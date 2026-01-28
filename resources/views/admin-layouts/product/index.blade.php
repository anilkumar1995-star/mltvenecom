@extends('admin-layouts.app')
@section('title', 'Product')
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
                                            href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Products</h1>
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
                                    value="https://shofy-grocery.botble.com/admin/tables/filters" />

                                <div class="sample-filter-item-wrap hidden">
                                    <div class="row filter-item form-filter">
                                        <div class="col-auto w-50 w-sm-auto">
                                            <div class="mb-3 position-relative">
                                                <select class="form-select filter-column-key" name="filter_columns[]"
                                                    id="filter_columns[]">
                                                    <option value="category">Category</option>
                                                    <option value="brand_id">Brand</option>
                                                    <option value="name">Name</option>
                                                    <option value="order">Sort order</option>
                                                    <option value="status">Status</option>
                                                    <option value="stock_status">Stock status</option>
                                                    <option value="created_at">Created At</option>
                                                    <option value="is_featured">Is featured?</option>
                                                    <option value="store_id">Store</option>
                                                    <option value="product_type">Product type</option>
                                                    <option value="sku">SKU</option>
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
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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

                                <form method="GET" action="https://shofy-grocery.botble.com/admin/ecommerce/products"
                                    accept-charset="UTF-8" class="filter-form">
                                    <input type="hidden" name="filter_table_id" class="filter-data-table-id"
                                        value="botble-ecommerce-tables-product-table">
                                    <input type="hidden" name="class" class="filter-data-class"
                                        value="Botble\Ecommerce\Tables\ProductTable">
                                    <div class="filter_list inline-block filter-items-wrap">
                                        <div class="row filter-item form-filter filter-item-default">
                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-column-key" name="filter_columns[]"
                                                        id="filter_columns[]">
                                                        <option value="" selected>Select field</option>
                                                        <option value="category">Category</option>
                                                        <option value="brand_id">Brand</option>
                                                        <option value="name">Name</option>
                                                        <option value="order">Sort order</option>
                                                        <option value="status">Status</option>
                                                        <option value="stock_status">Stock status</option>
                                                        <option value="created_at">Created At</option>
                                                        <option value="is_featured">Is featured?</option>
                                                        <option value="store_id">Store</option>
                                                        <option value="product_type">Product type</option>
                                                        <option value="sku">SKU</option>
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
                                            href="https://shofy-grocery.botble.com/admin/ecommerce/products"
                                            data-bb-toggle="datatable-reset-filter">
                                            <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                                            <div class="dropdown-submenu">
                                                <button class="dropdown-item">
                                                    Bulk changes
                                                    <svg class="icon dropdown-item-icon ms-auto me-0 svg-icon-ti-ti-chevron-right"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M9 6l6 6l-6 6" />
                                                    </svg> </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item bulk-change-item" data-key="category"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">

                                                        Category

                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="brand_id"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Brand
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="name"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Name
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="order"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Sort order
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="status"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Status
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="stock_status"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Stock status
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="created_at"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Created At
                                                    </button>
                                                    <button class="dropdown-item bulk-change-item" data-key="is_featured"
                                                        data-class-item="Botble\Ecommerce\Tables\ProductTable"
                                                        data-save-url="https://shofy-grocery.botble.com/admin/tables/bulk-changes/save">
                                                        Is featured?
                                                    </button>
                                                </div>
                                            </div>

                                            <a class="dropdown-item"
                                                href="https://shofy-grocery.botble.com/admin/tables/bulk-actions"
                                                data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST"
                                                data-table-target="Botble\Ecommerce\Tables\ProductTable"
                                                data-target="Botble\Table\BulkActions\DeleteBulkAction"
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
                                    <button class="btn action-item  " tabindex="0"
                                        aria-controls="botble-ecommerce-tables-product-table" type="button"
                                        aria-haspopup="dialog" aria-expanded="false">
                                        <span data-action="export"
                                            data-href="https://shofy-grocery.botble.com/admin/tools/data-synchronize/export/products">
                                            <svg class="icon svg-icon-ti-ti-file-export"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" />
                                            </svg>
                                            Export
                                        </span>

                                    </button>
                                    <button class="btn action-item " tabindex="0"
                                        aria-controls="botble-ecommerce-tables-product-table" type="button"
                                        aria-haspopup="dialog" aria-expanded="false">
                                        <span data-action="import"
                                            data-href="https://shofy-grocery.botble.com/admin/tools/data-synchronize/import/products">
                                            <svg class="icon svg-icon-ti-ti-file-import"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path
                                                    d="M5 13v-8a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5.5m-9.5 -2h7m-3 -3l3 3l-3 3" />
                                            </svg>
                                            Import
                                        </span>
                                    </button>
                                   <div class="dropdown d-inline-block">
                                    <a href="{{ route('admin.products.create') }}"
                                    class="btn buttons-collection action-item btn-primary">
                                        <svg class="icon svg-icon-ti-ti-plus"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        <span class="ms-1">Create</span>
                                    </a>
                                </div>


                                    <button class="btn" type="button" data-bb-toggle="dt-buttons"
                                        data-bb-target=".buttons-reload" tabindex="0"
                                        aria-controls="botble-ecommerce-tables-product-table">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
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
                                <table class="table card-table table-vcenter table-striped table-hover"
                                    id="botble-ecommerce-tables-product-table">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox"><input
                                                    class="form-check-input m-0 align-middle table-check-all"
                                                    data-set=".dataTable .checkboxes" name="" type="checkbox">
                                            </th>
                                            <th title="ID" width="20"
                                                class="text-center no-column-visibility  column-key-0">ID</th>
                                            <th title="Image" width="50" class=" column-key-1">Image
                                            </th>
                                            <th title="Products" class="text-start  column-key-2">Products
                                            </th>
                                            <th title="Price" class="text-start  column-key-3">Price</th>
                                            <th title="Stock status" class=" column-key-4">Stock status</th>
                                            <th title="Quantity" class="text-start  column-key-5">Quantity
                                            </th>
                                            <th title="SKU" class="text-start  column-key-6">SKU</th>
                                            <th title="Sort order" width="50" class=" column-key-7">
                                                Sort order</th>
                                            <th title="Created At" width="100" class=" column-key-8">
                                                Created At</th>
                                            <th title="Status" width="100" class="text-center  column-key-9">Status
                                            </th>
                                            <th title="Store">Store</th>
                                            <th title="Operations">Operations</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



@endsection
