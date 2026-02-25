<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Checkout - Shofy')</title>
    
    <!-- Fonts and Core CSS -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss'])
    
    <!-- Essential CSS Only -->
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home-dashboard-files/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/fontawesome.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}home-dashboard-files/theme.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/core.css">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('/') }}css/main.css">
    
    <style>
        body { background-color: #f5f5f5; font-family: 'Jost', sans-serif; }
        .checkout-header { background: #fff; padding: 20px 0; border-bottom: 1px solid #e5e5e5; }
        .checkout-logo { max-height: 40px; }
        .checkout-content { padding: 40px 0; }
        .checkout-footer { text-align: center; padding: 20px 0; font-size: 12px; color: #999; border-top: 1px solid #e5e5e5; margin-top: 40px;}
        
        /* Shofy Specific overrides */
        :root { --primary-color: #678E61; }
    </style>
    @stack('styles')
</head>
<body>
    
    <!-- Minimal Header -->
    <header class="checkout-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                     <a href="{{ route('frontend.home') }}">
                        <img src="{{ asset('storage/main/general/logo.png') }}" alt="Shofy" class="checkout-logo">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="checkout-content">
        @yield('content')
    </div>

    <!-- Minimal Footer -->
    <footer class="checkout-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Shofy. All rights reserved.</p>
        </div>
    </footer>

    <!-- Essential Scripts -->
    <script src="{{ asset('/') }}home-dashboard-files/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('/') }}home-dashboard-files/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}home-dashboard-files/theme.js"></script>
    @stack('scripts')
</body>
</html>
