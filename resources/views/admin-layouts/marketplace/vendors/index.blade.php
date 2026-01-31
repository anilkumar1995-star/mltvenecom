@extends('admin-layouts.app')
@section('title', 'Marketplace Vendors')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Vendors</h1>
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
                                                    value="email">Email</option>
                                                <option
                                                    value="created_at">Created At</option>
                                                <option
                                                    value="vendor_verified_at">Verified</option>
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

                            <form method="GET" action="https://shofy-grocery.botble.com/admin/marketplaces/vendors" accept-charset="UTF-8" class="filter-form">
                                <input
                                    type="hidden"
                                    name="filter_table_id"
                                    class="filter-data-table-id"
                                    value="botble-marketplace-tables-vendor-table">
                                <input
                                    type="hidden"
                                    name="class"
                                    class="filter-data-class"
                                    value="Botble\Marketplace\Tables\VendorTable">
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
                                                        value="email">Email</option>
                                                    <option
                                                        value="created_at">Created At</option>
                                                    <option
                                                        value="vendor_verified_at">Verified</option>
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
                                        class="btn btn-icon   w-6" style="display: none;" type="button" href="https://shofy-grocery.botble.com/admin/marketplaces/vendors" data-bb-toggle="datatable-reset-filter">
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
                                                <button class="dropdown-item bulk-change-item" data-key="name" data-class-item="Botble\Marketplace\Tables\VendorTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                    Name

                                                </button>
                                                <button class="dropdown-item bulk-change-item" data-key="email" data-class-item="Botble\Marketplace\Tables\VendorTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                    Email

                                                </button>
                                                <button class="dropdown-item bulk-change-item" data-key="status" data-class-item="Botble\Marketplace\Tables\VendorTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                    Status

                                                </button>
                                                <button class="dropdown-item bulk-change-item" data-key="created_at" data-class-item="Botble\Marketplace\Tables\VendorTable" data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                    Created At

                                                </button>
                                            </div>
                                        </div>

                                        <a class="dropdown-item" href="https://shofy-grocery.botble.com/admin/tables/bulk-actions" data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST" data-table-target="Botble\Marketplace\Tables\VendorTable" data-target="Botble\Table\BulkActions\DeleteBulkAction" data-confirmation-modal-title="Confirm to perform this action" data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone." data-confirmation-modal-button="Delete" data-confirmation-modal-cancel-button="Cancel">

                                            Delete

                                        </a>
                                    </div>
                                </div>

                                <button
                                    class="btn   btn-show-table-options" type="button">

                                    Filters

                                </button>

                                <div class="table-search-input">
                                    <label>
                                        <input
                                            type="search"
                                            class="form-control input-sm"
                                            placeholder="Search..."
                                            style="min-width: 120px">
                                        <button
                                            type="button"
                                            title="Search..."
                                            class="search-icon"><svg class="icon svg-icon-ti-ti-search"
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
                                            </svg></button>
                                        <button
                                            type="button"
                                            title="Clear"
                                            class="search-reset-icon"><svg class="icon svg-icon-ti-ti-x"
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
                                            </svg></button>
                                    </label>
                                </div>
                            </div>
                            <div
                                class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">

                                <div class="dropdown">
                                    <button
                                        title="Export"
                                        class="btn buttons-collection dropdown-toggle buttons-export"
                                        data-bs-toggle="dropdown"
                                        tabindex="0"
                                        aria-controls="botble-marketplace-tables-vendor-table"
                                        type="button"
                                        aria-haspopup="dialog"
                                        aria-expanded="false">
                                        <span>
                                            <svg class="icon svg-icon-ti-ti-download"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                                <path d="M7 11l5 5l5 -5" />
                                                <path d="M12 4l0 12" />
                                            </svg> Export
                                        </span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button
                                            class="dropdown-item"
                                            data-bb-toggle="dt-exports"
                                            data-bb-target="csv"
                                            aria-controls="botble-marketplace-tables-vendor-table">
                                            <span>
                                                <svg class="icon svg-icon-ti-ti-file-type-csv"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                    <path d="M7 16.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                                                    <path d="M10 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                                                    <path d="M16 15l2 6l2 -6" />
                                                </svg> CSV
                                            </span>
                                        </button>
                                        <button
                                            class="dropdown-item"
                                            data-bb-toggle="dt-exports"
                                            data-bb-target="excel"
                                            aria-controls="botble-marketplace-tables-vendor-table">
                                            <span>
                                                <svg class="icon svg-icon-ti-ti-file-type-xls"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                                    <path d="M4 15l4 6" />
                                                    <path d="M4 21l4 -6" />
                                                    <path d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                                                    <path d="M11 15v6h3" />
                                                </svg> Excel
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <button
                                    class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-marketplace-tables-vendor-table">
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
                            <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-vendor-table">
                                <thead>
                                    <tr>
                                        <th title="Checkbox"><input class="form-check-input m-0 align-middle table-check-all" data-set=".dataTable .checkboxes" name="" type="checkbox"></th>
                                        <th title="ID" width="20" class="text-center no-column-visibility  column-key-0">ID</th>
                                        <th title="Avatar" class=" column-key-1">Avatar</th>
                                        <th title="Name" class="text-start  column-key-2">Name</th>
                                        <th title="Email" class="text-start  column-key-3">Email</th>
                                        <th title="Store name" class=" column-key-4">Store name</th>
                                        <th title="Store phone" class=" column-key-5">Store phone</th>
                                        <th title="Products" class=" column-key-6">Products</th>
                                        <th title="Total Revenue" class=" column-key-7">Total Revenue</th>
                                        <th title="Balance" class=" column-key-8">Balance</th>
                                        <th title="Verified" width="100" class="text-center  column-key-9">Verified</th>
                                        <th title="Store Status" class=" column-key-10">Store Status</th>
                                        <th title="Status" width="100" class="text-center  column-key-11">Status</th>
                                        <th title="Created At" width="100" class=" column-key-12">Created At</th>
                                        <th title="Operations">Operations</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </main>




@endsection
@push('scripts')

@endpush