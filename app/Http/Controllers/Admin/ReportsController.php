<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
   public function reports()
   {
        $storeCount = Store::count();
        $vendorCount = Customer::whereHas('store')->count();
        $withdrawalCount = Withdrawal::where('status', 'pending')->count();
        
        $latestWithdrawals = Withdrawal::with('customer.store')->latest()->limit(5)->get();
        $topStores = Store::withCount('products')->orderBy('products_count', 'desc')->limit(5)->get();

        $totalFee = Withdrawal::sum('fee');
        $totalAmount = Withdrawal::sum('amount');
        $commissionRate = $totalAmount > 0 ? ($totalFee / $totalAmount) * 100 : 0;

        return view('admin-layouts.marketplace.reports.index', compact(
            'storeCount', 
            'vendorCount', 
            'withdrawalCount', 
            'latestWithdrawals', 
            'topStores',
            'totalFee',
            'totalAmount',
            'commissionRate'
        ));
   }

   
}
