@extends('admin-layouts.app')
@section('title', 'Vendors')

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
                            <li class="breadcrumb-item">
                                <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Marketplace</span>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Vendors</h1>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            {{-- Shared Filter Panel --}}
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'vendorsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="vendorsTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th width="60">Avatar</th>
                                    <th>Vendor Info</th>
                                    <th>Shop Name</th>
                                    <th class="text-center">KYC Status</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="150" class="text-center">Registered</th>
                                    <th width="150" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($vendors as $vendor)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $vendor->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $vendor->id }}</td>
                                    <td>
                                        <div class="avatar avatar-sm rounded-circle bg-white border">
                                            @php
                                                $avatarUrl = $vendor->avatar ? (str_contains($vendor->avatar, 'http') ? $vendor->avatar : asset('storage/' . $vendor->avatar)) : asset('vendor/core/core/base/images/placeholder.png');
                                            @endphp
                                            <img src="{{ $avatarUrl }}" alt="{{ $vendor->name }}" class="avatar-img rounded-circle" onerror="this.src='{{ asset('vendor/core/core/base/images/placeholder.png') }}'">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $vendor->name }}</span>
                                            <small class="text-muted">{{ $vendor->email }}</small>
                                            @if($vendor->mobile)
                                                <small class="text-muted"><i class="fas fa-phone-alt me-1 tiny"></i>{{ $vendor->mobile }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $vendor->shop_name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $kycClass = match(strtolower($vendor->kyc_status ?? '')) {
                                                'success' => 'bg-teal-lt',
                                                'pending' => 'bg-warning-lt',
                                                'failure' => 'bg-danger-lt',
                                                default   => 'bg-gray-100 text-muted'
                                            };
                                            $kycIcon = match(strtolower($vendor->kyc_status ?? '')) {
                                                'success' => 'fa-check-circle',
                                                'pending' => 'fa-hourglass-half',
                                                'failure' => 'fa-times-circle',
                                                default   => 'fa-minus'
                                            };
                                        @endphp
                                        <span class="badge {{ $kycClass }} px-2 py-1">
                                            <i class="fas {{ $kycIcon }} me-1"></i> {{ strtoupper($vendor->kyc_status ?? 'None') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = $vendor->is_approved ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg';
                                            $statusLabel = $vendor->is_approved ? 'Approved' : ucwords($vendor->status ?? 'Pending');
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $vendor->created_at ? $vendor->created_at->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @if($vendor->kyc_status === 'success' && !$vendor->is_approved)
                                                <button type="button" class="btn btn-sm btn-success approve-btn" 
                                                    data-url="{{ route('admin.marketplace.vendors.approve', $vendor->id) }}"
                                                    title="Approve Vendor">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('admin.marketplace.vendors.edit', $vendor->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.marketplace.vendors.destroy', $vendor->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No vendors found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between pt-3">
                        <div class="text-muted small">
                            Showing {{ $vendors->firstItem() ?? 0 }} to {{ $vendors->lastItem() ?? 0 }} of {{ $vendors->total() }} entries
                        </div>
                        <div>
                            {{ $vendors->appends(request()->query())->links() }}
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
        'tableId'       => 'vendorsTable',
        'bulkDeleteUrl' => route('admin.marketplace.vendors.bulk-delete')
    ])
    <script>
        $(document).on('click', '.approve-btn', function() {
            let url = $(this).data('url');
            Swal.fire({
                title: 'Approve Vendor?',
                text: "Confirming will mark this vendor as active and approved.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2fb344',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if(res.status) {
                                Swal.fire('Approved!', res.message, 'success').then(() => {
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