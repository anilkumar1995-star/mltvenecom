<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcProduct as Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Review
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:ec_products,id',
            'star'       => 'required|integer|min:1|max:5',
            'comment'    => 'required|string',
            'images.*'   => 'image|max:2048'
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $imagePaths[] = $path;
            }
        }

        $customerId = Auth::guard('customer')->id() ?? Auth::id();
        
        $reviewData = [
            'star'    => $request->star,
            'comment' => $request->comment,
            'status'  => 'published',
        ];

        if (!empty($imagePaths)) {
            $reviewData['images'] = $imagePaths;
        }

        $review = \App\Models\Review::updateOrCreate(
            [
                'product_id'  => $request->product_id,
                'customer_id' => $customerId,
            ],
            $reviewData
        );

        $message = $review->wasRecentlyCreated ? 'Review added successfully.' : 'Review updated successfully.';

        // Update product reviews columns
        $product = Product::find($request->product_id);
        if ($product) {
            $product->reviews_count = $product->reviews()->count();
            $product->reviews_avg = $product->reviews()->avg('star');
            $product->save();
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Review
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return response()->json([
            'status' => true,
            'message' => 'Review deleted successfully.'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Product Reviews Page
    |--------------------------------------------------------------------------
    */
    public function getProductReview($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('frontend.product-review', compact('product'));
    }

    /*
    |--------------------------------------------------------------------------
    | Ajax Reviews
    |--------------------------------------------------------------------------
    */
    public function ajaxReviews($productId, Request $request)
    {
        $product = Product::findOrFail($productId);

        $query = Review::where('product_id', $product->id)
            ->where('status', 'published');

        if ($request->filled('star')) {
            $query->where('star', $request->star);
        }

        if ($request->filled('search')) {
            $query->where('comment', 'like', '%' . $request->search . '%');
        }

        if ($request->sort_by === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $reviews = $query->paginate(10);

        return response()->json([
            'status' => true,
            'html' => view('frontend.review-list', compact('reviews'))->render(),
            'total' => $reviews->total()
        ]);
    }
}
