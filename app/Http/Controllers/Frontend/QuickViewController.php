<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class QuickViewController extends Controller
{
    public function show(Request $request, $id = null)
    {
        $id = $id ?? $request->input('product_id');

        if (!$id) {
            return response()->json([
                'status' => false,
                'message' => 'Product ID is required.'
            ]);
        }

        // Fetch product with relations
        $product = Product::with([
            'images',
            'tags',
            'options.values',
            'variations.attributes'
        ])->find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'This product is not available.'
            ]);
        }

        // Basic variation logic
        $productVariation = $product->variations->first();
        $selectedAttrs = $productVariation ? $productVariation->attributes : [];

        return response()->json([
            'status' => true,
            'html' => view('frontend.quick-view', [
                'product' => $product,
                'productImages' => $product->images,
                'productVariation' => $productVariation,
                'selectedAttrs' => $selectedAttrs,
            ])->render()
        ]);
    }
}
