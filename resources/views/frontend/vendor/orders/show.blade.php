@extends('vendor-layouts.app')
@section('title', 'Order Detail #' . $order->code)
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.orders.index') }}">Orders</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Order {{ $order->code }}</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-primary" onclick="window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                            Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Items</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product_image)
                                                        @php 
                                                            $imageUrl = $item->product_image ? (str_starts_with($item->product_image, 'http') ? $item->product_image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($item->product_image, '/')) : asset('home/placeholder.png');
                                                        @endphp
                                                        <span class="avatar avatar-sm me-2" style="background-image: url({{ $imageUrl }})"></span>
                                                    @endif
                                                    <div class="flex-fill">
                                                        <div class="font-weight-medium text-dark">{{ $item->product_name }}</div>
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
                                            <td class="text-center text-muted">
                                                {{ $item->qty }}
                                            </td>
                                            <td class="text-end text-muted">
                                                ₹{{ number_format($item->price, 2) }}
                                            </td>
                                            <td class="text-end">
                                                ₹{{ number_format($item->getSubtotal(), 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end text-muted">Subtotal</td>
                                        <td class="text-end">₹{{ number_format($order->sub_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end text-muted">Tax</td>
                                        <td class="text-end">₹{{ number_format($order->tax_amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end text-muted">Shipping</td>
                                        <td class="text-end">₹{{ number_format($order->shipping_amount, 2) }}</td>
                                    </tr>
                                    @if($order->discount_amount > 0)
                                        <tr>
                                            <td colspan="3" class="text-end text-muted">Discount</td>
                                            <td class="text-end text-danger">-₹{{ number_format($order->discount_amount, 2) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end font-weight-bold">Total</td>
                                        <td class="text-end font-weight-bold text-primary fs-3">₹{{ number_format($order->amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    @if($order->description)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Order Note</h3>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 text-muted">{{ $order->description }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3 shadow-sm border-primary" style="border-left: 4px solid var(--tblr-primary)">
                        <div class="card-header">
                            <h3 class="card-title">Manage Order</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('frontend.vendor.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Order Status</label>
                                    <select class="form-select" name="status">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary w-100" id="btn-update-status">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10"/></svg>
                                        Update Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>                    <div class="card mb-3 shadow-sm border-info mt-3" style="border-left: 4px solid var(--tblr-info)">
                        <div class="card-header">
                            <h3 class="card-title">Order History Log</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush" style="max-height: 250px; overflow-y: auto;">
                                @forelse($order->histories->sortByDesc('created_at') as $history)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="badge bg-info-lt">Update</span>
                                            <small class="text-muted">{{ $history->created_at->format('M d, H:i') }}</small>
                                        </div>
                                        <div class="small fw-bold">{{ $history->description }}</div>
                                    </div>
                                @empty
                                    <div class="list-group-item text-center text-muted py-4">
                                        No history entries recorded.
                                    </div>
                                @endforelse
                                <div class="list-group-item bg-light-subtle">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="badge bg-success-lt">System</span>
                                        <small class="text-muted">{{ $order->created_at->format('M d, H:i') }}</small>
                                    </div>
                                    <div class="small fw-bold text-success">Order was successfully placed by customer.</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Order Info</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase">Date</label>
                                <div>{{ $order->created_at->format('M d, Y h:i A') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase">Payment Method</label>
                                <div class="badge bg-blue-lt text-uppercase">{{ str_replace(['-', '_'], ' ', $order->payment->payment_channel ?? 'COD') }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted small text-uppercase">Payment Status</label>
                                <div>
                                    @if($order->payment)
                                        @php
                                            $payStatus = $order->payment->status;
                                            $badgeClass = 'bg-secondary'; 
                                            if (in_array($payStatus, ['completed', 'success', 'paid', 'confirmed'])) $badgeClass = 'bg-success text-white';
                                            elseif ($payStatus == 'pending') $badgeClass = 'bg-warning text-white';
                                            elseif (in_array($payStatus, ['failed', 'canceled', 'refunded'])) $badgeClass = 'bg-danger text-white';
                                        @endphp
                                        <span class="badge {{ $badgeClass }} text-capitalize">
                                            {{ str_replace(['-', '_'], ' ', $payStatus) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-lt text-capitalize">No Payment Info Found</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Customer Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="avatar avatar-sm rounded-circle me-2">{{ substr($order->user->name ?? 'G', 0, 1) }}</span>
                                    <strong>{{ $order->user->name ?? 'Guest' }}</strong>
                                </div>
                                <div class="text-muted small">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="5" width="18" height="14" rx="2" /><polyline points="3 7 12 13 21 7" /></svg>
                                    <a href="mailto:{{ $order->user->email ?? '' }}">{{ $order->user->email ?? '' }}</a>
                                </div>
                                <div class="text-muted small mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                    {{ $order->user->phone ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @php $shippingAddress = $order->address->where('type', 'shipping')->first(); @endphp
                    @if($shippingAddress)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Shipping Address</h3>
                            </div>
                            <div class="card-body">
                                <address class="mb-0 text-muted">
                                    <strong class="text-dark">{{ $shippingAddress->name }}</strong><br>
                                    {{ $shippingAddress->address }}<br>
                                    {{ $shippingAddress->city }}, {{ $shippingAddress->state }}<br>
                                    {{ $shippingAddress->country }}<br>
                                    <span class="text-dark small"><abbr title="Phone">Phone:</abbr> {{ $shippingAddress->phone }}</span>
                                </address>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#btn-update-status').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const status = form.find('select[name="status"] option:selected').text();

            Swal.fire({
                title: 'Confirm Status Update',
                text: `Update order status to "${status}"?`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#206bc4',
                cancelButtonColor: '#6c7a91',
                confirmButtonText: 'Yes, update now',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-3 shadow-lg'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Updating order information...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
@endsection
