<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendors()
    {
        // Get all users who are vendors
        $vendors = User::where('role', 'vendor')->latest()->paginate(15);
        return view('admin-layouts.marketplace.vendors.index', compact('vendors'));
    }

    public function approve($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->status = 'active';
        $vendor->is_approved = true;
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

    public function destroy($id)
    {
        $vendor = User::findOrFail($id);
        $vendor->delete();

        return redirect()->back()->with('success', 'Vendor deleted successfully.');
    }

    // Maintain old route signature methods to avoid errors if linked
    public function unverifiedVendors() {
         $vendors = User::where('role', 'vendor')->where('status', 'pending')->latest()->paginate(15);
         return view('admin-layouts.marketplace.vendors.index', compact('vendors'));
    }

    public function show($id) {
         $vendor = User::findOrFail($id);
         // return view('admin-layouts.marketplace.vendors.show', compact('vendor'));
         return redirect()->route('admin.marketplace.vendors');
    }

    public function edit($id) {
         $vendor = User::findOrFail($id);
         // return view('admin-layouts.marketplace.vendors.edit', compact('vendor'));
         return redirect()->route('admin.marketplace.vendors');
    }

    public function messages() {
        return view('admin-layouts.marketplace.vendors.messages', ['messages' => []]);
    }

    public function destroyMessage($id) {
        return back();
    }

    public function update(Request $request, $id) {
        return back();
    }

}
