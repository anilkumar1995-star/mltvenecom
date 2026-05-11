    @extends('frontend.layouts.app')

    @section('title', $product->name . ' - Shofy')

    @push('styles')
    <style>
        .product-details-area { padding-top: 50px; padding-bottom: 100px; }
        .align-items-start { align-items: flex-start !important; }
        
        /* Breadcrumb */
        .breadcrumb__area { background: #f0f2f5; padding: 20px 0; margin-bottom: 50px; }
        .breadcrumb__list span { font-size: 14px; color: #55585b; }
        .breadcrumb__list span a { color: #55585b; text-decoration: none; }
        .breadcrumb__list span a:hover { color: var(--primary-color); }
        
        /* Gallery */
        .product-custom-gallery { display: flex; gap: 20px; }
        .product-thumbnails { display: flex; flex-direction: column; gap: 10px; width: 100px; }
        .product-thumbnails img { 
            width: 100%; height: 100px; object-fit: cover; cursor: pointer; 
            border: 1px solid #e5e6e8; border-radius: 6px; transition: .3s;
        }
        .product-thumbnails img:hover, .product-thumbnails img.active { border-color: var(--primary-color); }
        .product-main-image { flex: 1; border: 1px solid #e5e6e8; border-radius: 10px; overflow: hidden; position: relative; }
        .product-main-image img { width: 100%; height: auto; display: block; }
        .product-badge { position: absolute; top: 20px; left: 20px; z-index: 2; padding: 5px 10px; font-weight: 600; font-size: 14px; border-radius: 4px; }
        
        /* Product Info */
        .product-brand { font-size: 16px; color: #55585b; margin-bottom: 5px; display: block; text-decoration: none; }
        .product-brand:hover { color: var(--primary-color); }
        
        .product__details-title { font-size: 32px; font-weight: 500; margin-bottom: 15px; color: #010f1c; font-family: 'Jost', sans-serif; }
        .product__details-price { margin-bottom: 25px; }
        .product__details-price .new-price { font-size: 30px; font-weight: 600; color: #010f1c; }
        .product__details-price .old-price { font-size: 20px; font-weight: 400; color: #767a7d; text-decoration: line-through; margin-left: 10px; }
        
        /* Countdown */
        .tp-product-details-countdown {
            background: rgba(253, 75, 107, 0.05);
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 30px;
            border: 1px solid rgba(253, 75, 107, 0.1);
        }
        .tp-product-details-countdown h4 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #010f1c;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .tp-product-details-countdown-time {
            display: flex;
            gap: 15px;
        }
        .tp-product-details-countdown-item {
            background: #fff;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            min-width: 60px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        }
        .tp-product-details-countdown-item span { font-size: 18px; font-weight: 600; color: #010f1c; display: block; line-height: 1; }
        .tp-product-details-countdown-item p { font-size: 12px; color: #55585b; margin: 0; }

        .product__details-stock { margin-bottom: 25px; }
        .product__details-stock span { color: #678E61; font-weight: 500; }
        
        .product__details-action { display: flex; gap: 15px; align-items: center; margin-bottom: 35px; flex-wrap: wrap; }
        .product__quantity { 
            width: 120px; height: 50px; border: 1px solid #e5e6e8; border-radius: 6px; 
            display: flex; align-items: center; justify-content: space-between; padding: 0 15px; 
        }
        .product__quantity input { border: none; width: 40px; text-align: center; font-weight: 600; }
        .product__quantity button { background: none; border: none; font-size: 18px; cursor: pointer; color: #010f1c; }
        
        .tp-btn { 
            background-color: #010f1c; color: #fff; padding: 12px 40px; 
            font-weight: 600; border-radius: 6px; border: none; transition: .3s;
            height: 50px; font-family: 'Jost', sans-serif;
        }
        .tp-btn:hover { background-color: var(--primary-color); color: #fff; }

        .tp-btn-buy-now {
            background-color: #678E61; color: #fff; border: none; padding: 12px 40px; 
            font-weight: 600; border-radius: 6px; height: 50px; transition: .3s; flex-grow: 1; text-align: center; max-width: 200px;
        }
        .tp-btn-buy-now:hover { background-color: #557550; color: #fff; }

        /* Wishlist & Compare */
        .product-details-action-sm { display: flex; gap: 20px; margin-top: 20px; font-size: 14px; font-weight: 500; }
        .product-details-action-sm a { color: #55585b; text-decoration: none; display: flex; align-items: center; gap: 5px; }
        .product-details-action-sm a:hover { color: var(--primary-color); }

        /* Meta & Share */
        .product__details-meta { margin-top: 30px; border-top: 1px solid #e5e6e8; padding-top: 20px; }
        .tp-product-details-social { display: flex; align-items: center; gap: 10px; margin-top: 10px; }
        .tp-product-details-social span { font-weight: 600; color: #010f1c; }
        .tp-product-details-social a { 
            width: 36px; height: 36px; border-radius: 50%; border: 1px solid #e5e6e8; 
            display: flex; align-items: center; justify-content: center; color: #55585b; transition: .3s; text-decoration: none; font-size: 14px;
        }
        .tp-product-details-social a:hover { background: var(--primary-color); color: #fff; border-color: var(--primary-color); }

        /* Service Features */
        .tp-product-details-msg { 
            background-color: #f9f9f9; padding: 20px; border-radius: 6px; margin-top: 30px; 
        }
        .tp-product-details-msg ul { list-style: none; padding: 0; margin: 0; }
        .tp-product-details-msg ul li { margin-bottom: 10px; font-size: 14px; color: #55585b; display: flex; align-items: center; gap: 10px; }
        .tp-product-details-msg ul li:last-child { margin-bottom: 0; }
        .tp-product-details-msg ul li i { color: var(--primary-color); }

        .tp-product-details-payment { margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e6e8; }
        .tp-product-details-payment img { max-width: 100%; margin-top: 10px; }

        /* Tabs */
        .product-details-tab-nav { border-bottom: 1px solid #e5e6e8; margin-bottom: 40px; }
        .product-details-tab-nav .nav-link { 
            border: none; border-bottom: 2px solid transparent; color: #55585b; 
            font-size: 18px; font-weight: 600; padding: 10px 30px; margin-bottom: -1px;
        }
        .product-details-tab-nav .nav-link.active { color: var(--primary-color); border-bottom-color: var(--primary-color); background: none; }

        /* Frequently Bought Together */
        .tp-frequently-bought-together { margin-top: 50px; background: #f9f9f9; padding: 30px; border-radius: 10px; }
        .tp-frequently-bought-header { font-size: 20px; font-weight: 600; margin-bottom: 20px; }
        .tp-frequently-list { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
        .tp-frequently-item { display: flex; align-items: center; gap: 10px; background: #fff; padding: 10px; border-radius: 6px; border: 1px solid #e5e6e8; }
        .tp-frequently-item img { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; }
        .tp-frequently-plus { font-size: 20px; color: #55585b; }
        
        /* Related Products */
        .tp-related-product-area { margin-top: 100px; }
        .tp-section-title { font-size: 36px; font-weight: 600; margin-bottom: 40px; text-align: center; }

        /* Sticky Bar */
        .sticky-add-cart-bar {
            position: fixed; bottom: -100px; left: 0; width: 100%; background: #fff;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.05); z-index: 999; padding: 15px 0;
            transition: bottom 0.4s ease;
        }
        .sticky-add-cart-bar.visible { bottom: 0; }
        .sticky-thumb { width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #e5e6e8; }

        /* Review Form Stars */
        .tp-product-details-review-form-rating-icon { display: flex; gap: 5px; color: #d5d5d5; cursor: pointer; font-size: 20px; }
        .tp-product-details-review-form-rating-icon .star-item.active,
        .tp-product-details-review-form-rating-icon .star-item:hover,
        .tp-product-details-review-form-rating-icon .star-item.hover { color: #ffb21d; }
        .tp-product-details-review-input-item textarea { width: 100%; height: 120px; border: 1px solid #e5e6e8; border-radius: 6px; padding: 15px; margin-bottom: 20px; }
    </style>
    @endpush

    @section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb__area">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content">
                        <h3 class="breadcrumb__title">Product Details</h3>
                        <div class="breadcrumb__list">
                            <span><a href="{{ route('frontend.home') }}">Home</a></span>
                            <span><i class="far fa-angle-right"></i></span>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Details Area -->
    <section class="product-details-area">
        <div class="container">
            <div class="row align-items-start">
                <!-- Gallery -->
                <div class="col-lg-6">
                    <div class="product-custom-gallery">
                        <div class="product-thumbnails">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" class="active" onclick="changeMainImage(this.src, this)">
                            @endif
                            @foreach($product->gallery_image_urls as $imgUrl)
                                <img src="{{ $imgUrl }}" onclick="changeMainImage(this.src, this)">
                            @endforeach
                        </div>
                        <div class="product-main-image">
                            @if($product->isOnSale())
                                <span class="badge bg-primary product-badge">-{{ $product->getDiscountPercentage() }}%</span>
                            @endif
                            <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product__details-wrapper">
                        @if($product->brand)
                            <a href="#" class="product-brand">{{ $product->brand->name }}</a>
                        @endif

                        <h3 class="product__details-title">{{ $product->name }}</h3>

                        <div style="font-size: 16px; color: #666; margin-bottom: 15px; font-weight: 500;">
                            @if($product->weight > 0)
                                1 pack ({{ (float)$product->weight }} {{ $product->unit_type ?: 'kg' }})
                            @else
                                1 unit
                            @endif
                        </div>
                        
                        <div class="product__details-rating d-flex align-items-center mb-3">
                            <div class="rating-star me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= round($product->reviews()->avg('star') ?? 0) ? 'fas' : 'far' }} fa-star text-warning"></i>
                                @endfor
                            </div>
                            <span class="text-muted">({{ $product->reviews()->count() }} Reviews)</span>
                        </div>

                        <div class="product__details-price">
                            @if($product->isOnSale())
                                <span class="new-price">₹{{ number_format($product->sale_price, 0) }}</span>
                                <span class="old-price">₹{{ number_format($product->price, 0) }}</span>
                            @else
                                <span class="new-price">₹{{ number_format($product->price, 0) }}</span>
                            @endif
                            <span class="ms-2 text-success small">{{ $product->quantity }} products available</span>
                        </div>

                        @if($product->end_date && $product->end_date > now())
                        <div class="tp-product-details-countdown">
                            <h4><i class="fas fa-fire-alt text-danger me-2"></i> Flash Sale end in:</h4>
                            <div class="tp-product-details-countdown-time" id="countdown-timer" data-end-date="{{ $product->end_date }}">
                                <div class="tp-product-details-countdown-item"><span id="days">00</span><p>Days</p></div>
                                <div class="tp-product-details-countdown-item"><span id="hours">00</span><p>Hours</p></div>
                                <div class="tp-product-details-countdown-item"><span id="minutes">00</span><p>Mins</p></div>
                                <div class="tp-product-details-countdown-item"><span id="seconds">00</span><p>Secs</p></div>
                            </div>
                        </div>
                        @endif

                        <div class="product__details-description mb-4 text-muted">
                            <p>{{ Str::limit(strip_tags($product->description), 150) }}</p>
                        </div>



                        <div class="tp-product-details-action-wrapper mb-4">
                            @php
                                $cart = session()->get('cart', []);
                                $qtyInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
                            @endphp

                            <div class="action-state-container" data-product-id="{{ $product->id }}">
                                <!-- ADD Button State -->
                                <div class="add-btn-state {{ $qtyInCart > 0 ? 'd-none' : '' }}">
                                    <button type="button" class="tp-product-details-add-btn" onclick="handleInitialAdd(this)">
                                        ADD
                                    </button>
                                </div>

                                <!-- Quantity Selector State -->
                                <div class="qty-selector-state {{ $qtyInCart > 0 ? '' : 'd-none' }}">
                                    <div class="tp-product-details-quantity-box">
                                        <span class="qty-control minus" onclick="updateDetailedQty(-1)">-</span>
                                        <input type="text" class="qty-input" id="detailed-qty-input" value="{{ $qtyInCart > 0 ? $qtyInCart : ($product->minimum_order_quantity > 0 ? $product->minimum_order_quantity : 1) }}" readonly>
                                        <span class="qty-control plus" onclick="updateDetailedQty(1)">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            .action-state-container {
                                max-width: 180px;
                            }
                            
                            /* Initial ADD Button - Matches Homepage Card */
                            .tp-product-details-add-btn {
                                width: 100%;
                                height: 46px;
                                background: #fff;
                                border: 1.5px solid #ff3269;
                                color: #ff3269;
                                font-weight: 800;
                                font-size: 16px;
                                border-radius: 10px;
                                cursor: pointer;
                                transition: all 0.2s ease;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                text-transform: uppercase;
                                box-shadow: 0 4px 10px rgba(255, 50, 105, 0.1);
                            }
                            .tp-product-details-add-btn:hover {
                                background: #fff5f7;
                                transform: translateY(-1px);
                                box-shadow: 0 6px 15px rgba(255, 50, 105, 0.15);
                            }

                            /* Quantity Selector Box - Matches Homepage Card */
                            .tp-product-details-quantity-box {
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                background: #ff3269;
                                border-radius: 10px;
                                height: 46px;
                                padding: 0 5px;
                                color: #fff;
                                transition: all 0.3s ease;
                                box-shadow: 0 4px 12px rgba(255, 50, 105, 0.3);
                            }
                            .qty-control {
                                width: 40px;
                                height: 100%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                cursor: pointer;
                                color: #fff;
                                font-size: 20px;
                                font-weight: 700;
                                transition: background 0.2s;
                            }
                            .qty-control:hover {
                                background: rgba(255, 255, 255, 0.15);
                            }
                            .qty-input {
                                background: transparent;
                                border: none;
                                color: #fff;
                                width: 50px;
                                text-align: center;
                                font-weight: 800;
                                font-size: 20px;
                            }
                            .qty-input:focus { outline: none; }
                        </style>



                        <div class="product-details-action-sm">
                            <a href="#"><i class="fal fa-exchange"></i> Compare</a>
                            @php
                                $wishlist = session('wishlist', []);
                                $inWishlist = isset($wishlist[$product->id]);
                            @endphp
                            <a href="#" class="tp-wishlist-btn" data-id="{{ $product->id }}">
                                <i class="{{ $inWishlist ? 'fas text-danger' : 'far' }} fa-heart"></i> 
                                <span class="wishlist-text">{{ $inWishlist ? 'Wishlisted' : 'Add Wishlist' }}</span>
                            </a>
                        </div>

                        <div class="product__details-meta">
                            <div class="mb-2"><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</div>
                            @if($product->barcode)
                                <div class="mb-2"><strong>Barcode:</strong> {{ $product->barcode }}</div>
                            @endif
                            <div class="mb-2"><strong>Category:</strong> 
                                @foreach($product->categories as $category)
                                    <a href="{{ route('frontend.categories.show', $category->slug) }}" class="text-muted">{{ $category->name }}</a>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                            <div class="mb-2"><strong>Tag:</strong> 
                                @foreach($product->tags as $tag)
                                    <a href="#" class="text-muted">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </div>
                            <div class="tp-product-details-social">
                                <span>Share:</span>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                        
                        <div class="tp-product-details-msg">
                            <ul>
                                <li> 30 days easy returns</li>
                                <li> Order yours before 2.30pm for same day dispatch</li>
                                <li> Guaranteed safe & secure checkout</li>
                            </ul>
                        </div>

                        <div class="tp-product-details-payment">
                            <img src="{{ asset('home/footer-pay.png') }}" alt="Payment">
                        </div>
                    </div>
                </div>
            </div>

            @if($product->crossSellingProducts->count() > 0)
            <!-- Frequently Bought Together (Card Style) -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="tp-frequently-bought-wrapper mb-4">
                        <h4 class="tp-frequently-bought-header mb-4">Frequently Bought Together</h4>
                        
                        <form id="frequently-bought-form" action="{{ route('frontend.cart.add') }}" method="POST" class="d-flex flex-wrap align-items-center gap-3">
                            @csrf
                            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
                            
                            <!-- Main Product Card -->
                            <div class="tp-frequently-card">
                                <div class="tp-frequently-check">
                                    <input type="checkbox" checked disabled>
                                </div>
                                <div class="tp-frequently-img-wrapper">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                                </div>
                                <div class="tp-frequently-content">
                                    <h6 class="tp-frequently-title text-truncate" style="max-width: 150px;" title="{{ $product->name }}">{{ $product->name }}</h6>
                                    <span class="tp-frequently-price">₹{{ number_format($product->final_price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Plus Sign -->
                            <div class="tp-frequently-plus">
                                <i class="fal fa-plus"></i>
                            </div>

                            <!-- Cross Sell Products -->
                            @foreach($product->crossSellingProducts as $crossProduct)
                                <div class="tp-frequently-card">
                                    <div class="tp-frequently-check">
                                        <input type="checkbox" name="product_ids[]" value="{{ $crossProduct->id }}" 
                                            class="bundle-checkbox" data-price="{{ $crossProduct->final_price }}" checked>
                                    </div>
                                    <div class="tp-frequently-img-wrapper">
                                        <img src="{{ asset('storage/' . $crossProduct->image) }}" alt="{{ $crossProduct->name }}" class="img-fluid">
                                    </div>
                                    <div class="tp-frequently-content">
                                        <h6 class="tp-frequently-title text-truncate" style="max-width: 150px;" title="{{ $crossProduct->name }}">{{ $crossProduct->name }}</h6>
                                        <span class="tp-frequently-price">₹{{ number_format($crossProduct->final_price, 2) }}</span>
                                    </div>
                                </div>
                                
                                @if(!$loop->last)
                                    <div class="tp-frequently-plus">
                                        <i class="fal fa-plus"></i>
                                    </div>
                                @endif
                            @endforeach

                            <!-- Add Bundle Button -->
                            <div class="tp-frequently-action ms-auto">
                                <div class="tp-frequently-total mb-2 text-end">
                                    <span class="text-muted">Total Price:</span>
                                    <span class="fw-bold text-dark fs-5">
                                        <span id="bundle-total-price" data-base-price="{{ $product->final_price }}">
                                            @php
                                                $totalBundlePrice = $product->final_price;
                                                foreach($product->crossSellingProducts as $crossProduct) {
                                                    $totalBundlePrice += $crossProduct->final_price;
                                                }
                                            @endphp
                                            ₹{{ number_format($totalBundlePrice, 2) }}
                                        </span>
                                    </span>
                                </div>
                                <button type="submit" class="tp-btn-dark w-100">Add Bundle To Cart</button>
                            </div>
                        </form>
                    </div>

                    <style>
                        .tp-frequently-bought-wrapper {
                            background: #fff;
                            padding: 30px;
                            border: 1px solid #E0E2E3;
                            border-radius: 8px;
                        }
                        .tp-frequently-card {
                            border: 1px solid #E0E2E3;
                            border-radius: 8px;
                            padding: 15px;
                            display: flex;
                            gap: 15px;
                            align-items: center;
                            background: #fff;
                            min-width: 280px;
                        }
                        .tp-frequently-img-wrapper {
                            width: 70px;
                            height: 70px;
                            flex-shrink: 0;
                            background: #f9f9f9;
                            border-radius: 6px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .tp-frequently-img-wrapper img {
                            max-width: 100%;
                            max-height: 100%;
                            object-fit: contain;
                        }
                        .tp-frequently-title {
                            font-size: 15px;
                            font-weight: 500;
                            margin-bottom: 4px;
                            color: #010F1C;
                        }
                        .tp-frequently-price {
                            font-size: 14px;
                            color: #678E61; /* Green Price */
                            font-weight: 500;
                        }
                        .tp-frequently-plus {
                            color: #767a7d;
                            font-size: 18px;
                        }
                        .tp-btn-dark {
                            background-color: #010F1C;
                            color: #ffffff;
                            padding: 12px 30px;
                            border: none;
                            border-radius: 4px;
                            font-weight: 500;
                            font-family: 'Jost', sans-serif;
                            transition: all 0.3s ease;
                        }
                        .tp-btn-dark:hover {
                            background-color: #678E61;
                            color: #fff;
                        }
                        .tp-frequently-check {
                            flex-shrink: 0;
                        }
                        .tp-frequently-check input {
                            width: 18px;
                            height: 18px;
                            cursor: pointer;
                            accent-color: #678E61;
                        }
                        .tp-frequently-card.unchecked {
                            opacity: 0.6;
                            background-color: #f5f5f5;
                        }
                        .tp-frequently-card.unchecked .tp-frequently-price {
                            color: #999;
                        }
                    </style>
                </div>
            </div>
            @endif

            <!-- Tabs/Info -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="product-details-tab">
                        <ul class="nav nav-tabs product-details-tab-nav" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button" role="tab" aria-controls="desc" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec" type="button" role="tab" aria-controls="spec" aria-selected="false">Product Specification</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Reviews ({{ $product->reviews()->count() }})</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="vendor-tab" data-bs-toggle="tab" data-bs-target="#vendor" type="button" role="tab" aria-controls="vendor" aria-selected="false">Vendor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">FAQs</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                <div class="product__details-description-content ck-content">
                                    {!! $product->content !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="spec" role="tabpanel" aria-labelledby="spec-tab">
                                <table class="table table-bordered">
                                    <tbody>
                                        @if($product->weight)
                                        <tr>
                                            <th>Weight</th>
                                            <td>{{ (float)$product->weight }} {{ $product->unit_type ?: 'g' }}</td>
                                        </tr>
                                        @endif
                                        @if($product->sku)
                                        <tr>
                                            <th>SKU</th>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                        @endif
                                        @if($product->barcode)
                                        <tr>
                                            <th>Barcode</th>
                                            <td>{{ $product->barcode }}</td>
                                        </tr>
                                        @endif
                                        @if($product->length || $product->wide || $product->height)
                                        <tr>
                                            <th>Dimensions</th>
                                            <td>{{ $product->length }}x{{ $product->wide }}x{{ $product->height }} cm</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="tp-product-details-review-statics mb-40">
                                            <h4 class="tp-product-details-review-title mb-20">Customer Reviews</h4>
                                            @foreach($product->reviews as $review)
                                                <div class="mb-3 pb-3 border-bottom">
                                                    <div class="d-flex justify-content-between">
                                                        <strong>{{ $review->customer->name ?? 'Anonymous' }}</strong>
                                                        <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                    <div class="mb-2">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="{{ $i <= $review->star ? 'fas' : 'far' }} fa-star text-warning"></i>
                                                        @endfor
                                                    </div>
                                                    <p class="mb-0">{{ $review->comment }}</p>
                                                </div>
                                            @endforeach
                                            @if($product->reviews->isEmpty())
                                                <p class="text-muted">No reviews yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tp-product-details-review-form">
                                            <h4 class="tp-product-details-review-title mb-20">Write a review</h4>
                                            @auth('customer')
                                                <form action="{{ route('frontend.reviews.store') }}" method="POST" id="review-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="tp-product-details-review-form-rating mb-20">
                                                        <p class="mb-1">Your Rating <span class="text-danger">*</span></p>
                                                        <div class="tp-product-details-review-form-rating-icon" id="star-rating-container">
                                                            <input type="hidden" name="star" id="star-rating-input" value="5">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <span class="star-item active" data-value="{{ $i }}"><i class="fas fa-star"></i></span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="tp-product-details-review-input-wrapper">
                                                        <div class="tp-product-details-review-input-item">
                                                            <p class="mb-1">Your Review <span class="text-danger">*</span></p>
                                                            <textarea name="comment" id="review-comment" placeholder="Write your review here..." required></textarea>
                                                        </div>
                                                        <div class="tp-product-details-review-btn-wrapper">
                                                            <button type="submit" class="tp-btn" id="submit-review-btn">Submit Review</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-info">
                                                    Please <a href="{{ route('login') }}" class="fw-bold">Login</a> or <a href="{{ route('register') }}" class="fw-bold">Register</a> to write a review.
                                                </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor-tab">
                                @if($product->store)
                                    @php 
                                        $store = $product->store; 
                                        $storeProducts = $store->products;
                                        $totalReviews = $storeProducts->sum('reviews_count');
                                        $avgRating = $storeProducts->avg('reviews_avg') ?? 0;
                                    @endphp
                                    <div class="tp-product-details-vendor px-1">
                                        <a href="{{ route('frontend.stores.show', $store->slug) }}" class="d-flex align-items-center mb-3 text-decoration-none">
                                            <div class="vendor-logo me-3">
                                                <img src="{{ $store->logo_url }}" alt="{{ $store->name }}" style="width: 70px; height: 70px; object-fit: contain; border: 1px solid #eee; padding: 5px; border-radius: 6px;">
                                            </div>
                                            <div class="vendor-meta">
                                                <h5 class="mb-0 text-dark fw-bold d-flex align-items-center">
                                                    {{ $store->name }}
                                                    @if($store->is_verified)
                                                        <i class="fas fa-check-circle ms-1" style="font-size: 14px; color: #0095f6;"></i>
                                                    @endif
                                                </h5>
                                                <div class="text-muted" style="font-size: 11px;">Joined {{ $store->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </a>
                                        
                                        <div class="vendor-contact pt-2 border-top">
                                            <div class="d-flex align-items-center mb-2 gap-2">
                                                <i class="fal fa-map-marker-alt text-muted" style="width: 15px;"></i>
                                                <span class="small text-muted"><strong>Address:</strong> {{ $store->address }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-2 gap-2">
                                                <i class="fal fa-phone-alt text-muted" style="width: 15px;"></i>
                                                <span class="small text-muted"><strong>Phone:</strong> {{ $store->phone }}</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-0 gap-2">
                                                <i class="fal fa-envelope text-muted" style="width: 15px;"></i>
                                                <span class="small text-muted"><strong>Email:</strong> {{ $store->email }}</span>
                                            </div>
                                        </div>
                                        
                                        @if($store->description)
                                            <div class="mt-2 pt-2 border-top">
                                                <p class="small text-muted mb-0" style="line-height: 1.5;">{{ Str::limit($store->description, 180) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <style>
                                        .tp-product-details-vendor a:hover .text-dark { color: var(--primary-color) !important; }
                                    </style>
                                @else
                                    <p class="text-muted text-center py-4">Vendor information not available.</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                @if($product->faq_schema_config && count($product->faq_schema_config))
                                    <div class="accordion" id="faqAccordion">
                                        @foreach($product->faq_schema_config as $index => $faq)
                                            <div class="accordion-item border-0 mb-3 shadow-sm rounded">
                                                <h2 class="accordion-header" id="faq-heading-{{ $index }}">
                                                    <button class="accordion-button rounded {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-{{ $index }}">
                                                        {{ $faq['question'] }}
                                                    </button>
                                                </h2>
                                                <div id="faq-collapse-{{ $index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body text-muted">
                                                        {{ $faq['answer'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">No FAQs found for this product.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="row tp-related-product-area">
                <div class="col-12">
                    <h3 class="tp-section-title">Related Products</h3>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach($product->relatedProducts as $related)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="product-item shadow-sm rounded overflow-hidden">
                                    <div class="product-thumb position-relative">
                                        <a href="{{ route('frontend.products.show', $related->slug ?: $related->id) }}">
                                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}" style="width:100%; height: 250px; object-fit:cover;">
                                        </a>
                                        @if($related->isOnSale())
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $related->getDiscountPercentage() }}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content p-3">
                                        <h6 class="product-title mb-2"><a href="{{ route('frontend.products.show', $related->slug ?: $related->id) }}" class="text-dark text-decoration-none text-truncate d-block">{{ $related->name }}</a></h6>
                                        <div class="product-price">
                                            @if($related->isOnSale())
                                                <span class="text-danger fw-bold">₹{{ number_format($related->sale_price, 2) }}</span>
                                                <span class="text-muted text-decoration-line-through ms-2 small">₹{{ number_format($related->price, 2) }}</span>
                                            @else
                                                <span class="fw-bold">₹{{ number_format($related->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($product->relatedProducts->isEmpty())
                            <div class="col-12 text-center text-muted">No related products found.</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Sticky Add to Cart Bar -->
    <div class="sticky-add-cart-bar" id="stickyCartBar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex align-items-center">
                    <img src="{{ $product->image_url }}" class="sticky-thumb me-3" alt="Thumb">
                    <div>
                        <h6 class="mb-0 text-truncate" style="max-width: 300px;">{{ $product->name }}</h6>
                        <span class="text-success fw-bold">₹{{ number_format($product->final_price, 0) }}</span>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <form action="{{ route('frontend.cart.add') }}" method="POST" class="add-to-cart-form d-inline-flex gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="tp-btn py-2 px-4" style="height: auto;">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
    <script>
        function changeMainImage(src, element) {
            const mainImg = document.getElementById('mainImage');
            if (mainImg) mainImg.src = src;
            
            // Update active state of thumbnail
            document.querySelectorAll('.product-thumbnails img').forEach(img => {
                img.classList.remove('active');
            });
            if (element) element.classList.add('active');
        }

        // New Zepto-style Cart Handlers
        function handleInitialAdd(btn) {
            const container = btn.closest('.action-state-container');
            const productId = container.dataset.productId;
            const minQty = parseInt('{{ $product->minimum_order_quantity > 0 ? $product->minimum_order_quantity : 1 }}', 10);
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;

            $.post("{{ route('frontend.cart.add') }}", {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: minQty
            }, function(res) {
                if(res.success) {
                    $('.add-btn-state').addClass('d-none');
                    $('.qty-selector-state').removeClass('d-none');
                    $('#detailed-qty-input').val(minQty);
                    
                    if(typeof notify === 'function') notify(res.message, 'success');
                    
                    // Global cart sync
                    $('[data-bb-value="cart-count"]').text(res.count);
                    if(typeof refreshCartArea === 'function') refreshCartArea();
                } else {
                    btn.innerHTML = 'ADD';
                    btn.disabled = false;
                    if(typeof notify === 'function') notify(res.message || 'Error adding to cart', 'error');
                }
            }).fail(function() {
                btn.innerHTML = 'ADD';
                btn.disabled = false;
            });
        }

        function updateDetailedQty(change) {
            const input = $('#detailed-qty-input');
            let currentVal = parseInt(input.val(), 10);
            let newVal = currentVal + change;
            const productId = '{{ $product->id }}';
            const minQty = parseInt('{{ $product->minimum_order_quantity > 0 ? $product->minimum_order_quantity : 1 }}', 10);

            if (newVal < minQty && change < 0) {
                // Remove from cart if it goes below min
                handleRemoveItem(productId);
                return;
            }

            // Check stock
            const max = parseInt('{{ $product->quantity ?? 0 }}', 10);
            const withManagement = '{{ $product->with_storehouse_management }}' == '1';
            const allowCheckout = '{{ $product->allow_checkout_when_out_of_stock }}' == '1';

            if (withManagement && !allowCheckout && newVal > max) {
                if(typeof notify === 'function') notify('Only ' + max + ' items available.', 'error');
                return;
            }

            input.val(newVal);

            // AJAX Update
            $.post("{{ route('frontend.cart.update') }}", {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: newVal
            }, function(res) {
                if(!res.success) {
                    input.val(currentVal);
                    if(typeof notify === 'function') notify(res.message, 'error');
                } else {
                    $('[data-bb-value="cart-count"]').text(res.count);
                }
            });
        }

        function handleRemoveItem(productId) {
            $.post("{{ route('frontend.cart.remove', ['id' => $product->id]) }}", {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
                product_id: productId
            }, function(res) {
                if(res.success) {
                    $('.add-btn-state').removeClass('d-none');
                    $('.qty-selector-state').addClass('d-none');
                    $('.tp-product-details-add-btn').text('ADD').prop('disabled', false);
                    
                    if(typeof notify === 'function') notify(res.message, 'success');
                    
                    $('[data-bb-value="cart-count"]').text(res.count);
                }
            });
        }

        function incrementValue() {
            // ... legacy support if needed by sticky bar ...
            updateDetailedQty(1);
        }

        function decrementValue() {
            // ... legacy support if needed by sticky bar ...
            updateDetailedQty(-1);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Countdown Timer
            const timer = document.getElementById('countdown-timer');
            if (timer && timer.dataset.endDate) {
                const endDate = new Date(timer.dataset.endDate).getTime();
                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = endDate - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        const countdownArea = document.querySelector('.tp-product-details-countdown');
                        if (countdownArea) countdownArea.style.display = 'none';
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    const dEl = document.getElementById('days');
                    const hEl = document.getElementById('hours');
                    const mEl = document.getElementById('minutes');
                    const sEl = document.getElementById('seconds');

                    if (dEl) dEl.innerText = days < 10 ? '0' + days : days;
                    if (hEl) hEl.innerText = hours < 10 ? '0' + hours : hours;
                    if (mEl) mEl.innerText = minutes < 10 ? '0' + minutes : minutes;
                    if (sEl) sEl.innerText = seconds < 10 ? '0' + seconds : seconds;
                }, 1000);
            }
            
            // Sticky Bar Visibility
            const stickyBar = document.getElementById('stickyCartBar');
            const trigger = document.querySelector('.product__details-action');
            if (stickyBar && trigger) {
                document.addEventListener('scroll', function() {
                    const rect = trigger.getBoundingClientRect();
                    if (rect.top < 0) {
                        stickyBar.classList.add('visible');
                    } else {
                        stickyBar.classList.remove('visible');
                    }
                });
            }

            // Review Star Rating System
            const starItems = document.querySelectorAll('#star-rating-container .star-item');
            const starInput = document.getElementById('star-rating-input');

            if (starItems.length > 0 && starInput) {
                starItems.forEach(item => {
                    item.addEventListener('mouseenter', function() {
                        const val = parseInt(this.getAttribute('data-value'), 10);
                        starItems.forEach(star => {
                            const sVal = parseInt(star.getAttribute('data-value'), 10);
                            star.classList.toggle('hover', sVal <= val);
                        });
                    });

                    item.addEventListener('mouseleave', function() {
                        starItems.forEach(star => star.classList.remove('hover'));
                    });

                    item.addEventListener('click', function() {
                        const val = parseInt(this.getAttribute('data-value'), 10);
                        starInput.value = val;
                        starItems.forEach(star => {
                            const sVal = parseInt(star.getAttribute('data-value'), 10);
                            star.classList.toggle('active', sVal <= val);
                        });
                    });
                });
            }

            // AJAX Review Submission
            const reviewForm = document.getElementById('review-form');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const submitBtn = document.getElementById('submit-review-btn');
                    if (!submitBtn) return;

                    const originalText = submitBtn.innerText;
                    submitBtn.innerText = 'Submitting...';
                    submitBtn.disabled = true;

                    const formData = new FormData(this);
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            notify(data.message, 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            notify(data.message || 'Something went wrong', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        notify('An error occurred. Please try again.', 'error');
                    })
                    .finally(() => {
                        submitBtn.innerText = originalText;
                        submitBtn.disabled = false;
                    });
                });
            }

            // Bundle Price Calculation
            const bundleForm = document.getElementById('frequently-bought-form');
            if (bundleForm) {
                const bundleCheckboxes = bundleForm.querySelectorAll('.bundle-checkbox');
                const bundleTotalPriceSpan = document.getElementById('bundle-total-price');
                
                if (bundleTotalPriceSpan) {
                    const basePrice = parseFloat(bundleTotalPriceSpan.dataset.basePrice) || 0;

                    function updateBundleTotal() {
                        let total = basePrice;
                        bundleCheckboxes.forEach(cb => {
                            const card = cb.closest('.tp-frequently-card');
                            const price = parseFloat(cb.dataset.price) || 0;
                            if (cb.checked) {
                                total += price;
                                if (card) card.classList.remove('unchecked');
                            } else {
                                if (card) card.classList.add('unchecked');
                            }
                        });
                        bundleTotalPriceSpan.innerText = '₹' + total.toLocaleString('en-IN', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }

                    bundleCheckboxes.forEach(cb => {
                        cb.addEventListener('change', updateBundleTotal);
                    });
                }
            }
        });
    </script>
    @endpush
