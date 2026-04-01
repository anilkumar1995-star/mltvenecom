<!DOCTYPE html>
<!-- saved from url=(0027){{ url("/") }}/admin -->
<html lang="en"
    class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('/') }}assets1/img/favicon.png">
    <meta name="description" content="Copyright 2026 © Your App. Version 1.4.3">
    <meta property="og:description" content="Copyright 2026 © Your App. Version 1.4.3">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css" />

    <style>
        [v-cloak],
        [x-cloak] {
            display: none;
        }

        @media (min-width: 992px) {
            #sidebar-menu-main {
                transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                overflow: visible !important;
                position: relative;
                z-index: 1050;
                background: #1a2234 !important;
                border-right: 1px solid rgba(255, 255, 255, 0.05);
            }

            /* Compact State (navbar-minimal) */
            #sidebar-menu-main.navbar-minimal {
                width: 80px !important;
            }

            #sidebar-menu-main.navbar-minimal .nav-link-title {
                display: none !important;
            }

            #sidebar-menu-main.navbar-minimal .nav-item {
                justify-content: center;
            }

            #sidebar-menu-main.navbar-minimal .nav-link {
                justify-content: center;
                padding: 1rem 0 !important;
            }

            #sidebar-menu-main.navbar-minimal .nav-link-icon {
                margin: 0 !important;
                font-size: 1.75rem !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                width: 100% !important;
            }

            #sidebar-menu-main.navbar-minimal .nav-link-icon .icon {
                width: 32px !important;
                height: 32px !important;
            }

            /* Expanded State */
            #sidebar-menu-main:not(.navbar-minimal) {
                width: 260px !important;
            }

            #sidebar-menu-main:not(.navbar-minimal) .nav-link {
                padding: 0.75rem 1.5rem !important;
                justify-content: flex-start;
            }

            #sidebar-menu-main:not(.navbar-minimal) .nav-link-title {
                display: inline-block !important;
                margin-left: 10px;
                opacity: 1;
            }

            /* Floating tooltips (Only in minimal state) */
            #sidebar-menu-main.navbar-minimal .nav-link:not(.dropdown-toggle):hover::after {
                content: attr(data-title);
                position: absolute;
                left: 100%;
                top: 50%;
                transform: translateY(-50%);
                background: #1a2234;
                color: #fff;
                padding: 0.5rem 1rem;
                white-space: nowrap;
                border-radius: 0 4px 4px 0;
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-left: none;
                font-size: 0.875rem;
                font-weight: 500;
                box-shadow: 10px 0 20px rgba(0, 0, 0, 0.3);
                z-index: 10000;
                animation: fadeIn 0.15s ease-out;
                cursor: pointer;
            }

            /* Floating Submenu (Only in minimal state) */
            #sidebar-menu-main.navbar-minimal .nav-item.dropdown:hover > .dropdown-menu {
                display: block !important;
                position: absolute !important;
                left: 100% !important;
                top: 0 !important;
                margin-top: 0 !important;
                margin-left: -1px !important;
                min-width: 240px !important;
                background: #1a2234 !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                border-radius: 0 8px 8px 0 !important;
                box-shadow: 15px 0 30px rgba(0, 0, 0, 0.5) !important;
                padding: 0.5rem 0 !important;
                z-index: 10000;
                animation: slideInLeft 0.2s ease-out;
            }

            /* Active State Indicator */
            #sidebar-menu-main .nav-item.active > .nav-link,
            #sidebar-menu-main .nav-item:hover > .nav-link {
                color: #fff !important;
                background: rgba(255, 255, 255, 0.08) !important;
            }

            #sidebar-menu-main .nav-item.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 15%;
                bottom: 15%;
                width: 3px;
                background: #206bc4;
                border-radius: 0 4px 4px 0;
            }

            /* Submenu Styles in minimal */
            #sidebar-menu-main.navbar-minimal .dropdown-menu .dropdown-item {
                color: rgba(255, 255, 255, 0.7) !important;
                padding: 0.75rem 1.25rem !important;
                font-size: 0.875rem;
                display: flex;
                align-items: center;
                gap: 10px;
                border: none !important;
            }

            #sidebar-menu-main.navbar-minimal .dropdown-menu .dropdown-item:hover {
                color: #fff !important;
                background: rgba(255, 255, 255, 0.1) !important;
            }

            #sidebar-menu-main .dropdown-toggle::after {
                display: none !important;
            }

            @keyframes slideInLeft {
                from { opacity: 0; transform: translateX(-10px); }
                to { opacity: 1; transform: translateX(0); }
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
        }

        /* Responsive Mobile Drawer Styling */
        @media (max-width: 991px) {
            #sidebar-menu-main {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                width: 260px;
                z-index: 1060;
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                background: #1a2234 !important;
                visibility: hidden;
            }

            #sidebar-menu-main.show {
                transform: translateX(0);
                visibility: visible;
                box-shadow: 10px 0 30px rgba(0,0,0,0.5);
            }

            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1055;
                backdrop-filter: blur(2px);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-backdrop.show {
                opacity: 1;
                visibility: visible;
            }

            #sidebar-menu-main.show .navbar-collapse {
                display: block !important;
            }

            .navbar-brand img {
                max-height: 28px !important;
            }

            /* Hide desktop minimize button helper */
            .d-lg-block {
                display: none !important;
            }
            @media (min-width: 992px) {
                .d-lg-block {
                    display: block !important;
                }
            }
        }
    </style>

    <style>
        :root {
            --primary-font: "Inter";
            --primary-color: #206bc4;
            --primary-color-rgb: 32, 107, 196;
            --secondary-color: #6c7a91;
            --secondary-color-rgb: 108, 122, 145;
            --heading-color: inherit;
            --text-color: #182433;
            --text-color-rgb: 24, 36, 51;
            --link-color: #206bc4;
            --link-color-rgb: 32, 107, 196;
            --link-hover-color: #206bc4;
            --link-hover-color-rgb: 32, 107, 196;
        }
    </style>

    {{--  <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/spectrum.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/core.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('css/language.css') }}">  --}}



    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/font-awesome/css/fontawesome.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/select2/css/select2.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/css/libraries/select2.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/toastr/toastr.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/flatpickr/flatpickr.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/spectrum/spectrum.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/libraries/tagify/tagify.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/core/base/css/core.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/plugins/language/css/language.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/plugins/ecommerce/css/ecommerce.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/packages/slug/css/slug.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/packages/shortcode/css/shortcode.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/packages/seo-helper/css/seo-helper.css?v=1.4.4') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('vendor/core/plugins/faq/css/faq.css?v=1.4.4') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vue.global.min.js') }}"></script>
    <script src="{{ asset('js/vue-app.js') }}"></script>
    
    <script src="{{ asset('vendor/core/core/base/libraries/jquery.min.js?v=1.4.4') }}"></script>
    {{-- <script src="{{ asset('vendor/core/core/base/libraries/jquery-compat/jquery4-compat.js?v=1.4.4') }}"></script> --}}
    <script src="{{ asset('vendor/core/core/base/js/app.js?v=1.4.4') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
   <script>
        $(document).ready(function() {

    // Start NProgress & show loader instantly
    NProgress.start();
    $('#page-loader').fadeIn(50); // show spinner fast

    // Page ready → hide loader after short delay
    setTimeout(() => {
        NProgress.done();
        $('#page-loader').fadeOut(150); // smooth fade
    }, 500); // 0.5s wait, spinner visible

    // AJAX handling
    $(document).ajaxStart(function () {
        NProgress.start();
        $('#page-loader').fadeIn(100);
    });

    $(document).ajaxStop(function () {
        NProgress.done();
        $('#page-loader').fadeOut(150);
    });

});

    </script>


    <script>
        window.BotbleVariables = {
            languages: {
                notices_msg: 'Success!',
                error_msg: 'Error!',
            }
        };
        window.Botble = {
            showNotice: function(type, message) {
                if (typeof notify !== 'undefined') {
                    notify(message, type);
                } else if (typeof toastr !== 'undefined') {
                    toastr[type](message);
                } else {
                    console.log(type + ': ' + message);
                }
            }
        };
        window.route = function(name) {
            console.warn('Legacy script called route("' + name + '") which is not defined.');
            return '#';
        };

        // Fix accessibility warning: Blocked aria-hidden on an element because its descendant retained focus.
        $(document).ready(function() {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === "attributes" && mutation.attributeName === "aria-hidden") {
                        if ($('#app').attr('aria-hidden') === 'true') {
                            $('#app').removeAttr('aria-hidden');
                        }
                    }
                });
            });
            const appEl = document.getElementById('app');
            if (appEl) {
                observer.observe(appEl, { attributes: true });
            }
        });
    </script>

    <style>
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: var(--primary-color, #206bc4);
            position: fixed;
            z-index: 10310;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
        }

        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px var(--primary-color, #206bc4), 0 0 5px var(--primary-color, #206bc4);
            opacity: 1.0;
            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 10310;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;
            border: solid 2px transparent;
            border-top-color: var(--primary-color, #206bc4);
            border-left-color: var(--primary-color, #206bc4);
            border-radius: 50%;
            -webkit-animation: nprogress-spinner 400ms linear infinite;
            animation: nprogress-spinner 400ms linear infinite;
        }

        .nprogress-custom-parent {
            overflow: hidden;
            position: relative;
        }

        .nprogress-custom-parent #nprogress .spinner,
        .nprogress-custom-parent #nprogress .bar {
            position: absolute;
        }

        @-webkit-keyframes nprogress-spinner {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        @keyframes nprogress-spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Global Page Loader Overlay */
        #page-loader {
            position: fixed;
            inset: 0; /* top:0; left:0; right:0; bottom:0 */
            background: rgba(0, 0, 0, 0.0); /* fully transparent */
            z-index: 99999;
            display: flex; /* flex for centering spinner */
            align-items: center;
            justify-content: center;
            pointer-events: none; /* page interactable even loader shows */
        }

        .loader-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(var(--primary-color-rgb, 32,107,196), 0.2); /* light border */
            border-top-color: var(--primary-color, #206bc4); /* colored spinner */
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }

    </style>
    <style>
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
    </style>
    <style class="fslightbox-styles">
        .fslightbox-absoluted {
            position: absolute;
            top: 0;
            left: 0
        }

        .fslightbox-fade-in {
            animation: fslightbox-fade-in .3s cubic-bezier(0, 0, .7, 1)
        }

        .fslightbox-fade-out {
            animation: fslightbox-fade-out .3s ease
        }

        .fslightbox-fade-in-strong {
            animation: fslightbox-fade-in-strong .3s cubic-bezier(0, 0, .7, 1)
        }

        .fslightbox-fade-out-strong {
            animation: fslightbox-fade-out-strong .3s ease
        }

        @keyframes fslightbox-fade-in {
            from {
                opacity: .65
            }

            to {
                opacity: 1
            }
        }

        @keyframes fslightbox-fade-out {
            from {
                opacity: .35
            }

            to {
                opacity: 0
            }
        }

        @keyframes fslightbox-fade-in-strong {
            from {
                opacity: .3
            }

            to {
                opacity: 1
            }
        }

        @keyframes fslightbox-fade-out-strong {
            from {
                opacity: 1
            }

            to {
                opacity: 0
            }
        }

        .fslightbox-cursor-grabbing {
            cursor: grabbing
        }

        .fslightbox-full-dimension {
            width: 100%;
            height: 100%
        }

        .fslightbox-open {
            overflow: hidden;
            height: 100%
        }

        .fslightbox-flex-centered {
            display: flex;
            justify-content: center;
            align-items: center
        }

        .fslightbox-opacity-0 {
            opacity: 0 !important
        }

        .fslightbox-opacity-1 {
            opacity: 1 !important
        }

        .fslightbox-scrollbarfix {
            padding-right: 17px
        }

        .fslightbox-transform-transition {
            transition: transform .3s
        }

        .fslightbox-container {
            font-family: Arial, sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(rgba(30, 30, 30, .9), #000 1810%);
            touch-action: pinch-zoom;
            z-index: 1000000000;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent
        }

        .fslightbox-container * {
            box-sizing: border-box
        }

        .fslightbox-svg-path {
            transition: fill .15s ease;
            fill: #ddd
        }

        .fslightbox-nav {
            height: 45px;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0
        }

        .fslightbox-slide-number-container {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 100%;
            font-size: 15px;
            color: #d7d7d7;
            z-index: 0;
            max-width: 55px;
            text-align: left
        }

        .fslightbox-slide-number-container .fslightbox-flex-centered {
            height: 100%
        }

        .fslightbox-slash {
            display: block;
            margin: 0 5px;
            width: 1px;
            height: 12px;
            transform: rotate(15deg);
            background: #fff
        }

        .fslightbox-toolbar {
            position: absolute;
            z-index: 3;
            right: 0;
            top: 0;
            height: 100%;
            display: flex;
            background: rgba(35, 35, 35, .65)
        }

        .fslightbox-toolbar-button {
            height: 100%;
            width: 45px;
            cursor: pointer
        }

        .fslightbox-toolbar-button:hover .fslightbox-svg-path {
            fill: #fff
        }

        .fslightbox-slide-btn-container {
            display: flex;
            align-items: center;
            padding: 12px 12px 12px 6px;
            position: absolute;
            top: 50%;
            cursor: pointer;
            z-index: 3;
            transform: translateY(-50%)
        }

        @media (min-width:476px) {
            .fslightbox-slide-btn-container {
                padding: 22px 22px 22px 6px
            }
        }

        @media (min-width:768px) {
            .fslightbox-slide-btn-container {
                padding: 30px 30px 30px 6px
            }
        }

        .fslightbox-slide-btn-container:hover .fslightbox-svg-path {
            fill: #f1f1f1
        }

        .fslightbox-slide-btn {
            padding: 9px;
            font-size: 26px;
            background: rgba(35, 35, 35, .65)
        }

        @media (min-width:768px) {
            .fslightbox-slide-btn {
                padding: 10px
            }
        }

        @media (min-width:1600px) {
            .fslightbox-slide-btn {
                padding: 11px
            }
        }

        .fslightbox-slide-btn-container-previous {
            left: 0
        }

        @media (max-width:475.99px) {
            .fslightbox-slide-btn-container-previous {
                padding-left: 3px
            }
        }

        .fslightbox-slide-btn-container-next {
            right: 0;
            padding-left: 12px;
            padding-right: 3px
        }

        @media (min-width:476px) {
            .fslightbox-slide-btn-container-next {
                padding-left: 22px
            }
        }

        @media (min-width:768px) {
            .fslightbox-slide-btn-container-next {
                padding-left: 30px
            }
        }

        @media (min-width:476px) {
            .fslightbox-slide-btn-container-next {
                padding-right: 6px
            }
        }

        .fslightbox-down-event-detector {
            position: absolute;
            z-index: 1
        }

        .fslightbox-slide-swiping-hoverer {
            z-index: 4
        }

        .fslightbox-invalid-file-wrapper {
            font-size: 22px;
            color: #eaebeb;
            margin: auto
        }

        .fslightbox-video {
            object-fit: cover
        }

        .fslightbox-youtube-iframe {
            border: 0
        }

        .fslightboxl {
            display: block;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 67px;
            height: 67px
        }

        .fslightboxl div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 54px;
            height: 54px;
            margin: 6px;
            border: 5px solid;
            border-color: #999 transparent transparent transparent;
            border-radius: 50%;
            animation: fslightboxl 1.2s cubic-bezier(.5, 0, .5, 1) infinite
        }

        .fslightboxl div:nth-child(1) {
            animation-delay: -.45s
        }

        .fslightboxl div:nth-child(2) {
            animation-delay: -.3s
        }

        .fslightboxl div:nth-child(3) {
            animation-delay: -.15s
        }

        @keyframes fslightboxl {
            0% {
                transform: rotate(0)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        .fslightbox-source {
            position: relative;
            z-index: 2;
            opacity: 0
        }
    </style>
</head>

<body class="antialiased" style="">
    <div id="page-loader">
        <div class="loader-spinner"></div>
    </div>

    <div class="wrapper">
        @include('vendor-layouts.header')

        <div class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
            </div>
        </div>

        <div class="page-wrapper">
            <div class="d-flex flex-row" style="min-height: calc(100vh - 3.5rem);">
                @include('vendor-layouts.sidebar')

                <div class="d-flex flex-column flex-fill" style="min-width: 0; overflow: auto;">
                    @yield('content')
                    @include('vendor-layouts.footer')
                </div>
            </div>
        </div>
    </div>

    </div> {{-- Closes #app from header --}}


    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('vendor/core/core/base/js/core-ui.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/excanvas.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/ie8.fix.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/modernizr/modernizr.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/select2/js/select2.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/flatpickr/flatpickr.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/jquery-cookie/jquery.cookie.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/js/core.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/toastr/toastr.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/stickytableheaders/jquery.stickytableheaders.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/jquery-waypoints/jquery.waypoints.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/spectrum/spectrum.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/fslightbox.js?v=1.4.4') }}"></script>
    <script src="{{ asset('js/sortable.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/moment-with-locales.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/jquery-inputmask/jquery.inputmask.bundle.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/jquery-ui/jquery-ui.min.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/tagify/tagify.js?v=1.4.4') }}"></script>
    
    {{-- Dependencies for js-validation --}}
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/additional-methods.min.js"></script>
    <script src="{{ asset('vendor/core/core/js-validation/js/js-validation.js?v=1.4.4') }}"></script>

    <script src="{{ asset('vendor/core/core/base/libraries/jquery.are-you-sure/jquery.are-you-sure.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/plugins/language/js/language-global.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/plugins/ecommerce/js/edit-product.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/js/tags.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/packages/slug/js/slug.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/libraries/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/core/core/base/js/editor.js') }}"></script>
    <script src="{{ asset('vendor/core/packages/shortcode/js/shortcode.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/core/base/js/repeater-field.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/packages/seo-helper/js/seo-helper.js?v=1.4.4') }}"></script>
    <script src="{{ asset('vendor/core/plugins/faq/js/faq.js?v=1.4.4') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/global-search.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    {{-- DataTables moved up to ensure it is available --}}
    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "processing": true,
                "language": {
                    "processing": '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>'
                }
            });

            @if (session('success'))
                Botble.showNotice('success', "{{ session('success') }}");
            @endif

            @if (session('error'))
                Botble.showNotice('error', "{{ session('error') }}");
            @endif

            @if (session('status'))
                Botble.showNotice('success', "{{ session('status') }}");
            @endif
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
                autotimeout: 4000,
                gap: 20,
                distance: 15,
                type: 1,
                position: 'right top'
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            var $menuItemsCount = $('.menu-item-count');
            if ($menuItemsCount.length > 0) {
                var url = $menuItemsCount.first().data('url');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $.each(response, function(key, value) {
                            var $badge = $('.' + key);
                            if ($badge.length > 0 && value > 0) {
                                $badge.text(value).show();
                            } else {
                                $badge.hide();
                            }
                        });
                    }
                });
            }
        });
    </script>
    <script src="{{ asset('js/admin-ajax.js') }}"></script>
    @stack('scripts')
@auth
    <script>
        (function() {
            let inactivityTime = function() {
                let time;
                // Get session lifetime from PHP and convert to milliseconds
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
    {{-- Sidebar Persistence Script --}}
    <script>
        $(document).ready(function() {
            const sidebar = $('#sidebar-menu-main');
            const toggleBtn = $('[data-bb-toggle="navbar-minimal"]');
            
            // Listener to Save State on toggle
            toggleBtn.on('click', function() {
                setTimeout(() => {
                    const currentState = sidebar.hasClass('navbar-minimal');
                    localStorage.setItem('vendor_sidebar_minimal', currentState);
                }, 50);
            });

            // Mobile Sidebar Toggle
            const mobileToggle = $('#mobile-sidebar-toggle');
            
            // Create Backdrop if it doesn't exist
            if ($('.sidebar-backdrop').length === 0) {
                $('body').append('<div class="sidebar-backdrop"></div>');
            }
            const backdrop = $('.sidebar-backdrop');

            mobileToggle.on('click', function(e) {
                e.preventDefault();
                sidebar.toggleClass('show');
                backdrop.toggleClass('show');
                $('body').toggleClass('overflow-hidden');
            });

            backdrop.on('click', function() {
                sidebar.removeClass('show');
                backdrop.removeClass('show');
                $('body').removeClass('overflow-hidden');
            });

            // Close sidebar when clicking on a link (on mobile)
            sidebar.find('.nav-link:not(.dropdown-toggle)').on('click', function() {
                if ($(window).width() < 992) {
                    sidebar.removeClass('show');
                    backdrop.removeClass('show');
                    $('body').removeClass('overflow-hidden');
                }
            });
        });
    </script>
</body>

</html>

