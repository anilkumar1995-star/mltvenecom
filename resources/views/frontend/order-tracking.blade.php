@extends('frontend.layouts.app')

@section('title', 'Order Tracking')

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f5f5f5;
        background-image: url('{{ asset("storage/main/general/breadcrumb.jpg") }}');
        background-size: cover;
        background-position: center;
    }
    .tp-order-inner {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .tp-order-info-wrapper .form-label {
        font-weight: 600;
        color: #010f1c;
    }
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 12px;
        font-weight: 600;
    }
    .btn-primary:hover {
        background-color: var(--tp-theme-secondary);
        border-color: var(--tp-theme-secondary);
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 text-start">
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

    <section class="tp-order-area pb-120">
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
                        <div class="card mt-5 border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="mb-0">Order {{ $order->code }} details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <p class="text-muted mb-1">Status</p>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <p class="text-muted mb-1">Order Date</p>
                                        <p class="fw-bold">{{ $order->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3">Items</h6>
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-end">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($item->product && $item->product->image)
                                                            <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $item->product->image }}" alt="" style="width: 50px; height: 50px; object-fit: cover;" class="me-3 rounded">
                                                        @endif
                                                        <span>{{ $item->product_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-end">₹{{ number_format($item->price * $item->qty, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-end">Subtotal</th>
                                                <td class="text-end">₹{{ number_format($order->sub_total, 2) }}</td>
                                            </tr>
                                            @if($order->shipping_amount > 0)
                                            <tr>
                                                <th colspan="2" class="text-end">Shipping</th>
                                                <td class="text-end">₹{{ number_format($order->shipping_amount, 2) }}</td>
                                            </tr>
                                            @endif
                                            @if($order->tax_amount > 0)
                                            <tr>
                                                <th colspan="2" class="text-end">Tax</th>
                                                <td class="text-end">₹{{ number_format($order->tax_amount, 2) }}</td>
                                            </tr>
                                            @endif
                                            @if($order->discount_amount > 0)
                                            <tr>
                                                <th colspan="2" class="text-end">Discount</th>
                                                <td class="text-end text-danger">-₹{{ number_format($order->discount_amount, 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr class="fw-bold border-top">
                                                <th colspan="2" class="text-end fs-5">Total</th>
                                                <td class="text-end fs-5 text-primary">₹{{ number_format($order->amount, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h6 class="fw-bold mb-2">Shipping Address</h6>
                                        @php $shipping = $order->address->where('type', 'shipping')->first() ?? $order->address->first(); @endphp
                                        @if($shipping)
                                            <address class="text-muted mb-0">
                                                {{ $shipping->name }}<br>
                                                {{ $shipping->address }}<br>
                                                {{ $shipping->city }}, {{ $shipping->state }} {{ $shipping->zip_code }}<br>
                                                {{ $shipping->country }}<br>
                                                {{ $shipping->phone }}
                                            </address>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <h6 class="fw-bold mb-2">Payment Method</h6>
                                        <p class="text-muted">{{ str_replace('_', ' ', ucfirst($order->shipping_method)) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif(request()->isMethod('post'))
                        <div class="alert alert-danger mt-4">
                            No order found with the provided details. Please check your Order ID and Email.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
