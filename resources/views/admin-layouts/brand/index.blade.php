@extends('admin-layouts.app')
@section('title', 'Brand')
    @section('content')


            <div class="page-wrapper">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-arrows">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">DASHBOARD</a></li>
                                        <li class="breadcrumb-item"><a>ECOMMERCE</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><a>BRANDS</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="page-body page-content">
                    <div class="container-xl">


                        <div class="table-wrapper">
                            <div class="card mb-3 table-configuration-wrap" style="display: none;">
                                <div class="card-body">
                                    <button class="btn btn-icon  btn-sm btn-show-table-options rounded-pill" type="button">
                                        <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>

                                    </button>

                                    <div class="wrapper-filter">
                                        <p>Filters</p>

                                        <input type="hidden" class="filter-data-url" value="https://shofy-grocery.botble.com/admin/tables/filters" />

                                        <div class="sample-filter-item-wrap d-none">
                                            <div class="row filter-item form-filter">
                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-column-key" name="filter_columns[]">
                                                            <option value="" selected>Select field</option>
                                                            <option value="name">Name</option>
                                                            <option value="status">Status</option>
                                                            <option value="created_at">Created At</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                            <option value="like">Contains</option>
                                                            <option value="=" selected>Is equal to</option>
                                                            <option value="&gt;">Greater than</option>
                                                            <option value="&lt;">Less than</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-100 w-sm-25">
                                                    <span class="filter-column-value-wrap">
                                                        <input
                                                            class="form-control filter-column-value"
                                                            type="text"
                                                            placeholder="Value"
                                                            name="filter_values[]"
                                                        >
                                                    </span>
                                                </div>

                                                <div class="col">
                                                    <button class="btn btn-icon btn-remove-filter-item mb-3 text-danger" type="button" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <form method="GET" action="{{ route('admin.brand.Index') }}" accept-charset="UTF-8" class="filter-form">
                                            <div class="filter_list inline-block filter-items-wrap">
                                                <div class="row filter-item form-filter filter-item-default">
                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-column-key" name="filter_columns[]">
                                                                <option value="" selected>Select field</option>
                                                                <option value="name">Name</option>
                                                                <option value="status">Status</option>
                                                                <option value="created_at">Created At</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                                <option value="like">Contains</option>
                                                                <option value="=" selected>Is equal to</option>
                                                                <option value="&gt;">Greater than</option>
                                                                <option value="&lt;">Less than</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-100 w-sm-25">
                                                        <div class="filter-column-value-wrap mb-3">
                                                            <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-list">
                                                <button class="btn   add-more-filter" type="button">

                                                    Add additional filter

                                                </button>
                                                <button class="btn btn-primary  btn-apply" type="submit">

                                                    Apply

                                                </button>
                                                <a class="btn btn-icon   w-6" style="display: none;" type="button" href="{{ route('admin.brand.Index') }}" data-bb-toggle="datatable-reset-filter">
                                                    <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                                    </svg>

                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card has-actions has-filter">
                                <div class="card-header border-bottom-0 pb-0">
                                    <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                             <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" id="bulkActionsBtn">
                                                    Bulk Actions
                                                </button>
                                                <div class="dropdown-menu shadow-sm">
                                                    <div class="dropdown-submenu">
                                                        <a class="dropdown-item dropdown-toggle d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                                            Bulk changes
                                                            <i class="fas fa-chevron-right ms-2 small opa-5"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end shadow-sm submenu-nested">
                                                            <button class="dropdown-item bulk-change-item" data-key="name">Name</button>
                                                            <button class="dropdown-item bulk-change-item" data-key="status">Status</button>
                                                            <button class="dropdown-item bulk-change-item" data-key="created_at">Created At</button>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger d-flex align-items-center" href="javascript:void(0)" id="bulkDeleteBtn">
                                                        <i class="fas fa-trash me-2"></i> Delete
                                                    </a>
                                                </div>
                                            </div>

                                            <button class="btn btn-light btn-show-table-options" type="button">
                                                Filters
                                            </button>

                                            <div class="table-search-input">
                                                <form action="{{ route('admin.brand.Index') }}" method="GET">
                                                    <div class="input-group input-group-flat">
                                                        <input type="text" name="search" class="form-control ps-2" placeholder="Search..." value="{{ request('search') }}">
                                                        <span class="input-group-text px-2">
                                                            <i class="fas fa-search text-muted"></i>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('admin.brand.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                                                <i class="fas fa-plus"></i>
                                                <span>Create</span>
                                            </a>
                                            <button class="btn btn-light d-flex align-items-center gap-1" onclick="location.reload()">
                                                <i class="fas fa-sync-alt"></i>
                                                <span>Reload</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-table">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-hover datatable" id="myTable">
                                            <thead>
                                                <tr>
                                                    <th width="40" class="text-center"><input type="checkbox" class="form-check-input" id="checkAll"></th>
                                                    <th width="40" class="text-secondary text-uppercase fs-6">ID <i class="fas fa-sort-amount-up ms-1 small opa-5"></i></th>
                                                    <th width="80" class="text-secondary text-uppercase fs-6">LOGO</th>
                                                    <th class="text-secondary text-uppercase fs-6">NAME <i class="fas fa-sort-amount-up ms-1 small opa-5"></i></th>
                                                    <th width="120" class="text-secondary text-uppercase fs-6">IS FEATURED</th>
                                                    <th width="150" class="text-secondary text-uppercase fs-6 text-center">CREATED AT</th>
                                                    <th width="120" class="text-secondary text-uppercase fs-6 text-center">STATUS</th>
                                                    <th width="100" class="text-center text-secondary text-uppercase fs-6">OPERATIONS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($brands))
                                                    @foreach($brands as $brand)
                                                    <tr>
                                                        <td class="text-center"><input type="checkbox" class="form-check-input row-checkbox" value="{{ $brand->id }}"></td>
                                                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                                       <td>
                                                            <div class="brand-logo-wrap p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                                <img src="{{ $brand->logo ? asset($brand->logo) : asset('img/noimg.png') }}"
                                                                     onerror="this.src='{{ asset('img/noimg.png') }}'"
                                                                     alt="{{ $brand->name }}" class="img-fluid" style="max-height: 100%;">
                                                            </div>
                                                        </td>

                                                        <td><a href="{{ route('admin.brand.edit', $brand) }}" class="text-primary text-decoration-none fw-medium">{{ $brand->name }}</a></td>
                                                        <td>
                                                            <span class="badge {{ $brand->is_featured === 1 ? 'bg-success text-success-fg' : 'bg-danger text-danger-fg' }} rounded-pill px-3">
                                                                {{ $brand->is_featured == 1 ? "Yes" : "No" }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center text-muted small">{{ $brand->created_at }}</td>
                                                        <td class="text-center">
                                                            <span class="badge {{ $brand->status == 'published' ? 'bg-success text-success-fg' : 'bg-danger text-danger-fg' }} rounded-pill px-2">
                                                                {{ ucwords($brand->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center no-column-visibility text-nowrap">
                                                            <div class="d-flex justify-content-center gap-1">
                                                                <a href="{{ route('admin.brand.edit', $brand) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" title="Edit">
                                                                    <svg class="icon fs-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415"></path>
                                                                        <path d="M16 5l3 3"></path>
                                                                    </svg>
                                                                </a>
                                                                <button type="button" onclick="deleteBrand({{ $brand->id }})" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Delete">
                                                                    <svg class="icon fs-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M4 7l16 0"></path>
                                                                        <path d="M10 11l0 6"></path>
                                                                        <path d="M14 11l0 6"></path>
                                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex align-items-center border-top-0 pt-0">
                                        <p class="m-0 text-muted small">Show from 1 to {{ count($brands) }} in <span class="badge bg-secondary text-white rounded-pill px-2">{{ count($brands) }}</span> records</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>



@endsection
@push('styles')
<style>
    .breadcrumb-arrows .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 11px;
        font-weight: 600;
    }
    .breadcrumb-item.active a {
        color: #6c7a91;
    }
    .table thead th {
        background: #f8f9fa;
        border-top: none;
        border-bottom: 1px solid #e6e8e9;
        color: #6c7a91;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .datatable tr td {
        border-bottom: 1px solid #f1f1f1;
        padding: 12px 8px;
    }
    .badge.rounded-pill {
        font-weight: 500;
        padding: 4px 10px;
    }
    .bg-success {
        background-color: #2fb344 !important;
        color: #fff !important;
    }
    .bg-danger {
        background-color: #d63939 !important;
        color: #fff !important;
    }
    .opa-5 { opacity: 0.5; }
    .table-search-input .input-group-flat .form-control {
        border-radius: 4px 0 0 4px;
        min-width: 250px;
    }
    .table-search-input .input-group-flat .input-group-text {
        border-radius: 0 4px 4px 0;
        background: white;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
        color: #182433;
    }
    .brand-logo-wrap {
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Nested Submenu Fix */
    .dropdown-submenu {
        position: relative;
    }
    .dropdown-submenu .submenu-nested {
        top: 0;
        left: 100%;
        margin-top: -1px;
        display: none;
        position: absolute;
    }
    .dropdown-submenu:hover > .submenu-nested {
        display: block;
    }
    .table-responsive {
        overflow: visible !important; /* Allow dropdown to overflow the table */
    }
    .card-table {
        overflow: visible !important;
    }
</style>
@endpush
@push('scripts')
<script>
$(document).ready(function() {
    // CSRF for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Toggle Filters
    $('.btn-show-table-options').on('click', function() {
        $('.table-configuration-wrap').slideToggle();
    });

    // Add more filter
    $('.add-more-filter').on('click', function() {
        var html = $('.sample-filter-item-wrap').html();
        $('.filter-items-wrap').append(html);
    });

    // Remove filter
    $(document).on('click', '.btn-remove-filter-item', function() {
        $(this).closest('.filter-item').remove();
    });

    // Reset filter
    $('[data-bb-toggle="datatable-reset-filter"]').on('click', function(e) {
        e.preventDefault();
        window.location.href = "{{ route('admin.brand.Index') }}";
    });

    // Check All
    $('#checkAll').on('change', function() {
        $('.row-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Bulk Delete
    $('#bulkDeleteBtn').on('click', function(e) {
        e.preventDefault();
        var ids = [];
        $('.row-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            Swal.fire('Error', 'Please select at least one brand.', 'error');
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete " + ids.length + " selected brands?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete them!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.brand.bulk-delete') }}",
                    type: 'POST',
                    data: {
                        ids: ids
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });

    // Bulk Change
    $('.bulk-change-item').on('click', function() {
        var key = $(this).data('key');
        var ids = [];
        $('.row-checkbox:checked').each(function() {
            ids.push($(this).val());
        });

        if (ids.length === 0) {
            Swal.fire('Error', 'Please select at least one brand.', 'error');
            return;
        }

        var inputHtml = '';
        var title = '';
        if (key === 'status') {
            title = 'Update Status';
            inputHtml = '<select id="bulk_value" class="form-select"><option value="published">Published</option><option value="draft">Draft</option><option value="pending">Pending</option></select>';
        } else if (key === 'name') {
            title = 'Update Name';
            inputHtml = '<input type="text" id="bulk_value" class="form-control" placeholder="Enter new name">';
        } else if (key === 'created_at') {
            title = 'Update Created At';
            inputHtml = '<input type="datetime-local" id="bulk_value" class="form-control">';
        }

        Swal.fire({
            title: title,
            html: '<div class="mb-3 text-start"><label class="form-label">Select Value</label>' + inputHtml + '</div>',
            showCancelButton: true,
            confirmButtonText: 'Apply Change',
            preConfirm: () => {
                const value = document.getElementById('bulk_value').value;
                if (!value && value !== '0') {
                    Swal.showValidationMessage('Please select a value');
                }
                return value;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.brand.bulk-change') }}",
                    type: 'POST',
                    data: {
                        ids: ids,
                        column: key,
                        value: result.value
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Updated!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });
});


        function deleteBrand(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this Brand?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '{{ route("admin.brand.Delete") }}',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id: id },

                    {{--  beforeSend: function() {
                        Swal.fire({
                            title: 'Deleting...',
                            didOpen: () => Swal.showLoading(),
                            allowOutsideClick: false
                        });
                    },  --}}
                    success: function(res) {
                        Swal.close();

                        if (res.status === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: res.message
                            }).then(() => {
                                window.location.href = "{{ route('admin.brand.Index') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong!'
                            });
                        }
                    },

                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!'
                        });
                    }
                });

            } else {
                notify('Delete cancelled', 'info');
            }
        });
    }

</script>
@endpush
