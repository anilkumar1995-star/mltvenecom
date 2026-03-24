<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class PaymentLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ApiLog::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'url', 'txnid', 'modal', 'request', 'response'], // Searchable
            ['id', 'modal', 'created_at'] // Filterable
        );

        $logs = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'url'        => 'URL',
            'txnid'      => 'Transaction ID',
            'modal'      => 'Modal',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.payments.logs', compact('logs', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, ApiLog::class, 'log');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, ApiLog::class, 'logs');
    }
}
