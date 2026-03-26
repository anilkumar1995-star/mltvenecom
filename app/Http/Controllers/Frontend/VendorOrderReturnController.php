<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorOrderReturnController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        $query = OrderReturn::whereHas('order', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->with(['order', 'user']);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'reason'], // searchable
            ['id', 'return_status', 'created_at'] // filterable
        );

        $returns = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'reason' => 'Reason',
            'return_status' => 'Return Status',
            'created_at' => 'Date'
        ];

        return view('frontend.vendor.order-returns.index', compact('returns', 'filterColumns'));
    }

    public function show(OrderReturn $orderReturn)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($orderReturn->order->store_id != $store->id) {
            abort(403);
        }

        return view('frontend.vendor.order-returns.show', compact('orderReturn'));
    }

    public function update(Request $request, OrderReturn $orderReturn)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($orderReturn->order->store_id != $store->id) {
            abort(403);
        }

        $request->validate(['return_status' => 'required|string']);
        $orderReturn->update(['return_status' => $request->return_status]);

        return back()->with('success', 'Return status updated successfully.');
    }
}
