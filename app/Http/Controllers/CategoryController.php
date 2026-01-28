<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::whereNull('deleted_at')->orderBy('id','desc')->get();
        return view('admin-layouts.category.index');
    }

    public function create(){
        return view('admin-layouts.category.create');
    }
}
