<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stores;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
   public function reports()
   {
       return view('admin-layouts.marketplace.reports.index');
   }

   
}
