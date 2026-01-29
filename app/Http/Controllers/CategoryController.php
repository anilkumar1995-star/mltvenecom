<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::whereNull('deleted_at')->orderBy('id','desc')->get();
        return view('admin-layouts.category.index',$data);
    }

    public function create(){
        $data['categories'] = Category::whereNull('deleted_at')->where('parent_id','=','0')->orderBy('id','desc')->get();
        return view('admin-layouts.category.create',$data);
    }

    public function store(Request $post)
    {
        $post->validate([
            "name" => "required|string",
            "parent_id" => "required",
            "description" => "required|string",
            "status" => "required|in:Pending,Published"
        ]);

        Category::create([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id,
            "description" => $post->description,
            "status" => $post->status
        ]);

        return redirect()->route('admin.category.Index')->with('success', 'Category created.');
    }


    public function Edit(Category $category){
        return view('admin-layouts.category.edit', compact('category'));
    }

    public function update(Request $post, Category $category)
    {
        $post->validate([
            "name" => "required|string",
            "parent_id" => "required",
            "description" => "required|string",
            "status" => "required|in:Pending,Published"
        ]);

        $category->update([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id,
            "description" => $post->description,
            "status" => $post->status
        ]);

        return redirect()->route('admin.category.Index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category)
    {
        if($category->parent_id == null){
            $category->delete();
            return redirect()->route('admin.category.Index')->with('success', 'Category deleted.');
        }else{
            return redirect()->route('admin.category.Index')->with('Error', 'Category Has Child');
        }
    }
}
