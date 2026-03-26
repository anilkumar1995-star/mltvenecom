<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Vendor;
use App\Services\IpaymentsKycService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $redirectTo = '/customer/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:ec_customers,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required', 'string', 'in:customer,vendor'],
            'shop_name' => ['required_if:type,vendor', 'nullable', 'string', 'unique:mp_stores,name'],
            'shop_url' => ['required_if:type,vendor', 'nullable', 'string'],
            'mobile' => ['required_if:type,vendor', 'nullable', 'string', 'min:10'],
            'pan_number' => ['required_if:type,vendor', 'nullable', 'string', 'min:10', 'max:10'],
            'aadhar_number' => ['required_if:type,vendor', 'nullable', 'string', 'min:12', 'max:16'],
        ]);
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $customer = $this->create($request->all());

        event(new Registered($customer));

        // Log the customer in via the 'customer' guard (ec_customers table)
        Auth::guard('customer')->login($customer);

        return $this->registered($request, $customer);
    }

    /**
     * Create a new customer/vendor in the correct tables.
     *
     * Tables affected:
     * 1. ec_customers   - Always (main customer record)
     * 2. mp_stores      - Only if vendor (store info)
     * 3. mp_vendor_info - Only if vendor (financial info)
     * 4. slugs          - Only if vendor (store SEO URL)
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $isVendor = ($data['type'] === 'vendor');

            // ── 1. Save to ec_customers ──
            $customer = Customer::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['mobile'] ?? null,
                'status' => 'activated',
                'is_vendor' => $isVendor ? 1 : 0,
                'pan_number' => $data['pan_number'] ?? null,
                'aadhar_number' => $data['aadhar_number'] ?? null,
            ]);

            if ($isVendor) {
                // ── 2. Save to mp_stores ──
                $store = Store::create([
                    'name' => $data['shop_name'],
                    'slug' => Str::slug($data['shop_name']),
                    'email' => $data['email'],
                    'phone' => $data['mobile'] ?? '',
                    'customer_id' => $customer->id,
                    'status' => 'pending',
                    'is_verified' => 0,
                ]);

                // ── 3. Save to mp_vendor_info ──
                Vendor::create([
                    'customer_id' => $customer->id,
                    'balance' => 0,
                    'total_fee' => 0,
                    'total_revenue' => 0,
                    'payout_payment_method' => 'bank_transfer',
                ]);

                // ── 4. Save to slugs ──
                DB::table('slugs')->insert([
                    'key' => Str::slug($data['shop_name']),
                    'reference_id' => $store->id,
                    'reference_type' => 'Botble\\Marketplace\\Models\\Store',
                    'prefix' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $customer;
        });
    }

    /**
     * Handle the post-registration logic (KYC for vendors).
     */
    protected function registered(Request $request, $customer)
    {
        // Customer registration success - Redirect directly to dashboard
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Redirecting...',
                'redirect' => $this->redirectTo,
            ]);
        }
        return redirect($this->redirectTo);
    }
}
