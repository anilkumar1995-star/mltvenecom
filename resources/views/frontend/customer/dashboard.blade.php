@extends('frontend.layouts.app')

@section('title', 'Dashboard')

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
                                    @include('frontend.customer.sidebar', ['active' => 'dashboard'])
                                </div>
                            </div>
                        </div>

                        {{-- Main Content --}}
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4">
                                    <h1 class="bb-profile-header-title h3 mb-0">Overview</h1>
                                </div>
                                <div class="bb-profile-main">
                                    {{-- Welcome Section --}}
                                    <div class="bb-customer-profile mb-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="bb-customer-profile-avatar" style="width:80px;height:80px;border-radius:50%;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10z"/>
                                                        <path d="M20 21a8 8 0 0 0-16 0"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="bb-customer-profile-info">
                                                    <h2 class="h4 mb-2">Welcome back, <strong>{{ $customer->name ?? 'User' }}</strong>!</h2>
                                                    <p class="text-muted mb-0">Manage your account, view orders, and update your preferences from your personal dashboard.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Stats Row --}}
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center gap-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(13,110,253,0.1);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304"/>
                                                            <path d="M9 11v-5a3 3 0 0 1 6 0v5"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-muted small">Total Orders</div>
                                                        <div class="fw-bold h4 mb-0">{{ $total_orders ?? 0 }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center gap-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(25,135,84,0.1);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M6 3h12" />
                                                            <path d="M6 8h12" />
                                                            <path d="m6 13 8.5 8" />
                                                            <path d="M6 13h3" />
                                                            <path d="M9 13c6.667 0 6.667-10 0-10" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-muted small">Total Spent</div>
                                                        <div class="fw-bold h4 mb-0">₹{{ number_format($total_spent ?? 0, 2) }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-0 shadow-sm h-100">
                                                <div class="card-body d-flex align-items-center gap-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:rgba(255,193,7,0.1);">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <div class="text-muted small">Addresses</div>
                                                        <div class="fw-bold h4 mb-0">{{ $total_addresses ?? 0 }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Quick Action Cards --}}
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-4">
                                            <div class="card h-100 border-0 bg-primary bg-opacity-10">
                                                <div class="card-body text-center py-4">
                                                    <div class="bg-primary bg-opacity-25 rounded-circle p-3 d-inline-flex mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304"/>
                                                            <path d="M9 11v-5a3 3 0 0 1 6 0v5"/>
                                                        </svg>
                                                    </div>
                                                    <h5 class="card-title h6 mb-2">View Orders</h5>
                                                    <p class="card-text text-muted small mb-3">Track your recent orders and order history</p>
                                                    <a href="{{ route('frontend.customer.orders') }}" class="btn btn-primary btn-sm">View Orders →</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card h-100 border-0 bg-success bg-opacity-10">
                                                <div class="card-body text-center py-4">
                                                    <div class="bg-success bg-opacity-25 rounded-circle p-3 d-inline-flex mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0"/>
                                                        </svg>
                                                    </div>
                                                    <h5 class="card-title h6 mb-2">Manage Addresses</h5>
                                                    <p class="card-text text-muted small mb-3">Update your shipping and billing addresses</p>
                                                    <a href="{{ route('frontend.customer.addresses') }}" class="btn btn-success btn-sm">Manage Addresses →</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card h-100 border-0 bg-warning bg-opacity-10">
                                                <div class="card-body text-center py-4">
                                                    <div class="bg-warning bg-opacity-25 rounded-circle p-3 d-inline-flex mb-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065"/>
                                                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"/>
                                                        </svg>
                                                    </div>
                                                    <h5 class="card-title h6 mb-2">Account Settings</h5>
                                                    <p class="card-text text-muted small mb-3">Edit your profile and account details</p>
                                                    <a href="{{ route('frontend.customer.profile') }}" class="btn btn-warning btn-sm">Edit Account →</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Recent Orders --}}
                                    @if(isset($total_orders) && $total_orders > 0)
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                                            <h5 class="mb-0">Recent Orders</h5>
                                            <a href="{{ route('frontend.customer.orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-nowrap align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="ps-4">Order ID</th>
                                                            <th>Date</th>
                                                            <th>Items</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th class="pe-4">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($recent_orders as $order)
                                                        <tr>
                                                            <td class="ps-4"><strong>#{{ $order->id }}</strong></td>
                                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                                            <td>{{ $order->items ? $order->items->count() : 0 }} items</td>
                                                            <td><strong>₹{{ number_format($order->amount, 2) }}</strong></td>
                                                            <td>
                                                                @php
                                                                    $statusColors = [
                                                                        'completed' => 'success',
                                                                        'delivered' => 'success',
                                                                        'pending' => 'warning',
                                                                        'processing' => 'info',
                                                                        'cancelled' => 'danger',
                                                                    ];
                                                                    $color = $statusColors[$order->status] ?? 'secondary';
                                                                @endphp
                                                                <span class="badge bg-{{ $color }}">{{ ucfirst($order->status) }}</span>
                                                            </td>
                                                            <td class="pe-4">
                                                                <a href="{{ route('frontend.customer.orders.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                                        <circle cx="12" cy="12" r="3"/>
                                                                    </svg> View
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="card border-0 shadow-sm bg-light">
                                        <div class="card-body py-5">
                                            <div class="row align-items-center">
                                                <div class="col-12 col-md-auto text-center mb-3 mb-md-0">
                                                    <span class="bg-info bg-opacity-20 rounded-circle p-3 d-inline-block">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0dcaf0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M4 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                                            <path d="M15 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                                                            <path d="M17 17h-11v-14h-2"/>
                                                            <path d="M6 5l14 1l-1 7h-13"/>
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="col-12 col-md text-center text-md-start">
                                                    <h5 class="card-title h6 mb-1">Ready to start shopping?</h5>
                                                    <p class="card-text text-muted small mb-3 mb-md-0">You haven't placed any orders yet. Browse our products and find something you love!</p>
                                                </div>
                                                <div class="col-12 col-md-auto text-center">
                                                    <a href="{{ route('frontend.products.index') }}" class="btn btn-info">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1">
                                                            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304"/>
                                                            <path d="M9 11v-5a3 3 0 0 1 6 0v5"/>
                                                        </svg> Browse Products
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

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
                            @include('frontend.customer.sidebar', ['active' => 'dashboard'])
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
