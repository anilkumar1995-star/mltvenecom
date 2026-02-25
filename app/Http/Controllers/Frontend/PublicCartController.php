<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PublicCartController extends Controller
{
    private function getCart()
    {
        return session()->get('cart', []);
    }

    private function saveCart($cart)
    {
        session()->put('cart', $cart);
    }

    public function index()
    {
        $cart = $this->getCart();

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return response()->json([
            'status' => true,
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'nullable|integer|min:1'
        ]);

        $product = Product::findOrFail($request->id);
        $qty = $request->qty ?? 1;

        if ($product->quantity < $qty) {
            return response()->json([
                'status' => false,
                'message' => 'Not enough stock'
            ]);
        }

        $cart = $this->getCart();

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty
            ];
        }

        $this->saveCart($cart);

        return response()->json([
            'status' => true,
            'message' => 'Added to cart',
            'cart' => $cart
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = $this->getCart();

        if (!isset($cart[$request->id])) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ]);
        }

        $cart[$request->id]['qty'] = $request->qty;

        $this->saveCart($cart);

        return response()->json([
            'status' => true,
            'message' => 'Cart updated',
            'cart' => $cart
        ]);
    }

    public function destroy($id)
    {
        $cart = $this->getCart();

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->saveCart($cart);
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed',
            'cart' => $cart
        ]);
    }

    public function empty()
    {
        session()->forget('cart');

        return response()->json([
            'status' => true,
            'message' => 'Cart emptied'
        ]);
    }
}
