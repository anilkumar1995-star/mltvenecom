<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Currency;
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
}
