<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MLTVE - Multipurpose eCommerce Laravel Script')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{--  @vite(['resources/sass/app.scss'])  --}}

    <meta name="description"
        content="MLTVE is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <link rel="canonical" href="{{ asset('/') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="MLTVE - Multipurpose eCommerce Laravel Script">
    <meta property="og:type" content="article">
    <meta property="og:title" content="MLTVE - Multipurpose eCommerce Laravel Script">
    <meta property="og:description"
        content="Shofy is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <meta property="og:url" content="{{ asset('/') }}">
    <meta property="og:image" content="{{ asset('/') }}storage/i-university-logo-01.png">
    <meta name="twitter:title" content="Shofy - Multipurpose eCommerce Laravel Script">
    <meta name="twitter:description"
        content="Shofy is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <link rel="sitemap" title="Sitemap" href="{{ asset('/') }}sitemap.xml" type="application/xml">

    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}storage/main/general/favicon.png">


    <!-- <link rel="preload" as="image" href="./home/newsletter-popup.jpg"> -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/content-styles.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/front-auth.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/social-login.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/front-ecommerce.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/animate.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/swiper-bundle.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/owl.carousel.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/slick.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/theme.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/theme(1).css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/lightgallery.min.css">

    {{--  <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/fontawesome.min.css">  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/select2.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/toastr.min.css">
    <link media="all" type="text/css" rel="stylesheet"
        href="{{ asset('/') }}css/jquery.mCustomScrollbar.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/flatpickr.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/spectrum.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/jquery.fancybox.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/core.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/language.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home/announcement.css">
    <link href="{{ asset('/') }}" hreflang="x-default" rel="alternate">
    <script async="" defer="" src="{{ asset('/') }}js/js"></script>


    <link href="{{ asset('/') }}" hreflang="en" rel="alternate">
    <link href="{{ asset('/') }}" hreflang="en-us" rel="alternate">
    <style>
        :root {
            --primary-color: #678E61;
            --secondary-color: #821f40;
            --primary-color-rgb: 103, 142, 97;
            --tp-theme-secondary: #821f40;
            --footer-background-color: #fff;
            --footer-text-color: #010f1c;
            --footer-title-color: #010f1c;
            --footer-link-color: #010f1c;
            --footer-link-hover-color: #0989ff;
            --footer-border-color: #e5e6e8;
            --header-menu-text-hover-color: #0989ff;
            --header-main-text-hover-color: #0989ff;
            --header-sticky-background-color: #fff;
            --header-sticky-text-color: #010f1c;
            --header-sticky-text-hover-color: #0989ff;


        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73odd4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73ord4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 300;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73otd4jqmfxi.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73odd4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73ord4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 400;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73otd4jqmfxi.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73odd4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73ord4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 500;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73otd4jqmfxi.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73odd4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73ord4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 600;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73otd4jqmfxi.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73odd4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73ord4jqmfxic7w.woff2) format('woff2');
            unicode-range: U+0100-02BA, U+02BD-02C5, U+02C7-02CC, U+02CE-02D7, U+02DD-02FF, U+0304, U+0308, U+0329, U+1D00-1DBF, U+1E00-1E9F, U+1EF2-1EFF, U+2020, U+20A0-20AB, U+20AD-20C0, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        @font-face {
            font-family: 'Jost';
            font-style: normal;
            font-weight: 700;
            font-display: swap;
            src: url({{ asset('/') }}storage/fonts/7c2fc45563/sjostv2092zatbhpnqw73otd4jqmfxi.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+0304, U+0308, U+0329, U+2000-206F, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        a, a:hover, a:focus, a:active {
            text-decoration: none !important;
        }

        ::selection {
            background-color: var(--primary-color) !important;
            color: #fff !important;
        }

        :root {
            --primary-font: "Jost", sans-serif;
            --body-size: 14px;
            --h1-size: 36px;
            --h2-size: 32px;
            --h3-size: 28px;
            --h4-size: 24px;
            --h5-size: 20px;
            --h6-size: 16px;
        }

        h1 {
            font-size: var(--h1-size);
        }

        h2 {
            font-size: var(--h2-size);
        }

        h3 {
            font-size: var(--h3-size);
        }

        h4 {
            font-size: var(--h4-size);
        }

        h5 {
            font-size: var(--h5-size);
        }

        h6 {
            font-size: var(--h6-size);
        }

        body {
            font-size: var(--body-size);
        }

        .page_speed_748968259 {
            max-height: 35px !important;
        }

        .page_speed_474752537 {
            height: 24px;
            width: auto;
        }

        .page_speed_1049214245 {
            height: 16px;
            width: auto;
        } 

        .page_speed_772306096 {
            --bottom-bar-menu-text-font-size: 13px;
        }

        .page_speed_1191860875 {
            background-color: #fff;
            color: #010f1c
        }

        .page_speed_470946417 {
            background-color: #678E61;
            color: #fff
        }

        .page_speed_1068123808 {
            display: none
        }

        .page_speed_464693960 {
            background-image: url(https://shofy-grocery.botble.com/storage/main/general/breadcrumb.jpg);
            display: flex;
            align-items: center;
            height: 120px;
        }

        .page_speed_1736237404 {
            display: none;
        }

        .page_speed_1658013737 {
            direction: ltr;
            text-align: left;
        }

        .page_speed_580096859 {
            background-color: #FFFFFF
        }

        .page_speed_910613870 {
            max-height: 50px
        }

        .page_speed_2077739829 {}

        .page_speed_1668707954 {
            background-color: #000;
            color: #fff;
        }

        .page_speed_1959373873 {
            max-width: 1170px;
        }

        .page_speed_647546886 {
            background-color: #fff;
            color: #000;
            border: 1px solid #fff;
        }

        .page_speed_1043679985 {
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
        }

        /* Toastr Fix - force text visibility */
        .toast-success {
            background-color: #72ac72 !important;
            color: #fff !important;
        }
        .toast-error {
            background-color: #BD362F !important;
            color: #fff !important;
        }
        .toast-info {
            background-color: #2F96B4 !important;
            color: #fff !important;
        }
        .toast-warning {
            background-color: #F89406 !important;
            color: #fff !important;
        }
        #toast-container > div {
            opacity: 1 !important;
            color: #fff !important;
        }
        #toast-container .toast-title {
            color: #fff !important;
            font-weight: bold;
        }
        #toast-container .toast-message {
            color: #fff !important;
        }

        /* Global Alert Fix */
        .alert-success {
            background-color: #d1e7dd !important;
            color: #90f897 !important;
            border-color: #badbcc !important;
        }
        .alert-danger {
            background-color: #f8d7da !important;
            color: #842029 !important;
            border-color: #f5c2c7 !important;
        }

        /* Fix: Restore normal table layout on desktop for customer pages */
        @media (min-width: 768px) {
            .bb-customer-page .table-responsive .table {
                border-collapse: collapse !important;
            }
            .bb-customer-page .table-responsive .table thead {
                display: table-header-group !important;
            }
            .bb-customer-page .table-responsive .table tbody {
                display: table-row-group !important;
            }
            .bb-customer-page .table-responsive .table tbody tr {
                display: table-row !important;
                margin-bottom: 0 !important;
                border-radius: 0 !important;
            }
            .bb-customer-page .table-responsive .table tbody tr td {
                display: table-cell !important;
                text-align: left !important;
                border-bottom: 1px solid #dee2e6 !important;
                width: auto !important;
            }
            .bb-customer-page .table-responsive .table tbody tr td:before {
                content: none !important;
                display: none !important;
            }
            .bb-customer-page .table-responsive .table tbody tr td.text-end {
                text-align: right !important;
            }
            .bb-customer-page .table-responsive {
                background-color: transparent !important;
                padding: 0 !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('frontend.layouts.header')

    @yield('content')
    @include('frontend.layouts.footer')

    <script src="{{ asset('/') }}home/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('/') }}home/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}home/lazyload.min.js"></script>
    <script src="{{ asset('/') }}home/swiper-bundle.js"></script>
    <script src="{{ asset('/') }}home/owl.carousel.js"></script>
    <script src="{{ asset('/') }}home/slick.min.js"></script>
    <script src="{{ asset('/') }}home/meanmenu.js"></script>
    <script src="{{ asset('/') }}home/theme.js"></script>
    <script src="{{ asset('/') }}home/front-ecommerce.js"></script>
    <script src="{{ asset('/') }}assets/js/core/sweetalert2@11.js"></script>
    <script src="{{ asset('/') }}home/ecommerce.js"></script>
    <script src="{{ asset('/') }}js/toastr.min.js"></script>

    @include('frontend.partials.mini-cart')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/shopify-cartjs/1.1.0/cart.min.js"></script>     -->
@stack('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
        };

        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('status'))
            toastr.info("{{ session('status') }}");
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        window.themeOptions = {
            ecommerce_auto_open_mini_cart: 'yes',
        };
    </script>

    {{-- Cart AJAX Functionality --}}
    <script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Update cart badge count in header
        function updateCartBadge(count) {
            $('[data-bb-value="cart-count"]').text(count);
        }

        // Refresh mini-cart HTML
        function refreshMiniCart(html) {
            if (html) {
                var $temp = $('<div>').html(html);
                var $newCartArea = $temp.find('.cartmini__area');
                if ($newCartArea.length) {
                    $('.cartmini__area').html($newCartArea.html());
                }
            }
        }

        // Mini-cart PLUS button
        $(document).on('click', '.cart-plus', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).data('id');
            var $input = $(this).siblings('.cart-input');
            var currentQty = parseInt($input.val()) || 1;
            var newQty = currentQty + 1;
            $input.val(newQty);

            $.ajax({
                url: '{{ route("frontend.cart.update") }}',
                method: 'POST',
                data: { _token: csrfToken, product_id: id, quantity: newQty },
                success: function(res) {
                    if (res.success) {
                        updateCartBadge(res.count);
                        refreshMiniCart(res.html);
                    }
                }
            });
        });

        // Mini-cart MINUS button - removes item when qty reaches 0
        $(document).on('click', '.cart-minus', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var id = $(this).data('id');
            var $input = $(this).siblings('.cart-input');
            var currentQty = parseInt($input.val()) || 1;
            var newQty = currentQty - 1;

            if (newQty <= 0) {
                // Remove item completely
                $.ajax({
                    url: '/cart/remove/' + id,
                    method: 'POST',
                    data: { _token: csrfToken, _method: 'DELETE' },
                    success: function(res) {
                        if (res.success) {
                            updateCartBadge(res.count);
                            refreshMiniCart(res.html);
                            toastr.success('Product removed from cart!');
                        }
                    }
                });
                return;
            }

            $input.val(newQty);
            $.ajax({
                url: '{{ route("frontend.cart.update") }}',
                method: 'POST',
                data: { _token: csrfToken, product_id: id, quantity: newQty },
                success: function(res) {
                    if (res.success) {
                        updateCartBadge(res.count);
                        refreshMiniCart(res.html);
                    }
                }
            });
        });

        // Mini-cart DELETE (X) button
        $(document).on('click', '.cartmini__del', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $li = $(this).closest('li');
            var $form = $li.find('form[id^="remove-cart-"]');
            var action = $form.attr('action');
            if (!action) return;

            $.ajax({
                url: action,
                method: 'POST',
                data: { _token: csrfToken, _method: 'DELETE' },
                success: function(res) {
                    if (res.success) {
                        updateCartBadge(res.count);
                        refreshMiniCart(res.html);
                        toastr.success(res.message);
                    }
                }
            });
        });

        // Add to Cart AJAX (for forms with class .add-to-cart-form)
        $(document).on('submit', '.add-to-cart-form', function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('button[type="submit"]');
            var originalText = $btn.html();

            $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Adding...');

            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(res) {
                    if (res.success) {
                        updateCartBadge(res.count);
                        refreshMiniCart(res.html);
                        toastr.success(res.message);

                        // Auto open mini-cart
                        if (window.themeOptions && window.themeOptions.ecommerce_auto_open_mini_cart === 'yes') {
                            $('.cartmini__area').addClass('cartmini-opened');
                            $('.body-overlay').addClass('opened');
                        }
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!');
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
    </script>
</body>

</html>
