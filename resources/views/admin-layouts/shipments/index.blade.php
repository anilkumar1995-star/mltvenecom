@extends('admin-layouts.app')
@section('title', 'Shipments')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Shipments</h1>
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
                <div class="table-wrapper">
                    
                    {{-- Table Card --}}
                    <div class="card has-actions has-filter">
                        <div class="card-header">
                            <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Bulk Actions
                                        </button>
                                        <div class="dropdown-menu">
                                            <button class="dropdown-item" id="bulk-delete" style="display: none;">Delete</button>
                                        </div>
                                    </div>

                                    <button class="btn btn-show-table-options" type="button">Filters</button>

                                    <div class="table-search-input">
                                        <label>
                                            <input type="search" class="form-control input-sm" id="table-search" placeholder="Search..." style="min-width: 120px" value="{{ request('search') }}">
                                        </label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                    <a href="{{ route('admin.shipments.export') }}" class="btn" data-bs-toggle="tooltip" title="Export">
                                        <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                        Export
                                    </a>

                                    <button class="btn" type="button" onclick="window.location.reload()">
                                        <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Reload
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="shipmentsTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Order ID">ORDER ID</th>
                                            <th title="Customer">CUSTOMER</th>
                                            <th title="Shipping Amount">SHIPPING AMOUNT</th>
                                            <th title="Warehouse">WAREHOUSE</th>
                                            <th title="Status" width="100" class="text-center">STATUS</th>
                                            <th title="COD Status" width="100" class="text-center">COD STATUS</th>
                                            <th title="Created At">CREATED AT</th>
                                            <th title="Operations" class="text-end">OPERATIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($shipments as $shipment)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $shipment->id }}">
                                            </td>
                                            <td class="text-center text-muted">{{ $shipment->id }}</td>
                                            <td>
                                                @if($shipment->order_id)
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" class="text-primary text-decoration-none">#SF-{{ str_pad($shipment->order_id, 8, '0', STR_PAD_LEFT) }}</a>
                                                        <a href="#" class="ms-1 text-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg>
                                                        </a>
                                                    </div>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($shipment->order && $shipment->order->user)
                                                    <div class="mb-1 text-dark">{{ $shipment->order->user->name }}</div>
                                                    <div class="mb-1"><a href="mailto:{{ $shipment->order->user->email }}" class="text-primary text-decoration-none">{{ $shipment->order->user->email }}</a></div>
                                                    @if($shipment->order->user->phone)
                                                    <div class="text-muted small">{{ $shipment->order->user->phone }}</div>
                                                    @endif
                                                @else
                                                    <div class="text-muted">Guest</div>
                                                @endif
                                            </td>
                                            <td>${{ number_format($shipment->price, 2) }}</td>
                                            <td>
                                                <span class="text-muted">{{ $shipment->store && $shipment->store->name ? $shipment->store->name : 'N/A' }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if(strtolower($shipment->status) == 'delivered')
                                                    <span class="badge bg-success text-success-fg">Delivered</span>
                                                @elseif(strtolower($shipment->status) == 'approved')
                                                    <span class="badge bg-warning text-warning-fg">Approved</span>
                                                @elseif(strtolower($shipment->status) == 'delivering')
                                                    <span class="badge bg-info text-info-fg">Delivering</span>
                                                @elseif(strtolower($shipment->status) == 'canceled')
                                                    <span class="badge bg-danger text-danger-fg">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($shipment->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(strtolower($shipment->cod_status) == 'completed')
                                                    <span class="badge bg-success text-success-fg">Completed</span>
                                                @elseif(strtolower($shipment->cod_status) == 'pending' || strtolower($shipment->cod_status) == 'not available')
                                                    <span class="badge bg-blue text-blue-fg">Not available</span>
                                                @else
                                                    <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($shipment->cod_status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $shipment->created_at->format('Y-m-d') }}</td>
                                            <td class="text-end">
                                                <div class="btn-group gap-1">
                                                    <a href="{{ route('admin.shipments.edit', $shipment->id) }}" class="btn btn-sm btn-primary btn-icon" title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger btn-icon delete-btn" data-id="{{ $shipment->id }}" data-url="{{ route('admin.shipments.destroy', $shipment->id) }}" title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">No records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ method_exists($shipments, 'firstItem') ? $shipments->firstItem() : 0 }} to {{ method_exists($shipments, 'lastItem') ? $shipments->lastItem() : 0 }} of {{ method_exists($shipments, 'total') ? $shipments->total() : $shipments->count() }} entries
                                </div>
                                {{ method_exists($shipments, 'links') ? $shipments->appends(request()->query())->links('pagination::bootstrap-5') : '' }}
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
        $(document).ready(function () {
            // Check all
            $('#check-all').on('change', function () {
                $('.bulk-checkbox').prop('checked', $(this).is(':checked'));
                updateBulkDeleteButton();
            });

            $(document).on('change', '.bulk-checkbox', function () {
                updateBulkDeleteButton();
            });

            function updateBulkDeleteButton() {
                let checkedCount = $('.bulk-checkbox:checked').length;
                if (checkedCount > 0) {
                    $('#bulk-delete').show().text(`Delete (${checkedCount})`);
                } else {
                    $('#bulk-delete').hide();
                }
            }

            // Individual Delete
            $(document).on('click', '.delete-btn', function () {
                let btn = $(this);
                let url = btn.data('url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (response) {
                                Swal.fire('Deleted!', 'Shipment has been deleted.', 'success').then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Bulk Delete
            $('#bulk-delete').on('click', function () {
                let ids = [];
                $('.bulk-checkbox:checked').each(function () {
                    ids.push($(this).val());
                });

                if(ids.length === 0) return;

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${ids.length} shipments!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.shipments.bulk_delete') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire('Deleted!', response.message, 'success').then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Live Search (client-side)
            let searchTimer;
            $('#table-search').on('keyup', function () {
                clearTimeout(searchTimer);
                let query = $(this).val().toLowerCase();
                searchTimer = setTimeout(function() {
                    $('#shipmentsTable tbody tr').each(function () {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(query) > -1);
                    });
                }, 300);
            });
        });
    </script>
@endpush
