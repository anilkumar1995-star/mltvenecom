<?php

namespace App\Http\Controllers;

use App\Models\EcProductCategory;
use App\Models\EcBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
     public function index(){
        $data['categories'] = EcProductCategory::where('status','!=','Pending')->orderBy('id','desc')->get();
        $data['brands'] = EcBrand::orderBy('id','desc')->get();
        return view('admin-layouts.brand.index',$data);
    }

    public function create(){
        $data['categories'] = EcProductCategory::where('status','!=','Pending')->orderBy('id','desc')->get();
        return view('admin-layouts.brand.create',$data);
    }

    // public function store(Request $post)
    // {
    //     $post->validate([
    //         "name" => "required|string",
    //         "parent_id" => "required",
    //         "description" => "required|string",
    //         "status" => "required|in:Pending,Published"
    //     ]);

    //     Category::create([
    //         "name" => ucwords($post->name),
    //         "parent_id" => $post->parent_id,
    //         "description" => $post->description,
    //         "status" => $post->status
    //     ]);

    //     return redirect()->route('admin.category.Index')->with('success', 'Category created.');
    // }


    // public function Edit(Category $category){
    //     return view('admin-layouts.category.edit', compact('category'));
    // }

    // public function update(Request $post, Category $category)
    // {
    //     $post->validate([
    //         "name" => "required|string",
    //         "parent_id" => "required",
    //         "description" => "required|string",
    //         "status" => "required|in:Pending,Published"
    //     ]);

    //     $category->update([
    //         "name" => ucwords($post->name),
    //         "parent_id" => $post->parent_id,
    //         "description" => $post->description,
    //         "status" => $post->status
    //     ]);

    //     return redirect()->route('admin.category.Index')->with('success', 'Category updated.');
    // }

    // public function destroy(Category $category)
    // {
    //     if($category->parent_id == null){
    //         $category->delete();
    //         return redirect()->route('admin.category.Index')->with('success', 'Category deleted.');
    //     }else{
    //         return redirect()->route('admin.category.Index')->with('Error', 'Category Has Child');
    //     }
    // }
}
