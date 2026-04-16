<div class="d-block d-lg-flex">
    <aside class="navbar navbar-vertical navbar-expand-lg flex-auto" data-bs-theme="dark" id="sidebar-menu-main">
        <script>
            (function() {
                const isMinimal = localStorage.getItem('vendor_sidebar_minimal');
                if (isMinimal === null || isMinimal === 'true') {
                    document.getElementById('sidebar-menu-main').classList.add('navbar-minimal');
                }
            })();

            // Add listener to save minimal state preference
            document.addEventListener('click', function(e) {
                const button = e.target.closest('[data-bb-toggle="navbar-minimal"]');
                if (button) {
                    setTimeout(() => {
                        const sidebar = document.getElementById('sidebar-menu-main');
                        if (sidebar) {
                            localStorage.setItem('vendor_sidebar_minimal', sidebar.classList.contains('navbar-minimal'));
                        }
                    }, 100);
                }
            });
        </script>
        <div class="container-xl">
            {{-- Hide individual toggler as we have a main toggle in header --}}
            <button class="navbar-toggler d-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="icon svg-icon-ti-ti-menu-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6l16 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M4 18l16 0"></path>
                </svg>
            </button>
            {{-- Brand logo removed as it is in the header --}}


            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">

                    {{-- Dashboard --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.dashboard') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.dashboard') ? 'active' : '' }}"
                            href="{{ route('frontend.vendor.dashboard') }}" data-title="Dashboard">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon svg-icon-ti-ti-home" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Dashboard</span>
                        </a>
                    </li>

                    {{-- Products --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.products.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.products.*') ? 'active' : '' }}"
                            href="{{ route('frontend.vendor.products.index') }}" data-title="Products">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon svg-icon-ti-ti-package" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                    <path d="M12 12l8 -4.5"></path>
                                    <path d="M12 12l0 9"></path>
                                    <path d="M12 12l-8 -4.5"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Products</span>
                        </a>
                    </li>

                    {{-- Orders --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.orders.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.orders.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.orders.index') }}" data-title="Orders">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon svg-icon-ti-ti-shopping-cart" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M17 17h-11v-14h-2"></path>
                                    <path d="M6 5l14 1l-1 7h-13"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Orders</span>
                        </a>
                    </li>

                    {{-- Order Returns --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.order-returns.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.order-returns.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.order-returns.index') }}" data-title="Order Returns">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Order Returns</span>
                        </a>
                    </li>

                    {{-- Discounts --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.discounts.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.discounts.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.discounts.index') }}" data-title="Discounts">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 15l6 -6"></path>
                                    <circle cx="9.5" cy="9.5" r=".5" fill="currentColor"></circle>
                                    <circle cx="14.5" cy="14.5" r=".5" fill="currentColor"></circle>
                                    <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.41 .41 .96 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .59 .23 1.14 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1c0 -.59 -.23 -1.14 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7c.41 -.41 .64 -.96 .64 -1.55v-1z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Discounts</span>
                        </a>
                    </li>

                    {{-- Withdrawals --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.withdrawals.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.withdrawals.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.withdrawals.index') }}" data-title="Withdrawals">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 8l4 4l-4 4"></path>
                                    <path d="M3 12h18"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Withdrawals</span>
                        </a>
                    </li>

                    {{-- Reviews --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.reviews.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.reviews.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.reviews.index') }}" data-title="Reviews">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Reviews</span>
                        </a>
                    </li>

                    {{-- Revenues --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.revenues.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.revenues.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.revenues.index') }}" data-title="Revenues">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 8l4 4l-4 4"></path>
                                    <path d="M14 4l-10 10l10 10"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Revenues</span>
                        </a>
                    </li>

                    {{-- Messages --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.messages.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.messages.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.messages.index') }}" data-title="Messages">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                    <path d="M3 7l9 6l9 -6"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Messages</span>
                        </a>
                    </li>

                    {{-- Product Specification (Dropdown) --}}
                    <li class="nav-item dropdown {{ request()->routeIs('frontend.vendor.specifications.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('frontend.vendor.specifications.*') ? 'show' : '' }}" href="#navbar-specification" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ request()->routeIs('frontend.vendor.specifications.*') ? 'true' : 'false' }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M9 15l2 2l4 -4"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">Product Specification</span>
                        </a>
                        <div class="dropdown-menu {{ request()->routeIs('frontend.vendor.specifications.*') ? 'show' : '' }}">
                            <a class="dropdown-item {{ request()->routeIs('frontend.vendor.specifications.groups.index') ? 'active' : '' }}" href="{{ route('frontend.vendor.specifications.groups.index') }}">
                                <i class="fa fa-layer-group me-2"></i> Specification Groups
                            </a>
                            <a class="dropdown-item {{ request()->routeIs('frontend.vendor.specifications.tables.index') ? 'active' : '' }}" href="{{ route('frontend.vendor.specifications.tables.index') }}">
                                <i class="fa fa-table me-2"></i> Specification Tables
                            </a>
                        </div>
                    </li>

                    {{-- KYC Verification --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.kyc.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.kyc.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.kyc.index') }}" data-title="KYC Verification">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon svg-icon-ti-ti-id-badge" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 11l4 4l10 -10"></path>
                                    <path d="M5 19h14v-2c0 -5 -2 -14 -14 -14"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">KYC Verification</span>
                        </a>
                    </li>

                    {{-- Settings --}}
                    <li class="nav-item {{ request()->routeIs('frontend.vendor.settings.*') ? 'active' : '' }}">
                        <a class="nav-link {{ request()->routeIs('frontend.vendor.settings.*') ? 'active' : '' }}" 
                            href="{{ route('frontend.vendor.settings.index') }}" data-title="Settings">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37a1.724 1.724 0 0 0 2.572 -1.065z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                            <span class="nav-link-title text-truncate">Settings</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </aside>
</div>
