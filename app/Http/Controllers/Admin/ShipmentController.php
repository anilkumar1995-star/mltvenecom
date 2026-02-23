<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with(['order', 'order.user'])->orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.shipments.index', compact('shipments'));
    }

    public function destroy($id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->delete();
        return redirect()->back()->with('success', 'Shipment deleted successfully');
    }
}
