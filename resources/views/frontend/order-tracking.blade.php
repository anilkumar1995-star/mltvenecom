@extends('frontend.layouts.app')

@section('title', 'Order Tracking - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Track Your Order</h1>

            <div class="card mb-5">
                <div class="card-body p-4">
                    <form action="{{ route('frontend.orders.tracking') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Order ID</label>
                            <input type="text" name="order_id" class="form-control" placeholder="e.g. #10000001" required value="{{ request('order_id') }}">
                            <div class="form-text">Found in your order confirmation email.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Billing Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email@example.com" value="{{ request('email') }}">
                        </div>

                        <div class="text-center my-3">
                            <span class="text-muted">OR</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Your phone number" value="{{ request('phone') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Track Order</button>
                        </div>
                    </form>
                </div>
            </div>

            @if(isset($order) && $order)
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Order Found: {{ $order->code }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Status</h6>
                                <span class="badge bg-info">{{ $order->status }}</span>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h6>Date</h6>
                                <p>{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <h6>Items</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->products as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>${{ number_format($item->price * $item->qty, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Shipping Address</h6>
                                <address>
                                    {{ $order->address->name }}<br>
                                    {{ $order->address->address }}<br>
                                    {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                                    {{ $order->address->country }}
                                </address>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5>Total: ${{ number_format($order->amount, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(request()->isMethod('post'))
                <div class="alert alert-danger">
                    Order not found. Please check your details and try again.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
