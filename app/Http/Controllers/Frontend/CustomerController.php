<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Get the correct ec_customers ID regardless of auth guard
     */
    private function getCustomerId()
    {
        // If logged in via customer guard, return directly
        if (auth('customer')->check()) {
            return auth('customer')->id();
        }

        // If logged in via web guard, find matching ec_customers record by email
        if (auth('web')->check()) {
            $user = auth('web')->user();
            $customer = Customer::where('email', $user->email)->first();
            
            // If no customer record exists, create one
            if (!$customer) {
                $customer = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone ?? $user->mobile ?? null,
                    'password' => $user->password,
                    'confirmed_at' => now(),
                    'status' => 'activated',
                ]);
            }
            
            return $customer->id;
        }

        return null;
    }

    /**
     * Get the authenticated user object (for display purposes)
     */
    private function getCustomer()
    {
        return auth('customer')->user() ?? auth('web')->user();
    }
    public function dashboard()
    {
        $customer = auth('customer')->user() ?? auth('web')->user();
        if (!$customer) {
            return redirect()->route('login');
        }
        $customerId = $this->getCustomerId();
        $recent_orders = Order::where('user_id', $customerId)
            ->latest()
            ->take(5)
            ->get();

        $total_orders = Order::where('user_id', $customerId)->count();
        $total_spent = Order::where('user_id', $customerId)->sum('amount');
        $total_addresses = Address::where('customer_id', $customerId)->count();

        return view('frontend.customer.dashboard', compact('customer', 'recent_orders', 'total_orders', 'total_spent', 'total_addresses'));
    }

    public function orders()
    {
        $customer = $this->getCustomer();
        $customerId = $this->getCustomerId();
        $orders = Order::where('user_id', $customerId ?? 0)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.customer.orders', compact('customer', 'orders'));
    }

    public function orderDetail($id)
    {
        $customer = $this->getCustomer();
        $customerId = $this->getCustomerId();
        $order = Order::where('user_id', $customerId ?? 0)
            ->where('id', $id)
            ->with(['items.product', 'address'])
            ->firstOrFail();

        return view('frontend.customer.order-detail', compact('customer', 'order'));
    }

    public function profile()
    {
        $customer = auth('customer')->user() ?? auth('web')->user();
        return view('frontend.customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = auth('customer')->user() ?? auth('web')->user();

        // Determine table based on whether it is a customer or user model
        $table = auth('customer')->check() ? 'ec_customers' : 'users';

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:' . $table . ',email,' . $customer->id,
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
        $customer = $this->getCustomer();
        $customerId = $this->getCustomerId();
        $addresses = Address::where('customer_id', $customerId)->get();
        return view('frontend.customer.addresses', compact('customer', 'addresses'));
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

        $customerId = $this->getCustomerId();
        $validated['customer_id'] = $customerId;
        $validated['is_default'] = $request->has('is_default');

        // If this is default, unset other defaults
        if ($validated['is_default']) {
            Address::where('customer_id', $customerId)
                ->update(['is_default' => false]);
        }

        Address::create($validated);

        return back()->with('success', 'Address added successfully!');
    }

    public function updateAddress(Request $request, $id)
    {
        $customerId = $this->getCustomerId();
        $address = Address::where('id', $id)->where('customer_id', $customerId)->firstOrFail();

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

        $validated['is_default'] = $request->has('is_default');

        // If this is default, unset other defaults
        if ($validated['is_default']) {
            Address::where('customer_id', $customerId)
                ->where('id', '!=', $id)
                ->update(['is_default' => false]);
        }

        $address->update($validated);

        return back()->with('success', 'Address updated successfully!');
    }

    public function deleteAddress($id)
    {
        $customerId = $this->getCustomerId();
        $address = Address::where('id', $id)->where('customer_id', $customerId)->firstOrFail();
        $address->delete();

        return back()->with('success', 'Address deleted successfully!');
    }

    public function invoices()
    {
        $customer = $this->getCustomer();
        return view('frontend.customer.invoices', compact('customer'));
    }

    public function reviews()
    {
        $customer = $this->getCustomer();
        return view('frontend.customer.reviews', compact('customer'));
    }

    public function downloads()
    {
        $customer = $this->getCustomer();
        return view('frontend.customer.downloads', compact('customer'));
    }

    public function returns()
    {
        $customer = $this->getCustomer();
        return view('frontend.customer.returns', compact('customer'));
    }
}
