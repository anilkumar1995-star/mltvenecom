@extends('frontend.layouts.app')

@section('title', $category->name . ' - Shofy E-commerce')

@section('content')
<!-- breadcrumb area start -->
<section class="breadcrumb__area include-bg pt-100 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__content p-relative z-index-1">
                    <h3 class="breadcrumb__title">{{ $category->name }}</h3>
                    <div class="breadcrumb__list">
                        <span><a href="{{ route('frontend.home') }}">Home</a></span>
                        <span>{{ $category->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb area end -->

<section class="tp-product-area pb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="tp-shop-main-wrapper">
                    <div class="tp-shop-top mb-45">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="tp-shop-top-left d-flex align-items-center">
                                    <div class="tp-shop-top-result">
                                        <p>Showing 1–{{ $products->count() }} of {{ $products->total() }} results</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tp-shop-items-wrapper tp-shop-item-primary">
                        <div class="row infinite-container">
                            @forelse($products as $product)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 infinite-item">
                                    @include('frontend.partials.product-card-grid', ['product' => $product])
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <div class="tp-error-content">
                                            <h4 class="tp-error-title">No products found</h4>
                                            <p>No products found in this category.</p>
                                            <a href="{{ route('frontend.home') }}" class="tp-btn-green">Back to Home</a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="tp-shop-pagination mt-20">
                        <div class="tp-pagination">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
