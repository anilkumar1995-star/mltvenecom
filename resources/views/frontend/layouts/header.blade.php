<style>
    :root {
        --zepto-primary: #ff3269;
        /* Zepto Pink/Red */
        --zepto-green: #0c831f;
        /* Zepto Green */
        --zepto-bg: #ffffff;
        --zepto-border: #eeeeee;
        --zepto-text: #1a1a1a;
        --zepto-text-muted: #666666;
    }
    
    body {
        padding-top: 75px;
    }

    .tp-header-area {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1030;
        background-color: #fff !important;
        border-bottom: 1px solid var(--zepto-border) !important;
        height: auto !important;
        padding: 12px 0 !important;
        transition: all 0.3s ease;
    }

    .tp-header-logo img {
        height: 32px;
        width: auto;
    }

    /* Location Selector */
    .zepto-location {
        display: flex;
        flex-direction: column;
        margin-left: 20px;
        cursor: pointer;
        min-width: 150px;
    }

    .zepto-location .loc-title {
        font-size: 14px;
        font-weight: 800;
        color: var(--zepto-text);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .zepto-location .loc-time {
        font-size: 12px;
        color: var(--zepto-text-muted);
    }

    /* Search Bar */
    .zepto-search-container {
        flex-grow: 1;
        margin: 0 40px;
        position: relative;
    }

    .zepto-search-container form {
        width: 100%;
        position: relative;
    }

    .zepto-search-container input {
        width: 100%;
        height: 48px;
        background: #f8f8f8 !important;
        border: 1px solid transparent !important;
        border-radius: 10px !important;
        padding: 0 20px 0 45px !important;
        font-size: 14px !important;
        outline: none !important;
        transition: all 0.2s ease;
        color: #333 !important;
    }

    .zepto-search-container input:focus {
        background: #fff !important;
        border-color: var(--zepto-border) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .zepto-search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 16px;
    }

    /* Header Actions */
    .zepto-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .zepto-action-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--zepto-text);
        font-weight: 500;
        font-size: 14px;
        text-decoration: none !important;
        transition: all 0.2s;
        cursor: pointer;
    }

    .zepto-action-item:hover {
        opacity: 0.8;
        color: var(--zepto-green);
    }

    .cart-btn-zepto {
        background: var(--zepto-green);
        color: #fff !important;
        padding: 7px 14px;
        border-radius: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 4px 12px rgba(12, 131, 31, 0.15);
        transition: all 0.2s ease;
    }

    .cart-btn-zepto:hover {
        background: #0a701a;
        color: #fff !important;
        transform: translateY(-1px);
    }

    .cart-badge-zepto {
        background: #fff;
        color: var(--zepto-green);
        min-width: 26px;
        height: 26px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 5px;
    }

    /* User Dropdown Style */
    .zepto-user-dropdown {
        position: relative;
    }
    .zepto-user-dropdown-menu {
        position: absolute;
        top: calc(100% + 15px);
        right: 0;
        background: #fff;
        min-width: 220px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid #f1f1f1;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 999999;
    }
    .zepto-user-dropdown:hover .zepto-user-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .zepto-user-header {
        padding: 15px 20px;
        border-bottom: 1px solid #f8f8f8;
    }
    .zepto-user-name {
        display: block;
        font-weight: 800;
        color: #111;
        font-size: 14px;
        line-height: 1.2;
    }
    .zepto-user-email {
        display: block;
        color: #666;
        font-size: 12px;
        margin-top: 2px;
    }
    .zepto-dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        color: #333;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none !important;
        transition: background 0.2s;
    }
    .zepto-dropdown-item:hover {
        background: #fcfcfc;
        color: var(--zepto-green);
    }
    .zepto-dropdown-item i {
        font-size: 16px;
        color: #999;
        width: 18px;
        text-align: center;
    }
    .zepto-dropdown-divider {
        height: 1px;
        background: #f8f8f8;
        margin: 5px 0;
    }

    @media (max-width: 575px) {
        .zepto-actions {
            gap: 12px;
        }
        .cart-btn-zepto {
            padding: 5px 10px;
            gap: 8px;
        }
        .cart-badge-zepto {
            min-width: 22px;
            height: 22px;
            font-size: 11px;
        }
    }

    /* Mobile adjustments */
    @media (max-width: 991px) {
        .zepto-location {
            display: none !important;
        }
        .zepto-search-container {
            margin: 0 5px;
            flex-grow: 1;
            min-width: 100px;
        }
        .zepto-search-container input {
            height: 38px;
            padding-left: 32px !important;
            padding-right: 10px !important;
            font-size: 12px !important;
        }
        .zepto-search-icon {
            left: 10px;
            font-size: 13px;
        }
        .tp-header-logo img {
            height: 22px;
        }
        .zepto-actions {
            gap: 8px;
        }
    }

    @media (max-width: 400px) {
        .container-fluid {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        .zepto-search-container {
            min-width: 80px;
        }
        .cart-btn-zepto span.d-md-block {
             display: none !important;
        }
    }

    /* AJAX Search Results Dropdown */
    .zepto-search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 10px;
        z-index: 999995;
        max-height: 480px;
        overflow-y: auto;
        display: none;
        border: 1px solid #eee;
    }
    .zepto-result-item {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        border-bottom: 1px solid #f8f8f8;
        transition: background 0.2s;
        text-decoration: none !important;
        color: #333;
    }
    .zepto-result-item:hover {
        background: #fcfcfc;
    }
    .zepto-result-thumb {
        width: 45px;
        height: 45px;
        border-radius: 6px;
        overflow: hidden;
        margin-right: 12px;
        flex-shrink: 0;
        border: 1px solid #eee;
    }
    .zepto-result-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .zepto-result-info h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.2;
    }
    .zepto-result-info span {
        font-size: 12px;
        color: var(--zepto-green);
        font-weight: 700;
    }
    .zepto-search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.2);
        z-index: 99998;
        display: none;
    }
</style>

<header>
    <div id="header-sticky" class="tp-header-area">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center">
                <!-- Logo & Location -->
                <div class="col-auto d-flex align-items-center">
                    <div class="tp-header-logo">
                        <a href="{{ url('/') }}">
                            @if(isset($footer_settings->footer_logo))
                                <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $footer_settings->footer_logo }}"
                                    alt="{{ $footer_settings->site_name ?? 'Logo' }}">
                            @else
                                <img src="{{ asset('/') }}home/logo.png"
                                    alt="Multive">
                            @endif
                        </a>
                    </div>
                    
                    @php
                        $headerLogged = auth('web')->check() || auth('customer')->check();
                        $headerUser = auth('web')->user() ?? auth('customer')->user();
                        $deliveryLocation = "Select Location";
                        $deliverySubtitle = "Check deliverability";
                        
                        if($headerLogged && $headerUser && method_exists($headerUser, 'addresses')) {
                            $address = $headerUser->addresses()->where('is_default', 1)->first() ?? $headerUser->addresses()->first();
                            if($address && $address->zip_code) {
                                $deliveryLocation = $address->zip_code;
                                $deliverySubtitle = "10 mins Delivery";
                            } elseif($address && $address->city) {
                                $deliveryLocation = $address->city;
                                $deliverySubtitle = "10 mins Delivery";
                            }
                        }
                    @endphp
                    <div class="zepto-location d-none d-lg-flex">
                        <span class="loc-title">{{ $deliveryLocation != 'Select Location' ? 'Deliver to ' : '' }}{{ $deliveryLocation }} <i class="fas fa-chevron-down" style="font-size: 10px"></i></span>
                        <span class="loc-time">{{ $deliverySubtitle }}</span>
                    </div>
                </div>

                <!-- Global Search -->
                <div class="col zepto-search-container">
                    <form action="{{ url('/products') }}" method="GET">
                        <i class="fas fa-search zepto-search-icon"></i>
                        <input type="text" name="search" id="zepto-global-search" placeholder='Search "milk", "bread", or "fruits"...' autocomplete="off">
                    </form>
                    <div class="zepto-search-results"></div>
                </div>
                <div class="zepto-search-overlay"></div>

                <!-- Actions: Login & Cart -->
                <div class="col-auto zepto-actions ms-auto">
                    @php
                        $isLogged = auth('web')->check() || auth('customer')->check();
                        $currentUser = auth('web')->user() ?? auth('customer')->user();
                        $dashboardRoute = (auth('web')->check() && $currentUser->role === 'admin') ? route('admin.dashboard') : route('frontend.customer.dashboard');
                    @endphp

                    @if($isLogged)
                        <div class="zepto-user-dropdown">
                            <a href="javascript:void(0)" class="zepto-action-item">
                                @if($currentUser->avatar)
                                    <img src="{{ $currentUser->avatar_url }}" alt="user" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover; border: 1.5px solid var(--zepto-green);">
                                @else
                                    <i class="far fa-user" style="font-size: 18px;"></i>
                                @endif
                                <span class="d-none d-md-block">{{ explode(' ', $currentUser->name)[0] }}</span>
                                <i class="fas fa-chevron-down d-none d-md-block" style="font-size: 10px; opacity: 0.5;"></i>
                            </a>
                            <div class="zepto-user-dropdown-menu">
                                <div class="zepto-user-header d-flex align-items-center gap-3">
                                    <div class="zepto-user-thumb">
                                        @if($currentUser->avatar)
                                            <img src="{{ $currentUser->avatar_url }}" alt="user" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <div style="width: 45px; height: 45px; border-radius: 50%; background: #f0f5f9; display: flex; align-items: center; justify-content: center; color: var(--zepto-green); font-size: 20px;">
                                                <i class="far fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="zepto-user-meta">
                                        <span class="zepto-user-name">{{ $currentUser->name }}</span>
                                        <span class="zepto-user-email">{{ $currentUser->email }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('frontend.customer.profile') }}" class="zepto-dropdown-item">
                                    <i class="far fa-user-circle"></i> My Profile
                                </a>
                                <div class="zepto-dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="zepto-dropdown-item" style="color: #ff3269;">
                                    <i class="fas fa-sign-out-alt" style="color: #ff3269;"></i> Logout
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="zepto-action-item" style="background: rgba(12, 131, 31, 0.08); padding: 6px 15px; border-radius: 8px; color: var(--zepto-green) !important; font-weight: 700;">
                            <span class="d-none d-md-block">Login</span>
                            <i class="far fa-user d-md-none" style="font-size: 16px;"></i>
                        </a>
                    @endif

                    <a href="{{ route('frontend.cart.index') }}" class="zepto-action-item cart-btn-zepto">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="d-none d-md-block">Cart</span>
                        <span class="cart-badge-zepto" data-bb-value="cart-count">{{ count(session('cart', [])) }}</span>
                    </a>
                </div>
        </div>
    </div>
</header>
