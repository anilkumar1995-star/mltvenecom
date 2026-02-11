<?php

namespace App\Http\Controllers\Admin\ProductSpecification;

use App\Http\Controllers\Controller;
use App\Models\EcSpecificationAttribute;
use App\Models\EcSpecificationGroup;
use App\Models\EcSpecificationTable;
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
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $groups = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin-layouts.product-specification.group.index', compact('groups'));
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
        $group = EcSpecificationGroup::findOrFail($request->id);
        $group->delete();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Group deleted successfully'
            ]);
        }

        return redirect()->back()->with('success', 'Specification Group deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            EcSpecificationGroup::whereIn('id', $ids)->delete();
            return response()->json(['status' => true, 'message' => 'Selected items deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'No items selected']);
    }

    // --- Specification Attributes ---

    public function productIndex(Request $request)
    {
        $query = EcSpecificationAttribute::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $attributes = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin-layouts.product-specification.attributes.index', compact('attributes'));
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
        $attribute = EcSpecificationAttribute::findOrFail($request->id);
        $attribute->delete();

        if ($request->ajax()) {
            return response()->json([
                'status' => true,
                'message' => 'Specification Attribute deleted successfully'
            ]);
        }

        return redirect()->back()->with('success', 'Specification Attribute deleted successfully');
    }

    public function productAttributebulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            EcSpecificationAttribute::whereIn('id', $ids)->delete();
            return response()->json(['status' => true, 'message' => 'Selected items deleted successfully']);
        }
        return response()->json(['status' => false, 'message' => 'No items selected']);
    }

    // --- Specification Tables ---

    public function productTable()
    {
        $data['tables'] = EcSpecificationTable::with('groups')->orderBy('id', 'desc')->get();
        return view('admin-layouts.product-specification.tables.index', $data);
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function productTabledestroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $table = EcSpecificationTable::findOrFail($request->id);
            $table->groups()->detach();
            $table->delete();
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Specification Table deleted successfully'
                ]);
            }

            return redirect()->back()->with('success', 'Specification Table deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function productTablebulkDelete(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            DB::beginTransaction();
            try {
                $tables = EcSpecificationTable::whereIn('id', $ids)->get();
                foreach ($tables as $table) {
                    $table->groups()->detach();
                    $table->delete();
                }
                DB::commit();
                return response()->json(['status' => true, 'message' => 'Selected items deleted successfully']);
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['status' => false, 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
            }
        }
        return response()->json(['status' => false, 'message' => 'No items selected']);
    }
}