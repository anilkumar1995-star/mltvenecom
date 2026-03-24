<?php

namespace App\Http\Controllers\Admin\ProductSpecification;

use App\Http\Controllers\Controller;
use App\Models\EcSpecificationAttribute;
use App\Models\EcSpecificationGroup;
use App\Models\EcSpecificationTable;
use App\Helpers\TableHelpers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // --- Specification Groups ---

    public function index(Request $request)
    {
        $query = EcSpecificationGroup::query();

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'description'],
        ['id', 'created_at']
        );

        $groups = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product-specification.group.index', compact('groups', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.product-specification.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'nullable|max:400',
        ]);

        $group = EcSpecificationGroup::create([
            'name' => $request->name,
            'description' => $request->description,
            'author_type' => Auth::user()->name,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Group created successfully',
                'data' => $group
            ]);
        }

        return redirect()->route('admin.group.Index')->with('success', 'Specification Group created successfully');
    }

    public function Edit($id)
    {
        $group = EcSpecificationGroup::findOrFail($id);
        return view('admin-layouts.product-specification.group.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = EcSpecificationGroup::findOrFail($id);
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'nullable|max:400',
        ]);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Group updated successfully',
                'data' => $group
            ]);
        }

        return redirect()->route('admin.group.Index')->with('success', 'Specification Group updated successfully');
    }

    public function destroy(Request $request)
    {
        return TableHelpers::performDelete($request->id, EcSpecificationGroup::class , 'Specification Group');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcSpecificationGroup::class , 'Specification Groups');
    }

    // --- Specification Attributes ---

    public function productIndex(Request $request)
    {
        $query = EcSpecificationAttribute::query()->with('group');

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'type'],
        ['id', 'group_id', 'type', 'created_at']
        );

        $specAttributes = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'group_id' => 'Group ID',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product-specification.attributes.index', compact('specAttributes', 'filterColumns'));
    }

    public function productAttributeCreate()
    {
        $data['groups'] = EcSpecificationGroup::all();
        return view('admin-layouts.product-specification.attributes.create', $data);
    }

    public function productAttributeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'group_id' => 'required|exists:ec_specification_groups,id',
            'type' => 'required',
        ]);

        $attribute = EcSpecificationAttribute::create([
            'name' => $request->name,
            'group_id' => $request->group_id,
            'type' => $request->type,
            'options' => $request->options,
            'default_value' => $request->default_value,
            'author_type' => Auth::user()->name,
            'author_id' => Auth::id(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Attribute created successfully',
                'data' => $attribute
            ]);
        }

        return redirect()->route('admin.productattributes.Index')->with('success', 'Specification Attribute created successfully');
    }

    public function productAttributeEdit($id)
    {
        $attribute = EcSpecificationAttribute::findOrFail($id);
        $groups = EcSpecificationGroup::all();
        return view('admin-layouts.product-specification.attributes.edit', compact('attribute', 'groups'));
    }

    public function productAttributeupdate(Request $request, $id)
    {
        $attribute = EcSpecificationAttribute::findOrFail($id);
        $request->validate([
            'name' => 'required|max:191',
            'group_id' => 'required|exists:ec_specification_groups,id',
            'type' => 'required',
        ]);

        $attribute->update([
            'name' => $request->name,
            'group_id' => $request->group_id,
            'type' => $request->type,
            'options' => $request->options,
            'default_value' => $request->default_value,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Attribute updated successfully',
                'data' => $attribute
            ]);
        }

        return redirect()->route('admin.productattributes.Index')->with('success', 'Specification Attribute updated successfully');
    }

    public function productAttributedestroy(Request $request)
    {
        return TableHelpers::performDelete($request->id, EcSpecificationAttribute::class , 'Specification Attribute');
    }

    public function productAttributebulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcSpecificationAttribute::class , 'Specification Attributes');
    }


    public function productTable(Request $request)
    {
        $query = EcSpecificationTable::with('groups');

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'description'],
        ['id', 'created_at']
        );

        $tables = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.product-specification.tables.index', compact('tables', 'filterColumns'));
    }

    public function productTablecreate()
    {
        $data['groups'] = EcSpecificationGroup::orderBy('id', 'DESC')->get();
        return view('admin-layouts.product-specification.tables.create', $data);
    }



    public function productTablestore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'nullable|max:400',
            'group_ids' => 'required|array',
            'group_ids.*' => 'exists:ec_specification_groups,id',
        ]);

        DB::beginTransaction();
        try {
            $table = EcSpecificationTable::create([
                'name' => $request->name,
                'description' => $request->description,
                'author_type' => Auth::user()->name,
                'author_id' => Auth::id(),
            ]);

            $table->groups()->sync($request->group_ids);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Specification Table created successfully',
                    'data' => $table
                ]);
            }

            return redirect()->route('admin.producttable.Index')->with('success', 'Specification Table created successfully');
        }
        catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function productTableEdit($id)
    {
        $table = EcSpecificationTable::with('groups')->findOrFail($id);
        $groups = EcSpecificationGroup::all();
        $selectedGroupIds = $table->groups->pluck('id')->toArray();
        return view('admin-layouts.product-specification.tables.edit', compact('table', 'groups', 'selectedGroupIds'));
    }

    public function productTableupdate(Request $request, $id)
    {
        $table = EcSpecificationTable::findOrFail($id);
        $request->validate([
            'name' => 'required|max:191',
            'description' => 'nullable|max:400',
            'group_ids' => 'required|array',
            'group_ids.*' => 'exists:ec_specification_groups,id',
        ]);

        DB::beginTransaction();
        try {
            $table->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $table->groups()->sync($request->group_ids);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Specification Table updated successfully',
                    'data' => $table
                ]);
            }

            return redirect()->route('admin.producttable.Index')->with('success', 'Specification Table updated successfully');
        }
        catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function productTabledestroy(Request $request)
    {
        return TableHelpers::performDelete($request->id, EcSpecificationTable::class , 'Specification Table');
    }

    public function productTablebulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, EcSpecificationTable::class , 'Specification Tables');
    }
}
