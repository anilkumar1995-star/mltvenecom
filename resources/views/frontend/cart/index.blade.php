@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Shofy E-commerce')

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
        position: relative;
    }
    .breadcrumb__title {
        font-size: 40px;
        font-weight: 600;
        color: #010f1c;
        margin-bottom: 5px;
    }
    .breadcrumb__list span {
        font-size: 14px;
        color: #55585b;
        position: relative;
    }
    .breadcrumb__list span:not(:last-child)::after {
        content: ".";
        margin: 0 10px;
        font-weight: 700;
    }
    .breadcrumb__list span a {
        color: #010f1c;
    }

    /* Grid Cart Styling */
    .cart-item-row:hover {
        background-color: #fcfcfc;
    }
    .btn-ghost-danger {
        color: #dc3545;
        background: transparent;
        transition: 0.2s;
    }
    .btn-ghost-danger:hover {
        background: #fff5f5;
        color: #c82333;
    }
    
    @media (max-width: 768px) {
        .breadcrumb__title { font-size: 24px !important; }
        .product-name-responsive { font-size: 13px !important; }
        .product-sku-responsive { font-size: 10px !important; }
        .fs-responsive { font-size: 13px !important; }
        
        .tp-product-quantity {
            width: 85px !important;
            height: 30px !important;
        }
        .page-cart-qty-input {
            width: 25px !important;
            font-size: 13px !important;
            color: #010f1c !important;
        }
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pt-40 pb-40 mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">Shopping Cart</h3>
                        <div class="breadcrumb__list">
                           <span><a href="{{ route('frontend.home') }}">Home</a></span>
                           <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container pb-100">

    @if(empty($cart) || count($cart) == 0)
        <div id="empty-cart-message" class="text-center py-5">
            <div class="mb-4">
                <img src="{{ asset('home/empty-cart.png') }}" alt="Empty Cart" style="max-width: 250px; opacity: 0.8;">
            </div>
            <h4 class="fw-bold text-dark">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary px-5 py-3 fw-bold" style="border-radius: 8px;">
                Start Shopping
            </a>
        </div>
        <div id="cart-content" class="row d-none">
    @else
        <div id="empty-cart-message" class="text-center py-5 d-none">
            <div class="mb-4">
                <img src="{{ asset('home/empty-cart.png') }}" alt="Empty Cart" style="max-width: 250px; opacity: 0.8;">
            </div>
            <h4 class="fw-bold text-dark">Your cart is empty</h4>
            <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary px-5 py-3 fw-bold" style="border-radius: 8px;">
                Start Shopping
            </a>
        </div>
        <div id="cart-content" class="row">
            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body p-0">
                        {{-- Header - Hidden on mobile --}}
                        <div class="d-none d-md-flex row align-items-center fw-bold text-muted border-bottom py-3 px-4" style="font-size: 13px; background: #fafafa; border-radius: 8px 8px 0 0;">
                            <div class="col-6">PRODUCT</div>
                            <div class="col-2 text-center">PRICE</div>
                            <div class="col-2 text-center">QUANTITY</div>
                            <div class="col-2 text-end">SUBTOTAL</div>
                        </div>

                        {{-- Product Rows --}}
                        <div id="cart-items-container">
                            @foreach($cart as $id => $item)
                            <div class="cart-item-row p-3 p-md-4 border-bottom position-relative" 
                                data-product-id="{{ $id }}" data-price="{{ $item['price'] }}" 
                                data-min="{{ $item['min_qty'] ?? 0 }}" 
                                data-max="{{ $item['max_qty'] ?? 0 }}"
                                data-stock="{{ $item['stock_qty'] ?? 0 }}"
                                data-with-storehouse="{{ $item['with_storehouse'] ?? 0 }}"
                                data-allow-checkout="{{ $item['allow_checkout'] ?? 0 }}">
                                
                                <div class="row align-items-center g-3">
                                    {{-- Product Image & Name --}}
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative">
                                                @if($item['image'])
                                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() . $item['image'] }}" alt="{{ $item['name'] }}" class="rounded shadow-sm" style="width: 70px; height: 70px; object-fit: cover;">
                                                @else
                                                    <img src="https://via.placeholder.com/70" alt="{{ $item['name'] }}" class="rounded shadow-sm">
                                                @endif
                                            </div>
                                            <div class="ms-3 pe-4">
                                                <h6 class="mb-1 fw-bold text-dark product-name-responsive" style="font-size: 14px;">{{ $item['name'] }}</h6>
                                                <div class="text-muted product-sku-responsive" style="font-size: 11px;">Slug: {{ $item['slug'] }}</div>
                                                <div style="font-size: 10px; color: #666;">
                                                    @if(isset($item['weight']) && (float)$item['weight'] > 0)
                                                        1 pack ({{ (float)$item['weight'] }} {{ $item['unit_type'] ?? 'kg' }})
                                                    @else
                                                        1 unit
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-4 col-md-2 text-md-center">
                                        <div class="d-md-none small text-muted mb-1">Price</div>
                                        <div class="fw-bold fs-responsive text-muted">₹{{ number_format($item['price'], 2) }}</div>
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="col-4 col-md-2 text-center">
                                        <div class="d-md-none small text-muted mb-1">Quantity</div>
                                        <div class="tp-product-quantity d-inline-flex align-items-center justify-content-between mx-auto" style="background-color: #F3F5F6; height: 34px; border-radius: 6px; width: 95px; padding: 0 8px;">
                                            <span class="d-flex align-items-center justify-content-center page-cart-qty-btn" data-action="minus" style="cursor:pointer; width:25px; height:100%;">
                                                <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            <input type="text" value="{{ $item['quantity'] }}" data-id="{{ $id }}" class="page-cart-qty-input text-center m-0 bg-transparent border-0 fw-bold" style="flex-grow: 1; min-width: 0; width: 30px; outline: none; font-size: 14px; color: #010f1c; height: 100%; padding: 0;" readonly>
                                            <span class="d-flex align-items-center justify-content-center page-cart-qty-btn" data-action="plus" style="cursor:pointer; width:25px; height:100%;">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Subtotal --}}
                                    <div class="col-4 col-md-2 text-end">
                                        <div class="d-md-none small text-muted mb-1">Subtotal</div>
                                        <div class="item-subtotal text-primary fw-bold fs-responsive">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                                    </div>
                                </div>

                                {{-- Remove Button --}}
                                <button type="button" class="btn btn-sm btn-ghost-danger page-cart-remove-btn position-absolute" style="top: 15px; right: 15px; border-radius: 50%; width: 32px; height: 32px; padding: 0;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Cart Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong id="summary-subtotal">₹{{ number_format($total ?? 0, 2) }}</strong>
                        </div>
                        @php
                            $taxItem = \App\Models\Tax::where('status', 'published')->orderBy('priority', 'desc')->first();
                            $taxPercentage = $taxItem ? (float) $taxItem->percentage : 0;
                            $taxTitle = $taxItem ? $taxItem->title : 'Tax';
                            $taxAmount = ($total ?? 0) * ($taxPercentage / 100);
                        @endphp
                        <div class="d-flex justify-content-between mb-2">
                            <span id="dynamic-tax-label">{{ $taxTitle }} ({{ $taxPercentage }}%):</span>
                            <strong id="summary-tax">₹{{ number_format($taxAmount, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <strong id="summary-shipping">₹0.00</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-primary" id="summary-total">₹{{ number_format(($total ?? 0) + $taxAmount, 2) }}</strong>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('frontend.checkout.index') }}" class="btn btn-primary flex-grow-1">
                                Checkout
                            </a>
                            <a href="{{ route('frontend.products.index') }}" class="btn btn-outline-secondary flex-grow-1">
                                Continue
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</main>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    function formatCurrency(amount) {
        return '₹' + amount.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    function updateSummary(subtotal) {
        if (subtotal <= 0) {
            $('#cart-content').addClass('d-none');
            $('#empty-cart-message').removeClass('d-none');
            return;
        }

        var taxRate = {{ isset($taxPercentage) ? $taxPercentage : 0 }} / 100;
        var tax = subtotal * taxRate;
        var shipping = 0.00;
        var total = subtotal + tax + shipping;

        $('#summary-subtotal').text(formatCurrency(subtotal));
        $('#summary-tax').text(formatCurrency(tax));
        $('#summary-total').text(formatCurrency(total));
    }

    function removeRow(productId) {
        var $row = $('.cart-item-row[data-product-id="' + productId + '"]');
        $row.remove();
        
        var anyRows = $('.cart-item-row').length > 0;
        if (!anyRows) {
            $('#cart-content').addClass('d-none');
            $('#empty-cart-message').removeClass('d-none');
        }
    }

    $('.page-cart-qty-btn').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var action = $btn.data('action');
        var $row = $btn.closest('.cart-item-row');
        var productId = $row.data('product-id');
        var price = parseFloat($row.data('price'));
        var $input = $row.find('.page-cart-qty-input');
        
        var currentQty = parseInt($input.val()) || 1;
        var minQty = parseInt($row.data('min')) || 0;
        var maxQty = parseInt($row.data('max')) || 0;
        var stockQty = parseInt($row.data('stock')) || 0;
        var withStorehouse = $row.data('with-storehouse') == '1';
        var allowCheckout = $row.data('allow-checkout') == '1';
        
        var newQty = action === 'plus' ? currentQty + 1 : currentQty - 1;

        // Max Check
        if (action === 'plus' && maxQty > 0 && newQty > maxQty) {
            if(typeof notify === 'function') notify('Maximum order quantity is ' + maxQty, 'error');
            return;
        }

        // Stock Check
        if (action === 'plus' && withStorehouse && !allowCheckout && newQty > stockQty) {
            if(typeof notify === 'function') notify('Only ' + stockQty + ' items available in stock.', 'error');
            return;
        }

        // Min Check
        if (action === 'minus' && minQty > 0 && currentQty <= minQty) {
            if(typeof notify === 'function') notify('Minimum order quantity is ' + minQty, 'error');
            return;
        }

        if (newQty <= 0) {
            // Remove item
            $.ajax({
                url: '/cart/remove/' + productId,
                method: 'POST',
                data: { _token: csrfToken, _method: 'DELETE' },
                success: function(res) {
                    if (res.success) {
                        $('.tp-cart-count, [data-bb-value="cart-count"]').text(res.count);
                        if(typeof refreshMiniCart === 'function') refreshMiniCart(res.html);
                        if(typeof notify === 'function') notify('Product removed from cart!', 'success');
                        
                        removeRow(productId);
                        updateSummary(parseFloat(res.subtotal || 0));
                    }
                }
            });
        } else {
            // Update quantity
            $.ajax({
                url: '{{ route("frontend.cart.update") }}',
                method: 'POST',
                data: { _token: csrfToken, product_id: productId, quantity: newQty },
                success: function(res) {
                    if (res.success) {
                        $('.tp-cart-count, [data-bb-value="cart-count"]').text(res.count);
                        if(typeof refreshMiniCart === 'function') refreshMiniCart(res.html);
                        
                        $input.val(newQty);
                        $row.find('.item-subtotal').text(formatCurrency(price * newQty));
                        updateSummary(parseFloat(res.subtotal || 0));
                    } else {
                        if(typeof notify === 'function') notify(res.message || 'Stock limit reached!', 'error');
                    }
                },
                error: function() {
                    if(typeof notify === 'function') notify('Failed to update cart.', 'error');
                }
            });
        }
    });

    $('.page-cart-remove-btn').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var $row = $btn.closest('.cart-item-row');
        var productId = $row.data('product-id');

        $.ajax({
            url: '/cart/remove/' + productId,
            method: 'POST',
            data: { _token: csrfToken, _method: 'DELETE' },
            success: function(res) {
                if (res.success) {
                    $('.tp-cart-count, [data-bb-value="cart-count"]').text(res.count);
                    if(typeof refreshMiniCart === 'function') refreshMiniCart(res.html);
                    if(typeof notify === 'function') notify('Product removed from cart!', 'success');
                    
                    removeRow(productId);
                    updateSummary(parseFloat(res.subtotal || 0));
                }
            }
        });
    });
});
</script>
@endpush

