@extends('admin-layouts.app')
@section('title', 'Marketplace Store')
@section('content')

            <div class="page-wrapper">
                <div class="page-header d-print-none">
                    <div class="container-xl">
                        <div class="row g-2 align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li
                                                class="breadcrumb-item">
                                                <a
                                                    class="mb-0 d-inline-block fs-6 lh-1"
                                                    href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                            </li>
                                            <li
                                                class="breadcrumb-item">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Marketplace</h1>
                                            </li>
                                            <li
                                                class="breadcrumb-item active"
                                                aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Stores</h1>
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
                                    <button
                                        class="btn btn-icon  btn-sm btn-show-table-options rounded-pill" type="button">
                                        <svg class="icon icon-sm  icon-left svg-icon-ti-ti-x"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>

                                    </button>

                                    <div class="wrapper-filter">
                                        <p>Filters</p>

                                        <input
                                            type="hidden"
                                            class="filter-data-url"
                                            value="https://shofy-grocery.botble.com/admin/tables/filters" />

                                        <div class="sample-filter-item-wrap hidden">
                                            <div class="row filter-item form-filter">
                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                            <option
                                                                value="name">Name</option>
                                                            <option
                                                                value="status">Status</option>
                                                            <option
                                                                value="is_verified">Verified Store</option>
                                                            <option
                                                                value="created_at">Created At</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-50 w-sm-auto">
                                                    <div class="mb-3 position-relative">
                                                        <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                            <option
                                                                value="like">Contains</option>
                                                            <option
                                                                value="=">Is equal to</option>
                                                            <option
                                                                value="&gt;">Greater than</option>
                                                            <option
                                                                value="&lt;">Less than</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-auto w-100 w-sm-25">
                                                    <span class="filter-column-value-wrap">
                                                        <input
                                                            class="form-control filter-column-value"
                                                            type="text"
                                                            placeholder="Value"
                                                            name="filter_values[]">
                                                    </span>
                                                </div>

                                                <div class="col">
                                                    <button
                                                        class="btn btn-icon   btn-remove-filter-item mb-3 text-danger" type="button"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Delete">
                                                        <svg class="icon icon-left svg-icon-ti-ti-trash"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="2"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round">
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

                                        <form method="GET" action="https://shofy-grocery.botble.com/admin/marketplaces/stores" accept-charset="UTF-8" class="filter-form">
                                            <input
                                                type="hidden"
                                                name="filter_table_id"
                                                class="filter-data-table-id"
                                                value="botble-marketplace-tables-store-table">
                                            <input
                                                type="hidden"
                                                name="class"
                                                class="filter-data-class"
                                                value="Botble\Marketplace\Tables\StoreTable">
                                            <div class="filter_list inline-block filter-items-wrap">
                                                <div class="row filter-item form-filter filter-item-default">
                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-column-key" name="filter_columns[]" id="filter_columns[]">
                                                                <option
                                                                    value=""
                                                                    selected>Select field</option>
                                                                <option
                                                                    value="name">Name</option>
                                                                <option
                                                                    value="status">Status</option>
                                                                <option
                                                                    value="is_verified">Verified Store</option>
                                                                <option
                                                                    value="created_at">Created At</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-50 w-sm-auto">
                                                        <div class="mb-3 position-relative">
                                                            <select class="form-select filter-operator filter-column-operator" name="filter_operators[]" id="filter_operators[]">
                                                                <option
                                                                    value="like">Contains</option>
                                                                <option
                                                                    value="="
                                                                    selected>Is equal to</option>
                                                                <option
                                                                    value="&gt;">Greater than</option>
                                                                <option
                                                                    value="&lt;">Less than</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto w-100 w-sm-25">
                                                        <div class="filter-column-value-wrap mb-3">
                                                            <input
                                                                class="form-control filter-column-value"
                                                                type="text"
                                                                placeholder="Value"
                                                                name="filter_values[]"
                                                                value="">
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-list">
                                                <button
                                                    class="btn   add-more-filter" type="button">

                                                    Add additional filter

                                                </button>
                                                <button
                                                    class="btn btn-primary  btn-apply" type="submit">

                                                    Apply

                                                </button>
                                                <a
                                                    class="btn btn-icon   w-6" style="display: none;" type="button" href="https://shofy-grocery.botble.com/admin/marketplaces/stores" data-bb-toggle="datatable-reset-filter">
                                                    <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
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
                                                <button
                                                    class="btn   dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                                    Bulk Actions

                                                </button>

                                                <div class="dropdown-menu">
                                                    <div class="dropdown-submenu">
                                                        <button class="dropdown-item">

                                                            Bulk changes

                                                            <svg class="icon dropdown-item-icon ms-auto me-0 svg-icon-ti-ti-chevron-right"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                width="24"
                                                                height="24"
                                                                viewBox="0 0 24 24"
                                                                fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="2"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path d="M9 6l6 6l-6 6" />
                                                            </svg> </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item bulk-change-item" data-key="name" data-class-item="Botble\Marketplace\Tables\StoreTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                                Name

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="status" data-class-item="Botble\Marketplace\Tables\StoreTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                                Status

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="is_verified" data-class-item="Botble\Marketplace\Tables\StoreTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                                Verified Store

                                                            </button>
                                                            <button class="dropdown-item bulk-change-item" data-key="created_at" data-class-item="Botble\Marketplace\Tables\StoreTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                                Created At

                                                            </button>
                                                        </div>
                                                    </div>

                                                    <a class="dropdown-item" href="https://shofy-grocery.botble.com/admin/tables/bulk-actions" data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST" data-table-target="Botble\Marketplace\Tables\StoreTable" data-target="Botble\Table\BulkActions\DeleteBulkAction" data-confirmation-modal-title="Confirm to perform this action" data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone." data-confirmation-modal-button="Delete" data-confirmation-modal-cancel-button="Cancel">

                                                        Delete

                                                    </a>
                                                </div>
                                            </div>

                                            <button
                                                class="btn   btn-show-table-options" type="button">

                                                Filters

                                            </button>

                                            <div class="input-group">
                                                <input
                                                    type="search"
                                                    class="form-control input-sm"
                                                    placeholder="Search..."
                                                    style="min-width: 120px">
                                                <button
                                                    type="button"
                                                    title="Search..."
                                                    class="btn btn-icon btn-outline-secondary search-icon">
                                                    <svg class="icon svg-icon-ti-ti-search"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                </button>
                                                <button
                                                    type="button"
                                                    title="Clear"
                                                    class="btn btn-icon btn-outline-secondary search-reset-icon">
                                                    <svg class="icon svg-icon-ti-ti-x"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path d="M18 6l-12 12" />
                                                        <path d="M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                           <a href="{{ route('admin.marketplace.store.create') }}"
   class="btn action-item btn-primary">
    <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
        width="24" height="24" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 5l0 14" />
        <path d="M5 12l14 0" />
    </svg>
    Create
</a>


                                            <button
                                                class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-marketplace-tables-store-table">
                                                <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
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
                                        <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-store-table">
                                            <thead>
                                                <tr>
                                                    <th title="Checkbox"><input class="form-check-input m-0 align-middle table-check-all" data-set=".dataTable .checkboxes" name="" type="checkbox"></th>
                                                    <th title="ID" width="20" class="text-center no-column-visibility  column-key-0">ID</th>
                                                    <th title="Logo" width="50" class=" column-key-1">Logo</th>
                                                    <th title="Name" class="text-start  column-key-2">Name</th>
                                                    <th title="Earnings" width="100" class="text-start  column-key-3">Earnings</th>
                                                    <th title="Products Count" class=" column-key-4">Products Count</th>
                                                    <th title="Vendor" class="text-start  column-key-5">Vendor</th>
                                                    <th title="Created At" width="100" class=" column-key-6">Created At</th>
                                                    <th title="Status" width="100" class="text-center  column-key-7">Status</th>
                                                    <th title="Operations">Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($stores as $store)
                                                    <tr>
                                                        <td><input class="form-check-input m-0 align-middle checkboxes" type="checkbox" value="{{ $store->id }}"></td>
                                                        <td class="text-center">{{ $store->id }}</td>
                                                        <td><img src="{{ asset($store->logo) }}" alt="{{ $store->name }}" width="50"></td>
                                                        <td>{{ $store->name }}</td>
                                                        <td>{{ $store->earnings ?? 0 }}</td>
                                                        <td>{{ $store->products_count ?? 0 }}</td>
                                                        <td>{{ $store->customer_name ?? 'N/A' }}</td>
                                                        <td>{{ $store->created_at->format('Y-m-d') }}</td>
                                                        <td class="text-center">
                                                            @if($store->status == 'published')
                                                                <span class="badge bg-success">Published</span>
                                                            @elseif($store->status == 'draft')
                                                                <span class="badge bg-secondary">Draft</span>
                                                            @else
                                                                <span class="badge bg-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.marketplace.store.show', $store->id) }}" class="btn btn-icon btn-sm btn-info" data-bs-toggle="tooltip" data-bs-original-title="View">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                   <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                                   <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ route('admin.marketplace.store.edit', $store->id) }}" class="btn btn-icon btn-primary btn-sm">
                                                                <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                                            </a>
                                                           <form action="{{ route('admin.marketplace.store.destroy', $store->id) }}"method="POST"class="delete-store-form"style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-icon btn-danger btn-sm">
                                                                    <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer d-flex align-items-center">
                                        {{ $stores->withQueryString()->links('pagination::bootstrap-5') }}
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
        $(document).on('click', '.action-item[data-href]', function () {
            window.location.href = $(this).data('href');
        });

        $(document).on('submit', '.delete-store-form', function (e) {
            e.preventDefault();

            let form = this;
            let $form = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "This store will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        success: function (response) {
                            if (response.status) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $form.closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'Could not delete store.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif
    });
</script>

@endpush
