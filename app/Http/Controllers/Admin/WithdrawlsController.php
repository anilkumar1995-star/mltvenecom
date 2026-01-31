<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stores;
use Illuminate\Http\Request;

class WithdrawlsController extends Controller
{
   public function withdrawls()
   {
       return view('admin-layouts.marketplace.withdrawls.index');
   }

   
}
