@extends('admin-layouts.app')
@section('title', 'View product - ' . $product->name)
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.products.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">View product - {{ $product->name }}</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <div class="row mb-3 g-2">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-blue text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Total Views</div>
                                        <div class="h3 m-0">{{ $stats['views'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-green text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-shopping-cart" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M15 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M17 17h-11v-14h-2"></path>
                                            <path d="M6 5l14 1l-1 7h-13"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Completed Orders</div>
                                        <div class="h3 m-0">{{ $stats['completed_orders'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-cyan text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-package" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5"></path>
                                            <path d="M12 12l8 -4.5"></path>
                                            <path d="M12 12l0 9"></path>
                                            <path d="M12 12l-8 -4.5"></path>
                                            <path d="M16 5.25l-8 4.5"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Total Sold</div>
                                        <div class="h3 m-0">{{ $stats['total_sold'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-orange text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-cash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M7 15h-3a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v3"></path>
                                            <path d="M7 10a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1l0 -8"></path>
                                            <path d="M12 14a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Total Revenue</div>
                                        <div class="h3 m-0">₹{{ number_format($stats['revenue'], 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-yellow text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-clock" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                            <path d="M12 7v5l3 3"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Pending Orders</div>
                                        <div class="h3 m-0">{{ $stats['pending_orders'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-lime text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-clock-dollar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20.866 10.45a9 9 0 1 0 -7.815 10.488"></path>
                                            <path d="M12 7v5l1.5 1.5"></path>
                                            <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                            <path d="M19 21v1m0 -8v1"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Pending Revenue</div>
                                        <div class="h3 m-0">₹{{ number_format($stats['pending_revenue'], 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-purple text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-percentage" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 17a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                            <path d="M6 7a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                            <path d="M6 18l12 -12"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Conversion Rate</div>
                                        <div class="h3 m-0">{{ number_format($stats['conversion_rate'], 2) }}%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-pink text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-message-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M8 9h8"></path>
                                            <path d="M8 13h4.5"></path>
                                            <path d="M10.325 19.605l-2.325 1.395v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"></path>
                                            <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Total Reviews</div>
                                        <div class="h3 m-0">{{ $stats['reviews_count'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <span class="bg-yellow text-white avatar me-3">
                                        <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <div class="text-muted small">Average Rating</div>
                                        <div class="h3 m-0">{{ number_format($stats['average_rating'], 2) }} / 5.0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cards">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Product Information</h4>
                            </div>
                            <div class="card-body p-0">
                                @php
                                    $mainImage = $product->image_url;
                                    $gallery = $product->gallery_image_urls;
                                    if (empty($product->image) && !empty($gallery)) {
                                        $mainImage = $gallery[0];
                                    }
                                @endphp
                                <div class="text-center p-3 border-bottom">
                                    <div class="mb-3">
                                        <img src="{{ $mainImage }}" alt="{{ $product->name }}" class="img-fluid rounded shadow-sm border" style="max-width: 100%; height: 220px; object-fit: cover;">
                                        @if($product->is_featured)
                                            <div class="mt-2">
                                                <span class="badge bg-yellow text-white shadow-sm">Featured</span>
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="m-0 fw-bold">{{ $product->name }}</h3>
                                    <p class="text-muted small mb-2">SKU: {{ $product->sku ?? 'N/A' }}</p>
                                    <div class="mt-2">
                                        @php
                                            $statusCls = match($product->status) {
                                                'published' => 'bg-green-lt text-green',
                                                'draft' => 'bg-orange-lt text-orange',
                                                default => 'bg-secondary-lt text-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusCls }} px-3 rounded-pill">{{ ucfirst($product->status) }}</span>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="datagrid">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Price</div>
                                            <div class="datagrid-content">₹{{ number_format($product->price ?? 0, 2) }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Quantity</div>
                                            <div class="datagrid-content">{{ $product->quantity ?? 0 }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Stock status</div>
                                            <div class="datagrid-content">
                                                <span class="{{ $product->stock_status == 'in_stock' ? 'text-success' : 'text-danger' }}">
                                                    {{ str_replace('_', ' ', ucfirst($product->stock_status)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Brand</div>
                                            <div class="datagrid-content">{{ $product->brand->name ?? 'N/A' }}</div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Category</div>
                                            <div class="datagrid-content">
                                                {{ $product->categories->pluck('name')->implode(', ') ?: 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Created At</div>
                                            <div class="datagrid-content">{{ $product->created_at ? $product->created_at->format('Y-m-d H:i') : 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 border-top">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary w-100 mb-2">
                                        <svg class="icon svg-icon-ti-ti-edit" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <a href="{{ url('products/' . $product->slug) }}" target="_blank" class="btn btn-secondary w-100">
                                        <svg class="icon svg-icon-ti-ti-external-link" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                            <path d="M11 13l9 -9"></path>
                                            <path d="M15 4h5v5"></path>
                                        </svg>
                                        View on Frontend
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <svg class="icon svg-icon-ti-ti-chart-line" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19l16 0"></path>
                                        <path d="M4 15l4 -6l4 2l4 -5l4 4"></path>
                                    </svg>
                                    Views by Date (Last 30 Days)
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="empty">
                                    <div class="empty-icon">
                                        <svg class="icon svg-icon-ti-ti-eye-off" style="--bb-icon-size: 3rem;" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                                            <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"></path>
                                            <path d="M3 3l18 18"></path>
                                        </svg>
                                    </div>
                                    <p class="empty-title">No views data available for the last 30 days.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <svg class="icon svg-icon-ti-ti-shopping-bag" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304"></path>
                                        <path d="M9 11v-5a3 3 0 0 1 6 0v5"></path>
                                    </svg>
                                    Recent Orders
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th class="text-end">Quantity</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Total</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($recentOrders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="fw-bold text-primary">#{{ $order->id }}</a>
                                                    </td>
                                                    <td>{{ $order->customer_name ?? 'Guest' }}</td>
                                                    <td>
                                                        @php
                                                            $payStatus = strtolower($order->payment_status ?? 'pending');
                                                            $payClass = match($payStatus) {
                                                                'completed' => 'bg-success',
                                                                'pending' => 'bg-warning',
                                                                default => 'bg-secondary'
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $payClass }} text-white px-2 rounded-pill small">{{ ucfirst($payStatus) }}</span>
                                                    </td>
                                                    <td class="text-end fw-bold">{{ $order->qty }}</td>
                                                    <td class="text-end">₹{{ number_format($order->product_price, 2) }}</td>
                                                    <td class="text-end fw-bold text-dark">₹{{ number_format($order->qty * $order->product_price, 2) }}</td>
                                                    <td class="small text-muted text-end">{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4 text-muted">No recent orders for this product.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Related Products --}}
                        <div class="card mt-3">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">
                                    <svg class="icon svg-icon-ti-ti-link me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5"></path>
                                        <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5"></path>
                                    </svg>
                                    Related Products
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-2">
                                    @forelse($relatedProducts as $rp)
                                        <div class="col-6 col-md-3">
                                            <a href="{{ route('admin.products.show', $rp->id) }}" class="text-decoration-none text-dark">
                                                <div class="p-2 border rounded text-center h-100 shadow-hover bg-white">
                                                    <img src="{{ $rp->image_url }}" class="img-fluid rounded mb-2" style="height: 100px; width: 100%; object-fit: cover;">
                                                    <div class="fw-bold small text-truncate">{{ $rp->name }}</div>
                                                    <div class="text-muted tiny mb-1">{{ $rp->brand->name ?? 'N/A' }}</div>
                                                    <div class="fw-bold text-primary">₹{{ number_format($rp->price, 2) }}</div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center text-muted py-5 bg-white rounded shadow-xs">
                                            <i class="fas fa-link-slash fa-2x mb-2 opacity-20"></i>
                                            <p class="mb-0">No related products linked.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
