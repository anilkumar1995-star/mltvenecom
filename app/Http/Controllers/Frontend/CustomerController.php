<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Address;
use App\Models\Store;
use App\Models\Vendor;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'dob' => 'nullable|date',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $request->input('phone') ?? $customer->phone;
        $customer->dob = $validated['dob'] ?? $customer->dob;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $upload = ImageHelper::imageUploadHelper('avatar_', $file);
            if ($upload['status']) {
                $customer->avatar = $upload['data']['target_file'];
            }
        }

        $customer->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $customer = auth('customer')->user() ?? auth('web')->user();

        $request->validate([
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, $customer->password)) {
            return back()->withErrors(['old_password' => 'The current password does not match.']);
        }

        $customer->password = Hash::make($request->password);
        $customer->save();

        return back()->with('success', 'Password updated successfully!');
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

    public function becomeVendor()
    {
        $customer = $this->getCustomer();
        if ($customer->is_vendor) {
            return redirect()->route('frontend.vendor.dashboard');
        }
        return view('frontend.customer.become-vendor', compact('customer'));
    }

    public function processBecomeVendor(Request $request)
    {
        $customer = $this->getCustomer();
        if ($customer->is_vendor) {
            return redirect()->route('frontend.vendor.dashboard');
        }

        $request->validate([
            'shop_name' => 'required|string|max:255|unique:mp_stores,name',
            'shop_url' => 'required|string|max:255|unique:mp_stores,slug',
            'phone' => 'required|string|max:20',
            'pan_number' => 'required|string|max:20',
            'aadhar_number' => 'required|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            // 1. Update customer
            $customer->is_vendor = 1;
            $customer->phone = $request->phone;
            $customer->pan_number = $request->pan_number;
            $customer->aadhar_number = $request->aadhar_number;
            $customer->save();

            // 2. Create store
            $store = Store::create([
                'name' => $request->shop_name,
                'slug' => Str::slug($request->shop_url),
                'email' => $customer->email,
                'phone' => $request->phone,
                'customer_id' => $customer->id,
                'status' => 'pending',
                'is_verified' => 0,
            ]);

            // 3. Create vendor info
            Vendor::create([
                'customer_id' => $customer->id,
                'balance' => 0,
                'total_fee' => 0,
                'total_revenue' => 0,
                'payout_payment_method' => 'bank_transfer',
            ]);

            // 4. Create slug
            DB::table('slugs')->insert([
                'key' => Str::slug($request->shop_url),
                'reference_id' => $store->id,
                'reference_type' => 'Botble\\Marketplace\\Models\\Store',
                'prefix' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('frontend.customer.dashboard')->with('success', 'Your vendor application has been submitted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
