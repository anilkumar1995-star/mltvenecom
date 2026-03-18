<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'],
            ['id', 'status', 'created_at']
        );

        $categories = $query->orderBy('order', 'asc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.blog.categories.index', compact('categories', 'filterColumns'));
    }

    public function edit(Category $category, Request $request)
    {
        // For blog categories, we usually edit on the list page or a separate page.
        // If the view handles it on the list page, we need the list as well.
        $query = Category::query();
        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'],
            ['id', 'status', 'created_at']
        );
        $categories = $query->orderBy('order', 'asc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.blog.categories.index', compact('categories', 'category', 'filterColumns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string|max:400',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft,pending',
        ]);

        $category = new Category($request->all());
        $category->is_featured = $request->has('is_featured') ? 1 : 0;
        $category->is_default = $request->has('is_default') ? 1 : 0;
        
        $category->author_type = 'Admin';
        if(auth()->check()){
            $category->author_id = auth()->id();
        }
        
        $category->parent_id = $request->parent_id ?? 0;

        $category->save();

        return redirect()->route('admin.blog.categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'parent_id' => 'nullable|integer',
            'description' => 'nullable|string|max:400',
            'icon' => 'nullable|string|max:255',
            'status' => 'required|in:published,draft,pending',
        ]);

        $category->fill($request->all());
        $category->is_featured = $request->has('is_featured') ? 1 : 0;
        $category->is_default = $request->has('is_default') ? 1 : 0;
        
        $category->parent_id = $request->parent_id ?? 0;

        $category->save();

        if ($request->has('save_and_exit')) {
             return redirect()->route('admin.blog.categories.index')->with('success', 'Category updated successfully.');
        }

        return redirect()->route('admin.blog.categories.edit', $category->id)->with('success', 'Category updated successfully.');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Category::class, 'blog categories');
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Category::class, 'blog category');
    }
}
