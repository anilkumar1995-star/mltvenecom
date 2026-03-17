<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcBrand;
use App\Models\EcProduct;
use App\Models\EcProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = EcProduct::published()
            ->with(['brand', 'categories']);

        // Filter by category
        if ($category_id = $request->get('category')) {
            $query->whereHas('categories', function ($q) use ($category_id) {
                $q->where('ec_product_categories.id', $category_id);
            });
        }

        $query = $this->applyFilters($query, $request);

        $products = $query->paginate(12)->appends($request->all());
        $categories = EcProductCategory::published()->parent()->with('children')->get();
        $brands = EcBrand::published()->get();

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = EcProduct::published()
            ->where(function ($query) use ($slug) {
                $query->where('slug', $slug);
                if (is_numeric($slug)) {
                    $query->orWhere('id', $slug);
                }
            })
            ->with(['brand', 'categories', 'reviews.customer', 'tags'])
            ->firstOrFail();

        // Increment views
        $product->increment('views');

        // Related products
        $related_products = EcProduct::published()
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($q) use ($product) {
                $q->whereIn('ec_product_categories.id', $product->categories->pluck('id'));
            })
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'related_products'));
    }

    public function category(Request $request, $slug)
    {
        $category = EcProductCategory::published()
            ->where('slug', $slug)
            ->with('children')
            ->firstOrFail();

        $allCategoryIds = $this->getAllCategoryIds($category);

        $query = EcProduct::published()
            ->whereHas('categories', function ($q) use ($allCategoryIds) {
                $q->whereIn('ec_product_categories.id', $allCategoryIds);
            })
            ->with(['brand', 'categories']);

        $query = $this->applyFilters($query, $request);

        $products = $query->paginate(12)->appends($request->all());

        $brandIds = EcProduct::published()
            ->whereHas('categories', function ($q) use ($allCategoryIds) {
                $q->whereIn('ec_product_categories.id', $allCategoryIds);
            })
            ->pluck('brand_id')
            ->unique()
            ->filter();
            
        $brands = EcBrand::whereIn('id', $brandIds)->get();

        $categories = EcProductCategory::published()->parent()->with('children')->get();

        // Dynamic price range
        $minPrice = EcProduct::published()
            ->whereHas('categories', function ($q) use ($allCategoryIds) {
                $q->whereIn('ec_product_categories.id', $allCategoryIds);
            })
            ->min('price') ?? 0;

        $maxPrice = EcProduct::published()
            ->whereHas('categories', function ($q) use ($allCategoryIds) {
                $q->whereIn('ec_product_categories.id', $allCategoryIds);
            })
            ->max('price') ?? 1000;

        return view('frontend.products.category', compact('category', 'products', 'brands', 'categories', 'minPrice', 'maxPrice'));
    }

    protected function applyFilters($query, Request $request)
    {
        // Search
        if ($search = $request->get('q') ?: $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by brand
        if ($brands = $request->get('brands')) {
            if (is_array($brands)) {
                $query->whereIn('brand_id', $brands);
            } else {
                $query->where('brand_id', $brands);
            }
        } elseif ($brand_id = $request->get('brand')) {
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
        $sort = $request->get('sort-by') ?: $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'rating_asc':
                // Assuming you have a way to sort by rating, if not default to latest
                // For now just latest as placeholder if ratings table not joined
                $query->latest();
                break;
            case 'rating_desc':
                $query->latest();
                break;
            default:
                $query->latest();
        }

        return $query;
    }

    protected function getAllCategoryIds($category)
    {
        $ids = [$category->id];
        foreach ($category->children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }
        return $ids;
    }

    public function brand($slug)
    {
        $brand = EcBrand::published()
            ->where(function ($query) use ($slug) {
                $query->where('slug', $slug);
                if (is_numeric($slug)) {
                    $query->orWhere('id', $slug);
                }
            })
            ->firstOrFail();

        $products = EcProduct::published()
            ->where('brand_id', $brand->id)
            ->with(['brand', 'categories'])
            ->paginate(12);

        return view('frontend.products.brand', compact('brand', 'products'));
    }
}
