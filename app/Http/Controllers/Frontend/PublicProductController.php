<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::published()->with(['brand', 'categories']);

        // Search
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('sku', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('categories', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Sorting
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = ProductCategory::published()->parent()->get();
        $brands = \App\Models\Brand::published()->take(10)->get();

        if ($request->ajax()) {
            return view('frontend.products.partials.product_list', compact('products'))->render();
        }

        return view('frontend.products.index', compact('products', 'categories', 'brands'));
    }

    public function show($slug)
    {
        $product = Product::published()
            ->where('slug', $slug)
            ->with(['brand', 'categories', 'reviews.user', 'tags'])
            ->firstOrFail();

        $related_products = Product::published()
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function($q) use ($product) {
                $q->whereIn('id', $product->categories->pluck('id'));
            })
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'related_products'));
    }

    public function getProductVariation(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $attributes = $request->input('attributes', []);

        // Logic to find specific variation based on attributes
        // This assumes a standard variation structure. Adjust if your DB schema is complex.

        $variation = ProductVariation::where('configurable_product_id', $id)
            ->whereHas('productAttributes', function($q) use ($attributes) {
                // This part requires complex matching depending on how attributes are stored
                // For simplicity, we might just return the main product or simple logic here
            })
            ->first();

        // If your system uses a simpler variation tracking, implement it here.
        // For now, returning success for the base structure.

        return response()->json([
            'success' => true,
            'data' => $variation ?? null
        ]);
    }

    public function getOrderTracking(Request $request)
    {
        $order = null;

        if ($request->isMethod('post') && $request->filled('order_id')) {
            $request->validate([
                'order_id' => 'required|string',
                'email' => 'required_without:phone|email|nullable',
                'phone' => 'required_without:email|string|nullable',
            ]);

            $query = Order::where(function($q) use ($request) {
                $q->where('code', $request->order_id)
                  ->orWhere('code', '#' . $request->order_id);
            });

            if ($request->filled('email')) {
                $query->whereHas('address', function($q) use ($request) {
                    $q->where('email', $request->email);
                });
            }

            if ($request->filled('phone')) {
                $query->whereHas('address', function($q) use ($request) {
                    $q->where('phone', $request->phone);
                });
            }

            $order = $query->with(['products', 'address'])->first();
        }

        return view('frontend.order-tracking', compact('order'));
    }
}
