<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShipmentsExport;
use App\Helpers\TableHelpers;

class ShipmentController extends Controller
{

    public function index(Request $request)
    {
        $query = Shipment::with(['order', 'order.user', 'store']);

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'order_id', 'order.user.name', 'status', 'cod_status', 'tracking_id'],
        ['id', 'order_id', 'status', 'cod_status', 'created_at']
        );

        $shipments = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'Shipment ID',
            'order_id' => 'Order ID',
            'status' => 'Status',
            'cod_status' => 'COD Status',
            'tracking_id' => 'Tracking ID',
            'created_at' => 'Created At'
        ];

        return view('admin-layouts.shipments.index', compact('shipments', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Shipment::class , 'shipment');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Shipment::class , 'shipments');
    }

    public function edit($id)
    {
        $shipment = Shipment::with('order')->findOrFail($id);
        return view('admin-layouts.shipments.edit', compact('shipment'));
    }

    public function update(Request $request, $id)
    {
        $shipment = Shipment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,delivering,delivered,canceled',
            'cod_status' => 'required|in:pending,completed',
            'tracking_id' => 'nullable|string|max:191',
            'shipping_company_name' => 'nullable|string|max:191',
            'tracking_link' => 'nullable|string|max:191',
            'weight' => 'nullable|numeric',
            'note' => 'nullable|string',
            'estimate_date_shipped' => 'nullable|date',
            'date_shipped' => 'nullable|date',
        ]);

        $shipment->update($request->only([
            'status', 'cod_status', 'tracking_id', 'shipping_company_name',
            'tracking_link', 'weight', 'note', 'estimate_date_shipped', 'date_shipped'
        ]));

        if ($request->has('save_and_exit')) {
            return redirect()->route('admin.shipments.index')->with('success', 'Shipment updated successfully.');
        }

        return redirect()->route('admin.shipments.edit', $shipment->id)->with('success', 'Shipment updated successfully.');
    }

    public function export(Request $request)
    {
        return Excel::download(new ShipmentsExport, 'shipments_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}
