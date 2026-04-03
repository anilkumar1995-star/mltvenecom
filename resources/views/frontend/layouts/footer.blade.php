<footer>
    <div class="tp-footer-area tp-footer-style-2 tp-footer-style-5 page_speed_1220626634">
        <div class="tp-footer-top pt-95 pb-45">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                        <div class="tp-footer-widget footer-col-1 mb-50">
                            <div class="tp-footer-widget-content">
                                <div class="tp-footer-logo">
                                    <a href="{{ asset('/') }}">
                                        @if(isset($footer_settings->footer_logo))
                                            <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $footer_settings->footer_logo }}"
                                                alt="{{ $footer_settings->site_name ?? 'Logo' }}">
                                        @else
                                            <img src="{{ asset('/') }}home/logo.png"
                                                alt="Multive - Multipurpose eCommerce Laravel Script">
                                        @endif
                                    </a>
                                </div>
                                <div class="tp-footer-desc">
                                    {{ $footer_settings->footer_description ?? 'Multive is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.' }}
                                </div>
                                <div class="tp-footer-social">
                                    <a href="{{ $footer_settings->facebook_url ?? '#' }}" title="Facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="{{ $footer_settings->twitter_url ?? '#' }}" title="X (Twitter)" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="{{ $footer_settings->youtube_url ?? '#' }}" title="YouTube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="{{ $footer_settings->linkedin_url ?? '#' }}" title="Linkedin" target="_blank">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="tp-footer-widget footer-col-2">
                            <h4 class="tp-footer-widget-title">My Account</h4>
                            <div class="tp-footer-widget-content">
                                <ul>
                                    <li><a href="{{ route('frontend.orders.tracking') }}" title="Track Orders"> Track Orders </a></li>
                                    <li><a href="{{ route('frontend.shipping') }}" title="Shipping"> Shipping </a></li>
                                    <li><a href="{{ route('frontend.wishlist.index') }}" title="Wishlist"> Wishlist </a></li>
                                    <li><a href="{{ route('frontend.customer.dashboard') }}" title="My Account"> My Account </a></li>
                                    <li><a href="{{ route('frontend.customer.orders') }}" title="Order History"> Order History </a></li>
                                    <li><a href="{{ route('frontend.customer.returns') }}" title="Returns"> Returns </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="tp-footer-widget footer-col-2">
                            <h4 class="tp-footer-widget-title">Information</h4>
                            <div class="tp-footer-widget-content">
                                <ul>
                                    <li><a href="{{ route('frontend.our-story') }}" title="Our Story"> Our Story </a></li>
                                    <li><a href="{{ route('frontend.careers') }}" title="Careers"> Careers </a></li>
                                    <li><a href="{{ route('frontend.cookie-policy') }}" title="Cookie Policy"> Cookie Policy </a></li>
                                    <li><a href="{{ route('frontend.blog.index') }}" title="Latest News"> Latest News </a></li>
                                    <li><a href="{{ route('frontend.contact.index') }}" title="Contact Us"> Contact Us </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="tp-footer-widget footer-col-4 mb-50">
                            <h4 class="tp-footer-widget-title">Talk To Us</h4>
                            <div class="tp-footer-widget-content">
                                <div class="tp-footer-talk mb-20"><span>Got Questions? Call us</span>
                                    <h4><a href="tel:{{ $footer_settings->footer_phone ?? '+670 413 90 762' }}">{{ $footer_settings->footer_phone ?? '+670 413 90 762' }}</a></h4>
                                </div>
                                <div class="tp-footer-contact">
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                            <p><a href="mailto:{{ $footer_settings->footer_email ?? 'support@multive.com' }}">{{ $footer_settings->footer_email ?? 'support@multive.com' }}</a></p>
                                        </div>
                                    </div>
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                            <p><a href="#" target="_blank">{{ $footer_settings->footer_address ?? '79 Sleepy Hollow St. Jamaica, New York 1432' }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-footer-bottom">
            <div class="container">
                <div class="tp-footer-bottom-wrapper">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="tp-footer-copyright">
                                <div>© {{ date('Y') }} {{ $footer_settings->site_name ?? 'All Rights Reserved.' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tp-footer-payment text-md-end">
                                <p><img src="{{ asset('/') }}home/footer-pay.png" alt="footer image"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
