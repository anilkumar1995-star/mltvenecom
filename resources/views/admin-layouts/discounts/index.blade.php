@extends('admin-layouts.app')
@section('title', 'Discounts')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <ol class="breadcrumb" aria-label="breadcrumbs">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Ecommerce</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Discounts</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="card mb-3">
                <div class="card-body py-3">
                    <div class="d-flex">
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                    Bulk Actions
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Delete</a>
                                </div>
                            </div>
                            <div class="input-icon">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                            </div>
                        </div>
                        <div class="ms-auto d-flex gap-2">
                            <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                Create
                            </a>
                            <a href="{{ route('admin.discounts.index') }}" class="btn btn-default">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1.002 7.935 1.007 9.425 4.747"></path>
                                   <path d="M20 4v5h-5"></path>
                                </svg>
                                Reload
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" id="check-all" aria-label="Select all invoices"></th>
                                <th class="w-1">ID</th>
                                <th>Detail</th>
                                <th>Used</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Store</th>
                                <th class="w-1">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($discounts as $discount)
                            <tr>
                                <td><input class="form-check-input m-0 align-middle bulk-checkbox" type="checkbox" value="{{ $discount->id }}" aria-label="Select invoice"></td>
                                <td>{{ $discount->id }}</td>
                                <td>
                                    @if($discount->type == 'coupon')
                                    <div class="p-2 rounded text-white" style="background-color: #206bc4; max-width: 350px;">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="fw-bold me-2">COUPON CODE: {{ $discount->code }}</span>
                                            <a href="javascript:void(0)" class="text-white text-decoration-none" onclick="navigator.clipboard.writeText('{{ $discount->code }}'); toastr.success('Copied!');" title="Copy">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-copy" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                   <path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
                                                   <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="mb-2">
                                            Discount 
                                            @if($discount->type_option == 'amount')
                                                ₹{{ number_format($discount->value, 2) }}
                                            @else
                                                {{ $discount->value }}%
                                            @endif
                                            for {{ str_replace('-', ' ', $discount->target) }}
                                        </div>
                                        @if(!$discount->can_use_with_promotion)
                                            <div class="text-warning fst-italic small">
                                                (Coupon code <strong>cannot</strong> be used with promotion).
                                            </div>
                                        @endif
                                    </div>
                                    @else
                                    <div class="p-2 rounded text-white" style="background-color: #6f42c1; max-width: 350px;">
                                        <div class="fw-bold mb-1 text-uppercase">Promotion: {{ $discount->title }}</div>
                                        <div class="mb-1">
                                            Discount 
                                            @if($discount->type_option == 'amount')
                                                ₹{{ number_format($discount->value, 2) }}
                                            @else
                                                {{ $discount->value }}%
                                            @endif
                                            for {{ str_replace('-', ' ', $discount->target) }}
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>{{ $discount->total_used ?? 0 }}</td>
                                <td>{{ $discount->start_date->format('Y-m-d') }}</td>
                                <td>
                                    @if($discount->end_date)
                                        {{ $discount->end_date->format('Y-m-d') }}
                                    @else
                                        Lifetime
                                    @endif
                                </td>
                                <td>
                                    @if($discount->store_id && $discount->store)
                                        {{ $discount->store->name }}
                                    @else
                                        Global
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-icon btn-primary btn-sm" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><line x1="13.5" y1="6.5" x2="17.5" y2="10.5" /></svg>
                                        </a>
                                        <form action="{{ route('admin.discounts.destroy', $discount->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger btn-sm" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Show from {{ $discounts->firstItem() ?? 0 }} to {{ $discounts->lastItem() ?? 0 }} in {{ $discounts->total() }} records</p>
                    <div class="ms-auto">
                         {{ $discounts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Check all functionality
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
                    $('#bulk-delete').removeClass('d-none').text(`Bulk Delete (${checkedCount})`);
                } else {
                    $('#bulk-delete').addClass('d-none');
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
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                     toastr.error('Failed to delete.');
                                }
                            },
                            error: function() {
                                toastr.error('An error occurred.');
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

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${ids.length} discounts!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.discounts.bulk_delete') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: ids
                            },
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: response.message,
                                        timer: 1500
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    toastr.error('Failed to delete selected items.');
                                }
                            },
                            error: function() {
                                toastr.error('An error occurred.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
