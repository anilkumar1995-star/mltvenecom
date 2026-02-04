<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EcProduct;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $products = EcProduct::with(['brand', 'store'])->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin-layouts.product.product.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku',
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|max:60',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'allow_checkout_when_out_of_stock' => 'nullable|boolean',
            'with_storehouse_management' => 'nullable|boolean',
            'stock_status' => 'nullable|string|max:191',
            'is_featured' => 'nullable|boolean',
            'is_new_until' => 'nullable|date',
            'brand_id' => 'nullable|integer',
            'product_type' => 'nullable|string|max:60',
            'barcode' => 'nullable|string|max:150',
            'cost_per_item' => 'nullable|numeric',
            'price_includes_tax' => 'nullable|boolean',
            'length' => 'nullable|numeric',
            'wide' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'minimum_order_quantity' => 'nullable|integer',
            'maximum_order_quantity' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);
        
        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Set default values for hidden or non-form fields if needed
        $validated['created_by_id'] = auth()->id() ?? 0;
        $validated['created_by_type'] = 'App\Models\User';

        $product = EcProduct::create($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully.',
                'redirect' => route('admin.products.index')
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(EcProduct $product)
    {
        return view('admin-layouts.product.edit', compact('product'));
    }

    public function update(Request $request, EcProduct $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'sku' => 'nullable|string|max:191|unique:ec_products,sku,' . $product->id,
            'price' => 'nullable|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
            'status' => 'required|string|max:60',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'allow_checkout_when_out_of_stock' => 'nullable|boolean',
            'with_storehouse_management' => 'nullable|boolean',
            'stock_status' => 'nullable|string|max:191',
            'is_featured' => 'nullable|boolean',
            'is_new_until' => 'nullable|date',
            'brand_id' => 'nullable|integer',
            'product_type' => 'nullable|string|max:60',
            'barcode' => 'nullable|string|max:150',
            'cost_per_item' => 'nullable|numeric',
            'price_includes_tax' => 'nullable|boolean',
            'length' => 'nullable|numeric',
            'wide' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'minimum_order_quantity' => 'nullable|integer',
            'maximum_order_quantity' => 'nullable|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'redirect' => route('admin.products.index')
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(EcProduct $product)
    {
        $product->delete();
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.'
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No products selected.'], 400);
        }

        EcProduct::whereIn('id', $ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Selected products deleted successfully.'
        ]);
    }
}
