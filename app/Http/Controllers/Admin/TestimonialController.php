<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Helpers\TableHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimonial::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'company', 'content'], // Searchable
            ['id', 'name', 'status', 'created_at'] // Filterable
        );

        $testimonials = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'name'       => 'Name',
            'company'    => 'Company',
            'status'     => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.testimonials.index', compact('testimonials', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'required|string',
            'company' => 'nullable|string|max:120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|string|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('testimonial_', $request->file('image'));
                if ($upload['status']) {
                    $imagePath = $upload['data']['target_file'];
                } else {
                    return back()->with('error', 'Image upload failed: ' . $upload['message'])->withInput();
                }
            }

            Testimonial::create([
                'name' => $request->name,
                'content' => $request->content,
                'company' => $request->company,
                'image' => $imagePath,
                'status' => $request->status,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
            }
            return redirect()->back()->with('success', 'Testimonial created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin-layouts.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:120',
            'content' => 'required|string',
            'company' => 'nullable|string|max:120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|string|in:published,draft,pending',
        ]);

        try {
            DB::beginTransaction();

            $imagePath = $testimonial->image;
            if ($request->hasFile('image')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('testimonial_', $request->file('image'));
                if ($upload['status']) {
                    $imagePath = $upload['data']['target_file'];
                } else {
                    return back()->with('error', 'Image upload failed: ' . $upload['message'])->withInput();
                }
            }

            $testimonial->update([
                'name' => $request->name,
                'content' => $request->content,
                'company' => $request->company,
                'image' => $imagePath,
                'status' => $request->status,
            ]);

            DB::commit();

            if ($request->has('save_and_exit')) {
                return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
            }
            return redirect()->back()->with('success', 'Testimonial updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Testimonial::class, 'testimonial');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Testimonial::class, 'testimonials');
    }
}
