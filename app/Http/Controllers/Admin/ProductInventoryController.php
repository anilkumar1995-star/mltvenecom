<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use Illuminate\Http\Request;

class ProductInventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = EcProduct::query();

        if ($request->has('keyword') && $request->keyword != '') {
            $query->where('name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('sku', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('stock_status') && $request->stock_status != '') {
            $query->where('stock_status', $request->stock_status);
        }

        $sort_by = $request->input('sort_by', 'id');
        $sort_order = $request->input('sort_order', 'desc');
        $query->orderBy($sort_by, $sort_order);

        $products = $query->select('id', 'name', 'sku', 'images', 'image', 'is_variation', 'stock_status', 'quantity', 'with_storehouse_management', 'price', 'sale_price')
                    ->paginate(20);

        return view('admin-layouts.product-inventory.index', compact('products'));
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
}
