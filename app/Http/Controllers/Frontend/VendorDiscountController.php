<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorDiscountController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        $query = Discount::where('store_id', $store->id);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'title', 'code'], // searchable
            ['id', 'title', 'code', 'type', 'total_used', 'created_at'] // filterable
        );

        $discounts = $query->with('store')->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'title' => 'Title',
            'code' => 'Code',
            'type' => 'Type',
            'total_used' => 'Total Used',
            'created_at' => 'Date'
        ];

        return view('frontend.vendor.discounts.index', compact('discounts', 'filterColumns'));
    }

    public function create()
    {
        return view('frontend.vendor.discounts.create');
    }

    public function store(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if (!$store) {
            return redirect()->route('frontend.vendor.dashboard')->with('error', 'Store not found.');
        }

        $request->validate([
            'title' => 'nullable|string|max:191',
            'code' => 'required_if:type,coupon|nullable|string|max:191|unique:ec_discounts,code',
            'value' => 'required|numeric|min:0',
            'type' => 'required|string|in:coupon,promotion',
            'type_option' => 'required|string|in:amount,percentage',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->all();
        $data['store_id'] = $store->id;
        
        // If it's a coupon and title is empty, use code as title
        if ($data['type'] == 'coupon' && empty($data['title'])) {
            $data['title'] = $data['code'];
        }

        Discount::create($data);

        return redirect()->route('frontend.vendor.discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($discount->store_id != $store->id) {
            abort(403);
        }

        return view('frontend.vendor.discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($discount->store_id != $store->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'nullable|string|max:191',
            'code' => 'required_if:type,coupon|nullable|string|max:191|unique:ec_discounts,code,' . $discount->id,
            'value' => 'required|numeric|min:0',
            'type' => 'required|string|in:coupon,promotion',
            'type_option' => 'required|string|in:amount,percentage',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $data = $request->all();
        // If it's a coupon and title is empty, use code as title
        if ($data['type'] == 'coupon' && empty($data['title'])) {
            $data['title'] = $data['code'];
        }

        $discount->update($data);

        return redirect()->route('frontend.vendor.discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($discount->store_id != $store->id) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $discount->delete();

        return response()->json(['status' => true, 'message' => 'Discount deleted successfully.']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        Discount::whereIn('id', $ids)->where('store_id', $store->id)->delete();

        return response()->json(['status' => true, 'message' => 'Discounts deleted successfully.']);
    }
}
