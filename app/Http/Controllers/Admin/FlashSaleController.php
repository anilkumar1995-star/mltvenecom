<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcFlashSale;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class FlashSaleController extends Controller
{
    public function index(Request $request)
    {
        $query = EcFlashSale::withCount('products');

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name'], // Searchable
            ['id', 'name', 'status', 'end_date', 'created_at'] // Filterable
        );

        $flashSales = $query->orderBy('id', 'desc')->paginate(15);

        $filterColumns = [
            'id'         => 'ID',
            'name'       => 'Name',
            'status'     => 'Status',
            'end_date'   => 'End Date',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.flash-sales.index', compact('flashSales', 'filterColumns'));
    }

    public function create()
    {
        $products = EcProduct::where('status', 'published')->get();
        return view('admin-layouts.flash-sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'end_date' => 'required|date',
            'status' => 'required|in:published,draft,closed',
            'products' => 'nullable|array',
            'products.*.product_id' => 'required|exists:ec_products,id',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $flashSale = EcFlashSale::create([
            'name' => $request->name,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        if ($request->has('products')) {
            $syncData = [];
            foreach ($request->products as $product) {
                 if (isset($product['product_id'])) {
                    $syncData[$product['product_id']] = [
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                        'sold' => 0,
                    ];
                }
            }
            $flashSale->products()->sync($syncData);
        }

        if ($request->input('submiter') === 'save') {
             return redirect()->route('admin.flash-sales.edit', $flashSale->id)->with('success', 'Flash sale created successfully.');
        }

        return redirect()->route('admin.flash-sales.index')->with('success', 'Flash sale created successfully.');
    }

    public function edit($id)
    {
        $flashSale = EcFlashSale::with('products')->findOrFail($id);
        $products = EcProduct::where('status', 'published')->get();
        return view('admin-layouts.flash-sales.edit', compact('flashSale', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'end_date' => 'required|date',
            'status' => 'required|in:published,draft,closed',
            'products' => 'nullable|array',
            'products.*.product_id' => 'required|exists:ec_products,id',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $flashSale = EcFlashSale::findOrFail($id);

        $flashSale->update([
            'name' => $request->name,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        if ($request->has('products')) {
            $syncData = [];
            foreach ($request->products as $product) {
                 if (isset($product['product_id'])) {
                    $existingPivot = $flashSale->products()->where('ec_flash_sale_products.product_id', $product['product_id'])->first();
                    $sold = $existingPivot ? $existingPivot->pivot->sold : 0;

                    $syncData[$product['product_id']] = [
                        'price' => $product['price'],
                        'quantity' => $product['quantity'],
                        'sold' => $sold,
                    ];
                }
            }
            $flashSale->products()->sync($syncData);
        } else {
            $flashSale->products()->detach();
        }

        if ($request->input('submiter') === 'save') {
            return redirect()->back()->with('success', 'Flash sale updated successfully.');
        }

        return redirect()->route('admin.flash-sales.index')->with('success', 'Flash sale updated successfully.');
    }

    public function destroy($id)
    {
        $flashSale = EcFlashSale::findOrFail($id);
        $flashSale->products()->detach();
        return TableHelpers::performDelete($flashSale, EcFlashSale::class, 'flash sale');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcFlashSale::class, 'flash sales');
    }
}
