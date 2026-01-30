<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\EcProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
       $data['categories'] = EcProductCategory::with('children')
        ->whereNull('deleted_at')
        ->where('parent_id', 0)
        ->orderBy('id', 'desc')
        ->get();

        return view('admin-layouts.category.index',$data);
    }

    public function create(){
        $data['categories'] = EcProductCategory::where('parent_id','=','0')->orderBy('id','desc')->get();
        return view('admin-layouts.category.create',$data);
    }

    public function store(Request $post)
    {
        $rules = array([
            "name" => "required|string",
            "description" => "required|string",
            "status" => "required|in:Pending,Published"
        ]);

        $validator = Validator::make($post->all(),$rules);
        if($validator->fails()) return response()->json(['status' => false,'errors' => $validator->errors()]);

        $slug = Str::slug($post->name);

        $originalSlug = $slug;
        $counter = 1;

        while (EcProductCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        EcProductCategory::create([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id,
            "description" => $post->description,
            "status" => Auth::user()->id == 1 ? "Published" : "Pending",
            "slug" => $slug
        ]);

        return response()->json(['status' => true,'message' => "Record Created Successfully...!"]);
    }


    public function Edit(EcProductCategory $category){
        return view('admin-layouts.category.edit', compact('category'));
    }

    public function update(Request $post, EcProductCategory $category)
    {
        $rules = array([
            "name" => "required|string",
            "description" => "required|string",
            "status" => "required|in:Pending,Published"
        ]);

        $validator = Validator::make($post->all(),$rules);
        if($validator->fails()) return response()->json(['status' => false,'errors' => $validator->errors()]);


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
        $category->update([
            "name" => ucwords($post->name),
            "parent_id" => $post->parent_id,
            "description" => $post->description,
            "status" => Auth::user()->id == 1 ? "Published" : "Pending",
            "slug" => $slug
        ]);

        return response()->json(['status' => true,'message' => "Record Updated Successfully...!"]);
    }

    public function destroy(Request $post)
    {
        $rules = array([
            "id" => "required|exists:ec_product_categories,id",
        ]);

        $validator = Validator::make($post->all(),$rules);
        if($validator->fails()) return response()->json(['status' => false,'errors' => $validator->errors()]);

        $category = EcProductCategory::where('id',$post->id)->first();
        if(!$category) return response()->json(['status' => false,'message' => "Record Not Found"]);

        if($category->parent_id == null){
            $category->delete();
            return response()->json(['status' => true, 'message' => 'Category Successfully Deleted.']);
        }else{
            return response()->json(['status' => false,'message' => 'Category Has Child']);
        }
    }
}
