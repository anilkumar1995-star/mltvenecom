<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecificationAttribute;
use App\Models\SpecificationGroup;

class SpecificationAttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = SpecificationAttribute::with('group');

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $attributes = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin.specification_attributes.index', compact('attributes'));
    }

    public function create()
    {
        $groups = SpecificationGroup::orderBy('name')->get();
        return view('admin.specification_attributes.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'group_id' => 'required|integer|exists:ec_specification_groups,id',
            'field_type' => 'nullable|in:text,select,number,date,checkbox',
            'description' => 'nullable|string',
        ]);

        SpecificationAttribute::create($data);

        return redirect()->route('admin.spec.attributes.index')->with('success', 'Specification attribute created.');
    }

    public function edit(SpecificationAttribute $attribute)
    {
        $groups = SpecificationGroup::orderBy('name')->get();
        return view('admin.specification_attributes.edit', compact('attribute', 'groups'));
    }

    public function update(Request $request, SpecificationAttribute $attribute)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'group_id' => 'required|integer|exists:ec_specification_groups,id',
            'field_type' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $attribute->update($data);

        return redirect()->route('admin.spec.attributes.index')->with('success', 'Specification attribute updated.');
    }

    public function destroy(SpecificationAttribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.spec.attributes.index')->with('success', 'Specification attribute deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return redirect()->route('admin.spec.attributes.index')->with('error', 'No items selected.');
        }

        SpecificationAttribute::whereIn('id', $ids)->delete();
        return redirect()->route('admin.spec.attributes.index')->with('success', 'Selected attributes deleted.');
    }
}
