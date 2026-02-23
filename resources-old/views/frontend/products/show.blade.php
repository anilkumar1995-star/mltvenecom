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
                                <img src="{{ asset('uploads/' . $product->image) }}" class="active" onclick="changeMainImage(this.src)">
                            @endif
                            @foreach($product->images ?? [] as $img)
                                <img src="{{ asset('uploads/' . $img) }}" onclick="changeMainImage(this.src)">
                            @endforeach
                        </div>
                        <div class="product-main-image">
                            @if($product->isOnSale())
                                <span class="badge bg-primary product-badge">-{{ $product->getDiscountPercentage() }}%</span>
                            @endif
                            <img id="mainImage" src="{{ $product->image ? asset('uploads/' . $product->image) : 'https://via.placeholder.com/600x600' }}" alt="{{ $product->name }}">
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

                        <div class="product__details-rating d-flex align-items-center mb-3">
                            <div class="rating-star me-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $product->reviews_avg ? 'fas' : 'far' }} fa-star text-warning"></i>
                                @endfor
                            </div>
                            <span class="text-muted">({{ $product->reviews_count }} Reviews)</span>
                        </div>

                        <div class="product__details-price">
                            @if($product->isOnSale())
                                <span class="new-price">${{ number_format($product->sale_price, 0) }}</span>
                                <span class="old-price">${{ number_format($product->price, 0) }}</span>
                            @else
                                <span class="new-price">${{ number_format($product->price, 0) }}</span>
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



                        <form action="{{ route('frontend.cart.add') }}" method="POST" class="product-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="tp-product-details-action-wrapper">
                                <!-- Row 1: Quantity + Add to Cart -->
                                <div class="tp-product-details-add-to-cart mb-3 d-flex align-items-center gap-3">
                                    <div class="tp-product-details-quantity">
                                        <div class="tp-product-quantity d-flex align-items-center">
                                            <span class="tp-cart-minus" onclick="decrementValue()">
                                                <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            <input class="tp-cart-input" type="text" name="quantity" id="qty" value="1" readonly>
                                            <span class="tp-cart-plus" onclick="incrementValue()">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="tp-product-details-add-to-cart-btn w-100">Add To Cart</button>
                                </div>

                                <!-- Row 2: Buy Now -->
                                <button type="button"
                                    onclick="var form = this.closest('form'); form.action = '{{ route('frontend.cart.buyNow') }}'; form.submit();"
                                    class="tp-product-details-buy-now-btn w-100">
                                    Buy Now
                                </button>
                            </div>
                        </form>

                        <style>
                            /* Quantity */
                            .tp-product-details-quantity {
                                width: 140px;
                                flex-shrink: 0;
                            }
                            .tp-product-quantity {
                                background-color: #F3F5F6;
                                border-radius: 0;
                                height: 46px;
                                justify-content: space-between;
                                padding: 0 15px;
                            }
                            .tp-cart-input {
                                height: 46px;
                                background-color: transparent;
                                border: none;
                                text-align: center;
                                font-size: 16px;
                                font-weight: 500;
                                color: #010F1C;
                                width: 100%;
                            }
                            .tp-cart-minus, .tp-cart-plus {
                                cursor: pointer;
                                color: #010F1C;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            }

                            /* Add to Cart */
                            .tp-product-details-add-to-cart-btn {
                                height: 46px;
                                background-color: transparent;
                                border: 1px solid #E0E2E3;
                                color: #010F1C;
                                font-family: 'Jost', sans-serif;
                                font-size: 16px;
                                font-weight: 400;
                                padding: 0 30px;
                                transition: all 0.3s ease;
                            }
                            .tp-product-details-add-to-cart-btn:hover {
                                background-color: #010F1C;
                                border-color: #010F1C;
                                color: #ffffff;
                            }

                            /* Buy Now */
                            .tp-product-details-buy-now-btn {
                                height: 46px;
                                background-color: #678E61; /* Exact Shofy Green */
                                border: none;
                                color: #ffffff;
                                font-family: 'Jost', sans-serif;
                                font-size: 16px;
                                font-weight: 500;
                                letter-spacing: 0;
                                transition: all 0.3s ease;
                            }
                            .tp-product-details-buy-now-btn:hover {
                                background-color: #010F1C;
                                color: #ffffff;
                            }
                        </style>



                        <div class="product-details-action-sm">
                            <a href="#"><i class="fal fa-exchange"></i> Compare</a>
                            <a href="#"><i class="fal fa-heart"></i> Add Wishlist</a>
                        </div>

                        <div class="product__details-meta">
                            <div class="mb-2"><strong>SKU:</strong> {{ $product->sku ?? 'N/A' }}</div>
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
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>

                        <div class="tp-product-details-msg">
                            <ul>
                                <li><i class="fas fa-check-circle"></i> 30 days easy returns</li>
                                <li><i class="fas fa-check-circle"></i> Order yours before 2.30pm for same day dispatch</li>
                                <li><i class="fas fa-check-circle"></i> Guaranteed safe & secure checkout</li>
                            </ul>
                        </div>

                        <div class="tp-product-details-payment">
                            <img src="{{ asset('home-dashboard-files/payment-option.png') }}" alt="Payment">
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

                        <form action="{{ route('frontend.cart.add') }}" method="POST" class="d-flex flex-wrap align-items-center gap-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <!-- Main Product Card -->
                            <div class="tp-frequently-card">
                                <div class="tp-frequently-img-wrapper">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                </div>
                                <div class="tp-frequently-content">
                                    <h6 class="tp-frequently-title text-truncate" style="max-width: 150px;" title="{{ $product->name }}">{{ $product->name }}</h6>
                                    <span class="tp-frequently-price">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Plus Sign -->
                            <div class="tp-frequently-plus">
                                <i class="fal fa-plus"></i>
                            </div>

                            <!-- Cross Sell Products -->
                            @foreach($product->crossSellingProducts as $crossProduct)
                                <div class="tp-frequently-card">
                                    <div class="tp-frequently-img-wrapper">
                                        <img src="{{ asset('storage/' . $crossProduct->image) }}" alt="{{ $crossProduct->name }}" class="img-fluid">
                                    </div>
                                    <div class="tp-frequently-content">
                                        <h6 class="tp-frequently-title text-truncate" style="max-width: 150px;" title="{{ $crossProduct->name }}">{{ $crossProduct->name }}</h6>
                                        <span class="tp-frequently-price">${{ number_format($crossProduct->price, 2) }}</span>
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
                                        ${{ number_format($product->price + $product->crossSellingProducts->sum('price'), 2) }}
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
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Reviews ({{ $product->reviews_count }})</button>
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
                                        <tr>
                                            <th>Weight</th>
                                            <td>{{ $product->weight }} {{ $product->weight_unit ?? 'kg' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td>{{ $product->length }}x{{ $product->wide }}x{{ $product->height }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
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
                            <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor-tab">
                                <p class="text-muted">Vendor information not available.</p>
                            </div>
                            <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                <p class="text-muted">No FAQs found.</p>
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
                                        <a href="{{ route('frontend.products.show', $related->slug) }}">
                                            <img src="{{ asset('uploads/' . $related->image) }}" alt="{{ $related->name }}" style="width:100%; height: 250px; object-fit:cover;">
                                        </a>
                                        @if($related->isOnSale())
                                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $related->getDiscountPercentage() }}%</span>
                                        @endif
                                    </div>
                                    <div class="product-content p-3">
                                        <h6 class="product-title mb-2"><a href="{{ route('frontend.products.show', $related->slug) }}" class="text-dark text-decoration-none">{{ $related->name }}</a></h6>
                                        <div class="product-price">
                                            @if($related->isOnSale())
                                                <span class="text-danger fw-bold">${{ number_format($related->sale_price, 2) }}</span>
                                                <span class="text-muted text-decoration-line-through ms-2">${{ number_format($related->price, 2) }}</span>
                                            @else
                                                <span class="fw-bold">${{ number_format($related->price, 2) }}</span>
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
                    <img src="{{ $product->image ? asset('uploads/' . $product->image) : 'https://via.placeholder.com/60x60' }}" class="sticky-thumb me-3" alt="Thumb">
                    <div>
                        <h6 class="mb-0">{{ $product->name }}</h6>
                        <span class="text-muted">${{ number_format($product->final_price, 0) }}</span>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <form action="{{ route('frontend.cart.add') }}" method="POST" class="d-inline-flex gap-2">
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
        function changeMainImage(src) {
            document.getElementById('mainImage').src = src;
            // Also update active state of thumbnail
            document.querySelectorAll('.product-thumbnails img').forEach(img => img.classList.remove('active'));
            event.target.classList.add('active');
        }

        function incrementValue() {
            var value = parseInt(document.getElementById('qty').value, 10);
            value = isNaN(value) ? 1 : value;
            if(value < {{ $product->quantity }}) {
                value++;
                document.getElementById('qty').value = value;
            }
        }

        function decrementValue() {
            var value = parseInt(document.getElementById('qty').value, 10);
            value = isNaN(value) ? 1 : value;
            if(value > 1) {
                value--;
                document.getElementById('qty').value = value;
            }
        }

        // Countdown Timer
        document.addEventListener('DOMContentLoaded', function() {
            const timer = document.getElementById('countdown-timer');
            if (timer) {
                const endDate = new Date(timer.dataset.endDate).getTime();

                const interval = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = endDate - now;

                    if (distance < 0) {
                        clearInterval(interval);
                        document.querySelector('.tp-product-details-countdown').style.display = 'none';
                        return;
                    }

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById('days').innerText = days < 10 ? '0' + days : days;
                    document.getElementById('hours').innerText = hours < 10 ? '0' + hours : hours;
                    document.getElementById('minutes').innerText = minutes < 10 ? '0' + minutes : minutes;
                    document.getElementById('seconds').innerText = seconds < 10 ? '0' + seconds : seconds;
                }, 1000);
            }

            // Sticky Bar
            document.addEventListener('scroll', function() {
                const stickyBar = document.getElementById('stickyCartBar');
                const trigger = document.querySelector('.product__details-action');

                if (trigger) {
                    const rect = trigger.getBoundingClientRect();
                    if (rect.top < 0) {
                        stickyBar.classList.add('visible');
                    } else {
                        stickyBar.classList.remove('visible');
                    }
                }
            });
        });
    </script>
    @endpush
