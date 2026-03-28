<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the stores.
     */
    public function index(Request $request)
    {
        $query = Store::query()
            ->where('status', 'published')
            ->whereNotNull('slug')
            ->where('slug', '!=', '');

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->query('q') . '%');
        }

        $stores = $query->withCount('products')->paginate(12);

        return view('frontend.stores.index', compact('stores'));
    }

    /**
     * Display the specified store.
     */
    public function show(Request $request, $slug)
    {
        $store = Store::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $query = $store->products()->where('status', 'published');

        // Search within store
        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->query('q') . '%');
        }

        // Category filter
        if ($request->has('categories')) {
            $categoryIds = (array)$request->query('categories');
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('ec_product_categories.id', $categoryIds);
            });
        }

        // Sort
        switch ($request->query('sort-by')) {
            case 'date_asc':
                $query->orderBy('created_at', 'asc');
                break;
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
            default:
                $query->orderBy('created_at', 'desc');
        }

        $perPage = $request->query('per-page', 12);
        $products = $query->paginate($perPage);

        // Get categories that have products in this store
        $categories = \App\Models\EcProductCategory::whereHas('products', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })->get();

        return view('frontend.stores.show', compact('store', 'products', 'categories'));
    }
}
