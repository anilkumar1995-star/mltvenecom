@extends('frontend.layouts.app')

@section('title', 'Vendor Approval Pending')

@section('content')
<main>
    <div class="bb-customer-page crop-avatar">
        <div class="container">
            <div class="customer-body shadow-sm rounded-4 bg-white overflow-hidden my-5">
                {{-- Mobile Header --}}
                <div class="d-lg-none bg-white border-bottom p-3 text-center">
                    <div class="fw-semibold">{{ $user->name }}</div>
                    <div class="text-muted small">Vendor Approval Pending</div>
                </div>

                <div class="row g-0">
                    {{-- Desktop Sidebar --}}
                    <div class="col-lg-3 col-xl-3 d-none d-lg-block border-end bg-light">
                        <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                            <div class="bb-customer-sidebar flex-1">
                                <div class="bb-customer-sidebar-heading border-bottom">
                                    <div class="d-flex align-items-center gap-3 p-4">
                                        <div class="position-relative">
                                            <div style="width:48px;height:48px; border-radius:50%; background:#e9ecef; display:flex; align-items:center; justify-content:center;">
                                                <i class="fas fa-user text-secondary"></i>
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-warning rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="name fw-semibold text-truncate">{{ $user->name }}</div>
                                            <div class="email text-muted small text-truncate">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                @include('frontend.customer.sidebar', ['active' => 'vendor.dashboard'])
                            </div>
                        </div>
                    </div>

                    {{-- Main Content --}}
                    <div class="col-lg-9 col-xl-9">
                        <div class="bb-profile-content p-4">
                            <div class="bb-profile-header">
                                <h1 class="bb-profile-header-title h3 mb-0"></h1>
                            </div>
                            <div class="bb-profile-main">
                                <h3 class="alert-heading">Become Vendor</h3>
                                <div class="alert alert-warning mb-0 mt-3" role="alert">
                                    <p class="mb-0">Please wait for the administrator to review and approve!</p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="mb-3">Vendor Information</h5>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Store name:</strong> {{ $store ? $store->name : ($user->shop_name ?? 'N/A') }}</li>
                                        <li class="list-group-item"><strong>Store owner:</strong> {{ $user->name }}</li>
                                        <li class="list-group-item"><strong>Phone:</strong> {{ $store ? $store->phone : ($user->mobile ?? $user->phone ?? 'N/A') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
