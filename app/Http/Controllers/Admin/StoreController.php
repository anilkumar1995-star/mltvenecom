<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;



class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::query();

        if ($request->filled('q')) {
            $q = $request->get('q');
            $query->where('name', 'like', "%{$q}%");
        }

        $stores = $query->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin-layouts.marketplace.store.index', compact('stores'));
    }

    public function create()
    {
        $countries = Countries::where('status', 'published')
        ->orderBy('order')
        ->get();

    return view('admin-layouts.marketplace.store.create', compact('countries'));
    }

  
public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|max:191',
        'email'       => 'required|email|max:255',
        'phone'       => 'required|max:20',
        'status'      => 'required|in:published,draft,pending',
        'customer_id' => 'required|exists:ec_customers,id', 
    ]);

    $store = Store::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'phone'       => $request->phone,
        'address'     => $request->address,
        'country'     => $request->country,
        'state'       => $request->state,
        'city'        => $request->city,
        'company'     => $request->company,
        'tax_id'      => $request->tax_id,
        'description' => $request->description,
        'content'     => $request->content,
        'status'      => $request->status,
        'customer_id' => $request->customer_id,
        'logo'        => $request->logo,
        'logo_square' => $request->logo_square,
        'cover_image' => $request->cover_image,
    ]);

    return response()->json([
        'status'  => true,
        'message' => 'Store created successfully',
        'redirect_url' => route('admin.marketplace.store.index')
    ]);
}



   public function edit($id)
{
    $store = Store::findOrFail($id);
    $customers = \DB::table('ec_customers')->get();
// dd($customers,$store);
    return view('admin-layouts.marketplace.store.edit', compact('store', 'customers'));
}


       public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'customer_id' => 'required|exists:ec_customers,id',
            'status'      => 'required',
        ]);

        $store->update([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'description' => $request->description,
            'content'     => $request->content,
            'country'     => $request->country,
            'state'       => $request->state,
            'city'        => $request->city,
            'address'     => $request->address,
            'company'     => $request->company,
            'tax_id'      => $request->tax_id,
            'status'      => $request->status,
            'customer_id' => $request->customer_id,
            'logo'        => $request->logo,
            'logo_square' => $request->logo_square,
            'cover_image' => $request->cover_image,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Store updated successfully',
            'redirect_url' => route('admin.marketplace.store.index')
        ]);
    }

    public function show(Store $store)
    {
        $store->load('customer');
        $store->loadCount('products');
        return view('admin-layouts.marketplace.store.show', compact('store'));
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json([
            'status' => true,
            'message' => 'Store deleted successfully.'
        ]);
    }
}
