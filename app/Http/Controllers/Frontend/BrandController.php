<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EcBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of all brands.
     */
    public function index()
    {
        $brands = EcBrand::published()
            ->orderBy('order', 'ASC')
            ->get();

        return view('frontend.brands.index', compact('brands'));
    }
}
