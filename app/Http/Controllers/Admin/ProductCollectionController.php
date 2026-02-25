<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductCollection::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['collections'] = $query->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.collections.index', $data);
    }

    public function create()
    {
        return view('admin-layouts.product.collections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('collections', 'public');
            }

            ProductCollection::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'image' => $imagePath,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product collection created successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $data['collection'] = ProductCollection::findOrFail($id);
        return view('admin-layouts.product.collections.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $collection = ProductCollection::findOrFail($id);

            $imagePath = $collection->image;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('collections', 'public');
            }

            $collection->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'image' => $imagePath,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product collection updated successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $collection = ProductCollection::findOrFail($request->id);
            $collection->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product collection deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $ids = $request->ids;

            if (empty($ids)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No items selected.'
                ], 400);
            }

            ProductCollection::whereIn('id', $ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected collections deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }
}
