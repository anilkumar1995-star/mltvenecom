<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;

class TaxController extends Controller
{
    public function index(Request $request)
    {
        $query = Tax::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'title', 'percentage'], // Searchable
            ['id', 'title', 'status', 'created_at'] // Filterable
        );

        $taxes = $query->orderBy('priority', 'asc')->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id'         => 'ID',
            'title'      => 'Title',
            'percentage' => 'Percentage',
            'status'     => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product.taxes.index', compact('taxes', 'filterColumns'));
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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tax created successfully.',
                    'redirect' => route('admin.taxes.index')
                ]);
            }

            return redirect()->route('admin.taxes.index')->with('success', 'Tax created successfully.');
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
        $tax = Tax::findOrFail($id);
        return view('admin-layouts.product.taxes.edit', compact('tax'));
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

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tax updated successfully.',
                    'redirect' => route('admin.taxes.index')
                ]);
            }

            return redirect()->route('admin.taxes.index')->with('success', 'Tax updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Tax::class, 'tax');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Tax::class, 'taxes');
    }
}
