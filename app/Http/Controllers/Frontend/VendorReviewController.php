<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorReviewController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        // Get reviews for products in this store
        $query = Review::whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->with(['product', 'customer']);

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'product.name'], // searchable
            ['id', 'star', 'status', 'created_at', 'product.name'] // filterable
        );

        $reviews = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'star' => 'Star Rating',
            'product.name' => 'Product Name',
            'status' => 'Status',
            'created_at' => 'Date'
        ];

        return view('frontend.vendor.reviews.index', compact('reviews', 'filterColumns'));
    }

    public function show(Review $review)
    {
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        if ($review->product->store_id != $store->id) {
            abort(403);
        }

        return view('frontend.vendor.reviews.show', compact('review'));
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        $user = Auth::guard('customer')->user();
        $store = Store::where('customer_id', $user->id)->first();

        Review::whereIn('id', $ids)
            ->whereHas('product', function($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->delete();

        return response()->json(['status' => true, 'message' => 'Reviews deleted successfully.']);
    }
}
