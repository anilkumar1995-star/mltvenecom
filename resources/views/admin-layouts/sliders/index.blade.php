@extends('admin-layouts.app')
@section('title', 'Simple Sliders')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-arrows">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>SIMPLE SLIDERS</a></li>
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
                        <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
                            <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6l-12 12" />
                                <path d="M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="wrapper-filter">
                            <p>Filters</p>
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
                                            <select class="form-select filter-operator filter-column-operator"
                                                name="filter_operators[]">
                                                <option value="like">Contains</option>
                                                <option value="=" selected>Is equal to</option>
                                                <option value="&gt;">Greater than</option>
                                                <option value="&lt;">Less than</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-auto w-100 w-sm-25">
                                        <span class="filter-column-value-wrap">
                                            <input class="form-control filter-column-value" type="text"
                                                placeholder="Value" name="filter_values[]">
                                        </span>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-icon btn-remove-filter-item mb-3 text-danger"
                                            type="button" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <form method="GET" action="{{ route('admin.simple-sliders.index') }}" accept-charset="UTF-8"
                                class="filter-form">
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
                                                <select class="form-select filter-operator filter-column-operator"
                                                    name="filter_operators[]">
                                                    <option value="like">Contains</option>
                                                    <option value="=" selected>Is equal to</option>
                                                    <option value="&gt;">Greater than</option>
                                                    <option value="&lt;">Less than</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-auto w-100 w-sm-25">
                                            <div class="filter-column-value-wrap mb-3">
                                                <input class="form-control filter-column-value" type="text"
                                                    placeholder="Value" name="filter_values[]" value="">
                                            </div>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-list">
                                    <button class="btn add-more-filter" type="button">Add additional filter</button>
                                    <button class="btn btn-primary btn-apply" type="submit">Apply</button>
                                    <a class="btn btn-icon w-6" style="display: none;" type="button"
                                        href="{{ route('admin.simple-sliders.index') }}" data-bb-toggle="datatable-reset-filter">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
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
                                    <button class="btn btn-light dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" id="bulkActionsBtn">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu shadow-sm">
                                        <div class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle d-flex align-items-center justify-content-between"
                                                href="javascript:void(0)">
                                                Bulk changes
                                                <i class="fas fa-chevron-right ms-2 small opa-5"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end shadow-sm submenu-nested">
                                                <button class="dropdown-item bulk-change-item" data-key="name">Name</button>
                                                <button class="dropdown-item bulk-change-item" data-key="status">Status</button>
                                            </div>
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger d-flex align-items-center"
                                            href="javascript:void(0)" id="bulkDeleteBtn">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </a>
                                    </div>
                                </div>

                                <button class="btn btn-light btn-show-table-options" type="button">
                                    Filters
                                </button>

                                <div class="table-search-input ms-2">
                                    <form action="{{ route('admin.simple-sliders.index') }}" method="GET">
                                        <div class="input-icon" style="min-width: 250px;">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search..." value="{{ request('search') }}">
                                            <span class="input-icon-addon">
                                                <i class="fas fa-search text-muted opacity-50"></i>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.simple-sliders.create') }}"
                                    class="btn btn-primary d-flex align-items-center gap-1">
                                    <i class="fas fa-plus"></i>
                                    <span>Create</span>
                                </a>
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <img src="{{ asset('flags/us.svg') }}" alt="English" style="width: 16px; margin-right: 5px;"> Language
                                    </button>
                                    <div class="dropdown-menu shadow-sm">
                                        <a href="#" class="dropdown-item"><img src="{{ asset('flags/us.svg') }}" style="width: 16px; margin-right: 5px;"> English</a>
                                    </div>
                                </div>
                                <button class="btn btn-light d-flex align-items-center gap-1"
                                    onclick="location.reload()">
                                    <i class="fas fa-sync-alt"></i>
                                    <span>Reload</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-table mt-3">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="postsTable">
                                <thead>
                                    <tr>
                                        <th width="40" class="text-center"><input type="checkbox"
                                                class="form-check-input" id="checkAll"></th>
                                        <th width="80" class="text-secondary text-uppercase fs-6">ID</th>
                                        <th class="text-secondary text-uppercase fs-6">NAME</th>
                                        <th class="text-secondary text-uppercase fs-6">SHORTCODE</th>
                                        <th width="150" class="text-secondary text-uppercase fs-6 text-center">CREATED AT</th>
                                        <th width="120" class="text-secondary text-uppercase fs-6 text-center">STATUS</th>
                                        <th width="100" class="text-center text-secondary text-uppercase fs-6">
                                            OPERATIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($sliders) && count($sliders) > 0)
                                    @foreach($sliders as $slider)
                                    <tr>
                                        <td class="text-center"><input type="checkbox"
                                                class="form-check-input row-checkbox" value="{{ $slider->id }}"></td>
                                        <td class="text-muted text-center" style="padding-left: 15px;">{{ $slider->id }}</td>
                                        <td><a href="{{ route('admin.simple-sliders.edit', $slider) }}"
                                                class="text-primary text-decoration-none fw-medium">{{ $slider->name
                                                }}</a></td>
                                        <td>
                                            <code>[simple-slider alias="{{ $slider->key }}"][/simple-slider]</code>
                                            <a href="javascript:void(0)" class="ms-1 text-muted fs-5"><i class="far fa-copy"></i></a>
                                        </td>
                                        <td class="text-center text-muted small fw-medium">{{ $slider->created_at ? $slider->created_at->format('Y-m-d') : '' }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge {{ $slider->status == 'published' ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }} px-2 py-1">
                                                {{ ucwords($slider->status) }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <div class="table-actions d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.simple-sliders.edit', $slider) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-title="Edit">
                                                    <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>            
                                                    <span class="sr-only">Edit</span>
                                                </a>
                                                <button type="button" onclick="deleteSlider({{ $slider->id }})" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" data-bs-title="Delete">
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
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">No records found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center border-top-0 pt-0 mt-3 pb-3">
                            <p class="m-0 text-muted small d-flex align-items-center gap-1">
                                <i class="fas fa-globe text-muted opacity-50"></i> Show from 1 to {{ count($sliders) }} in <span class="badge bg-secondary text-white rounded-pill px-2 py-1 mx-1">{{ count($sliders) }}</span> records
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
<style>
    .breadcrumb-arrows .breadcrumb-item+.breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
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
    .bg-secondary {
        background-color: #6c7a91 !important;
        color: #fff !important;
    }
    .bg-danger {
        background-color: #d63939 !important;
        color: #fff !important;
    }
    .opa-5 { opacity: 0.5; }
    .table-search-input .input-icon .form-control {
        border-radius: 4px;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
        color: #182433;
    }
    .dropdown-submenu { position: relative; }
    .dropdown-submenu .submenu-nested {
        top: 0; left: 100%; margin-top: -1px; display: none; position: absolute;
    }
    .dropdown-submenu:hover>.submenu-nested { display: block; }
    .table-responsive { overflow: visible !important; }
    .card-table { overflow: visible !important; }
    code { 
        background: #f1f3f5; padding: 4px 8px; border-radius: 4px; color: #6c7a91; font-size: 13px; font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('.btn-show-table-options').on('click', function() {
            $('.table-configuration-wrap').slideToggle();
        });

        $('#checkAll').on('change', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });

        $('#bulkDeleteBtn').on('click', function(e) {
            e.preventDefault();
            var ids = [];
            $('.row-checkbox:checked').each(function() { ids.push($(this).val()); });
            
            if (ids.length === 0) {
                Swal.fire('Error', 'Please select at least one record.', 'error');
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + ids.length + " selected records?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.simple-sliders.bulk-delete') }}",
                        type: 'POST',
                        data: { ids: ids },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('Deleted!', response.message, 'success').then(() => { location.reload(); });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        }
                    });
                }
            });
        });
    });

    function deleteSlider(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this Simple Slider?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/simple-sliders") }}/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire({ icon: 'success', title: 'Deleted!', text: res.message }).then(() => { location.reload(); });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                        }
                    }
                });
            }
        });
    }
</script>
@endpush
