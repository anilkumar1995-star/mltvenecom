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
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $slider_id = $request->query('slider_id', $request->simple_slider_id);

            $data = $request->only([
                'title', 'subtitle', 'link', 'button_label', 'description', 
                'order', 'status', 'background_color'
            ]);
            $data['background_color_light'] = $request->has('background_color_light') ? 1 : 0;
            $data['simple_slider_id'] = $slider_id;

            // Handle uploads
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['image'] = 'uploads/sliders/' . $filename;
            }

            if ($request->hasFile('tablet_image')) {
                $file = $request->file('tablet_image');
                $filename = time() . '_tablet_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['tablet_image'] = 'uploads/sliders/' . $filename;
            }

            if ($request->hasFile('mobile_image')) {
                $file = $request->file('mobile_image');
                $filename = time() . '_mobile_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['mobile_image'] = 'uploads/sliders/' . $filename;
            }

            SimpleSliderItem::create($data);

            DB::commit();

            return redirect()->route('admin.simple-sliders.edit', $slider_id)
                             ->with('success', 'Slider item created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $item = SimpleSliderItem::findOrFail($id);
            
            $data = $request->only([
                'title', 'subtitle', 'link', 'button_label', 'description', 
                'order', 'status', 'background_color'
            ]);
            $data['background_color_light'] = $request->has('background_color_light') ? 1 : 0;

            // Handle uploads
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['image'] = 'uploads/sliders/' . $filename;
            }

            if ($request->hasFile('tablet_image')) {
                $file = $request->file('tablet_image');
                $filename = time() . '_tablet_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['tablet_image'] = 'uploads/sliders/' . $filename;
            }

            if ($request->hasFile('mobile_image')) {
                $file = $request->file('mobile_image');
                $filename = time() . '_mobile_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/sliders'), $filename);
                $data['mobile_image'] = 'uploads/sliders/' . $filename;
            }

            $item->update($data);

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
