<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;
use Illuminate\Support\Facades\DB;
use Exception;

class VendorController extends Controller
{
    public function vendors(Request $request)
    {
        $query = Customer::where('is_vendor', 1)->with(['store', 'vendorInfo'])->withCount('products')->withSum('vendorOrders as total_revenue_sum', 'amount')->withSum(['withdrawals as total_withdrawn' => function($q) { $q->whereIn('status', ['completed', 'pending', 'processing']); }], 'amount');

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'email', 'phone'], // searchable
        ['id', 'status', 'created_at'] // filterable
        );

        $vendors = $query->latest()->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
        return view('admin-layouts.marketplace.vendors.index', compact('vendors', 'filterColumns'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();
            $vendor = Customer::findOrFail($id);

            // Check if KYC is complete before approval
            if ($vendor->kyc_status !== 'approved' && $vendor->kyc_status !== 'verified') {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot approve vendor. KYC is ' . ($vendor->kyc_status ?? 'pending') . '. Please wait for KYC verification.'
                ]);
            }

            $vendor->status = 'activated';
            $vendor->vendor_verified_at = now();
            $vendor->save();

            // also verify store
            if ($vendor->store) {
                $vendor->store->is_verified = 1;
                $vendor->store->verified_at = now();
                $vendor->store->status = 'published';
                $vendor->store->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Vendor approved successfully.',
                'reload' => true
            ]);
        }
        catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Customer::class , 'Vendor');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Customer::class , 'Vendors');
    }

    // Messages Logic
    public function messages(Request $request)
    {
        $query = Message::with(['store', 'customer']);

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'email', 'content'], // searchable
        ['id', 'store_id', 'customer_id', 'created_at'] // filterable
        );

        $messages = $query->latest()->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.marketplace.vendors.messages', compact('messages', 'filterColumns'));
    }

    public function destroyMessage($id)
    {
        return TableHelpers::performDelete($id, Message::class , 'Message');
    }

    public function bulkDeleteMessages(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Message::class , 'Messages');
    }

    // Maintain old route signature methods to avoid errors if linked
    public function unverifiedVendors(Request $request)
    {
        $query = Customer::where('is_vendor', 1)
                 ->whereHas('store', function ($q) {
                     $q->where('is_verified', 0);
                 })->with(['store', 'vendorInfo'])->withCount('products')->withSum('vendorOrders as total_revenue_sum', 'amount')->withSum(['withdrawals as total_withdrawn' => function($q) { $q->whereIn('status', ['completed', 'pending', 'processing']); }], 'amount');

        TableHelpers::applyTableLogic($query, $request,
        ['id', 'name', 'email', 'phone'], // searchable
        ['id', 'status', 'created_at'] // filterable
        );

        $vendors = $query->orderBy('id', 'desc')->paginate(TableHelpers::getPerPage($request));

        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.marketplace.unverified.index', compact('vendors', 'filterColumns'));
    }

    public function show($id)
    {
        $vendor = Customer::with(['store', 'vendorInfo'])
                  ->withCount(['products', 'vendorOrders as orders_count'])
                  ->withSum('vendorOrders as total_revenue_sum', 'amount')
                  ->withSum(['withdrawals as total_withdrawn' => function($q) { $q->whereIn('status', ['completed', 'pending', 'processing']); }], 'amount')
                  ->findOrFail($id);
        return view('admin-layouts.marketplace.vendors.show', compact('vendor'));
    }

    public function edit($id)
    {
        $vendor = Customer::with(['store', 'vendorInfo'])->findOrFail($id);
        return view('admin-layouts.marketplace.vendors.edit', compact('vendor'));
    }

    public function verify($id)
    {
        $vendor = Customer::with(['store', 'vendorInfo'])->findOrFail($id);
        // Load partial view for verifying vendors
        return view('admin-layouts.marketplace.unverified.show', compact('vendor'));
    }

    public function checkKycStatus($id)
    {
        $vendor = Customer::findOrFail($id);
        return response()->json([
            'status' => true,
            'kyc_status' => $vendor->kyc_status ?? 'N/A',
            'message' => 'Current KYC Status: ' . ucfirst($vendor->kyc_status ?? 'N/A')
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Customer::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ec_customers,email,' . $id,
            'shop_name' => 'required|string|max:255',
            'mobile' => 'nullable|string',
            'status' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $data = $request->only(['name', 'email', 'status', 'pan_number', 'aadhar_number']);
            
            // Handle 'phone' vs 'mobile' from the form
            if ($request->has('mobile')) {
                $data['phone'] = $request->mobile;
            } elseif ($request->has('phone')) {
                $data['phone'] = $request->phone;
            }

            if ($request->filled('password')) {
                $request->validate(['password' => 'string|min:8|confirmed']);
                $data['password'] = bcrypt($request->password);
            }

            if ($request->hasFile('avatar_file')) {
                $upload = \App\Helpers\ImageHelper::imageUploadHelper('vendor_avatar_', $request->file('avatar_file'));
                if ($upload['status']) {
                    $data['avatar'] = $upload['data']['target_file'];
                }
            }

            $user->update($data);

            // Update associated Store
            if ($user->store) {
                $user->store->update([
                    'name' => $request->shop_name,
                    'email' => $user->email,
                    'phone' => $data['phone'] ?? $user->phone,
                ]);
            }

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Vendor updated successfully',
                    'redirect_url' => route('admin.marketplace.vendors')
                ]);
            }

            return redirect()->route('admin.marketplace.vendors')->with('success', 'Vendor updated successfully');
        } catch (\Exception $e) {
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
}
