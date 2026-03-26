@extends('vendor-layouts.app')
@section('title', 'Revenues')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Earnings & Revenue</h2>
                    <div class="text-muted mt-1">Detailed financial overview for your store</div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                {{-- Stats Widgets --}}
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-primary text-white avatar">₹</span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Total Sales</div>
                                    <div class="text-muted">₹{{ number_format($totalSales, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-success text-white avatar"><i class="fa fa-wallet"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Current Balance</div>
                                    <div class="text-muted">₹{{ number_format($balance, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-info text-white avatar"><i class="fa fa-shopping-cart"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Completed Orders</div>
                                    <div class="text-muted">{{ $completedOrdersCount }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-warning text-white avatar"><i class="fa fa-clock"></i></span>
                                </div>
                                <div class="col">
                                    <div class="font-weight-medium">Pending Withdrawals</div>
                                    <div class="text-muted">₹{{ number_format($pendingWithdrawn, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sales History (Last 30 Days)</h3>
                        </div>
                        <div class="card-body">
                            <div id="chart-sales" style="min-height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.ApexCharts && (new ApexCharts(document.getElementById('chart-sales'), {
                chart: {
                    type: "area",
                    height: 250,
                    toolbar: { show: false },
                },
                dataLabels: { enabled: false },
                fill: { opacity: .1, type: 'solid' },
                stroke: { width: 2, lineCap: "round", curve: "smooth" },
                series: [{
                    name: "Sales (₹)",
                    data: {!! json_encode($salesData->pluck('total')) !!}
                }],
                grid: {
                    strokeDashArray: 4,
                },
                xaxis: {
                    labels: { padding: 0 },
                    tooltip: { enabled: false },
                    axisBorder: { show: false },
                    categories: {!! json_encode($salesData->pluck('date')) !!},
                },
                yaxis: {
                    labels: { padding: 4 }
                },
                colors: ["#206bc4"],
                legend: { show: false },
            })).render();
        });
    </script>
@endpush
