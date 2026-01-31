<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


class VendorController extends Controller
{
   public function vendors()
   {
       return view('admin-layouts.marketplace.vendors.index');
   }

    public function unverifiedVendors()
   {
       return view('admin-layouts.marketplace.vendors.unverified_vendors');
   }

    public function messages()
   {
       return view('admin-layouts.marketplace.vendors.messages');
   }
   
}
