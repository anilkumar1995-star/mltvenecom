@extends('admin-layouts.app')
@section('title', 'View vendor: ' . $vendor->name)
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-muted">Marketplace</h1>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">View vendor {{ $vendor->name }}</h1>
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
            <div class="row row-cards">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header">
                            <h4 class="card-title fw-bold">Vendor Information</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="text-center p-3">
                                <div class="mb-2 text-center">
                                    <img src="{{ $vendor->avatar_url }}" alt="{{ $vendor->name }}" class="avatar avatar-rounded avatar-xl shadow-xs" onerror="this.src='{{ asset('home/placeholder.png') }}'">
                                </div>
                                <h3 class="m-0 fw-bold">{{ $vendor->name }}</h3>
                                <p class="text-muted small mb-1">{{ $vendor->email }}</p>
                                
                                <div class="mt-2 d-flex flex-wrap justify-content-center gap-1">
                                    @if($vendor->email_verified_at)
                                        <span class="badge bg-green text-green-fg p-1 px-2">
                                            <svg class="icon svg-icon-ti-ti-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10"></path></svg>
                                            Email verified
                                        </span>
                                    @endif
                                    @if($vendor->vendor_verified_at)
                                        <span class="badge bg-green text-green-fg p-1 px-2">
                                            <svg class="icon svg-icon-ti-ti-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10"></path></svg>                                            Vendor Verified
                                        </span>
                                    @else
                                        <span class="badge bg-cyan text-cyan-fg p-1 px-2">
                                            <svg class="icon svg-icon-ti-ti-shield-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13.252 20.601c-.408 .155 -.826 .288 -1.252 .399a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.19 7.357"></path><path d="M22 22l-5 -5"></path><path d="M17 22l5 -5"></path></svg>
                                            Vendor Not Verified
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="hr my-2 opacity-50"></div>

                            <div class="p-3">
                                <dl class="row mb-2">
                                    <dt class="col small text-muted">Status</dt>
                                    <dd class="col-auto">
                                        <span class="badge bg-green text-green-fg px-2">
                                            {{ ucfirst($vendor->status ?? 'activated') }}
                                        </span>
                                    </dd>
                                </dl>
                                <dl class="row mb-2">
                                    <dt class="col small text-muted">Created At</dt>
                                    <dd class="col-auto small">{{ $vendor->created_at ? $vendor->created_at->format('Y-m-d H:i') : 'N/A' }}</dd>
                                </dl>
                                <dl class="row mb-2">
                                    <dt class="col small text-muted">Total orders</dt>
                                    <dd class="col-auto small">{{ $vendor->orders_count }}</dd>
                                </dl>
                                <dl class="row mb-0">
                                    <dt class="col small text-muted">Total spent</dt>
                                    <dd class="col-auto small">₹0.00</dd>
                                </dl>
                            </div>

                            <div class="hr my-2 opacity-50"></div>

                            <div class="p-3">
                                <a href="{{ route('admin.customers.edit', $vendor->id) }}" class="btn btn-primary w-100 shadow-xs">
                                    <svg class="icon svg-icon-ti-ti-edit" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415"></path><path d="M16 5l3 3"></path></svg>
                                    Edit vendor
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-header border-bottom-0">
                            <h4 class="card-title fw-bold">Store information</h4>
                        </div>
                        <div class="card-body p-0 text-center">
                            <div class="p-3">
                                <div class="mb-2 text-center">
                                    <img src="{{ optional($vendor->store)->logo_url ?? asset('img/noimg.png') }}" class="avatar avatar-rounded avatar-xl shadow-xs" onerror="this.src='{{ asset('img/noimg.png') }}'">
                                </div>
                                <h3 class="m-0 fw-bold">
                                    <a href="#" target="_blank" class="text-dark">
                                        {{ $vendor->store->name ?? 'N/A' }}
                                        <svg class="icon svg-icon-ti-ti-external-link" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path><path d="M11 13l9 -9"></path><path d="M15 4h5v5"></path></svg>
                                    </a>
                                </h3>
                                <p class="text-muted small mb-1">{{ $vendor->email }}</p>
                                <p class="text-muted small mb-2">
                                    <svg class="icon svg-icon-ti-ti-phone" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path></svg>
                                    {{ $vendor->store->phone ?? $vendor->phone ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <!-- Vendor Statistics -->
                    <div class="row row-cards mb-3">
                        @foreach([
                            ['label' => 'Store Products', 'value' => $vendor->products_count],
                            ['label' => 'Store Orders', 'value' => $vendor->orders_count],
                            ['label' => 'Total Revenue', 'value' => '₹' . number_format($vendor->total_revenue_sum ?? 0, 2)],
                            ['label' => 'Total Earnings', 'value' => '₹' . number_format($vendor->total_revenue_sum ?? 0, 2)],
                            ['label' => 'Withdrawals', 'value' => '₹' . number_format($vendor->total_withdrawn ?? 0, 2)],
                            ['label' => 'Pending Withdrawals', 'value' => '₹0.00'],
                            ['label' => 'Balance', 'value' => '₹' . number_format(($vendor->total_revenue_sum ?? 0) - ($vendor->total_withdrawn ?? 0), 2)],
                            ['label' => 'Completed orders', 'value' => '0'],
                        ] as $stat)
                            <div class="col-md-3 col-sm-6">
                                <div class="card shadow-xs border-0 mb-3 py-2">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-1">
                                            <div class="subheader text-muted fw-bold small text-uppercase">{{ $stat['label'] }}</div>
                                        </div>
                                        <div class="h1 mb-0 fw-bold">{{ $stat['value'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Additional Details / History -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header border-bottom-0 pb-0">
                            <h4 class="card-title fw-bold">Recent Withdrawals</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="small text-muted text-uppercase">ID</th>
                                            <th class="small text-muted text-uppercase">Amount</th>
                                            <th class="small text-muted text-uppercase">Status</th>
                                            <th class="small text-muted text-uppercase">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">No withdrawals history found.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
