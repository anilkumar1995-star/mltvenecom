<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicAjaxController extends Controller
{
    // 🔎 AJAX Product Search
    public function ajaxSearchProducts(Request $request)
    {
        $keyword = $request->input('q');

        $products = Product::query()
            ->published() // Only show published products
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhere('sku', 'like', '%' . $keyword . '%')
                    ->orWhereHas('categories', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('brand', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('tags', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            })
            ->latest()
            ->take(15)
            ->get();

        return response()->json([
            'status' => true,
            'total' => $products->count(),
            'data' => $products
        ]);
    }

    // 📂 Categories Dropdown
    public function ajaxGetCategoriesDropdown()
    {
        $categories = Category::select('id', 'name')->get();

        return response()->json([
            'status' => true,
            'data' => $categories
        ]);
    }
}
