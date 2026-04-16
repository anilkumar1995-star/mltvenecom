<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppFaq;
use App\Models\Page;
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

        $page = Page::where('name', 'FAQs')->where('status', 'published')->first();

        return view('frontend.faqs.index', compact('faqs', 'page'));
    }
}
