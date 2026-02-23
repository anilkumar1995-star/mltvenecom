<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Models\Customer;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customer = auth('customer')->user() ?? auth('web')->user();
        if (!$customer) {
            return redirect()->route('login');
        }
        $recent_orders = Order::where('user_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        $total_orders = Order::where('user_id', $customer->id)->count();
        $total_spent = Order::where('user_id', $customer->id)->sum('amount');

        return view('frontend.customer.dashboard', compact('customer', 'recent_orders', 'total_orders', 'total_spent'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth('customer')->id())
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.customer.orders', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::where('user_id', auth('customer')->id())
            ->where('id', $id)
            ->with(['items.product', 'address'])
            ->firstOrFail();

        return view('frontend.customer.order-detail', compact('order'));
    }

    public function profile()
    {
        $customer = auth('customer')->user();
        return view('frontend.customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = auth('customer')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:ec_customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? $customer->phone;

        if (!empty($validated['password'])) {
            $customer->password = Hash::make($validated['password']);
        }

        $customer->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function addresses()
    {
        $addresses = Address::where('customer_id', auth('customer')->id())->get();
        return view('frontend.customer.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'is_default' => 'nullable|boolean',
        ]);

        $validated['customer_id'] = auth('customer')->id();
        $validated['is_default'] = $request->has('is_default');

        // If this is default, unset other defaults
        if ($validated['is_default']) {
            Address::where('customer_id', auth('customer')->id())
                ->update(['is_default' => false]);
        }

        Address::create($validated);

        return back()->with('success', 'Address added successfully!');
    }
}
