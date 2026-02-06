<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Store;
use Illuminate\Http\Request;

class VendorController extends Controller
{
   public function vendors()
   {
     $vendors = Customer::has('store')->with('store')->latest()->paginate(15);

       return view('admin-layouts.marketplace.vendors.index', compact('vendors'));
   }

    public function unverifiedVendors()
   {

       $stores = Store::where('is_verified', 0)->with('customer')->orderBy('created_at', 'desc')->paginate(10);
       return view('admin-layouts.marketplace.vendors.unverified_vendors', compact('stores'));
   }

    public function messages()
   {
      $messages = Message::with(['store', 'customer'])->orderBy('created_at', 'desc')->paginate(15);
       return view('admin-layouts.marketplace.vendors.messages', compact('messages'));
   }

    public function show($id)
    {
        $vendor = Customer::with('store')->findOrFail($id);
        return view('admin-layouts.marketplace.vendors.show', compact('vendor'));
    }

    public function edit($id)
    {
        $vendor = Customer::findOrFail($id);
        return view('admin-layouts.marketplace.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Customer::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ec_customers,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'status' => 'required',
        ];

        if ($request->is_change_password) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'status' => $request->status,
            'is_vendor' => $request->has('is_vendor') ? 1 : 0,
        ];

          if ($request->hasFile('avatar_file')) {
            $path = $request->file('avatar_file')->store('vendors', 'public');
            $data['avatar_file'] = 'storage/' . $path;
        } elseif ($request->avatar_file) {
            $data['avatar_file'] = $request->avatar_file;
        }

      
        if ($request->is_change_password) {
            $data['password'] = bcrypt($request->password);
        }

        $vendor->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Vendor updated successfully',
            'redirect_url' => route('admin.marketplace.vendors')
        ]);
    }

    public function destroy($id)
    {
        $vendor = Customer::findOrFail($id);
        // Maybe also delete store? For now just delete customer/vendor.
        $vendor->delete();

        return response()->json([
            'status' => true,
            'message' => 'Vendor deleted successfully.'
        ]);
    }

    public function destroyMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->json([
            'status' => true,
            'message' => 'Message deleted successfully.'
        ]);
    }
}
