@extends('admin-layouts.app')
@section('title', 'Invoices')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Invoices</h1>
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
                                        <button class="dropdown-item text-danger" id="bulk-delete" style="display: none;">Delete</button>
                                    </div>
                                </div>

                                <button class="btn btn-show-table-options" type="button">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>
                                    Filters
                                </button>

                                <div class="table-search-input">
                                    <label>
                                        <input type="search" class="form-control input-sm" id="table-search" placeholder="Search..." style="min-width: 120px" value="{{ request('search') }}">
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                <button class="btn btn-primary invoice-generate" data-action="{{ route('admin.invoices.generate') }}" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                                    Generate Invoices
                                </button>
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
                            <table class="table card-table table-vcenter table-hover datatable" id="invoicesTable">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">
                                        <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" aria-label="Select all invoices">
                                    </th>
                                    <th title="ID" width="50" class="text-start">ID</th>
                                    <th title="Name" class="text-start">Name</th>
                                    <th title="Order" class="text-start">Order</th>
                                    <th title="Code" class="text-start">Code</th>
                                    <th title="Amount" class="text-start">Amount</th>
                                    <th title="Created at" class="text-start">Created At</th>
                                    <th title="Status" width="120" class="text-center">Status</th>
                                    <th title="Operations" class="text-end">Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($invoices as $invoice)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $invoice->id }}">
                                        </td>
                                        <td class="text-start">{{ $invoice->id }}</td>
                                        <td class="text-start">
                                            <div>{{ $invoice->customer_name }}</div>
                                            @if($invoice->customer_email)
                                            <div class="text-muted"><small>{{ $invoice->customer_email }}</small></div>
                                            @endif
                                        </td>
                                        <td class="text-start">
                                            <a href="#" class="text-decoration-none">#SF-100000{{ $invoice->reference_id }}</a>
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}">{{ $invoice->code }}</a>
                                        </td>
                                        <td class="text-start">${{ number_format($invoice->amount, 2) }}</td>
                                        <td class="text-start">{{ $invoice->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            @if($invoice->status == 'completed')
                                                <span class="badge bg-success text-white">Completed</span>
                                            @elseif($invoice->status == 'pending')
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif($invoice->status == 'canceled')
                                                <span class="badge bg-danger text-white">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ ucfirst($invoice->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="table-actions">
                                                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-title="Edit">
                                                    <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>            
                                                    <span class="sr-only">Edit</span>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger delete-btn delete-item" data-id="{{ $invoice->id }}" data-action="{{ route('admin.invoices.destroy', $invoice->id) }}" data-bs-toggle="tooltip" data-bs-title="Delete" data-confirmation-modal="true" data-confirmation-modal-title="Confirm delete" data-confirmation-modal-message="Do you really want to delete this record?" data-confirmation-modal-button="Delete" data-confirmation-modal-cancel-button="Cancel">
                                                    <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>            
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No invoices found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ method_exists($invoices, 'firstItem') ? $invoices->firstItem() : 0 }} to {{ method_exists($invoices, 'lastItem') ? $invoices->lastItem() : 0 }} of {{ method_exists($invoices, 'total') ? $invoices->total() : $invoices->count() }} entries
                            </div>
                            {{ method_exists($invoices, 'links') ? $invoices->appends(request()->query())->links('pagination::bootstrap-5') : '' }}
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
                                Swal.fire('Deleted!', 'Invoice has been deleted.', 'success').then(() => {
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
                    text: `You are about to delete ${ids.length} invoices!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            // Note: Add a bulk delete route in web.php if needed, or use a placeholder for now
                            url: "{{ url('admin/invoices/bulk-delete') }}", 
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function (response) {
                                if (response.success || response) {
                                    Swal.fire('Deleted!', 'Invoices have been deleted.', 'success').then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('Error!', response.message || 'Something went wrong.', 'error');
                                }
                            },
                            error: function(xhr) {
                                // Fallback just in case route doesn't exist yet
                                Swal.fire('Error!', 'Bulk delete endpoint not available or an error occurred.', 'error');
                            }
                        });
                    }
                });
            });

            // Live Search (client-side implementation)
            let searchTimer;
            $('#table-search').on('keyup', function () {
                clearTimeout(searchTimer);
                let query = $(this).val().toLowerCase();
                searchTimer = setTimeout(function() {
                    $('#invoicesTable tbody tr').each(function () {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(query) > -1);
                    });
                }, 300);
            });
            // Generate Invoices Logic
            $('.invoice-generate').on('click', function () {
                let btn = $(this);
                let url = btn.data('action');
                let originalText = btn.html();

                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Generating...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        btn.prop('disabled', false).html(originalText);
                        if (response.success || response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message || 'Invoices generated successfully.',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message || 'Something went wrong.', 'error');
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html(originalText);
                        Swal.fire('Error!', 'Could not generate invoices. Please check your backend code.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
