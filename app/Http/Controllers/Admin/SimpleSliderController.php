<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimpleSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;

class SimpleSliderController extends Controller
{
    public function index(Request $request)
    {
        $query = SimpleSlider::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'key', 'description'],
            ['id', 'status', 'created_at']
        );

        $sliders = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'key' => 'Key',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.sliders.index', compact('sliders', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'key' => 'required|max:255|unique:simple_sliders,key',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $slider = SimpleSlider::create([
                'name' => $request->name,
                'key' => $request->key,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.simple-sliders.edit', $slider->id)
                             ->with('success', 'Slider created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $slider = SimpleSlider::with('sliderItems')->findOrFail($id);
        return view('admin-layouts.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'key' => 'required|max:255|unique:simple_sliders,key,' . $id,
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $slider = SimpleSlider::findOrFail($id);
            $slider->update([
                'name' => $request->name,
                'key' => $request->key,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            DB::commit();

            return redirect()->route('admin.simple-sliders.edit', $slider->id)
                             ->with('success', 'Slider updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, SimpleSlider::class, 'Slider');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, SimpleSlider::class, 'Sliders');
    }
}
