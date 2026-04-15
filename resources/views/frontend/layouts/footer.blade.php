<footer>
    <div class="tp-footer-area pt-50 pb-10" style="background: #fff; border-top: 1px solid #f1f1f1;">
        <div class="container">
            <div class="row">
                <!-- Branding Section -->
                <div class="col-xl-3 col-lg-3 col-md-12 mb-10 text-center text-lg-start">
                    <div class="tp-footer-widget">
                        <div class="tp-footer-logo mb-25">
                            <a href="{{ url('/') }}">
                                @if(isset($footer_settings->footer_logo))
                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $footer_settings->footer_logo }}" alt="Logo" style="height: 42px;">
                                @else
                                    <h2 style="font-weight: 900; color: #0c831f; margin: 0;">{{ $footer_settings->site_name ?? 'MLTVE' }}</h2>
                                @endif
                            </a>
                        </div>
                        <p style="color: #666; font-size: 14px; line-height: 1.6; max-width: 280px; margin: 0 auto; margin-bottom: 20px;" class="ms-lg-0">
                            {{ $footer_settings->footer_description ?? 'Your daily essentials, delivered in minutes. Experience the magic of quick commerce.' }}
                        </p>
                        <div class="d-flex gap-3 mt-4 justify-content-center justify-content-lg-start">
                             <a href="{{ $footer_settings->facebook_url ?? '#' }}" class="zepto-social-link zepto-facebook"><i class="fab fa-facebook-f"></i></a>
                             <a href="{{ $footer_settings->twitter_url ?? '#' }}" class="zepto-social-link zepto-twitter"><i class="fab fa-twitter"></i></a>
                             <a href="{{ $footer_settings->instagram_url ?? '#' }}" class="zepto-social-link zepto-instagram"><i class="fab fa-instagram"></i></a>
                             @if(isset($footer_settings->youtube_url))
                                <a href="{{ $footer_settings->youtube_url }}" class="zepto-social-link zepto-youtube"><i class="fab fa-youtube"></i></a>
                             @endif
                             @if(isset($footer_settings->linkedin_url))
                                <a href="{{ $footer_settings->linkedin_url }}" class="zepto-social-link zepto-linkedin"><i class="fab fa-linkedin-in"></i></a>
                             @endif
                        </div>
                    </div>
                </div>

                <!-- Shop Column -->
                <div class="col-xl-2 col-lg-2 col-6 mb-40">
                    <div class="tp-footer-widget">
                        <h4 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; color: #1a1a1a;">Shop</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li class="mb-10"><a href="{{ route('frontend.categories.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Shop Categories</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.brands.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Shop Brands</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.products.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">All Products</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.coupons.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Grab Coupons</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Information Column (Restored from screenshot) -->
                <div class="col-xl-2 col-lg-2 col-6 mb-40">
                    <div class="tp-footer-widget">
                        <h4 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; color: #1a1a1a;">Information</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li class="mb-10"><a href="{{ route('frontend.our-story') }}" style="color: #666; font-size: 13px; text-decoration: none;">Our Story</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.careers') }}" style="color: #666; font-size: 13px; text-decoration: none;">Careers</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.cookie-policy') }}" style="color: #666; font-size: 13px; text-decoration: none;">Cookie Policy</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.blog.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Latest News</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.contact.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Contact Us</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Account & Vendor Column -->
                <div class="col-xl-2 col-lg-2 col-6 mb-40">
                    <div class="tp-footer-widget">
                        <h4 style="font-size: 15px; font-weight: 800; margin-bottom: 20px; color: #1a1a1a;">Account</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li class="mb-10"><a href="{{ route('frontend.customer.dashboard') }}" style="color: #666; font-size: 13px; text-decoration: none;">My Account</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.wishlist.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">My Wishlist</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.cart.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Shopping Cart</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.orders.tracking') }}" style="color: #666; font-size: 13px; text-decoration: none;">Track Order</a></li>
                            <li class="mb-10"><a href="{{ route('frontend.stores.index') }}" style="color: #666; font-size: 13px; text-decoration: none;">Vendor Stores</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Talk To Us (Matched to Screenshot) -->
                <div class="col-xl-3 col-lg-3 col-md-12 text-center text-lg-start mb-40">
                    <div class="tp-footer-widget">
                        <h4 style="font-size: 18px; font-weight: 800; margin-bottom: 20px; color: #1a1a1a;">Talk To Us</h4>
                        <div class="mb-25">
                            <p style="font-size: 14px; color: #333; margin-bottom: 5px; font-weight: 600;">Got Questions? Call us</p>
                            <h4 style="margin: 0;"><a href="tel:{{ $footer_settings->footer_phone ?? '1234567890' }}" style="color: #1a1a1a; font-weight: 900; text-decoration: none; font-size: 24px;">{{ $footer_settings->footer_phone ?? '1234567890' }}</a></h4>
                        </div>
                        <div class="mb-20" style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 20px; display: flex; justify-content: center;">
                                <i class="far fa-envelope" style="color: #1a1a1a; font-size: 16px;"></i>
                            </div>
                            <a href="mailto:{{ $footer_settings->footer_email ?? 'support@mltve.com' }}" style="color: #1a1a1a; font-size: 15px; text-decoration: none;">{{ $footer_settings->footer_email ?? 'support@mltve.com' }}</a>
                        </div>
                        <div class="mb-25" style="display: flex; align-items: flex-start; gap: 12px;">
                            <div style="width: 20px; display: flex; justify-content: center; margin-top: 4px;">
                                <i class="fas fa-map-marker-alt" style="color: #1a1a1a; font-size: 16px;"></i>
                            </div>
                            <span style="color: #1a1a1a; font-size: 15px; line-height: 1.4;">{{ $footer_settings->footer_address ?? 'c 90 3rd floor vibhuti khand lucknow' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright -->
    <style>
        .zepto-social-link {
            font-size: 16px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none !important;
            color: #fff !important;
        }
        .zepto-social-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            filter: brightness(1.1);
        }
        .zepto-facebook { background: #1877F2; }
        .zepto-twitter { background: #000000; }
        .zepto-instagram { background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); }
        .zepto-youtube { background: #FF0000; }
        .zepto-linkedin { background: #0A66C2; }

        .tp-footer-widget ul li a {
            display: inline-block;
            padding: 5px 8px;
            margin-left: -8px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
        .tp-footer-widget ul li a:hover {
            color: #0c831f !important;
            background: rgba(12, 131, 31, 0.05);
            padding-left: 12px;
        }
        @media (max-width: 991px) {
            .tp-footer-area {
                padding-bottom: 0px !important;
            }
        }
    </style>
    <div class="py-4" style="background: #fff; border-top: 1px solid #f1f1f1;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0" style="color: #999; font-size: 13px; font-weight: 500;">© {{ date('Y') }} {{ $footer_settings->site_name ?? 'MLTVE' }}</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
                    <img src="{{ asset('/') }}home/footer-pay.png" alt="Payment Methods" style="height: 25px; opacity: 0.7;">
                </div>
            </div>
        </div>
    </div>
</footer>
