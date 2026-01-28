<div class="d-block d-lg-flex">
    <aside class="navbar navbar-vertical navbar-expand-lg flex-auto" data-bs-theme="dark" id="sidebar-menu-main">
        <div class="container-xl"><button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false"
                aria-label="Toggle navigation"><svg class="icon svg-icon-ti-ti-menu-2"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6l16 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M4 18l16 0"></path>
                </svg></button>
            <h2 class="d-block d-lg-none navbar-brand navbar-brand-autodark"><a href="http://127.0.0.1:8000/admin"><img
                        src="{{ asset('/') }}js/logo-white.png" alt="Your App" class="navbar-brand-image"
                        style="max-height: 32px; height: auto;"></a>
            </h2>
            <div class="navbar-nav flex-row d-lg-none">
                <div class="dropdown nav-item"><a href="http://127.0.0.1:8000/admin#"
                        class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu"><span class="crop-image-original avatar avatar-sm"
                            style="background-image: url(&quot;data:image/jpeg;base64,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&quot;);"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end"><a class="dropdown-item"
                            href="http://127.0.0.1:8000/admin/system/users/profile/1"><svg
                                class="icon dropdown-item-icon svg-icon-ti-ti-user" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg> Profile </a><a class="dropdown-item" href="http://127.0.0.1:8000/admin/logout"><svg
                                class="icon dropdown-item-icon svg-icon-ti-ti-logout" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                </path>
                                <path d="M9 12h12l-3 -3"></path>
                                <path d="M18 15l3 -3"></path>
                            </svg> Logout </a></div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class="nav-link nav-priority--9999 active show"
                            href="http://127.0.0.1:8000/admin" id="cms-core-dashboard" title="Dashboard"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Dashboard"><svg
                                    class="icon svg-icon-ti-ti-home" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Dashboard </span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-0"
                            href="http://127.0.0.1:8000/admin#cms-plugins-ecommerce" id="cms-plugins-ecommerce"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false"
                            title="Ecommerce"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Ecommerce"><svg class="icon svg-icon-ti-ti-shopping-bag"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z">
                                    </path>
                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Ecommerce <span
                                    class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count ecommerce-count"
                                    data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                    style="display: none;"></span></span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start">
                                {{--  <a
                                class="dropdown-item nav-priority-0"
                                href="http://127.0.0.1:8000/admin/ecommerce/reports" id="cms-plugins-ecommerce-report"
                                title="Report"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Report"><svg class="icon svg-icon-ti-ti-report-analytics"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                        </path>
                                        <path
                                            d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M9 17v-5"></path>
                                        <path d="M12 17v-1"></path>
                                        <path d="M15 17v-3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Report </span></a>
<a
                                class="dropdown-item nav-priority-10"
                                href="http://127.0.0.1:8000/admin/ecommerce/orders" id="cms-plugins-ecommerce-order"
                                title="Orders"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Orders"><svg class="icon svg-icon-ti-ti-truck-delivery"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6h-8m0 -5h5l3 5"></path>
                                        <path d="M3 9l4 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Orders <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count pending-orders"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a><a
                                class="dropdown-item nav-priority-20"
                                href="http://127.0.0.1:8000/admin/ecommerce/incomplete-orders"
                                id="cms-plugins-ecommerce-incomplete-order" title="Incomplete orders"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Incomplete orders"><svg
                                        class="icon svg-icon-ti-ti-basket-cancel" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 10l-2 -6"></path>
                                        <path d="M7 10l2 -6"></path>
                                        <path
                                            d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.3 1.713">
                                        </path>
                                        <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                        <path d="M17 21l4 -4"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Incomplete orders
                                </span></a><a class="dropdown-item nav-priority-30"
                                href="http://127.0.0.1:8000/admin/ecommerce/order-returns"
                                id="cms-plugins-ecommerce-order-return" title="Order returns"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Order returns"><svg
                                        class="icon svg-icon-ti-ti-basket-down" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 10l-2 -6"></path>
                                        <path d="M7 10l2 -6"></path>
                                        <path
                                            d="M12 20h-4.756a3 3 0 0 1 -2.965 -2.544l-1.255 -7.152a2 2 0 0 1 1.977 -2.304h13.999a2 2 0 0 1 1.977 2.304l-.349 1.989">
                                        </path>
                                        <path d="M10 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path d="M19 16v6"></path>
                                        <path d="M22 19l-3 3l-3 -3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Order returns <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count pending-order-returns"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a><a
                                class="dropdown-item nav-priority-40"
                                href="http://127.0.0.1:8000/admin/ecommerce/shipments"
                                id="cms-plugins-ecommerce-shipping-shipments" title="Shipments"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Shipments"><svg
                                        class="icon svg-icon-ti-ti-truck-loading" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 3h1a2 2 0 0 1 2 2v10a2 2 0 0 0 2 2h15"></path>
                                        <path
                                            d="M9 6m0 3a3 3 0 0 1 3 -3h4a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-4a3 3 0 0 1 -3 -3z">
                                        </path>
                                        <path d="M9 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M18 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Shipments
                                </span></a><a class="dropdown-item nav-priority-50"
                                href="http://127.0.0.1:8000/admin/ecommerce/invoices"
                                id="cms-plugins-ecommerce-invoice" title="Invoices"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Invoices"><svg
                                        class="icon svg-icon-ti-ti-file-invoice" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <path d="M9 7l1 0"></path>
                                        <path d="M9 13l6 0"></path>
                                        <path d="M13 17l2 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Invoices </span></a>

  --}}
<a
                                class="dropdown-item nav-priority-60" href="{{ route('admin.products.index') }}"
                                id="cms-plugins-ecommerce-product" title="Products"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Products"><svg
                                        class="icon svg-icon-ti-ti-package" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                        <path d="M12 12l8 -4.5"></path>
                                        <path d="M12 12l0 9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                        <path d="M16 5.25l-8 4.5"></path>
                                    </svg></span>
<span class="nav-link-title text-truncate"> Products <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count pending-products"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a>
{{--  <a
                                class="dropdown-item nav-priority-70"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-prices"
                                id="cms-plugins-ecommerce-product-price" title="Product Prices"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product Prices"><svg
                                        class="icon svg-icon-ti-ti-currency-dollar" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2">
                                        </path>
                                        <path d="M12 3v3m0 12v3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product Prices
                                </span></a><a class="dropdown-item nav-priority-80"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-inventory"
                                id="cms-plugins-ecommerce-product-inventory" title="Product Inventory"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product Inventory"><svg
                                        class="icon svg-icon-ti-ti-home-check" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2"></path>
                                        <path d="M19 13.488v-1.488h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.525"></path>
                                        <path d="M15 19l2 2l4 -4"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product Inventory
                                </span></a>  --}}

<a class="dropdown-item nav-priority-90"
                                href="{{ route('admin.category.Index') }}"
                                id="cms-plugins-product-categories" title="Product categories"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product categories"><svg
                                        class="icon svg-icon-ti-ti-archive" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10"></path>
                                        <path d="M10 12l4 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product categories
                                </span></a>
{{--  <a class="dropdown-item nav-priority-100"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-tags" id="cms-plugins-product-tag"
                                title="Product tags"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Product tags"><svg class="icon svg-icon-ti-ti-tag"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path
                                            d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product tags
                                </span></a><a class="dropdown-item nav-priority-110"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-attribute-sets"
                                id="cms-plugins-product-attribute" title="Product attributes"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product attributes"><svg
                                        class="icon svg-icon-ti-ti-album" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M12 4v7l2 -2l2 2v-7"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product attributes
                                </span></a><a class="dropdown-item nav-priority-120"
                                href="http://127.0.0.1:8000/admin/ecommerce/options"
                                id="cms-plugins-ecommerce-global-options" title="Product options"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product options"><svg
                                        class="icon svg-icon-ti-ti-database" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0"></path>
                                        <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                        <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product options
                                </span></a><a class="dropdown-item nav-priority-130"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-collections"
                                id="cms-plugins-product-collections" title="Product collections"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product collections"><svg
                                        class="icon svg-icon-ti-ti-album" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M12 4v7l2 -2l2 2v-7"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product collections
                                </span></a><a class="dropdown-item nav-priority-140"
                                href="http://127.0.0.1:8000/admin/ecommerce/product-labels"
                                id="cms-plugins-product-label" title="Product labels"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Product labels"><svg
                                        class="icon svg-icon-ti-ti-tags" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 8v4.172a2 2 0 0 0 .586 1.414l5.71 5.71a2.41 2.41 0 0 0 3.408 0l3.592 -3.592a2.41 2.41 0 0 0 0 -3.408l-5.71 -5.71a2 2 0 0 0 -1.414 -.586h-4.172a2 2 0 0 0 -2 2z">
                                        </path>
                                        <path d="M18 19l1.592 -1.592a4.82 4.82 0 0 0 0 -6.816l-4.592 -4.592"></path>
                                        <path d="M7 10h-.01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Product labels
                                </span></a><a class="dropdown-item nav-priority-150"
                                href="http://127.0.0.1:8000/admin/ecommerce/brands" id="cms-plugins-brands"
                                title="Brands"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Brands"><svg class="icon svg-icon-ti-ti-registered"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                        <path d="M10 15v-6h2a2 2 0 1 1 0 4h-2"></path>
                                        <path d="M14 15l-2 -2"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Brands </span></a><a
                                class="dropdown-item nav-priority-160"
                                href="http://127.0.0.1:8000/admin/ecommerce/reviews" id="cms-ecommerce-review"
                                title="Reviews"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Reviews"><svg class="icon svg-icon-ti-ti-star"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Reviews </span></a><a
                                class="dropdown-item nav-priority-170"
                                href="http://127.0.0.1:8000/admin/ecommerce/flash-sales" id="cms-plugins-flash-sale"
                                title="Flash sales"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Flash sales"><svg class="icon svg-icon-ti-ti-bolt"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M13 3l0 7l6 0l-8 11l0 -7l-6 0l8 -11"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Flash sales
                                </span></a><a class="dropdown-item nav-priority-180"
                                href="http://127.0.0.1:8000/admin/ecommerce/discounts"
                                id="cms-plugins-ecommerce-discount" title="Discounts"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Discounts"><svg
                                        class="icon svg-icon-ti-ti-discount" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 15l6 -6"></path>
                                        <circle cx="9.5" cy="9.5" r=".5" fill="currentColor">
                                        </circle>
                                        <circle cx="14.5" cy="14.5" r=".5" fill="currentColor">
                                        </circle>
                                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Discounts
                                </span></a><a class="dropdown-item nav-priority-190"
                                href="http://127.0.0.1:8000/admin/customers" id="cms-plugins-ecommerce-customer"
                                title="Customers"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Customers"><svg class="icon svg-icon-ti-ti-users"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Customers </span></a>  --}}
                        </div>
                    </li>
                    {{--  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-0"
                            href="http://127.0.0.1:8000/admin#cms-plugins-product-specification"
                            id="cms-plugins-product-specification" data-bs-toggle="dropdown"
                            data-bs-auto-close="false" role="button" aria-expanded="false"
                            title="Product Specification"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Product Specification"><svg class="icon svg-icon-ti-ti-table-options"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 21h-7a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7">
                                    </path>
                                    <path d="M3 10h18"></path>
                                    <path d="M10 3v18"></path>
                                    <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    <path d="M19.001 15.5v1.5"></path>
                                    <path d="M19.001 21v1.5"></path>
                                    <path d="M22.032 17.25l-1.299 .75"></path>
                                    <path d="M17.27 20l-1.3 .75"></path>
                                    <path d="M15.97 17.25l1.3 .75"></path>
                                    <path d="M20.733 20l1.3 .75"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Product Specification
                            </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-0"
                                href="http://127.0.0.1:8000/admin/ecommerce/specification-groups"
                                id="cms-plugins-product-specification-groups" title="Groups"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Groups"><svg
                                        class="icon svg-icon-ti-ti-folder" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Groups </span></a><a
                                class="dropdown-item nav-priority-10"
                                href="http://127.0.0.1:8000/admin/ecommerce/specification-attributes"
                                id="cms-plugins-product-specification-attributes" title="Attributes"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Attributes"><svg
                                        class="icon svg-icon-ti-ti-list-details" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M13 5h8"></path>
                                        <path d="M13 9h5"></path>
                                        <path d="M13 15h8"></path>
                                        <path d="M13 19h5"></path>
                                        <path
                                            d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Attributes
                                </span></a><a class="dropdown-item nav-priority-20"
                                href="http://127.0.0.1:8000/admin/ecommerce/specification-tables"
                                id="cms-plugins-product-specification-tables" title="Tables"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Tables"><svg
                                        class="icon svg-icon-ti-ti-table" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z">
                                        </path>
                                        <path d="M3 10h18"></path>
                                        <path d="M10 3v18"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Tables </span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-0"
                            href="http://127.0.0.1:8000/admin#cms-plugins-marketplace" id="cms-plugins-marketplace"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Marketplace"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Marketplace"><svg
                                    class="icon svg-icon-ti-ti-building-store" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M3 21l18 0"></path>
                                    <path
                                        d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4">
                                    </path>
                                    <path d="M5 21l0 -10.15"></path>
                                    <path d="M19 21l0 -10.15"></path>
                                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Marketplace <span
                                    class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count marketplace-notifications-count"
                                    data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                    style="display: none;"></span></span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-0"
                                href="http://127.0.0.1:8000/admin/marketplaces/reports"
                                id="cms-plugins-marketplace-reports" title="Reports"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Reports"><svg
                                        class="icon svg-icon-ti-ti-chart-bar" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path d="M4 20h14"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Reports </span></a><a
                                class="dropdown-item nav-priority-1"
                                href="http://127.0.0.1:8000/admin/marketplaces/stores" id="cms-plugins-store"
                                title="Stores"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Stores"><svg class="icon svg-icon-ti-ti-building-store"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 21l18 0"></path>
                                        <path
                                            d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4">
                                        </path>
                                        <path d="M5 21l0 -10.15"></path>
                                        <path d="M19 21l0 -10.15"></path>
                                        <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Stores </span></a><a
                                class="dropdown-item nav-priority-2"
                                href="http://127.0.0.1:8000/admin/marketplaces/withdrawals"
                                id="cms-plugins-withdrawal" title="Withdrawals"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Withdrawals"><svg
                                        class="icon svg-icon-ti-ti-cash-banknote" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path
                                            d="M3 8a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M18 12h.01"></path>
                                        <path d="M6 12h.01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Withdrawals <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count pending-withdrawals"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a><a
                                class="dropdown-item nav-priority-4"
                                href="http://127.0.0.1:8000/admin/marketplaces/vendors"
                                id="cms-plugins-marketplace-vendors" title="Vendors"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Vendors"><svg
                                        class="icon svg-icon-ti-ti-users" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Vendors </span></a><a
                                class="dropdown-item nav-priority-5"
                                href="http://127.0.0.1:8000/admin/marketplaces/unverified-vendors"
                                id="cms-plugins-marketplace-unverified-vendor" title="Unverified vendors"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Unverified vendors"><svg
                                        class="icon svg-icon-ti-ti-user-question" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>
                                        <path d="M19 22v.01"></path>
                                        <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Unverified vendors
                                    <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count unverified-vendors"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a><a
                                class="dropdown-item nav-priority-10"
                                href="http://127.0.0.1:8000/admin/marketplaces/messages"
                                id="cms-plugins-marketplace-messages" title="Messages"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Messages"><svg
                                        class="icon svg-icon-ti-ti-messages" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10">
                                        </path>
                                        <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Messages </span></a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-2" href="http://127.0.0.1:8000/admin/pages"
                            id="cms-core-page" title="Pages"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Pages"><svg class="icon svg-icon-ti-ti-notebook"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18">
                                    </path>
                                    <path d="M13 8l2 0"></path>
                                    <path d="M13 12l2 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Pages </span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-3"
                            href="http://127.0.0.1:8000/admin#cms-plugins-blog" id="cms-plugins-blog"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Blog"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Blog"><svg
                                    class="icon svg-icon-ti-ti-article" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                    </path>
                                    <path d="M7 8h10"></path>
                                    <path d="M7 12h10"></path>
                                    <path d="M7 16h10"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Blog </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-10" href="http://127.0.0.1:8000/admin/blog/posts"
                                id="cms-plugins-blog-post" title="Posts"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Posts"><svg
                                        class="icon svg-icon-ti-ti-file-text" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <path d="M9 9l1 0"></path>
                                        <path d="M9 13l6 0"></path>
                                        <path d="M9 17l6 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Posts </span></a><a
                                class="dropdown-item nav-priority-20"
                                href="http://127.0.0.1:8000/admin/blog/categories" id="cms-plugins-blog-categories"
                                title="Categories"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Categories"><svg class="icon svg-icon-ti-ti-folder"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Categories
                                </span></a><a class="dropdown-item nav-priority-30"
                                href="http://127.0.0.1:8000/admin/blog/tags" id="cms-plugins-blog-tags"
                                title="Tags"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Tags"><svg class="icon svg-icon-ti-ti-tag"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path
                                            d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Tags </span></a><a
                                class="dropdown-item nav-priority-40" href="http://127.0.0.1:8000/admin/blog/reports"
                                id="cms-plugins-blog-reports" title="Reports"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Reports"><svg
                                        class="icon svg-icon-ti-ti-chart-bar" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path
                                            d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z">
                                        </path>
                                        <path d="M4 20h14"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Reports </span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-3"
                            href="http://127.0.0.1:8000/admin#cms-plugins-payments" id="cms-plugins-payments"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Payments"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Payments"><svg
                                    class="icon svg-icon-ti-ti-credit-card" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                    </path>
                                    <path d="M3 10l18 0"></path>
                                    <path d="M7 15l.01 0"></path>
                                    <path d="M11 15l2 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Payments <span
                                    class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count payment-count"
                                    data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                    style="display: none;"></span></span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-0"
                                href="http://127.0.0.1:8000/admin/payments/transactions" id="cms-plugins-payments-all"
                                title="Transactions"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Transactions"><svg class="icon svg-icon-ti-ti-list"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 6l11 0"></path>
                                        <path d="M9 12l11 0"></path>
                                        <path d="M9 18l11 0"></path>
                                        <path d="M5 6l0 .01"></path>
                                        <path d="M5 12l0 .01"></path>
                                        <path d="M5 18l0 .01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Transactions <span
                                        class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count pending-payments"
                                        data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                        style="display: none;"></span></span></a><a
                                class="dropdown-item nav-priority-1" href="http://127.0.0.1:8000/admin/payments/logs"
                                id="cms-plugins-payment-logs" title="Payment Logs"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Payment Logs"><svg
                                        class="icon svg-icon-ti-ti-file-text" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path
                                            d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                        </path>
                                        <path d="M9 9l1 0"></path>
                                        <path d="M9 13l6 0"></path>
                                        <path d="M9 17l6 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Payment Logs
                                </span></a><a class="dropdown-item nav-priority-1"
                                href="http://127.0.0.1:8000/admin/payments/methods" id="cms-plugins-payment-methods"
                                title="Payment methods">
                                <span class="nav-link-icon d-md-none d-lg-inline-block" title="Payment methods"><svg
                                        class="icon svg-icon-ti-ti-settings" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                        </path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Payment methods
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-5"
                            href="http://127.0.0.1:8000/admin/galleries" id="cms-plugins-gallery"
                            title="Galleries"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Galleries"><svg class="icon svg-icon-ti-ti-camera"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2">
                                    </path>
                                    <path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Galleries </span></a>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-5"
                            href="http://127.0.0.1:8000/admin/testimonials" id="cms-plugins-testimonial"
                            title="Testimonials"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Testimonials"><svg class="icon svg-icon-ti-ti-user-star"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h.5"></path>
                                    <path
                                        d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z">
                                    </path>
                                </svg></span><span class="nav-link-title text-truncate"> Testimonials </span></a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-8"
                            href="http://127.0.0.1:8000/admin#cms-plugins-ads" id="cms-plugins-ads"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Ads"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Ads"><svg
                                    class="icon svg-icon-ti-ti-ad-circle" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M12 12m-10 0a10 10 0 1 0 20 0a10 10 0 1 0 -20 0"></path>
                                    <path d="M7 15v-4.5a1.5 1.5 0 0 1 3 0v4.5"></path>
                                    <path d="M7 13h3"></path>
                                    <path d="M14 9v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Ads </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-1" href="http://127.0.0.1:8000/admin/ads"
                                id="cms-plugins-ads-list" title="Ads"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Ads"><svg
                                        class="icon svg-icon-ti-ti-list" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 6l11 0"></path>
                                        <path d="M9 12l11 0"></path>
                                        <path d="M9 18l11 0"></path>
                                        <path d="M5 6l0 .01"></path>
                                        <path d="M5 12l0 .01"></path>
                                        <path d="M5 18l0 .01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Ads </span></a><a
                                class="dropdown-item nav-priority-2" href="http://127.0.0.1:8000/admin/settings/ads"
                                id="cms-plugins-ads-setting" title="Ads Settings"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Ads Settings"><svg
                                        class="icon svg-icon-ti-ti-settings" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                        </path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Ads Settings
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-10"
                            href="http://127.0.0.1:8000/admin/announcements" id="cms-plugins-announcement"
                            title="Announcements"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Announcements"><svg class="icon svg-icon-ti-ti-speakerphone"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 8a3 3 0 0 1 0 6"></path>
                                    <path d="M10 8v11a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-5"></path>
                                    <path
                                        d="M12 8h0l4.524 -3.77a.9 .9 0 0 1 1.476 .692v12.156a.9 .9 0 0 1 -1.476 .692l-4.524 -3.77h-8a1 1 0 0 1 -1 -1v-4a1 1 0 0 1 1 -1h8">
                                    </path>
                                </svg></span><span class="nav-link-title text-truncate"> Announcements </span></a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-120"
                            href="http://127.0.0.1:8000/admin#cms-plugins-contact" id="cms-plugins-contact"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Contact"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Contact"><svg
                                    class="icon svg-icon-ti-ti-mail" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                    </path>
                                    <path d="M3 7l9 6l9 -6"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Contact <span
                                    class="badge badge-sm bg-primary text-primary-fg badge-pill menu-item-count unread-contacts"
                                    data-url="http://127.0.0.1:8000/admin/menu-items-count"
                                    style="">5</span></span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-120" href="http://127.0.0.1:8000/admin/contacts"
                                id="cms-plugins-contact-list" title="Contacts"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Contacts"><svg
                                        class="icon svg-icon-ti-ti-cube" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M21 16.008v-8.018a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.008c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0l7 -4.008c.619 -.355 1 -1.01 1 -1.718z">
                                        </path>
                                        <path d="M12 22v-10"></path>
                                        <path d="M12 12l8.73 -5.04"></path>
                                        <path d="M3.27 6.96l8.73 5.04"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Contacts
                                </span></a><a class="dropdown-item nav-priority-130"
                                href="http://127.0.0.1:8000/admin/contacts/custom-fields"
                                id="cms-plugins-contact-custom-fields" title="Custom Fields"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Custom Fields"><svg
                                        class="icon svg-icon-ti-ti-cube-plus" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M21 12.5v-4.509a1.98 1.98 0 0 0 -1 -1.717l-7 -4.008a2.016 2.016 0 0 0 -2 0l-7 4.007c-.619 .355 -1 1.01 -1 1.718v8.018c0 .709 .381 1.363 1 1.717l7 4.008a2.016 2.016 0 0 0 2 0">
                                        </path>
                                        <path d="M12 22v-10"></path>
                                        <path d="M12 12l8.73 -5.04"></path>
                                        <path d="M3.27 6.96l8.73 5.04"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Custom Fields
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-390"
                            href="http://127.0.0.1:8000/admin/simple-sliders" id="cms-plugins-simple-slider"
                            title="Simple Sliders"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Simple Sliders"><svg class="icon svg-icon-ti-ti-slideshow"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 6l.01 0"></path>
                                    <path
                                        d="M3 3m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z">
                                    </path>
                                    <path d="M3 13l4 -4a3 5 0 0 1 3 0l4 4"></path>
                                    <path d="M13 12l2 -2a3 5 0 0 1 3 0l3 3"></path>
                                    <path d="M8 21l.01 0"></path>
                                    <path d="M12 21l.01 0"></path>
                                    <path d="M16 21l.01 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Simple Sliders
                            </span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-420"
                            href="http://127.0.0.1:8000/admin#cms-plugins-faq" id="cms-plugins-faq"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="FAQs"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="FAQs"><svg
                                    class="icon svg-icon-ti-ti-help-octagon" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M12.802 2.165l5.575 2.389c.48 .206 .863 .589 1.07 1.07l2.388 5.574c.22 .512 .22 1.092 0 1.604l-2.389 5.575c-.206 .48 -.589 .863 -1.07 1.07l-5.574 2.388c-.512 .22 -1.092 .22 -1.604 0l-5.575 -2.389a2.036 2.036 0 0 1 -1.07 -1.07l-2.388 -5.574a2.036 2.036 0 0 1 0 -1.604l2.389 -5.575c.206 -.48 .589 -.863 1.07 -1.07l5.574 -2.388a2.036 2.036 0 0 1 1.604 0z">
                                    </path>
                                    <path d="M12 16v.01"></path>
                                    <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                                </svg></span><span class="nav-link-title text-truncate"> FAQs </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-0" href="http://127.0.0.1:8000/admin/faqs"
                                id="cms-plugins-faq-list" title="FAQs"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="FAQs"><svg
                                        class="icon svg-icon-ti-ti-list-check" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                                        <path d="M11 6l9 0"></path>
                                        <path d="M11 12l9 0"></path>
                                        <path d="M11 18l9 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> FAQs </span></a><a
                                class="dropdown-item nav-priority-10"
                                href="http://127.0.0.1:8000/admin/faq-categories" id="cms-plugins-faq-category"
                                title="Categories"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Categories"><svg class="icon svg-icon-ti-ti-folder"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Categories
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-430"
                            href="http://127.0.0.1:8000/admin/newsletters" id="cms-plugins-newsletter"
                            title="Newsletters"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Newsletters"><svg class="icon svg-icon-ti-ti-mail"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z">
                                    </path>
                                    <path d="M3 7l9 6l9 -6"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Newsletters </span></a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-900"
                            href="http://127.0.0.1:8000/admin#cms-plugins-location" id="cms-plugins-location"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Locations"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Locations"><svg
                                    class="icon svg-icon-ti-ti-world" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M3.6 9h16.8"></path>
                                    <path d="M3.6 15h16.8"></path>
                                    <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                                    <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Locations </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-0" href="http://127.0.0.1:8000/admin/countries"
                                id="cms-plugins-country" title="Countries"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Countries"><svg
                                        class="icon svg-icon-ti-ti-flag" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M5 5a5 5 0 0 1 7 0a5 5 0 0 0 7 0v9a5 5 0 0 1 -7 0a5 5 0 0 0 -7 0v-9z">
                                        </path>
                                        <path d="M5 21v-7"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Countries
                                </span></a><a class="dropdown-item nav-priority-10"
                                href="http://127.0.0.1:8000/admin/states" id="cms-plugins-state"
                                title="States"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="States"><svg class="icon svg-icon-ti-ti-map"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13"></path>
                                        <path d="M9 4v13"></path>
                                        <path d="M15 7v13"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> States </span></a><a
                                class="dropdown-item nav-priority-20" href="http://127.0.0.1:8000/admin/cities"
                                id="cms-plugins-city" title="Cities"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Cities"><svg
                                        class="icon svg-icon-ti-ti-location-pin" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034">
                                        </path>
                                        <path
                                            d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z">
                                        </path>
                                        <path d="M19 18v.01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Cities </span></a><a
                                class="dropdown-item nav-priority-30"
                                href="http://127.0.0.1:8000/admin/locations/bulk-import"
                                id="cms-plugins-location-bulk-import" title="Location Importer"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Location Importer"><svg
                                        class="icon svg-icon-ti-ti-package-import"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"></path>
                                        <path d="M12 12l8 -4.5"></path>
                                        <path d="M12 12v9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                        <path d="M22 18h-7"></path>
                                        <path d="M18 15l-3 3l3 3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Location Importer
                                </span></a><a class="dropdown-item nav-priority-40"
                                href="http://127.0.0.1:8000/admin/locations/export" id="cms-plugins-location-export"
                                title="Location Exporter"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Location Exporter"><svg class="icon svg-icon-ti-ti-package-export"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"></path>
                                        <path d="M12 12l8 -4.5"></path>
                                        <path d="M12 12v9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                        <path d="M15 18h7"></path>
                                        <path d="M19 15l3 3l-3 3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Location Exporter
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-999"
                            href="http://127.0.0.1:8000/admin/media" id="cms-core-media" title="Media"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Media"><svg
                                    class="icon svg-icon-ti-ti-folder" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2">
                                    </path>
                                </svg></span><span class="nav-link-title text-truncate"> Media </span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-2000"
                            href="http://127.0.0.1:8000/admin#cms-core-appearance" id="cms-core-appearance"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Appearance"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Appearance"><svg
                                    class="icon svg-icon-ti-ti-brush" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M3 21v-4a4 4 0 1 1 4 4h-4"></path>
                                    <path d="M21 3a16 16 0 0 0 -12.8 10.2"></path>
                                    <path d="M21 3a16 16 0 0 1 -10.2 12.8"></path>
                                    <path d="M10.6 9a9 9 0 0 1 4.4 4.4"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Appearance </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-1" href="http://127.0.0.1:8000/admin/theme/all"
                                id="cms-core-theme" title="Themes"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Themes"><svg
                                        class="icon svg-icon-ti-ti-palette" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25">
                                        </path>
                                        <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Themes </span></a><a
                                class="dropdown-item nav-priority-2" href="http://127.0.0.1:8000/admin/menus"
                                id="cms-core-menu" title="Menus"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Menus"><svg
                                        class="icon svg-icon-ti-ti-tournament" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 4m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M4 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M4 20m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M6 12h3a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-3"></path>
                                        <path d="M6 4h7a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-2"></path>
                                        <path d="M14 10h4"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Menus </span></a><a
                                class="dropdown-item nav-priority-3" href="http://127.0.0.1:8000/admin/widgets"
                                id="cms-core-widget" title="Widgets"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Widgets"><svg
                                        class="icon svg-icon-ti-ti-layout" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path
                                            d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path
                                            d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Widgets </span></a><a
                                class="dropdown-item nav-priority-4"
                                href="http://127.0.0.1:8000/admin/theme/options" id="cms-core-theme-option"
                                title="Theme Options"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Theme Options"><svg class="icon svg-icon-ti-ti-list-tree"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 6h11"></path>
                                        <path d="M12 12h8"></path>
                                        <path d="M15 18h5"></path>
                                        <path d="M5 6v.01"></path>
                                        <path d="M8 12v.01"></path>
                                        <path d="M11 18v.01"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Theme Options
                                </span></a><a class="dropdown-item nav-priority-5"
                                href="http://127.0.0.1:8000/admin/theme/custom-css"
                                id="cms-core-appearance-custom-css" title="Custom CSS"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Custom CSS"><svg
                                        class="icon svg-icon-ti-ti-file-type-css" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M8 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0"></path>
                                        <path
                                            d="M11 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75">
                                        </path>
                                        <path
                                            d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75">
                                        </path>
                                    </svg></span><span class="nav-link-title text-truncate"> Custom CSS
                                </span></a><a class="dropdown-item nav-priority-6"
                                href="http://127.0.0.1:8000/admin/theme/custom-js"
                                id="cms-core-appearance-custom-js" title="Custom JS"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Custom JS"><svg
                                        class="icon svg-icon-ti-ti-file-type-js" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M3 15h3v4.5a1.5 1.5 0 0 1 -3 0"></path>
                                        <path
                                            d="M9 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75">
                                        </path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-1"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Custom JS
                                </span></a><a class="dropdown-item nav-priority-6"
                                href="http://127.0.0.1:8000/admin/theme/custom-html"
                                id="cms-core-appearance-custom-html" title="Custom HTML"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block" title="Custom HTML"><svg
                                        class="icon svg-icon-ti-ti-file-type-html"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M2 21v-6"></path>
                                        <path d="M5 15v6"></path>
                                        <path d="M2 18h3"></path>
                                        <path d="M20 15v6h2"></path>
                                        <path d="M13 21v-6l2 3l2 -3v6"></path>
                                        <path d="M7.5 15h3"></path>
                                        <path d="M9 15v6"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Custom HTML
                                </span></a>
                            <a class="dropdown-item nav-priority-6"
                                href="http://127.0.0.1:8000/admin/theme/robots-txt"
                                id="cms-core-appearance-robots-txt" title="Robots.txt Editor">
                                <span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Robots.txt Editor"><svg class="icon svg-icon-ti-ti-file-type-txt"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                        <path d="M16.5 15h3"></path>
                                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"></path>
                                        <path d="M4.5 15h3"></path>
                                        <path d="M6 15v6"></path>
                                        <path d="M18 15v6"></path>
                                        <path d="M10 15l4 6"></path>
                                        <path d="M10 21l4 -6"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Robots.txt Editor
                                </span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-3000"
                            href="http://127.0.0.1:8000/admin#cms-core-plugins" id="cms-core-plugins"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Plugins"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Plugins"><svg
                                    class="icon svg-icon-ti-ti-plug" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M9.785 6l8.215 8.215l-2.054 2.054a5.81 5.81 0 1 1 -8.215 -8.215l2.054 -2.054z">
                                    </path>
                                    <path d="M4 20l3.5 -3.5"></path>
                                    <path d="M15 4l-3.5 3.5"></path>
                                    <path d="M20 9l-3.5 3.5"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Plugins </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-1"
                                href="http://127.0.0.1:8000/admin/plugins/installed" id="cms-core-plugins-installed"
                                title="Installed Plugins"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Installed Plugins"><svg class="icon svg-icon-ti-ti-square-check"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z">
                                        </path>
                                        <path d="M9 12l2 2l4 -4"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Installed Plugins
                                </span></a><a class="dropdown-item nav-priority-2"
                                href="http://127.0.0.1:8000/admin/plugins/new" id="cms-core-plugins-marketplace"
                                title="Add New Plugin"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Add New Plugin"><svg class="icon svg-icon-ti-ti-square-rounded-plus"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z">
                                        </path>
                                        <path d="M15 12h-6"></path>
                                        <path d="M12 9v6"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Add New Plugin
                                </span></a></div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle nav-priority-9000"
                            href="http://127.0.0.1:8000/admin#cms-core-tools" id="cms-core-tools"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="false" title="Tools"><span
                                class="nav-link-icon d-md-none d-lg-inline-block" title="Tools"><svg
                                    class="icon svg-icon-ti-ti-tool" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5">
                                    </path>
                                </svg></span><span class="nav-link-title text-truncate"> Tools </span></a>
                        <div class="dropdown-menu animate slideIn dropdown-menu-start"><a
                                class="dropdown-item nav-priority-9000"
                                href="http://127.0.0.1:8000/admin/tools/data-synchronize"
                                id="cms-packages-data-synchronize" title="Export/Import Data"><span
                                    class="nav-link-icon d-md-none d-lg-inline-block"
                                    title="Export/Import Data"><svg class="icon svg-icon-ti-ti-package-import"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5"></path>
                                        <path d="M12 12l8 -4.5"></path>
                                        <path d="M12 12v9"></path>
                                        <path d="M12 12l-8 -4.5"></path>
                                        <path d="M22 18h-7"></path>
                                        <path d="M18 15l-3 3l3 3"></path>
                                    </svg></span><span class="nav-link-title text-truncate"> Export/Import Data
                                </span></a></div>
                    </li>
                    <li class="nav-item"><a class="nav-link nav-priority-9999"
                            href="http://127.0.0.1:8000/admin/settings" id="cms-core-settings"
                            title="Settings"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Settings"><svg class="icon svg-icon-ti-ti-settings"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Settings </span></a></li>
                    <li class="nav-item"><a class="nav-link nav-priority-10000"  --}}
                            {{--  href="http://127.0.0.1:8000/admin/system" id="cms-core-system"
                            title="Platform Administration"><span class="nav-link-icon d-md-none d-lg-inline-block"
                                title="Platform Administration"><svg class="icon svg-icon-ti-ti-user-shield"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h2"></path>
                                    <path
                                        d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z">
                                    </path>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                </svg></span><span class="nav-link-title text-truncate"> Platform Administration
                            </span></a></li>  --}}
                </ul>
            </div>
        </div>
    </aside>
