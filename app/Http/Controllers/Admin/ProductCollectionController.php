<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCollection;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;

class ProductCollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductCollection::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'slug'], // Searchable
            ['id', 'name', 'status', 'is_featured', 'created_at'] // Filterable
        );

        $collections = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'          => 'ID',
            'name'        => 'Name',
            'status'      => 'Status',
            'is_featured' => 'Is Featured',
            'created_at'  => 'Created At',
        ];

        return view('admin-layouts.product.collections.index', compact('collections', 'filterColumns'));
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
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'image'       => $imagePath,
                'status'      => $request->status,
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
        $collection = ProductCollection::findOrFail($id);
        return view('admin-layouts.product.collections.edit', compact('collection'));
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
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'image'       => $imagePath,
                'status'      => $request->status,
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

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, ProductCollection::class, 'product collection');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, ProductCollection::class, 'product collections');
    }
}
