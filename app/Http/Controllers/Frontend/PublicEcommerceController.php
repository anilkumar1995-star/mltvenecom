<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PublicEcommerceController extends Controller
{
    public function changeCurrency(Request $request, ?string $title = null)
    {
        // Get currency from parameter or request
        if (empty($title)) {
            $title = $request->input('currency');
        }

        if (!$title) {
            return response()->json([
                'status' => false,
                'message' => 'Currency not provided'
            ]);
        }

        // Find currency
        $currency = Currency::where('title', $title)->first();

        if ($currency) {
            // Store in session
            Session::put('currency', $currency->title);
        }

        // Previous URL
        $url = URL::previous();

        if (!$url || $url === URL::current()) {
            return response()->json([
                'status' => true,
                'next_url' => url('/')
            ]);
        }

        // Remove price filters
        if (Str::contains($url, ['min_price', 'max_price'])) {
            $url = preg_replace('/&min_price=[0-9]+/', '', $url);
            $url = preg_replace('/&max_price=[0-9]+/', '', $url);
        }
        return response()->json([
            'status' => true,
            'next_url' => $url
        ]);
    }

    public function orderTracking()
    {
        return view('frontend.order-tracking');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'email'    => 'required|email',
        ]);

        $orderId = $request->order_id;

        $order = Order::where('code', $orderId)
            ->whereHas('address', function($query) use ($request) {
                $query->where('email', $request->email);
            })
            ->with(['items.product', 'address'])
            ->first();

        if (!$order) {
            $order = Order::where('code', $orderId)
                ->whereHas('user', function($query) use ($request) {
                    $query->where('email', $request->email);
                })
                ->with(['items.product', 'address'])
                ->first();
        }


        if ($order) {
            Session::now('success', 'Order record found! Scroll down for details.');
        } else {
            Session::now('error', 'No order found with the provided details.');
        }

        return view('frontend.order-tracking', compact('order'));
    }

    public function ourStory()
    {
        $page = Page::where('name', 'Our Story')->where('status', 'published')->first();
        return view('frontend.our-story', compact('page'));
    }

    public function shipping()
    {
        $page = Page::where('name', 'Shipping')->where('status', 'published')->first();
        return view('frontend.shipping', compact('page'));
    }

    public function careers()
    {
        $page = Page::where('name', 'Careers')->where('status', 'published')->first();
        return view('frontend.careers', compact('page'));
    }

    public function cookiePolicy()
    {
        $page = Page::where('name', 'Cookie Policy')->where('status', 'published')->first();
        return view('frontend.cookie-policy', compact('page'));
    }
}
