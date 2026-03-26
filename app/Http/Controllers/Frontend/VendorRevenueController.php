<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorRevenueController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->with('customer')->first();

        if (!$store) {
            return redirect()->route('frontend.vendor.dashboard')->with('error', 'Store not found.');
        }

        // Stats
        $totalSales = Order::where('store_id', $store->id)->where('status', 'completed')->sum('amount');
        $totalOrders = Order::where('store_id', $store->id)->count();
        $completedOrdersCount = Order::where('store_id', $store->id)->where('status', 'completed')->count();
        
        $totalWithdrawn = Withdrawal::where('customer_id', $user->id)->where('status', 'completed')->sum('amount');
        $pendingWithdrawn = Withdrawal::where('customer_id', $user->id)->where('status', 'pending')->sum('amount');
        
        // Calculations
        $balance = $totalSales - $totalWithdrawn;

        // Sales Chart Data (Last 30 days)
        $salesData = Order::where('store_id', $store->id)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('frontend.vendor.revenues.index', compact(
            'totalSales',
            'totalOrders',
            'completedOrdersCount',
            'totalWithdrawn',
            'pendingWithdrawn',
            'balance',
            'salesData'
        ));
    }
}
