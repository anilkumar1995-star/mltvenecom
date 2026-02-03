<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EcProductTag;
use Illuminate\Http\Request;

class ProductTaxesConntroller extends Controller
{
    public function Index(){
        $data['tags'] = EcProductTag::orderBy('id','desc')->get();
        return view('admin-layouts.product.taxes.index',$data);
    }
}
