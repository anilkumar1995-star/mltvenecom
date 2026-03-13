<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimpleSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpleSliderController extends Controller
{
    public function index(Request $request)
    {
        $query = SimpleSlider::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('key', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['sliders'] = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin-layouts.sliders.index', $data);
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
        $data['slider'] = SimpleSlider::with('sliderItems')->findOrFail($id);
        return view('admin-layouts.sliders.edit', $data);
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

    public function destroy(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            $sliderId = $request->id ?? $id;
            $slider = SimpleSlider::findOrFail($sliderId);
            $slider->delete();
            DB::commit();

            if($request->ajax()){
                 return response()->json([
                    'status' => true,
                    'message' => 'Slider deleted successfully.'
                ]);
            }
            return back()->with('success','Slider deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            if($request->ajax()){
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
             return back()->with('error','Something went wrong: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
             'ids' => 'required|array',
             'ids.*' => 'exists:simple_sliders,id'
        ]);

        try {
            DB::beginTransaction();
            SimpleSlider::whereIn('id', $request->ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected sliders deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }
}
