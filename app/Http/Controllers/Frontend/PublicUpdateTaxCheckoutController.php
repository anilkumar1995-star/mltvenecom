<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PublicUpdateTaxCheckoutController extends Controller
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

        // Fetch products
        $products = EcProduct::whereIn('id', array_keys($cart))->get();

        $subtotal = 0;

        foreach ($products as $product) {
            $qty = $cart[$product->id]['quantity'];
            $subtotal += $product->price * $qty;
        }

        // Get address inputs
        $country = $request->input('address.country');
        $state   = $request->input('address.state');
        $city    = $request->input('address.city');
        $zip     = $request->input('address.zip_code');

        // Example tax logic
        $taxRate = $this->getTaxRate($country, $state);

        $tax = ($subtotal * $taxRate) / 100;

        // Example shipping logic
        $shipping = $subtotal > 1000 ? 0 : 100;

        $total = $subtotal + $tax + $shipping;

        return response()->json([
            'subtotal' => $subtotal,
            'tax_rate' => $taxRate,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    protected function getTaxRate($country, $state)
    {
        // Simple example rules

        if ($country === 'India') {
            return 18;
        }

        if ($country === 'USA') {
            return 10;
        }

        return 5; // default
    }
}
