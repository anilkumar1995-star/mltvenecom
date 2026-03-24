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
        content="Multive is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <meta property="og:url" content="{{ asset('/') }}">
    <meta property="og:image" content="{{ asset('/') }}storage/i-university-logo-01.png">
    <meta name="twitter:title" content="Multive - Multipurpose eCommerce Laravel Script">
    <meta name="twitter:description"
        content="Multive is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <link rel="sitemap" title="Sitemap" href="{{ asset('/') }}sitemap.xml" type="application/xml">

    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}storage/main/general/favicon.png">


    <!-- <link rel="preload" as="image" href="./home/newsletter-popup.jpg"> -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/content-styles.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/bootstrap.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/front-auth.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/social-login.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/front-ecommerce.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/animate.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/swiper-bundle.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/owl.carousel.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/slick.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/theme.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/theme(1).css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/lightgallery.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/spectrum.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/core.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/language.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('home/announcement.css') }}">
    <link href="{{ asset('') }}" hreflang="x-default" rel="alternate">
    <script>
        window.currencies = {
            "display_big_money": false,
            "billion": "Billion",
            "million": "Million",
            "is_prefix_symbol": true,
            "symbol": "₹",
            "title": "INR",
            "decimal_separator": ".",
            "thousands_separator": ",",
            "number_after_dot": 2,
            "show_symbol_or_title": true
        };
        window.siteConfig = {
            "img_placeholder": "{{ asset('home/placeholder.png') }}"
        };
    </script>
    <script async="" defer="" src="{{ asset('js/js') }}"></script>

    <link href="{{ asset('') }}" hreflang="en" rel="alternate">
    <link href="{{ asset('') }}" hreflang="en-us" rel="alternate">
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
            background-image: url({{ asset('/') }}/storage/main/general/breadcrumb.jpg);
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
    <style>
        /* Premium Mini Cart Sidebar Styles */
        .cartmini__area {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background: #fff;
            z-index: 100000;
            transform: translateX(105%);
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            box-shadow: -10px 0 30px rgba(0,0,0,0.1);
            display: flex !important;
            flex-direction: column;
        }

        .cartmini__area.cartmini-opened {
            transform: translateX(0);
        }

        .cartmini__wrapper {
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .cartmini__title {
            padding: 20px 25px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
        }

        .cartmini__title h4 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #010f1c;
        }

        .cartmini__close {
            position: absolute;
            top: 15px;
            right: 20px;
            z-index: 10;
        }

        .cartmini__close-btn {
            font-size: 18px;
            color: #010f1c;
            background: #f5f5f5;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .cartmini__close-btn:hover {
            background: #678E61;
            color: #fff;
            transform: rotate(90deg);
        }

        .cartmini__widget {
            flex-grow: 1;
            overflow-y: auto;
            padding: 20px 25px;
            scrollbar-width: thin;
            scrollbar-color: #678E61 #f0f0f0;
        }

        .cartmini__widget::-webkit-scrollbar {
            width: 5px;
        }
        .cartmini__widget::-webkit-scrollbar-thumb {
            background: #678E61;
            border-radius: 10px;
        }

        .cartmini__inner ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .cartmini__inner ul li {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #f5f5f5;
            position: relative;
        }

        .cartmini__thumb {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            margin-right: 15px;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .cartmini__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cartmini__content {
            flex-grow: 1;
            padding-right: 20px;
        }

        .cartmini__content h5 {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .cartmini__content h5 a:hover {
            color: #678E61;
        }

        .cartmini__del {
            position: absolute;
            top: 0;
            right: 0;
            color: #999;
            font-size: 14px;
            transition: 0.3s;
        }

        .cartmini__del:hover {
            color: #ff4d4f;
        }

        .cartmini__checkout {
            padding: 25px;
            background: #fff;
            border-top: 1px solid #f0f0f0;
            box-shadow: 0 -5px 20px rgba(0,0,0,0.02);
        }

        .cartmini__checkout-title span {
            font-size: 15px;
            color: #55585b;
        }

        .cartmini__checkout-title h4 {
            font-size: 18px;
            font-weight: 700;
            color: #010f1c;
        }

        .cartmini__checkout-btn .tp-btn {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 12px;
            text-transform: uppercase;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .cartmini__checkout-btn .tp-btn:hover {
            background: #678E61;
            border-color: #678E61;
            color: #fff;
        }

        /* Mini Cart Quantity Styling */
        .product-quantity {
            display: flex;
            align-items: center;
            background: #f3f5f6;
            width: fit-content;
            border-radius: 4px;
            padding: 2px;
        }
        .cart-minus, .cart-plus {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            color: #010f1c;
            transition: 0.3s;
        }
        .cart-minus:hover, .cart-plus:hover {
            color: #678E61;
        }
        .cart-input {
            width: 35px;
            text-align: center;
            border: none;
            background: transparent;
            font-size: 14px;
            font-weight: 600;
            color: #010f1c;
            pointer-events: none;
            padding: 0;
            margin: 0;
        }

        .body-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(1, 15, 28, 0.6);
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            backdrop-filter: blur(3px);
        }

        .body-overlay.opened {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 480px) {
            .cartmini__area {
                width: 100%;
            }
        }

        /* Loading state for buttons */
        .tp-add-cart-btn.loading {
            position: relative;
            color: transparent !important;
            pointer-events: none;
        }
        .tp-add-cart-btn.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-top: -10px;
            margin-left: -10px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    @include('frontend.layouts.header')

    @yield('content')
    @include('frontend.layouts.footer')

    <script src="{{ asset('home/jquery-3.7.1.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ asset('home/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/lazyload.min.js') }}"></script>
    <script src="{{ asset('home/swiper-bundle.js') }}"></script>
    <script src="{{ asset('home/owl.carousel.js') }}"></script>
    <script src="{{ asset('home/slick.min.js') }}"></script>
    <script src="{{ asset('home/meanmenu.js') }}"></script>
    <script src="{{ asset('home/theme.js') }}"></script>
    <script src="{{ asset('home/front-ecommerce.js') }}"></script>
    <script src="{{ asset('assets/js/core/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('home/ecommerce.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>

    @include('frontend.partials.mini-cart')

    <!-- Quick View Modal -->
    <div class="modal fade tp-product-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="tp-product-modal-thumb">
                                <img src="" id="qv-image" alt="product" class="img-fluid rounded-4 h-100 w-100 object-fit-cover" style="max-height: 400px;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tp-product-modal-content p-4">
                                <h3 class="tp-product-modal-title mb-2 h4 fw-bold" id="qv-name">Product Name</h3>
                                <div class="tp-product-modal-price mb-3">
                                    <span class="h4 fw-bold text-primary">₹<span id="qv-price">0.00</span></span>
                                </div>
                                <p class="text-muted mb-4 small">Discover high-quality products curated just for you. Add this item to your cart and enjoy the best shopping experience.</p>
                                
                                <div class="tp-product-modal-action d-flex align-items-center gap-3 mt-4">
                                    <button class="btn btn-primary w-100 py-3 rounded-3 fw-bold qv-add-btn" id="qv-add-to-cart-btn">
                                        <i class="fas fa-shopping-basket me-2"></i> Add to Cart
                                    </button>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" id="qv-view-details" class="text-primary text-decoration-none fw-medium small">View Full Details <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stack('scripts')
    <script>
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // --- Utility Functions ---

            function updateCartBadge(count) {
                $('[data-bb-value="cart-count"]').text(count);
                $('.tp-cart-count').text(count);
            }

            function refreshMiniCart(html) {
                if (html) {
                    var $temp = $('<div>').append($.parseHTML(html));
                    var $newWrapper = $temp.find('.cartmini__wrapper');
                    if ($newWrapper.length) {
                        $('.cartmini__wrapper').html($newWrapper.html());
                    }
                }
            }

            function openMiniCart() {
                $('.cartmini__area').addClass('cartmini-opened');
                $('.body-overlay').addClass('opened');
                $('body').css('overflow', 'hidden');
            }

            function closeMiniCart() {
                $('.cartmini__area').removeClass('cartmini-opened');
                $('.body-overlay').removeClass('opened');
                $('body').css('overflow', '');
            }

            // --- Event Listeners ---

            // Close actions
            $(document).on('click', '.cartmini-close-btn, .body-overlay', function(e) {
                closeMiniCart();
            });

            // Open actions (from header)
            $(document).on('click', '.cartmini-open-btn', function(e) {
                e.preventDefault();
                openMiniCart();
            });

            // Add to Cart AJAX (for standalone buttons)
            $(document).on('click', '.tp-add-cart-btn', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var id = $btn.data('id');
                var url = $btn.data('url') || '{{ route("frontend.cart.add") }}';
                
                $btn.addClass('loading');

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { _token: csrfToken, product_id: id, quantity: 1 },
                    success: function(res) {
                        if (res.success) {
                            updateCartBadge(res.count);
                            refreshMiniCart(res.html);
                            notify(res.message, 'success');
                            openMiniCart();
                        }
                    },
                    error: function() { notify('Failed to add product.', 'error'); },
                    complete: function() { $btn.removeClass('loading'); }
                });
            });

            // Add to Cart AJAX (for forms)
            $(document).on('submit', '.add-to-cart-form', function(e) {
                e.preventDefault();
                var $form = $(this);
                var $btn = $form.find('button[type="submit"]');
                var originalText = $btn.html();

                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: $form.serialize(),
                    success: function(res) {
                        if (res.success) {
                            updateCartBadge(res.count);
                            refreshMiniCart(res.html);
                            notify(res.message, 'success');
                            openMiniCart();
                        }
                    },
                    error: function() { notify('Failed to add product.', 'error'); },
                    complete: function() { $btn.prop('disabled', false).html(originalText); }
                });
            });

            // Wishlist Toggle AJAX
            $(document).on('click', '.tp-wishlist-btn', function(e) {
                e.preventDefault();
                var $btn = $(this);
                var id = $btn.data('id');
                var url = $btn.data('url') || '{{ route("frontend.wishlist.toggle") }}';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { _token: csrfToken, product_id: id },
                    success: function(res) {
                        if (res.success) {
                            notify(res.message, 'success');
                            if (res.in_wishlist) {
                                $btn.find('i').removeClass('far').addClass('fas text-danger');
                            } else {
                                $btn.find('i').removeClass('fas text-danger').addClass('far');
                            }
                            $('[data-bb-value="wishlist-count"]').text(res.count);
                        }
                    }
                });
            });

            // Mini-cart Quantity Controls
            $(document).on('click', '.cart-plus, .cart-minus', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $btn = $(this);
                var id = $btn.data('id');
                var $input = $btn.siblings('.cart-input');
                var currentQty = parseInt($input.val()) || 1;
                var isPlus = $btn.hasClass('cart-plus');
                var newQty = isPlus ? currentQty + 1 : currentQty - 1;

                if (newQty <= 0) {
                    removeItem(id);
                } else {
                    $input.val(newQty);
                    updateQty(id, newQty);
                }
            });

            function updateQty(id, qty) {
                $.ajax({
                    url: '{{ route("frontend.cart.update") }}',
                    method: 'POST',
                    data: { _token: csrfToken, product_id: id, quantity: qty },
                    success: function(res) {
                        if (res.success) {
                            updateCartBadge(res.count);
                            refreshMiniCart(res.html);
                        }
                    }
                });
            }

            function removeItem(id) {
                $.ajax({
                    url: '/cart/remove/' + id,
                    method: 'POST',
                    data: { _token: csrfToken, _method: 'DELETE' },
                    success: function(res) {
                        if (res.success) {
                            updateCartBadge(res.count);
                            refreshMiniCart(res.html);
                            notify('Product removed!', 'success');
                        }
                    }
                });
            }

            // Mini-cart Delete Button
            $(document).on('click', '.cartmini__del', function(e) {
                e.preventDefault();
                removeItem($(this).data('id'));
            });

            // Quick View Logic
            $(document).on('click', '.tp-quick-view-btn', function(e) {
                e.preventDefault();
                var data = $(this).data();
                $('#qv-name').text(data.name);
                $('#qv-price').text(data.price);
                $('#qv-image').attr('src', data.image);
                $('#qv-view-details').attr('href', data.url);
                $('#qv-add-to-cart-btn').data('id', data.id);
                $('#quickViewModal').modal('show');
            });
            
            // Modal Add to Cart
            $(document).on('click', '#qv-add-to-cart-btn', function() {
                var id = $(this).data('id');
                $('#quickViewModal').modal('hide');
                $('.tp-add-cart-btn[data-id="' + id + '"]').first().trigger('click');
            });
        });

        function notify(text, status) {
            new Notify({
                status: status,
                title: null,
                text: text,
                effect: 'fade',
                customClass: null,
                customIcon: null,
                showIcon: true,
                showCloseButton: true,
                autoclose: true,
                autotimeout: 2000,
                gap: 20,
                distance: 15,
                type: 1,
                position: 'right top'
            })
        }

        @if(session('success')) notify("{{ session('success') }}", 'success'); @endif
        @if(session('error')) notify("{{ session('error') }}", 'error'); @endif
        @if($errors->any()) @foreach($errors->all() as $error) notify("{{ $error }}", 'error'); @endforeach @endif
    </script>
    <form id="global-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
@auth
    <script>
        (function() {
            let inactivityTime = function() {
                let time;
                // Get session lifetime from PHP and convert to milliseconds
                // Default is from config/session.php (minutes)
                const waitTime = {{ config('session.lifetime') * 60 * 1000 }};
                
                window.onload = resetTimer;
                document.onmousemove = resetTimer;
                document.onkeypress = resetTimer;
                document.ontouchstart = resetTimer;
                document.onmousedown = resetTimer;
                document.onscroll = resetTimer;

                function logout() {
                    // Show a sleek alert before logout if SweetAlert2 is available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Session Expiring',
                            text: 'You have been inactive for a while. Logging out for security...',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            willClose: () => {
                                performLogout();
                            }
                        });
                    } else {
                        performLogout();
                    }
                }

                function performLogout() {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('logout') }}';
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);
                    document.body.appendChild(form);
                    form.submit();
                }

                function resetTimer() {
                    clearTimeout(time);
                    time = setTimeout(logout, waitTime);
                }
            };
            inactivityTime();
        })();
    </script>
    @endauth
</body>
</html>

