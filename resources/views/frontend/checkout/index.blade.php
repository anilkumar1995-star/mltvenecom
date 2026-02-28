@extends('frontend.layouts.checkout')

@section('title', 'Checkout - Shofy')

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
    
    /* Reveal Styles */
    #create_pass_box, #shipping_address_box, #tax_information_box { display: none; }
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
                                    <input type="text" name="address[name]" placeholder="Enter your full name" required value="{{ auth('customer')->user()->name ?? (auth('web')->user()->name ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name="address[email]" placeholder="Enter your email" required value="{{ auth('customer')->user()->email ?? (auth('web')->user()->email ?? '') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Phone number</label>
                                    <input type="tel" name="address[phone_display]" placeholder="Enter phone number" value="{{ auth('customer')->user()->phone ?? (auth('web')->user()->phone ?? '') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="country-select">
                                    <label>Country <span class="required">*</span></label>
                                    <select name="address[country]" required>
                                        <option value="US">United States</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="CA">Canada</option>
                                        <option value="AU">Australia</option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>State / Province <span class="required">*</span></label>
                                    <input type="text" name="address[state]" placeholder="State" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>
                                    <input type="text" name="address[city]" placeholder="City" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    <input type="text" name="address[address]" placeholder="Street address" required>
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
                        
                        <!-- Different Address / Billing Logic -->
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
                                                <!-- ... -->
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
                        </div>

                        <!-- Notes and Tax -->
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
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="col-lg-6">
                    <div class="your-order">
                        <h3>Your Order</h3>
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
                                            <span class="amount">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">${{ number_format($subtotal, 2) }}</span></td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Tax</th>
                                        <td>
                                            <ul>
                                                <li><span class="amount">${{ number_format($tax, 2) }}</span></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">${{ number_format($total, 2) }}</span></strong></td>
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
    });
</script>
@endpush
