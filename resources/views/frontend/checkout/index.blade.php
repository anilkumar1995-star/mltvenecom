<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout - Shofy</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('home dashboard_files/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home dashboard_files/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('home dashboard_files/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('home dashboard_files/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home dashboard_files/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout-custom.css') }}">
    
    <style>
        body { background-color: #fff; }
        .checkout-wrapper { max-width: 1200px; margin: 0 auto; padding: 40px 15px; }
        .checkout-left { padding-right: 40px; border-right: 1px solid #e5e7eb; }
        .checkout-right { padding-left: 40px; }
        
        .shofy-logo { margin-bottom: 30px; display: block; }
        .shofy-logo img { height: 40px; }
        
        .breadcrumb-nav { margin-bottom: 20px; font-size: 14px; color: #6b7280; }
        .breadcrumb-nav a { color: #0989ff; text-decoration: none; }
        .breadcrumb-nav span { margin: 0 5px; }
        
        .section-header { margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .section-header h4 { font-size: 18px; font-weight: 600; margin: 0; }
        .section-header a { font-size: 14px; text-decoration: none; color: #0989ff; }
        
        .form-floating-custom { position: relative; margin-bottom: 15px; }
        .form-floating-custom input, .form-floating-custom select {
            height: 50px;
            border-radius: 5px;
            border: 1px solid #d1d5db;
            padding: 0 15px;
            width: 100%;
            font-size: 14px;
        }
        .form-floating-custom label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            transition: 0.2s;
            background: #fff;
            padding: 0 5px;
        }
        .form-floating-custom input:focus, .form-floating-custom input:not(:placeholder-shown) {
            border-color: #0989ff;
        }
        /* Simulate floating label if needed, or just standard */
        
        .shipping-method-item {
            border: 1px solid #d1d5db;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        .shipping-method-item:hover { border-color: #0989ff; }
        .shipping-method-item input { margin-right: 10px; }
        
        @media (max-width: 991px) {
            .checkout-left { border-right: none; padding-right: 0; }
            .checkout-right { padding-left: 0; margin-top: 30px; }
        }
        
        .coupon-box {
            border: 1px dashed #0989ff;
            background: #f0f9ff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .coupon-item {
            background: #fff;
            border: 1px solid #e5e7eb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .coupon-code { font-weight: 700; color: #1f2937; }
        .coupon-desc { font-size: 12px; color: #6b7280; }
        
    </style>
</head>
<body>

                    <p class="text-muted small ps-4 mb-3" id="cod-text">Please pay money directly to the postman, if you choose cash on delivery method (COD).</p>
                    
                    <label class="payment-method-item">
                        <div class="d-flex align-items-center">
                            <input class="form-check-input payment-method-radio" type="radio" name="payment_method" value="bank_transfer">
                            <span>Bank transfer</span>
                        </div>
                        <div class="payment-method-icons">
                            <i class="fas fa-university text-muted fs-5"></i>
                        </div>
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Order notes</label>
                    <textarea name="note" class="form-control-checkout" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                </div>
                
                <div class="mb-3">
                    <div class="form-check">
                         <input class="form-check-input" type="checkbox" id="invoice" name="invoice">
                        <label class="form-check-label text-muted" for="invoice">
                            Requires company invoice (Please fill in your company information to receive the invoice)?
                        </label>
                    </div>
                </div>
                
                 <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('frontend.cart.index') }}" class="text-decoration-none text-muted"><i class="fas fa-arrow-left me-1"></i> Back to cart</a>
                    <button type="submit" class="btn btn-primary btn-lg px-5">Checkout</button>
                </div>

            </form>
        </div>

        <!-- Right Column (Sidebar) -->
        <div class="col-lg-5 checkout-right">
            <h5 class="mb-4">Product(s)</h5>
            @foreach($cart as $item)
            <div class="summary-product-item">
                <div class="position-relative">
                    <img src="{{ isset($item['image']) ? asset('storage/' . $item['image']) : asset('home dashboard_files/product-1.jpg') }}" class="summary-product-img" alt="{{ $item['name'] }}">
                    <span class="summary-product-badge">{{ $item['quantity'] }}</span>
                </div>
                <div class="summary-product-info">
                    <h6>{{ $item['name'] }}</h6>
                </div>
                <div class="summary-product-price">
                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                </div>
            </div>
            @endforeach
            
            <div class="mt-4 mb-4">
                <h6 class="mb-3">Shipping method:</h6>
                <label class="shipping-method-item">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="shipping_method" value="free_shipping" checked>
                        <strong>Local Pickup - Free shipping</strong>
                    </div>
                    <span>$0.00</span>
                </label>
                <label class="shipping-method-item">
                    <div class="d-flex align-items-center">
                        <input class="form-check-input" type="radio" name="shipping_method" value="flat_rate">
                        <span>Flat Rate</span>
                    </div>
                    <span>$20.00</span>
                </label>
            </div>

            <div class="summary-calculations">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax:</span>
                    <span>${{ number_format($tax, 2) }} (Import Tax - 15%)</span>
                </div>
                <div class="summary-row">
                    <span>Shipping fee:</span>
                    <span id="shipping-fee-display">Free shipping</span>
                </div>
                <div class="summary-row total">
                    <span>Total:</span>
                    <span class="text-primary" id="total-display">${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <!-- Coupon Codes -->
            <div class="coupon-box">
                <h6 class="mb-3 border-bottom pb-2 text-primary"><i class="fas fa-ticket-alt me-2"></i> Coupon codes (6)</h6>
                <div style="max-height: 300px; overflow-y: auto;">
                    <!-- Coupon 1 -->
                    <div class="coupon-item">
                        <div>
                            <div class="coupon-code">XVBU4T3KJ6CQ</div>
                            <div class="coupon-desc">Free shipping to All orders...</div>
                        </div>
                        <button class="btn btn-sm btn-primary">Apply</button>
                    </div>
                     <!-- Coupon 2 -->
                    <div class="coupon-item">
                        <div>
                            <div class="coupon-code">FVKPEBKFGIFH</div>
                            <div class="coupon-desc">Discount 10% for all orders</div>
                        </div>
                        <button class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    <!-- Coupon 3 -->
                    <div class="coupon-item">
                        <div>
                            <div class="coupon-code">W2IHOTPBEPLJ</div>
                            <div class="coupon-desc">Discount 79% for all orders</div>
                        </div>
                        <button class="btn btn-sm btn-primary">Apply</button>
                    </div>
                </div>
                
                 <div class="mt-3">
                    <a href="#" class="text-decoration-none small">You have a coupon code?</a>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js.download') }}"></script>
<script src="{{ asset('js/checkout-custom.js') }}"></script>
<script>
    $(document).ready(function() {
        // Dynamic Total Calculation
        $('input[name="shipping_method"]').change(function() {
             let val = $(this).val();
             let subtotal = {{ $subtotal }};
             let tax = {{ $tax }};
             let shipping = val === 'flat_rate' ? 20 : 0;
             let total = subtotal + tax + shipping;
             
             $('#total-display').text('$' + total.toFixed(2));
        });
    });
</script>

</body>
</html>
