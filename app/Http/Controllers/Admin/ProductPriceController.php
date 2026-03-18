<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class ProductPriceController extends Controller
{
    public function index(Request $request)
    {
        $query = EcProduct::select('id', 'name', 'price', 'sale_price', 'sku', 'images', 'image');

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name', 'sku', 'price', 'sale_price'],
            ['id', 'created_at']
        );

        $products = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'sku' => 'SKU',
            'price' => 'Price',
            'sale_price' => 'Sale Price',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product-prices.index', compact('products', 'filterColumns'));
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

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcProduct::class, 'products');
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, EcProduct::class, 'product');
    }
}
