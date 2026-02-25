<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductLabelConntroller extends Controller
{
    public function Index(Request $request)
    {
        $query = ProductLabel::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['labels'] = $query->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.lables.index', $data);
    }

    public function create()
    {
        return view('admin-layouts.product.lables.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:published,draft,pending',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $label = new ProductLabel();
        $label->name = $request->name;
        $label->color = $request->color;
        $label->text_color = $request->text_color;
        $label->status = $request->status;
        $label->save();

        return response()->json([
            'status' => true,
            'message' => 'Product label created successfully',
            'redirect' => route('admin.productlables.Index')
        ]);
    }

    public function edit($id)
    {
        $label = ProductLabel::findOrFail($id);
        return view('admin-layouts.product.lables.edit', compact('label'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:published,draft,pending',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $label = ProductLabel::findOrFail($id);
        $label->name = $request->name;
        $label->color = $request->color;
        $label->text_color = $request->text_color;
        $label->status = $request->status;
        $label->save();

        return response()->json([
            'status' => true,
            'message' => 'Product label updated successfully',
            'redirect' => route('admin.productlables.Index')
        ]);
    }

    public function destroy(Request $request)
    {
        $label = ProductLabel::findOrFail($request->id);
        $label->delete();

        return response()->json([
            'status' => true,
            'message' => 'Product label deleted successfully'
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        ProductLabel::whereIn('id', $ids)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Selected product labels deleted successfully'
        ]);
    }
}
