<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['product', 'customer']);

        // Standardized Table Logic (Handles Search, Filters, Sorting)
        // Note: product.name and customer.name are now supported by TableHelpers
        TableHelpers::applyTableLogic($query, $request,
            ['id', 'product.name', 'customer.name', 'comment'], // Searchable
            ['id', 'product.name', 'customer.name', 'star', 'status', 'created_at'] // Filterable
        );

        $reviews = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'            => 'ID',
            'product.name'  => 'Product Name',
            'customer.name' => 'User Name',
            'star'          => 'Rating',
            'status'        => 'Status',
            'created_at'    => 'Created At'
        ];

        return view('admin-layouts.reviews.index', compact('reviews', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:ec_products,id',
            'customer_id' => 'required|exists:ec_customers,id',
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'status' => 'required|in:published,pending',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->customer_id = $request->customer_id;
        $review->star = $request->star;
        $review->comment = $request->comment;
        $review->status = $request->status;

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('review_', $image);
                if ($upload['status']) {
                    $images[] = $upload['data']['target_file'];
                }
            }
        }
        $review->images = $images;

        $review->save();

        if ($request->input('submitter') === 'save-exit') {
            return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully');
        }

        return redirect()->route('admin.reviews.edit', $review->id)->with('success', 'Review created successfully');
    }

    public function show($id)
    {
        $review = Review::with(['product', 'customer'])->findOrFail($id);
        return view('admin-layouts.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::with(['product', 'customer'])->findOrFail($id);
        return view('admin-layouts.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'status' => 'required|in:published,pending',
            'product_id' => 'required|exists:ec_products,id',
            'customer_id' => 'required|exists:ec_customers,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $review = Review::findOrFail($id);
        $review->product_id = $request->product_id;
        $review->customer_id = $request->customer_id;
        $review->star = $request->star;
        $review->comment = $request->comment;
        $review->status = $request->status;

        $currentImages = $review->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('review_', $image);
                if ($upload['status']) {
                    $currentImages[] = $upload['data']['target_file'];
                }
            }
        }
        $review->images = $currentImages;

        $review->save();

        if ($request->input('submitter') === 'save-exit') {
            return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully');
        }

        return redirect()->back()->with('success', 'Review updated successfully');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $reply = new \App\Models\ReviewReply();
        $reply->review_id = $id;
        $reply->user_id = auth()->id();
        $reply->message = $request->message;
        $reply->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Your reply has been saved successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Reply saved successfully');
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Review::class, 'review');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Review::class, 'reviews');
    }
}
