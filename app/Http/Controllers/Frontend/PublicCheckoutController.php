<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublicCheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart is empty');
        }

        return view('checkout.index', compact('cart'));
    }

    // Place Order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($cart as $id => $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'name'         => $request->name,
                'email'        => $request->email,
                'phone'        => $request->phone,
                'address'      => $request->address,
                'total_amount' => $total,
                'status'       => 'pending',
            ]);

            foreach ($cart as $id => $item) {

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);

                // Reduce stock
                Product::where('id', $id)
                    ->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong!');
        }
    }

    // Success Page
    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('checkout.success', compact('order'));
    }
}
