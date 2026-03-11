<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderReturnsExport;

class OrderReturnController extends Controller
{
    public function index()
    {
        $returns = OrderReturn::with(['order', 'user'])->orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.order-returns.index', compact('returns'));
    }

    public function destroy($id)
    {
        $return = OrderReturn::findOrFail($id);
        $return->delete();
        return redirect()->back()->with('success', 'Order return request deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids && is_array($ids)) {
            OrderReturn::whereIn('id', $ids)->delete();
            return response()->json(['success' => true, 'message' => 'Selected return requests deleted successfully']);
        }
        return response()->json(['success' => false, 'message' => 'No items selected'], 400);
    }

    public function export(Request $request)
    {
        return Excel::download(new OrderReturnsExport, 'order_returns_'.date('Y-m-d_H-i-s').'.xlsx');
    }
}
