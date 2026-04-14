
@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')

@push('styles')
<style>
    /* Custom Product Card Hover Effects & Clean Design */
    .tp-product-item-2 {
        transition: all 0.3s ease-in-out !important;
        background: #fff !important;
        position: relative !important;
    }

    .tp-product-item-2:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        transform: translateY(-5px) !important;
    }

    .tp-product-thumb-2 {
        overflow: hidden !important;
        border-radius: 12px 12px 0 0 !important;
        position: relative !important;
    }

    .tp-product-thumb-2 div img {
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    /* Product scaling removed as requested */

    .tp-product-action-2 {
        position: absolute !important;
        right: 15px !important;
        top: 15px !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateX(15px) !important;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
        z-index: 9 !important;
    }

    .tp-product-item-2:hover .tp-product-action-2 {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateX(0) !important;
    }

    /* Fixed height for Bestseller Cards */
    .tp-best-item-5 .tp-product-item-5 {
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        min-height: 480px !important;
    }

    .tp-best-item-5 .tp-product-thumb-5 {
        height: 240px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: hidden !important;
    }

    .tp-best-item-5 .tp-product-thumb-5 img {
        height: 100% !important;
        width: 100% !important;
        object-fit: contain !important;
    }

    .tp-best-item-5 .tp-product-content-5 {
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }

    .tp-product-title-2 {
        min-height: 44px !important; /* Forces 2 lines */
    }

    .tp-product-action-btn-2 {
        background-color: #fff !important;
        color: #444 !important;
        border: none !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 8px !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1) !important;
        transition: all 0.3s ease !important;
    }

    .tp-product-action-btn-2:hover {
        background-color: var(--primary-color, #678E61) !important;
        color: #fff !important;
        transform: scale(1.1) !important;
    }

    .tp-product-action-btn-2 i {
        font-size: 16px !important;
    }

    /* Price colors handled in partial */

    .tp-product-rating-icon-2 span {
        color: #ffb21d !important;
        font-size: 12px !important;
    }

    .tp-category-item-5 {
        border-radius: 18px !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
        border: none !important;
        min-height: 130px !important; /* Reverted to compact height */
        width: 130px !important;  /* Reverted to compact width */
        margin: 0 auto !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        padding: 10px !important; /* Subtle padding for the icon */
        background-color: #f3f4f6 !important;
    }

    .tp-category-item-5:hover {
        transform: translateY(-5px) !important;
    }

    .tp-category-card-link {
        display: block !important;
        text-align: center !important;
        padding: 0 5px !important;
    }

    .tp-category-thumb-5 {
        height: 100% !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        overflow: visible !important;
    }

    .tp-category-thumb-5 img {
        max-height: 100% !important;
        max-width: 100% !important;
        object-fit: contain !important;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    .tp-category-title-5 {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #212529 !important;
        margin-top: 8px !important;
        line-height: 1.2 !important;
        min-height: 32px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    .tp-category-slider-arrow-5 button {
        position: absolute;
        top: 35%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        background-color: #000 !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center;
        justify-content: center;
        z-index: 10;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
        transition: all 0.3s ease !important;
        color: #fff !important;
        border: none !important;
    }

    .tp-category-slider-arrow-5 button:hover {
        background-color: #333 !important;
        transform: translateY(-50%) scale(1.1) !important;
    }

    .tp-category-slider-button-prev {
        left: -10px !important;
    }

    .tp-category-slider-button-next {
        right: -10px !important;
    }

    .tp-category-slider-active-2 .swiper-slide {
        width: auto !important;
        margin-right: 15px !important; /* Reduced gap */
    }

    @media (max-width: 768px) {
        .tp-category-item-5 {
            height: 105px !important;
            width: 105px !important;
            padding: 6px !important;
            border-radius: 12px !important;
        }
        .tp-category-thumb-5 {
            height: 70px !important;
        }
        .tp-category-title-5 {
            font-size: 11px !important;
        }
        .tp-category-slider-active-2 .swiper-slide {
            margin-right: 10px !important;
        }
    }


    .tp-slider-height-5 {
        min-height: 280px !important;
    }

    .tp-slider-title-5 {
        font-weight: 800 !important;
        font-size: 32px !important;
        line-height: 1.1 !important;
        color: #111 !important;
        margin-bottom: 20px !important;
    }

    .tp-btn-green {
        background-color: var(--primary-color, #678E61) !important;
        color: #fff !important;
        padding: 8px 18px !important;
        border-radius: 5px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
        font-size: 14px !important;
    }

    .tp-btn-green:hover {
        background-color: #222 !important;
        color: #fff !important;
    }

    @media (max-width: 767px) {
        .tp-slider-height-5 {
            min-height: 160px !important;
        }
        .tp-slider-title-5 {
            font-size: 18px !important;
            margin-bottom: 12px !important;
        }
        .tp-btn-green {
            padding: 6px 14px !important;
            font-size: 12px !important;
        }
    }

    /* Restored Product Card Styles */
    .tp-product-item-5 {
        height: 100% !important;
        display: flex !important;
        flex-direction: column !important;
        border: 1px solid #f1f1f1 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
        background: #fff !important;
    }

    .tp-product-thumb-5 {
        height: 200px !important;
        overflow: hidden !important;
        position: relative !important;
        background: #f9f9f9 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .tp-product-thumb-5 img {
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: contain !important;
        transition: transform 0.5s ease-in-out !important;
    }

    .tp-product-content-5 {
        padding: 15px !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .tp-product-sm-item-5 {
        margin-bottom: 20px !important;
        padding: 10px !important;
        border-radius: 10px !important;
        transition: all 0.3s ease !important;
    }

    .tp-product-sm-thumb-5 {
        flex: 0 0 80px !important;
        width: 80px !important;
        height: 80px !important;
        margin-right: 15px !important;
    }

    .tp-product-sm-title-5 {
        font-size: 14px !important;
        font-weight: 600 !important;
        line-height: 1.3 !important;
        margin-bottom: 4px !important;
    }
</style>
@endpush
<!-- <section data-block-id="simple-slider" class="tp-slider-area p-relative z-index-1 fix">
    <div class="tp-slider-active-5 owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000"
        data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1"
        data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"
        data-owl-animate-out="fadeOut" data-owl-animate-in="fadeIn">

        @if(isset($home_slider) && $home_slider->sliderItems->count() > 0)
        @foreach($home_slider->sliderItems as $item)
        <div class="tp-slider-item-5 scene tp-slider-height-5 d-flex align-items-center"
            style="background-color: #F3F3F3;">
            <div class="tp-slider-shape-5">
   
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="tp-slider-content-5 p-relative z-index-1">
                            <h3 class="tp-slider-title-5">{!! $item->title !!}</h3>
                            @if($item->link)
                            <div class="tp-slider-btn-5"><a href="{{ $item->link }}" class="tp-btn-green">
                                    Shop Now </a></div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="tp-slider-thumb-wrapper-5 p-relative">
                            <div class="tp-slider-thumb-5 main-img">
                                @php
                                $imageUrl = $item->image ? (str_starts_with($item->image, 'http') ? $item->image : \App\Helpers\ImageHelper::getImageUrl() . $item->image) : asset('home/slider-1.png');
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $item->title }}">
                                <span class="tp-slider-thumb-5-gradient"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="tp-slider-item-5 scene tp-slider-height-5 d-flex align-items-center"
            style="background-color: #F3F3F3;">
            <div class="tp-slider-shape-5">
                <div class="tp-slider-shape-5-1"><img src="{{ asset('home/shape-1.png') }}"
                        class="layer" data-depth="0.2" alt="shape"></div>
                <div class="tp-slider-shape-5-2"><img src="{{ asset('home/shape-2.png') }}"
                        class="layer" data-depth="0.2" alt="shape"></div>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-7 col-xl-7 col-lg-6">
                        <div class="tp-slider-content-5 p-relative z-index-1">
                            <h3 class="tp-slider-title-5"> The Online <br> Grocery Store </h3>
                            <div class="tp-slider-btn-5"><a href="{{ route('frontend.products.index') }}" class="tp-btn-green">
                                    Shop
                                    Now </a></div>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-5 col-lg-6">
                        <div class="tp-slider-thumb-wrapper-5 p-relative">
                            <div class="tp-slider-thumb-5 main-img">
                                <img src="{{ asset('home/slider-1.png') }}" alt="slider">
                                <span class="tp-slider-thumb-5-gradient"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section> -->

<section class="tp-category-area pt-60 pb-60">
    <div class="container">
                <div class="tp-section-title-wrapper-5 mb-40 d-flex align-items-center justify-content-between">
            <h3 class="tp-section-title-5" style="font-weight: 800; font-size: 24px; margin:0;">Shop by Category</h3>
            <a href="{{ route('frontend.categories.index') }}" class="text-decoration-none fw-bold" style="color: #ff3269; font-size: 14px;">See All <i class="fas fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-category-slider-wrapper-5 p-relative">
                    <div class="tp-category-slider-active-2 swiper-container">
                        <div class="swiper-wrapper">
                            @if (!empty($categories))
                            @php
                            $bgColors = ['#f0f8f1', '#fef1f1', '#f2fce4', '#fefce8', '#f2f3ff', '#f9f1ff', '#fff0f5'];
                            @endphp
                            @foreach ($categories as $index => $category)
                            @php
                            $imageUrl = $category->image ? (str_starts_with($category->image, 'http') ? $category->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->image, '/')) : asset('home/placeholder.png');
                            @endphp
                            <div class="swiper-slide">
                                <a href="{{ route('frontend.categories.show', $category->slug) }}" class="tp-category-card-link">
                                    <div class="tp-category-item-5 p-relative z-index-1 mb-10">
                                        <div class="tp-category-thumb-5">
                                            <img src="{{ $imageUrl }}" alt="{{ $category->name }}">
                                        </div>
                                    </div>
                                    <h3 class="tp-category-title-5">{{ $category->name }}</h3>
                                </a>
                            </div>
                            @endforeach
                            {{-- See All Card --}}
                            <div class="swiper-slide">
                                <a href="{{ route('frontend.categories.index') }}" class="tp-category-card-link">
                                    <div class="tp-category-item-5 p-relative z-index-1 mb-10" style="background: #fdf2f5 !important; border: 1px dashed #ff3269 !important;">
                                        <div class="tp-category-thumb-5" style="color: #ff3269;">
                                            <i class="fas fa-arrow-right" style="font-size: 24px;"></i>
                                        </div>
                                    </div>
                                    <h3 class="tp-category-title-5" style="color: #ff3269 !important;">See All</h3>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tp-category-slider-arrow-5">
                        <button class="tp-category-slider-button-prev">
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button class="tp-category-slider-button-next">
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tp-product-area pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="tp-section-title-wrapper-5 mb-50 d-flex align-items-baseline gap-3">
                    <h3 class="section-title tp-section-title-5 m-0"> <span>Featured</span> Products </h3>
                    <a href="{{ url('/products') }}" class="text-decoration-none fw-bold" style="color: #ff3269; font-size: 14px;">See All <i class="fas fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="tp-product-tab-2 tp-product-tab-5 tp-tab mb-50">
                    <ul class="nav nav-tabs justify-content-lg-end" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                                All Product
                                <span class="tp-product-tab-tooltip">{{ $all_products->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured" type="button" role="tab" aria-controls="featured" aria-selected="false">
                                Featured
                                <span class="tp-product-tab-tooltip">{{ $featured_products->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="on-sale-tab" data-bs-toggle="tab" data-bs-target="#on-sale" type="button" role="tab" aria-controls="on-sale" aria-selected="false">
                                On Sale
                                <span class="tp-product-tab-tooltip">{{ $on_sale->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="trending-tab" data-bs-toggle="tab" data-bs-target="#trending" type="button" role="tab" aria-controls="trending" aria-selected="false">
                                Trending
                                <span class="tp-product-tab-tooltip">{{ $trending_products->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="top-rated-tab" data-bs-toggle="tab" data-bs-target="#top-rated" type="button" role="tab" aria-controls="top-rated" aria-selected="false">
                                Top Rated
                                <span class="tp-product-tab-tooltip">{{ $top_rated_products->count() }}</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <!-- All Products -->
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @foreach ($all_products as $product)
                    <div class="col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Featured Products -->
            <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @foreach ($featured_products as $product)
                    <div class="col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- On Sale Products -->
            <div class="tab-pane fade" id="on-sale" role="tabpanel" aria-labelledby="on-sale-tab">
                <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @foreach ($on_sale as $product)
                    <div class="col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Trending Products -->
            <div class="tab-pane fade" id="trending" role="tabpanel" aria-labelledby="trending-tab">
                <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @foreach ($trending_products as $product)
                    <div class="col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Rated Products -->
            <div class="tab-pane fade" id="top-rated" role="tabpanel" aria-labelledby="top-rated-tab">
                <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                    @foreach ($top_rated_products as $product)
                    <div class="col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tp-product-area pb-70">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="tp-section-title-wrapper-5 mb-50 d-flex justify-content-between align-items-baseline">
                    <h3 class="section-title tp-section-title-5 m-0"> <span>New</span> Arrivals </h3>
                    <a href="{{ url('/products') }}" class="text-decoration-none fw-bold" style="color: #ff3269; font-size: 14px;">See All <i class="fas fa-chevron-right ms-1" style="font-size: 10px;"></i></a>
                </div>
            </div>
        </div>
        <div class="row mb-30 row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
            @if (!empty($new_arrivals))
            @foreach ($new_arrivals as $product)
            <div class="col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
{{-- Dynamic Flash Sale --}}
@if ($flash_sale)
<section class="tp-deal-area pt-70 pb-70 p-relative z-index-1 fix" style="background: linear-gradient(rgba(215, 210, 210, 0.7), rgba(180, 172, 172, 0.7))">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7">
                <a href="{{ route('frontend.flash-sale.show', $flash_sale->id) }}" class="tp-deal-content-link">
                    <div class="tp-deal-content text-center">
                        <span class="tp-deal-title-pre" style="color: #678E61; font-weight: 600; font-size: 18px; margin-bottom: 5px; display: block;">Best Deals of the week!</span>
                        <h3 class="tp-deal-title" style="font-size: 56px; font-weight: 800; color: #111; margin-bottom: 30px;">{{ $flash_sale->name }}</h3>
                        <div class="tp-deal-countdown">
                            <div class="tp-product-countdown" data-countdown="" data-date="{{ $flash_sale->end_date->format('Y/m/d H:i:s') }}">
                                <div class="tp-product-countdown-inner">
                                    <ul class="d-flex align-items-center justify-content-center gap-2">
                                        <li class="bg-white rounded py-3 px-2 shadow-sm" style="min-width: 80px; text-align: center;">
                                            <span data-days="" style="display: block; font-size: 28px; font-weight: 700; color: #678E61; line-height: 1;">0</span>
                                            <small style="text-transform: uppercase; font-size: 10px; color: #666; font-weight: 600;">Days</small>
                                        </li>
                                        <li class="bg-white rounded py-3 px-2 shadow-sm" style="min-width: 80px; text-align: center;">
                                            <span data-hours="" style="display: block; font-size: 28px; font-weight: 700; color: #678E61; line-height: 1;">0</span>
                                            <small style="text-transform: uppercase; font-size: 10px; color: #666; font-weight: 600;">Hrs</small>
                                        </li>
                                        <li class="bg-white rounded py-3 px-2 shadow-sm" style="min-width: 80px; text-align: center;">
                                            <span data-minutes="" style="display: block; font-size: 28px; font-weight: 700; color: #678E61; line-height: 1;">0</span>
                                            <small style="text-transform: uppercase; font-size: 10px; color: #666; font-weight: 600;">Mins</small>
                                        </li>
                                        <li class="bg-white rounded py-3 px-2 shadow-sm" style="min-width: 80px; text-align: center;">
                                            <span data-seconds="" style="display: block; font-size: 28px; font-weight: 700; color: #678E61; line-height: 1;">0</span>
                                            <small style="text-transform: uppercase; font-size: 10px; color: #666; font-weight: 600;">Secs</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Product Groups: Trending & Top Rated --}}
<section class="tp-product-sm-area pt-30 pb-30">
    <div class="container">
        <div class="row align-items-stretch"> {{-- Added stretch to align heights --}}
            <div class="col-xl-4 col-lg-4 col-md-12 mb-40">
                <div class="tp-product-side-banner-thumb h-100"> {{-- h-100 to fill column height --}}
                    <a href="{{ route('frontend.products.index') }}" class="h-100 d-block">
                        <img src="{{ asset('home/bestseller.jpg') }}" style="width: 100%;" alt="Banner">
                    </a>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="row">
                    {{-- Trending Column --}}
                    <div class="col-md-6 col-sm-6">
                        <div class="tp-product-sm-wrapper-5 mb-60">
                            <h3 class="tp-product-sm-section-title">Trending Products</h3>
                            <div class="tp-product-sm-item-wrapper-5">
                                @foreach($trending_products->take(3) as $product)
                                @php
                                $imageUrl = $product->image ? (str_starts_with($product->image, 'http') ? $product->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($product->image, '/')) : asset('home/placeholder.png');
                                @endphp
                                <div class="tp-product-sm-item-5 d-flex align-items-center p-relative">
                                    <div class="tp-product-sm-thumb-5 fix">
                                        <a href="{{ $product->slug ? route('frontend.products.show', $product->slug) : '#' }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="tp-product-sm-content-5">
                                        <div class="tp-product-sm-tag-5">
                                            <a href="{{ ($product->store->slug ?? null) ? route('frontend.stores.show', $product->store->slug) : '#' }}">
                                                {{ $product->store->name ?? 'Shofy Store' }}
                                                @if ($product->store && $product->store->is_verified)
                                                    <i class="fas fa-check-circle ms-1" style="font-size: 9px; color: #0095f6;"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <h4 class="tp-product-sm-title-5">
                                            <a href="{{ $product->slug ? route('frontend.products.show', $product->slug) : '#' }}">{{ $product->name }}</a>
                                        </h4>
                                        <div class="tp-product-rating-icon-2 mb-5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span><i class="fas fa-star" style="color: {{ $i <= round($product->reviews_avg ?? 0) ? '#ffb21d' : '#d5d5d5' }}; font-size: 10px;"></i></span>
                                            @endfor
                                            <span class="ms-1 text-muted" style="font-size: 10px;">({{ $product->reviews_count ?? 0 }})</span>
                                        </div>
                                        <div style="font-size: 11px; color: #666; margin-bottom: 5px;">
                                            @if($product->weight > 0)
                                                1 pack ({{ (float)$product->weight }} {{ $product->unit_type ?: 'kg' }})
                                            @else
                                                1 unit
                                            @endif
                                        </div>
                                        <div class="tp-product-sm-price-wrapper-5 d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="tp-product-sm-price-5" style="background: #25a541; color: #fff !important; font-weight: 800; font-size: 13px; padding: 2px 6px; border-radius: 6px;">₹{{ number_format($product->final_price) }}</span>
                                                    @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                                                        <span class="tp-product-sm-price-5 old-price" style="text-decoration: line-through; color: #999; font-size: 12px; margin-left: -2px;">₹{{ number_format($product->price) }}</span>
                                                    @endif
                                                </div>
                                                @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                                                    <span style="color: #25a541; font-weight: 800; font-size: 11px; margin-top: 4px;">₹{{ number_format($product->price - $product->final_price) }} OFF</span>
                                                @endif
                                            </div>
                                            <div class="tp-product-action-zepto" data-id="{{ $product->id }}" style="position: absolute; bottom: 12px; right: 12px; z-index: 3;">
                                                @php
                                                    $cart = session('cart', []);
                                                    $cartItem = $cart[$product->id] ?? null;
                                                @endphp
                                                {{-- ADD Button --}}
                                                <button type="button"
                                                    class="tp-add-to-cart-zepto-card {{ $cartItem ? 'd-none' : '' }}"
                                                    data-id="{{ $product->id }}"
                                                    data-url="{{ route('frontend.cart.add') }}"
                                                    style="background: #fff; color: #ff3269; border: 1px solid #ff3269; border-radius: 6px; font-weight: 800; font-size: 11px; height: 28px; min-width: 60px; text-transform: uppercase; padding: 0 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: all 0.2s ease;">
                                                    ADD
                                                </button>

                                                {{-- Quantity Selector --}}
                                                <div class="tp-qty-selector-zepto {{ $cartItem ? '' : 'd-none' }}" style="background: #ff3269; color: #fff; border-radius: 6px; display: flex; align-items: center; height: 28px; min-width: 75px; justify-content: space-between; font-weight: 800; font-size: 13px; box-shadow: 0 2px 5px rgba(255, 50, 105, 0.2);">
                                                    <span class="qty-btn-zepto minus" style="cursor: pointer; padding: 0 8px; height: 100%; display: flex; align-items: center;">-</span>
                                                    <span class="qty-count-zepto">{{ $cartItem ? $cartItem['quantity'] : 1 }}</span>
                                                    <span class="qty-btn-zepto plus" style="cursor: pointer; padding: 0 8px; height: 100%; display: flex; align-items: center;">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Top Rated Column --}}
                    <div class="col-md-6 col-sm-6">
                        <div class="tp-product-sm-wrapper-5 mb-60">
                            <h3 class="tp-product-sm-section-title">Top Rated</h3>
                            <div class="tp-product-sm-item-wrapper-5">
                                @foreach($top_rated_products->take(3) as $product)
                                @php
                                $imageUrl = $product->image ? (str_starts_with($product->image, 'http') ? $product->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($product->image, '/')) : asset('home/placeholder.png');
                                @endphp
                                <div class="tp-product-sm-item-5 d-flex align-items-center p-relative">
                                    <div class="tp-product-sm-thumb-5 fix">
                                        <a href="{{ $product->slug ? route('frontend.products.show', $product->slug) : '#' }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                    <div class="tp-product-sm-content-5">
                                        <div class="tp-product-sm-tag-5">
                                            <a href="{{ ($product->store->slug ?? null) ? route('frontend.stores.show', $product->store->slug) : '#' }}">
                                                {{ $product->store->name ?? 'Shofy Store' }}
                                                @if ($product->store && $product->store->is_verified)
                                                    <i class="fas fa-check-circle ms-1" style="font-size: 12px; color: #0095f6;"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <h4 class="tp-product-sm-title-5">
                                            <a href="{{ $product->slug ? route('frontend.products.show', $product->slug) : '#' }}">{{ $product->name }}</a>
                                        </h4>
                                        <div class="tp-product-rating-icon-2 mb-5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <span><i class="fas fa-star" style="color: {{ $i <= round($product->reviews_avg ?? 0) ? '#ffb21d' : '#d5d5d5' }}; font-size: 10px;"></i></span>
                                            @endfor
                                            <span class="ms-1 text-muted" style="font-size: 10px;">({{ $product->reviews_count ?? 0 }})</span>
                                        </div>
                                        <div class="tp-product-sm-price-wrapper-5 d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="tp-product-sm-price-5" style="background: #25a541; color: #fff !important; font-weight: 800; font-size: 13px; padding: 2px 6px; border-radius: 6px;">₹{{ number_format($product->final_price) }}</span>
                                                    @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                                                        <span class="tp-product-sm-price-5 old-price" style="text-decoration: line-through; color: #999; font-size: 12px; margin-left: -2px;">₹{{ number_format($product->price) }}</span>
                                                    @endif
                                                </div>
                                                @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                                                    <span style="color: #25a541; font-weight: 800; font-size: 11px; margin-top: 4px;">₹{{ number_format($product->price - $product->final_price) }} OFF</span>
                                                @endif
                                            </div>
                                            <div class="tp-product-action-zepto" data-id="{{ $product->id }}" style="position: absolute; bottom: 12px; right: 12px; z-index: 3;">
                                                @php
                                                    $cart = session('cart', []);
                                                    $cartItem = $cart[$product->id] ?? null;
                                                @endphp
                                                {{-- ADD Button --}}
                                                <button type="button"
                                                    class="tp-add-to-cart-zepto-card {{ $cartItem ? 'd-none' : '' }}"
                                                    data-id="{{ $product->id }}"
                                                    data-url="{{ route('frontend.cart.add') }}"
                                                    style="background: #fff; color: #ff3269; border: 1px solid #ff3269; border-radius: 6px; font-weight: 800; font-size: 11px; height: 28px; min-width: 60px; text-transform: uppercase; padding: 0 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: all 0.2s ease;">
                                                    ADD
                                                </button>

                                                {{-- Quantity Selector --}}
                                                <div class="tp-qty-selector-zepto {{ $cartItem ? '' : 'd-none' }}" style="background: #ff3269; color: #fff; border-radius: 6px; display: flex; align-items: center; height: 28px; min-width: 75px; justify-content: space-between; font-weight: 800; font-size: 13px; box-shadow: 0 2px 5px rgba(255, 50, 105, 0.2);">
                                                    <span class="qty-btn-zepto minus" style="cursor: pointer; padding: 0 8px; height: 100%; display: flex; align-items: center;">-</span>
                                                    <span class="qty-count-zepto">{{ $cartItem ? $cartItem['quantity'] : 1 }}</span>
                                                    <span class="qty-btn-zepto plus" style="cursor: pointer; padding: 0 8px; height: 100%; display: flex; align-items: center;">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>
</div>
</div>
</section> {{-- Dynamic Testimonials --}}
@if ($testimonials->isNotEmpty())
<section class="tp-testimonial-area pt-30 pb-30 shortcode-lazy-loading-loaded">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="tp-testimonial-slider-wrapper-5">
                    <div class="row">
                        <div class="col-xl-7 offset-xl-3">
                            <div class="tp-section-title-wrapper-5 mb-45">
                                <span class="tp-section-title-pre-5">Customer Reviews</span>
                                <h3 class="section-title tp-section-title-5">Our Happy Customers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="tp-testimonial-slider-5 p-relative">
                        <div class="tp-testimonial-slider-active-5 swiper-container pb-15">
                            <div class="swiper-wrapper">
                                @foreach($testimonials as $testimonial)
                                <div class="tp-testimonial-item-5 d-md-flex swiper-slide white-bg">
                                    <div class="tp-testimonial-avater-wrapper-5 p-relative">
                                        <div class="tp-avater-rounded mr-60">
                                            <div class="tp-testimonial-avater-5">
                                                <img src="{{ $testimonial->customer->avatar_url ?? asset('home/placeholder.png') }}" alt="{{ $testimonial->customer->name ?? 'User' }}">
                                            </div>
                                        </div>
                                        <span class="quote-icon">
                                            <img src="{{ asset('themes/shofy-grocery/images/testimonial-quote.png') }}" alt="quote">
                                        </span>
                                    </div>

                                    <div class="tp-testimonial-content-5">
                                        <div class="tp-testimonial-rating tp-testimonial-rating-5 ">
                                            @for($i = 0; $i < 5; $i++)
                                                <span class="{{ $i < $testimonial->star ? 'star-filled' : 'star-empty' }}">
                                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="{{ $i < $testimonial->star ? 'currentColor' : 'none' }}" stroke="currentColor">
                                                    <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z"></path>
                                                </svg>
                                                </span>
                                                @endfor
                                        </div>
                                        <p>{{ Str::limit($testimonial->comment, 150) }}</p>
                                        <div class="tp-testimonial-user-5-info">
                                            <h3 class="tp-testimonial-user-5-title">{{ $testimonial->customer->name ?? 'User' }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tp-testimonial-arrow-5">
                            <button type="button" class="tp-testimonial-slider-5-button-prev">
                                <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.10059 7.97559L32.1006 7.97559" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M8.15039 0.999999L1.12076 7.99942L8.15039 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <button type="button" class="tp-testimonial-slider-5-button-next">
                                <svg width="33" height="16" viewBox="0 0 33 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.1006 7.97559L1.10059 7.97559" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M25.0508 0.999999L32.0804 7.99942L25.0508 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

</div>

</div>
</div>
</div>
</div>
</div>
</section>
{{-- Dynamic Bestsellers --}}
<section class="tp-best-seller-area pt-110 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7">
                <div class="tp-best-banner-5 p-relative mr-20">
                    <div class="tp-best-banner-slider-active-5 swiper-container">
                        <div class="swiper-wrapper">
                            <div class="tp-best-banner-item-5 p-relative fix swiper-slide">
                                <div class="tp-best-banner-thumb-5 include-bg grey-bg">
                                    <a href="{{ route('frontend.products.index') }}">
                                        <img src="{{ asset('home/banner-2.png') }}" style="width: 100%" alt="Ads">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tp-best-banner-slider-dot-5 tp-swiper-dot"></div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <div class="tp-best-slider-wrapper-5">
                    <div class="tp-section-title-wrapper-5 mb-50">
                        <span class="tp-section-title-pre-5">More to Discover</span>
                        <h3 class="section-title tp-section-title-5"><span>Bestsellers</span> of the week</h3>
                    </div>

                    <div class="tp-best-slider-5 p-relative">
                        <div class="tp-best-slider-active-5 swiper-container" data-item-per-row="3">
                            <div class="swiper-wrapper">
                                @foreach($all_products->take(6) as $product)
                                <div class="tp-best-item-5 swiper-slide">
                                    @include('frontend.partials.product-card-grid', ['product' => $product])
                                </div>
                                @endforeach
                            </div>
                            <div class="tp-best-slider-arrow-5 d-none d-sm-block">
                                <button type="button" class="tp-best-slider-5-button-prev">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                                <button type="button" class="tp-best-slider-5-button-next">
                                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('home/countdown.js') }}"></script>
<script>
    $(document).ready(function() {
        if (typeof $.fn.countdown === 'function') {
            $('[data-countdown]').each(function() {
                var $this = $(this);
                var finalDate = $this.data('date');
                $this.countdown(finalDate, function(event) {
                    $this.find('[data-days]').html(event.strftime('%D'));
                    $this.find('[data-hours]').html(event.strftime('%H'));
                    $this.find('[data-minutes]').html(event.strftime('%M'));
                    $this.find('[data-seconds]').html(event.strftime('%S'));
                });
            });
        }

        // Swiper slider auto-width compatibility fix
        // This ensures the custom CSS `width: auto` is handled correctly
        setTimeout(function() {
            if (typeof Swiper !== 'undefined') {
                var catSliders = document.querySelectorAll('.tp-category-slider-active-2');
                catSliders.forEach(function(el) {
                    if (el.swiper) {
                        el.swiper.destroy(true, true);
                    }
                    new Swiper(el, {
                        slidesPerView: 'auto',
                        spaceBetween: 0, // Handled correctly by margins
                        loop: false,
                        navigation: {
                            nextEl: '.tp-category-slider-button-next',
                            prevEl: '.tp-category-slider-button-prev',
                        }
                    });
                });
            }
        }, 600);
    });
</script>
@endpush
@endsection