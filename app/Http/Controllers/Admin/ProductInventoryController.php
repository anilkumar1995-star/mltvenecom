<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class ProductInventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = EcProduct::query();

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name', 'sku'],
            ['id', 'stock_status', 'with_storehouse_management', 'created_at']
        );

        $products = $query->select('id', 'name', 'sku', 'images', 'image', 'is_variation', 'stock_status', 'quantity', 'with_storehouse_management', 'price', 'sale_price')
                    ->orderBy('id', 'desc')
                    ->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'sku' => 'SKU',
            'stock_status' => 'Stock Status',
            'with_storehouse_management' => 'Storehouse Management',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product-inventory.index', compact('products', 'filterColumns'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pk' => 'required|exists:ec_products,id',
            'name' => 'required|in:stock_status,quantity,with_storehouse_management',
            'value' => 'nullable',
        ]);

        $product = EcProduct::find($request->pk);

        if ($request->name == 'quantity') {
             $product->quantity = (int) $request->value;
        } elseif ($request->name == 'stock_status') {
             $product->stock_status = $request->value;
        } elseif($request->name == 'with_storehouse_management') {
             $product->with_storehouse_management = $request->value;
        }

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
