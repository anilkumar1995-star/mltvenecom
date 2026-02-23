@php
    $cart = session('cart', []);
    $subtotal = 0;
    foreach($cart as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
@endphp

<div class="cartmini__area">
    <div class="cartmini__wrapper">
        <div class="cartmini__title">
            <h4>Shopping Cart</h4>
        </div>
        <div class="cartmini__close">
            <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
        </div>
        <div class="cartmini__widget">
            <div class="cartmini__inner">
                @if(count($cart) > 0)
                    <ul>
                        @foreach($cart as $id => $item)
                        <li>
                            <div class="cartmini__thumb">
                                <a href="{{ route('frontend.products.show', $item['slug'] ?: $item['id']) }}">
                                    @if(isset($item['image']))
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                    @else
                                        <img src="{{ asset('home dashboard_files/product-1.jpg') }}" alt="{{ $item['name'] }}">
                                    @endif
                                </a>
                            </div>
                            <div class="cartmini__content">
                                <h5><a href="{{ route('frontend.products.show', $item['slug'] ?: $item['id']) }}">{{ $item['name'] }}</a></h5>
                                <div class="product-quantity mt-10 mb-10">
                                    <span class="cart-minus" data-id="{{ $id }}">-</span>
                                    <input class="cart-input" type="text" value="{{ $item['quantity'] }}" readonly>
                                    <span class="cart-plus" data-id="{{ $id }}">+</span>
                                </div>
                                <div class="product__sm-price-wrapper">
                                    <span class="product__sm-price">${{ number_format($item['price'], 2) }}</span>
                                </div>
                            </div>
                            <a href="{{ route('frontend.cart.remove', $id) }}" class="cartmini__del" onclick="event.preventDefault(); document.getElementById('remove-cart-{{ $id }}').submit();"><i class="fal fa-times"></i></a>
                            <form id="remove-cart-{{ $id }}" action="{{ route('frontend.cart.remove', $id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Your cart is empty</p>
                @endif
            </div>
            <div class="cartmini__checkout">
                <div class="cartmini__checkout-title mb-30">
                    <h4>Subtotal:</h4>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="cartmini__checkout-btn">
                    <a href="{{ route('frontend.cart.index') }}" class="tp-btn mb-10 w-100"> view cart</a>
                    <a href="{{ route('frontend.checkout.index') }}" class="tp-btn tp-btn-border w-100"> checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
