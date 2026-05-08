<div id="app" data-v-app="">
    <header class="navbar navbar-expand-md sticky-top d-none d-lg-flex d-print-none" style="z-index: 1040 !important; background: #182433 !important;" data-bs-theme="dark">
        <div class="container-fluid"><button class="navbar-toggler d-none d-lg-block me-2 ms-n1" type="button"
                data-bb-toggle="navbar-minimal" data-bb-target="#sidebar-menu-main" aria-controls="navbar-menu"
                aria-expanded="false" aria-label="Toggle navigation"
                data-url="{{ url("/") }}/admin/system/users/profile/1/preferences" data-method="PATCH">
                <svg class="icon svg-icon-ti-ti-menu-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M4 6l16 0"></path>
                    <path d="M4 12l16 0"></path>
                    <path d="M4 18l16 0"></path>
                </svg></button>
            <h1 class="navbar-brand navbar-brand-autodark me-4">
                <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('/') }}js/logo-white.png" alt="Your App"
                        class="navbar-brand-image" style="max-height: 32px; height: auto;"></a>
            </h1>
            <div class="flex-row navbar-nav order-md-last">
                <div class="d-flex align-items-center me-3">
                    <div class="">
                        <label class="form-label sr-only" for="global-search-input"> Search </label>
                        <div class="input-group input-group-flat">
                            <input class="form-control" type="text" name="keyword" id="global-search-input"
                                placeholder="Search" tabindex="0" data-bb-toggle="gs-navbar-input" autocomplete="off">
                            <div class="input-group-text"><kbd>ctrl/cmd + k</kbd></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center me-3"><a class="btn" type="button"
                        href="{{ url("/") }}/" target="_blank">
                        <svg class="icon icon-left svg-icon-ti-ti-world" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M3.6 9h16.8"></path>
                            <path d="M3.6 15h16.8"></path>
                            <path d="M11.5 3a17 17 0 0 0 0 18"></path>
                            <path d="M12.5 3a17 17 0 0 1 0 18"></path>
                        </svg> View website </a></div>
                <div class="d-none d-md-flex me-2"><a href="{{ url("/") }}/admin/toggle-theme-mode?theme=dark"
                        class="px-0 nav-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
                        aria-label="Enable dark mode" data-bs-original-title="Enable dark mode"><svg
                            class="icon svg-icon-ti-ti-moon" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z">
                            </path>
                        </svg></a>
                    <div class="nav-item d-none d-md-flex me-2"><a class="px-0 nav-link" data-bs-toggle="offcanvas"
                            href="{{ url("/") }}/admin#notification-sidebar" role="button"
                            aria-controls="notification-sidebar"><svg class="icon svg-icon-ti-ti-bell"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                                </path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg> <span class="badge bg-blue text-blue-fg badge-pill marketplace-notifications-count menu-item-count" data-url="{{ route('admin.menu-items-count') }}">0</span>
                        </a></div>
                        <div class="nav-item d-none d-md-flex me-2">
                            <a href="{{ url('/') }}/admin/contacts" 
                            class="nav-link px-0"
                            aria-label="Open contacts">
                                <svg class="icon svg-icon-ti-ti-mail" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                <path d="M3 7l9 6l9 -6"></path>
                            </svg>

                            <span class="badge bg-red text-red-fg badge-pill unread-contacts menu-item-count">
                                0
                            </span>
                        </a>
                    </div>
                </div>
                <div class="dropdown nav-item">
                    <a href="#" class="p-0 nav-link d-flex lh-1 text-reset" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url('{{ Auth::user()->avatar ? \App\Helpers\ImageHelper::getImageUrl() . Auth::user()->avatar : asset('avatars/no_user.webp') }}');"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="mt-1 small text-muted">{{ Auth::user()->email }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                            <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg> 
                            Profile 
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg class="icon dropdown-item-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M9 12h12l-3 -3"></path><path d="M18 15l3 -3"></path></svg> 
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu"></div>
        </div>
    </header>

