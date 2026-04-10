@extends('frontend.layouts.app')
@section('title', 'My Wishlist')
@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
        position: relative;
    }
    .breadcrumb__title {
        font-size: 40px;
        font-weight: 600;
        color: #010f1c;
        margin-bottom: 5px;
    }
    .breadcrumb__list span {
        font-size: 14px;
        color: #55585b;
        position: relative;
    }
    .breadcrumb__list span:not(:last-child)::after {
        content: ".";
        margin: 0 10px;
        font-weight: 700;
    }
    .breadcrumb__list span a {
        color: #010f1c;
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pt-40 pb-40 mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">My Wishlist</h3>
                        <div class="breadcrumb__list">
                           <span><a href="{{ route('frontend.home') }}">Home</a></span>
                           <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container pb-100">

    @if($products->isEmpty())
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="far fa-heart fa-4x text-muted opacity-50"></i>
            </div>
            <h4 class="fw-bold text-dark">Your wishlist is empty</h4>
            <p class="text-muted mb-4">You haven't added any products to your wishlist yet.</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary px-5 py-3 fw-bold" style="border-radius: 8px;">
                Start Browsing
            </a>
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-6">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>
    @endif
    </div>
</main>
@endsection
