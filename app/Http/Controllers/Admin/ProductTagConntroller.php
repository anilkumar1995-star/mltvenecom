<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProductTag;
use App\Models\EcProductTagTranslation;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTagConntroller extends Controller
{
    public function Index(Request $request)
    {
        $query = EcProductTag::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['tags'] = $query->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.product-tags.index', $data);
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

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();

            $id = $request->id;
            DB::table('ec_product_tag_products')->where('tag_id', $id)->delete();
            $tag = EcProductTag::findOrFail($id);
            $tag->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product tag deleted successfully.'
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
            DB::table('ec_product_tag_products')->whereIn('tag_id', $ids)->delete();
            EcProductTag::whereIn('id', $ids)->delete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected product tags deleted successfully.'
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
