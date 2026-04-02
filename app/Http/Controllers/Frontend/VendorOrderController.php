<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorOrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if (!$store) {
            return redirect()->route('frontend.vendor.dashboard')->with('error', 'Store not found.');
        }

        $query = Order::where('store_id', $store->id)
            ->with(['user', 'payment']);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'code', 'amount'], // searchable
            ['id', 'status', 'amount', 'created_at'] // filterable
        );

        $orders = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'Order ID',
            'code' => 'Order Code',
            'amount' => 'Amount',
            'status' => 'Status',
            'created_at' => 'Created At'
        ];

        return view('frontend.vendor.orders.index', compact('orders', 'filterColumns'));
    }

    public function show(Order $order)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($order->store_id != $store->id) {
            abort(403);
        }

        $order->load(['items.product', 'address', 'payment', 'user', 'histories.user']);
        return view('frontend.vendor.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($order->store_id != $store->id) {
            abort(403);
        }

        $request->validate(['status' => 'required|string']);
        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        // Sync Invoice
        \App\Services\InvoiceService::createInvoiceFromOrder($order);

        // Record history
        \App\Models\OrderHistory::create([
            'action' => 'update_status',
            'description' => "Order status updated from " . ucfirst($oldStatus) . " to " . ucfirst($order->status) . " by vendor.",
            'order_id' => $order->id,
            'user_id' => null, // Since vendor is a Customer model, we log details in description for now or use extras
            'extras' => json_encode(['vendor_id' => $user->id, 'vendor_name' => $user->name])
        ]);

        return redirect()->route('frontend.vendor.orders.index')->with('success', 'Order status updated successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        Order::whereIn('id', $ids)->where('store_id', $store->id)->delete();

        return response()->json(['status' => true, 'message' => 'Orders deleted successfully.']);
    }
}
