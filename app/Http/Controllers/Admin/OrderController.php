<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'payment');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('payment_method', 'like', "%{$search}%")
                  ->orWhere('payment_status', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        if ($request->filled('filter_columns')) {
            $columns = $request->input('filter_columns', []);
            $operators = $request->input('filter_operators', []);
            $values = $request->input('filter_values', []);

            foreach ($columns as $i => $column) {
                if (!empty($column) && isset($values[$i]) && $values[$i] !== '') {
                    $operator = $operators[$i] ?? '=';
                    $value = $values[$i];

                    $allowed = ['id', 'status', 'payment_method', 'payment_status', 'amount', 'created_at'];
                    if (in_array($column, $allowed)) {
                        if ($operator === 'like') {
                            $query->where($column, 'like', "%{$value}%");
                        } else {
                            $query->where($column, $operator, $value);
                        }
                    }
                }
            }
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Order deleted successfully']);
        }

        return redirect()->back()->with('success', 'Order deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No orders selected']);
        }

        Order::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => count($ids) . ' orders deleted successfully']);
    }

    public function create()
    {
        return view('admin-layouts.orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:ec_customers,id',
            'products' => 'required|array',
            'products.*.id' => 'exists:ec_products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        // Calculate totals
        $subTotal = 0;
        foreach ($request->products as $productData) {
            $subTotal += $productData['price'] * $productData['quantity'];
        }

        $taxAmount = 0;
        $shippingAmount = (float) ($request->shipping_amount ?? 0);
        $discountAmount = (float) ($request->discount_amount ?? 0);
        $totalAmount = $subTotal + $taxAmount + $shippingAmount - $discountAmount;

        // Create Payment record first
        $payment = DB::table('payments')->insertGetId([
            'currency' => $request->currency ?? 'INR',
            'user_id' => $request->user_id ?? 0,
            'charge_id' => null,
            'payment_channel' => $request->payment_method ?? 'cod',
            'description' => 'Order payment',
            'amount' => $totalAmount,
            'order_id' => null,
            'status' => $request->payment_status ?? 'pending',
            'payment_type' => 'confirm',
            'customer_id' => $request->user_id ?? null,
            'customer_type' => $request->user_id ? 'App\\Models\\Customer' : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $order = new Order();
        $order->user_id = $request->user_id ?? 0;
        $order->amount = $totalAmount;
        $order->sub_total = $subTotal;
        $order->tax_amount = $taxAmount;
        $order->shipping_amount = $shippingAmount;
        $order->discount_amount = $discountAmount;
        $order->status = $request->status ?? 'pending';
        $order->shipping_method = $request->shipping_method ?? 'default';
        $order->payment_id = $payment;
        $order->description = $request->description;
        $order->store_id = $request->store_id ?? 1;
        $order->is_confirmed = 1;
        $order->code = 'ORD-' . strtoupper(uniqid());
        $order->save();

        // Update payment with order_id
        DB::table('payments')->where('id', $payment)->update(['order_id' => $order->id]);

        // Save Order Items
        foreach ($request->products as $productData) {
            DB::table('ec_order_product')->insert([
                'order_id' => $order->id,
                'product_id' => $productData['id'],
                'product_name' => $productData['name'] ?? '',
                'qty' => $productData['quantity'],
                'price' => $productData['price'],
                'tax_amount' => 0,
                'options' => '[]',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Save Shipping Address
        if ($request->filled('shipping_name')) {
            DB::table('ec_order_addresses')->insert([
                'order_id' => $order->id,
                'name' => $request->shipping_name,
                'phone' => $request->shipping_phone,
                'email' => $request->shipping_email,
                'country' => $request->shipping_country,
                'state' => $request->shipping_state,
                'city' => $request->shipping_city,
                'address' => $request->shipping_address,
                'zip_code' => $request->shipping_zipcode,
                'type' => 'shipping',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Save Billing Address
        if (!$request->has('same_as_shipping') || !$request->same_as_shipping) {
            if ($request->filled('billing_name')) {
                DB::table('ec_order_addresses')->insert([
                    'order_id' => $order->id,
                    'name' => $request->billing_name,
                    'phone' => $request->billing_phone,
                    'email' => $request->billing_email,
                    'country' => $request->billing_country,
                    'state' => $request->billing_state,
                    'city' => $request->billing_city,
                    'address' => $request->billing_address,
                    'zip_code' => $request->billing_zipcode,
                    'type' => 'billing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }


    public function searchCustomer(Request $request)
    {
        $query = $request->get('q');
        $customers = \App\Models\Customer::with(['addresses' => function($q) {
                $q->where('is_default', 1);
            }])
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'email', 'phone')
            ->limit(10)
            ->get();
        return response()->json($customers);
    }

    public function searchProduct(Request $request)
    {
        $query = $request->get('q');
        $products = \App\Models\EcProduct::where('name', 'LIKE', "%{$query}%")
            ->orWhere('sku', 'LIKE', "%{$query}%")
            ->select('id', 'name', 'price', 'image', 'images', 'sku')
            ->limit(10)
            ->get();

        // Map images
        $products->transform(function($product) {
            $displayImage = $product->image ?: (is_array($product->images) && !empty($product->images) ? $product->images[0] : null);
             $product->image_url = $displayImage ? asset('uploads/' . $displayImage) : asset('home-dashboard-files/placeholder.png');
             return $product;
        });

        return response()->json($products);
    }
}
