<?php

namespace App\Http\Controllers;

use App\Models\EcBrand;
use App\Models\EcProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function index()
    {
        $data['categories'] = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        $data['brands'] = EcBrand::orderBy('id', 'desc')->get();
        return view('admin-layouts.brand.index', $data);
    }

    public function create()
    {
        $data['categories'] = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        return view('admin-layouts.brand.create', $data);
    }

    public function store(Request $post)
    {
        $post->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:191',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft,pending',
            'order' => 'required|integer',
            'is_featured' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try{
            $data = $post->all();
            $data['slug'] = \Illuminate\Support\Str::slug($post->name);

            $originalSlug = $data['slug'];
            $count = 1;
            while (EcBrand::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $count++;
            }

            if ($post->hasFile('logo')) {
                $imageName = time() . '.' . $post->logo->extension();
                $post->logo->move(public_path('uploads/brands'), $imageName);
                $data['logo'] = 'uploads/brands/' . $imageName;
            }

            $brand = EcBrand::create($data);

            if ($post->has('categories')) {
                $brand->categories()->sync($post->categories);
            }
            DB::commit();
            return response()->json(['status' => true, 'message' => 'Brand created successfully.']);

        }catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => false,'message' => $e->getMessage(),'line' => $e->getLine()]);
        }
    }

    public function Edit(EcBrand $brand)
    {
        $categories = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        return view('admin-layouts.brand.edit', compact('brand', 'categories'));
    }

    public function update(Request $post, EcBrand $brand)
    {
        $post->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:191',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft,pending',
            'order' => 'required|integer',
            'is_featured' => 'required|boolean',
        ]);

        DB::beginTransaction();
            try{
            $data = $post->all();

            if ($post->name != $brand->name) {
                $data['slug'] = \Illuminate\Support\Str::slug($post->name);
                $originalSlug = $data['slug'];
                $count = 1;
                while (EcBrand::where('slug', $data['slug'])->where('id', '!=', $brand->id)->exists()) {
                    $data['slug'] = $originalSlug . '-' . $count++;
                }
            }

            if ($post->hasFile('logo')) {
                // Delete old logo if exists
                if ($brand->logo && file_exists(public_path($brand->logo))) {
                    unlink(public_path($brand->logo));
                }
                $imageName = time() . '.' . $post->logo->extension();
                $post->logo->move(public_path('uploads/brands'), $imageName);
                $data['logo'] = 'uploads/brands/' . $imageName;
            }

            $brand->update($data);

            if ($post->has('categories')) {
                $brand->categories()->sync($post->categories);
            } else {
                $brand->categories()->detach();
            }

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Brand updated successfully.']);

        }catch(Exception $e){
            DB::rollback();
            return response()->json(['status' => false,'message' => $e->getMessage(),'line' => $e->getLine()]);
        }
    }

    public function destroy(EcBrand $brand)
    {
        DB::beginTransaction();
        try {
            if ($brand->logo && file_exists(public_path($brand->logo))) {
                unlink(public_path($brand->logo));
            }

            $brand->categories()->detach();

            $brand->delete();

            DB::commit();
            return response()->json(['status' => true, 'message' => 'Brand deleted successfully.']);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false, 'message' => $e->getMessage(), 'line' => $e->getLine()]);
        }
    }
}
