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
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->take(12)
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
