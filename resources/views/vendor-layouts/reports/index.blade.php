@extends('admin-layouts.app')
@section('title', 'Ecommerce Reports')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<style>
    :root {
        --bt-pink: #e91e63;
        --bt-green: #2fb344;
        --bt-red: #d63939;
        --bt-blue: #206bc4;
        --bt-yellow: #f59f00;
        --bt-lime: #74b816;
        --bt-cyan: #4299e1;
        --bt-orange: #fd7e14;
        --bt-purple: #ae3ec9;
        --bt-teal: #0ca678;
    }
    .page-wrapper { background-color: #f8fafc; min-height: 100vh; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
    .card { border: 1px solid rgba(0,0,0,.08); border-radius: 4px; margin-bottom: 1.5rem; background: #fff; box-shadow: 0 1px 2px rgba(0,0,0,.04); }
    .card-header { background: transparent; border-bottom: 1px solid rgba(0,0,0,0.05); padding: 0.85rem 1.25rem; display: flex; align-items: center; justify-content: space-between; }
    .card-title { font-size: 0.825rem; font-weight: 700; color: #1f2937; margin: 0; }
    
    .avatar-bt { 
        width: 64px !important; 
        height: 64px !important; 
        min-width: 64px !important;
        min-height: 64px !important;
        border-radius: 12px !important; 
        display: grid !important; 
        place-items: center !important; 
        flex-shrink: 0 !important; 
        background-color: rgba(0,0,0,0.03);
        transition: all 0.2s ease;
    }
    .avatar-bt i { 
        font-size: 32px !important; 
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        line-height: 1 !important; 
    }
    .card-sm:hover .avatar-bt { transform: scale(1.1); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    
    .bg-pink-lt { background: #fce8ef !important; color: var(--bt-pink) !important; }
    .bg-green-lt { background: #eaf7ed !important; color: var(--bt-green) !important; }
    .bg-red-lt { background: #fbebeb !important; color: var(--bt-red) !important; }
    .bg-blue-lt { background: #e9f0f9 !important; color: var(--bt-blue) !important; }
    .bg-yellow-lt { background: #fef5e6 !important; color: var(--bt-yellow) !important; }
    .bg-lime-lt { background: #f1f8e8 !important; color: var(--bt-lime) !important; }
    .bg-cyan-lt { background: #ecf5fc !important; color: var(--bt-cyan) !important; }
    .bg-orange-lt { background: #fff2e8 !important; color: var(--bt-orange) !important; }
    .bg-purple-lt { background: #f7ecf9 !important; color: var(--bt-purple) !important; }
    .bg-teal-lt { background: #e7f6f2 !important; color: var(--bt-teal) !important; }

    .subheader { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: #64748b; margin-bottom: 4px; }
    .h2 { font-size: 1.5rem; font-weight: 700; color: #1e293b; margin: 0; }

    .table thead th { background: #f8fafc; text-transform: uppercase; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.05em; color: #64748b; padding: 0.75rem 1rem; border-top: 0; border-bottom: 1px solid rgba(0,0,0,0.05); }
    .table tbody td { padding: 0.75rem 1rem; font-size: 0.8rem; vertical-align: middle; border-color: rgba(0,0,0,0.03); }
    .badge { padding: 0.35em 0.5em; font-weight: 600; border-radius: 4px; font-size: 0.65rem; }
    
    /* DataTables improvements */
    .dt-container { padding: 0 !important; }
    .dt-scroll-body { border: none !important; }
    .dt-paging { padding: 0.75rem 1rem !important; border-top: 1px solid rgba(0,0,0,0.05) !important; }
    .dt-search { padding: 0.75rem 1rem !important; }
    .dt-length { padding: 0.75rem 1rem !important; }
    
    .breadcrumb-item { font-size: 0.75rem; }
    .breadcrumb-item a { color: #206bc4; text-decoration: none; }
</style>

<div class="page-wrapper">
    <div class="px-4 pt-4 mb-4">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Ecommerce</li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                    <h2 class="h2 mb-0" style="font-size: 1.5rem;">Ecommerce Reports</h2>
                </div>
                <div class="col-auto ms-auto">
                    <div class="btn-list d-flex align-items-center">
                        <a href="#" class="btn btn-white btn-sm px-3 me-2" style="border: 1px solid rgba(0,0,0,0.1);"><i class="ti ti-settings me-1"></i>Configure Widgets</a>
                        <div class="input-icon">
                            <span class="input-icon-addon"><i class="ti ti-calendar"></i></span>
                            <input type="text" id="report-range" class="form-control form-control-sm" value="{{ $dateRange }}" style="min-width: 250px; border: 1px solid rgba(0,0,0,0.1);">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body px-4">
        <div class="container-xl">
            <!-- 10 Widgets Section -->
            <div class="row row-cards mb-4">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-pink-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-currency-rupee" style="font-size: 30px !important;"></i></span><div><div class="subheader">Revenue</div><div class="h2">₹<span id="widget-revenue">{{ number_format($revenue, 2) }}</span></div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-green-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-chart-line" style="font-size: 30px !important;"></i></span><div><div class="subheader">Profit</div><div class="h2">₹<span id="widget-profit">{{ number_format($profit, 2) }}</span></div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-red-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-trending-down" style="font-size: 30px !important;"></i></span><div><div class="subheader">Expenses</div><div class="h2">₹<span id="widget-expenses">{{ number_format($expenses, 2) }}</span></div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-blue-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-notebook" style="font-size: 30px !important;"></i></span><div><div class="subheader">Average Order Value</div><div class="h2">₹<span id="widget-aov">{{ number_format($averageOrderValue, 2) }}</span></div></div></div></div>
                </div>
                
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-yellow-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-shopping-cart" style="font-size: 30px !important;"></i></span><div><div class="subheader">Orders</div><div class="h2" id="widget-orders">{{ $ordersCount }}</div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-lime-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-users" style="font-size: 30px !important;"></i></span><div><div class="subheader">Customers</div><div class="h2" id="widget-customers">{{ $customersCount }}</div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-cyan-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-database" style="font-size: 30px !important;"></i></span><div><div class="subheader">Products</div><div class="h2" id="widget-products">{{ $productsCount }}</div></div></div></div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-orange-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-chart-pie" style="font-size: 30px !important;"></i></span><div><div class="subheader">Conversion Rate</div><div class="h2"><span id="widget-conversion">{{ number_format($conversionRate, 2) }}</span>%</div></div></div></div>
                </div>

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-purple-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-discount-2" style="font-size: 30px !important;"></i></span><div><div class="subheader">Tax Collection</div><div class="h2">₹<span id="widget-tax">{{ number_format($taxAmount, 2) }}</span></div></div></div></div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="card card-sm"><div class="card-body d-flex align-items-center"><span class="avatar-bt bg-teal-lt me-3" style="width: 60px !important; height: 60px !important; min-width: 60px !important; display: flex !important; align-items: center !important; justify-content: center !important; border-radius: 12px !important; flex-shrink: 0 !important;"><i class="ti ti-star" style="font-size: 30px !important;"></i></span><div><div class="subheader">Product Reviews</div><div class="h2"><span id="widget-reviews-avg">{{ number_format($reviewsAvg, 1) }}</span> (<span id="widget-reviews-count">{{ $reviewsCount }}</span> reviews)</div></div></div></div>
                </div>
            </div>

            <!-- Main Charts -->
            <div class="row row-cards mb-4">
                <div class="col-12"><div class="card"><div class="card-header"><h3 class="card-title">Sales Reports</h3></div><div class="card-body"><div id="sales-chart" style="min-height: 400px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Customers</h3></div><div class="card-body"><div id="customers-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Orders</h3></div><div class="card-body"><div id="orders-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Customer Retention</h3></div><div class="card-body"><div id="retention-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Product Categories</h3></div><div class="card-body"><div id="categories-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Order Statuses</h3></div><div class="card-body"><div id="statuses-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Payment Methods</h3></div><div class="card-body"><div id="payments-chart" style="min-height: 300px;"></div></div></div></div>
            </div>

            <!-- Shipping & Recent Orders -->
            <div class="row row-cards mb-4">
                <div class="col-lg-6"><div class="card"><div class="card-header"><h3 class="card-title">Shipping Methods</h3></div><div class="card-body"><div id="shipping-chart" style="min-height: 300px;"></div></div></div></div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Recent Orders</h3><a href="#" class="btn btn-white btn-sm">View all</a></div>
                        <div class="table-responsive">
                            <table class="table table-vcenter table-hover card-table" id="recent-orders-table">
                                <thead><tr><th>ID</th><th>CUSTOMER</th><th>AMOUNT</th><th>PAYMENT METHOD</th><th>PAYMENT STATUS</th></tr></thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ @$order->user->name ?: 'Guest' }}</td>
                                        <td class="font-weight-bold">₹{{ number_format($order->amount, 2) }}</td>
                                        <td class="text-uppercase small">{{ @$order->payment->payment_channel ?: 'N/A' }}</td>
                                        <td><span class="badge bg-{{ @$order->payment->status == 'completed' ? 'green' : 'orange' }}-lt">{{ ucfirst(@$order->payment->status ?: 'Pending') }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tables Bottom -->
            <div class="row row-cards">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Top Selling Products</h3></div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="top-selling-table">
                                <thead><tr><th>PRODUCT ID</th><th>PRODUCT NAME</th><th class="text-end">QUANTITY</th></tr></thead>
                                <tbody>
                                    @foreach($topProducts as $p)
                                    <tr><td>#{{ $p->product_id }}</td><td>{{ $p->name }}</td><td class="text-end">{{ $p->total_qty }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Trending Products</h3></div>
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table" id="trending-table">
                                <thead><tr><th>ID</th><th>PRODUCT NAME</th><th class="text-end">VIEWS</th></tr></thead>
                                <tbody>
                                    @foreach($trendingProducts as $p)
                                    <tr><td>#{{ $p->id }}</td><td>{{ $p->name }}</td><td class="text-end">{{ $p->views }}</td></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let charts = {};
        const dtConfig = {
            pageLength: 10,
            destroy: true,
            language: { search: "", searchPlaceholder: "Search...", lengthMenu: "_MENU_" },
            dom: '<"d-flex justify-content-between align-items-center p-3"lf>rt<"d-flex justify-content-between align-items-center p-3"ip>'
        };

        function initCharts(res) {
            // Main Sales Chart
            if(charts.sales) charts.sales.destroy();
            charts.sales = new ApexCharts(document.querySelector("#sales-chart"), {
                series: [{ name: 'Revenue', data: res.revenue }, { name: 'Profit', data: res.profit }, { name: 'Expenses', data: res.expenses }],
                chart: { type: 'area', height: 400, toolbar: { show: false } },
                colors: ['#206bc4', '#2fb344', '#d63939'],
                stroke: { curve: 'smooth', width: 2 },
                xaxis: { categories: res.dates },
                fill: { type: 'gradient', gradient: { opacityFrom: 0.2, opacityTo: 0.05 } },
                legend: { position: 'top', horizontalAlign: 'right' },
                yaxis: { labels: { formatter: (val) => "₹" + val.toLocaleString() } },
                tooltip: { y: { formatter: (val) => "₹" + val.toLocaleString() } }
            });
            charts.sales.render();

            // Customers & Orders Line Charts
            [['customers', '#customers-chart', '#4299e1'], ['orders', '#orders-chart', '#f59f00']].forEach(([key, sel, color]) => {
                if(charts[key]) charts[key].destroy();
                charts[key] = new ApexCharts(document.querySelector(sel), {
                    series: [{ name: key.toUpperCase(), data: res[key] }],
                    chart: { type: 'line', height: 300, toolbar: { show: false } },
                    colors: [color],
                    stroke: { curve: 'smooth', width: 3 },
                    xaxis: { categories: res.dates }
                });
                charts[key].render();
            });

            // Retention Chart
            if(charts.retention) charts.retention.destroy();
            charts.retention = new ApexCharts(document.querySelector("#retention-chart"), { 
                series: [{ name: 'Retention', data: res.retention }], 
                chart: { type: 'line', height: 300, toolbar: { show: false } }, 
                stroke: { curve: 'smooth', width: 3 }, 
                colors: ['#74b816'], 
                xaxis: { categories: res.dates } 
            });
            charts.retention.render();

            // Categories Donut
            if(charts.categories) charts.categories.destroy();
            charts.categories = new ApexCharts(document.querySelector("#categories-chart"), { 
                series: res.categorySales.map(i => parseFloat(i.total)), 
                labels: res.categorySales.map(i => i.name), 
                chart: { type: 'donut', height: 300 },
                tooltip: { y: { formatter: (val) => "₹" + val.toLocaleString() } }
            });
            charts.categories.render();

            // Statuses Bar
            if(charts.statuses) charts.statuses.destroy();
            charts.statuses = new ApexCharts(document.querySelector("#statuses-chart"), { 
                series: [{ name: 'Status', data: res.orderStatuses.map(i => parseInt(i.total)) }], 
                chart: { type: 'bar', height: 300, toolbar: { show: false } }, 
                plotOptions: { bar: { horizontal: true, borderRadius: 2 } }, 
                xaxis: { categories: res.orderStatuses.map(i => i.status) }, 
                colors: ['#206bc4'] 
            });
            charts.statuses.render();

            // Payments Pie
            if(charts.payments) charts.payments.destroy();
            charts.payments = new ApexCharts(document.querySelector("#payments-chart"), { 
                series: res.paymentMethods.map(i => parseInt(i.total)), 
                labels: res.paymentMethods.map(i => i.payment_method || 'Unknown'), 
                chart: { type: 'pie', height: 300 } 
            });
            charts.payments.render();

            // Shipping Bar
            if(charts.shipping) charts.shipping.destroy();
            charts.shipping = new ApexCharts(document.querySelector("#shipping-chart"), { 
                series: [{ name: 'Shipping', data: res.shippingMethods.map(i => parseInt(i.total)) }], 
                chart: { type: 'bar', height: 300, toolbar: { show: false } }, 
                xaxis: { categories: res.shippingMethods.map(i => i.shipping_method || 'N/A') }, 
                colors: ['#206bc4'] 
            });
            charts.shipping.render();
        }

        function updateTables(res) {
            // Recent Orders
            const recentOrdersTbody = document.querySelector("#recent-orders-table tbody");
            recentOrdersTbody.innerHTML = res.recentOrders.map(order => `
                <tr>
                    <td>#${order.id}</td>
                    <td>${order.customer}</td>
                    <td class="font-weight-bold">₹${order.amount}</td>
                    <td class="text-uppercase small">${order.payment_method}</td>
                    <td><span class="badge bg-${order.payment_status === 'completed' ? 'green' : 'orange'}-lt">${order.payment_status.charAt(0).toUpperCase() + order.payment_status.slice(1)}</span></td>
                </tr>
            `).join('');

            // Top Selling
            const topSellingTbody = document.querySelector("#top-selling-table tbody");
            topSellingTbody.innerHTML = res.topProducts.map(p => `
                <tr><td>#${p.product_id}</td><td>${p.name}</td><td class="text-end">${p.total_qty}</td></tr>
            `).join('');

            // Trending
            const trendingTbody = document.querySelector("#trending-table tbody");
            trendingTbody.innerHTML = res.trendingProducts.map(p => `
                <tr><td>#${p.id}</td><td>${p.name}</td><td class="text-end">${p.views}</td></tr>
            `).join('');

            // Re-initialize DataTables
            $('#recent-orders-table, #top-selling-table, #trending-table').DataTable().destroy();
            $('#recent-orders-table, #top-selling-table, #trending-table').DataTable(dtConfig);
        }

        function updateWidgets(widgets) {
            document.getElementById('widget-revenue').innerText = widgets.revenue;
            document.getElementById('widget-profit').innerText = widgets.profit;
            document.getElementById('widget-expenses').innerText = widgets.expenses;
            document.getElementById('widget-aov').innerText = widgets.averageOrderValue;
            document.getElementById('widget-orders').innerText = widgets.ordersCount;
            document.getElementById('widget-customers').innerText = widgets.customersCount;
            document.getElementById('widget-products').innerText = widgets.productsCount;
            document.getElementById('widget-conversion').innerText = widgets.conversionRate;
            document.getElementById('widget-tax').innerText = widgets.taxAmount;
            document.getElementById('widget-reviews-avg').innerText = widgets.reviewsAvg;
            document.getElementById('widget-reviews-count').innerText = widgets.reviewsCount;
        }

        function loadData(range) {
            $.ajax({
                url: '{{ route("admin.reports.data") }}',
                data: { date_range: range },
                success: function(res) {
                    updateWidgets(res.widgets);
                    initCharts(res);
                    updateTables(res);
                }
            });
        }

        flatpickr("#report-range", { 
            mode: "range", 
            dateFormat: "Y-m-d", 
            defaultDate: "{{ $dateRange }}", 
            onChange: function(dates, str) { 
                if(dates.length === 2) {
                    loadData(str);
                    const url = new URL(window.location);
                    url.searchParams.set('date_range', str);
                    window.history.pushState({}, '', url);
                }
            } 
        });

        // Initial Load
        loadData("{{ $dateRange }}");
    });
</script>
@endpush
