<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('frontend.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        if ($product->isOutOfStock()) {
            return back()->with('error', 'Product is out of stock!');
        }
        
        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->getFinalPrice(),
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug,
            ];
        }
        
        Session::put('cart', $cart);
        
        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        
        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return back()->with('success', 'Product removed from cart!');
    }
}
