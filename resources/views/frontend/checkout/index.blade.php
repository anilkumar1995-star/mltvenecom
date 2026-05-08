@extends('frontend.layouts.checkout')

@section('title', 'Checkout - iPaymnt Tech')

@push('styles')
<style>
    .checkout-area { padding: 50px 0; background: #fff; }
    .checkout-form-list { margin-bottom: 25px; }
    .checkout-form-list label { 
        color: #55585b; font-size: 14px; margin-bottom: 8px; display: block; font-weight: 500;
    }
    .checkout-form-list label .required { color: red; }
    .checkout-form-list input[type="text"],
    .checkout-form-list input[type="password"],
    .checkout-form-list input[type="email"],
    .checkout-form-list input[type="tel"],
    .checkout-form-list textarea,
    .checkout-form-list select {
        height: 50px; width: 100%; border: 1px solid #d9d9d9; background: #fff;
        padding: 0 20px; font-size: 14px; color: #010f1c; border-radius: 0;
        margin-bottom: 0; transition: .3s;
    }
    .checkout-form-list textarea { height: 120px; padding: 20px; resize: none; }
    .checkout-form-list input:focus, .checkout-form-list select:focus, .checkout-form-list textarea:focus { border-color: #197BBD; }
    
    .country-select { margin-bottom: 25px; }
    .country-select select { width: 100%; background-color: transparent; border: 1px solid #d9d9d9; height: 50px; border-radius: 0; padding: 0 20px; }
    
    .checkbox-form h3 { font-size: 24px; font-weight: 600; color: #010f1c; margin-bottom: 30px; border-bottom: 1px solid #e5e6e8; padding-bottom: 10px; }
    
    .create-acc-checkbox, .different-address { margin-bottom: 20px; margin-top: 15px;}
    .create-acc-checkbox input, .different-address input { width: auto; height: auto; margin-right: 10px; position: relative; top: 2px; }
    .create-acc-checkbox label, .different-address label { display: inline-block; cursor: pointer; color: #55585b; }
    
    /* Order Summary */
    .your-order { background: #f6f6f6; padding: 30px 40px; border-radius: 0; }
    .your-order h3 { font-size: 24px; font-weight: 600; color: #010f1c; margin-bottom: 30px; border-bottom: 1px solid #d9d9d9; padding-bottom: 10px; }
    .your-order-table table { width: 100%; }
    .your-order-table table th { border-bottom: 1px solid #d9d9d9; font-size: 16px; font-weight: 500; color: #010f1c; padding: 15px 0; text-align: left; }
    .your-order-table table .product-name { color: #55585b; font-size: 14px; padding: 15px 0; border-bottom: 1px solid #d9d9d9; }
    .your-order-table table .product-total { color: #010f1c; font-size: 14px; font-weight: 500; padding: 15px 0; border-bottom: 1px solid #d9d9d9; text-align: right; }
    .your-order-table table .cart-subtotal th, .your-order-table table .shipping th { border-bottom: 1px solid #d9d9d9; font-weight: 500; padding: 15px 0; }
    .your-order-table table .cart-subtotal td, .your-order-table table .shipping td { border-bottom: 1px solid #d9d9d9; color: #010f1c; font-weight: 500; padding: 15px 0; text-align: right; }
    .your-order-table table .order-total th { border-bottom: none; font-size: 18px; font-weight: 600; color: #010f1c; padding: 20px 0; }
    .your-order-table table .order-total td { border-bottom: none; font-size: 18px; font-weight: 600; color: #197BBD; padding: 20px 0; text-align: right; }
    
    /* Payment Methods */
    .payment-method { margin-top: 30px; }
    .payment-accordion .accordion-item { border: none; margin-bottom: 15px; border-bottom: 1px solid #d9d9d9; background: transparent; }
    .payment-accordion .accordion-button { background: none; box-shadow: none; padding: 15px 0; color: #010f1c; font-weight: 500; font-size: 16px; }
    .payment-accordion .accordion-button:not(.collapsed) { color: #197BBD; background: none; }
    .payment-accordion .accordion-body { padding: 0 0 15px 0; color: #55585b; font-size: 14px; }
    
    .place-order-btn { margin-top: 30px; }
    .place-order-btn .tp-btn { 
        width: 100%; display: block; text-align: center;
        background-color: #197BBD; color: #fff; padding: 12px 30px; 
        font-weight: 600; font-size: 16px; border-radius: 0; border: none;
        height: 54px; line-height: 30px;
    }
    .place-order-btn .tp-btn:hover { background-color: #156296; }
    
    /* Modal Styling */
    #discountModal .modal-content { border-radius: 12px; border: none; overflow: hidden; }
    #discountModal .modal-header { background: #f8f9fa; border-bottom: 1px solid #eee; padding: 20px; }
    #discountModal .modal-title { font-weight: 700; color: #010f1c; }
    
    .coupon-card { 
        border: 2px dashed #d9d9d9; border-radius: 10px; padding: 15px; margin-bottom: 15px; 
        transition: all 0.3s ease; cursor: pointer; position: relative; background: #fff;
    }
    .coupon-card:hover { border-color: #197BBD; background: #f0f7ff; transform: translateY(-2px); }
    .coupon-card .code-badge { 
        background: #197BBD; color: #fff; padding: 5px 12px; border-radius: 20px; 
        font-weight: 700; font-size: 14px; margin-bottom: 8px; display: inline-block;
    }
    .coupon-card .offer-value { color: #010f1c; font-weight: 700; font-size: 18px; margin-bottom: 4px; }
    .coupon-card .offer-desc { color: #55585b; font-size: 13px; line-height: 1.4; }
    .coupon-card .copy-btn { 
        position: absolute; top: 15px; right: 15px; color: #197BBD; font-weight: 600; font-size: 13px; 
        text-transform: uppercase;
    }
    .view-offers-link { 
        color: #197BBD; font-size: 13px; font-weight: 600; text-decoration: underline; 
        display: inline-block; margin-top: 8px; cursor: pointer;
    }
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb__area">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="breadcrumb__content">
                    <h3 class="breadcrumb__title">Checkout</h3>
                    <div class="breadcrumb__list">
                        <span><a href="{{ route('frontend.home') }}">Home</a></span>
                        <span><i class="far fa-angle-right"></i></span>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Area -->
<section class="checkout-area">
    <div class="container">
        <form action="{{ route('frontend.checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Left Column: Billing/Shipping Details -->
                <div class="col-lg-6">
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Full Name <span class="required">*</span></label>
                                    <input type="text" name="address[name]" placeholder="Enter your full name" required value="{{ old('address.name', $defaultAddress->name ?? (auth('customer')->user()->name ?? (auth('web')->user()->name ?? ''))) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="address[email]" placeholder="Enter your email" required value="{{ old('address.email', $defaultAddress->email ?? (auth('customer')->user()->email ?? (auth('web')->user()->email ?? ''))) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Phone number</label>
                                    <input type="tel" name="address[phone_display]" placeholder="Enter phone number" value="{{ old('address.phone_display', $defaultAddress->phone ?? (auth('customer')->user()->phone ?? (auth('web')->user()->phone ?? ''))) }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="country-select">
                                    <label>Country <span class="required">*</span></label>
                                    <select name="address[country]" required>
                                        <option value="IN" {{ (old('address.country', $defaultAddress->country ?? '') == 'IN') ? 'selected' : '' }}>India</option>
                                        <option value="US" {{ (old('address.country', $defaultAddress->country ?? '') == 'US') ? 'selected' : '' }}>United States</option>
                                        <option value="UK" {{ (old('address.country', $defaultAddress->country ?? '') == 'UK') ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="CA" {{ (old('address.country', $defaultAddress->country ?? '') == 'CA') ? 'selected' : '' }}>Canada</option>
                                        <option value="AU" {{ (old('address.country', $defaultAddress->country ?? '') == 'AU') ? 'selected' : '' }}>Australia</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>State / Province <span class="required">*</span></label>
                                    <input type="text" name="address[state]" placeholder="State" required value="{{ old('address.state', $defaultAddress->state ?? '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" name="address[city]" placeholder="City" required value="{{ old('address.city', $defaultAddress->city ?? '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address[address]" placeholder="Street address" required value="{{ old('address.address', $defaultAddress->address ?? '') }}">
                                </div>
                            </div>

                            <!-- Create Account Checkbox -->
                            @if(!auth('customer')->check() && !auth('web')->check())
                            <div class="col-md-12">
                                <div class="checkout-form-list create-acc-checkbox">
                                    <input id="create_account" type="checkbox" name="create_account">
                                    <label for="create_account">Register an account with above information?</label>
                                </div>
                                <div id="create_pass_box" class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Confirm Password <span class="required">*</span></label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Different Address / Billing Logic 
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>
                                    <label>
                                        Billing Information
                                    </label>
                                </h3>
                            </div>
                            <div class="checkout-form-list create-acc-checkbox">
                                <input id="billing_address_same_as_shipping_address" type="checkbox" name="billing_address_same_as_shipping_address" value="1" checked>
                                <label for="billing_address_same_as_shipping_address">Same as shipping information</label>
                            </div>

                            <div id="shipping_address_box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Full Name</label>
                                            <input type="text" name="billing_address[name]" placeholder="Enter your full name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Email</label>
                                            <input type="email" name="billing_address[email]" placeholder="Enter your email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Phone</label>
                                            <input type="tel" name="billing_address[phone_display]" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="country-select">
                                            <label>Country</label>
                                            <select name="billing_address[country]">
                                                <option value="US">United States</option>
                                                <option value="UK">United Kingdom</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>State / Province</label>
                                            <input type="text" name="billing_address[state]" placeholder="State">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City</label>
                                            <input type="text" name="billing_address[city]" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address</label>
                                            <input type="text" name="billing_address[address]" placeholder="Street address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>   -->

                        <!-- Notes and Tax 
                        <div class="order-notes">
                            <div class="checkout-form-list">
                                <label>Order notes</label>
                                <textarea name="description" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>

                        <div class="checkout-form-list create-acc-checkbox">
                             <input id="with_tax_information" type="checkbox" name="with_tax_information" value="1">
                             <label for="with_tax_information">Requires company invoice (Please fill in your company information to receive the invoice)?</label>
                        </div>
                        <div id="tax_information_box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input type="text" name="tax_information[company_name]" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Email</label>
                                        <input type="email" name="tax_information[company_email]" placeholder="Company Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Address</label>
                                        <input type="text" name="tax_information[company_address]" placeholder="Company Address">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Tax Code</label>
                                        <input type="text" name="tax_information[company_tax_code]" placeholder="Tax Code">
                                    </div>
                                </div>
                            </div>
                        </div>  -->
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="col-lg-6">
                    <div class="your-order">
                        <h3>Your Order</h3>
                        
                        {{-- Coupon Section --}}
                        <div class="checkout-coupon mb-30">
                            <div class="row g-2 align-items-center">
                                <div class="col-8">
                                    <div class="position-relative">
                                        <input type="text" id="coupon_code" class="form-control {{ isset($couponCode) ? 'is-valid border-success' : '' }}" 
                                            placeholder="Enter coupon code" value="{{ $couponCode ?? '' }}" {{ isset($couponCode) ? 'disabled' : '' }}
                                            style="height: 54px; padding-left: 15px; font-weight: 600;">
                                        @if(isset($couponCode))
                                            <span class="position-absolute translate-middle-y top-50 end-0 me-3 badge bg-success text-white">Applied</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-4">
                                    @if(isset($couponCode))
                                        <a href="{{ route('frontend.checkout.remove-coupon') }}" class="btn btn-danger w-100 d-flex align-items-center justify-content-center px-0" 
                                            style="height: 54px; font-size: 14px; background-color: #dc3545; border: none; font-weight: 600; border-radius: 0;">
                                            <i class="fas fa-trash-alt me-2"></i> Remove
                                        </a>
                                    @else
                                        <button type="button" id="apply_coupon_btn" class="tp-btn w-100" 
                                            style="height: 54px; padding: 0; font-size: 14px; background-color: #197BBD; font-weight: 600;">Apply</button>
                                    @endif
                                </div>
                            </div>
                            <div id="coupon_message" class="mt-2 small"></div>
                            @if(isset($availableDiscounts) && $availableDiscounts->count() > 0)
                                <div class="view-offers-link" data-bs-toggle="modal" data-bs-target="#discountModal">
                                    <i class="fas fa-percentage me-1"></i> View Available Offers
                                </div>
                            @endif
                        </div>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $item)
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{ $item['name'] }} <strong class="product-quantity"> × {{ $item['quantity'] }}</strong>
                                        </td>
                                        <td class="product-total">
                                            <span class="amount">₹{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">₹{{ number_format($subtotal, 2) }}</span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>{{ $taxTitle ?? 'Tax' }} ({{ $taxPercentage ?? 0 }}%)</th>
                                        <td>
                                            <span class="amount">₹{{ number_format($tax, 2) }}</span>
                                        </td>
                                    </tr>
                                    {{-- Shipping removed as requested --}}
                                    @if($discountAmount > 0)
                                    <tr class="shipping text-success">
                                        <th>Discount ({{ $couponCode }})</th>
                                        <td>
                                            <strong>-₹{{ number_format($discountAmount, 2) }}</strong>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">₹{{ number_format($total, 2) }}</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="payment-method">
                            <div class="accordion payment-accordion" id="accordionPayment">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paymentOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                            Direct Bank Transfer
                                        </button>
                                    </h2>
                                    <div id="bankOne" class="accordion-collapse collapse show" aria-labelledby="paymentOne" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paymentTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bankTwo" aria-expanded="false" aria-controls="bankTwo">
                                            Cash on Delivery
                                        </button>
                                    </h2>
                                    <div id="bankTwo" class="accordion-collapse collapse" aria-labelledby="paymentTwo" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Pay with cash upon delivery.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paymentPG">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bankPG" aria-expanded="false" aria-controls="bankPG">
                                            Online Payment
                                        </button>
                                    </h2>
                                    <div id="bankPG" class="accordion-collapse collapse" aria-labelledby="paymentPG" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Pay securely via our online payment gateway. All major credit/debit cards and UPI accepted.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="paymentThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bankThree" aria-expanded="false" aria-controls="bankThree">
                                            PayPal
                                        </button>
                                    </h2>
                                    <div id="bankThree" class="accordion-collapse collapse" aria-labelledby="paymentThree" data-bs-parent="#accordionPayment">
                                        <div class="accordion-body">
                                            Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="payment_method" id="payment_method_input" value="bank_transfer">
                            <div class="place-order-btn">
                                <button type="submit" class="tp-btn" id="place-order-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

<!-- Discount Offers Modal -->
<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="discountModalLabel">Available Discount Offers</h5>
                <button type="button" class="btn-close" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 450px; overflow-y: auto; padding: 20px;">
                @if(isset($availableDiscounts) && $availableDiscounts->count() > 0)
                    @foreach($availableDiscounts as $discount)  
                        <div class="coupon-card" onclick="copyCouponCode('{{ $discount->code }}')" title="Click to copy and apply">
                            <span class="copy-btn">Copy Code</span>
                            <div class="code-badge">{{ $discount->code }}</div>
                            <div class="offer-value">
                                @if($discount->type_option == 'percentage')
                                    {{ (int)$discount->value }}% Discount
                                @elseif($discount->type_option == 'shipping')
                                    FREE SHIPPING (₹{{ number_format($discount->value, 0) }})
                                @else
                                    ₹{{ number_format($discount->value, 0) }} OFF
                                @endif
                                <span class="badge bg-light text-dark border ms-2 small fw-normal">{{ ucfirst($discount->type_option) }} Offer</span>
                            </div>
                            
                            <div class="offer-desc mb-2">
                                <strong>Description:</strong> {{ $discount->description ?? ($discount->title ?? 'Flat discount on your purchase.') }}
                            </div>

                            <div class="offer-details small text-muted">
                                <div class="mb-1">
                                    <i class="far fa-clock me-1"></i> 
                                    @if($discount->end_date)
                                        Valid till: {{ $discount->end_date->format('d M, Y') }}
                                    @else
                                        Lifetime Validity
                                    @endif
                                </div>
                                @if($discount->min_order_price > 0)
                                    <div class="mb-1">
                                        <i class="fas fa-shopping-basket me-1"></i>
                                        Min Order: <strong>₹{{ number_format($discount->min_order_price, 0) }}</strong>
                                    </div>
                                @endif
                                <div class="mb-1">
                                    <i class="fas fa-users me-1"></i>
                                    Redemptions Left: <strong>{{ $discount->quantity ? ($discount->quantity - $discount->total_used) : 'Unlimited' }}</strong>
                                </div>
                            </div>

                            @php
                                $restrictions = [];
                                if($discount->products->count() > 0) $restrictions[] = 'Specific Products';
                                if($discount->productCategories->count() > 0) $restrictions[] = 'Certain Categories';
                            @endphp
                            
                            @if(!empty($restrictions))
                                <div class="mt-2 pt-2 border-top">
                                    <small class="text-danger fw-bold"><i class="fas fa-info-circle me-1"></i> Valid on: {{ implode(', ', $restrictions) }}</small>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No active offers available right now.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer bg-light">
                <small class="text-muted w-100 text-center">Click on any card to copy the code!</small>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Create Account Toggle
        $('#create_account').on('change', function() {
            if ($(this).is(':checked')) {
                $('#create_pass_box').slideDown();
            } else {
                $('#create_pass_box').slideUp();
            }
        });

        // Billing Details Toggle (Same as Shipping)
        $('#billing_address_same_as_shipping_address').on('change', function() {
            if ($(this).is(':checked')) {
                $('#shipping_address_box').slideUp();
            } else {
                $('#shipping_address_box').slideDown();
            }
        });

        // Tax Information Toggle
        $('#with_tax_information').on('change', function() {
            if ($(this).is(':checked')) {
                $('#tax_information_box').slideDown();
            } else {
                $('#tax_information_box').slideUp();
            }
        });

        // Payment Method Selection
        var paymentMethods = {
            'bankOne': 'bank_transfer',
            'bankTwo': 'cod',
            'bankPG': 'online_payment',
            'bankThree': 'paypal'
        };
        $('.payment-accordion .accordion-button').on('click', function() {
            var target = $(this).data('bs-target').replace('#', '');
            if (paymentMethods[target]) {
                $('#payment_method_input').val(paymentMethods[target]);
            }
        });

        // Place Order - loading state
        $('form').on('submit', function() {
            var btn = $('#place-order-btn');
            btn.prop('disabled', true);
            btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...');
        });

        // Apply Coupon
        $('#apply_coupon_btn').on('click', function() {
            var btn = $(this);
            var code = $('#coupon_code').val();
            var messageBox = $('#coupon_message');

            if (!code) {
                messageBox.css('color', 'red').text('Please enter a coupon code.');
                return;
            }

            btn.prop('disabled', true).text('Applying...');

            $.ajax({
                url: '{{ route("frontend.checkout.apply-coupon") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon_code: code
                },
                success: function(response) {
                    if (response.success) {
                        messageBox.css('color', 'green').text(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    } else {
                        btn.prop('disabled', false).text('Apply');
                        messageBox.css('color', 'red').text(response.message);
                    }
                },
                error: function() {
                    btn.prop('disabled', false).text('Apply');
                    messageBox.css('color', 'red').text('Something went wrong. Please try again.');
                }
            });
        });
    });

    /**
     * Copy Coupon Code to Clipboard
     */
    function copyCouponCode(code) {
        navigator.clipboard.writeText(code).then(function() {
            // Put it into the input field
            $('#coupon_code').val(code);
            
            // Show premium feedback
            if (typeof Notify !== 'undefined') {
                new Notify({
                    status: 'success',
                    title: 'Coupon Copied!',
                    text: 'Code: <strong>' + code + '</strong> is ready to use.',
                    effect: 'fade',
                    speed: 300,
                    showIcon: true,
                    autoclose: true,
                    autotimeout: 3000,
                    position: 'right top'
                });
            } else {
                alert('Coupon code ' + code + ' copied to clipboard!');
            }

            // Close the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('discountModal'));
            if (modal) {
                modal.hide();
            }
            
            // Highlight the input
            $('#coupon_code').addClass('is-valid').focus();
            setTimeout(() => {
                $('#coupon_code').removeClass('is-valid');
            }, 1000);

        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endpush
