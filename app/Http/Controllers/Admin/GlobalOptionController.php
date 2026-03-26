<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalOption;
use App\Models\GlobalOptionValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalOptionController extends Controller
{
    public function index(Request $request)
    {
        $query = GlobalOption::with('values');

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $options = $query->orderBy('id', 'desc')->paginate(15);

        $filterColumns = [
            'name'       => 'Name',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.global-options.index', compact('options', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.product.global-options.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'option_type' => 'required|in:dropdown,checkbox,radio,text',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $option = GlobalOption::create([
                'name' => $request->name,
                'option_type' => $request->option_type,
                'required' => $request->has('required') ? 1 : 0,
                'status' => $request->status,
            ]);

            // Save option values
            if ($request->has('option_values') && is_array($request->option_values)) {
                foreach ($request->option_values as $index => $value) {
                    if (!empty($value['option_value'])) {
                        GlobalOptionValue::create([
                            'option_id' => $option->id,
                            'option_value' => $value['option_value'],
                            'affect_price' => $value['affect_price'] ?? 0,
                            'affect_type' => $value['affect_type'] ?? 'fixed',
                            'order' => $index,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Global option created successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $data['option'] = GlobalOption::with('values')->findOrFail($id);
        return view('admin-layouts.product.global-options.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191',
            'option_type' => 'required|in:dropdown,checkbox,radio,text',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $option = GlobalOption::findOrFail($id);
            $option->update([
                'name' => $request->name,
                'option_type' => $request->option_type,
                'required' => $request->has('required') ? 1 : 0,
                'status' => $request->status,
            ]);

            // Delete old values and add new ones
            $option->values()->delete();

            if ($request->has('option_values') && is_array($request->option_values)) {
                foreach ($request->option_values as $index => $value) {
                    if (!empty($value['option_value'])) {
                        GlobalOptionValue::create([
                            'option_id' => $option->id,
                            'option_value' => $value['option_value'],
                            'affect_price' => $value['affect_price'] ?? 0,
                            'affect_type' => $value['affect_type'] ?? 'fixed',
                            'order' => $index,
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Global option updated successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            $option = GlobalOption::findOrFail($request->id);
            $option->values()->delete();
            $option->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Global option deleted successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();
            $ids = $request->ids;

            if (empty($ids)) {
                return response()->json([
                    'status' => false,
                    'message' => 'No items selected.'
                ], 400);
            }

            GlobalOptionValue::whereIn('option_id', $ids)->delete();
            GlobalOption::whereIn('id', $ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected global options deleted successfully.'
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
