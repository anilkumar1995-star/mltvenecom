@extends('admin-layouts.app')
@section('title', 'Unverified Vendors')
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
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Unverified vendors</h1>
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

                            <div class="card">
                                <div class="card-header">
                                    <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                        <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">


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

                                            <button
                                                class="btn" type="button" data-bb-toggle="dt-buttons" data-bb-target=".buttons-reload" tabindex="0" aria-controls="botble-marketplace-tables-unverified-vendor-table">
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
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-unverified-vendor-table">
                                            <thead>
                                                <tr>
                                                    <th title="ID" width="20" class="text-center no-column-visibility  column-key-0">ID</th>
                                                    <th title="Avatar" width="70" class=" column-key-1">Avatar</th>
                                                    <th title="Name" class="text-start  column-key-2">Name</th>
                                                    <th title="Store name" class="text-start  column-key-3">Store name</th>
                                                    <th title="Store phone" class="text-start  column-key-4">Store phone</th>
                                                    <th title="Created At" width="100" class=" column-key-5">Created At</th>
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