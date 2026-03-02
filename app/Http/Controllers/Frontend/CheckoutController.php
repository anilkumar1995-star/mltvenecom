<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;
use App\Models\Customer;
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
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('frontend.cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.15; // 15% tax
        $shipping = 20; // Flat shipping
        $total = $subtotal + $tax + $shipping;

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function process(Request $request)
    {
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

            $tax = $subtotal * 0.15;
            $shipping = 20;
            $total = $subtotal + $tax + $shipping;
            // Generate unique #000000 style code
            do {
                $code = '#' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            } while (Order::where('code', $code)->exists());

            // Generate unique token
            $token = \Illuminate\Support\Str::random(32);

            // Create order
            $order = Order::create([
                'user_id' => $this->getUserId(),
                'code' => $code,
                'token' => $token,
                'sub_total' => $subtotal,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'discount_amount' => 0,
                'amount' => $total,
                'status' => 'pending',
                'description' => $request->input('description'),
                'shipping_method' => $request->input('payment_method', 'cod'),
                'is_confirmed' => 0,
                'is_finished' => 0,
            ]);

            // Create order items
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
            }

            // Create shipping address
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

            // If billing address is different
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

            // Clear cart
            Session::forget('cart');

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
        return view('frontend.checkout.success', compact('order_id'));
    }
}
