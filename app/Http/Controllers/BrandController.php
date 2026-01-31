<?php

namespace App\Http\Controllers;

use App\Models\EcBrand;
use App\Models\EcProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = EcBrand::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('filter_columns')) {
            foreach ($request->filter_columns as $key => $column) {
                if (!empty($column) && isset($request->filter_values[$key]) && $request->filter_values[$key] !== '') {
                    $operator = $request->filter_operators[$key] ?? '=';
                    $value = $request->filter_values[$key];

                    if ($operator == 'like') {
                        $value = '%' . $value . '%';
                    }

                    $query->where($column, $operator, $value);
                }
            }
        }

        $data['categories'] = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        $data['brands'] = $query->orderBy('id', 'desc')->get();
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


    public function destroy(Request $post){
        $rules = array([
            "id" => "required|exists:ec_brands,id",
        ]);

        $validator = Validator::make($post->all(),$rules);
        if($validator->fails()) return response()->json(['status' => false,'errors' => $validator->errors()]);
        $brand = EcBrand::where('id',$post->id)->first();
        if(!$brand) return response()->json(['status' => false,'message' => "Record Not Found"]);

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


    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            DB::beginTransaction();
            try {
                $brands = EcBrand::whereIn('id', $ids)->get();
                foreach ($brands as $brand) {
                    if ($brand->logo && file_exists(public_path($brand->logo))) {
                        unlink(public_path($brand->logo));
                    }
                    $brand->categories()->detach();
                    $brand->delete();
                }
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Selected brands deleted successfully.']);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => false, 'message' => 'No brands selected.']);
    }

    public function bulkChange(Request $request)
    {
        $ids = $request->ids;
        $column = $request->column;
        $value = $request->value;

        if (!empty($ids) && !empty($column)) {
            if (!in_array($column, ['status', 'is_featured'])) {
                return response()->json(['status' => false, 'message' => 'Invalid column for bulk change.']);
            }

            DB::beginTransaction();
            try {
                EcBrand::whereIn('id', $ids)->update([$column => $value]);
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Selected brands updated successfully.']);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => false, 'message' => 'Invalid data.']);
    }
}
