<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $featured_products = Product::published()
            ->featured()
            ->inStock()
            ->with(['brand', 'categories'])
            ->take(8)
            ->get();

        $new_arrivals = Product::published()
            ->inStock()
            ->with(['brand', 'categories'])
            ->latest()
            ->take(8)
            ->get();

        $on_sale = Product::published()
            ->onSale()
            ->inStock()
            ->with(['brand', 'categories'])
            ->take(8)
            ->get();

        $categories = ProductCategory::published()
            ->parent()
            ->featured()
            ->take(8)
            ->get();

        $brands = Brand::published()
            ->featured()
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'featured_products',
            'new_arrivals',
            'on_sale',
            'categories',
            'brands'
        ));
    }
}
