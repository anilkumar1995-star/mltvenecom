<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicUpdateCheckoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty'
            ]);
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        $subtotal = 0;

        foreach ($products as $product) {
            $quantity = $cart[$product->id]['quantity'];
            $subtotal += $product->price * $quantity;
        }

        // Example tax 18%
        $tax = $subtotal * 0.18;

        // Example flat shipping
        $shipping = 100;

        $total = $subtotal + $tax + $shipping;

        return response()->json([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }
}
