
@extends('frontend.layouts.app')
@section('title', 'Groceries, Fresh Produce & Daily Essentials')
@section('content')

@push('styles')
<style>
    :root {
        --zepto-purple: #9A16CA;
        --zepto-text-muted: #586274;
        --zepto-border: #eee;
        --zepto-green: #0c831f;
    }

    /* Minimal custom CSS only for specialized branding colors/backgrounds */
    .bg-zepto-light { background: #f3f0ff !important; }
    .bg-zepto-purple { background: #9A16CA !important; }
    .text-zepto-purple { color: #9A16CA !important; }
    .border-zepto-purple { border-color: #9A16CA !important; }
    .bg-paan-stadium { 
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
    }
    .letter-spacing-1 { letter-spacing: 1px; }
    .floating-asset {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 150px;
        filter: drop-shadow(0 15px 15px rgba(0,0,0,0.3));
        transition: 0.3s ease;
    }
    .promo-card:hover .floating-asset { transform: translateY(-5px); }

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
    }

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

    /* AGGRESSIVE SCROLLBAR HIDE */
    .premium-product-row, 
    .embla__container, 
    .no-scrollbar {
        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }

    .premium-product-row::-webkit-scrollbar, 
    .embla__container::-webkit-scrollbar, 
    .no-scrollbar::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        background: transparent !important;
        -webkit-appearance: none !important;
    }

    /* Horizontal Product Scrolling */
    .premium-product-row {
        display: flex;
        overflow-x: auto;
        flex-wrap: nowrap;
        gap: 15px;
        padding: 5px 2px 10px 2px;
        -webkit-overflow-scrolling: touch;
    }
    .premium-product-row .product-col {
        flex: 0 0 200px;
        width: 200px;
        max-width: 200px;
    }
    @media (max-width: 768px) {
        .premium-product-row {
            gap: 10px;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: -15px;
            margin-right: -15px;
        }
        .premium-product-row .product-col {
            flex: 0 0 160px;
            width: 160px;
            max-width: 160px;
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
        <div class="row g-4 mb-5">
            <!-- Card 1: Zepto Experience -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 bg-zepto-light promo-card">
                    <div class="card-body p-4">
                        <p class="fw-bold text-uppercase small mb-4 letter-spacing-1 opacity-75">ALL <span class="text-zepto-purple">NEW</span> EXPERIENCE</p>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-6">
                                <div class="bg-white p-4 rounded-4 shadow-sm border border-light-subtle d-flex align-items-center gap-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/3081/3081840.png" width="40">
                                    <span class="fw-bold h4 mb-0">₹0 FEES</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="bg-white p-4 rounded-4 shadow-sm border border-light-subtle d-flex align-items-center gap-3">
                                    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331941.png" width="40">
                                    <div>
                                        <div class="small fw-bold text-muted text-uppercase" style="font-size: 0.6rem;">EVERYDAY</div>
                                        <div class="fw-bold h5 mb-0">LOWEST PRICES</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-top d-flex flex-wrap gap-4">
                            <div class="small fw-bold text-muted"><i class="fas fa-check-circle text-success me-2"></i> ₹0 Handling Fee</div>
                            <div class="small fw-bold text-muted"><i class="fas fa-check-circle text-success me-2"></i> ₹0 Delivery Fee*</div>
                            <div class="small fw-bold text-muted"><i class="fas fa-check-circle text-success me-2"></i> ₹0 Surge Fee</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Paan Corner -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-5 overflow-hidden h-100 bg-paan-stadium text-white promo-card">
                    <div class="card-body p-4 position-relative d-flex flex-column justify-content-center" style="min-height: 280px;">
                        <div class="z-index-1">
                            <h1 class="display-4 fw-bold mb-2">Paan Corner</h1>
                            <p class="h6 fw-normal mb-4 opacity-75" style="max-width: 400px;">Get smoking accessories, fresheners & more in Minutes this IPL!</p>
                            <a href="{{ url('/categories') }}" class="btn btn-light btn-sm rounded-pill px-4 fw-bold py-2 shadow">Order now</a>
                        </div>
                        
                        <img src='https://cdn-icons-png.flaticon.com/512/3081/3081840.png'
                             class="floating-asset d-block" 
                             style="max-height: 160px; width: auto;">
                    </div>
                </div>
            </div>
        </div>


        <div class="d-flex align-items-center justify-content-between mb-15">
            <h3 class="section-title-premium mb-0">Trending Now</h3>
            <a href="{{ url('/products') }}" style="color: #ff3269; font-weight: 800; font-size: 14px; text-decoration: none;">See all <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 4px;"></i></a>
        </div>
        <div class="premium-product-row mb-30">
            @foreach(($trending_products ?? [])->take(20) as $product)
            <div class="product-col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>

        @if(isset($new_arrivals) && $new_arrivals->count() > 0)
        <div class="d-flex align-items-center justify-content-between mb-15">
            <h3 class="section-title-premium mb-0">New Arrivals</h3>
            <a href="{{ url('/products') }}" style="color: #ff3269; font-weight: 800; font-size: 14px; text-decoration: none;">See all <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 4px;"></i></a>
        </div>
        <div class="premium-product-row mb-30">
            @foreach($new_arrivals as $product)
            <div class="product-col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>
        @endif

        @if(isset($on_sale) && $on_sale->count() > 0)
        <div class="d-flex align-items-center justify-content-between mb-15">
            <h3 class="section-title-premium mb-0">Deals for You</h3>
            <a href="{{ url('/products') }}" style="color: #ff3269; font-weight: 800; font-size: 14px; text-decoration: none;">See all <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 4px;"></i></a>
        </div>
        <div class="premium-product-row mb-30">
            @foreach($on_sale as $product)
            <div class="product-col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>
        @endif

         <!--
        @foreach($categories as $cat)
            @if($cat->products->count() > 0)
                <div class="d-flex align-items-center justify-content-between mb-15">
                    <h3 class="section-title-premium mb-0">{{ $cat->name }}</h3>
                    <a href="{{ url('/') }}?category={{ $cat->slug }}" style="color: #ff3269; font-weight: 800; font-size: 14px; text-decoration: none;">See all <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 4px;"></i></a>
                </div>
                <div class="premium-product-row mb-40">
                    @foreach($cat->products as $product)
                    <div class="product-col">
                        @include('frontend.partials.product-card-grid', ['product' => $product])
                    </div>
                    @endforeach
                </div>
            @endif
        @endforeach  -->

        <!-- How it Works Section -->
        <div class="my-5 py-4">
            <div class="container">
                <h2 class="text-center fw-bold mb-5">How it Works</h2>
                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                            <div class="mb-4 d-flex justify-content-center">
                                <img src='https://cdn-icons-png.flaticon.com/512/3437/3437364.png' alt="Open the website" style="height: 120px; width: auto;">
                            </div>
                            <h4 class="fw-bold mb-3">Open the website</h4>
                            <p class="text-muted small">Choose from over 7000 products across groceries, fresh fruits & veggies, meat, pet care, beauty items & more</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                            <div class="mb-4 d-flex justify-content-center">
                                <img src='https://cdn-icons-png.flaticon.com/512/3500/3500833.png' alt="Place an order" style="height: 120px; width: auto;">
                            </div>
                            <h4 class="fw-bold mb-3">Place an order</h4>
                            <p class="text-muted small">Add your favourite items to the cart & avail the best offers</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                            <div class="mb-4 d-flex justify-content-center">
                                <img src='https://cdn-icons-png.flaticon.com/512/2830/2830305.png' alt="Get free delivery" style="height: 120px; width: auto;">
                            </div>
                            <h4 class="fw-bold mb-3">Get free delivery</h4>
                            <p class="text-muted small">Experience lighting-fast speed & get all your items delivered in minutes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Category View --}}
        <h3 class="section-title-premium mb-1">{{ $active_category->name }}</h3>
        
        {{-- Subcategory Quick Filters --}}
        @php 
            $subcategories = \App\Models\EcProductCategory::where('parent_id', $active_category->id)->published()->get();
            $current_sub = request('subcategory', 'all');
        @endphp
        
        @if($subcategories->count() > 0)
            <div class="embla__container no-scrollbar mb-4 mt-2" style="gap: 10px; border-bottom: none;">
                {{-- Show All link as the first badge --}}
                <a href="{{ url('/') }}?category={{ $active_category->slug }}&subcategory=all" style="text-decoration:none">
                    <button class="btn btn-sm rounded-pill px-3 py-1 border {{ $current_sub == 'all' ? 'bg-zepto-purple text-white border-zepto-purple' : 'bg-white text-muted border-light-subtle' }}" 
                            style="font-weight: 700; font-size: 13px; white-space: nowrap;">
                        All
                    </button>
                </a>

                @foreach($subcategories as $sub)
                    <a href="{{ url('/') }}?category={{ $active_category->slug }}&subcategory={{ $sub->slug }}" style="text-decoration:none">
                        <button class="btn btn-sm rounded-pill px-3 py-1 border {{ $current_sub == $sub->slug ? 'bg-zepto-purple text-white border-zepto-purple' : 'bg-white text-muted border-light-subtle' }}" 
                                style="font-weight: 700; font-size: 13px; white-space: nowrap;">
                            {{ $sub->name }}
                        </button>
                    </a>
                @endforeach
            </div>
        @endif
        
        @if($category_products && $category_products->count() > 0)
            <div class="premium-product-row">
                @foreach($category_products as $product)
                <div class="product-col">
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