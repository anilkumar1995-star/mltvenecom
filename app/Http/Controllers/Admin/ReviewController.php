<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['product', 'customer']);

        if ($request->has('filter_columns') && $request->has('filter_values') && $request->has('filter_operators')) {
            $columns = $request->filter_columns;
            $values = $request->filter_values;
            $operators = $request->filter_operators;

            foreach ($columns as $key => $column) {
                if (!empty($column) && isset($values[$key]) && isset($operators[$key])) {
                    $operator = $operators[$key];
                    $value = $values[$key];

                    if ($operator === 'like') {
                        $value = '%' . $value . '%';
                    }

                    if ($column === 'product') {
                         $query->whereHas('product', function($q) use ($operator, $value) {
                             $q->where('name', $operator, $value);
                         });
                    } elseif ($column === 'customer') {
                         $query->whereHas('customer', function($q) use ($operator, $value) {
                             $q->where('name', $operator, $value);
                         });
                    } else {
                         $query->where($column, $operator, $value);
                    }
                }
            }
        }

        if ($request->has('sort_by') && $request->has('sort_order')) {
            $query->orderBy($request->sort_by, $request->sort_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $reviews = $query->paginate(20);
        return view('admin-layouts.reviews.index', compact('reviews'));
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
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/reviews'), $imageName);
                $images[] = $imageName;
            }
        }
        $review->images = $images;

        $review->save();

        if ($request->input('submitter') === 'save-exit') {
             return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully');
        }

        return redirect()->route('admin.reviews.edit', $review->id)->with('success', 'Review created successfully');
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
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/reviews'), $imageName);
                $currentImages[] = $imageName;
            }
        }
        $review->images = $currentImages;

        $review->save();

        if ($request->input('submitter') === 'save-exit') {
            return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully');
        }

        return redirect()->back()->with('success', 'Review updated successfully');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return redirect()->back()->with('error', 'No reviews selected');
        }

        $ids = explode(',', $ids);
        Review::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Selected reviews deleted successfully');
    }
}
