<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class IncompleteOrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::leftJoin('payments', 'ec_orders.payment_id', '=', 'payments.id')
            ->select('ec_orders.*', 'payments.payment_channel', 'payments.status as payment_status')
            ->where('ec_orders.is_finished', 0)
            ->with('user');

        TableHelpers::applyTableLogic($query, $request,
            ['ec_orders.id', 'payments.payment_channel', 'payments.status', 'user.name'],
            ['ec_orders.id', 'payments.payment_channel', 'payments.status', 'ec_orders.amount', 'ec_orders.created_at']
        );

        $orders = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'ec_orders.id' => 'ID',
            'payments.payment_channel' => 'Payment Method',
            'payments.status' => 'Payment Status',
            'ec_orders.amount' => 'Amount',
            'ec_orders.created_at' => 'Created At'
        ];

        return view('admin-layouts.incomplete-orders.index', compact('orders', 'filterColumns'));
    }

    public function destroy($id)
    {
        // Ensure it's an incomplete order
        $order = Order::where('is_finished', 0)->findOrFail($id);
        return TableHelpers::performDelete($order, Order::class, 'incomplete order');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => "No items selected."], 400);
        }

        try {
            Order::whereIn('id', $ids)->where('is_finished', 0)->delete();
            return response()->json(['success' => true, 'message' => "Selected incomplete orders deleted successfully."]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => "Error deleting incomplete orders: " . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // Placeholder
    }
}
