<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecificationTable;

class SpecificationTableController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = SpecificationTable::query();

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $tables = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin.specification_tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.specification_tables.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        SpecificationTable::create($data);

        return redirect()->route('admin.spec.tables.index')->with('success', 'Specification table created.');
    }

    public function edit(SpecificationTable $table)
    {
        return view('admin.specification_tables.edit', compact('table'));
    }

    public function update(Request $request, SpecificationTable $table)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        $table->update($data);

        return redirect()->route('admin.spec.tables.index')->with('success', 'Specification table updated.');
    }

    public function destroy(SpecificationTable $table)
    {
        $table->delete();
        return redirect()->route('admin.spec.tables.index')->with('success', 'Specification table deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.spec.tables.index')->with('error', 'No items selected.');
        }

        SpecificationTable::whereIn('id', $ids)->delete();
        return redirect()->route('admin.spec.tables.index')->with('success', 'Selected tables deleted.');
    }
}
