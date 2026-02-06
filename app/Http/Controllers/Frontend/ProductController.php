<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::published()
            ->inStock()
            ->with(['brand', 'categories']);

        // Search
        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by category
        if ($category_id = $request->get('category')) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('ec_product_categories.id', $category_id);
            });
        }

        // Filter by brand
        if ($brand_id = $request->get('brand')) {
            $query->where('brand_id', $brand_id);
        }

        // Price range
        if ($min_price = $request->get('min_price')) {
            $query->where('price', '>=', $min_price);
        }
        if ($max_price = $request->get('max_price')) {
            $query->where('price', '<=', $max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->latest();
        }

        $products = $query->paginate(12);
        $categories = ProductCategory::published()->parent()->get();
        $brands = Brand::published()->get();

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::published()
            ->where('slug', $slug)
            ->with(['brand', 'categories', 'reviews.customer', 'tags'])
            ->firstOrFail();
        // dd($product);

        // Increment views
        $product->increment('views');

        // Related products
        $related_products = Product::published()
            ->inStock()
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('ec_product_categories.id', $product->categories->pluck('id'));
            })
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'related_products'));
    }

    public function category($slug)
    {
        $category = ProductCategory::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $products = Product::published()
            ->inStock()
            ->whereHas('categories', function ($q) use ($category) {
                $q->where('ec_product_categories.id', $category->id);
            })
            ->with(['brand', 'categories'])
            ->paginate(12);

        return view('frontend.products.category', compact('category', 'products'));
    }

    public function brand($slug)
    {
        $brand = Brand::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $products = Product::published()
            ->inStock()
            ->where('brand_id', $brand->id)
            ->with(['brand', 'categories'])
            ->paginate(12);

        return view('frontend.products.brand', compact('brand', 'products'));
    }
}
