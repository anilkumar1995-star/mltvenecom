<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppFaq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index()
    {
        $faqs = AppFaq::where('status', 'published')
            ->orderBy('order', 'ASC')
            ->get();

        return view('frontend.faqs.index', compact('faqs'));
    }
}
