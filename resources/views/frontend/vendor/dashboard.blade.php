@extends('vendor-layouts.app')
@section('title', 'Vendor Dashboard')

@section('content')
<style>
    .welcome-card { 
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
        color: white; 
        border: none; 
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }
    .stat-card { 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
        border: 1px solid rgba(0,0,0,0.05); 
        border-radius: 16px; 
    }
    .stat-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); 
    }
    .icon-box { 
        width: 52px; 
        height: 52px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        border-radius: 14px; 
        transition: transform 0.3s;
    }
    .stat-card:hover .icon-box {
        transform: scale(1.1) rotate(-5deg);
    }
    .quick-link-ico { 
        width: 44px; 
        height: 44px; 
        border-radius: 12px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.1rem;
    }
</style>

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Overview</div>
                <h2 class="page-title">Store Dashboard</h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('frontend.vendor.products.create') }}" class="btn btn-white fw-bold">
                            <i class="fa fa-plus me-2 text-primary"></i> New Product
                        </a>
                    </span>
                    <a href="{{ route('frontend.vendor.settings.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="fa fa-cog me-2"></i> Store Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        {{-- Welcome Header --}}
        <div class="card welcome-card mb-4 shadow-lg overflow-hidden position-relative">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-6 fw-bold mb-2">Welcome back, {{ Auth::guard('customer')->user()->name }}!</h1>
                        @if($store)
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-primary-lt px-3 py-2 fs-4">
                                    <i class="fa fa-store me-2"></i> {{ $store->name }}
                                </span>
                                @if($store->phone)
                                    <span class="text-white-50 ms-2">
                                        <i class="fa fa-phone me-1"></i> <a href="tel:{{ $store->phone }}" class="text-white-50">{{ $store->phone }}</a>
                                    </span>
                                @endif
                            </div>
                        @endif
                        <p class="fs-4 text-white-50 mb-0">Manage your store products, orders, and customer insights all in one place.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <img src="{{ asset('vendor/core/core/base/images/welcome-dashboard.svg') }}" alt="Dashboard" style="max-width: 200px; opacity: 0.8;">
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            {{-- Revenue Card --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-success-lt me-3">
                                <i class="fa fa-money-bill-wave fs-3 text-success"></i>
                            </div>
                            <div class="fw-bold text-muted text-uppercase small">Total Revenue</div>
                        </div>
                        <div class="h1 fw-bold mb-0">₹{{ number_format($revenueCount, 2) }}</div>
                        <div class="text-muted small mt-2">Lifetime earnings</div>
                    </div>
                </div>
            </div>

            {{-- Orders Card --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-primary-lt me-3">
                                <i class="fa fa-shopping-cart fs-3 text-primary"></i>
                            </div>
                            <div class="fw-bold text-muted text-uppercase small">Orders</div>
                        </div>
                        <div class="h1 fw-bold mb-0">{{ $ordersCount }}</div>
                        <div class="d-flex align-items-center mt-2">
                            <span class="badge bg-warning text-white me-2">{{ $pendingOrdersCount }}</span>
                            <span class="text-muted small">Pending approval</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Products Card --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-info-lt me-3">
                                <i class="fa fa-box-open fs-3 text-info"></i>
                            </div>
                            <div class="fw-bold text-muted text-uppercase small">Inventory</div>
                        </div>
                        <div class="h1 fw-bold mb-0">{{ $productsCount }}</div>
                        <div class="text-muted small mt-2">Active products in store</div>
                    </div>
                </div>
            </div>

            {{-- Reviews Card --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-box bg-yellow-lt me-3">
                                <i class="fa fa-star fs-3 text-warning"></i>
                            </div>
                            <div class="fw-bold text-muted text-uppercase small">Customer Rating</div>
                        </div>
                        <div class="h1 fw-bold mb-0">{{ $reviewsCount }}</div>
                        <div class="text-muted small mt-2">Reviews received</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards mt-4">
            {{-- Recent Products Table --}}
            <div class="col-lg-8">
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h3 class="card-title fw-bold">Recently Added Products</h3>
                        <a href="{{ route('frontend.vendor.products.index') }}" class="btn btn-sm btn-ghost-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-sm rounded me-2" style="background-image: url({{ $product->image_url }})"></span>
                                            <div class="font-weight-medium text-truncate" style="max-width: 200px;">{{ $product->name }}</div>
                                        </div>
                                    </td>
                                    <td>₹{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->status == 'published' ? 'success' : 'warning' }}-lt">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td class="text-muted small">{{ $product->created_at->format('d M, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('frontend.vendor.products.edit', $product->id) }}" class="btn btn-sm btn-icon border-0" title="Edit">
                                            <i class="fa fa-edit text-muted"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No products added yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Quick Links Sidebar --}}
            <div class="col-lg-4">
                <div class="card shadow-sm rounded-4 border-0">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h3 class="card-title fw-bold">Quick Links</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('frontend.vendor.orders.index') }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                                <div class="quick-link-ico bg-primary-lt me-3"><i class="fa fa-shopping-bag"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold">View Orders</h5>
                                    <p class="small text-muted mb-0">Track and fulfill your orders</p>
                                </div>
                            </a>
                            <a href="{{ route('frontend.vendor.withdrawals.index') }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                                <div class="quick-link-ico bg-success-lt me-3"><i class="fa fa-wallet"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Withdrawals</h5>
                                    <p class="small text-muted mb-0">Manage your earnings & payments</p>
                                </div>
                            </a>
                            <a href="{{ route('frontend.vendor.discounts.index') }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                                <div class="quick-link-ico bg-purple-lt me-3"><i class="fa fa-tag"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Discounts</h5>
                                    <p class="small text-muted mb-0">Create coupons and sale prices</p>
                                </div>
                            </a>
                            <a href="{{ route('frontend.vendor.reviews.index') }}" class="list-group-item list-group-item-action py-3 d-flex align-items-center">
                                <div class="quick-link-ico bg-yellow-lt me-3"><i class="fa fa-star"></i></div>
                                <div>
                                    <h5 class="mb-0 fw-bold">Reviews</h5>
                                    <p class="small text-muted mb-0">Read what customers are saying</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
