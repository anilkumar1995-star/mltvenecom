<header>
    <div id="header-sticky" class="tp-header-area p-relative tp-header-sticky tp-header-height" data-sticky=""
        data-mobile-sticky="" style="height: 98px;">
        <div class="tp-header-5 pl-25 pr-25" style="background-color: #678E61; color: #fff">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xxl-2 col-xl-3 col-6">
                        <div class="tp-header-left-5 d-flex align-items-center">
                            <div class="tp-header-hamburger-5 mr-15 d-none d-xl-block">
                                <button class="tp-hamburger-btn-2 tp-hamburger-toggle"
                                    aria-label="Toggle categories menu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <div class="tp-header-hamburger-5 mr-15 d-xl-none">
                                <button class="tp-hamburger-btn-2 tp-offcanvas-open-btn" aria-label="Open menu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <div class="logo">
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
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-5 d-none d-xl-block">
                        <div class="main-menu">
                            <nav class="tp-main-menu-content">
                                <ul>
                                    <li class="has-dropdown">
                                        <a href="{{ url('/') }}" title="Home">
                                            Home
                                            <!-- <svg class="icon svg-icon-ti-ti-chevron-down"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 9l6 6l6 -6"></path>
                                            </svg>  -->
                                        </a>

                                       <!-- <ul class="tp-submenu">
                                            <li class="">
                                                <a href="#" title="Electronics">
                                                    Electronics
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#" title="Fashion">
                                                    Fashion
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#" title="Beauty">
                                                    Beauty
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#" title="Jewelry">
                                                    Jewelry
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#" title="Grocery">
                                                    Grocery
                                                </a>
                                            </li>
                                        </ul>  -->
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="{{ url('/') }}" title="Shop">
                                            Shop
                                            <svg class="icon svg-icon-ti-ti-chevron-down"
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 9l6 6l6 -6"></path>
                                            </svg> </a>
                                        <ul class="tp-submenu">
                                            <li class="">
                                                <a href="{{ route('frontend.categories.index') }}" title="Shop Categories">Shop Categories</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('frontend.brands.index') }}" title="Shop Brands">Shop Brands</a>
                                            </li>
                                            <!-- <li class="">
                                                <a href="{{ route('frontend.products.index', ['layout' => 'list']) }}" title="Shop List">Shop List</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('frontend.products.index', ['layout' => 'grid']) }}" title="Shop Grid">Shop Grid</a>
                                            </li> -->
                                            <li class="">
                                                <a href="{{ route('frontend.products.index') }}" title="Product Detail">Products</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('frontend.coupons.index') }}" title="Grab Coupons">Grab Coupons</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('frontend.cart.index') }}" title="Cart">Cart</a>
                                            </li>
                                            <!-- <li class="">
                                                <a href="#" title="Compare">Compare</a>
                                            </li> -->
                                            <li class="">
                                                <a href="{{ route('frontend.wishlist.index') }}" title="Wishlist">Wishlist</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ auth('customer')->check() ? route('frontend.customer.orders') : route('login') }}" title="Track Your Order">Track Your Order</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="{{ route('frontend.stores.index') }}" title="Vendors">
                                            Vendors
                                        </a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="#" title="Pages">
                                            Pages
                                            <svg class="icon svg-icon-ti-ti-chevron-down"
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 9l6 6l6 -6"></path>
                                            </svg> </a>

                                        <ul class="tp-submenu">
                                            <li class="">
                                                <a href="{{ route('frontend.faqs.index') }}" title="FAQs">
                                                    FAQs
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('login') }}" class="d-flex align-items-center me-2">Login</a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('register') }}" title="Register">
                                                    Register
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('password.request') }}"
                                                    title="Forgot Password">
                                                    Forgot Password
                                                </a>
                                            </li>
                                            <!-- <li class="">
                                                <a href="#" title="404 Error">
                                                    404 Error
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#" title="Coming Soon">
                                                    Coming Soon
                                                </a>
                                            </li> -->
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="{{ route('frontend.blog.index') }}" title="Blog">
                                            Blog
                                            <svg class="icon svg-icon-ti-ti-chevron-down"
                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M6 9l6 6l6 -6"></path>
                                            </svg> </a>
                                        <ul class="tp-submenu">
                                            <li class="">
                                                <a href="{{ route('frontend.blog.index', ['layout' => 'grid']) }}"
                                                    title="Blog Grid">
                                                    Blog Grid
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="{{ route('frontend.blog.index', ['layout' => 'list']) }}"
                                                    title="Blog List">
                                                    Blog List
                                                </a>
                                            </li>
                                            <li class="">
                                                @php $firstPost = \App\Models\Post::where('status', 'published')->first(); @endphp
                                                <a href="{{ $firstPost ? route('frontend.blog.show', $firstPost->slug ? $firstPost->slug->key : $firstPost->id) : '#' }}"
                                                    title="Blog Detail">
                                                    Blog Detail
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                     <li class="">
                                         <a href="{{ route('frontend.contact.index') }}" title="Contact">
                                             Contact
                                         </a>
                                     </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="d-none">
                        <div class="tp-header-search-5">
                            <form role="search" action="{{ url('/') }}products"
                                method="GET">
                                <div class="tp-header-search-input-box-5">
                                    <div class="tp-header-search-input-5">
                                        <input type="search" name="search"
                                            placeholder="Search for Products..." autocomplete="off">
                                        <span class="tp-header-search-icon-5">
                                            <svg width="18" height="18" viewBox="0 0 18 18"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z"
                                                    stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <select name="category" aria-label="Product categories">
                                        <option value="">All Categories</option>
                                    </select>
                                    <button type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-xl-4 col-6">
                        <div class="tp-header-right-5 d-flex align-items-center justify-content-end">
                            <div class="tp-header-login-5 d-none d-lg-block">
                                @php
                                    $isLogged = auth('web')->check() || auth('customer')->check();
                                    $currentUser = auth('web')->user() ?? auth('customer')->user();
                                    $dashboardRoute = (auth('web')->check() && $currentUser->role === 'admin') ? route('admin.dashboard') : route('frontend.customer.dashboard');
                                @endphp

                                <div class="d-flex align-items-center">
                                    <div class="tp-header-login-icon-5" style="border-radius: 50%; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; overflow: hidden; background: rgba(255,255,255,0.1);">
                                        @if($isLogged && $currentUser->avatar)
                                            <a href="{{ $dashboardRoute }}">
                                                <img src="{{ $currentUser->avatar_url }}" alt="{{ $currentUser->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="text-white">
                                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.00029 9C10.2506 9 12.0748 7.20914 12.0748 5C12.0748 2.79086 10.2506 1 8.00029 1C5.75 1 3.92578 2.79086 3.92578 5C3.92578 7.20914 5.75 9 8.00029 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15 17C15 13.904 11.8626 11.4 8 11.4C4.13737 11.4 1 13.904 1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>

                                    <div class="tp-header-login-5 d-none d-lg-block ms-3">
                                        @if($isLogged)
                                            <a href="{{ $dashboardRoute }}" class="text-decoration-none text-start">
                                                <div style="line-height: 1.2;">
                                                    <span style="font-size: 13px; color: rgba(255, 255, 255, 0.7); display: block; margin-bottom: 2px;">{{ $currentUser->email }}</span>
                                                    <span style="font-size: 15px; font-weight: 500; color: #fff; display: block;">Hello, {{ $currentUser->name }}</span>
                                                </div>
                                            </a>
                                        @else
                                            <div class="d-flex">
                                                <a href="{{ route('login') }}" class="text-white me-3 text-decoration-none">Login</a>
                                                <a href="{{ route('register') }}" class="text-white text-decoration-none">Register</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tp-header-action-5 d-flex align-items-center ml-20">
                                <div
                                    class="tp-header-action-item-5 d-none d-sm-block tp-header-action-item-wishlist">
                                    <a href="{{ asset('/') }}wishlist">
                                        <svg width="18" height="17" viewBox="0 0 18 17"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M9.20125 16.0348C11.0291 14.9098 12.7296 13.5858 14.2722 12.0865C15.3567 11.0067 16.1823 9.69033 16.6858 8.23822C17.5919 5.42131 16.5335 2.19649 13.5717 1.24212C12.0151 0.740998 10.315 1.02741 9.00329 2.01177C7.69109 1.02861 5.99161 0.742297 4.43489 1.24212C1.47305 2.19649 0.40709 5.42131 1.31316 8.23822C1.81666 9.69033 2.64228 11.0067 3.72679 12.0865C5.26938 13.5858 6.96983 14.9098 8.79771 16.0348L8.99568 16.1579L9.20125 16.0348Z"
                                            stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M5.85156 4.41306C4.95446 4.69963 4.31705 5.50502 4.2374 6.45262"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <span class="tp-header-action-badge-5"
                                            data-bb-value="wishlist-count">{{ count(session('wishlist', [])) }}</span>
                                    </a>
                                </div>

                                <div class="tp-header-action-item-5 tp-header-action-item-cart">
                                    <a href="{{ route('frontend.cart.index') }}">
                                        <svg width="18" height="18" viewBox="0 0 18 18"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.31165 17H12.6964C15.4091 17 17.4901 16.0781 16.899 12.3676L16.2107 7.33907C15.8463 5.48764 14.5912 4.77907 13.49 4.77907H4.48572C3.36828 4.77907 2.18607 5.54097 1.76501 7.33907L1.07673 12.3676C0.574694 15.659 2.59903 17 5.31165 17Z"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path
                                                d="M5.19048 4.59622C5.19048 2.6101 6.90163 1.00003 9.01244 1.00003V1.00003C10.0289 0.99598 11.0052 1.37307 11.7254 2.04793C12.4457 2.72278 12.8506 3.6398 12.8506 4.59622V4.59622"
                                                stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M6.38837 8.34478H6.42885" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                            <path d="M11.5466 8.34478H11.5871" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </path>
                                        </svg>
                                        <span class="tp-header-action-badge-5"
                                            data-bb-value="cart-count">{{ count(session('cart', [])) }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-header-side-menu tp-side-menu-5" style="display: none;">
            <nav class="tp-category-menu-content">
                <ul>
                    @foreach(\App\Models\EcProductCategory::where(function($q) { $q->whereNull('parent_id')->orWhere('parent_id', 0); })->with('children')->published()->orderBy('order', 'ASC')->get() as $category)
                    <li class="{{ $category->children->count() > 0 ? 'has-dropdown' : '' }}">
                        <a href="{{ route('frontend.categories.show', $category->slug) }}" class="text-decoration-none {{ $category->children->count() > 0 ? 'has-mega-menu' : '' }}">
                            @if($category->icon_image)
                                <img src="{{ str_starts_with($category->icon_image, 'http') ? $category->icon_image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->icon_image, '/') }}" alt="{{ $category->name }}" width="20" class="me-2">
                            @elseif($category->icon)
                                <i class="{{ $category->icon }} me-2"></i>
                            @endif
                            {{ $category->name }}
                        </a>
                        
                        @if($category->children->count() > 0)
                            <ul class="tp-submenu">
                                @foreach($category->children->where('status', 'published') as $child)
                                <li class="">
                                    <a href="{{ route('frontend.categories.show', $child->slug) }}" class="text-decoration-none">
                                        {{ $child->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
