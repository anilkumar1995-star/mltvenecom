<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttributeSet;
use App\Models\ProductAttribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;

class ProductAttributeSetController extends Controller
{
    public function index(Request $request)
    {
        $query = ProductAttributeSet::with('attributes');

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'title', 'slug'], // Searchable
            ['id', 'title', 'status', 'created_at'] // Filterable
        );

        $attributeSets = $query->orderBy('order')->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'title'      => 'Name',
            'status'     => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.attribute-sets.index', compact('attributeSets', 'filterColumns'));
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
                            'title'           => $attr['title'],
                            'slug'            => Str::slug($attr['title']),
                            'color'           => $attr['color'] ?? null,
                            'image'           => $attr['image'] ?? null,
                            'is_default'      => isset($attr['is_default']) ? 1 : 0,
                            'order'           => $index,
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
        $attributeSet = ProductAttributeSet::with('attributes')->findOrFail($id);
        return view('admin-layouts.product.attribute-sets.edit', compact('attributeSet'));
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
                            'title'           => $attr['title'],
                            'slug'            => Str::slug($attr['title']),
                            'color'           => $attr['color'] ?? null,
                            'image'           => $attr['image'] ?? null,
                            'is_default'      => isset($attr['is_default']) ? 1 : 0,
                            'order'           => $index,
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

    public function destroy($id)
    {
        $set = ProductAttributeSet::findOrFail($id);
        $set->attributes()->delete();
        return TableHelpers::performDelete($set, ProductAttributeSet::class, 'attribute set');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            ProductAttribute::whereIn('attribute_set_id', $ids)->delete();
        }
        return TableHelpers::performBulkDelete($request, ProductAttributeSet::class, 'attribute sets');
    }
}
