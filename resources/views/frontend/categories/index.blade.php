@extends('frontend.layouts.app')
@section('title', 'Categories - Shop by Department')

@section('content')
<main style="background: #fff;">
    <div class="container py-4 pb-30">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-800 m-0" style="color: #1a1a1a; letter-spacing: -0.5px;">All Categories</h4>
            <div class="small text-muted">{{ count($categories) }} total categories</div>
        </div>

        <div class="row g-2 row-cols-3 row-cols-sm-4 row-cols-md-6 row-cols-lg-8 row-cols-xl-10">
            @foreach ($categories as $index => $category)
                @php
                    $imageUrl = $category->image ? (str_starts_with($category->image, 'http') ? $category->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->image, '/')) : asset('home/placeholder.png');
                @endphp
                <div class="col">
                    <a href="{{ route('frontend.categories.show', $category->slug) }}" class="zepto-category-card text-decoration-none">
                        <div class="zepto-cat-icon-box">
                            <img src="{{ $imageUrl }}" alt="{{ $category->name }}">
                        </div>
                        <h6 class="zepto-cat-name">{{ $category->name }}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</main>

<style>
    .fw-800 { font-weight: 800; }
    
    .zepto-category-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        transition: transform 0.2s ease;
        text-align: center;
        margin-bottom: 5px;
    }

    .zepto-category-card:hover {
        transform: translateY(-4px);
    }

    .zepto-cat-icon-box {
        width: 100%;
        aspect-ratio: 1/1;
        background: #f2f4f6;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        overflow: hidden;
        transition: background 0.2s ease;
        margin: 0 auto;
    }

    .zepto-category-card:hover .zepto-cat-icon-box {
        background: #e9ecef;
    }

    .zepto-cat-icon-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));
    }

    .zepto-cat-name {
        font-size: 11px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        line-height: 1.2;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        height: 28px;
    }

    @media (max-width: 575px) {
        .zepto-cat-icon-box {
            padding: 8px;
            border-radius: 10px;
            max-width: 85px;
        }
        .zepto-cat-name {
            font-size: 10px;
            height: 24px;
        }
    }
</style>
@endsection

