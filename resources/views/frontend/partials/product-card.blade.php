<div class="tp-product-item-5 p-relative white-bg mb-40">
    <div class="tp-product-thumb-5 w-img fix mb-15">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">
            @php
                $imgUrl = asset('home-dashboard-files/placeholder.png');
                if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                    $imgUrl = asset('storage/' . $product->image);
                } elseif ($product->images && count($product->images) > 0) {
                     $imgUrl = asset('uploads/' . $product->images[0]);
                }
            @endphp
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('home-dashboard-files/placeholder.png') }}'">
        </a>
        </a>

        @if($product->on_sale)
            <div class="tp-product-badge">
                <span class="product-sale">Sale</span>
            </div>
        @endif

        <div class="tp-product-action-2 tp-product-action-5 tp-product-action-greenStyle">
            <div class="tp-product-action-item-2 d-flex flex-column">
                <button type="button" class="tp-product-action-btn-2 tp-product-add-cart-btn" 
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
                <button type="button" class="tp-product-action-btn-2" title="Add To Wishlist">
                    <i class="far fa-heart"></i>
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

        <div class="tp-product-price-wrapper-5">
            <span class="tp-product-price-5 new-price">${{ number_format($product->price, 2) }}</span>
            @if($product->original_price > $product->price)
                <span class="">
                    <small>
                        <del class="tp-product-price-5 old-price">${{ number_format($product->original_price, 2) }}</del>
                    </small>
                </span>
            @endif
        </div>
    </div>
</div>
