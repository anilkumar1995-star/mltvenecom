@extends('admin-layouts.app')
@section('title', 'Unverified Vendors')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Unverified Vendors</h1>
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
                    <div class="col-12">
                        {{-- Filters Panel --}}
                        @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                        {{-- Table Card --}}
                        <div class="card has-actions has-filter shadow-sm">
                            {{-- Custom Action Buttons for this page --}}
                            @section('table_actions')
                                <a href="#" class="btn" data-bs-toggle="tooltip" title="Export">
                                    <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                    Export
                                </a>
                            @endsection

                            {{-- Shared Header --}}
                            @include('admin-layouts.partials.table-header', [
                                'bulkActions' => true
                            ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-striped table-hover datatable" id="unverifiedVendorsTable">
                                    <thead>
                                        <tr>
                                            <th class="w-1"><input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all"></th>
                                            <th class="text-center" width="20">ID</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>PAN</th>
                                            <th>Aadhar</th>
                                            <th>KYC KID</th>
                                            <th>KYC Status</th>
                                            <th>Status</th>
                                            <th class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendors as $vendor)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle bulk-checkbox" type="checkbox" name="id[]" value="{{ $vendor->id }}"></td>
                                            <td class="text-center text-muted">{{ $vendor->id }}</td>
                                            <td>
                                                <span class="avatar avatar-sm rounded" style="background-image: url({{ $vendor->avatar ? asset('storage/' . $vendor->avatar) : asset('vendor/core/core/base/images/placeholder.png') }})"></span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.marketplace.unverified-vendors.verify', $vendor->id) }}" class="fw-bold text-dark">{{ $vendor->name }}</a>
                                                <div class="small text-muted">{{ $vendor->store->name ?? '—' }}</div>
                                            </td>
                                            <td class="text-muted small">{{ $vendor->email }}</td>
                                            <td class="small fw-bold">{{ $vendor->pan_number ?? '—' }}</td>
                                            <td class="small fw-bold">{{ $vendor->aadhar_number ?? '—' }}</td>
                                            <td class="text-muted small">{{ $vendor->kyc_kid ?? '—' }}</td>
                                            <td>
                                                @php
                                                    $kycColor = 'secondary';
                                                    if($vendor->kyc_status == 'approved' || $vendor->kyc_status == 'verified') $kycColor = 'success';
                                                    elseif($vendor->kyc_status == 'pending') $kycColor = 'warning';
                                                    elseif($vendor->kyc_status == 'rejected') $kycColor = 'danger';
                                                @endphp
                                                <span class="badge bg-{{ $kycColor }} text-white">{{ ucfirst($vendor->kyc_status ?? 'N/A') }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-white">{{ ucfirst($vendor->status) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.marketplace.unverified-vendors.verify', $vendor->id) }}" class="btn btn-sm btn-outline-info" title="Review & Verify">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11" class="text-center py-4 text-muted">No unverified vendors found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <p class="m-0 text-muted">Showing <span>{{ $vendors->firstItem() ?? 0 }}</span> to <span>{{ $vendors->lastItem() ?? 0 }}</span> of <span>{{ $vendors->total() }}</span> entries</p>
                            {{ $vendors->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Shared Scripts --}}
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'unverifiedVendorsTable',
        'bulkDeleteUrl' => route('admin.marketplace.vendors.bulk-delete')
    ])
</div>
@endsection
