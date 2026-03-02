@extends('frontend.layouts.app')

@section('title', 'Downloads')

@section('content')
  <main>
        <div class="bb-customer-page crop-avatar">
            <div class="container">
                <div class="customer-body">
                    <div class="d-lg-none bg-white border-bottom p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wrapper-image page_speed_3267104">
                                    <img class="rounded-circle img-fluid" style="width:40px;height:40px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $customer->name ?? 'User' }}</div>
                                    <div class="text-muted small">Account Dashboard</div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#customerSidebar" aria-controls="customerSidebar">
                                <svg class="icon icon-sm" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l16 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row g-0">
                        {{-- Desktop Sidebar --}}
                        <div class="col-lg-3 col-xl-3 d-none d-lg-block">
                            <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                                <div class="bb-customer-sidebar flex-1">
                                    <div class="bb-customer-sidebar-heading">
                                        <div class="d-flex align-items-center gap-3 p-4">
                                            <div class="position-relative">
                                                <div class="wrapper-image">
                                                    <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                                </div>
                                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                                <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('frontend.customer.sidebar', ['active' => 'downloads'])
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4">
                                    <h1 class="bb-profile-header-title h3 mb-0"> Downloads </h1>
                                </div>
                                <div class="bb-profile-main">
                                    <div class="card border-0 shadow-sm rounded-3">
                                        <div class="card-body p-4 p-md-5 text-center">
                                            <div class="mb-4">
                                                <svg class="icon text-muted" style="width: 64px; height: 64px;" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                    <path d="M7 11l5 5l5 -5" />
                                                    <path d="M12 4l0 12" />
                                                </svg>
                                            </div>
                                            <h4 class="fw-semibold text-dark">No downloads found</h4>
                                            <p class="text-muted mb-4">You do not have any digital products to download.</p>
                                            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary px-4">
                                                Start shopping now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Mobile Sidebar Offcanvas --}}
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="customerSidebar" aria-labelledby="customerSidebarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="customerSidebarLabel">Account Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                        <div class="bb-customer-sidebar flex-1">
                            <div class="bb-customer-sidebar-heading">
                                <div class="d-flex align-items-center gap-3 p-4">
                                    <div class="position-relative">
                                        <div class="wrapper-image">
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                        <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.customer.sidebar', ['active' => 'downloads'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </main>
@endsection
