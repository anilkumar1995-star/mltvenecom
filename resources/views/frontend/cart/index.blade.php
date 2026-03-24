@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Shopping Cart</h2>

    @if(empty($cart) || count($cart) == 0)
        <div id="empty-cart-message" class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">Add some products to get started!</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
        <div id="cart-content" class="row d-none">
    @else
        <div id="empty-cart-message" class="text-center py-5 d-none">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">Add some products to get started!</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
        <div id="cart-content" class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $id => $item)
                                <tr class="cart-item-row" data-product-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item['image'])
                                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px; object-fit: cover;" class="me-3">
                                            @else
                                                <img src="https://via.placeholder.com/60" alt="{{ $item['name'] }}" class="me-3">
                                            @endif
                                            <div>
                                                <strong>{{ $item['name'] }}</strong>
                                                <br>
                                                <small class="text-muted">SKU: {{ $item['slug'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>₹{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <div class="tp-product-quantity d-inline-flex align-items-center justify-content-between" style="background-color: #F3F5F6; height: 38px; border-radius: 4px; width: 110px; padding: 0 10px;">
                                            <span class="d-flex align-items-center justify-content-center page-cart-qty-btn text-decoration-none" data-action="minus" style="cursor:pointer; width:30px; height:100%; color: #010F1C;">
                                                <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            
                                            <input type="text" value="{{ $item['quantity'] }}" class="page-cart-qty-input text-center m-0 bg-transparent border-0 fw-medium text-dark" style="width: 40px; height: 100%; outline: none; font-size: 15px; padding: 0;" readonly>
                                            
                                            <span class="d-flex align-items-center justify-content-center page-cart-qty-btn text-decoration-none" data-action="plus" style="cursor:pointer; width:30px; height:100%; color: #010F1C;">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="item-subtotal"><strong>₹{{ number_format($item['price'] * $item['quantity'], 2) }}</strong></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger page-cart-remove-btn">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (15%):</span>
                            <strong id="summary-tax">₹{{ number_format(($total ?? 0) * 0.15, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <strong id="summary-shipping">₹20.00</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-primary" id="summary-total">₹{{ number_format(($total ?? 0) + (($total ?? 0) * 0.15) + 20, 2) }}</strong>
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

        var tax = subtotal * 0.15;
        var shipping = 20.00;
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
        var newQty = action === 'plus' ? currentQty + 1 : currentQty - 1;

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
                        $row.find('.item-subtotal strong').text(formatCurrency(price * newQty));
                        updateSummary(parseFloat(res.subtotal || 0));
                    }
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

