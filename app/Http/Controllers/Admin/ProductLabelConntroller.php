<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProductTag;
use Illuminate\Http\Request;

class ProductLabelConntroller extends Controller
{
    public function Index(Request $request)
    {
        $query = EcProductTag::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data['tags'] = $query->orderBy('id', 'desc')->get();
        return view('admin-layouts.product.lables.index', $data);
    }

    public function create()
    {
        return view('admin-layouts.product.lables.create');
    }
}
