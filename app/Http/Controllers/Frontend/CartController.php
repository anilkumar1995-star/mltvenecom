<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
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
        // if (!auth()->guard('customer')->check() && !auth()->guard('web')->check()) {
        //     if (!$request->ajax()) {
        //         session(['url.intended' => url()->previous()]);
        //         return redirect()->route('login');
        //     }
        //      return response()->json(['error' => 'Unauthenticated', 'url' => route('login')], 401);
        // }

        $product = EcProduct::findOrFail($request->product_id);

        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->final_price,
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug ?: $product->id,
            ];
        }

        Session::put('cart', $cart);

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
        }

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

    public function remove(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
        }

        return back()->with('success', 'Product removed from cart!');
    }

    public function buyNow(Request $request)
    {
        $product = EcProduct::findOrFail($request->product_id);

        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->final_price,
                'quantity' => $quantity,
                'image' => $product->image,
                'slug' => $product->slug ?: $product->id,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('frontend.checkout.index');
    }
}
