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
                                        <img src="{{ asset('/') }}home/logo.png"
                                            alt="Multive - Multipurpose eCommerce Laravel Script">
                                    </a>
                                </div>
                                <div class="tp-footer-desc"> Multive is a powerful tool eCommerce Laravel script for
                                    creating a professional and visually appealing online store. </div>
                                <div class="tp-footer-social">
                                    <a href="#" title="Facebook" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" title="X (Twitter)" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" title="YouTube" target="_blank">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="#" title="Linkedin" target="_blank">
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
                                    <li><a href="{{ asset('/') }}orders/tracking" title="Track Orders"> Track Orders </a></li>
                                    <li><a href="{{ asset('/') }}shipping" title="Shipping"> Shipping </a></li>
                                    <li><a href="{{ asset('/') }}wishlist" title="Wishlist"> Wishlist </a></li>
                                    <li><a href="{{ route('frontend.customer.dashboard') }}" title="My Account"> My Account </a></li>
                                    <li><a href="{{ asset('/') }}customer/orders" title="Order History"> Order History </a></li>
                                    <li><a href="{{ asset('/') }}customer/order-returns" title="Returns"> Returns </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="tp-footer-widget footer-col-2">
                            <h4 class="tp-footer-widget-title">Information</h4>
                            <div class="tp-footer-widget-content">
                                <ul>
                                    <li><a href="{{ asset('/') }}our-story" title="Our Story"> Our Story </a></li>
                                    <li><a href="{{ asset('/') }}careers" title="Careers"> Careers </a></li>
                                    <li><a href="{{ asset('/') }}cookie-policy" title="Privacy Policy"> Privacy Policy </a></li>
                                    <li><a href="{{ asset('/') }}blog" title="Latest News"> Latest News </a></li>
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
                                    <h4><a href="tel:+670 413 90 762">+670 413 90 762</a></h4>
                                </div>
                                <div class="tp-footer-contact">
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                            <p><a href="mailto:support@multive.com">support@multive.com</a></p>
                                        </div>
                                    </div>
                                    <div class="tp-footer-contact-item d-flex align-items-start">
                                        <div class="tp-footer-contact-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="tp-footer-contact-content">
                                            <p><a href="#" target="_blank"> 79 Sleepy Hollow St. Jamaica, New York 1432 </a></p>
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
                                <div>© {{ date('Y') }} All Rights Reserved.</div>
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
