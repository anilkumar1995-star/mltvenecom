<?php

namespace App\Http\Controllers;

use App\Models\EcBrand;
use App\Models\EcProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;
use App\Helpers\ImageHelper;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = EcBrand::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'slug', 'description'], // searchable
            ['id', 'status', 'is_featured', 'created_at'] // filterable
        );

        $brands = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'is_featured' => 'Is Featured',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.brand.index', compact('brands', 'filterColumns'));
    }

    public function create()
    {
        $data['categories'] = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        return view('admin-layouts.brand.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:191',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft,pending',
            'order' => 'required|integer',
            'is_featured' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $data = $request->except(['logo', '_token', '_method']);
            $data['slug'] = Str::slug($request->name);

            $originalSlug = $data['slug'];
            $count = 1;
            while (EcBrand::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $count++;
            }

            if ($request->hasFile('logo')) {
                $upload = ImageHelper::imageUploadHelper('brand_', $request->file('logo'));
                if ($upload['status']) {
                    $data['logo'] = $upload['data']['target_file'];
                }
            }

            $brand = EcBrand::create($data);


            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Brand created successfully.',
                    'redirect_url' => route('admin.brand.Index')
                ]);
            }

            return redirect()->route('admin.brand.Index')->with('success', 'Brand created successfully.');

        } catch (Exception $e) {
            DB::rollback();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function Edit(EcBrand $brand)
    {
        $categories = EcProductCategory::where('status', '!=', 'Pending')->orderBy('id', 'desc')->get();
        return view('admin-layouts.brand.edit', compact('brand', 'categories'));
    }

    public function update(Request $request, EcBrand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'website' => 'nullable|url|max:191',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:published,draft,pending',
            'order' => 'required|integer',
            'is_featured' => 'required|boolean',
        ]);

        try {
            DB::beginTransaction();
            $data = $request->except(['logo', '_token', '_method']);

            if ($request->name != $brand->name) {
                $data['slug'] = Str::slug($request->name);
                $originalSlug = $data['slug'];
                $count = 1;
                while (EcBrand::where('slug', $data['slug'])->where('id', '!=', $brand->id)->exists()) {
                    $data['slug'] = $originalSlug . '-' . $count++;
                }
            }

            if ($request->hasFile('logo')) {
                $upload = ImageHelper::imageUploadHelper('brand_', $request->file('logo'));
                if ($upload['status']) {
                    $data['logo'] = $upload['data']['target_file'];
                }
            }

            $brand->update($data);



            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Brand updated successfully.',
                    'redirect_url' => route('admin.brand.Index')
                ]);
            }

            return redirect()->route('admin.brand.Index')->with('success', 'Brand updated successfully.');

        } catch (Exception $e) {
            DB::rollback();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, EcBrand::class, 'Brand');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcBrand::class, 'Brands');
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

            try {
                DB::beginTransaction();
                EcBrand::whereIn('id', $ids)->update([$column => $value]);
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Selected brands updated successfully.']);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => false, 'message' => 'Invalid data.'], 400);
    }
}
