<div class="offcanvas__area">
    <div class="offcanvas__wrapper">
        <div class="offcanvas__close">
            <button class="offcanvas__close-btn offcanvas-close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas__content">
            <div class="offcanvas__top mb-40 d-flex justify-content-between align-items-center">
                <div class="offcanvas__logo logo">
                    <a href="{{ url('/') }}">
                        @if(isset($footer_settings->footer_logo))
                            <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $footer_settings->footer_logo }}"
                                alt="{{ $footer_settings->site_name ?? 'Logo' }}">
                        @else
                            <img src="{{ asset('/') }}home/logo.png" alt="logo">
                        @endif
                    </a>
                </div>
                <div class="offcanvas__auth">
                    @php
                        $isLogged = auth('web')->check() || auth('customer')->check();
                        $currentUser = auth('web')->user() ?? auth('customer')->user();
                        $dashboardRoute = (auth('web')->check() && $currentUser->role === 'admin') ? route('admin.dashboard') : route('frontend.customer.dashboard');
                    @endphp

                    @if($isLogged)
                        <a href="{{ $dashboardRoute }}" class="d-flex align-items-center text-decoration-none">
                            <div class="auth-icon me-2" style="width: 35px; height: 35px; border-radius: 50%; overflow: hidden; background: #f3f3f3;">
                                @if($currentUser->avatar)
                                    <img src="{{ $currentUser->avatar_url }}" alt="user" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle fa-2x text-muted"></i>
                                @endif
                            </div>
                            <span class="text-dark fw-bold" style="font-size: 14px;">{{ $currentUser->name }}</span>
                        </a>
                    @else
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="mobile-menu-2 fix mb-40">
                {{-- Main Menu in Mobile --}}
                <div class="tp-main-menu-content">
                     <h5 class="mb-20">Main Menu</h5>
                     <ul class="offcanvas-main-menu">
                        <li class="has-dropdown">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="has-dropdown">
                            <a href="javascript:void(0)" class="menu-toggle">Shop <i class="fas fa-chevron-down ms-1"></i></a>
                            <ul class="submenu ms-3 mt-2" style="display: none;">
                                <li><a href="{{ route('frontend.categories.index') }}">Shop Categories</a></li>
                                <li><a href="{{ route('frontend.brands.index') }}">Shop Brands</a></li>
                                <li><a href="{{ route('frontend.products.index') }}">Products</a></li>
                                <li><a href="{{ route('frontend.coupons.index') }}">Grab Coupons</a></li>
                                <li><a href="{{ route('frontend.cart.index') }}">Cart</a></li>
                                <li><a href="{{ route('frontend.wishlist.index') }}">Wishlist</a></li>
                                <li><a href="{{ auth('customer')->check() ? route('frontend.customer.orders') : route('login') }}">Track Your Order</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('frontend.stores.index') }}">Vendors</a></li>
                        <li class="has-dropdown">
                            <a href="javascript:void(0)" class="menu-toggle">Pages <i class="fas fa-chevron-down ms-1"></i></a>
                            <ul class="submenu ms-3 mt-2" style="display: none;">
                                <li><a href="{{ route('frontend.faqs.index') }}">FAQs</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('password.request') }}">Forgot Password</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a href="javascript:void(0)" class="menu-toggle">Blog <i class="fas fa-chevron-down ms-1"></i></a>
                            <ul class="submenu ms-3 mt-2" style="display: none;">
                                <li><a href="{{ route('frontend.blog.index', ['layout' => 'grid']) }}">Blog Grid</a></li>
                                <li><a href="{{ route('frontend.blog.index', ['layout' => 'list']) }}">Blog List</a></li>
                                @php $firstPost = \App\Models\Post::where('status', 'published')->first(); @endphp
                                <li><a href="{{ $firstPost ? route('frontend.blog.show', $firstPost->slug ? $firstPost->slug->key : $firstPost->id) : '#' }}">Blog Detail</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('frontend.contact.index') }}">Contact</a></li>
                     </ul>
                </div>
            </div>
            
            <div class="offcanvas__contact mt-40">
                <p class="mb-2">Contact Us</p>
                @if(isset($footer_settings->footer_email))
                    <a href="mailto:{{ $footer_settings->footer_email }}" style="color: var(--primary-color);">{{ $footer_settings->footer_email }}</a>
                @endif
                <div class="offcanvas__social mt-20 d-flex gap-3">
                    @if(isset($footer_settings->facebook_url))
                        <a href="{{ $footer_settings->facebook_url }}" class="text-dark"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if(isset($footer_settings->twitter_url))
                        <a href="{{ $footer_settings->twitter_url }}" class="text-dark"><i class="fab fa-x-twitter"></i></a>
                    @endif
                    @if(isset($footer_settings->instagram_url))
                        <a href="{{ $footer_settings->instagram_url }}" class="text-dark"><i class="fab fa-instagram"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .offcanvas__area {
        position: fixed;
        right: 0;
        top: 0;
        width: 320px;
        height: 100%;
        background-color: #ffffff;
        box-shadow: -10px 0 30px rgba(0,0,0,0.1);
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        transform: translateX(100%);
        z-index: 100000;
        overflow-y: auto;
    }
    .offcanvas__area.offcanvas-opened {
        transform: translateX(0);
    }
    .offcanvas__wrapper {
        position: relative;
        padding: 50px 30px;
    }
    .offcanvas__close {
        position: absolute;
        top: 15px;
        right: 15px;
    }
    .offcanvas__close-btn {
        background: #f3f3f3;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #010f1c;
        transition: all 0.3s ease;
    }
    .offcanvas__close-btn:hover {
        background: var(--primary-color);
        color: #fff;
    }
    .offcanvas__logo img {
        max-height: 40px;
        width: auto;
    }
    .offcanvas-main-menu {
        list-style: none;
        padding: 0;
    }
    .offcanvas-main-menu > li {
        border-bottom: 1px solid #f3f3f3;
        padding: 10px 0;
    }
    .offcanvas-main-menu > li > a {
        font-size: 16px;
        font-weight: 600;
        color: #010f1c;
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-decoration: none;
    }
    .offcanvas-main-menu .submenu {
        list-style: none;
        padding-left: 10px;
    }
    .offcanvas-main-menu .submenu li {
        padding: 5px 0;
    }
    .offcanvas-main-menu .submenu li a {
        font-size: 14px;
        color: #555;
        text-decoration: none;
    }
    .body-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 99999;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s linear;
    }
    .body-overlay.opened {
        visibility: visible;
        opacity: 1;
    }
    @media (min-width: 992px) {
        .offcanvas__area {
            display: none !important;
        }
    }
</style>

