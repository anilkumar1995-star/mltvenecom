<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use App\Models\EcBrand;
use App\Models\SimpleSlider;

class HomeController extends Controller
{
    public function index()
    {
        $home_slider = SimpleSlider::with(['sliderItems' => function($q) {
            $q->orderBy('order', 'asc');
        }])->where('key', 'home-slider')->where('status', 'published')->first();

        $featured_products = EcProduct::published()
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
            ->withCount('products')
            ->take(8)
            ->get();

        $EcBrands = EcBrand::published()
            ->featured()
            ->take(6)
            ->get();

        // All Products
        $all_products = EcProduct::published()
            ->with(['brand', 'categories'])
            ->latest()
            ->take(8)
            ->get();

        // Trending Products (Most Viewed)
        $trending_products = EcProduct::published()
            ->with(['brand', 'categories'])
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        // Top Rated Products (Best Reviews)
        $top_rated_products = EcProduct::published()
            ->with(['brand', 'categories'])
            ->orderBy('reviews_avg', 'desc')
            ->orderBy('reviews_count', 'desc')
            ->take(8)
            ->get();

        return view('frontend.home', compact(
            'home_slider',
            'featured_products',
            'new_arrivals',
            'on_sale',
            'categories',
            'EcBrands',
            'all_products',
            'trending_products',
            'top_rated_products'
        ));
    }
}
