@php
    $cart = session('cart', []);
    $subtotal = 0;
    foreach($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
@endphp

{{-- No more root container here to allow clean AJAX updates --}}
<div class="cartmini__wrapper">
    <div class="cartmini__title">
        <h4>Shopping Cart</h4>
        <div class="cartmini__close">
            <button type="button" class="cartmini__close-btn cartmini-close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="cartmini__widget">
        <div class="cartmini__inner">
            @if(count($cart) > 0)
                <ul>
                    @foreach($cart as $item)
                    @php $id = $item['id']; @endphp
                    <li>
                        <div class="cartmini__thumb">
                            <a href="{{ route('frontend.products.show', $item['slug'] ?: $id) }}">
                                @if(isset($item['image']))
                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() . $item['image'] }}" alt="{{ $item['name'] }}">
                                @else
                                    <img src="{{ asset('home/product-1.jpg') }}" alt="{{ $item['name'] }}">
                                @endif
                            </a>
                        </div>
                        <div class="cartmini__content">
                            <h5><a href="{{ route('frontend.products.show', $item['slug'] ?: $id) }}">{{ $item['name'] }}</a></h5>
                            <div class="product-quantity mt-10 mb-10">
                                <button type="button" class="cart-minus" data-id="{{ $id }}" style="background:none; border:none; padding: 0 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; height: 100%;">
                                    <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                                <input class="cart-input" type="text" data-id="{{ $id }}" 
                                    data-min="{{ $item['min_qty'] ?? 0 }}" 
                                    data-max="{{ $item['max_qty'] ?? 0 }}" 
                                    data-stock="{{ $item['stock_qty'] ?? 0 }}"
                                    data-with-storehouse="{{ $item['with_storehouse'] ?? 0 }}"
                                    data-allow-checkout="{{ $item['allow_checkout'] ?? 0 }}"
                                    value="{{ $item['quantity'] }}" readonly>
                                <button type="button" class="cart-plus" data-id="{{ $id }}" style="background:none; border:none; padding: 0 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; height: 100%;">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="product__sm-price-wrapper">
                                <span class="product__sm-price" style="color: #678E61; font-weight: 600;">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                            <a href="javascript:void(0)" class="cartmini__del" data-id="{{ $id }}"><i class="fas fa-trash"></i></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-shopping-basket mb-3" style="font-size: 40px; color: #eee;"></i>
                    <p class="text-muted">Your cart is empty</p>
                    <a href="{{ route('frontend.products.index') }}" class="tp-btn mt-10">Shop Now</a>
                </div>
            @endif
        </div>
    </div>
    
    @if(count($cart) > 0)
    <div class="cartmini__checkout">
        <div class="cartmini__checkout-title mb-20">
            <div class="d-flex justify-content-between align-items-center mb-10">
                <span>Subtotal:</span>
                <h4 class="mb-0">₹{{ number_format($subtotal, 2) }}</h4>
            </div>
            <p class="small text-muted mb-0">Taxes and shipping calculated at checkout</p>
        </div>
        <div class="cartmini__checkout-btn d-flex gap-2">
            <a href="{{ route('frontend.checkout.index') }}" class="tp-btn flex-grow-1 py-3" style="background-color: #010f1c; color: #fff;">Checkout</a>
            <a href="{{ route('frontend.cart.index') }}" class="tp-btn tp-btn-border flex-grow-1 py-3">View Cart</a>
        </div>
    </div>
    @endif
</div>

