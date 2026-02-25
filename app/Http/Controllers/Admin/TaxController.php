<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        $query = Tax::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['taxes'] = $query->orderBy('priority')->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.taxes.index', $data);
    }

    public function create()
    {
        return view('admin-layouts.product.taxes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:191',
            'percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            Tax::create([
                'title' => $request->title,
                'percentage' => $request->percentage,
                'priority' => $request->priority ?? 0,
                'status' => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Tax created successfully.'
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
        $data['tax'] = Tax::findOrFail($id);
        return view('admin-layouts.product.taxes.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:191',
            'percentage' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:published,draft',
        ]);

        try {
            DB::beginTransaction();

            $tax = Tax::findOrFail($id);
            $tax->update([
                'title' => $request->title,
                'percentage' => $request->percentage,
                'priority' => $request->priority ?? 0,
                'status' => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Tax updated successfully.'
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
            $tax = Tax::findOrFail($request->id);
            $tax->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Tax deleted successfully.'
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
            Tax::whereIn('id', $request->ids)->delete();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Selected taxes deleted successfully.'
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
