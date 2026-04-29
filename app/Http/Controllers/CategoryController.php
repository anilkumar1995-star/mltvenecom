<?php

namespace App\Http\Controllers;

use App\Models\EcProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Helpers\TableHelpers;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = EcProductCategory::with('children');

        // Allow searching/filtering across all categories
        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'],
            ['id', 'status', 'created_at']
        );

        // If no search/filter is applied, we usually want to show the tree view (where parent_id is 0)
        // But the user requested "same as others", which usually means a flat searchable table.
        // I will keep it flat for search results, but show top-level if no search.
        if (!$request->filled('search') && !$request->filled('filter_columns')) {
            $query->where('parent_id', 0);
        }

        $categories = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.category.index', compact('categories', 'filterColumns'));
    }

    public function create()
    {
        $data['categories'] = EcProductCategory::where('parent_id', '=', '0')->orderBy('id', 'desc')->get();
        return view('admin-layouts.category.create', $data);
    }

    public function store(Request $post)
    {
        $rules = [
            "name" => "required|string",
            "description" => "required|string",
            "status" => "required|in:Pending,Published",
            "image" => "nullable|image|max:2048",
            "icon_image" => "nullable|image|max:2048",
        ];

        $validator = Validator::make($post->all(), $rules);
        if ($validator->fails()) return response()->json(['status' => false, 'errors' => $validator->errors()]);

        $slug = Str::slug($post->name);
        $originalSlug = $slug;
        $counter = 1;

        while (EcProductCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $image = null;
        if ($post->hasFile('image')) {
            $res = \App\Helpers\ImageHelper::imageUploadHelper('category', $post->file('image'));
            if ($res['status']) $image = $res['data']['target_file'];
        }

        $icon_image = null;
        if ($post->hasFile('icon_image')) {
            $res = \App\Helpers\ImageHelper::imageUploadHelper('cat_icon', $post->file('icon_image'));
            if ($res['status']) $icon_image = $res['data']['target_file'];
        }
        
        $category = EcProductCategory::create([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id ?? 0,
            "description" => $post->description,
            "status" => Auth::user()->id == 1 ? "Published" : $post->status,
            "slug" => $slug,
            "image" => $image,
            "icon" => $post->icon,
            "icon_image" => $icon_image,
            "is_featured" => $post->is_featured ? 1 : 0
        ]);

        // Handle Sub Categories
        if ($post->has('sub_category_names')) {
            foreach ($post->sub_category_names as $name) {
                if (empty($name)) continue;
                
                EcProductCategory::create([
                    'name' => ucwords($name),
                    'parent_id' => $category->id,
                    'status' => $category->status,
                    'description' => $category->description,
                    'slug' => Str::slug($name) . '-' . rand(100, 999)
                ]);
            }
        }

        return response()->json(['status' => true, 'message' => "Record Created Successfully...!"]);
    }

    public function Edit(EcProductCategory $category)
    {
        $categories = EcProductCategory::where('parent_id', '=', '0')
            ->where('id', '!=', $category->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('admin-layouts.category.edit', compact('category', 'categories'));
    }

    public function update(Request $post, EcProductCategory $category)
    {
        $rules = [
            "name" => "required|string",
            "description" => "required|string",
            "status" => "required|in:Pending,Published",
            "image" => "nullable|image|max:2048",
            "icon_image" => "nullable|image|max:2048",
        ];

        $validator = Validator::make($post->all(), $rules);
        if ($validator->fails()) return response()->json(['status' => false, 'errors' => $validator->errors()]);

        if ($post->name !== $category->name) {
            $slug = Str::slug($post->name);
            $originalSlug = $slug;
            $counter = 1;

            while (EcProductCategory::where('slug', $slug)
                ->where('id', '!=', $category->id)
                ->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
        } else {
            $slug = $category->slug;
        }

        $image = $category->image;
        if ($post->hasFile('image')) {
            $res = \App\Helpers\ImageHelper::imageUploadHelper('category', $post->file('image'));
            if ($res['status']) $image = $res['data']['target_file'];
        }

        $icon_image = $category->icon_image;
        if ($post->hasFile('icon_image')) {
            $res = \App\Helpers\ImageHelper::imageUploadHelper('cat_icon', $post->file('icon_image'));
            if ($res['status']) $icon_image = $res['data']['target_file'];
        }
        
        $category->update([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id ?? 0,
            "description" => $post->description,
            "status" => Auth::user()->id == 1 ? "Published" : $post->status,
            "slug" => $slug,
            "image" => $image,
            "icon" => $post->icon,
            "icon_image" => $icon_image,
            "is_featured" => $post->is_featured ? 1 : 0
        ]);

        // Handle Sub Categories
        if ($post->has('sub_category_names')) {
            foreach ($post->sub_category_names as $index => $name) {
                if (empty($name)) continue;

                $subId = $post->sub_category_ids[$index] ?? null;
                $subData = [
                    'name' => ucwords($name),
                    'parent_id' => $category->id,
                    'status' => $category->status,
                    'description' => $category->description, // Or empty
                ];

                if ($subId) {
                    $subCat = EcProductCategory::find($subId);
                    if ($subCat) {
                        $subCat->update($subData);
                    }
                } else {
                    $subData['slug'] = Str::slug($name) . '-' . rand(100, 999);
                    EcProductCategory::create($subData);
                }
            }
        }

        // Handle Removals
        if ($post->has('remove_sub_category_ids')) {
            EcProductCategory::whereIn('id', $post->remove_sub_category_ids)->delete();
        }

        return response()->json(['status' => true, 'message' => "Record Updated Successfully...!"]);
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcProductCategory::class, 'categories');
    }

    public function destroy($idOrModel)
    {
        // For categories, we might want to check for children, but performDelete is generic.
        // Let's do a manual check if needed, or just follow the "same as others" (direct delete).
        // The original logic was complex and buggy. I'll use performDelete for consistency.
        return TableHelpers::performDelete($idOrModel, EcProductCategory::class, 'category');
    }
}
