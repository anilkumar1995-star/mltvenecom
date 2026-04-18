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
        $unverifiedVendors = Customer::where('is_vendor', 1)
            ->where(function($q) {
                $q->where('is_approved', '!=', 1)->orWhereNull('is_approved');
            })
            ->count();
        $pendingOrders = Order::whereIn('status', ['pending'])->count();
        $unreadContacts = \App\Models\Contact::where('status', 'unread')->count();

        $data = [
            'pending-orders' => $pendingOrders,
            'pending-order-returns' => OrderReturn::whereIn('return_status', ['pending', 'processing'])->count(),
            'pending-products' => Product::where('status', 'pending')->count(),
            'marketplace-notifications-count' => $unverifiedVendors,
            'pending-withdrawals' => Withdrawal::where('status', 'pending')->count(),
            'unverified-vendors' => $unverifiedVendors,
            'unread-contacts' => $unreadContacts,
            'contact-count' => $unreadContacts,
            'payment-count' => \App\Models\Payment::where('status', 'pending')->count(),
            'pending-payments' => \App\Models\Payment::where('status', 'pending')->count(),
            'ecommerce-count' => $pendingOrders,
        ];

        return response()->json($data);
    }
}
