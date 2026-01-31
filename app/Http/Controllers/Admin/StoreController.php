<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Stores;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Stores::query();

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $stores = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin-layouts.marketplace.store.index', compact('stores'));
    }

    public function create(){
        $data['categories'] = Category::whereNull('deleted_at')->where('status','!=','Pending')->orderBy('id','desc')->get();
        return view('admin-layouts.store.create',$data);
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
