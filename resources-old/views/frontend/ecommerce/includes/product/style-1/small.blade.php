<div class="tp-product-sm-item-5 d-flex align-items-center">
    <div class="tp-product-sm-thumb-5 fix">
        <a href="{{ url('/products/' . $product->slug) }}">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            @else
                <img src="{{ asset('images/placeholder.jpg') }}" alt="{{ $product->name }}" class="img-fluid">
            @endif
        </a>
    </div>
    <div class="tp-product-sm-content-5">
        @if($product->brand)
            <div class="tp-product-sm-tag-5">
                <a href="{{ url('/brands/' . $product->brand->slug) }}">{{ $product->brand->name }}</a>
            </div>
        @endif

        <h4 class="tp-product-sm-title-5">
            <a href="{{ url('/products/' . $product->slug) }}">{{ $product->name }}</a>
        </h4>

        @if($product->reviews_count > 0)
            <div class="tp-product-sm-rating-5">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($product->reviews_avg))
                        <i class="fas fa-star text-warning"></i>
                    @elseif($i - 0.5 <= $product->reviews_avg)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
                <span class="ms-1">({{ $product->reviews_count }})</span>
            </div>
        @endif

        <div class="tp-product-sm-price-wrapper-5">
            @if($product->sale_price > 0 && $product->sale_price < $product->price)
                <span class="tp-product-sm-price-5">${{ number_format($product->sale_price, 2) }}</span>
                <span class="tp-product-sm-price-5 old-price">${{ number_format($product->price, 2) }}</span>
            @else
                <span class="tp-product-sm-price-5">${{ number_format($product->price, 2) }}</span>
            @endif
        </div>
    </div>
</div>
