<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of all product categories.
     */
    public function index()
    {
        $categories = EcProductCategory::published()
            ->parent()
            ->with(['children' => function($q) {
                $q->published();
            }])
            ->withCount('products')
            ->orderBy('order', 'ASC')
            ->get();

        return view('frontend.categories.index', compact('categories'));
    }
}
