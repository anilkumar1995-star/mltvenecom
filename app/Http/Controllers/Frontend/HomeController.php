<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use App\Models\EcBrand;

class HomeController extends Controller
{
    public function index()
    {
        $featured_EcProducts = EcProduct::published()
            ->featured()
            ->with(['brand', 'categories'])
            ->take(8)
            ->get();

        $new_arrivals = EcProduct::published()
            ->with(['brand', 'categories'])
            ->latest()
            ->take(8)
            ->get();

        $on_sale = EcProduct::published()
            ->onSale()
            ->with(['brand', 'categories'])
            ->take(8)
            ->get();

        $categories = EcProductCategory::published()
            ->parent()
            ->featured()
            ->take(8)
            ->get();

        $EcBrands = EcBrand::published()
            ->featured()
            ->take(6)
            ->get();

        return view('frontend.home', compact(
            'featured_EcProducts',
            'new_arrivals',
            'on_sale',
            'categories',
            'EcBrands'
        ));
    }
}
