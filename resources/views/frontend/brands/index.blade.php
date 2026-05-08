@extends('frontend.layouts.app')
@section('title', 'All Brands')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pb-20 mb-20 pt-20 text-start page_speed_272179630">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Brands</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Brands </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-40 pt-20">
        <div class="container">
            <div class="tp-brand-area">
                <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 row-cols-xl-6 g-4">
                    @forelse($brands as $brand)
                        @php
                            $imageUrl = $brand->logo ? (str_starts_with($brand->logo, 'http') ? $brand->logo : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($brand->logo, '/')) : asset('home/placeholder.png');
                        @endphp
                        <div class="col">
                            <div class="tp-brand-item text-center p-4 bg-white rounded-4 shadow-sm h-100 d-flex flex-column align-items-center justify-content-center border transition-3">
                                <a href="{{ route('frontend.brands.show', $brand->slug ?: $brand->id) }}" title="{{ $brand->name }}" class="d-block mb-3">
                                    <img src="{{ $imageUrl }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height: 80px; width: auto; object-fit: contain;">
                                </a>
                                <h6 class="mt-auto mb-0 text-center">
                                    <a href="{{ route('frontend.brands.show', $brand->slug ?: $brand->id) }}" title="{{ $brand->name }}" class="text-dark text-decoration-none fw-bold hover-primary">
                                        {{ $brand->name }}
                                    </a>
                                </h6>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info">No brands found.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('styles')
<style>
    .tp-brand-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08) !important;
        border-color: var(--primary-color) !important;
    }
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
</style>
@endpush
