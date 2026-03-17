<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EcProduct;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ordersCount = Order::count();
        $productsCount = EcProduct::count();
        $customersCount = Customer::count();
        $reviewsCount = Review::count();

        return view('home', compact('ordersCount', 'productsCount', 'customersCount', 'reviewsCount'));
    }
}
