@extends('frontend.layouts.app')
@section('title', 'All Categories')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 mb-30 text-start pt-30 page_speed_1872106736">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Categories</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Categories </span>
                </div>
            </div>
        </div>
    </section>

    <div class="tp-category-page-area pb-110">
        <div class="container">
            <div class="row g-4">
                @php
                    $bgColors = ['#f0f8f1', '#fef1f1', '#f2fce4', '#fefce8', '#f2f3ff', '#f9f1ff', '#fff0f5'];
                @endphp
                @foreach ($categories as $index => $category)
                    @php
                        $bgColor = $bgColors[$index % count($bgColors)];
                        $imageUrl = $category->image ? (str_starts_with($category->image, 'http') ? $category->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->image, '/')) : asset('home/placeholder.png');
                    @endphp
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="tp-category-item-5 p-relative z-index-1 mb-30 shadow-sm category-card-custom"
                            style="background-color: {{ $bgColor }}; border-radius: 20px; overflow: hidden; height: 320px !important;">
                            <a href="{{ route('frontend.categories.show', $category->slug) }}"
                                class="d-flex flex-column align-items-center p-4 h-100 text-decoration-none">
                                
                                <div class="tp-category-content-5 text-center mt-3" style="position: relative; z-index: 5;">
                                    <h3 class="tp-category-title-5 fw-bold mb-1" style="font-size: 20px; color: #010f1c;">{{ $category->name }}</h3>
                                    <span style="font-size: 14px; color: #55585b; display: block;">{{ $category->products_count ?? 0 }} products</span>
                                </div>
                                
                                <div class="tp-category-thumb-5-custom mt-auto pb-4" style="width: 100%; display: flex; align-items: center; justify-content: center; z-index: 1;">
                                    <img src="{{ $imageUrl }}" alt="{{ $category->name }}" 
                                        style="max-height: 140px; width: auto; max-width: 90%; object-fit: contain; transition: transform 0.5s ease; filter: drop-shadow(0 15px 15px rgba(0,0,0,0.1));">
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

@endsection

@push('styles')
<style>
    /* Reset theme-specific absolute positioning for our category cards */
    .category-card-custom .tp-category-thumb-5-custom {
        position: relative !important;
        transform: none !important;
        top: auto !important;
        left: auto !important;
    }
    
    .category-card-custom {
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1) !important;
        border: 1px solid transparent;
    }
    
    .category-card-custom:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        border-color: rgba(0,0,0,0.05);
    }
    
    .category-card-custom:hover img {
        transform: scale(1.1);
    }
    
    .tp-category-title-5 {
        transition: color 0.3s ease;
    }
    
    .category-card-custom:hover .tp-category-title-5 {
        color: var(--primary-color) !important;
    }

    .breadcrumb__area {
        background-color: #f3f3f3;
    }
</style>
@endpush
