
@extends('frontend.layouts.app')
@section('title', 'Home')
@section('content')

@push('styles')
<style>
    :root {
        --zepto-purple: #9A16CA;
        --zepto-text-muted: #586274;
        --zepto-border: #eee;
        --zepto-green: #0c831f;
    }

    /* Iconic Navigation Bar */
    .__6E3Wm {
        background: #fff;
        border-bottom: 1px solid var(--zepto-border);
        position: sticky;
        top: 0px; /* STICKY LOCK: Aligns with Header bottom */
        z-index: 1000;
        width: 100%;
        overflow: hidden;
    }
    .PP02U {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }
    .embla__container {
        display: flex;
        gap: 15px;
        padding: 5px 0;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .embla__container::-webkit-scrollbar { display: none; }

    .__8pvtm {
        background: none;
        border: none;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 10px;
        cursor: pointer;
        white-space: nowrap;
        position: relative;
    }
    .__8pvtm img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }
    .c2zll {
        font-size: 14px;
        font-weight: 700;
        color: var(--zepto-text-muted);
    }
    .__8pvtm.active .c2zll {
        color: var(--zepto-purple) !important;
    }
    .mh28o {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--zepto-purple);
        border-radius: 3px 3px 0 0;
        opacity: 0;
        transform: scaleX(0);
        transition: 0.3s ease;
    }
    .__8pvtm.active .mh28o {
        opacity: 1;
        transform: scaleX(1);
    }

    /* Content Area */
    .tp-home-main-content {
        padding-top: 20px;
        padding-bottom: 60px;
    }
    .section-title-premium {
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 25px;
        color: #1a1a1a;
    }

    /* Category Slider (Grid Style) */
    .premium-cat-slider-wrap {
        position: relative;
        margin-bottom: 20px;
        padding: 0 30px;
    }
    
    /* Pre-initialization fix to prevent vertical stacking */
    .premium-cat-slider:not(.slick-initialized) {
        display: flex !important;
        overflow-x: hidden !important;
        flex-wrap: nowrap !important;
    }
    .premium-cat-slider:not(.slick-initialized) .cat-card-premium {
        flex: 0 0 auto !important;
    }
    .cat-card-premium {
        text-align: center;
        padding: 5px;
        width: 125px; /* Fixed width for packed alignment */
        outline: none !important;
        transition: transform 0.3s;
        margin-right: 10px;
    }
    .cat-card-premium:hover {
        transform: translateY(-3px);
    }
    .cat-card-inner {
        width: 110px;
        height: 110px;
        background: #f8f8f8;
        border-radius: 18px;
        margin-bottom: 8px; /* Removed auto to allow left alignment */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid #eee;
    }
    .cat-card-inner img {
        width: 75%;
        height: 75%;
        /* object-fit: cover; */
    }
    .cat-card-title {
        font-size: 13px;
        font-weight: 700;
        color: #1a1a1a;
        margin-top: 5px;
        line-height:1.2;
    }
    .cat-card-see-all {
        border: 1px dashed #ff3269;
        background: #fff5f7;
    }
    .cat-card-see-all i {
        font-size: 20px;
        color: #ff3269;
    }

    /* Slider Arrows */
    .cat-slider-btn {
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        width: 32px;
        height: 32px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 50%;
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: 0.3s;
    }
    .cat-slider-btn:hover { background: #333; transform: translateY(-50%) scale(1.1); }
    .cat-prev { left: 0; }
    .cat-next { right: 0; }
    
    @media (max-width: 768px) {
        .premium-cat-slider-wrap {
            padding: 0 10px;
            margin-bottom: 10px;
        }
        .cat-card-premium {
            width: 100px;
            margin-right: 8px;
        }
        .cat-card-inner {
            width: 90px;
            height: 90px;
        }
        .cat-prev { left: -5px; }
        .cat-next { right: -5px; }
        .cat-card-premium:last-of-type {
            margin-right: 20px; /* Extra space for the last card */
        }
    }
</style>
@endpush

<!-- Iconic Navigation Bar -->
<div class="__6E3Wm">
    <div class="PP02U">
        <div class="embla__container no-scrollbar">
            <a href="{{ url('/') }}" style="text-decoration:none">
                <button class="__8pvtm {{ !request('category') ? 'active' : '' }}">
                    <img src="https://cdn.zeptonow.com/production/inventory/banner/a767cf6e-9113-409b-b5ab-ac0d22a7db58.png" alt="All">
                    <span class="c2zll">All</span>
                    <div class="mh28o"></div>
                </button>
            </a>

            @if(isset($categories))
                @foreach ($categories as $cat)
                    <a href="{{ url('/') }}?category={{ $cat->slug }}" style="text-decoration:none">
                        <button class="__8pvtm {{ request('category') == $cat->slug ? 'active' : '' }}">
                            <img src="https://cdn.zeptonow.com/production/inventory/banner/a767cf6e-9113-409b-b5ab-ac0d22a7db58.png" alt="{{ $cat->name }}">
                            <span class="c2zll">{{ $cat->name }}</span>
                            <div class="mh28o"></div>
                        </button>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="container tp-home-main-content">
    @if(!request('category'))
        {{-- Default Landing View --}}

        <div class="premium-cat-slider-wrap">
            <button class="cat-slider-btn cat-prev"><i class="fas fa-chevron-left"></i></button>
            <div class="premium-cat-slider">
                @if(isset($categories))
                    @foreach($categories as $cat)
                        <div class="cat-card-premium">
                            <a href="{{ url('/') }}?category={{ $cat->slug }}" style="text-decoration:none">
                                <div class="cat-card-inner">
                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $cat->image }}" 
                                         onerror="this.src='https://cdn.zeptonow.com/production/inventory/banner/a767cf6e-9113-409b-b5ab-ac0d22a7db58.png'" 
                                         alt="{{ $cat->name }}">
                                </div>
                                <div class="cat-card-title">{{ $cat->name }}</div>
                            </a>
                        </div>
                    @endforeach
                @endif
                {{-- See All Card --}}
                <div class="cat-card-premium">
                    <a href="{{ url('/categories') }}" style="text-decoration:none">
                        <div class="cat-card-inner cat-card-see-all">
                             <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="cat-card-title" style="color:#ff3269">See All</div>
                    </a>
                </div>
            </div>
            <button class="cat-slider-btn cat-next"><i class="fas fa-chevron-right"></i></button>
        </div>

        <h3 class="section-title-premium">Trending Now</h3>
        <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
            @foreach(($trending_products ?? []) as $product)
            <div class="col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>
    @else
        {{-- Category View --}}
        <h3 class="section-title-premium">{{ $active_category->name ?? 'Category' }}</h3>
        
        @if($category_products && $category_products->count() > 0)
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-4">
                @foreach($category_products as $product)
                <div class="col">
                    @include('frontend.partials.product-card-grid', ['product' => $product])
                </div>
                @endforeach
            </div>
            <div class="mt-5">
                {{ $category_products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <img src="{{ asset('home/empty-cart.png') }}" alt="Empty" style="width: 120px; opacity: 0.6;">
                </div>
                <h4 style="font-weight: 800; color: #1a1a1a;">No products found</h4>
                <p style="color: #666;">We couldn't find any products in this category right now.</p>
                <a href="{{ url('/') }}" class="btn mt-3" style="background: #ff3269; color: #fff; font-weight: 800; border-radius: 8px; padding: 10px 25px;">Go Back</a>
            </div>
        @endif
    @endif
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Slick Slider for Categories
        $('.premium-cat-slider').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 9,
            slidesToScroll: 3,
            variableWidth: true, // Packs cards to the left
            prevArrow: $('.cat-prev'),
            nextArrow: $('.cat-next'),
            responsive: [
                {
                    breakpoint: 1400,
                    settings: { slidesToShow: 7 }
                },
                {
                    breakpoint: 1200,
                    settings: { slidesToShow: 6 }
                },
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 5 }
                },
                {
                    breakpoint: 768,
                    settings: { slidesToShow: 4 }
                },
                {
                    breakpoint: 576,
                    settings: { slidesToShow: 3 }
                }
            ]
        });
    });
</script>
@endpush

@endsection