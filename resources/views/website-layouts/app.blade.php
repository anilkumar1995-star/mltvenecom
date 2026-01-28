<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Shofy - Multipurpose eCommerce Laravel Script</title>
    <meta name="description"
        content="Shofy is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <link rel="canonical" href="{{ asset('/') }}">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="Shofy - Multipurpose eCommerce Laravel Script">
    <meta property="og:type" content="article">
    <meta property="og:title" content="Shofy - Multipurpose eCommerce Laravel Script">
    <meta property="og:description"
        content="Shofy is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <meta property="og:url" content="{{ asset('/') }}">
    <meta property="og:image" content="{{ asset('/') }}storage/i-university-logo-01.png">
    <meta name="twitter:title" content="Shofy - Multipurpose eCommerce Laravel Script">
    <meta name="twitter:description"
        content="Shofy is a powerful tool eCommerce Laravel script for creating a professional and visually appealing online store.">
    <link rel="sitemap" title="Sitemap" href="{{ asset('/') }}sitemap.xml" type="application/xml">

    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}storage/main/general/favicon.png">


    <!-- <link rel="preload" as="image" href="./home dashboard_files/newsletter-popup.jpg"> -->
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/content-styles.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/front-auth.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/social-login.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/front-ecommerce.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/animate.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/swiper-bundle.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/owl.carousel.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/slick.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/theme.css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/theme(1).css">
    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/lightgallery.min.css">

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/fontawesome.min.css">
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

    <link media="all" type="text/css" rel="stylesheet" href="./home dashboard_files/announcement.css">
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
    </style>
    <style>
        .site-notice {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 8px;
            z-index: 99999;
            display: none;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .site-notice.site-notice--visible {
            display: block;
        }

        .site-notice.site-notice-full-width .site-notice-body {
            margin: 0 auto;
        }

        .site-notice.site-notice-minimal {
            padding: 0;
            right: unset;
            border-radius: 5px;
            bottom: 1em;
            flex-direction: column;
            left: 1em;
        }

        .site-notice.site-notice-minimal .site-notice-body {
            margin: 0 16px 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 400px !important;
        }

        .site-notice.site-notice-minimal .site-notice__inner {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
            padding: 4px;
        }

        .site-notice.site-notice-minimal .site-notice__message {
            font-size: 13px;
            line-height: 1.5;
            padding: 12px 12px 0;
        }

        .site-notice.site-notice-minimal .site-notice__actions {
            margin: 0;
            padding: 8px 12px 12px;
            justify-content: flex-end;
            gap: 8px;
        }

        .site-notice.site-notice-minimal .site-notice__actions button {
            min-width: auto;
            padding: 6px 12px;
            font-size: 12px;
        }

        .site-notice.site-notice-minimal .site-notice__categories {
            padding: 12px;
            margin-top: 0;
        }

        .site-notice.site-notice-minimal .site-notice__categories .cookie-category {
            padding: 8px;
            margin-bottom: 8px;
        }

        .site-notice.site-notice-minimal .site-notice__categories .cookie-category:last-child {
            margin-bottom: 0;
        }

        .site-notice.site-notice-minimal .site-notice__categories .cookie-category__description {
            font-size: 12px;
        }

        .site-notice.site-notice-minimal .site-notice__categories .cookie-consent__save {
            padding: 8px 0 0;
            margin-top: 8px;
        }

        .site-notice.site-notice-minimal .site-notice__categories .cookie-consent__save .cookie-consent__save-button {
            font-size: 12px;
            padding: 6px 12px;
        }

        .site-notice .site-notice-body {
            padding: 8px 15px;
            border-radius: 4px;
        }

        .site-notice .site-notice__inner {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .site-notice .site-notice__message {
            margin: 0;
            line-height: 1.4;
            font-size: 14px;
            flex: 1;
            min-width: 200px;
        }

        .site-notice .site-notice__message a {
            color: inherit;
            text-decoration: underline;
        }

        .site-notice .site-notice__message a:hover {
            text-decoration: none;
        }

        /* .site-notice .site-notice__categories {
            display: none;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        } */

        .site-notice .site-notice__categories .cookie-category {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        .site-notice .site-notice__categories .cookie-category__label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        .site-notice .site-notice__categories .cookie-category__label input[type="checkbox"] {
            margin: 0;
            padding: 0;
            border: none;
            border-radius: 0;
            box-shadow: none;
            font-size: initial;
            height: initial;
            width: auto;
        }

        .site-notice .site-notice__categories .cookie-category__label input[type="checkbox"]:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .site-notice .site-notice__categories .cookie-category__name {
            font-weight: bold;
        }

        .site-notice .site-notice__categories .cookie-category__description {
            margin: 0;
            font-size: 0.9em;
            opacity: 0.8;
        }

        .site-notice .site-notice__categories .cookie-consent__save {
            margin-top: 1rem;
            padding: .75rem;
        }

        [dir="rtl"] .site-notice .site-notice__categories .cookie-consent__save {
            text-align: left;
        }

        .site-notice .site-notice__categories .cookie-consent__save .cookie-consent__save-button {
            padding: 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
            min-width: 100px;
            text-align: center;
            font-weight: bold;
        }

        .site-notice .site-notice__categories .cookie-consent__save .cookie-consent__save-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .site-notice .site-notice__categories .cookie-consent__save .cookie-consent__save-button:active {
            transform: translateY(0);
        }

        .site-notice .site-notice__actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-end;
            margin-left: auto;
        }

        [dir="rtl"] .site-notice .site-notice__actions {
            margin-left: 0;
            margin-right: auto;
        }

        .site-notice .site-notice__actions button {
            padding: 6px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 13px;
            min-width: 100px;
            text-align: center;
        }

        .site-notice .site-notice__actions button:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .site-notice .site-notice__actions button:active {
            transform: translateY(0);
        }

        .site-notice .cookie-consent__actions .site-notice__reject {
            font-weight: 500;
            opacity: 0.95;
        }

        .site-notice .cookie-consent__actions .site-notice__reject:hover {
            opacity: 1;
        }

        .site-notice .cookie-consent__actions .site-notice__customize {
            font-weight: 500;
            opacity: 0.95;
        }

        .site-notice .cookie-consent__actions .site-notice__customize:hover {
            opacity: 1;
        }

        .site-notice .cookie-consent__actions .site-notice__customize.active {
            opacity: 0.8;
            transform: translateY(0);
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .site-notice .cookie-consent__actions .site-notice__agree {
            font-weight: bold;
            position: relative;
        }

        .site-notice .cookie-consent__actions .site-notice__agree:before {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }

        @media (max-width: 767px) {
            .site-notice .site-notice__inner {
                flex-direction: column;
                align-items: stretch;
                gap: 0.75rem;
            }

            [dir="rtl"] .site-notice .site-notice__inner {
                flex-direction: column;
            }

            .site-notice .site-notice__actions {
                justify-content: center;
                margin-left: 0;
                gap: 0.4rem;
                flex-wrap: wrap;
            }

            [dir="rtl"] .site-notice .site-notice__actions {
                margin-right: 0;
            }

            .site-notice .site-notice__actions button {
                flex: none;
                min-width: 70px;
                max-width: 100px;
                padding: 6px 10px;
                font-size: 11px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                border-radius: 3px;
            }
        }

        .toastify {
            padding: 0.75rem 2rem 0.75rem 0.75rem;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow:
                0 3px 6px -1px rgba(0, 0, 0, 0.12),
                0 10px 36px -4px rgba(77, 96, 232, 0.3);
            background: -webkit-linear-gradient(315deg, #73a5ff, #5477f5);
            background: linear-gradient(135deg, #73a5ff, #5477f5);
            position: fixed;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.215, 0.61, 0.355, 1);
            border-radius: 2px;
            cursor: pointer;
            text-decoration: none;
            z-index: 999999;
            width: 25rem;
            max-width: calc(100% - 30px);
        }

        .toastify.on {
            opacity: 1;
        }

        .toastify-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .toast-close {
            background: transparent;
            border: 0;
            color: white;
            cursor: pointer;
            font-family: inherit;
            font-size: 1em;
            opacity: 0.4;
            padding: 0 5px;
            position: absolute;
            top: 0.25rem;
            inset-inline-end: 0.25rem;
        }

        .toast-close svg {
            width: 1em;
            height: 1em;
        }

        .toastify-text a {
            text-decoration: underline;
            color: #fff;
        }

        .toastify-right {
            inset-inline-end: 15px;
        }

        .toastify-left {
            inset-inline-start: 15px;
        }

        .toastify-top {
            top: -150px;
        }

        .toastify-bottom {
            bottom: -150px;
        }

        .toastify-rounded {
            border-radius: 25px;
        }

        .toastify-center {
            margin-inline-start: auto;
            margin-inline-end: auto;
            inset-inline-start: 0;
            inset-inline-end: 0;
            max-width: fit-content;
            max-width: -moz-fit-content;
        }

        @media only screen and (max-width: 360px) {

            .toastify-right,
            .toastify-left {
                margin-inline-start: auto;
                margin-inline-end: auto;
                inset-inline-start: 0;
                inset-inline-end: 0;
                max-width: fit-content;
            }
        }

        .shortcode-lazy-loading {
            position: relative;
            min-height: 12rem;
        }

        .loading-spinner {
            align-items: center;
            background: hsla(0, 0%, 100%, 0.5);
            display: flex;
            height: 100%;
            inset-inline-start: 0;
            justify-content: center;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1;

            &:after {
                animation: loading-spinner-rotation 0.5s linear infinite;
                border-color: var(--primary-color) transparent var(--primary-color) transparent;
                border-radius: 50%;
                border-style: solid;
                border-width: 1px;
                content: ' ';
                display: block;
                height: 40px;
                position: absolute;
                top: calc(50% - 20px);
                width: 40px;
                z-index: 1;
            }
        }

        @keyframes loading-spinner-rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    @include('website-layouts.header')
    @yield('content')
    @include('website-layouts.footer')

    <script src="{{ asset('/') }}js/jquery-3.7.1.min.js.download"></script>
    <script src="{{ asset('/') }}js/integrate.js.download"></script>
</body>

</html>
