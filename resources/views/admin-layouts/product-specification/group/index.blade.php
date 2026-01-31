@extends('admin-layouts.app')
@section('title','Group')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Specification Groups</h1>
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

                <div class="card has-actions">
                    <div class="card-header">
                        <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                            <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                <div class="dropdown d-inline-block">
                                    <button class="btn   dropdown-toggle" type="button" data-bs-toggle="dropdown">

                                        Bulk Actions

                                    </button>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="https://shofy-grocery.botble.com/admin/tables/bulk-actions"
                                            data-trigger-bulk-action="data-trigger-bulk-action" data-method="POST"
                                            data-table-target="Botble\Ecommerce\Tables\SpecificationGroupTable"
                                            data-target="Botble\Table\BulkActions\DeleteBulkAction"
                                            data-confirmation-modal-title="Confirm to perform this action"
                                            data-confirmation-modal-message="Are you sure you want to do this action? This cannot be undone."
                                            data-confirmation-modal-button="Delete"
                                            data-confirmation-modal-cancel-button="Cancel">

                                            Delete

                                        </a>
                                    </div>
                                </div>


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
                                    <a href="{{ route('admin.group.create') }}"
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
                                    aria-controls="botble-ecommerce-tables-specification-group-table">
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
                        <div class="table-responsive table-has-actions">
                            <table class="table card-table table-vcenter table-striped table-hover"
                                id="botble-ecommerce-tables-specification-group-table">
                                <thead>
                                    <tr>
                                        <th title="Checkbox"><input
                                                class="form-check-input m-0 align-middle table-check-all"
                                                data-set=".dataTable .checkboxes" name="" type="checkbox"></th>
                                        <th title="ID" width="20"
                                            class="text-center no-column-visibility  column-key-0">ID</th>
                                        <th title="Name" class="text-start  column-key-1">Name</th>
                                        <th title="Description" class=" column-key-2">Description</th>
                                        <th title="Created At" width="100" class=" column-key-3">Created At</th>
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