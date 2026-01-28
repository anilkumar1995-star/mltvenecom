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


                    <div class="card has-actions has-filter">
                        <div class="card-header">
                            <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                    <div class="dropdown d-inline-block">

                                        <div class="dropdown-menu">
                                            <div class="dropdown-submenu">

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

                                </div>
                                <div
                                    class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                   
                                    <div class="dropdown d-inline-block">
                                        <a href="{{ route('admin.category.create') }}"
                                            class="btn buttons-collection action-item btn-primary">
                                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
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
                                            <th title="ID" width="20"
                                                class="text-center no-column-visibility  column-key-0">ID</th>
                                            <th title="CategoryName" width="50" class=" column-key-1">Name
                                            </th>
                                            <th title="Description" class="text-start  column-key-2">description
                                            </th>
                                            <th title="Status" class="text-start  column-key-3">Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
