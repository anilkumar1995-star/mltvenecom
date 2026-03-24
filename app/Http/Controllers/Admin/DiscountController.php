<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\EcProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $query = Discount::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'title', 'code'], // Searchable
            ['id', 'title', 'code', 'type', 'type_option', 'start_date', 'end_date', 'created_at'] // Filterable
        );

        $discounts = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'          => 'ID',
            'title'       => 'Title',
            'code'        => 'Coupon Code',
            'type'        => 'Type',
            'type_option' => 'Discount Type',
            'start_date'  => 'Start Date',
            'end_date'    => 'End Date',
            'created_at'  => 'Created At',
        ];

        return view('admin-layouts.discounts.index', compact('discounts', 'filterColumns'));
    }

    public function create()
    {
        $products = EcProduct::where('status', 'published')->get();
        return view('admin-layouts.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required_if:type,coupon|nullable|string|unique:ec_discounts,code|max:255',
            'value' => 'required|numeric|min:0',
            'type_option' => 'required|in:amount,percentage',
            'type' => 'required|in:coupon,promotion',
            'quantity' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'target' => 'required|in:all-orders,amount-minimum-order,specific-product,group-products,specific-customer',
            'min_order_price' => 'nullable|numeric|min:0',
        ]);

        $title = $request->code;
        if (!$title) {
            $title = 'Promotion ' . now()->format('Y-m-d H:i:s');
        }

        $discount = Discount::create([
            'title' => $title,
            'code' => $request->code,
            'value' => $request->value,
            'type_option' => $request->type_option,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'target' => $request->target,
            'min_order_price' => $request->min_order_price,
            'can_use_with_promotion' => $request->has('can_use_with_promotion'),
            'can_use_with_flash_sale' => $request->has('can_use_with_flash_sale'),
            'apply_via_url' => $request->has('apply_via_url'),
            'display_at_checkout' => $request->has('display_at_checkout'),
            'description' => $request->description,
        ]);

        if ($request->target == 'specific-product' && $request->has('products')) {
            $discount->products()->attach($request->products);
        }

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit($id)
    {
        $discount = Discount::with('products')->findOrFail($id);
        $products = EcProduct::where('status', 'published')->get();
        return view('admin-layouts.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::findOrFail($id);

        $request->validate([
            'code' => 'required_if:type,coupon|nullable|string|max:255|unique:ec_discounts,code,' . $id,
            'value' => 'required|numeric|min:0',
            'type_option' => 'required|in:amount,percentage',
            'type' => 'required|in:coupon,promotion',
            'quantity' => 'nullable|integer|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'target' => 'required|in:all-orders,amount-minimum-order,specific-product,group-products,specific-customer',
            'min_order_price' => 'nullable|numeric|min:0',
        ]);

        $title = $request->code;
        if (!$title) {
            $title = $discount->title;
            if (!$title || $request->type == 'coupon') {
                  $title = $request->code ?? 'Promotion ' . now()->format('Y-m-d H:i:s');
            }
        }

        $discount->update([
            'title' => $title,
            'code' => $request->code,
            'value' => $request->value,
            'type_option' => $request->type_option,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'target' => $request->target,
            'min_order_price' => $request->min_order_price,
            'can_use_with_promotion' => $request->has('can_use_with_promotion'),
            'can_use_with_flash_sale' => $request->has('can_use_with_flash_sale'),
            'apply_via_url' => $request->has('apply_via_url'),
            'display_at_checkout' => $request->has('display_at_checkout'),
            'description' => $request->description,
        ]);

        if ($request->target == 'specific-product') {
             $discount->products()->sync($request->products ?? []);
        } else {
             $discount->products()->detach();
        }

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Discount::class, 'discount');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Discount::class, 'discounts');
    }
}
