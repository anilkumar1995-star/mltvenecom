<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request)
    {
        $layout = $request->query('layout', 'grid');
        
        $posts = Post::where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate(12);

        return view('frontend.blog.index', compact('posts', 'layout'));
    }

    /**
     * Display a single blog post.
     */
    public function show($slug)
    {
        // Assuming Botble's slug management or simple lookup
        $post = Post::where('status', 'published')->whereHas('slug', function($q) use ($slug) {
            $q->where('key', $slug)->where('reference_type', 'Botble\Blog\Models\Post');
        })->first();

        if (!$post) {
            // Fallback for simple slug column if it exists or by ID
            $post = Post::where('status', 'published')->where('id', $slug)->first();
        }

        if (!$post) {
            abort(404);
        }

        return view('frontend.blog.show', compact('post'));
    }
}
