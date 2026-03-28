<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderReturn;
use App\Models\Product;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class MenuCountController extends Controller
{
    public function getCounts()
    {
        $unverifiedVendors = Customer::where('is_vendor', 1)->where('status', 'pending')->count();
        $pendingOrders = Order::whereIn('status', ['pending', 'processing'])->count();
        $unreadContacts = \App\Models\Contact::where('status', 'unread')->count();

        $data = [
            ['key' => 'pending-orders', 'value' => $pendingOrders],
            ['key' => 'pending-order-returns', 'value' => OrderReturn::whereIn('return_status', ['pending', 'processing'])->count()],
            ['key' => 'pending-products', 'value' => Product::where('status', 'pending')->count()],
            ['key' => 'marketplace-notifications-count', 'value' => $unverifiedVendors],
            ['key' => 'pending-withdrawals', 'value' => Withdrawal::where('status', 'pending')->count()],
            ['key' => 'unverified-vendors', 'value' => $unverifiedVendors],
            ['key' => 'unread-contacts', 'value' => $unreadContacts],
            ['key' => 'contact-count', 'value' => $unreadContacts],
            ['key' => 'payment-count', 'value' => \App\Models\Payment::where('status', 'pending')->count()],
            ['key' => 'pending-payments', 'value' => \App\Models\Payment::where('status', 'pending')->count()],
            ['key' => 'ecommerce-count', 'value' => $pendingOrders], // Linking ecommerce to pending orders
        ];

        return response()->json(['data' => $data]);
    }
}
