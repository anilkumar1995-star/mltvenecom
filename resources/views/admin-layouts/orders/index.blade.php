@extends('admin-layouts.app')
@section('title', 'Orders')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Orders</h1>
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
                    {{-- Filter Panel --}}
                    <div class="card mb-3 table-configuration-wrap" style="display: none;">
                        <div class="card-body">
                            <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
                                <svg class="icon icon-sm icon-left" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="wrapper-filter">
                                <p>Filters</p>
                                <input type="hidden" class="filter-data-url" value="{{ route('admin.orders.index') }}" />

                                <div class="sample-filter-item-wrap hidden">
                                    <div class="row filter-item form-filter">
                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-column-key" name="filter_columns[]">
                                                    <option value="id">ID</option>
                                                    <option value="status">Status</option>
                                                    <option value="payment_method">Payment Method</option>
                                                    <option value="payment_status">Payment Status</option>
                                                    <option value="amount">Amount</option>
                                                    <option value="created_at">Created At</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                    <option value="like">Contains</option>
                                                    <option value="=">Is equal to</option>
                                                    <option value="&gt;">Greater than</option>
                                                    <option value="&lt;">Less than</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto w-100 w-sm-25">
                                            <span class="filter-column-value-wrap">
                                                <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]">
                                            </span>
                                        </div>

                                        <div class="col">
                                            <button class="btn btn-icon btn-remove-filter-item mb-3 text-danger" type="button" data-bs-toggle="tooltip" title="Delete">
                                                <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <form method="GET" action="{{ route('admin.orders.index') }}" accept-charset="UTF-8" class="filter-form">
                                    <div class="filter_list inline-block filter-items-wrap">
                                        <div class="row filter-item form-filter filter-item-default">
                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-column-key" name="filter_columns[]">
                                                        <option value="" selected>Select field</option>
                                                        <option value="id" {{ request('filter_columns.0') == 'id' ? 'selected' : '' }}>ID</option>
                                                        <option value="status" {{ request('filter_columns.0') == 'status' ? 'selected' : '' }}>Status</option>
                                                        <option value="payment_method" {{ request('filter_columns.0') == 'payment_method' ? 'selected' : '' }}>Payment Method</option>
                                                        <option value="payment_status" {{ request('filter_columns.0') == 'payment_status' ? 'selected' : '' }}>Payment Status</option>
                                                        <option value="amount" {{ request('filter_columns.0') == 'amount' ? 'selected' : '' }}>Amount</option>
                                                        <option value="created_at" {{ request('filter_columns.0') == 'created_at' ? 'selected' : '' }}>Created At</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                        <option value="like">Contains</option>
                                                        <option value="=" selected>Is equal to</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-auto w-100 w-sm-25">
                                                <div class="filter-column-value-wrap mb-3">
                                                    <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]" value="{{ request('filter_values.0') }}">
                                                </div>
                                            </div>

                                            <div class="col"></div>
                                        </div>
                                    </div>
                                    <div class="btn-list">
                                        <button class="btn add-more-filter" type="button">Add additional filter</button>
                                        <button class="btn btn-primary btn-apply" type="submit">Apply</button>
                                        <a class="btn btn-icon w-6" style="{{ request()->has('filter_columns') ? '' : 'display: none;' }}" type="button" href="{{ route('admin.orders.index') }}" data-bb-toggle="datatable-reset-filter">
                                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                            </svg>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
                                    <a href="#" class="btn" data-bs-toggle="tooltip" title="Export">
                                        <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                        Export
                                    </a>
                                    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary d-flex align-items-center">
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5v14" />
                                            <path d="M5 12h14" />
                                        </svg>
                                        Create
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
                                <table class="table card-table table-vcenter table-hover datatable" id="ordersTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Email">Email</th>
                                            <th title="Amount">Amount</th>
                                            <th title="Payment method">Payment method</th>
                                            <th title="Payment status" width="130" class="text-center">Payment status</th>
                                            <th title="Status" width="120" class="text-center">Status</th>
                                            <th title="Tax amount">Tax amount</th>
                                            <th title="Shipping amount">Shipping amount</th>
                                            <th title="Operations" class="text-end">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $order->id }}">
                                            </td>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td>
                                                @if($order->user)
                                                    <div>{{ $order->user->name }}</div>
                                                    <div class="text-muted small">{{ $order->user->email }}</div>
                                                    @if($order->user->phone)
                                                        <div class="text-muted small">{{ $order->user->phone }}</div>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Guest</span>
                                                @endif
                                            </td>
                                            <td>₹{{ number_format($order->amount, 2) }}</td>
                                            <td>{{ $order->payment ? ucfirst(str_replace('_', ' ', $order->payment->payment_channel ?? 'N/A')) : 'N/A' }}</td>
                                            <td class="text-center">
                                                @php $payStatus = $order->payment->status ?? 'N/A'; @endphp
                                                @if($payStatus == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($payStatus == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($payStatus == 'refunded')
                                                    <span class="badge bg-info text-white">Refunded</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($payStatus) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($order->status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($order->status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge bg-info text-white">Processing</span>
                                                @elseif($order->status == 'canceled')
                                                    <span class="badge bg-danger text-white">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($order->status) }}</span>
                                                @endif
                                            </td>
                                            <td>₹{{ number_format($order->tax_amount, 2) }}</td>
                                            <td>₹{{ number_format($order->shipping_amount, 2) }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $order->id }}" data-url="{{ route('admin.orders.destroy', $order->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">No orders found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Toggle Filter
            $('.btn-show-table-options').on('click', function() {
                $('.table-configuration-wrap').slideToggle();
            });

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
                                    'Order has been deleted.',
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
                    text: `You are about to delete ${ids.length} orders!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.orders.bulk_delete') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Deleted!',
                                        response.message,
                                        'success'
                                    ).then(() => {
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
                    $('#ordersTable tbody tr').each(function () {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(query) > -1);
                    });
                }, 300);
            });

            // Add more filter
            $('.add-more-filter').on('click', function() {
                let template = $('.sample-filter-item-wrap').html();
                $('.filter-items-wrap').append(template);
            });

            // Remove filter item
            $(document).on('click', '.btn-remove-filter-item', function() {
                $(this).closest('.filter-item').remove();
            });
        });
    </script>
@endpush
