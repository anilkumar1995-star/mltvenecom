<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecificationGroup;

class SpecificationGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = SpecificationGroup::query();

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $groups = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin.specification_groups.index', compact('groups'));
    }

    public function create()
    {
        return view('admin.specification_groups.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        SpecificationGroup::create($data);

        return redirect()->route('admin.spec.groups.index')->with('success', 'Specification group created.');
    }

    public function edit(SpecificationGroup $group)
    {
        return view('admin.specification_groups.edit', compact('group'));
    }

    public function update(Request $request, SpecificationGroup $group)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        $group->update($data);

        return redirect()->route('admin.spec.groups.index')->with('success', 'Specification group updated.');
    }

    public function destroy(SpecificationGroup $group)
    {
        $group->delete();
        return redirect()->route('admin.spec.groups.index')->with('success', 'Specification group deleted.');
    }

    /**
     * Bulk delete groups by ids
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.spec.groups.index')->with('error', 'No items selected.');
        }

        SpecificationGroup::whereIn('id', $ids)->delete();
        return redirect()->route('admin.spec.groups.index')->with('success', 'Selected groups deleted.');
    }
}
