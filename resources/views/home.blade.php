@extends('admin-layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Dashboard</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button class="btn btn-outline-primary manage-widget" type="button" data-bs-toggle="modal"
                            data-bs-target="#widgets-management-modal">
                            <svg class="icon icon-left svg-icon-ti-ti-layout-dashboard" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                                <path d="M5 16h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
                                <path d="M15 12h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1"></path>
                                <path d="M15 4h4a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-2a1 1 0 0 1 1 -1"></path>
                            </svg>
                            Manage Widgets
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="page-body page-content">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div role="alert" class="alert alert-info">
                        <div class="d-flex gap-1">
                            <div>
                                <svg class="icon alert-icon svg-icon-ti-ti-alert-circle" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div class="w-100">
                                Hi {{ Auth::user()->name }}, welcome to your dashboard!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row row-cards">
                        {{-- Orders Widget --}}
                        <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3">
                            <a class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                href="{{ route('admin.orders.index') }}" style="background-color: rgb(50, 197, 210);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                        <div class="desc fw-medium">Orders</div>
                                        <div class="number fw-bolder"><span>{{ $ordersCount }}</span></div>
                                    </div>
                                    <div class="visual ps-1 position-absolute end-0">
                                        <i class="fas fa-shopping-basket me-n2" style="opacity: 0.1; font-size: 80px;"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Products Widget --}}
                        <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3">
                            <a class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                href="{{ route('admin.products.index') }}" style="background-color: rgb(18, 128, 245);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                        <div class="desc fw-medium">Products</div>
                                        <div class="number fw-bolder"><span>{{ $productsCount }}</span></div>
                                    </div>
                                    <div class="visual ps-1 position-absolute end-0">
                                        <svg class="icon me-n2 svg-icon-ti-ti-shopping-cart" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            style="opacity: 0.1; width: 80px; height: 80px;">
                                            <path d="M4 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M15 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M17 17h-11v-14h-2"></path>
                                            <path d="M6 5l14 1l-1 7h-13"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Customers Widget --}}
                        <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3">
                            <a class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                href="{{ route('admin.customers.index') }}" style="background-color: rgb(117, 182, 249);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                        <div class="desc fw-medium">Customers</div>
                                        <div class="number fw-bolder"><span>{{ $customersCount }}</span></div>
                                    </div>
                                    <div class="visual ps-1 position-absolute end-0">
                                        <svg class="icon me-n2 svg-icon-ti-ti-user" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            style="opacity: 0.1; width: 80px; height: 80px;">
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        {{-- Reviews Widget --}}
                        <div class="col dashboard-widget-item col-12 col-md-6 col-lg-3">
                            <a class="text-white d-block rounded position-relative overflow-hidden text-decoration-none"
                                href="{{ route('admin.reviews.index') }}" style="background-color: rgb(7, 79, 157);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="details px-4 py-3 d-flex flex-column justify-content-between">
                                        <div class="desc fw-medium">Reviews</div>
                                        <div class="number fw-bolder"><span>{{ $reviewsCount }}</span></div>
                                    </div>
                                    <div class="visual ps-1 position-absolute end-0">
                                        <svg class="icon me-n2 svg-icon-ti-ti-messages" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            style="opacity: 0.1; width: 80px; height: 80px;">
                                            <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10">
                                            </path>
                                            <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div id="list_widgets" class="row row-cards" data-bb-toggle="widgets-list" data-url="{{ route('admin.menu-items-count') }}">
                        {{-- Site Analytics Widget --}}
                        <div class="widget-item col-12 d-flex" id="widget_analytics_general" data-url="{{ route('admin.reports.data') }}">
                            <div class="card card-sm flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title"> Site Analytics </h4>
                                    <div class="card-actions btn-actions">
                                        <div class="dropdown d-flex align-items-center me-2">
                                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"> Today </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <button class="dropdown-item"> Today </button>
                                                <button class="dropdown-item"> Yesterday </button>
                                                <button class="dropdown-item"> This Week </button>
                                                <button class="dropdown-item"> Last 7 Days </button>
                                                <button class="dropdown-item"> This Month </button>
                                                <button class="dropdown-item"> Last 30 Days </button>
                                                <button class="dropdown-item"> This Year </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content" style="min-height: 20rem; padding: 1.25rem;">
                                    <div id="site-analytics-chart" style="min-height: 300px;">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <div class="text-muted">Loading analytics...</div>
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
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const chartElement = document.querySelector("#site-analytics-chart");
        const url = "{{ route('admin.reports.data') }}";

        $.ajax({
            url: url,
            success: function(res) {
                chartElement.innerHTML = ""; // Clear loader
                new ApexCharts(chartElement, {
                    series: [
                        { name: 'Revenue', data: res.revenue },
                        { name: 'Orders', data: res.orders }
                    ],
                    chart: { type: 'area', height: 320, toolbar: { show: false } },
                    colors: ['#206bc4', '#f59f00'],
                    stroke: { curve: 'smooth', width: 2 },
                    xaxis: { categories: res.dates },
                    fill: { type: 'gradient', gradient: { opacityFrom: 0.3, opacityTo: 0.05 } },
                    legend: { position: 'top', horizontalAlign: 'right' },
                    yaxis: [
                        { title: { text: 'Revenue' }, labels: { formatter: (val) => "₹" + val.toLocaleString() } },
                        { opposite: true, title: { text: 'Orders' } }
                    ]
                }).render();
            }
        });
    });
</script>
@endpush
@endsection
