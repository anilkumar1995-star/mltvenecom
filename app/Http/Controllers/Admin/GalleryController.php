<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Helpers\TableHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'description'], // Searchable
            ['id', 'name', 'status', 'created_at'] // Filterable
        );

        $galleries = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'name'       => 'Name',
            'status'     => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.galleries.index', compact('galleries', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|string|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('gallery_', $request->file('image'));
                if ($upload['status']) {
                    $imagePath = $upload['data']['target_file'];
                } else {
                    return back()->with('error', 'Image upload failed: ' . $upload['message'])->withInput();
                }
            }

            Gallery::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'user_id' => auth()->id() ?? 1,
                'order' => $request->order ?? 0,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.galleries.index')->with('success', 'Gallery created successfully.');
            }

            return redirect()->back()->with('success', 'Gallery created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Gallery $gallery)
    {
        return view('admin-layouts.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|string|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = $gallery->image;
            if ($request->hasFile('image')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('gallery_', $request->file('image'));
                if ($upload['status']) {
                    $imagePath = $upload['data']['target_file'];
                } else {
                    return back()->with('error', 'Image upload failed: ' . $upload['message'])->withInput();
                }
            }

            $gallery->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured') ? 1 : 0,
                'order' => $request->order ?? 0,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.galleries.index')->with('success', 'Gallery updated successfully.');
            }

            return redirect()->back()->with('success', 'Gallery updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Gallery::class, 'gallery');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Gallery::class, 'galleries');
    }
}
