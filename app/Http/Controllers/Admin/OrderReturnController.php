<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderReturnsExport;
use App\Helpers\TableHelpers;

class OrderReturnController extends Controller
{

    public function index(Request $request)
    {
        $query = OrderReturn::with(['order', 'user']);

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'order_id', 'user.name', 'reason', 'return_status'],
            ['id', 'order_id', 'return_status', 'created_at']
        );

        $returns = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'Return ID',
            'order_id' => 'Order ID',
            'reason' => 'Reason',
            'return_status' => 'Return Status',
            'created_at' => 'Created At'
        ];

        return view('admin-layouts.order-returns.index', compact('returns', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, OrderReturn::class, 'order return');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, OrderReturn::class, 'order returns');
    }

    public function export(Request $request)
    {
        return Excel::download(new OrderReturnsExport, 'order_returns_'.date('Y-m-d_H-i-s').'.xlsx');
    }
}
