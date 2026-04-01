@extends('admin-layouts.app')
@section('title', 'Verify Vendor: ' . $vendor->name)
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
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.marketplace.vendors') }}">Vendors</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Verify vendor "{{ $vendor->name }}"</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list"></div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h4 class="card-title fw-bold">Store information</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-3 text-center">
                                <div class="mb-3">
                                    <img src="{{ $vendor->avatar ? asset('storage/' . $vendor->avatar) : asset('vendor/core/core/base/images/placeholder.png') }}" alt="{{ $vendor->shop_name }}" class="avatar avatar-rounded avatar-xl border shadow-xs">
                                </div>
                                <h4 class="mb-1 fw-bold">{{ $vendor->store->name ?? 'N/A' }}</h4>
                                <a href="{{ route('admin.marketplace.store.edit', $vendor->id ?? 0) }}" target="_blank" class="text-primary small">
                                    View Store
                                    <svg class="icon svg-icon-ti-ti-external-link ms-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                        <path d="M11 13l9 -9"></path>
                                        <path d="M15 4h5v5"></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="hr my-2 opacity-50"></div>
                            <dl class="row p-3 pt-0 mb-0">
                                <dt class="col-sm-5 text-muted small">Store phone</dt>
                                <dd class="col-sm-7 text-end fw-medium">{{ $vendor->store->phone ?? $vendor->phone ?? 'N/A' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h4 class="card-title fw-bold">Vendor information</h4>
                        </div>
                        <div class="card-body">
                            <div class="datagrid">
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Full Name</div>
                                    <div class="datagrid-content fw-bold text-dark">
                                        {{ $vendor->name }}
                                        <a href="#" target="_blank" class="ms-1">
                                            <svg class="icon svg-icon-ti-ti-external-link text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"></path>
                                                <path d="M11 13l9 -9"></path>
                                                <path d="M15 4h5v5"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Email Address</div>
                                    <div class="datagrid-content text-muted">{{ $vendor->email }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Registered At</div>
                                    <div class="datagrid-content text-muted">{{ $vendor->created_at->format('Y-m-d H:i:s') }}</div>
                                </div>
                                <div class="datagrid-item">
                                    <div class="datagrid-title">Current Status</div>
                                    <div class="datagrid-content">
                                        <span class="badge bg-{{ $vendor->vendor_verified_at ? 'success' : 'warning' }}-lt px-2 py-1">
                                            {{ $vendor->vendor_verified_at ? 'Approved' : 'Pending' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-end py-3">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="btn-list text-end">
                                    <button class="btn btn-outline-danger px-4 reject-vendor-btn" type="button" data-url="{{ route('admin.marketplace.vendors.reject', $vendor->id) }}">
                                        <svg class="icon icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6l-12 12"></path>
                                            <path d="M6 6l12 12"></path>
                                        </svg>
                                        Reject
                                    </button>
                                    <button class="btn btn-primary px-4 approve-vendor-btn" type="button" data-url="{{ route('admin.marketplace.vendors.approve', $vendor->id) }}">
                                        <svg class="icon icon-left svg-icon-ti-ti-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12l5 5l10 -10"></path>
                                        </svg>
                                        Approve
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.approve-vendor-btn', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: 'Approve Vendor?',
            text: "Mark this vendor as active and allow them to sell?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2fb344',
            confirmButtonText: 'Yes, Approve!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) { return res; }
                });
            }
        }).then((result) => {
            if (result.isConfirmed && result.value && result.value.status) {
                Swal.fire('Approved!', 'Vendor has been approved.', 'success').then(() => {
                    window.location.href = "{{ route('admin.marketplace.unverified-vendors') }}";
                });
            } else if (result.value) {
                Swal.fire('Error!', result.value.message || 'Action failed.', 'error');
            }
        });
    });

    $(document).on('click', '.reject-vendor-btn', function() {
        let url = $(this).data('url');
        Swal.fire({
            title: 'Reject Vendor?',
            text: "Are you sure you want to reject this vendor? This will disable their account.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d63939',
            confirmButtonText: 'Yes, Reject!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) { return res; }
                });
            }
        }).then((result) => {
            if (result.isConfirmed && result.value && result.value.status) {
                Swal.fire('Rejected!', 'Vendor has been rejected.', 'success').then(() => {
                    window.location.href = "{{ route('admin.marketplace.unverified-vendors') }}";
                });
            } else if (result.value) {
                Swal.fire('Error!', result.value.message || 'Action failed.', 'error');
            }
        });
    });
</script>
@endpush
