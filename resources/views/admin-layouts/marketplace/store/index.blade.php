@extends('admin-layouts.app')
@section('title', 'Stores')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center text-uppercase">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Marketplace</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Stores</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
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
                    <a href="{{ route('admin.marketplace.store.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'storesTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="storesTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th width="60">Logo</th>
                                    <th>Name</th>
                                    <th>Vendor</th>
                                    <th class="text-center">Earnings</th>
                                    <th class="text-center">Products</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="120" class="text-center">Verified</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stores as $store)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $store->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $store->id }}</td>
                                    <td>
                                        <div class="avatar avatar-sm rounded bg-white border">
                                            @php
                                                $logoUrl = $store->logo ? (str_contains($store->logo, 'http') ? $store->logo : asset('storage/' . $store->logo)) : asset('img/noimg.png');
                                            @endphp
                                            <img src="{{ $logoUrl }}" alt="{{ $store->name }}" class="avatar-img" onerror="this.src='{{ asset('img/noimg.png') }}'">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.marketplace.store.edit', $store->id) }}" class="fw-bold text-dark text-decoration-none">
                                                {{ $store->name }}
                                            </a>
                                            <small class="text-muted">{{ $store->email }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($store->customer)
                                            <div class="small fw-medium">{{ $store->customer->name }}</div>
                                            <div class="small text-muted">{{ $store->customer->email }}</div>
                                        @else
                                            <span class="text-muted small">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center small">
                                        ₹{{ number_format($store->earnings ?? 0, 2) }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-blue-lt">{{ $store->products_count ?? 0 }}</span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($store->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                'pending'   => 'bg-warning text-warning-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ ucwords($store->status ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if($store->is_verified)
                                            <span class="badge bg-teal-lt px-3 rounded-pill" title="Verified at {{ $store->verified_at }}">
                                                <i class="fas fa-check-circle me-1"></i> Verified
                                            </span>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-warning rounded-pill verify-btn" data-url="{{ route('admin.marketplace.store.verify', $store->id) }}">
                                                Verify
                                            </button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.marketplace.store.show', $store->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.marketplace.store.edit', $store->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.marketplace.store.destroy', $store->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No stores found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $stores->firstItem() ?? 0 }} to {{ $stores->lastItem() ?? 0 }} of {{ $stores->total() }} entries
                        </div>
                        <div>
                            {{ $stores->appends(request()->query())->links() }}
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
        'tableId'       => 'storesTable',
        'bulkDeleteUrl' => route('admin.marketplace.store.bulk-delete')
    ])
    <script>
        $(document).on('click', '.verify-btn', function() {
            let url = $(this).data('url');
            Swal.fire({
                title: 'Verify Store?',
                text: "Are you sure you want to verify this store?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Verify!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if(res.status) {
                                Swal.fire('Verified!', res.message, 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        }
                    });
                }
            });
        });
    </script>
@endpush
