@extends('admin-layouts.app')
@section('title', 'Vendor: ' . $vendor->name)
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
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.marketplace.vendors') }}">Vendors</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">View vendor {{ $vendor->name }}</h1>
                                            </li>
                                        </ol>
                                    </nav>

                                </div>
                            </div>
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="{{ route('admin.marketplace.vendors.edit', $vendor->id) }}" class="btn btn-primary">
                                        <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" /><path d="M16 5l3 3" /></svg>
                                        Edit Vendor
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="page-body page-content">
                    <div class="container-xl">


                        <div class="row row-cards">
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Vendor Information
                                        </h4>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="text-center p-3">
                                            <div class="mb-2">
                                                <img
                                                    src="{{ $vendor->avatar ? asset('storage/' . $vendor->avatar) : asset('vendor/core/core/base/images/placeholder.png') }}"
                                                    alt="{{ $vendor->name }}"
                                                    class="avatar avatar-rounded avatar-xl" />
                                            </div>

                                            <h3 class="m-0">{{ $vendor->name }}</h3>
                                            <p class="text-muted">{{ $vendor->email }}</p>

                                            <p class="text-muted mb-1">
                                                <svg class="icon svg-icon-ti-ti-phone"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                                </svg> {{ $vendor->phone ?? 'N/A' }}
                                            </p>

                                            <div class="mt-2">
                                                @if($vendor->email_verified_at)
                                                <span class="badge bg-green text-green-fg">
                                                    <svg class="icon svg-icon-ti-ti-check"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M5 12l5 5l10 -10" />
                                                    </svg> Email verified
                                                </span>
                                                @endif

                                                @if($vendor->vendor_verified_at)
                                                <span class="badge bg-primary text-primary-fg">
                                                    <svg class="icon svg-icon-ti-ti-shield-check"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" />
                                                        <path d="M15 19l2 2l4 -4" />
                                                    </svg> Vendor Verified
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hr my-2"></div>

                                        <div class="p-3">
                                            <dl class="row">
                                                <dt class="col">Status</dt>
                                                <dd class="col-auto">
                                                    <span class="badge {{ $vendor->status == 'activated' ? 'bg-green' : 'bg-red' }} text-white">
                                                        {{ ucfirst($vendor->status) }}
                                                    </span>

                                                </dd>
                                            </dl>

                                            <dl class="row">
                                                <dt class="col">Date of birth</dt>
                                                <dd class="col-auto">{{ $vendor->dob ?? 'N/A' }}</dd>
                                            </dl>

                                            <dl class="row">
                                                <dt class="col">Created At</dt>
                                                <dd class="col-auto">{{ $vendor->created_at->format('Y-m-d H:i') }}</dd>
                                            </dl>

                                            @if($vendor->vendor_verified_at)
                                            <dl class="row">
                                                <dt class="col">Verified At</dt>
                                                <dd class="col-auto">{{ \Carbon\Carbon::parse($vendor->vendor_verified_at)->format('Y-m-d H:i') }}</dd>
                                            </dl>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($vendor->store)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Store information
                                        </h4>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="p-3 text-center">
                                            <div class="mb-2">
                                                <img
                                                    src="{{ $vendor->store->logo ? asset($vendor->store->logo) : asset('vendor/core/core/base/images/placeholder.png') }}"
                                                    alt="{{ $vendor->store->name }}"
                                                    class="avatar avatar-rounded avatar-xl" />
                                            </div>

                                            <h3 class="m-0">
                                                <a href="{{ route('admin.marketplace.store.show', $vendor->store->id) }}">
                                                    {{ $vendor->store->name }}
                                                    <svg class="icon svg-icon-ti-ti-external-link"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                        <path d="M11 13l9 -9" />
                                                        <path d="M15 4h5v5" />
                                                    </svg> </a>
                                            </h3>

                                            <p class="text-muted mb-1">{{ $vendor->store->email }}</p>

                                            <p class="text-muted mb-1">
                                                <svg class="icon svg-icon-ti-ti-phone"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                                </svg> {{ $vendor->store->phone ?? 'N/A' }}
                                            </p>

                                            @if($vendor->store->is_verified)
                                            <span class="badge bg-green text-green-fg">
                                                <svg class="icon svg-icon-ti-ti-shield-check"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06" />
                                                    <path d="M15 19l2 2l4 -4" />
                                                </svg> Verified Store
                                            </span>
                                            @endif
                                        </div>

                                        <div class="hr my-2"></div>
                                        <div class="p-3">
                                            <strong>Store Address</strong>
                                            <p class="text-muted mb-0">
                                                {{ $vendor->store->address }}
                                                @if($vendor->store->city), {{ $vendor->store->city }} @endif
                                                @if($vendor->store->state), {{ $vendor->store->state }} @endif
                                                @if($vendor->store->country), {{ $vendor->store->country }} @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Personal Addresses
                                        </h4>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="list-group list-group-flush">
                                            @forelse($vendor->addresses ?? [] as $address)
                                            <div class="list-group-item">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <div class="text-truncate">
                                                            <strong>{{ $address->name }}</strong>
                                                            @if($address->is_default)
                                                            <span class="badge bg-blue text-blue-fg ms-1">Default</span>
                                                            @endif
                                                        </div>
                                                        <div class="text-muted text-truncate mt-1">
                                                            {{ $address->address }}, {{ $address->city }}, {{ $address->state }}
                                                        </div>
                                                        <div class="text-muted mt-1">
                                                            <svg class="icon svg-icon-ti-ti-phone"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                                            </svg> {{ $address->phone }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="list-group-item text-center text-muted py-3">
                                                No addresses found.
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9">
                                <!-- Vendor Statistics -->
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Store Products</div>
                                                </div>
                                                <div class="h1 mb-0">{{ $vendor->store->products_count ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Store Orders</div>
                                                </div>
                                                <div class="h1 mb-0">{{ $vendor->store->orders_count ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Total Revenue</div>
                                                </div>
                                                <div class="h1 mb-0">${{ number_format($vendor->store->revenue ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Total Earnings</div>
                                                </div>
                                                <div class="h1 mb-0">${{ number_format($vendor->store->balance ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Withdrawals</div>
                                                </div>
                                                <div class="h1 mb-0">${{ number_format($vendor->store->total_withdrawn ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Pending Withdrawals</div>
                                                </div>
                                                <div class="h1 mb-0">${{ number_format($vendor->store->pending_withdrawals ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Balance</div>
                                                </div>
                                                <div class="h1 mb-0">${{ number_format($vendor->store->balance ?? 0, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="subheader">Completed orders</div>
                                                </div>
                                                <div class="h1 mb-0">{{ $vendor->store->completed_orders_count ?? 0 }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Recent Products
                                        </h4>
                                    </div>

                                    <table class="table table-vcenter card-table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Product
                                                </th>
                                                <th>
                                                    Price
                                                </th>
                                                <th>
                                                    Quantity
                                                </th>
                                                <th>
                                                    Status
                                                </th>
                                                <th>
                                                    Created At
                                                </th>
                                                <th>

                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($vendor->store && $vendor->store->products)
                                                @forelse($vendor->store->products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img
                                                                src="{{ asset($product->image ?? 'vendor/core/core/base/images/placeholder.png') }}"
                                                                alt="{{ $product->name }}"
                                                                class="me-2 rounded"
                                                                style="width: 40px; height: 40px; object-fit: cover;" />
                                                            <div>
                                                                    <a href="{{ route('admin.products.edit', $product->id) }}">
                                                                        {{ $product->name }}
                                                                    </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        ${{ number_format($product->price ?? 0, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ $product->quantity ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $product->status == 'published' ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }}">
                                                            {{ ucfirst($product->status ?? 'unknown') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ optional($product->created_at)->format('Y-m-d') ?? 'N/A' }}
                                                    </td>
                                                    <td>
                                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="text-decoration-none">
                                                                View Detail
                                                            </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="6" class="text-center py-4">No products found.</td></tr>
                                                @endforelse
                                            @else
                                                <tr><td colspan="6" class="text-center py-4">No store products available for this vendor.</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>


                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Recent Reviews ({{ $vendor->store->reviews_count ?? 0 }})
                                        </h4>
                                    </div>

                                    <div class="card-body">
                                        @if($vendor->store && $vendor->store->reviews)
                                            @forelse($vendor->store->reviews as $review)
                                            <div class="mb-3 pb-3 border-bottom">
                                                <div class="d-flex align-items-start">
                                                    <img
                                                        src="{{ asset($review->product->image ?? 'vendor/core/core/base/images/placeholder.png') }}"
                                                        alt="{{ $review->product->name ?? 'Product' }}"
                                                        class="me-3 rounded"
                                                        style="width: 50px; height: 50px; object-fit: cover;" />
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between align-items-start">
                                                            <div>
                                                                @if($review->product)
                                                                <a href="{{ route('admin.products.edit', $review->product->id) }}" class="text-decoration-none">
                                                                    <strong>{{ $review->product->name }}</strong>
                                                                </a>
                                                                @endif
                                                                <div class="text-warning">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $review->star)
                                                                            <svg class="icon svg-icon-ti-ti-star-filled" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                                <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" stroke-width="0" fill="currentColor" />
                                                                            </svg>
                                                                        @else
                                                                            <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873" />
                                                                            </svg>
                                                                        @endif
                                                                    @endfor
                                                                    <span class="text-muted ms-1">({{ $review->star }}/5)</span>
                                                                </div>
                                                            </div>
                                                            <div class="text-muted small">
                                                                {{ $review->created_at ? $review->created_at->diffForHumans() : '' }}
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 mt-2">{{ $review->comment }}</p>
                                                        <div class="mt-1 small text-muted">By: {{ $review->customer_name ?? 'Anonymous' }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="text-center text-muted py-4">No reviews found.</div>
                                            @endforelse
                                        @else
                                            <div class="text-center text-muted py-4">Review data unavailable.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </main>

           

@endsection
