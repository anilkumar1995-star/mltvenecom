<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class QuickShopController extends Controller
{
    public function show(Request $request, $slug)
    {
        $request->validate([
            'reference_product' => ['sometimes', 'string'],
        ]);

        // Get product by slug
        $product = Product::with([
            'images',
            'tags',
            'options.values'
        ])->where('slug', $slug)->firstOrFail();

        // Optional reference product
        $referenceProduct = null;

        if ($request->filled('reference_product')) {
            $referenceProduct = Product::where('slug', $request->reference_product)->first();
        }

        // Basic variation logic
        $productVariation = $product->variations()->first();
        $selectedAttrs = $productVariation ? $productVariation->attributes : [];

        return response()->json([
            'html' => view('frontend.quick-shop', [
                'product' => $product,
                'productVariation' => $productVariation,
                'selectedAttrs' => $selectedAttrs,
                'referenceProduct' => $referenceProduct,
            ])->render()
        ]);
    }
}
