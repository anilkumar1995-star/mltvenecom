<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function index()
    {
        $products = EcProduct::select('id', 'name', 'price', 'sale_price', 'sku', 'images', 'image')->orderBy('id', 'desc')->paginate(20);
        return view('admin-layouts.product-prices.index', compact('products'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pk' => 'required|exists:ec_products,id',
            'name' => 'required|in:price,sale_price',
            'value' => 'nullable|numeric|min:0',
        ]);

        $product = EcProduct::find($request->pk);
        $product->{$request->name} = $request->value;
        $product->save();

        return response()->json(['success' => true]);
    }
}
