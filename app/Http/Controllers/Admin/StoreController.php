<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Countries;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Exception;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $query = Store::query()->with('customer');

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'email', 'phone'],
        ['id', 'status', 'is_verified', 'created_at']
        );

        $stores = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        return view('admin-layouts.marketplace.store.index', compact('stores', 'filterColumns'));
    }

    public function create()
    {
        $countries = Countries::where('status', 'published')
            ->orderBy('order')
            ->get();
        $customers = Customer::all();

        return view('admin-layouts.marketplace.store.create', compact('countries', 'customers'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:191',
            'slug' => 'required|max:191|unique:mp_stores,slug',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:20',
            'status' => 'required|in:published,draft,pending',
            'customer_id' => 'required|exists:ec_customers,id',
            'logo' => 'nullable|image|max:2048',
            'logo_square' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only([
                'name', 'slug', 'email', 'phone', 'address', 'country', 'state', 'city',
                'company', 'tax_id', 'description', 'content', 'status', 'customer_id',
                'social_links', 'zip_code'
            ]);

            $data['seo_title'] = $request->input('seo_meta.seo_title');
            $data['seo_description'] = $request->input('seo_meta.seo_description');
            $data['seo_index'] = $request->input('seo_meta.index', 'index');

            if ($request->hasFile('logo')) {
                $upload = ImageHelper::imageUploadHelper('logo_', $request->file('logo'));
                if ($upload['status']) {
                    $data['logo'] = $upload['data']['target_file'];
                }
            }

            if ($request->hasFile('logo_square')) {
                $upload = ImageHelper::imageUploadHelper('logo_sq_', $request->file('logo_square'));
                if ($upload['status']) {
                    $data['logo_square'] = $upload['data']['target_file'];
                }
            }

            if ($request->hasFile('cover_image')) {
                $upload = ImageHelper::imageUploadHelper('cover_', $request->file('cover_image'));
                if ($upload['status']) {
                    $data['cover_image'] = $upload['data']['target_file'];
                }
            }

            Store::create($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Store created successfully',
                    'redirect_url' => route('admin.marketplace.store.index')
                ]);
            }

            return redirect()->route('admin.marketplace.store.index')->with('success', 'Store created successfully.');
        }
        catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $customers = Customer::all();
        $countries = Countries::where('status', 'published')
            ->orderBy('order')
            ->get();
        return view('admin-layouts.marketplace.store.edit', compact('store', 'customers', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $store = Store::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|max:191|unique:mp_stores,slug,' . $id,
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'customer_id' => 'required|exists:ec_customers,id',
            'status' => 'required',
            'logo' => 'nullable|image|max:2048',
            'logo_square' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only([
                'name', 'slug', 'email', 'phone', 'description', 'content', 'country',
                'state', 'city', 'address', 'company', 'tax_id', 'status', 'customer_id',
                'social_links', 'zip_code'
            ]);

            $data['seo_title'] = $request->input('seo_meta.seo_title');
            $data['seo_description'] = $request->input('seo_meta.seo_description');
            $data['seo_index'] = $request->input('seo_meta.index', 'index');

            if ($request->hasFile('logo')) {
                $upload = ImageHelper::imageUploadHelper('logo_', $request->file('logo'));
                if ($upload['status']) {
                    $data['logo'] = $upload['data']['target_file'];
                }
            }

            if ($request->hasFile('logo_square')) {
                $upload = ImageHelper::imageUploadHelper('logo_sq_', $request->file('logo_square'));
                if ($upload['status']) {
                    $data['logo_square'] = $upload['data']['target_file'];
                }
            }

            if ($request->hasFile('cover_image')) {
                $upload = ImageHelper::imageUploadHelper('cover_', $request->file('cover_image'));
                if ($upload['status']) {
                    $data['cover_image'] = $upload['data']['target_file'];
                }
            }

            $store->update($data);

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Store updated successfully',
                    'redirect_url' => route('admin.marketplace.store.index')
                ]);
            }

            return redirect()->route('admin.marketplace.store.index')->with('success', 'Store updated successfully.');
        }
        catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        $store->load('customer');
        $store->loadCount('products');

        $statements = \App\Models\Withdrawal::where('customer_id', $store->customer_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin-layouts.marketplace.store.show', compact('store', 'statements'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Store::class , 'Store');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Store::class , 'Stores');
    }

    public function verify(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $store = Store::findOrFail($id);

            // Toggle verify/unverify logic
            if ($store->is_verified) {
                // UNVERIFY
                $store->update([
                    'status' => 'pending',
                    'is_verified' => 0,
                    'verified_at' => null,
                    'verified_by' => null,
                    'verification_note' => null,
                ]);

                if ($store->customer) {
                    $store->customer->update([
                        'status' => 'locked',
                        'vendor_verified_at' => null
                    ]);
                }
                $message = 'Store unverified successfully';
            }
            else {
                // VERIFY
                $store->update([
                    'status' => 'published',
                    'is_verified' => 1,
                    'verified_at' => now(),
                    'verified_by' => auth()->id(),
                    'verification_note' => $request->input('verification_note', ''),
                ]);

                // If possible, mark the vendor customer as fully verified too
                if ($store->customer) {
                    $store->customer->update([
                        'status' => 'activated',
                        'vendor_verified_at' => now()
                    ]);
                }
                $message = 'Store verified successfully';
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => $message,
                    'reload' => true
                ]);
            }
            return redirect()->back()->with('success', $message);
        }
        catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
