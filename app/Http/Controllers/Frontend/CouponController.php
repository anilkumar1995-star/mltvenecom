<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of all active coupons.
     */
    public function index()
    {
        $coupons = Discount::active()
            ->available()
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontend.coupons.index', compact('coupons'));
    }
}
