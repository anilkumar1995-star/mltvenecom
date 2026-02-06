@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')
    <section data-block-id="simple-slider" class="tp-slider-area p-relative z-index-1 fix">
        <div class="tp-slider-active-5 owl-carousel" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000"
            data-owl-gap="0" data-owl-nav="false" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1"
            data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on"
            data-owl-animate-out="fadeOut" data-owl-animate-in="fadeIn">
            <div class="tp-slider-item-5 scene tp-slider-height-5 d-flex align-items-center"
                style="background-color: #F3F3F3;">
                <div class="tp-slider-shape-5">
                    <div class="tp-slider-shape-5-1"><img src="{{ asset('/') }}home dashboard_files/shape-1.png"
                            class="layer" data-depth="0.2" alt="shape"></div>
                    <div class="tp-slider-shape-5-2"><img src="{{ asset('/') }}home dashboard_files/shape-2.png"
                            class="layer" data-depth="0.2" alt="shape"></div>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-7 col-xl-7 col-lg-6">
                            <div class="tp-slider-content-5 p-relative z-index-1">
                                <h3 class="tp-slider-title-5"> The Online <br> Grocery Store </h3>
                                <div class="tp-slider-btn-5"><a href="{{ asset('/') }}products" class="tp-btn-green">
                                        Shop
                                        Now </a></div>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-6">
                            <div class="tp-slider-thumb-wrapper-5 p-relative">
                                <div class="tp-slider-thumb-5 main-img">
                                    <img src="{{ asset('/') }}home dashboard_files/slider-1.png" alt="slider">
                                    <span class="tp-slider-thumb-5-gradient"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-category-area pt-110 pb-110">
        <div class="container">
            <div class="tp-section-title-wrapper-5 mb-50 text-center">
                <span class="tp-section-title-pre-5"> Shop by Category </span>
                <h3 class="section-title tp-section-title-5"><span>Popular</span> on the Shofy store. </h3>
            </div>
            <div class="row">
                @if (!empty($categories))
                    @foreach ($categories as $category)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="tp-category-item-5 p-relative z-index-1 fix mb-30">
                                <a href="{{ asset('/') }}products?category={{ $category->id }}">
                                    <div class="tp-category-thumb-5 include-bg"
                                        style="background-image: url({{ $category->image && file_exists(public_path('storage/' . $category->image)) ? asset('storage/' . $category->image) : asset('home dashboard_files/placeholder.png') }});">
                                    </div>
                                    <div class="tp-category-content-5">
                                        <h3 class="tp-category-title-5">{{ $category->name }}</h3>
                                        <span> {{ $category->products_count ?? 0 }} products </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="tp-product-area pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="tp-section-title-wrapper-5 mb-50">
                        <span class="tp-section-title-pre-5"> Trending Products </span>
                        <h3 class="section-title tp-section-title-5"> <span>Featured</span> Products </h3>
                    </div>
                </div>
            </div>
            <div class="row mb-30 row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                @if (!empty($featured_products))
                    @foreach ($featured_products as $product)
                        <div class="col">
                            @include('frontend.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="tp-product-area pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <div class="tp-section-title-wrapper-5 mb-50">
                        <span class="tp-section-title-pre-5"> New Collections </span>
                        <h3 class="section-title tp-section-title-5"> <span>New</span> Arrivals </h3>
                    </div>
                </div>
            </div>
            <div class="row mb-30 row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2">
                @if (!empty($new_arrivals))
                    @foreach ($new_arrivals as $product)
                        <div class="col">
                            @include('frontend.partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
