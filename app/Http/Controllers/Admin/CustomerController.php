<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Helpers\TableHelpers;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        TableHelpers::applyTableLogic($query, $request,
            ['id', 'name', 'email', 'phone'], // searchable
            ['id', 'status', 'created_at']   // filterable
        );

        $customers = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];

        return view('admin-layouts.customers.index', compact('customers', 'filterColumns'));
    }

    public function create()
    {
        return view('admin-layouts.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:ec_customers',
            'password' => 'required|min:6|confirmed',
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => $request->status,
                'phone' => $request->phone,
                'dob' => $request->dob,
            ];

            if ($request->hasFile('avatar')) {
                $upload = ImageHelper::imageUploadHelper('avatar_', $request->file('avatar'));
                if ($upload['status']) {
                    $data['avatar'] = $upload['data']['target_file'];
                }
            }

            Customer::create($data);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Customer created successfully',
                    'redirect_url' => route('admin.customers.index')
                ]);
            }

            return redirect()->route('admin.customers.index')->with('success', 'Customer created successfully');
        } catch (Exception $e) {
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
        $customer = Customer::with(['addresses', 'orders', 'wishlist.product', 'reviews.product'])->findOrFail($id);
        return view('admin-layouts.customers.edit', compact('customer'));
    }

    public function show($id)
    {
        $customer = Customer::with(['addresses', 'orders.items', 'wishlist.product', 'reviews.product', 'store', 'vendorInfo'])
                    ->withCount(['products as listed_products_count', 'vendorOrders as received_orders_count'])
                    ->withSum('vendorOrders as total_revenue_sum', 'amount')
                    ->findOrFail($id);

        $totalOrders = $customer->orders->count();
        $completedOrders = $customer->orders->where('status', 'completed')->count();
        $totalSpent = $customer->orders->sum('amount');
        $totalProductsPurchased = $customer->orders->sum(function($order) {
            return $order->items->sum('qty');
        });

        return view('admin-layouts.customers.show', compact('customer', 'totalOrders', 'completedOrders', 'totalSpent', 'totalProductsPurchased'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:ec_customers,email,'.$id,
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $data = $request->except(['password', 'avatar', 'password_confirmation', '_token', '_method']);

            if ($request->filled('password')) {
                $request->validate(['password' => 'min:6|confirmed']);
                $data['password'] = bcrypt($request->password);
            }

            if ($request->hasFile('avatar')) {
                $upload = ImageHelper::imageUploadHelper('avatar_', $request->file('avatar'));
                if ($upload['status']) {
                    $data['avatar'] = $upload['data']['target_file'];
                }
            }

            $customer->update($data);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Customer updated successfully',
                    'redirect_url' => route('admin.customers.index')
                ]);
            }

            return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully');
        } catch (Exception $e) {
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

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Customer::class, 'Customer');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Customer::class, 'Customers');
    }

    public function storeAddress(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip_code' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['customer_id'] = $id;

            if ($request->has('is_default') && $request->is_default == 1) {
                Address::where('customer_id', $id)->update(['is_default' => 0]);
            }

            Address::create($data);
            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Address added successfully',
                    'reload' => true
                ]);
            }

            return redirect()->back()->with('success', 'Address added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroyAddress($address_id)
    {
        try {
            DB::beginTransaction();
            $address = Address::findOrFail($address_id);
            $address->delete();
            DB::commit();

            if (request()->ajax()) {
                return response()->json(['status' => true, 'message' => 'Address deleted successfully']);
            }
            return redirect()->back()->with('success', 'Address deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            if (request()->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
