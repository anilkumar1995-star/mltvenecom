<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $products = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin-layouts.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin-layouts.product.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'stock_status' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:100',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'stock_status' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.products.index')->with('error', 'No items selected.');
        }

        Product::whereIn('id', $ids)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Selected products deleted.');
    }
}
