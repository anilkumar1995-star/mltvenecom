<div class="tp-product-item-2 mb-40">
    <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">

            @php
                $imageUrl = asset('home/placeholder.png');
                if ($product->image && file_exists(public_path('storage/' . $product->image))) {
                    $imageUrl = asset('storage/' . $product->image);
                } elseif ($product->images && count($product->images) > 0) {
                     $imageUrl = asset('uploads/' . $product->images[0]);
                }
            @endphp
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('home/placeholder.png') }}'">
        </a>

        <!-- Product Actions -->
        <div class="tp-product-action-2 tp-product-action-blackStyle">
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

                <!-- Buy Now (Optional based on user preference, keeping for now as they asked for it) -->
                <form action="{{ route('frontend.cart.buyNow') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="tp-product-action-btn-2" title="Buy Now" formaction="{{ route('frontend.cart.buyNow') }}">
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

    <div class="tp-product-content-2">
        <div class="tp-product-tag-2">
            <a href="#">{{ $product->brand->name ?? 'Brand' }}</a>
        </div>
        <h3 class="tp-product-title-2">
            <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">{{ $product->name }}</a>
        </h3>
        <div class="tp-product-rating-icon tp-product-rating-icon-2">
            <span><i class="fas fa-star"></i></span>
            <span><i class="fas fa-star"></i></span>
            <span><i class="fas fa-star"></i></span>
            <span><i class="fas fa-star"></i></span>
            <span><i class="fas fa-star"></i></span>
        </div>
        <div class="tp-product-price-wrapper-2">
            <span class="tp-product-price-2 new-price">${{ number_format($product->price, 2) }}</span>
            @if($product->original_price > $product->price)
                <span class="tp-product-price-2 old-price">${{ number_format($product->original_price, 2) }}</span>
            @endif
        </div>
    </div>
</div>
