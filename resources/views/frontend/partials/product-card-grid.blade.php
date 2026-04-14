<div class="tp-product-item-2 mb-30" style="background: #fff; border-radius: 12px; height: 100%; border: 1px solid #f0f0f0; overflow: hidden; position: relative; transition: all 0.3s ease;">
    <div class="tp-product-thumb-2 p-relative z-index-1 fix w-img" style="background: #fff; position: relative; padding: 10px;">
        <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" style="display:block; width:100%; height:130px;">
            <div style="width:100%; height:130px; display: flex; align-items: center; justify-content: center;">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                     onerror="this.src='{{ asset('home/placeholder.png') }}'"
                     style="max-width:90%; max-height:130px; object-fit:contain;">
            </div>
        </a>
        
        {{-- Save Label --}}
        @if($product->is_on_sale && $product->price > $product->final_price)
            <div style="position: absolute; top: 10px; left: 10px; background: #34a853; color: #fff; font-size: 10px; font-weight: 800; padding: 2px 6px; border-radius: 4px; text-transform: uppercase; z-index: 2;">
                @php
                    $discount = round((($product->price - $product->final_price) / $product->price) * 100);
                @endphp
                {{ $discount }}% OFF
            </div>
        @endif

        {{-- Action Area (ADD Button or Qty Selector) --}}
        @php
            $cart = session('cart', []);
            $cartItem = $cart[$product->id] ?? null;
        @endphp
        <div class="tp-product-action-zepto" data-id="{{ $product->id }}" style="position: absolute; bottom: 8px; right: 8px; z-index: 3;">
            {{-- ADD Button --}}
            <button type="button"
                class="tp-add-to-cart-zepto-card {{ $cartItem ? 'd-none' : '' }}"
                data-id="{{ $product->id }}"
                data-url="{{ route('frontend.cart.add') }}"
                style="background: #fff; color: #ff3269; border: 1px solid #ff3269; border-radius: 8px; font-weight: 800; font-size: 13px; height: 34px; min-width: 75px; text-transform: uppercase; padding: 0 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.2s ease;">
                ADD
            </button>

            {{-- Quantity Selector --}}
            <div class="tp-qty-selector-zepto {{ $cartItem ? '' : 'd-none' }}" style="background: #ff3269; color: #fff; border-radius: 8px; display: flex; align-items: center; height: 34px; min-width: 90px; justify-content: space-between; font-weight: 800; font-size: 15px; box-shadow: 0 4px 10px rgba(255, 50, 105, 0.3); overflow: hidden;">
                <button type="button" class="qty-btn-zepto minus" style="background: none; border: none; color: #fff; cursor: pointer; padding: 0 12px; height: 100%; display: flex; align-items: center; font-size: 18px; outline: none !important;">-</button>
                <span class="qty-count-zepto">{{ $cartItem ? $cartItem['quantity'] : 1 }}</span>
                <button type="button" class="qty-btn-zepto plus" style="background: none; border: none; color: #fff; cursor: pointer; padding: 0 12px; height: 100%; display: flex; align-items: center; font-size: 18px; outline: none !important;">+</button>
            </div>
        </div>
    </div>
    
    <div class="tp-product-content-2" style="padding: 10px; border-top: 1px dashed #eee;">
        {{-- Price Section --}}
        <div class="mb-10">
            <div class="d-flex align-items-center gap-2 mb-1">
                <div style="background: #34a853; color: #fff; font-size: 14px; font-weight: 800; padding: 2px 8px; border-radius: 6px;">
                    ₹{{ number_format($product->final_price) }}
                </div>
                @if($product->is_on_sale && round($product->final_price, 2) < round($product->price, 2))
                    <div style="font-size: 10px; text-decoration: line-through; color: #999;">₹{{ number_format($product->price) }}</div>
                @endif
            </div>
            @if($product->is_on_sale && $product->price > $product->final_price)
                <div style="font-size: 11px; color: #34a853; font-weight: 700;">₹{{ number_format($product->price - $product->final_price) }} OFF</div>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="tp-product-title-2 mb-1" style="font-size: 14px; font-weight: 700; min-height: 40px; line-height: 1.3; color: #212529; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
            <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">{{ $product->name }}</a>
        </h3>

        <div style="font-size: 12px; color: #666; margin-bottom: 8px;">
            @if($product->weight > 0)
                1 pack ({{ (float)$product->weight }} {{ $product->unit_type ?: 'kg' }})
            @else
                1 unit
            @endif
        </div>

        {{-- Rating --}}
        <div class="d-flex align-items-center gap-2">
            @if($product->reviews_avg > 0)
                <div class="d-flex align-items-center" style="background: #f3fdf5; color: #34a853; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 4px;">
                    <i class="fas fa-star me-1" style="font-size: 9px;"></i>
                    {{ number_format($product->reviews_avg, 1) }}
                </div>
                <div style="font-size: 11px; color: #999;">({{ number_format($product->reviews_count) }})</div>
            @endif
        </div>
    </div>
</div>
