<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class IncompleteOrderController extends Controller
{
    public function index()
    {
        // specific logic for incomplete: is_finished = 0
        $orders = Order::where('is_finished', 0)->with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.incomplete-orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::where('is_finished', 0)->findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Incomplete order deleted successfully');
    }

 
    public function show($id)
    {

    }
}
