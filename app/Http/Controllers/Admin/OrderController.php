<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\TableHelpers;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $query = Order::with('user', 'payment');

        TableHelpers::applyTableLogic($query, $request, 
            ['id', 'status', 'payment_method', 'payment_status', 'user.name'], // searchable
            ['id', 'status', 'payment_method', 'payment_status', 'amount', 'created_at'] // filterable
        );

        $orders = $query->orderBy('created_at', 'desc')->paginate(TableHelpers::getPerPage($request));
        
        $filterColumns = [
            'id' => 'Order ID',
            'status' => 'Status',
            'payment_method' => 'Payment Method',
            'payment_status' => 'Payment Status',
            'amount' => 'Amount',
            'created_at' => 'Created At'
        ];

        return view('admin-layouts.orders.index', compact('orders', 'filterColumns'));
    }

    public function destroy($id)
    {
        return TableHelpers::performDelete($id, Order::class, 'order');
    }

    public function bulkDelete(Request $request)
    {
        return TableHelpers::performBulkDelete($request, Order::class, 'orders');
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
        $order->is_finished = 1;
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

            // Reduction if completed
            if ($order->status === 'completed') {
                \App\Models\EcProduct::where('id', $productData['id'])->decrement('quantity', $productData['quantity']);
            }
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

        // Generate Invoice
        \App\Services\InvoiceService::createInvoiceFromOrder($order);

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }


    public function edit($id)
    {
        $order = Order::with(['user', 'payment', 'items'])->findOrFail($id);
        
        // Get items in a way the view expects
        $products = DB::table('ec_order_product')
            ->join('ec_products', 'ec_order_product.product_id', '=', 'ec_products.id')
            ->where('ec_order_product.order_id', $id)
            ->select('ec_products.*', 'ec_order_product.qty', 'ec_order_product.price as order_price')
            ->get();

        // Standardize products for the view
        $products->transform(function($p) {
            $p->price = $p->order_price; // Use the price from the order
            return $p;
        });

        $shippingAddress = DB::table('ec_order_addresses')->where('order_id', $id)->where('type', 'shipping')->first();
        $billingAddress = DB::table('ec_order_addresses')->where('order_id', $id)->where('type', 'billing')->first();

        return view('admin-layouts.orders.edit', compact('order', 'products', 'shippingAddress', 'billingAddress'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
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

        $shippingAmount = (float) ($request->shipping_amount ?? 0);
        $discountAmount = (float) ($request->discount_amount ?? 0);
        $totalAmount = $subTotal + (float) ($order->tax_amount ?? 0) + $shippingAmount - $discountAmount;

        // Update Order
        $oldStatus = $order->status;
        $order->amount = $totalAmount;
        $order->sub_total = $subTotal;
        $order->shipping_amount = $shippingAmount;
        $order->discount_amount = $discountAmount;
        $order->status = $request->status ?? 'pending';
        $order->payment_id = $request->payment_id ?? $order->payment_id;
        $order->description = $request->description;
        $order->store_id = $request->store_id ?? $order->store_id;
        $order->is_finished = 1;
        $order->save();

        // Inventory Reduction Logic
        if ($oldStatus !== 'completed' && $order->status === 'completed') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->decrement('quantity', $item->qty);
                }
            }
        }

        // Update Payment
        if ($order->payment_id) {
            DB::table('payments')->where('id', $order->payment_id)->update([
                'payment_channel' => $request->payment_method ?? 'cod',
                'amount' => $totalAmount,
                'status' => $request->payment_status ?? 'pending',
                'updated_at' => now(),
            ]);
        }

        // Update Products (Delete and Re-insert is easiest)
        DB::table('ec_order_product')->where('order_id', $order->id)->delete();
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

        // Update Addresses
        DB::table('ec_order_addresses')->where('order_id', $order->id)->delete();

        // Shipping
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

        // Billing
        if (!$request->has('same_as_shipping')) {
            if ($request->filled('billing_name')) {
                DB::table('ec_order_addresses')->insert([
                    'order_id' => $order->id,
                    'name' => $request->billing_name,
                    'phone' => $request->billing_phone,
                    'email' => $request->billing_email,
                    'country' => $request->shipping_country, // fallback
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

        // Generate Invoice (or update if status changed)
        \App\Services\InvoiceService::createInvoiceFromOrder($order);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
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
            $product->image_url = $displayImage ? (str_starts_with($displayImage, 'http') ? $displayImage : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($displayImage, '/')) : asset('home/placeholder.png');
            return $product;
        });

        return response()->json($products);
    }
}
