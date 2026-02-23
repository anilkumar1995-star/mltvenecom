<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderReturn;
use Illuminate\Http\Request;

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
}
