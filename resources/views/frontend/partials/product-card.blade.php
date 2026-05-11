<div class="tp-product-item-5 p-relative white-bg mb-40">
    <div class="tp-product-thumb-5 w-img fix mb-15">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('home/placeholder.png') }}'">
        </a>

        @if($product->on_sale)
            <div class="tp-product-badge">
                <span class="product-sale">Sale</span>
            </div>
        @endif

        <div class="tp-product-action-2 tp-product-action-5 tp-product-action-greenStyle">
            <div class="tp-product-action-item-2 d-flex flex-column">
                <button type="button" class="tp-product-action-btn-2 tp-add-cart-btn" 
                        title="Add To Cart" data-id="{{ $product->id }}">
                    <i class="fas fa-shopping-basket"></i>
                    <span class="tp-product-tooltip tp-product-tooltip-right">Add To Cart</span>
                </button>
                <button type="button" class="tp-product-action-btn-2" title="Quick View">
                    <i class="far fa-eye"></i>
                    <span class="tp-product-tooltip tp-product-tooltip-right">Quick View</span>
                </button>
                <form action="{{ route('frontend.cart.buyNow') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="tp-product-action-btn-2" title="Buy Now">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="tp-product-tooltip tp-product-tooltip-right">Buy Now</span>
                    </button>
                </form>
                <button type="button" class="tp-product-action-btn-2 tp-wishlist-btn" title="Add To Wishlist" data-id="{{ $product->id }}">
                    <i class="{{ isset(session('wishlist', [])[$product->id]) ? 'fas text-danger' : 'far' }} fa-heart"></i>
                    <span class="tp-product-tooltip tp-product-tooltip-right">Add To Wishlist</span>
                </button>
            </div>
        </div>
    </div>
    <div class="tp-product-content-5">
        <div class="tp-product-tag-5">
            <span><a href="#">{{ $product->brand->name ?? 'Brand' }}</a></span>
        </div>

        <h3 class="tp-product-title-2 line-clamp-2">
            <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" title="{{ $product->name }}">{{ $product->name }}</a>
        </h3>

        <div class="tp-product-rating-icon-2 mb-5">
            @for($i = 1; $i <= 5; $i++)
                <span><i class="fas fa-star" style="color: {{ $i <= round($product->reviews_avg ?? 0) ? '#ffb21d' : '#d5d5d5' }}; font-size: 11px;"></i></span>
            @endfor
            <span class="ms-1 text-muted" style="font-size: 11px;">({{ $product->reviews_count ?? 0 }})</span>
        </div>

        <div class="tp-product-price-wrapper-5">
            <span class="tp-product-price-5 new-price">₹{{ number_format($product->final_price, 2) }}</span>
            @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                <span class="">
                    <small>
                        <del class="tp-product-price-5 old-price">₹{{ number_format($product->price, 2) }}</del>
                    </small>
                </span>
            @endif
        </div>
    </div>
</div>
