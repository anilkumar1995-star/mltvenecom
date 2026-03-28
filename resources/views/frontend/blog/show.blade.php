@extends('frontend.layouts.app')
@section('title', $post->name)
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 mb-30 text-start pt-30 page_speed_1817463929">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile mb-10">
                    <span><a class="d-inline-block text-muted" href="{{ route('frontend.home') }}">Home</a></span>
                    <span><a class="d-inline-block text-muted" href="{{ route('frontend.blog.index') }}">Blog</a></span>
                    <span> {{ $post->name }} </span>
                </div>
                <h3 class="breadcrumb__title fs-2 fw-bold text-dark">{{ $post->name }}</h3>
            </div>
        </div>
    </section>

    <section class="tp-blog-details-area pb-120">
        <div class="container">
            <div class="row">
                {{-- Main Post Content --}}
                <div class="col-xl-9 col-lg-8">
                    <div class="tp-blog-details-wrapper pe-xl-5">
                        <div class="tp-blog-details-thumb w-img mb-40 overflow-hidden rounded shadow-sm">
                            @php
                                $imageUrl = $post->image ? (str_starts_with($post->image, 'http') ? $post->image : \App\Helpers\ImageHelper::getImageUrl() . $post->image) : asset('home/placeholder.png');
                            @endphp
                            <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="w-100" style="max-height: 500px; object-fit: cover;">
                        </div>

                        <div class="tp-blog-details-content-top mb-40">
                            <div class="tp-blog-details-meta mb-20 d-flex align-items-center gap-4 text-muted small">
                                <span>
                                    <svg class="icon text-primary me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 7v5l3 3"></path>
                                    </svg>
                                    {{ $post->created_at->format('M d, Y') }}
                                </span>
                                <span>
                                    <svg class="icon text-primary me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                    Post by Admin
                                </span>
                                <span>
                                    <svg class="icon text-primary me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                    </svg>
                                    {{ number_format($post->views ?? 0) }} Views
                                </span>
                            </div>
                        </div>

                        <div class="tp-blog-details-content mb-40 lh-lg text-dark fs-6 ck-content">
                            {!! $post->content !!}
                        </div>

                        {{-- Tags / Share --}}
                        <div class="tp-blog-details-tag-share d-flex flex-wrap justify-content-between align-items-center gap-3 border-top border-bottom py-3 mb-40">
                            <div class="tp-blog-details-tag d-flex align-items-center gap-2">
                                <span class="fw-bold me-2">Tags:</span>
                                @forelse($post->tags as $tag)
                                    <a href="#" class="btn btn-sm btn-light border-0 px-3">{{ $tag->name }}</a>
                                @empty
                                    <span class="text-muted small">No tags</span>
                                @endforelse
                            </div>
                            <div class="tp-blog-details-share d-flex align-items-center gap-3">
                                <span class="fw-bold me-2">Share:</span>
                                <a href="#" class="text-muted hover-primary"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="text-muted hover-primary"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-muted hover-primary"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>

                        {{-- Navigation --}}
                        <div class="tp-blog-details-nav d-flex flex-wrap justify-content-between gap-4 mb-50">
                            @php
                                $prevPost = \App\Models\Post::where('status', 'published')->where('id', '<', $post->id)->orderBy('id', 'DESC')->first();
                                $nextPost = \App\Models\Post::where('status', 'published')->where('id', '>', $post->id)->orderBy('id', 'ASC')->first();
                            @endphp
                            
                            @if($prevPost)
                            <div class="tp-blog-details-nav-item d-flex align-items-center gap-3 overflow-hidden" style="max-width: 300px;">
                                <div class="tp-blog-details-nav-icon flex-shrink-0">
                                    <a href="{{ route('frontend.blog.show', $prevPost->slug ? $prevPost->slug->key : $prevPost->id) }}" class="btn btn-outline-light rounded-circle p-2 border-0">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                    </a>
                                </div>
                                <div class="tp-blog-details-nav-content overflow-hidden">
                                     <span class="small text-muted d-block mb-1">Previous Post</span>
                                     <h4 class="fs-6 mb-0 text-truncate fw-bold">
                                         <a href="{{ route('frontend.blog.show', $prevPost->slug ? $prevPost->slug->key : $prevPost->id) }}" class="text-dark hover-primary">{{ $prevPost->name }}</a>
                                     </h4>
                                </div>
                            </div>
                            @endif

                            @if($nextPost)
                            <div class="tp-blog-details-nav-item d-flex align-items-center flex-row-reverse gap-3 overflow-hidden text-end" style="max-width: 300px;">
                                <div class="tp-blog-details-nav-icon flex-shrink-0">
                                    <a href="{{ route('frontend.blog.show', $nextPost->slug ? $nextPost->slug->key : $nextPost->id) }}" class="btn btn-outline-light rounded-circle p-2 border-0">
                                        <i class="fas fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                                <div class="tp-blog-details-nav-content overflow-hidden">
                                     <span class="small text-muted d-block mb-1">Next Post</span>
                                     <h4 class="fs-6 mb-0 text-truncate fw-bold">
                                         <a href="{{ route('frontend.blog.show', $nextPost->slug ? $nextPost->slug->key : $nextPost->id) }}" class="text-dark hover-primary">{{ $nextPost->name }}</a>
                                     </h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-xl-3 col-lg-4">
                    <div class="tp-sidebar-wrapper tp-sidebar-ml--24">
                        {{-- Latest Blogs Sidebar --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-4 fs-5 fw-bold border-start border-primary border-4 ps-3">Latest Posts</h3>
                            <div class="tp-sidebar-widget-content">
                                <div class="tp-sidebar-blog-item-wrapper d-flex flex-column gap-3">
                                    @php
                                        $latestPosts = \App\Models\Post::where('status', 'published')->where('id', '!=', $post->id)->orderBy('created_at', 'DESC')->limit(3)->get();
                                    @endphp
                                    @foreach($latestPosts as $lPost)
                                        @php
                                            $lImageUrl = $lPost->image ? (str_starts_with($lPost->image, 'http') ? $lPost->image : \App\Helpers\ImageHelper::getImageUrl() . $lPost->image) : asset('home/placeholder.png');
                                        @endphp
                                        <div class="tp-sidebar-blog-item d-flex align-items-center gap-3">
                                            <div class="tp-sidebar-blog-thumb flex-shrink-0">
                                                <a href="{{ route('frontend.blog.show', $lPost->slug ? $lPost->slug->key : $lPost->id) }}">
                                                    <img src="{{ $lImageUrl }}" alt="{{ $lPost->name }}" class="rounded shadow-xs" style="width: 70px; height: 70px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="tp-sidebar-blog-content overflow-hidden">
                                                <div class="tp-sidebar-blog-meta small text-muted mb-1">{{ $lPost->created_at->format('M d, Y') }}</div>
                                                <h3 class="tp-sidebar-blog-title fs-6 mb-0 text-truncate fw-bold">
                                                    <a href="{{ route('frontend.blog.show', $lPost->slug ? $lPost->slug->key : $lPost->id) }}" class="text-dark hover-primary">{{ $lPost->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Popular Tags Widget --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-4 fs-5 fw-bold border-start border-primary border-4 ps-3">Popular Tags</h3>
                            <div class="tp-sidebar-widget-content tagcloud d-flex flex-wrap gap-2">
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Business</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Design</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Fashion</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Modern</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Vintage</a>
                            </div>
                        </div>

                        {{-- Subscribe --}}
                        <div class="tp-sidebar-widget mb-35 bg-primary p-4 shadow-sm rounded text-white overflow-hidden p-relative">
                            <div class="z-index-1 p-relative">
                                <h3 class="tp-sidebar-widget-title mb-2 fs-5 fw-bold text-white">Subscribe!</h3>
                                <p class="small mb-3 text-white-50">Stay informed about new products and special offers.</p>
                                <div class="tp-sidebar-subscribe">
                                    <div class="input-group">
                                        <input type="email" class="form-control border-0 px-3" placeholder="Email Address">
                                        <button class="btn btn-dark" type="button">Join</button>
                                    </div>
                                </div>
                            </div>
                            <svg class="p-absolute" style="right: -20px; bottom: -20px; opacity: 0.1; width: 150px; height: 150px;" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zM20 8l-8 5-8-5v10h16V8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('styles')
<style>
    .tp-blog-details-thumb img {
        transition: transform 0.7s ease;
    }
    .tp-blog-details-thumb:hover img {
        transform: scale(1.02);
    }
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
    .breadcrumb__area {
        background-color: #f8f9fa;
    }
    .tagcloud a:hover {
        background: var(--primary-color) !important;
        color: #fff !important;
        border-color: var(--primary-color) !important;
    }
    .shadow-xs {
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .ck-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem 0;
    }
    .ck-content blockquote {
        border-left: 4px solid var(--primary-color) !important;
        padding: 1.5rem 2rem !important;
        background: #f8f9fa !important;
        font-style: italic !important;
        margin: 1.5rem 0 !important;
        color: #333 !important;
    }
    .ck-content blockquote p {
        color: #333 !important;
        margin-bottom: 10px !important;
    }
    .ck-content blockquote span {
        color: #666 !important;
        font-weight: bold !important;
        display: block !important;
        margin-top: 5px !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    /* Font Awesome integration if not already present */
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
</style>
@endpush
