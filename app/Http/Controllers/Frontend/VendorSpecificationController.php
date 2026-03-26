<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcSpecificationAttribute;
use App\Models\EcSpecificationGroup;
use App\Models\EcSpecificationTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\TableHelpers;

class VendorSpecificationController extends Controller
{
    public function groupsIndex(Request $request)
    {
        $query = EcSpecificationGroup::query();
        
        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name'], // searchable
            ['id', 'name', 'created_at'] // filterable
        );

        $groups = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        $filterColumns = ['id' => 'ID', 'name' => 'Name', 'created_at' => 'Date'];

        return view('frontend.vendor.specifications.groups.index', compact('groups', 'filterColumns'));
    }

    public function tablesIndex(Request $request)
    {
        $query = EcSpecificationTable::query();
        
        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'name'], // searchable
            ['id', 'name', 'created_at'] // filterable
        );

        $tables = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));
        $filterColumns = ['id' => 'ID', 'name' => 'Name', 'created_at' => 'Date'];

        return view('frontend.vendor.specifications.tables.index', compact('tables', 'filterColumns'));
    }
}
