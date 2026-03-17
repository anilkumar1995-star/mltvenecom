@extends('admin-layouts.app')
@section('title', 'Order Returns')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Order Returns</h1>
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
                                    <a href="{{ route('admin.order-returns.export') }}" class="btn" data-bs-toggle="tooltip" title="Export">
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
                                <table class="table card-table table-vcenter table-hover datatable" id="returnsTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Order ID">Order ID</th>
                                            <th title="Customer">Customer</th>
                                            <th title="Reason">Reason</th>
                                            <th title="Status" width="120" class="text-center">Status</th>
                                            <th title="Created At">Created At</th>
                                            <th title="Operations" class="text-end">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($returns as $return)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $return->id }}">
                                            </td>
                                            <td class="text-center">{{ $return->id }}</td>
                                            <td>
                                                @if($return->order)
                                                    <a href="#">#{{ $return->order->id }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($return->user)
                                                    <a href="{{ route('admin.customers.edit', $return->user->id) }}">{{ $return->user->name }}</a>
                                                @else
                                                    Guest
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($return->reason, 50) }}</td>
                                            <td class="text-center">
                                                @if($return->return_status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($return->return_status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($return->return_status == 'canceled')
                                                    <span class="badge bg-danger text-white">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($return->return_status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $return->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $return->id }}" data-url="{{ route('admin.order-returns.destroy', $return->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ method_exists($returns, 'firstItem') ? $returns->firstItem() : 0 }} to {{ method_exists($returns, 'lastItem') ? $returns->lastItem() : 0 }} of {{ method_exists($returns, 'total') ? $returns->total() : $returns->count() }} entries
                                </div>
                                {{ method_exists($returns, 'links') ? $returns->appends(request()->query())->links('pagination::bootstrap-5') : '' }}
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
                                Swal.fire(
                                    'Deleted!',
                                    'Return request has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
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
                    text: `You are about to delete ${ids.length} return requests!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.order-returns.bulk_delete') }}",
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
                    $('#returnsTable tbody tr').each(function () {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(query) > -1);
                    });
                }, 300);
            });
        });
    </script>
@endpush
