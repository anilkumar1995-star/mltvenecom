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
                                @if($customer->avatar)
                                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url('{{ asset('storage/' . $customer->avatar) }}')"></span>
                                @else
                                    <span class="avatar avatar-xl mb-3 rounded bg-secondary-lt">{{ strtoupper(substr($customer->name, 0, 2)) }}</span>
                                @endif
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
                                             <span class="badge bg-{{ $customer->status === 'activated' ? 'green' : 'secondary' }}">{{ ucfirst($customer->status) }}</span>
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
                                @forelse($customer->addresses as $address)
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h4 class="mb-1">{{ $address->name }} @if($address->is_default) <span class="badge bg-primary ms-2">Default</span> @endif</h4>
                                                <div class="text-muted small">
                                                    {{ $address->address }}<br>
                                                    {{ $address->city }}, {{ $address->state }}<br>
                                                    {{ $address->country }} - {{ $address->zip_code }}<br>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone" width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg> {{ $address->phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item">
                                        <div class="text-muted text-center">No addresses found</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-lg-9">
                        <!-- Stats Row -->
                        <div class="row row-cards mb-3">
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-primary text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M17 17h-11v-14h-2" /><path d="M6 5l14 1l-1 7h-13" /></svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $totalOrders }}
                                                </div>
                                                <div class="text-muted">
                                                    Total Orders
                                                </div>
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
                                                <span class="bg-green text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $completedOrders }}
                                                </div>
                                                <div class="text-muted">
                                                    Completed Orders
                                                </div>
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
                                                <span class="bg-yellow text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-package" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ $totalProducts }}
                                                </div>
                                                <div class="text-muted">
                                                    Total Products
                                                </div>
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
                                                <span class="bg-purple text-white avatar">
                                                    <!-- Currency Icon, assume generic or dollar -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" /><path d="M12 3v3m0 12v3" /></svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium">
                                                    {{ number_format($totalSpent, 2) }}
                                                </div>
                                                <div class="text-muted">
                                                    Total Spent
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Orders -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Recent Orders</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Created At</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->orders->take(5) as $order)
                                            <tr>
                                                <td><a href="#">#{{ $order->id }}</a></td>
                                                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                <td>{{ number_format($order->amount, 2) }}</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $order->status === 'completed' ? 'green' : ($order->status === 'canceled' ? 'red' : 'yellow') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">View Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">No orders found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Recent Reviews -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Recent Reviews ({{ $customer->reviews->count() }})</h3>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse($customer->reviews->take(5) as $review)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-auto">
                                                @if($review->product && $review->product->image)
                                                    <img src="{{ asset('storage/' . $review->product->image) }}" class="avatar" alt="{{ $review->product->name }}">
                                                @else
                                                    <span class="avatar bg-secondary-lt">P</span>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="d-flex justify-content-between">
                                                    <a href="#" class="text-reset font-weight-bold">{{ $review->product->name ?? 'Unknown Product' }}</a>
                                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="text-muted mt-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star {{ $i <= $review->star ? 'text-yellow fill-yellow' : 'text-muted' }}" width="12" height="12" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                                    @endfor
                                                    <span class="ms-2">({{ $review->star }}/5)</span>
                                                </div>
                                                <div class="mt-2 text-muted">
                                                    {{ Str::limit($review->comment, 150) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item">
                                        <div class="text-muted text-center">No reviews found</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>

@endsection
