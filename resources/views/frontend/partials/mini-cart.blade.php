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
            <h4>Shopping cart</h4>
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
                                        <img src="{{ asset('home-dashboard-files/product-1.jpg') }}" alt="{{ $item['name'] }}">
                                    @endif
                                </a>
                            </div>
                            <div class="cartmini__content">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h5><a href="{{ route('frontend.products.show', $item['slug'] ?: $item['id']) }}">{{ $item['name'] }}</a></h5>
                                    <a href="{{ route('frontend.cart.remove', $id) }}" class="cartmini__del" onclick="event.preventDefault(); document.getElementById('remove-cart-{{ $id }}').submit();"><i class="fal fa-times"></i></a>
                                </div>
                                <div class="product-quantity mt-10 mb-10">
                                    <span class="cart-minus" data-id="{{ $id }}">-</span>
                                    <input class="cart-input" type="text" value="{{ $item['quantity'] }}" readonly>
                                    <span class="cart-plus" data-id="{{ $id }}">+</span>
                                </div>
                                <div class="product__sm-price-wrapper">
                                    <span class="product__sm-price" style="color: #678E61; font-weight: bold;">${{ number_format($item['price'], 2) }}</span>
                                    {{-- <span class="product__sm-price old-price" style="text-decoration: line-through; color: #999; margin-left: 5px;">$100.00</span> --}}
                                </div>
                            </div>
                            
                            <form id="remove-cart-{{ $id }}" action="{{ route('frontend.cart.remove', $id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center pt-20">Your cart is empty</p>
                @endif
            </div>
            <div class="cartmini__checkout">
                <div class="cartmini__checkout-title mb-30">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax:</span>
                        <span>${{ number_format($subtotal * 0.15, 2) }}</span> <!-- Assuming 15% tax as per screenshot -->
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                        <h4 style="font-size: 18px;">Total:</h4>
                        <span style="font-size: 18px; font-weight: bold;">${{ number_format($subtotal * 1.15, 2) }}</span>
                    </div>
                </div>
                <div class="cartmini__checkout-btn">
                    <a href="{{ route('frontend.checkout.index') }}" class="tp-btn mb-10 w-100" style="background-color: #010f1c; color: #fff; border-radius: 0;">Checkout</a>
                    <a href="{{ route('frontend.cart.index') }}" class="tp-btn tp-btn-border w-100" style="border-radius: 0;">View Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>
