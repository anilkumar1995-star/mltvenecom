@extends('admin-layouts.app')
@section('title', 'View Customer: ' . $customer->name)
@section('content')

    <div class="page-wrapper">
        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.customers.index') }}">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">View customer: {{ $customer->name }}</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Body -->
        <main class="page-body page-content">
            <div class="container-xl">
                <div class="row row-cards">
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        <!-- Customer Info Card -->
                        <div class="card mb-3">
                             <div class="card-header">
                                <h3 class="card-title">Customer Information</h3>
                            </div>
                            <div class="card-body text-center">
                                <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ $customer->avatar_url }}')"></span>
                                <h3 class="m-0 mb-1"><a href="#">{{ $customer->name }}</a></h3>
                                <div class="text-muted">{{ $customer->email }}</div>
                                
                                <div class="mt-3">
                                    <span class="badge bg-green-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                        Verified
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex p-3 border-top">
                                <!-- Phone -->
                                <div class="w-100 text-center">
                                     @if($customer->phone)
                                        <a href="tel:{{ $customer->phone }}" class="text-reset">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                            {{ $customer->phone }}
                                        </a>
                                    @else
                                        <span class="text-muted">No phone</span>
                                    @endif
                                </div>
                            </div>
                             <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="badge bg-{{ $customer->status === 'activated' ? 'green' : 'secondary' }}"></span></div>
                                        <div class="col text-truncate">
                                            Status
                                        </div>
                                        <div class="col-auto">
                                             <span class="badge bg-{{ $customer->status === 'activated' ? 'green' : 'secondary' }} text-white">{{ ucfirst($customer->status) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            Date of birth
                                        </div>
                                        <div class="col-auto text-muted">
                                            {{ $customer->dob ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col text-truncate">
                                            Created At
                                        </div>
                                        <div class="col-auto text-muted">
                                            {{ $customer->created_at->format('Y-m-d H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="card-footer">
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                    Edit customer
                                </a>
                            </div>
                        </div>

                        <!-- Addresses Card -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Addresses</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @if($customer->is_vendor && $customer->store)
                                    <div class="list-group-item bg-purple-lt">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="mb-1 text-purple"><i class="fas fa-store me-2"></i> {{ $customer->store->name }} (Store Address) <span class="badge bg-purple text-white ms-2">Vendor</span></h4>
                                                <div class="text-muted small">
                                                    {{ $customer->store->address }}<br>
                                                    {{ $customer->store->city }}, {{ $customer->store->state }}<br>
                                                    {{ $customer->store->country }} - {{ $customer->store->zip_code }}<br>
                                                    <i class="fas fa-phone me-1 tiny"></i> {{ $customer->store->phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @forelse($customer->addresses as $address)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="mb-1">{{ $address->name }} @if($address->is_default) <span class="badge bg-primary text-white ms-2">Default</span> @endif</h4>
                                                <div class="text-muted small">
                                                    {{ $address->address }}<br>
                                                    {{ $address->city }}, {{ $address->state }}<br>
                                                    {{ $address->country }} - {{ $address->zip_code }}<br>
                                                    <i class="fas fa-phone me-1 tiny"></i> {{ $address->phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @if(!$customer->is_vendor || !$customer->store)
                                        <div class="list-group-item">
                                            <div class="text-muted text-center">No addresses found</div>
                                        </div>
                                    @endif
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-lg-9">
                        <!-- Stats Row -->
                        <div class="row row-cards mb-3">
                            <!-- Column 1: Active Role Indicator -->
                            <div class="col-sm-6 col-md-3">
                                <div class="card card-sm bg-blue-lt border-primary shadow-xs">
                                     <div class="card-body">
                                         <div class="row align-items-center text-center">
                                              <div class="col">
                                                   <div class="subheader text-primary fw-bold small text-uppercase mb-1">Account Role</div>
                                                   <div class="h2 mb-0 fw-bold">
                                                        @if($customer->is_vendor)
                                                            <span class="badge bg-purple text-purple-fg px-3 rounded-pill shadow-xs">Vendor</span>
                                                        @else
                                                            <span class="badge bg-green text-green-fg px-3 rounded-pill shadow-xs">Customer</span>
                                                        @endif
                                                   </div>
                                              </div>
                                         </div>
                                     </div>
                                </div>
                            </div>

                            @if($customer->is_vendor)
                                <!-- VENDOR MODE STATS -->
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-purple text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">{{ $customer->listed_products_count }}</div>
                                                    <div class="text-muted small">Products Listed</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-indigo text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-truck-delivery" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M5 17h-2v-4m-1 -8h11v12m-4 0h6m4 0h2v-6l-3 -4h-3v4h-6" /><path d="M9 11l3 0" /><path d="M19 16l-.5 0" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">{{ $customer->received_orders_count }}</div>
                                                    <div class="text-muted small">Orders Received</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100 border-start-3 border-success">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-success text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-rupee" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 5h-11h3a4 4 0 0 1 0 8h-3l6 6" /><path d="M7 9l11 0" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">₹{{ number_format($customer->total_revenue_sum ?? 0, 2) }}</div>
                                                    <div class="text-muted small">Total Revenue</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- CUSTOMER MODE STATS -->
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-primary text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">{{ $totalOrders }}</div>
                                                    <div class="text-muted small">Purchases Made</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-yellow text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">{{ $customer->reviews->count() }}</div>
                                                    <div class="text-muted small">Reviews Posted</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-sm shadow-xs h-100 border-start-3 border-green">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <span class="bg-green text-white avatar shadow-xs">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h10l-5 10l-5 -10z" /><path d="M8 8a4 4 0 0 1 8 0" /></svg>
                                                    </span>
                                                </div>
                                                <div class="col">
                                                    <div class="font-weight-medium h3 mb-0">₹{{ number_format($totalSpent, 2) }}</div>
                                                    <div class="text-muted small">Total Spent</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Recent Orders (Purchases) -->
                        <div class="card mb-3 shadow-xs border-0">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title fw-bold text-dark"><i class="fas fa-shopping-bag me-2 text-primary"></i> Recent Purchases</h3>
                            </div>
                            <div class="card-table">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable table-hover">
                                        <thead class="bg-light small text-uppercase">
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th class="text-center">Amount</th>
                                                <th>Method</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($customer->orders->take(5) as $order)
                                                <tr>
                                                    <td class="fw-bold"><a href="{{ route('admin.orders.edit', $order->id) }}" class="text-decoration-none">#{{ $order->id }}</a></td>
                                                    <td class="text-muted small">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                    <td class="text-center fw-bold">₹{{ number_format($order->amount, 2) }}</td>
                                                    <td class="small">{{ strtoupper($order->payment_method ?: 'cod') }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-{{ $order->status === 'completed' ? 'green' : ($order->status === 'canceled' ? 'red' : 'yellow') }} text-white px-2 rounded-pill">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-ghost-primary rounded-pill">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted small">No purchases found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @if($customer->is_vendor)
                            <!-- Recent Sales (Received) -->
                            <div class="card mb-3 shadow-xs border-0">
                                <div class="card-header bg-white py-3 border-start-3 border-purple">
                                    <h3 class="card-title fw-bold text-dark"><i class="fas fa-store me-2 text-purple"></i> Recent Sales</h3>
                                </div>
                                <div class="card-table">
                                    <div class="table-responsive">
                                        <table class="table card-table table-vcenter text-nowrap datatable table-hover">
                                            <thead class="bg-light small text-uppercase">
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Date</th>
                                                    <th class="text-center">Total</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customer->vendorOrders->take(5) as $vOrder)
                                                    <tr>
                                                        <td class="fw-bold"><a href="{{ route('admin.orders.edit', $vOrder->id) }}" class="text-decoration-none">#{{ $vOrder->id }}</a></td>
                                                        <td class="text-muted small">{{ $vOrder->created_at->format('Y-m-d H:i') }}</td>
                                                        <td class="text-center fw-bold text-purple">₹{{ number_format($vOrder->amount, 2) }}</td>
                                                        <td class="text-center">
                                                            <span class="badge bg-{{ $vOrder->status === 'completed' ? 'green' : ($vOrder->status === 'canceled' ? 'red' : 'yellow') }} text-white px-2 rounded-pill">
                                                                {{ ucfirst($vOrder->status) }}
                                                            </span>
                                                        </td>
                                                        <td class="text-end">
                                                            <a href="{{ route('admin.orders.edit', $vOrder->id) }}" class="btn btn-sm btn-ghost-purple rounded-pill">Manage</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center py-4 text-muted small">No sales recorded yet.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Recent Reviews -->
                        <div class="card mb-3 shadow-xs border-0">
                            <div class="card-header bg-white py-3">
                                <h3 class="card-title fw-bold text-dark"><i class="fas fa-star me-2 text-warning"></i> Recent Reviews</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                @forelse($customer->reviews->take(5) as $review)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-md rounded" style="background-image: url({{ $review->product && $review->product->image ? asset('storage/' . $review->product->image) : asset('home/placeholder.png') }})"></div>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex justify-content-between">
                                                    <span class="font-weight-bold text-dark">{{ $review->product->name ?? 'Unknown Product' }}</span>
                                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="text-yellow mt-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->star ? 'fill-yellow' : 'opacity-20' }} small"></i>
                                                    @endfor
                                                </div>
                                                <div class="mt-2 text-muted small italic">
                                                    "{{ Str::limit($review->comment, 150) }}"
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5 text-muted small bg-white">No reviews posted yet.</div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

@endsection
