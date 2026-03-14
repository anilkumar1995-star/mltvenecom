<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        // Return view with categories for the list and an empty form for create
        return view('admin-layouts.blog.categories.index', compact('categories'));
    }

    public function edit(Category $category)
    {
        $categories = Category::orderBy('order', 'asc')->get();
        // Return same view but with the specific category selected for editing
        return view('admin-layouts.blog.categories.index', compact('categories', 'category'));
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
        
        if(!$request->parent_id) {
            $category->parent_id = 0;
        }

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
        
        if(!$request->parent_id) {
            $category->parent_id = 0;
        }

        $category->save();

        if ($request->has('save_and_exit')) {
             return redirect()->route('admin.blog.categories.index')->with('success', 'Category updated successfully.');
        }

        return redirect()->route('admin.blog.categories.edit', $category->id)->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if there are child categories
        if(Category::where('parent_id', $category->id)->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Cannot delete, category has sub-categories.']);
        }

        $category->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }
}
