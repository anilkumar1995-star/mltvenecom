<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;
use App\Models\Customer;
use App\Models\Payment;
use App\Services\InvoiceService;
use App\Helpers\CommonHelper;
use App\Models\Discount;
use App\Models\Tax;
use App\Models\Store;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Get the correct user_id for orders (from users table)
     */
    private function getUserId()
    {
        // If logged in via customer guard, return directly
        if (auth('customer')->check()) {
            return auth('customer')->id();
        }

        // If logged in via web guard, find matching ec_customers record by email
        if (auth('web')->check()) {
            $user = auth('web')->user();
            $customer = Customer::where('email', $user->email)->first();
            
            // If no customer record exists, create one
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? $user->mobile ?? null,
                    'password' => $user->password ?? bcrypt('password'),
                    'confirmed_at' => now(),
                    'status' => 'activated',
                ]);
            }
            
            return $customer->id;
        }

        return null;
    }

    public function index()
    {
        if (!auth('customer')->check() && !auth('web')->check()) {
            session(['url.intended' => route('frontend.checkout.index')]);
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout.');
        }

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('frontend.cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Fetch Dynamic Tax
        // 1. Calculate Discount
        $discountAmount = 0;
        $couponCode = Session::get('applied_coupon');
        if ($couponCode) {
            $discount = Discount::active()->available()->where('code', $couponCode)->first();
            if ($discount) {
                if ($discount->type_option === 'percentage') {
                    $discountAmount = $subtotal * ($discount->value / 100);
                } else {
                    $discountAmount = $discount->value;
                }
            } else {
                Session::forget('applied_coupon');
            }
        }

        // 2. Fetch Dynamic Tax Rate
        $taxItem = Tax::where('status', 'published')->orderBy('priority', 'desc')->first();
        $taxPercentage = $taxItem ? $taxItem->percentage : 0;
        $taxTitle = $taxItem ? $taxItem->title : 'Tax';
        
        // 3. Calculate Tax on Discounted Subtotal
        $taxableSubtotal = max(0, $subtotal - $discountAmount);
        $tax = $taxableSubtotal * ($taxPercentage / 100);
        
        $shipping = 0; // Removed as requested
        $total = $taxableSubtotal + $tax + $shipping;

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'tax', 'shipping', 'total', 'discountAmount', 'couponCode', 'taxPercentage', 'taxTitle'));
    }

    public function process(Request $request)
    {
        if (!auth('customer')->check() && !auth('web')->check()) {
            session(['url.intended' => route('frontend.checkout.index')]);
            return redirect()->route('login')->with('error', 'Please login to proceed to checkout.');
        }

        $validated = $request->validate([
            'address.name' => 'required|string|max:255',
            'address.email' => 'required|email',
            'address.phone_display' => 'nullable|string',
            'address.address' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.country' => 'required|string',
            'payment_method' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('frontend.cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $addressData = $request->input('address');

        DB::beginTransaction();
        try {
            // Calculate totals
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $discountAmount = 0;
            $couponCode = Session::get('applied_coupon');
            if ($couponCode) {
                $discount = Discount::active()->available()->where('code', $couponCode)->first();
                if ($discount) {
                    if ($discount->type_option === 'percentage') {
                        $discountAmount = $subtotal * ($discount->value / 100);
                    } else {
                        $discountAmount = $discount->value;
                    }
                    $discount->increment('total_used');
                }
            }

            $taxItem = Tax::where('status', 'published')->orderBy('priority', 'desc')->first();
            $taxPercentage = $taxItem ? $taxItem->percentage : 0;
            
            $taxableSubtotal = max(0, $subtotal - $discountAmount);
            $tax = $taxableSubtotal * ($taxPercentage / 100);
            
            $shipping = 0;
            $total = $taxableSubtotal + $tax + $shipping;
            do {
                $code = 'ORD' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
            } while (Order::where('code', $code)->exists());

            $token = \Illuminate\Support\Str::random(32);

            // Identify store for the order (scanning all items for parent store)
            $storeId = null;
            foreach ($cart as $cartItem) {
                $product = EcProduct::find($cartItem['id']);
                if ($product) {
                    if ($product->store_id) {
                        $storeId = $product->store_id;
                    } elseif ($product->is_variation) {
                        $parent = \App\Models\ProductVariation::getParentOfVariation($product->id);
                        if ($parent && $parent->store_id) {
                            $storeId = $parent->store_id;
                        }
                    }
                }
                if ($storeId) break;
            }

            $payment = Payment::create([
                'currency' => 'INR',
                'user_id' => $this->getUserId() ?? 0,
                'payment_channel' => $request->input('payment_method', 'cod'),
                'description' => 'Online checkout order',
                'amount' => $total,
                'status' => 'pending',
                'payment_type' => 'confirm',
                'customer_id' => $this->getUserId(),
                'customer_type' => 'App\\Models\\Customer',
            ]);

            $order = Order::create([
                'user_id' => $this->getUserId(),
                'code' => $code,
                'token' => $token,
                'sub_total' => $subtotal,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'discount_amount' => $discountAmount,
                'coupon_code' => $couponCode,
                'amount' => $total,
                'status' => 'pending',
                'description' => $request->input('description'),
                'shipping_method' => $request->input('payment_method', 'cod'),
                'payment_id' => $payment->id,
                'is_confirmed' => 0,
                'is_finished' => 0,
                'store_id' => $storeId,
            ]);

            $payment->update(['order_id' => $order->id]);

            foreach ($cart as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_image' => $item['image'] ?? null,
                    'qty' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_amount' => 0,
                ]);

                $product = EcProduct::find($item['id']);
                if ($product && $product->with_storehouse_management) {
                    $newQty = max(0, $product->quantity - $item['quantity']);
                    $product->quantity = $newQty;
                    
                    if ($newQty <= 0 && !$product->allow_checkout_when_out_of_stock) {
                        $product->stock_status = 'out_of_stock';
                    }
                    
                    $product->save();
                }
            }

            OrderAddress::create([
                'order_id' => $order->id,
                'name' => $addressData['name'],
                'email' => $addressData['email'],
                'phone' => $addressData['phone_display'] ?? '',
                'address' => $addressData['address'],
                'city' => $addressData['city'],
                'state' => $addressData['state'],
                'zip_code' => '',
                'country' => $addressData['country'],
                'type' => 'shipping',
            ]);

            if (!$request->input('billing_address_same_as_shipping_address')) {
                $billingData = $request->input('billing_address', []);
                if (!empty($billingData['name'])) {
                    OrderAddress::create([
                        'order_id' => $order->id,
                        'name' => $billingData['name'] ?? $addressData['name'],
                        'email' => $billingData['email'] ?? $addressData['email'],
                        'phone' => $billingData['phone_display'] ?? '',
                        'address' => $billingData['address'] ?? $addressData['address'],
                        'city' => $billingData['city'] ?? $addressData['city'],
                        'state' => $billingData['state'] ?? $addressData['state'],
                        'zip_code' => '',
                        'country' => $billingData['country'] ?? $addressData['country'],
                        'type' => 'billing',
                    ]);
                }
            }

            DB::commit();
            $order->update(['is_finished' => 1]);

            InvoiceService::createInvoiceFromOrder($order);

            // Notify Vendor about new order
            if ($order->store_id) {
                $store = Store::find($order->store_id);
                if ($store && !empty($store->email)) {
                    try {
                        $order->load('items');
                        $html = view('frontend.mail.order-notification', compact('order', 'store'))->render();
                        CommonHelper::sendZohoEmail($store->email, "[" . config('app.name') . "] New Order Received: #" . $order->code, $html);
                    } catch (\Exception $e) {
                        \Illuminate\Support\Facades\Log::error('Vendor notification failed: ' . $e->getMessage());
                    }
                }
            }


            if (!empty($addressData['email'])) {
                try {
                    $order->load(['items', 'payment', 'address']);
                    $html = view('frontend.mail.customer-order-confirmation', compact('order'))->render();
                    CommonHelper::sendZohoEmail($addressData['email'], "Order Confirmation: #" . $order->code . " [" . config('app.name') . "]", $html);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Customer notification failed: ' . $e->getMessage());
                }
            }

            Session::forget(['cart', 'applied_coupon']);

            return redirect()->route('frontend.checkout.success')
                ->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage())->withInput();
        }
    }

    public function success()
    {
        $order_id = session('order_id');
        $order = null;
        if ($order_id) {
            $order = Order::find($order_id);
        }
        return view('frontend.checkout.success', compact('order_id', 'order'));
    }

    public function applyCoupon(Request $request)
    {
        $code = $request->input('coupon_code');
        
        if (!$code) {
            return response()->json(['success' => false, 'error' => true, 'message' => 'Please enter a coupon code.']);
        }

        $discount = Discount::active()->available()->where('code', $code)->first();

        if (!$discount) {
            return response()->json(['success' => false, 'error' => true, 'message' => 'Invalid or expired coupon code.']);
        }

        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        if ($discount->min_order_price && $subtotal < $discount->min_order_price) {
            return response()->json(['success' => false, 'error' => true, 'message' => 'Order subtotal must be at least ₹' . number_format($discount->min_order_price, 2) . ' to use this coupon.']);
        }

        Session::put('applied_coupon', $code);

        return response()->json(['success' => true, 'error' => false, 'message' => 'Coupon applied successfully!']);
    }

    public function removeCoupon()
    {
        Session::forget('applied_coupon');
        return back()->with('success', 'Coupon removed successfully.');
    }
}
