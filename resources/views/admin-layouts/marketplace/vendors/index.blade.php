@extends('admin-layouts.app')
@section('title', 'Vendors')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Vendors</h1>
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
                <div class="table-wrapper">
                    {{-- Shared Filter Panel --}}
                    @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                        {{-- Table Card --}}
                        <div class="card has-actions has-filter shadow-sm">
                            {{-- Custom Action Buttons for this page --}}
                            @section('table_actions')
                                <div class="dropdown">
                                    <button title="Export" class="btn buttons-collection dropdown-toggle buttons-export" data-bs-toggle="dropdown" type="button">
                                        <span><svg class="icon svg-icon-ti-ti-download" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path><path d="M7 11l5 5l5 -5"></path><path d="M12 4l0 12"></path></svg> Export</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item">CSV</button>
                                        <button class="dropdown-item">Excel</button>
                                    </div>
                                </div>
                            @endsection

                            {{-- Shared Header --}}
                            @include('admin-layouts.partials.table-header', [
                                'bulkActions' => true
                            ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-striped table-hover datatable" id="vendorsTable">
                                    <thead>
                                        <tr>
                                            <th class="w-1"><input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all"></th>
                                            <th class="text-center" width="20">ID</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Store name</th>
                                            <th>Store phone</th>
                                            <th>Products</th>
                                            <th>Total Revenue</th>
                                            <th>Balance</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vendors as $vendor)
                                        <tr>
                                            <td><input class="form-check-input m-0 align-middle bulk-checkbox" type="checkbox" name="id[]" value="{{ $vendor->id }}"></td>
                                            <td class="text-center text-muted">{{ $vendor->id }}</td>
                                            <td>
                                                <span class="avatar avatar-sm rounded" style="background-image: url({{ $vendor->avatar_url }})"></span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.marketplace.vendors.show', $vendor->id) }}" class="fw-bold text-dark">{{ $vendor->name }}</a>
                                            </td>
                                            <td class="text-muted">{{ $vendor->email }}</td>
                                            <td>{{ $vendor->store->name ?? '—' }}</td>
                                            <td>{{ $vendor->store->phone ?? $vendor->phone ?? '—' }}</td>
                                            <td><span class="badge bg-blue text-blue-fg">{{ $vendor->products_count }}</span></td>
                                            <td>₹{{ number_format($vendor->total_revenue_sum ?? 0, 2) }}</td>
                                            <td><span class="badge bg-cyan text-cyan-fg">₹{{ number_format(($vendor->total_revenue_sum ?? 0) - ($vendor->total_withdrawn ?? 0), 2) }}</span></td>
                                            <td class="text-center">
                                                @if($vendor->is_approved == 1)
                                                    <span class="badge bg-success text-success-fg">Approved</span>
                                                @elseif($vendor->is_approved == 2)
                                                    <span class="badge bg-danger text-danger-fg">Rejected</span>
                                                @else
                                                    <span class="badge bg-warning text-warning-fg">Pending</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.marketplace.vendors.show', $vendor->id) }}" class="btn btn-sm btn-outline-info" title="View Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.customers.edit', $vendor->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.marketplace.vendors.destroy', $vendor->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="12" class="text-center py-4 text-muted">No vendors found.</td>
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
        </main>
    </div>
@endsection

@push('scripts')
    {{-- Shared Scripts --}}
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'vendorsTable',
        'bulkDeleteUrl' => route('admin.marketplace.vendors.bulk-delete')
    ])
@endpush