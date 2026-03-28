@extends('admin-layouts.app')
@section('title', 'Customers')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Customers</h1>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            {{-- Shared Filter Panel --}}
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                {{-- Create Button (must be BEFORE table-header include) --}}
                @section('table_actions')
                    <a href="{{ route('admin.customers.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'customersTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="customersTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th width="60">Avatar</th>
                                    <th>Customer Info</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Vendor</th>
                                    <th width="120" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $customer->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $customer->id }}</td>
                                    <td>
                                        <div class="avatar avatar-sm rounded-circle bg-white border">
                                            <img src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}" class="avatar-img rounded-circle" onerror="this.src='{{ asset('home/placeholder.png') }}'">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="fw-bold text-dark text-decoration-none">
                                                {{ $customer->name }}
                                            </a>
                                            <small class="text-muted">{{ $customer->email }}</small>
                                            @if($customer->phone)
                                                <small class="text-muted"><i class="fas fa-phone-alt me-1 tiny"></i>{{ $customer->phone }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($customer->status ?? '')) {
                                                'activated' => 'bg-success text-success-fg',
                                                'locked'    => 'bg-danger text-danger-fg',
                                                default      => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ ucwords($customer->status ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($customer->is_vendor)
                                            <span class="badge bg-purple-lt px-2 py-1"><i class="fas fa-store me-1"></i> YES</span>
                                        @else
                                            <span class="text-muted small">No</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $customer->created_at ? $customer->created_at->format('Y-m-d') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.customers.destroy', $customer->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No customers found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between pt-3">
                        <div class="text-muted small">
                            Showing {{ $customers->firstItem() ?? 0 }} to {{ $customers->lastItem() ?? 0 }} of {{ $customers->total() }} entries
                        </div>
                        <div>
                            {{ $customers->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId'       => 'customersTable',
        'bulkDeleteUrl' => route('admin.customers.bulk-delete')
    ])
@endpush
