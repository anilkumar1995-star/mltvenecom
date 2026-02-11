<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributeSet;
use App\Models\ProductAttribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductAttributeSetController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductAttributeSet::with('attributes');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['attributeSets'] = $query->orderBy('order')->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.attribute-sets.index', $data);
    }

    public function create()
    {
        return view('admin-layouts.product.attribute-sets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'status' => 'required|in:published,draft',
            'display_layout' => 'required|in:dropdown,swatch,text',
        ]);

        try {
            DB::beginTransaction();

            $set = ProductAttributeSet::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
                'order' => $request->order ?? 0,
                'display_layout' => $request->display_layout,
                'is_searchable' => $request->has('is_searchable') ? 1 : 0,
            ]);

            // Save attributes
            if ($request->has('attributes') && is_array($request->attributes)) {
                foreach ($request->attributes as $index => $attr) {
                    if (!empty($attr['title'])) {
                        ProductAttribute::create([
                            'attribute_set_id' => $set->id,
                            'title' => $attr['title'],
                            'slug' => Str::slug($attr['title']),
                            'color' => $attr['color'] ?? null,
                            'image' => $attr['image'] ?? null,
                            'is_default' => isset($attr['is_default']) ? 1 : 0,
                            'order' => $index,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product attribute set created successfully.'
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
        $data['attributeSet'] = ProductAttributeSet::with('attributes')->findOrFail($id);
        return view('admin-layouts.product.attribute-sets.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'status' => 'required|in:published,draft',
            'display_layout' => 'required|in:dropdown,swatch,text',
        ]);

        try {
            DB::beginTransaction();

            $set = ProductAttributeSet::findOrFail($id);
            $set->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'status' => $request->status,
                'order' => $request->order ?? 0,
                'display_layout' => $request->display_layout,
                'is_searchable' => $request->has('is_searchable') ? 1 : 0,
            ]);

            // Delete old and add new
            $set->attributes()->delete();

            if ($request->has('attributes') && is_array($request->attributes)) {
                foreach ($request->attributes as $index => $attr) {
                    if (!empty($attr['title'])) {
                        ProductAttribute::create([
                            'attribute_set_id' => $set->id,
                            'title' => $attr['title'],
                            'slug' => Str::slug($attr['title']),
                            'color' => $attr['color'] ?? null,
                            'image' => $attr['image'] ?? null,
                            'is_default' => isset($attr['is_default']) ? 1 : 0,
                            'order' => $index,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product attribute set updated successfully.'
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
            $set = ProductAttributeSet::findOrFail($request->id);
            $set->attributes()->delete();
            $set->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Product attribute set deleted successfully.'
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
            ProductAttribute::whereIn('attribute_set_id', $ids)->delete();
            ProductAttributeSet::whereIn('id', $ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected attribute sets deleted successfully.'
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
