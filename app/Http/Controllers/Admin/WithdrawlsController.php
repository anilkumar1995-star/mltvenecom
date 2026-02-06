<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stores;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawlsController extends Controller
{
   public function withdrawls()
   {
       $withdrawals = Withdrawal::with('customer.store')->orderBy('created_at', 'desc')->paginate(15);
       return view('admin-layouts.marketplace.withdrawls.index', compact('withdrawals'));
   }

   
}
