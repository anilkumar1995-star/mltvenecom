@extends('frontend.layouts.app')

@section('title', 'Checkout - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <form action="{{ route('frontend.checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Billing Details -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Billing Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone *</label>
                                <input type="tel" name="phone" class="form-control" required value="{{ old('phone') }}">
                                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Address *</label>
                                <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
                                @error('address')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City *</label>
                                <input type="text" name="city" class="form-control" required value="{{ old('city') }}">
                                @error('city')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">State *</label>
                                <input type="text" name="state" class="form-control" required value="{{ old('state') }}">
                                @error('state')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Zip Code *</label>
                                <input type="text" name="zip_code" class="form-control" required value="{{ old('zip_code') }}">
                                @error('zip_code')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Country *</label>
                                <input type="text" name="country" class="form-control" required value="{{ old('country') }}">
                                @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label" for="cod">
                                Cash on Delivery
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                            <label class="form-check-label" for="card">
                                Credit/Debit Card
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                            <label class="form-check-label" for="paypal">
                                PayPal
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                            <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                        @endforeach
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>${{ number_format($subtotal, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <strong>${{ number_format($tax, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <strong>${{ number_format($shipping, 2) }}</strong>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-primary fs-4">${{ number_format($total, 2) }}</strong>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
