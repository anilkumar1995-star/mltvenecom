<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/sass/admin.scss', 'resources/js/app.js'])
</head>
<body class="admin-app">
    <div class="admin-wrapper d-flex">
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="brand d-flex align-items-center">
                <button class="btn btn-ghost" id="sidebarCompactToggle" aria-label="Toggle sidebar"><i class="fas fa-bars"></i></button>
            </div>

            <nav class="admin-nav-rail" role="navigation">
                @if(!empty($adminNav) && is_array($adminNav))
                    @foreach($adminNav as $item)
                        @php $hasChildren = isset($item['children']) && is_array($item['children']) && count($item['children']) > 0; @endphp
                        <div class="rail-block">
                            @php
                                $icon = 'fa-box';
                                switch($item['title']) {
                                    case 'Dashboard': $icon = 'fa-home'; break;
                                    case 'Ecommerce': $icon = 'fa-shopping-bag'; break;
                                    case 'Products': $icon = 'fa-box'; break;
                                    case 'Pages': $icon = 'fa-file-alt'; break;
                                    case 'Blog': $icon = 'fa-blog'; break;
                                    case 'Settings': $icon = 'fa-cog'; break;
                                }
                            @endphp
                            <a href="{{ $hasChildren ? '#' : $item['url'] }}" class="rail-item {{ $hasChildren ? 'has-children' : '' }} {{ url()->current() === $item['url'] ? 'active' : '' }}" data-url="{{ $item['url'] }}">
                                <span class="rail-icon"><i class="fas {{ $icon }}"></i></span>
                                <span class="rail-label">{{ $item['title'] }}</span>
                                @if($hasChildren)
                                    <span class="rail-caret"><i class="fas fa-chevron-down"></i></span>
                                @endif
                            </a>

                            @if($hasChildren)
                                <div class="submenu">
                                    @foreach($item['children'] as $child)
                                        <a href="{{ $child['url'] }}" class="submenu-item {{ url()->current() === $child['url'] ? 'active' : '' }}">
                                            <span class="submenu-icon"><i class="fas fa-angle-right"></i></span>
                                            <span class="submenu-label">{{ $child['title'] }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </nav>
        </aside>

        <div class="admin-main flex-grow-1">
            <header class="admin-topbar d-flex align-items-center px-3">
                <div class="topbar-left d-flex align-items-center">
                    <button class="btn btn-ghost me-3" id="sidebarToggle">☰</button>
                    <a class="brand d-flex align-items-center me-3 text-decoration-none" href="#">
                            <img src="{{ asset('images/logo.svg') }}" alt="logo" style="height:30px; width:auto; margin-right:8px;" onerror="this.style.display='none'"/>
                    </a>
                </div>

                <div class="topbar-center flex-grow-1 d-flex justify-content-center">
                    <div class="search-box w-50">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control rounded-pill" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm rounded-pill ms-2" type="button">ctrl/cmd + k</button>
                        </div>
                    </div>
                </div>

                <div class="topbar-right d-flex align-items-center gap-2">
                    <a class="btn btn-sm btn-outline-light me-2" href="/" target="_blank">View website</a>

                    <button id="themeToggle" class="btn btn-ghost icon-btn" title="Toggle theme">🌙</button>
                    <div class="position-relative">
                        <button id="notifBtn" class="btn btn-ghost position-relative" title="Notifications">
                            🔔
                            <span class="badge-notify">0</span>
                        </button>
                        <div id="notifPanel" class="dropdown-panel d-none">
                            <div class="p-2">No notifications</div>
                        </div>
                    </div>
                    <div class="position-relative">
                        <button id="msgBtn" class="btn btn-ghost position-relative" title="Messages">
                            ✉️
                            <span class="badge-notify">5</span>
                        </button>
                        <div id="msgPanel" class="dropdown-panel d-none">
                            <div class="p-2">No messages</div>
                        </div>
                    </div>

                    @auth
                        <div class="d-flex align-items-center ms-2 admin-user">
                            <img src="{{ Auth::user()->avatar ?? ('https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?s=40&d=identicon') }}" alt="avatar" class="rounded-circle" style="width:40px;height:40px;object-fit:cover;">
                            <div class="ms-2 d-none d-md-block text-white small">
                                <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                <div class="text-muted small">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-light">Login</a>
                    @endauth
                </div>
            </header>

            <main class="admin-content p-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
