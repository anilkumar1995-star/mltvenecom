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
        return response()->json([
            'pending-orders' => Order::whereIn('status', ['pending', 'processing'])->count(),
            'pending-order-returns' => OrderReturn::whereIn('return_status', ['pending', 'processing'])->count(),
            'pending-products' => Product::where('status', 'pending')->count(),
            'marketplace-notifications-count' => 0, // Need clarification on notification storage
            'pending-withdrawals' => Withdrawal::where('status', 'pending')->count(),
            'unverified-vendors' => Customer::where('status', 'pending')->count(),
            'payment-count' => 0,
            'pending-payments' => 0,
            'unread-contacts' => \App\Models\Contact::where('status', 'unread')->count(),
            'ecommerce-count' => 0
        ]);
    }
}
