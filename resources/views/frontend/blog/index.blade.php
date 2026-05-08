@extends('frontend.layouts.app')
@section('title', 'Our Blog')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pb-20 mb-20 pt-20 text-start page_speed_1817463929">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Blog</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Blog </span>
                </div>
            </div>
        </div>
    </section>

    <div class="tp-blog-grid-area pb-40 pt-20">
        <div class="container">
            <div class="row">
                {{-- Main Content --}}
                <div class="col-xl-9 col-lg-8">
                    <div class="tp-blog-grid-wrapper">
                        <div class="tp-blog-grid-top d-flex flex-wrap justify-content-between align-items-center mb-40">
                            <div class="tp-blog-grid-result mb-3 mb-sm-0">
                                <p class="mb-0 text-muted">Showing {{ $posts->firstItem() ?? 0 }} to {{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} results</p>
                            </div>
                            <div class="tp-blog-grid-tab tp-tab">
                                <nav class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                                    <a class="nav-link {{ $layout === 'grid' ? 'active' : '' }} border-0" href="{{ route('frontend.blog.index', ['layout' => 'grid']) }}" title="Grid View">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.3328 6.01317V2.9865C16.3328 2.0465 15.9061 1.6665 14.8461 1.6665H12.1528C11.0928 1.6665 10.6661 2.0465 10.6661 2.9865V6.0065C10.6661 6.95317 11.0928 7.3265 12.1528 7.3265H14.8461C15.9061 7.33317 16.3328 6.95317 16.3328 6.01317Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M16.3328 15.18V12.4867C16.3328 11.4267 15.9061 11 14.8461 11H12.1528C11.0928 11 10.6661 11.4267 10.6661 12.4867V15.18C10.6661 16.24 11.0928 16.6667 12.1528 16.6667H14.8461C15.9061 16.6667 16.3328 16.24 16.3328 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.33281 6.01317V2.9865C7.33281 2.0465 6.90614 1.6665 5.84614 1.6665H3.1528C2.0928 1.6665 1.66614 2.0465 1.66614 2.9865V6.0065C1.66614 6.95317 2.0928 7.3265 3.1528 7.3265H5.84614C6.90614 7.33317 7.33281 6.95317 7.33281 6.01317Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M7.33281 15.18V12.4867C7.33281 11.4267 6.90614 11 5.84614 11H3.1528C2.0928 11 1.66614 11.4267 1.66614 12.4867V15.18C1.66614 16.24 2.0928 16.6667 3.1528 16.6667H5.84614C6.90614 16.6667 7.33281 16.24 7.33281 15.18Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                    <a class="nav-link {{ $layout === 'list' ? 'active' : '' }} border-0" href="{{ route('frontend.blog.index', ['layout' => 'list']) }}" title="List View">
                                        <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 7.11133H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 1H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M15 13.2222H1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <div class="tp-blog-grid-item-wrapper">
                            <div class="row tp-gx-30">
                                @forelse($posts as $post)
                                    @php
                                        $imageUrl = $post->image ? (str_starts_with($post->image, 'http') ? $post->image : \App\Helpers\ImageHelper::getImageUrl() . $post->image) : asset('home/placeholder.png');
                                        $postSlug = $post->slug ? $post->slug->key : $post->id;
                                    @endphp
                                    <div class="col-md-6 col-12 mb-30">
                                        <div class="tp-blog-grid-item p-relative transition-all h-100 shadow-sm border rounded overflow-hidden bg-white">
                                            <div class="tp-blog-grid-thumb w-img fix">
                                                <a href="{{ route('frontend.blog.show', $postSlug) }}">
                                                    <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="w-100" style="height: 250px; object-fit: cover; transition: transform 0.5s ease;">
                                                </a>
                                            </div>
                                            <div class="tp-blog-grid-content p-4">
                                                <div class="tp-blog-grid-meta mb-15 d-flex align-items-center gap-3 small text-muted">
                                                    <span>
                                                        <svg class="icon me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                            <path d="M12 7v5l3 3"></path>
                                                        </svg> 
                                                        {{ $post->created_at->format('M d, Y') }}
                                                    </span>
                                                    <span>
                                                        <svg class="icon me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                                        </svg> 
                                                        Admin
                                                    </span>
                                                </div>
                                                <h3 class="tp-blog-grid-title text-truncate mb-2 fs-5 fw-bold">
                                                    <a href="{{ route('frontend.blog.show', $postSlug) }}" title="{{ $post->name }}" class="text-dark hover-primary">{{ $post->name }}</a>
                                                </h3>
                                                <p class="mb-20 text-muted small line-clamp-2">
                                                    {{ Str::limit($post->description, 100) }}
                                                </p>
                                                <div class="tp-blog-grid-btn mt-auto">
                                                    <a href="{{ route('frontend.blog.show', $postSlug) }}" class="btn btn-link p-0 text-decoration-none fw-bold text-primary">
                                                        Read More 
                                                        <svg class="ms-1" width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 7.5L1 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M9.9502 1.47541L16.0002 7.49941L9.9502 13.5244" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <h4 class="text-muted">No posts found.</h4>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Pagination --}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="tp-blog-pagination mt-40 d-flex justify-content-center">
                                    {{ $posts->appends(['layout' => $layout])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-xl-3 col-lg-4 mt-5 mt-lg-0">
                    <div class="tp-sidebar-wrapper tp-sidebar-ml--24">
                        {{-- Search --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-3 fs-5 fw-bold border-start border-primary border-4 ps-3">Search</h3>
                            <div class="tp-sidebar-search">
                                <form method="GET" action="{{ route('frontend.blog.index') }}">
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control border-end-0" placeholder="Search..." value="{{ request('q') }}">
                                        <button class="bg-transparent border border-start-0 px-3 text-muted" type="submit">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- About Me --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-3 fs-5 fw-bold border-start border-primary border-4 ps-3">About Admin</h3>
                            <div class="tp-sidebar-widget-content text-center">
                                <div class="tp-sidebar-about">
                                    <div class="tp-sidebar-about-thumb mb-3">
                                        <img src="{{ asset('home/logo-red.png') }}" alt="Logo" class="rounded-circle shadow-sm" style="width: 80px; height: 80px; object-fit: contain; padding: 10px; border: 2px solid #f3f3f3;">
                                    </div>
                                    <div class="tp-sidebar-about-content">
                                        <h3 class="tp-sidebar-about-title fs-6 mb-1 fw-bold">Multive Marketplace</h3>
                                        <span class="tp-sidebar-about-designation text-muted small d-block mb-3">Blogger & Curator</span>
                                        <p class="small text-muted mb-0">Discover the latest insights, trends, and expert analysis in this comprehensive blog.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Latest Posts --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-3 fs-5 fw-bold border-start border-primary border-4 ps-3">Latest Posts</h3>
                            <div class="tp-sidebar-widget-content">
                                <div class="tp-sidebar-blog-item-wrapper d-flex flex-column gap-3">
                                    @php
                                        $latestPosts = \App\Models\Post::where('status', 'published')->orderBy('created_at', 'DESC')->limit(3)->get();
                                    @endphp
                                    @foreach($latestPosts as $lPost)
                                        @php
                                            $lImageUrl = $lPost->image ? (str_starts_with($lPost->image, 'http') ? $lPost->image : \App\Helpers\ImageHelper::getImageUrl() . $lPost->image) : asset('home/placeholder.png');
                                        @endphp
                                        <div class="tp-sidebar-blog-item d-flex align-items-center gap-3">
                                            <div class="tp-sidebar-blog-thumb flex-shrink-0">
                                                <a href="{{ route('frontend.blog.show', $lPost->slug ? $lPost->slug->key : $lPost->id) }}">
                                                    <img src="{{ $lImageUrl }}" alt="{{ $lPost->name }}" class="rounded shadow-xs" style="width: 60px; height: 60px; object-fit: cover;">
                                                </a>
                                            </div>
                                            <div class="tp-sidebar-blog-content overflow-hidden">
                                                <div class="tp-sidebar-blog-meta small text-muted mb-1">{{ $lPost->created_at->format('M d, Y') }}</div>
                                                <h3 class="tp-sidebar-blog-title fs-6 mb-1 text-truncate fw-bold">
                                                    <a href="{{ route('frontend.blog.show', $lPost->slug ? $lPost->slug->key : $lPost->id) }}" class="text-dark hover-primary">{{ $lPost->name }}</a>
                                                </h3>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        {{-- Popular Tags --}}
                        <div class="tp-sidebar-widget mb-35 bg-white p-4 shadow-sm rounded border">
                            <h3 class="tp-sidebar-widget-title mb-3 fs-5 fw-bold border-start border-primary border-4 ps-3">Popular Tags</h3>
                            <div class="tp-sidebar-widget-content tagcloud d-flex flex-wrap gap-2">
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Fashion</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Vintage</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Branding</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Design</a>
                                <a href="#" class="btn btn-outline-light btn-sm text-dark px-3 py-1">Modern</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('styles')
<style>
    .tp-blog-grid-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
    .tp-blog-grid-thumb img:hover {
        transform: scale(1.05);
    }
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
    .tp-tab .nav-link.active {
        color: var(--primary-color) !important;
        background: transparent !important;
    }
    .tp-tab .nav-link {
        color: #888;
        padding: 5px;
    }
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .shadow-xs {
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .hover-underline:hover {
        text-decoration: underline !important;
    }
</style>
@endpush
