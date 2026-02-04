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

        $stores = $query->with('customer')->orderBy('id', 'desc')->paginate(20)->withQueryString();
        return view('admin-layouts.marketplace.store.index', compact('stores'));
    }

    public function create()
    {
        $countries = Countries::where('status', 'published')
            ->orderBy('order')
            ->get();
        $customers = \DB::table('ec_customers')->get();

        return view('admin-layouts.marketplace.store.create', compact('countries', 'customers'));
    }

  
public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|max:191',
        'slug'        => 'required|max:191|unique:mp_stores,slug',
        'email'       => 'required|email|max:255',
        'phone'       => 'required|max:20',
        'status'      => 'required|in:published,draft,pending',
        'customer_id' => 'required|exists:ec_customers,id',
        'logo'        => 'nullable|image|max:2048',
        'logo_square' => 'nullable|image|max:2048',
        'cover_image' => 'nullable|image|max:2048',
    ]);

    $data = [
        'name'        => $request->name,
        'slug'        => $request->slug,
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
        'social_links' => $request->social_links,
        'seo_title'   => $request->input('seo_meta.seo_title'),
        'seo_description' => $request->input('seo_meta.seo_description'),
        'seo_index'   => $request->input('seo_meta.index', 'index'),
    ];

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('stores', 'public');
        $data['logo'] = 'storage/' . $path;
    } elseif ($request->logo) {
        $data['logo'] = $request->logo;
    }

    if ($request->hasFile('logo_square')) {
        $path = $request->file('logo_square')->store('stores', 'public');
        $data['logo_square'] = 'storage/' . $path;
    } elseif ($request->logo_square) {
        $data['logo_square'] = $request->logo_square;
    }

    if ($request->hasFile('cover_image')) {
        $path = $request->file('cover_image')->store('stores', 'public');
        $data['cover_image'] = 'storage/' . $path;
    } elseif ($request->cover_image) {
        $data['cover_image'] = $request->cover_image;
    }

    $store = Store::create($data);

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
    $countries = Countries::where('status', 'published')
        ->orderBy('order')
        ->get();
    return view('admin-layouts.marketplace.store.edit', compact('store', 'customers', 'countries'));
}


    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|max:191|unique:mp_stores,slug,' . $id,
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'customer_id' => 'required|exists:ec_customers,id',
            'status'      => 'required',
            'logo'        => 'nullable|image|max:2048',
            'logo_square' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name'        => $request->name,
            'slug'        => $request->slug,
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
            'social_links' => $request->social_links,
            'seo_title'   => $request->input('seo_meta.seo_title'),
            'seo_description' => $request->input('seo_meta.seo_description'),
            'seo_index'   => $request->input('seo_meta.index', 'index'),
        ];

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('stores', 'public');
            $data['logo'] = 'storage/' . $path;
        }

        if ($request->hasFile('logo_square')) {
            $path = $request->file('logo_square')->store('stores', 'public');
            $data['logo_square'] = 'storage/' . $path;
        }

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('stores', 'public');
            $data['cover_image'] = 'storage/' . $path;
        }

        $store->update($data);

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
        
        $statements = \App\Models\Withdrawal::where('customer_id', $store->customer_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin-layouts.marketplace.store.show', compact('store', 'statements'));
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json([
            'status' => true,
            'message' => 'Store deleted successfully.'
        ]);
    }
    public function verify(Store $store)
    {
        $store->update([
            'is_verified' => 1,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Store verified successfully',
            'reload' => true
        ]);
    }
}
