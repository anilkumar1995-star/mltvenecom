<?php

namespace App\Http\Controllers\Admin\ProductSpecification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        return view('admin-layouts.product-specification.group.index');
    }

    public function create(){
        return view('admin-layouts.product-specification.group.create');
    } 

    public function productIndex(){
        return view('admin-layouts.product-specification.group.index');
    }

}