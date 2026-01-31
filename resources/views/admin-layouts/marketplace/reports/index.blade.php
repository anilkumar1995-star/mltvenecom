@extends('admin-layouts.app')
@section('title', 'Marketplace Reports')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Reports</h1>
                                </li>
                            </ol>
                        </nav>

                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button
                            class="btn btn-outline-primary  date-range-picker" type="button" data-format-value="From __from__ to __to__" data-format="YYYY-MM-DD" data-href="https://shofy-grocery.botble.com/admin/marketplaces/reports" data-start-date="2026-01-01 08:21:26" data-end-date="2026-01-30 08:21:26">
                            <svg class="icon icon-left svg-icon-ti-ti-calendar"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M11 15h1" />
                                <path d="M12 15v3" />
                            </svg>
                            From 2026-01-01 to 2026-01-30

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">


            <div>
                <div class="row row-cards">
                    <div
                        id="average-commission-card-widget-parent"
                        class="widget-item col-md-3">
                        <div class="h-100 position-relative">
                            <div class="card analytic-card">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <svg class="icon icon-md  text-white bg-info rounded p-1 svg-icon-ti-ti-percentage"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M16 17a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 7a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                                <path d="M6 18l12 -12" />
                                            </svg>
                                        </div>
                                        <div class="col mt-0">
                                            <p class="text-secondary mb-0 fs-4">
                                                Average Commission Rate
                                            </p>
                                            <h3 class="mb-n1 fs-1">
                                                0.00%
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-secondary mb-0">
                                            Total fee: $0.00
                                        </p>
                                    </div>
                                </div>
                                <div class="px-3 pb-4">
                                    <span class="text-danger fw-semibold" style="visibility: hidden">&mdash;</span>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        id="sale-commission-html-widget"
                        class="mb-3 widget-item">
                        <div class="card report-chart-content" id="report-chart">
                            <div class="card-header">
                                <h4 class="card-title">Sale commissions</h4>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 mb-2">
                                        <div id="sale-commissions-chart"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="rp-card-chart position-relative mb-3">
                                            <div id="revenue-earnings-chart"></div>
                                            <div class="rp-card-information">
                                                <svg class="icon svg-icon-ti-ti-wallet"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                                                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                                                </svg> <strong>$0.00</strong>
                                                <small>Total Earnings</small>
                                            </div>
                                        </div>
                                        <div class="rp-card-status text-center">
                                            <p>
                                                <svg class="icon icon-sm  mb-0 me-1 svg-icon-ti-ti-circle-filled" style="color: #80bc00" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" stroke-width="0" fill="currentColor" />
                                                </svg> <strong>$0.00</strong>
                                                <span>Total fee</span>
                                            </p>
                                            <p>
                                                <svg class="icon icon-sm  mb-0 me-1 svg-icon-ti-ti-circle-filled" style="color: #E91E63" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 3.34a10 10 0 1 1 -4.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 4.995 -8.336z" stroke-width="0" fill="currentColor" />
                                                </svg> <strong>$0.00</strong>
                                                <span>Total amount</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div
                        id="store-growth-chart-widget-parent"
                        class="d-flex widget-item col-md-6">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Store Growth
                                </h4>
                            </div>
                            <div class="card-body p-0" id="store-growth-chart-widget">

                            </div>
                        </div>
                    </div>

                    <div
                        id="product-distribution-chart-widget-parent"
                        class="d-flex widget-item col-md-6">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Product Distribution by Store
                                </h4>
                            </div>
                            <div class="card-body p-0" id="product-distribution-chart-widget">

                            </div>
                        </div>
                    </div>

                    <div
                        id="top-performing-stores-card-widget-parent"
                        class="widget-item col-md-3">
                        <div class="h-100 position-relative">
                            <div class="card analytic-card">
                                <div class="card-body p-3">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <svg class="icon icon-md  text-white bg-success rounded p-1 svg-icon-ti-ti-building-store"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M3 21l18 0" />
                                                <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                                                <path d="M5 21l0 -10.15" />
                                                <path d="M19 21l0 -10.15" />
                                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
                                            </svg>
                                        </div>
                                        <div class="col mt-0">
                                            <p class="text-secondary mb-0 fs-4">
                                                Top Performing Stores
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="px-3">
                                            <p
                                                class="smiley"
                                                aria-hidden="true"></p>
                                            <p>No data to display</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div
                        id="withdrawal-status-chart-widget-parent"
                        class="d-flex widget-item col-md-6">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Withdrawal Status
                                </h4>
                            </div>
                            <div class="card-body p-0" id="withdrawal-status-chart-widget">

                            </div>
                        </div>
                    </div>

                    <div class="d-flex widget-item">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Store revenues
                                </h4>
                            </div>
                            <div class="table-responsive table-widget">
                                <div class="table-wrapper">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="btn-list">
                                                <div class="table-search-input">
                                                    <label><input
                                                            type="search"
                                                            class="form-control input-sm"
                                                            placeholder="Search..."></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-table">
                                            <div class="table-responsive">
                                                <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-store-revenue-table">
                                                    <thead>
                                                        <tr>
                                                            <th title="ID" width="20">ID</th>
                                                            <th title="Description">Description</th>
                                                            <th title="Store">Store</th>
                                                            <th title="Fee">Fee</th>
                                                            <th title="Sub amount">Sub amount</th>
                                                            <th title="Amount">Amount</th>
                                                            <th title="Type" width="100">Type</th>
                                                            <th title="Created At" width="100">Created At</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="d-flex widget-item">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Recent Withdrawals
                                </h4>
                            </div>
                            <div class="table-responsive table-widget">
                                <div class="table-wrapper">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="btn-list">
                                                <div class="table-search-input">
                                                    <label><input
                                                            type="search"
                                                            class="form-control input-sm"
                                                            placeholder="Search..."></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-table">
                                            <div class="table-responsive">
                                                <table class="table card-table table-vcenter table-striped table-hover" id="botble-marketplace-tables-recent-withdrawals-table">
                                                    <thead>
                                                        <tr>
                                                            <th title="ID" width="20">ID</th>
                                                            <th title="Store">Store</th>
                                                            <th title="Amount">Amount</th>
                                                            <th title="Fee">Fee</th>
                                                            <th title="Status" width="100">Status</th>
                                                            <th title="Created At" width="100">Created At</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </main>


@endsection
@push('scripts')

@endpush