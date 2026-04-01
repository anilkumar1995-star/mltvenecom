<div class="tp-product-item-2 mb-40">
    <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" style="display:block; width:100%; height:220px;">
            <div style="width:100%; height:220px; overflow:hidden;">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                     onerror="this.src='{{ asset('home/placeholder.png') }}'"
                     style="width:100%; height:220px; object-fit:cover; transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);">
            </div>
        </a>

        <!-- Product Actions -->
        <div class="tp-product-action-2 tp-product-action-blackStyle">
            <div class="tp-product-action-item-2 d-flex flex-column">

                {{-- Add To Cart --}}
                <button type="button"
                    class="tp-product-action-btn-2 tp-add-cart-btn"
                    title="Add To Cart"
                    data-id="{{ $product->id }}"
                    data-url="{{ route('frontend.cart.add') }}">
                    <i class="fas fa-shopping-basket"></i>
                    <span class="tp-product-tooltip tp-product-tooltip-right">Add To Cart</span>
                </button>

                {{-- Quick View --}}
                <button type="button"
                    class="tp-product-action-btn-2 tp-quick-view-btn"
                    title="Quick View"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ number_format($product->price, 2) }}"
                    data-image="{{ $product->image_url }}"
                    data-url="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">
                    <i class="far fa-eye"></i>
                    <span class="tp-product-tooltip tp-product-tooltip-right">Quick View</span>
                </button>

                {{-- Wishlist --}}
                <button type="button"
                    class="tp-product-action-btn-2 tp-wishlist-btn"
                    title="Add To Wishlist"
                    data-id="{{ $product->id }}"
                    data-url="{{ route('frontend.wishlist.toggle') }}">
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
        <div class="tp-product-rating-icon tp-product-rating-icon-2 mb-5">
            @for($i = 1; $i <= 5; $i++)
                <span><i class="fas fa-star" style="color: {{ $i <= round($product->reviews_avg ?? 0) ? '#ffb21d' : '#d5d5d5' }}; font-size: 11px;"></i></span>
            @endfor
            <span class="ms-1 text-muted" style="font-size: 11px;">({{ $product->reviews_count ?? 0 }})</span>
        </div>
        <div class="tp-product-price-wrapper-2">
            <span class="tp-product-price-2 new-price">₹{{ number_format($product->final_price, 2) }}</span>
            @if($product->is_on_sale)
                <span class="tp-product-price-2 old-price">₹{{ number_format($product->price, 2) }}</span>
            @endif
        </div>
    </div>
</div>
