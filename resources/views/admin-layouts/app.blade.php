<!DOCTYPE html>
<!-- saved from url=(0027)http://127.0.0.1:8000/admin -->
<html lang="en"
    class="js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="http://127.0.0.1:8000/storage/main/general/favicon.png" rel="icon shortcut" type="image/x-icon">
    <meta property="og:image" content="http://127.0.0.1:8000/storage/main/general/favicon.png">

    <meta name="description" content="Copyright 2026 © Your App. Version 1.4.3">
    <meta property="og:description" content="Copyright 2026 © Your App. Version 1.4.3">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/css/tree-category.css?v=1.4.4">


    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/font-awesome/css/fontawesome.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/select2/css/select2.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/css/libraries/select2.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/toastr/toastr.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/mcustom-scrollbar/jquery.mCustomScrollbar.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/flatpickr/flatpickr.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/spectrum/spectrum.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/fancybox/jquery.fancybox.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery-nestable/jquery.nestable.min.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/css/core.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/plugins/language/css/language.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/core/base/css/tree-category.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/packages/slug/css/slug.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/packages/shortcode/css/shortcode.css?v=1.4.4">
    <link media="all" type="text/css" rel="stylesheet"
        href="https://shofy-grocery.botble.com/vendor/core/packages/seo-helper/css/seo-helper.css?v=1.4.4">
        <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css">


    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery.min.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/jquery-compat/jquery4-compat.js?v=1.4.4">
    </script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/app.js?v=1.4.4"></script>



    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.6/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <style>
        [v-cloak],
        [x-cloak] {
            display: none;
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

    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/fontawesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/select2.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/select2.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/toastr.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/jquery.mCustomScrollbar.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/flatpickr.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/spectrum.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/jquery.fancybox.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/core.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/language.css">
    <script src="{{ asset('/') }}js/jquery.min.js.download"></script>
    <script src="{{ asset('/') }}js/app.js.download"></script>
    <script src="{{ asset('/') }}js/vue.global.min.js.download"></script>
    <script src="{{ asset('/') }}js/vue-app.js.download"></script>

    <style>
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: #007bff;

            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;

            width: 100%;
            height: 2px;
        }

        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px #007bff, 0 0 5px #007bff;
            opacity: 1.0;

            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 1031;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;

            border: solid 2px transparent;
            border-top-color: #007bff;
            border-left-color: #007bff;
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
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes nprogress-spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <style>
        #nprogress {
            pointer-events: none;
        }

        #nprogress .bar {
            background: var(--bb-primary);

            position: fixed;
            z-index: 1031;
            top: 0;
            left: 0;

            width: 100%;
            height: 2px;
        }

        #nprogress .peg {
            display: block;
            position: absolute;
            right: 0px;
            width: 100px;
            height: 100%;
            box-shadow: 0 0 10px var(--bb-primary), 0 0 5px var(--bb-primary);
            opacity: 1.0;

            -webkit-transform: rotate(3deg) translate(0px, -4px);
            -ms-transform: rotate(3deg) translate(0px, -4px);
            transform: rotate(3deg) translate(0px, -4px);
        }

        #nprogress .spinner {
            display: block;
            position: fixed;
            z-index: 1031;
            top: 15px;
            right: 15px;
        }

        #nprogress .spinner-icon {
            width: 18px;
            height: 18px;
            box-sizing: border-box;

            border: solid 2px transparent;
            border-top-color: var(--bb-primary);
            border-left-color: var(--bb-primary);
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
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes nprogress-spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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

<body class="page-sidebar-closed-hide-logo page-content-white page-container-bg-solid " style="">



    @include('admin-layouts.header')
    @include('admin-layouts.sidebar')
    @yield('content')
    @include('admin-layouts.footer')

    <script src="{{ asset('/') }}js/notification.js.download"></script>
    <script src="{{ asset('/') }}js/core-ui.js.download"></script>
    <script src="{{ asset('/') }}js/excanvas.min.js.download"></script>
    <script src="{{ asset('/') }}js/ie8.fix.min.js.download"></script>
    <script src="{{ asset('/') }}js/modernizr.min.js.download"></script>
    <script src="{{ asset('/') }}js/select2.min.js.download"></script>
    <script src="{{ asset('/') }}js/flatpickr.min.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.cookie.js.download"></script>
    <script src="{{ asset('/') }}js/core.js.download"></script>
    <script src="{{ asset('/') }}js/toastr.min.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.mCustomScrollbar.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.stickytableheaders.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.waypoints.min.js.download"></script>
    <script src="{{ asset('/') }}js/spectrum.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.fancybox.min.js.download"></script>
    <script src="{{ asset('/') }}js/fslightbox.js.download"></script>
    <script src="{{ asset('/') }}js/sortable.min.js.download"></script>
    <script src="{{ asset('/') }}js/jquery.counterup.min.js.download"></script>
    <script src="{{ asset('/') }}js/language-global.js.download"></script>
    <script src="{{ asset('/') }}js/dashboard.js.download"></script>
    <script src="{{ asset('/') }}js/check-for-updates.js.download"></script>
    <script src="{{ asset('/') }}js/blog.js.download"></script>
    <script src="{{ asset('/') }}js/audit-log.js.download"></script>
    <script src="{{ asset('/') }}js/request-log.js.download"></script>
    <script src="{{ asset('/') }}js/dashboard-widgets.js.download"></script>
    <script src="{{ asset('/') }}js/global-search.js.download"></script>
    <script src="{{ asset('/') }}js/license-activation.js.download"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/packages/slug/js/slug.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/packages/shortcode/js/shortcode.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/libraries/ckeditor/ckeditor.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/core/base/js/editor.js?v=1.4.4"></script>
    <script src="https://shofy-grocery.botble.com/vendor/core/packages/seo-helper/js/seo-helper.js?v=1.4.4"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/additional-methods.min.js"></script>


    <script src="https://cdn.datatables.net/2.3.6/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
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
    </script>
    @stack('scripts')
</body>

</html>
