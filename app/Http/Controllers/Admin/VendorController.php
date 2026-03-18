<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;
use Illuminate\Support\Facades\DB;
use Exception;

class VendorController extends Controller
{
    public function vendors(Request $request)
    {
        $query = User::where('role', 'vendor');

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'email', 'shop_name', 'mobile'], // searchable
            ['id', 'status', 'is_approved', 'created_at']   // filterable
        );

        $vendors = $query->latest()->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'is_approved' => 'Approved',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.marketplace.vendors.index', compact('vendors', 'filterColumns'));
    }

    public function approve($id)
    {
        try {
            DB::beginTransaction();
            $vendor = User::findOrFail($id);
            $vendor->status = 'active';
            $vendor->is_approved = true;
            $vendor->save();
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Vendor approved successfully.',
                'reload' => true
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, User::class, 'Vendor');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, User::class, 'Vendors');
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
        return TableHelpers::performDelete($id, Message::class, 'Message');
    }

    public function bulkDeleteMessages(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Message::class, 'Messages');
    }

    // Maintain old route signature methods to avoid errors if linked
    public function unverifiedVendors(Request $request) {
         $request->merge(['status' => 'pending']);
         return $this->vendors($request);
    }

    public function show($id) {
         return redirect()->route('admin.marketplace.vendors');
    }

    public function edit($id) {
         return redirect()->route('admin.marketplace.vendors');
    }

    public function update(Request $request, $id) {
        return back();
    }
}
