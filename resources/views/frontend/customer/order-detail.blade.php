@extends('frontend.layouts.app')

@section('title', 'Order Details')

@section('content')
  <main>
        <div class="bb-customer-page crop-avatar">
            <div class="container">
                <div class="customer-body">
                    <div class="d-lg-none bg-white border-bottom p-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="wrapper-image page_speed_3267104">
                                    <img class="rounded-circle img-fluid" style="width:40px;height:40px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $customer->name ?? 'User' }}</div>
                                    <div class="text-muted small">Account Dashboard</div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#customerSidebar" aria-controls="customerSidebar">
                                <svg class="icon icon-sm" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 6l16 0" />
                                    <path d="M4 12l16 0" />
                                    <path d="M4 18l16 0" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="row g-0">
                        {{-- Desktop Sidebar --}}
                        <div class="col-lg-3 col-xl-3 d-none d-lg-block">
                            <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                                <div class="bb-customer-sidebar flex-1">
                                    <div class="bb-customer-sidebar-heading">
                                        <div class="d-flex align-items-center gap-3 p-4">
                                            <div class="position-relative">
                                                <div class="wrapper-image">
                                                    <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                                </div>
                                                <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                                <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @include('frontend.customer.sidebar', ['active' => 'orders'])
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-9">
                            <div class="bb-profile-content p-4 p-md-5">
                                <div class="bb-profile-header mb-4 d-flex justify-content-between align-items-center">
                                    <h1 class="bb-profile-header-title h3 mb-0"> Order Details #{{ $order->id }} </h1>
                                    <a href="{{ route('frontend.customer.orders') }}" class="btn btn-outline-secondary btn-sm">
                                        Back to Orders
                                    </a>
                                </div>
                                <div class="bb-profile-main">
                                    
                                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                                        <div class="card-body p-4 d-flex justify-content-between">
                                            <div>
                                                <h6 class="text-muted mb-1">Order Date</h6>
                                                <p class="mb-0 fw-semibold">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                            <div>
                                                <h6 class="text-muted mb-1">Order Status</h6>
                                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                            <div class="text-end">
                                                <h6 class="text-muted mb-1">Total Amount</h6>
                                                <p class="mb-0 fw-bold fs-5">₹{{ number_format($order->amount, 2) }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <h5 class="fw-semibold mb-3">Order Items</h5>
                                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                                        <div class="table-responsive">
                                            <table class="table mb-0 align-middle">
                                                <thead class="table-light text-muted">
                                                    <tr>
                                                        <th class="ps-4">Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th class="pe-4 text-end">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order->items as $item)
                                                        <tr>
                                                            <td class="ps-4 py-3">
                                                                <div class="d-flex align-items-center gap-3">
                                                                    @if($item->product && $item->product->image)
                                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded shadow-sm" width="50" height="50" style="object-fit:cover;">
                                                                    @else
                                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px; height:50px;">
                                                                            <svg class="icon text-muted" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                                                <polyline points="21 15 16 10 5 21" />
                                                                            </svg>
                                                                        </div>
                                                                    @endif
                                                                    <div>
                                                                        <h6 class="mb-0 fw-semibold">{{ $item->product ? $item->product->name : 'Product Not Found' }}</h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="py-3">₹{{ number_format($item->price, 2) }}</td>
                                                            <td class="py-3">{{ $item->qty }}</td>
                                                            <td class="pe-4 py-3 text-end fw-semibold">₹{{ number_format($item->price * $item->qty, 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot class="table-light">
                                                    <tr>
                                                        <td colspan="3" class="text-end fw-semibold py-3">Total Amount:</td>
                                                        <td class="pe-4 py-3 text-end fw-bold text-primary">₹{{ number_format($order->amount, 2) }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Mobile Sidebar Offcanvas --}}
            <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="customerSidebar" aria-labelledby="customerSidebarLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="customerSidebarLabel">Account Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                        <div class="bb-customer-sidebar flex-1">
                            <div class="bb-customer-sidebar-heading">
                                <div class="d-flex align-items-center gap-3 p-4">
                                    <div class="position-relative">
                                        <div class="wrapper-image">
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxIDEiPjwvc3ZnPg==" alt="{{ $customer->name ?? 'User' }}">
                                        </div>
                                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="name fw-semibold text-truncate">{{ $customer->name ?? 'User' }}</div>
                                        <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.customer.sidebar', ['active' => 'orders'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </main>
@endsection
