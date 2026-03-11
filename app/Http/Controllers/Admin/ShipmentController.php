<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ShipmentsExport;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with(['order', 'order.user', 'store'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin-layouts.shipments.index', compact('shipments'));
    }

    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();
        return redirect()->back()->with('success', 'Shipment deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            Shipment::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected shipments deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected'], 400);
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
        return Excel::download(new ShipmentsExport, 'shipments_'.date('Y-m-d_H-i-s').'.xlsx');
    }
}
