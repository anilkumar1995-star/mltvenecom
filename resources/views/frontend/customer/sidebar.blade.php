<nav class="bb-customer-navigation px-3 pb-4">
    <div class="nav-section">
        <ul class="nav nav-pills flex-column gap-1 mt-3">
            <li class="nav-item">
                <a href="{{ route('frontend.customer.dashboard') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'dashboard' ? 'active' : '' }}" title="Overview">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-home" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                    <span class="nav-text">Overview</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.orders') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'orders' ? 'active' : '' }}" title="Orders">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-shopping-cart" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M15 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M17 17h-11v-14h-2" />
                        <path d="M6 5l14 1l-1 7h-13" />
                    </svg>
                    <span class="nav-text">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.invoices') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'invoices' ? 'active' : '' }}" title="Invoices">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-file-invoice" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                        <path d="M9 7l1 0" />
                        <path d="M9 13l6 0" />
                        <path d="M13 17l2 0" />
                    </svg>
                    <span class="nav-text">Invoices</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.reviews') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'reviews' ? 'active' : '' }}" title="Reviews">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />
                    </svg>
                    <span class="nav-text">Reviews</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.downloads') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'downloads' ? 'active' : '' }}" title="Downloads">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-download" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                        <path d="M7 11l5 5l5 -5" />
                        <path d="M12 4l0 12" />
                    </svg>
                    <span class="nav-text">Downloads</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.returns') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'returns' ? 'active' : '' }}" title="Order Return Requests">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-shopping-cart-cancel" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M12 17h-6v-14h-2" />
                        <path d="M6 5l14 1l-.857 5.998m-3.643 1.002h-9.5" />
                        <path d="M16 19a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M17 21l4 -4" />
                    </svg>
                    <span class="nav-text">Order Return Requests</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.addresses') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'addresses' ? 'active' : '' }}" title="Addresses">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-book" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                        <path d="M3 6l0 13" />
                        <path d="M12 6l0 13" />
                        <path d="M21 6l0 13" />
                    </svg>
                    <span class="nav-text">Addresses</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('frontend.customer.profile') }}" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'profile' ? 'active' : '' }}" title="Account Settings">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-settings" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065" />
                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                    </svg>
                    <span class="nav-text">Account Settings</span>
                </a>
            </li>
            @if (auth('customer')->user() && auth('customer')->user()->is_vendor)
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'vendor.dashboard' ? 'active' : '' }}" title="Vendor Dashboard">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-building-store" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21l18 0" />
                        <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                        <path d="M5 21l0 -10.15" />
                        <path d="M19 21l0 -10.15" />
                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                    </svg>
                    <span class="nav-text">Vendor Dashboard</span>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3 {{ isset($active) && $active == 'become-vendor' ? 'active' : '' }}" title="Become Vendor">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-building-store" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21l18 0" />
                        <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                        <path d="M5 21l0 -10.15" />
                        <path d="M19 21l0 -10.15" />
                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                    </svg>
                    <span class="nav-text">Become Vendor</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();" class="nav-link d-flex align-items-center gap-3 rounded-2 py-2 px-3" title="Logout">
                    <svg class="icon icon-sm nav-icon flex-shrink-0 svg-icon-ti-ti-logout" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                        <path d="M9 12h12l-3 -3" />
                        <path d="M18 15l3 -3" />
                    </svg>
                    <span class="nav-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
