<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SimpleSlider;
use App\Models\SimpleSliderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SimpleSliderItemController extends Controller
{
    public function create(Request $request)
    {
        $slider_id = $request->query('slider_id');
        $slider = SimpleSlider::findOrFail($slider_id);
        return view('admin-layouts.sliders.items.create', compact('slider'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'simple_slider_id' => 'required|exists:simple_sliders,id',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            SimpleSliderItem::create([
                'simple_slider_id' => $request->simple_slider_id,
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'image' => $request->image,
                'order' => $request->order ?? 0,
            ]);

            DB::commit();

            return redirect()->route('admin.simple-sliders.edit', $request->simple_slider_id)
                             ->with('success', 'Slider item created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $item = SimpleSliderItem::findOrFail($id);
        return view('admin-layouts.sliders.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'image' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        try {
            DB::beginTransaction();

            $item = SimpleSliderItem::findOrFail($id);
            $item->update([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'image' => $request->image,
                'order' => $request->order ?? 0,
            ]);

            DB::commit();

            return redirect()->route('admin.simple-sliders.edit', $item->simple_slider_id)
                             ->with('success', 'Slider item updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            $itemId = $request->id ?? $id;
            $item = SimpleSliderItem::findOrFail($itemId);
            $item->delete();
            DB::commit();

            if($request->ajax()){
                 return response()->json([
                    'status' => true,
                    'message' => 'Slider item deleted successfully.'
                ]);
            }
            return back()->with('success','Slider item deleted successfully.');
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
}
