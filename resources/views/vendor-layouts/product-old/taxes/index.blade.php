@extends('admin-layouts.app')
@section('title', 'Product Taxes')
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
                                        href="{{ asset('/') }}/admin">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1"
                                        href="{{ asset('/') }}/admin/ecommerce/products">Ecommerce</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Taxes</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list"></div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="row mb-5 d-block d-md-flex">
                <div class="col-12 col-md-3">
                    <h2>Taxes</h2>
                    <p class="text-muted">Manage tax rules by country, state, city with different rates and priorities
                    </p>
                </div>
                <div class="col-12 col-md-9">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-3 flex-wrap">
                        <button type="button" class="btn btn-primary btn-create-tax"
                            data-href="{{ asset('/') }}/admin/ecommerce/taxes/create">
                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>Create a tax
                        </button>

                        <button class="btn btn-ghost-secondary btn-sm" type="button" data-bs-toggle="collapse"
                            data-bs-target="#tax-help-section" aria-expanded="false" aria-controls="tax-help-section">
                            <svg class="icon svg-icon-ti-ti-help-circle" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                <path d="M12 16v.01" />
                                <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" />
                            </svg>How it works
                        </button>
                    </div>
                    <div class="collapse mb-3" id="tax-help-section">
                        <div class="card" style="--bb-card-border-color: rgba(98, 105, 118, 0.16);">
                            <div class="card-body py-3">
                                <div class="markdown">
                                    <ul class="mb-0 ps-3">
                                        <li class="mb-1"><strong>Tax</strong>: Create a tax with a base rate (e.g.,
                                            "VAT
                                            20%"). This rate applies when no specific rules match.</li>
                                        <li class="mb-1"><strong>Tax Rules</strong>: Add location-specific rules to
                                            override the base rate for certain countries, states, or cities.</li>
                                        <li class="mb-1"><strong>Default Tax</strong>: Set one tax as default. It will
                                            be applied to products that don't have a specific tax assigned.</li>
                                        <li><strong>Priority</strong>: Lower numbers = higher priority. When multiple
                                            taxes could apply, the one with lowest priority number wins.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3" id="tax-cards-container">
                        <div class="col-12" data-tax-id="1">
                            <div class="card h-100 tax-card  tax-card-inactive"
                                style="--bb-card-border-color: rgba(98, 105, 118, 0.16);">
                                <div class="card-header py-3" style="min-height: auto;">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="card-title mb-0">VAT</h4>
                                        <span class="badge bg-success text-success-fg">Published</span>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/edit/1"
                                            class="btn btn-icon btn-edit-tax" title="Edit">
                                            <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                        <button type="button" class="btn btn-icon text-danger btn-delete-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/1"
                                            title="Delete">
                                            <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                <div class="card-body py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-3 text-muted small flex-wrap">
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-percentage"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M16 17a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 7a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 18l12 -12" />
                                            </svg><strong>10%</strong> base rate
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-arrows-sort"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                            </svg>Priority: 1
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-list" style="width: 14px; height: 14px;"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 6l11 0" />
                                                <path d="M9 12l11 0" />
                                                <path d="M9 18l11 0" />
                                                <path d="M5 6l0 .01" />
                                                <path d="M5 12l0 .01" />
                                                <path d="M5 18l0 .01" />
                                            </svg>0 Tax rules
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body p-0 flex-grow-1"></div>
                                <div class="card-footer py-2 bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/rules/create?tax_id=1"
                                            class="btn btn-outline-primary btn-sm create-tax-rule-item">
                                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg> Add rule
                                        </a>
                                        <button type="button" class="btn btn-ghost-primary btn-sm btn-set-default-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/1/set-default"
                                            title="Set as default">
                                            <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />
                                            </svg> Set as default
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" data-tax-id="2">
                            <div class="card h-100 tax-card  tax-card-inactive"
                                style="--bb-card-border-color: rgba(98, 105, 118, 0.16);">
                                <div class="card-header py-3" style="min-height: auto;">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="card-title mb-0">None</h4>
                                        <span class="badge bg-success text-success-fg">Published</span>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/edit/2"
                                            class="btn btn-icon btn-edit-tax" title="Edit">
                                            <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                        <button type="button" class="btn btn-icon text-danger btn-delete-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/2"
                                            title="Delete">
                                            <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                <div class="card-body py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-3 text-muted small flex-wrap">
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-percentage"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M16 17a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 7a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 18l12 -12" />
                                            </svg><strong>0%</strong> base rate
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-arrows-sort"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                            </svg>Priority: 2
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-list" style="width: 14px; height: 14px;"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 6l11 0" />
                                                <path d="M9 12l11 0" />
                                                <path d="M9 18l11 0" />
                                                <path d="M5 6l0 .01" />
                                                <path d="M5 12l0 .01" />
                                                <path d="M5 18l0 .01" />
                                            </svg>0 Tax rules
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body p-0 flex-grow-1">
                                </div>

                                <div class="card-footer py-2 bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/rules/create?tax_id=2"
                                            class="btn btn-outline-primary btn-sm create-tax-rule-item">
                                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg> Add rule
                                        </a>
                                        <button type="button" class="btn btn-ghost-primary btn-sm btn-set-default-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/2/set-default"
                                            title="Set as default">
                                            <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />
                                            </svg> Set as default
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" data-tax-id="3">
                            <div class="card h-100 tax-card  tax-card-inactive"
                                style="--bb-card-border-color: rgba(98, 105, 118, 0.16);">
                                <div class="card-header py-3" style="min-height: auto;">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="card-title mb-0">Import Tax</h4>
                                        <span class="badge bg-success text-success-fg">Published</span>
                                    </div>
                                    <div class="card-actions">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/edit/3"
                                            class="btn btn-icon btn-edit-tax" title="Edit">
                                            <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </a>
                                        <button type="button" class="btn btn-icon text-danger btn-delete-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/3"
                                            title="Delete">
                                            <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
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
                                <div class="card-body py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-3 text-muted small flex-wrap">
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-percentage"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M16 17a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 7a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 18l12 -12" />
                                            </svg><strong>15%</strong> base rate
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-arrows-sort"
                                                style="width: 14px; height: 14px;" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 9l4 -4l4 4m-4 -4v14" />
                                                <path d="M21 15l-4 4l-4 -4m4 4v-14" />
                                            </svg>Priority: 3
                                        </span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <svg class="icon svg-icon-ti-ti-list" style="width: 14px; height: 14px;"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 6l11 0" />
                                                <path d="M9 12l11 0" />
                                                <path d="M9 18l11 0" />
                                                <path d="M5 6l0 .01" />
                                                <path d="M5 12l0 .01" />
                                                <path d="M5 18l0 .01" />
                                            </svg>0 Tax rules
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body p-0 flex-grow-1">
                                </div>

                                <div class="card-footer py-2 bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                        <a href="{{ asset('/') }}/admin/ecommerce/taxes/rules/create?tax_id=3"
                                            class="btn btn-outline-primary btn-sm create-tax-rule-item">
                                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg> Add rule
                                        </a>
                                        <button type="button" class="btn btn-ghost-primary btn-sm btn-set-default-tax"
                                            data-url="{{ asset('/') }}/admin/ecommerce/taxes/3/set-default"
                                            title="Set as default">
                                            <svg class="icon svg-icon-ti-ti-star" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path
                                                    d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873l-6.158 -3.245" />
                                            </svg> Set as default
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-blur modal fade modal-blur create-tax-form-modal" tabindex="-1" role="dialog"
                aria-hidden="true" data-select2-dropdown-parent="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Create a tax</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-status bg-info"></div>

                        <div class="modal-body">
                            ...
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-blur modal fade modal-blur create-tax-rule-form-modal" tabindex="-1"
                role="dialog" aria-hidden="true" data-select2-dropdown-parent="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Create a tax rule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-status bg-info"></div>

                        <div data-select2-dropdown-parent class="modal-body">
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @endsection

    @push('scripts')
    <script>
        $(document).ready(function() {
            $("#tableForm").on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status) {
                            Swal.fire('Success!', data.message, 'success').then(() => {
                                window.location.href = "{{ route('admin.producttags.Index') }}";
                            });
                        }
                    },error: function(xhr) {
                        if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorMsg = Object.values(errors).flat().join('<br>');
                            Swal.fire('Error!', errorMsg, 'error');
                        }
                    }
                });
            });
        });
        
        function deleteItem(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "Do you really want to delete this table?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.producttaxes.Delete') }}',
                        type: 'POST',
                        data: { id: id, _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }

        function bulkDelete() {
            var ids = [];
            $('.row-checkbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length === 0) {
                Swal.fire('Error', 'Please select at least one item', 'error');
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to delete " + ids.length + " items.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete them!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('admin.producttaxes.bulk-delete') }}',
                        type: 'POST',
                        data: { ids: ids, _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $(document).on('change', '#checkAll', function() {
                $('.row-checkbox').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    @endpush
