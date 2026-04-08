@extends('frontend.layouts.app')

@section('title', 'Order Success - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                    <h2>Order Placed Successfully!</h2>
                    <p class="text-muted mb-4">Thank you for your order. We'll send you a confirmation email shortly.</p>
                    
                    @if($order)
                    <div class="mt-4 text-start bg-light p-3 rounded">
                        <p class="mb-1">Order Code: <strong>{{ $order->code }}</strong></p>
                        <p class="mb-1">Payment Mode: <strong>{{ ucfirst(str_replace('_', ' ', $order->payment?->payment_channel ?? 'N/A')) }}</strong></p>
                        <p class="mb-0">Payment Status: <strong>{{ ucfirst($order->payment?->status ?? 'Pending') }}</strong></p>
                    </div>
                    @elseif($order_id)
                    <p>Order ID: <strong>#{{ $order_id }}</strong></p>
                    @endif
                    
                    <div class="d-grid gap-2 mt-4">
                        <a href="{{ route('frontend.home') }}" class="btn btn-primary">Continue Shopping</a>
                        @auth('customer')
                        <a href="{{ route('frontend.customer.orders') }}" class="btn btn-outline-primary">View My Orders</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
