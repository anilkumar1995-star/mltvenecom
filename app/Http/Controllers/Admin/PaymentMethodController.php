<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Api;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $query = Api::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'product', 'name', 'url', 'username', 'code', 'type'], // Searchable
            ['id', 'product', 'status', 'type', 'created_at'] // Filterable
        );

        $methods = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'      => 'ID',
            'product' => 'Product / Service',
            'name'    => 'Name',
            'type'    => 'Type',
            'status'  => 'Status',
        ];

        return view('admin-layouts.payments.methods', compact('methods', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Api::class, 'payment method');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Api::class, 'payment methods');
    }
}
