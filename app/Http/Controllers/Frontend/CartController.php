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
        $product_ids = $request->input('product_ids');
        if (!is_array($product_ids)) {
            $product_ids = [$request->input('product_id')];
        }

        $cart = Session::get('cart', []);
        $quantity = $request->quantity ?? 1;
        $added_count = 0;

        foreach ($product_ids as $id) {
            if (!$id) continue;
            
            $product = EcProduct::where('id', $id)->first();
            if (!$product) continue;

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
            $added_count++;
        }

        if ($added_count > 0) {
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => $added_count > 1 ? 'Bundle added to cart!' : 'Product added to cart!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
        }

        return back()->with('success', $added_count > 1 ? 'Bundle added to cart!' : 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            $newQty = (int) $request->quantity;
            if ($newQty <= 0) {
                unset($cart[$request->product_id]);
            } else {
                $cart[$request->product_id]['quantity'] = $newQty;
            }
            Session::put('cart', $cart);
        }

        if ($request->ajax()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'count' => count($cart),
                'subtotal' => $total,
                'html' => view('frontend.partials.mini-cart')->render(),
            ]);
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
