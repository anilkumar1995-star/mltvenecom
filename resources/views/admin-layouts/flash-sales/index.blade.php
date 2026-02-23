@extends('admin-layouts.app')
@section('title', 'Flash Sales')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Flash Sales</h1>
                                    </li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                        </div>
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
                                <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="wrapper-filter">
                                <p>Filters</p>
                                <input type="hidden" class="filter-data-url"
                                    value="{{ route('admin.flash-sales.index') }}" />

                                <div class="sample-filter-item-wrap hidden">
                                    <div class="row filter-item form-filter">
                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-column-key" name="filter_columns[]"
                                                    id="filter_columns[]">
                                                    <option value="name">Name</option>
                                                    <option value="status">Status</option>
                                                    <option value="created_at">Created At</option>
                                                    <option value="end_date">End Date</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-operator filter-column-operator"
                                                    name="filter_operators[]" id="filter_operators[]">
                                                    <option value="like">Contains</option>
                                                    <option value="=">Is equal to</option>
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
                                            <button class="btn btn-icon   btn-remove-filter-item mb-3 text-danger"
                                                type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Delete">
                                                <svg class="icon icon-left svg-icon-ti-ti-trash"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
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

                                <form method="GET" action="{{ route('admin.flash-sales.index') }}"
                                    accept-charset="UTF-8" class="filter-form">
                                    <div class="filter_list inline-block filter-items-wrap">
                                        <div class="row filter-item form-filter filter-item-default">
                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-column-key" name="filter_columns[]"
                                                        id="filter_columns[]">
                                                        <option value="" selected>Select field</option>
                                                        <option value="name">Name</option>
                                                        <option value="status">Status</option>
                                                        <option value="created_at">Created At</option>
                                                        <option value="end_date">End Date</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-operator filter-column-operator"
                                                        name="filter_operators[]" id="filter_operators[]">
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
                                        <button class="btn   add-more-filter" type="button">

                                            Add additional filter

                                        </button>
                                        <button class="btn btn-primary  btn-apply" type="submit">

                                            Apply

                                        </button>
                                        <a class="btn btn-icon   w-6" style="display: none;" type="button"
                                            href="{{ route('admin.flash-sales.index') }}"
                                            data-bb-toggle="datatable-reset-filter">
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
                        <div class="card-header">
                            <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                    <div class="dropdown d-inline-block">
                                        <button class="btn   dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                            Bulk Actions

                                        </button>

                                        <div class="dropdown-menu">
                                            <form action="{{ route('admin.flash-sales.destroy', ['id' => 0]) }}" method="POST" id="bulk-delete-form" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="ids" id="bulk-delete-ids">
                                            </form>
                                            <a class="dropdown-item"
                                                href="#"
                                                id="bulk-delete"
                                                data-confirmation-modal-title="Confirm to perform this action"
                                                data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone."
                                                data-confirmation-modal-button="Delete"
                                                data-confirmation-modal-cancel-button="Cancel">

                                                Delete

                                            </a>
                                        </div>
                                    </div>

                                    <button class="btn   btn-show-table-options" type="button">
                                        Filters
                                    </button>

                                    <div class="table-search-input">
                                        <label>
                                            <input type="search" class="form-control input-sm" placeholder="Search..."
                                                style="min-width: 120px">
                                        </label>
                                    </div>
                                </div>
                                <div
                                    class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                    
                                    <div class="dropdown d-inline-block">
                                        <button
                                            class="btn btn-primary dropdown-toggle d-flex align-items-center"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 5v14" />
                                                <path d="M5 12h14" />
                                            </svg>
                                            Create
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a
                                                    href="{{ route('admin.flash-sales.create') }}"
                                                    class="dropdown-item d-flex align-items-center"
                                                >
                                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg"
                                                        width="18" height="18" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M12 3l8 4.5v9l-8 4.5-8-4.5v-9z"/>
                                                        <path d="M12 12l8-4.5"/>
                                                        <path d="M12 12v9"/>
                                                        <path d="M12 12l-8-4.5"/>
                                                    </svg>
                                                    Flash Sale
                                                </a>
                                            </li>

                                        </ul>
                                    </div>

                                    <button class="btn" type="button" data-bb-toggle="dt-buttons"
                                        data-bb-target=".buttons-reload" tabindex="0"
                                        aria-controls="botble-ecommerce-tables-product-table">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
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
                                <table class="table card-table table-vcenter table-hover datatable" id="myTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox"><input
                                                    class="form-check-input m-0 align-middle table-check-all"
                                                    data-set=".dataTable .checkboxes" name="" type="checkbox">
                                            </th>
                                            <th title="ID" width="20"
                                                class="text-center no-column-visibility column-key-0">ID</th>
                                            <th title="Name" class="text-start column-key-1">Name</th>
                                            <th title="End Date" class="text-start column-key-2">End Date</th>
                                            <th title="Products" class="text-start column-key-3">Products</th>
                                            <th title="Created At" width="100" class="column-key-4">Created At</th>
                                            <th title="Status" width="100" class="text-center column-key-5">Status</th>
                                            <th title="Operations">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($flashSales as $item)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.flash-sales.edit', $item->id) }}" class="fw-bold text-decoration-none text-dark">{{ $item->name }}</a>
                                        </td>
                                        <td>{{ $item->end_date->format('Y-m-d') }}</td>
                                        <td>{{ $item->products_count ?? $item->products->count() }}</td>
                                        <td>{{ $item->created_at ? $item->created_at->format('M d, Y') : '' }}</td>
                                        <td>
                                            <span class="badge {{ $item->status == 'published' ? 'badge bg-success text-success-fg' : ($item->status == 'draft' ? 'badge bg-secondary text-secondary-fg' : 'bg-warning') }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                    
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.flash-sales.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.flash-sales.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>
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
                // Check all functionality
                $('#check-all').on('change', function () {
                    $('.bulk-checkbox').prop('checked', $(this).is(':checked'));
                });

                // Individual Delete
                $(document).on('click', '.delete-btn', function () {
                    let btn = $(this);
                    let form = btn.closest('form');

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
                            form.submit();
                        }
                    });
                });
                
                // Toggle filters
                $('.btn-show-table-options').on('click', function() {
                    $('.table-configuration-wrap').slideToggle();
                });
            });
        </script>
    @endpush
