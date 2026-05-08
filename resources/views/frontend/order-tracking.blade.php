@extends('frontend.layouts.app')

@section('title', 'Order Tracking')

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
        position: relative;
    }
    .tp-order-inner {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
    }
    .tp-order-info-wrapper .form-label {
        font-weight: 700;
        color: #010f1c;
        margin-bottom: 8px;
    }
    .form-control {
        padding: 12px 15px;
        border-radius: 8px;
        border: 1.5px solid #ebebeb;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(103, 142, 97, 0.1);
    }
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 14px;
        border-radius: 8px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #557750;
        border-color: #557750;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(103, 142, 97, 0.3);
    }
    .order-details-card {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    }
    .badge-status {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pb-20 mb-20 pt-20 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Order tracking</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Order tracking </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-order-area pb-40 pt-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="tp-order-inner">
                        <div class="tp-order-info-wrapper">
                            <form method="POST" action="{{ route('frontend.orders.tracking.post') }}" id="botble-ecommerce-forms-fronts-order-tracking-form" class="js-base-form">
                                @csrf
                                <div class="mb-4 position-relative">
                                    <label class="form-label required" for="order_id">Order ID</label>
                                    <input class="form-control" placeholder="Enter the order ID (e.g. 1)" required="required" name="order_id" type="text" id="order_id" value="{{ request('order_id') }}">
                                </div>
                                <div class="mb-4 position-relative">
                                    <label class="form-label required" for="email">Email</label>
                                    <input class="form-control" placeholder="Enter your billing email" required="required" name="email" type="email" id="email" value="{{ request('email') }}">
                                </div>
                                <button class="w-100 btn btn-primary" type="submit">Track Now</button>
                            </form>
                        </div>
                    </div>

                    @if(isset($order) && $order)
                        <div class="card mt-5 order-details-card">
                            <div class="card-header bg-white border-bottom py-4 px-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 fw-bold">Order <span class="text-primary">#{{ $order->code }}</span> details</h5>
                                    <span class="badge-status bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }} text-{{ $order->status == 'pending' ? 'dark' : 'white' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-1 small uppercase fw-bold">Order Placed On</p>
                                        <p class="fw-bold fs-5">{{ $order->created_at->format('M d, Y') }} at {{ $order->created_at->format('h:i A') }}</p>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <p class="text-muted mb-1 small uppercase fw-bold">Tracking ID</p>
                                        <p class="fw-bold fs-5 text-secondary">{{ $order->code }}</p>
                                    </div>
                                </div>

                                <div class="items-wrapper mb-4">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                                        <i class="fas fa-shopping-basket me-2 text-primary"></i> Order Items
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table table-borderless align-middle">
                                            <thead>
                                                <tr class="border-bottom">
                                                    <th class="py-3 text-muted fw-semi-bold">Product</th>
                                                    <th class="py-3 text-center text-muted fw-semi-bold">Quantity</th>
                                                    <th class="py-3 text-end text-muted fw-semi-bold">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                <tr class="border-bottom-faint">
                                                    <td class="py-3">
                                                        <div class="d-flex align-items-center">
                                                            @if($item->product && $item->product->image)
                                                                <div class="product-thumb me-3">
                                                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $item->product->image }}" alt="" style="width: 60px; height: 60px; object-fit: cover; border-radius: 12px; border: 1px solid #f0f0f0;">
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <span class="fw-bold d-block">{{ $item->product_name }}</span>
                                                                @if($item->options)
                                                                    <small class="text-muted">{{ is_array($item->options) ? implode(', ', $item->options) : $item->options }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center py-3 fw-bold">{{ $item->qty }}</td>
                                                    <td class="text-end py-3 fw-bold">₹{{ number_format($item->price * $item->qty, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-7">
                                        <div class="p-3 bg-light rounded-4 h-100">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="fas fa-map-marker-alt me-2 text-primary"></i> Shipping Address
                                            </h6>
                                            @php $shipping = $order->address->where('type', 'shipping')->first() ?? $order->address->first(); @endphp
                                            @if($shipping)
                                                <div class="address-details">
                                                    <p class="fw-bold mb-1">{{ $shipping->name }}</p>
                                                    <p class="text-muted mb-0 small">
                                                        {{ $shipping->address }}<br>
                                                        {{ $shipping->city }}, {{ $shipping->state }} {{ $shipping->zip_code }}<br>
                                                        {{ $shipping->country }}<br>
                                                        <span class="mt-2 d-block"><i class="fas fa-phone-alt me-1"></i> {{ $shipping->phone }}</span>
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="p-3 bg-light rounded-4 h-100">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="fas fa-receipt me-2 text-primary"></i> Summary
                                            </h6>
                                            <div class="summary-list">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-muted small">Subtotal</span>
                                                    <span class="fw-bold">₹{{ number_format($order->sub_total, 2) }}</span>
                                                </div>
                                                @if($order->shipping_amount > 0)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-muted small">Shipping</span>
                                                    <span class="fw-bold">₹{{ number_format($order->shipping_amount, 2) }}</span>
                                                </div>
                                                @endif
                                                @if($order->tax_amount > 0)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-muted small">Tax</span>
                                                    <span class="fw-bold">₹{{ number_format($order->tax_amount, 2) }}</span>
                                                </div>
                                                @endif
                                                @if($order->discount_amount > 0)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span class="text-muted small text-danger">Discount</span>
                                                    <span class="fw-bold text-danger">-₹{{ number_format($order->discount_amount, 2) }}</span>
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                                    <span class="fw-bold">Grand Total</span>
                                                    <span class="fw-bold fs-5 text-primary">₹{{ number_format($order->amount, 2) }}</span>
                                                </div>
                                                <div class="mt-3 text-end">
                                                    <small class="text-muted d-block">Method: {{ str_replace('_', ' ', ucfirst($order->shipping_method)) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
</main>
@endsection
