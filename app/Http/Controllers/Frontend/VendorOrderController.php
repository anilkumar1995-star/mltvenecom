<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Store;
use App\Services\InvoiceService;
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
            ->with(['user', 'payment', 'items']);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'code', 'amount'], 
            ['id', 'status', 'amount', 'created_at'] 
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
        $newStatus = $request->status;
        
        $order->update([
            'status' => $newStatus,
            'is_finished' => 1
        ]);

        // Explicitly load products to ensure stock can be updated
        $order->load('items.product');

        // Stock Management Logic
        $reducedStatuses = ['pending', 'processing', 'shipped', 'completed'];
        $wasReduced = in_array($oldStatus, $reducedStatuses);
        $isReduced = in_array($newStatus, $reducedStatuses);

        if (!$wasReduced && $isReduced) {
            // Deduct from stock
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->decrement('quantity', $item->qty);
                }
            }
        } elseif ($wasReduced && !$isReduced && in_array($newStatus, ['canceled', 'returned'])) {
            // Restore stock
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('quantity', $item->qty);
                }
            }
        }

        // Sync Invoice
        InvoiceService::createInvoiceFromOrder($order);

        // Record history
        OrderHistory::create([
            'action' => 'update_status',
            'description' => "Order status updated from " . ucfirst($oldStatus) . " to " . ucfirst($order->status) . " by vendor.",
            'order_id' => $order->id,
            'user_id' => $user->id ?? null, 
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
