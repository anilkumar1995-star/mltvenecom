<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('frontend.cart.index')
                ->with('error', 'Your cart is empty!');
        }

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

            // Create order
            $order = Order::create([
                'user_id' => auth('customer')->id() ?? null,
                'sub_total' => $subtotal,
                'tax_amount' => $tax,
                'shipping_amount' => $shipping,
                'discount_amount' => 0,
                'amount' => $total,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'qty' => $item['quantity'],
                    'price' => $item['price'],
                    'tax_amount' => 0,
                ]);
            }

            // Create shipping address
            OrderAddress::create([
                'order_id' => $order->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip_code' => $validated['zip_code'],
                'country' => $validated['country'],
                'type' => 'shipping',
            ]);

            DB::commit();

            // Clear cart
            Session::forget('cart');

            return redirect()->route('frontend.checkout.success')
                ->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    public function success()
    {
        $order_id = Session::get('order_id');
        return view('frontend.checkout.success', compact('order_id'));
    }
}
