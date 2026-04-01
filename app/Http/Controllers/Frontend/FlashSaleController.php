<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function show($id)
    {
        $flashSale = FlashSale::where('status', 'published')
            ->where('end_date', '>', now())
            ->with(['products' => function($q) {
                $q->where('status', 'published');
            }])
            ->findOrFail($id);

        $products = $flashSale->products()->paginate(12);

        return view('frontend.ecommerce.flash-sale', compact('flashSale', 'products'));
    }
}
