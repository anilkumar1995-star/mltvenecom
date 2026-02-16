@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Shopping Cart</h2>

    @if(empty($cart) || count($cart) == 0)
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h4>Your cart is empty</h4>
            <p class="text-muted">Add some products to get started!</p>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    @else
        <div class="row">
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
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item['image'])
                                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px; object-fit: cover;" class="me-3">
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
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form action="{{ route('frontend.cart.update') }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $id }}">
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm" style="width: 80px;" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td><strong>${{ number_format($item['price'] * $item['quantity'], 2) }}</strong></td>
                                    <td>
                                        <form action="{{ route('frontend.cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax (15%):</span>
                            <strong>${{ number_format($total * 0.15, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping:</span>
                            <strong>$20.00</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Total:</strong>
                            <strong class="text-primary">${{ number_format($total + ($total * 0.15) + 20, 2) }}</strong>
                        </div>
                        <a href="{{ route('frontend.checkout.index') }}" class="btn btn-primary w-100 mb-2">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('frontend.products.index') }}" class="btn btn-outline-secondary w-100">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
