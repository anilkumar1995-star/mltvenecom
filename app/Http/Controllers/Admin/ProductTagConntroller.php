<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProductTag;
use App\Models\EcProductTagTranslation;

use App\Helpers\TableHelpers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTagConntroller extends Controller
{
    public function destroy($id)
    {
        return TableHelpers::performDelete($id, EcProductTag::class);
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcProductTag::class);
    }
    public function Index(Request $request)
    {
        $query = EcProductTag::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'],
            ['id', 'status', 'created_at']
        );

        $tags = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.product-tags.index', compact('tags', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.product.product-tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120',
            'status' => 'required|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            EcProductTag::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product tag created successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function Edit($id)
    {
        $data['tag'] = EcProductTag::findOrFail($id);
        return view('admin-layouts.product.product-tags.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:120',
            'status' => 'required|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $tag = EcProductTag::findOrFail($id);
            $tag->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product tag updated successfully.'
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
