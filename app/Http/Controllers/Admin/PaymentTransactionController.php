<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class PaymentTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with(['order']);

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'charge_id', 'payment_channel', 'description', 'amount', 'status'], // Searchable
            ['id', 'payment_channel', 'status', 'created_at'] // Filterable
        );

        $payments = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'              => 'ID',
            'charge_id'       => 'Charge ID',
            'payment_channel' => 'Payment Channel',
            'status'          => 'Status',
            'created_at'      => 'Created At',
        ];

        return view('admin-layouts.payments.transactions', compact('payments', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Payment::class, 'payment');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Payment::class, 'payments');
    }
}
