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
                                    <img class="rounded-circle img-fluid" style="width:40px;height:40px;" src="{{ $customer->avatar_url ?? '' }}" alt="{{ $customer->name ?? 'User' }}">
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
                                                    <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="{{ $customer->avatar_url ?? '' }}" alt="{{ $customer->name ?? 'User' }}">
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
                                    <h1 class="bb-profile-header-title h3 mb-0"> Order Details ({{ $order->code }}) </h1>
                                    <a href="{{ route('frontend.customer.orders') }}" class="btn btn-outline-secondary btn-sm">
                                        Back to Orders
                                    </a>
                                </div>
                                <div class="bb-profile-main">
                                    {{-- Order Timeline --}}
                                    <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
                                        <div class="card-header bg-primary text-white py-3">
                                            <h5 class="mb-0 fw-bold">Track Your Order Progress</h5>
                                        </div>
                                        <div class="card-body p-4 bg-light bg-opacity-10">
                                            <div class="order-tracking-timeline">
                                                @php
                                                    $steps = [
                                                        ['status' => 'pending', 'icon' => 'shopping-cart', 'label' => 'Placed'],
                                                        ['status' => 'processing', 'icon' => 'cog', 'label' => 'Processing'],
                                                        ['status' => 'shipped', 'icon' => 'truck', 'label' => 'Shipped'],
                                                        ['status' => 'completed', 'icon' => 'check-circle', 'label' => 'Delivered']
                                                    ];
                                                    
                                                    // Determine the current step index
                                                    $currentStepIdx = 0;
                                                    foreach($steps as $idx => $step) {
                                                        if($order->status == $step['status']) $currentStepIdx = $idx;
                                                    }
                                                    if($order->status == 'completed') $currentStepIdx = 3;
                                                    if($order->status == 'canceled') $currentStepIdx = -1;
                                                @endphp

                                                <div class="timeline-steps d-flex justify-content-between position-relative">
                                                    @foreach($steps as $idx => $step)
                                                        @php
                                                            $isActive = ($idx <= $currentStepIdx) && ($order->status != 'canceled');
                                                            $isCurrent = ($idx == $currentStepIdx);
                                                        @endphp
                                                        <div class="timeline-step text-center flex-fill position-relative z-index-1">
                                                            <div class="timeline-icon mx-auto mb-2 rounded-circle d-flex align-items-center justify-content-center shadow-sm 
                                                                {{ $isActive ? 'bg-primary text-white' : 'bg-white text-muted border' }} 
                                                                {{ $isCurrent ? 'pulse-primary' : '' }}" 
                                                                style="width: 45px; height: 45px;">
                                                                <i class="fas fa-{{ $step['icon'] }}"></i>
                                                            </div>
                                                            <div class="timeline-label small fw-bold {{ $isActive ? 'text-primary' : 'text-muted' }}">
                                                                {{ $step['label'] }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    
                                                    {{-- Progress Line --}}
                                                    <div class="position-absolute top-50 start-0 translate-middle-y w-100 bg-secondary bg-opacity-25" style="height: 4px; z-index: 0; margin-top: -12px;">
                                                        <div class="bg-primary h-100 transition-all" style="width: {{ $order->status == 'canceled' ? '0' : ($currentStepIdx * 33.33) }}%;"></div>
                                                    </div>
                                                </div>

                                                @if($order->status == 'canceled')
                                                    <div class="mt-4 p-2 bg-danger bg-opacity-10 rounded border border-danger text-danger text-center fw-bold small">
                                                        <i class="fas fa-times-circle me-1"></i> THIS ORDER HAS BEEN CANCELED
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
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
                                                                    @php
                                                                        $pImg = $item->product_image ?: ($item->product ? $item->product->image : null);
                                                                        $pImgUrl = $pImg ? (str_starts_with($pImg, 'http') ? $pImg : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($pImg, '/')) : asset('home/placeholder.png');
                                                                    @endphp
                                                                    <img src="{{ $pImgUrl }}" alt="{{ $item->product_name }}" class="rounded shadow-sm" width="50" height="50" style="object-fit:cover;">
                                                                    <div>
                                                                        <h6 class="mb-0 fw-semibold text-wrap">{{ $item->product_name ?: ($item->product ? $item->product->name : 'Product Not Found') }}</h6>
                                                                        @if($item->options)
                                                                            <div class="text-muted small">
                                                                                @foreach($item->options as $key => $value)
                                                                                    {{ ucfirst($key) }}: {{ $value }}@if(!$loop->last), @endif
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
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

                                    <h5 class="fw-semibold mb-3 mt-4">Order History Log</h5>
                                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                                        <div class="card-body p-0 text-start">
                                            <ul class="list-group list-group-flush mb-0">
                                                <li class="list-group-item bg-light-subtle d-flex justify-content-between align-items-center py-3">
                                                    <div class="d-flex align-items-center text-start">
                                                        <div class="bg-primary rounded-circle p-2 text-white me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px;">
                                                            <i class="fas fa-plus small text-white"></i>
                                                        </div>
                                                        <div class="text-start">
                                                            <div class="fw-bold fs-6">Order was created</div>
                                                            <div class="text-muted small">Success: Listing generated in the system.</div>
                                                        </div>
                                                    </div>
                                                    <div class="text-end small text-muted ms-2 flex-shrink-0">{{ $order->created_at->format('M d, H:i') }}</div>
                                                </li>
                                                @foreach($order->histories->sortByDesc('created_at') as $history)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                        <div class="d-flex align-items-center text-start">
                                                            <div class="bg-info rounded-circle p-2 text-white me-3 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px;">
                                                                <i class="fas fa-edit small text-white"></i>
                                                            </div>
                                                            <div class="text-start">
                                                                <div class="fw-bold fs-6 text-wrap">{{ $history->description }}</div>
                                                                @if(isset($history->extras['vendor_name']))
                                                                    <div class="text-muted small italic">Update provided by {{ $history->extras['vendor_name'] }}</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="text-end small text-muted ms-2 flex-shrink-0">{{ $history->created_at->format('M d, H:i') }}</div>
                                                    </li>
                                                @endforeach
                                            </ul>
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
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="{{ $customer->avatar_url ?? '' }}" alt="{{ $customer->name ?? 'User' }}">
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
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .pulse-primary { animation: pulse-primary-anim 2s infinite; }
    @keyframes pulse-primary-anim {
        0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(13, 110, 253, 0); }
        100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0); }
    }
    .transition-all { transition: all 0.5s ease-in-out; }
    .z-index-1 { z-index: 1; }
    .italic { font-style: italic; }
</style>
@endpush
@endsection
