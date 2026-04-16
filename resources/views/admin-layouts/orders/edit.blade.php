@extends('admin-layouts.app')
@section('title', 'Edit Order #' . $order->id)
@section('content')

    <div class="page-wrapper">
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.orders.index') }}">Orders</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit Order #{{ $order->id }}</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="edit-order-form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- LEFT COLUMN: Main Content --}}
                        <div class="col-md-9">
                            {{-- Product Items Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                        <li class="nav-item">
                                            <a href="#tabs-products" class="nav-link active" data-bs-toggle="tab">Products</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="tabs-products">
                                            {{-- Product Search --}}
                                            <div class="mb-3">
                                                <label class="form-label">Search and add products</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="product-search" placeholder="Search by product name or SKU..." autocomplete="off">
                                                    <div class="list-group mt-1 position-absolute w-100 shadow-sm" id="product-results" style="display:none; max-height: 250px; overflow-y: auto; z-index: 100;"></div>
                                                </div>
                                            </div>

                                            {{-- Products Table --}}
                                            <div class="table-responsive">
                                                <table class="table table-vcenter table-mobile-md card-table" id="order-items-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th style="width: 120px;">Price</th>
                                                            <th style="width: 100px;">Quantity</th>
                                                            <th style="width: 120px;" class="text-end">Total</th>
                                                            <th style="width: 40px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="order-items-body">
                                                        @foreach($products as $product)
                                                        @php 
                                                            $displayImage = $product->image ?: (is_array($product->images) && !empty($product->images) ? $product->images[0] : null);
                                                            $imageUrl = $displayImage ? (str_starts_with($displayImage, 'http') ? $displayImage : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($displayImage, '/')) : asset('home/placeholder.png');
                                                        @endphp
                                                        <tr id="product-row-{{ $product->id }}">
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <span class="avatar avatar-sm me-2" style="background-image: url({{ $imageUrl }})"></span>
                                                                    <div class="flex-fill">
                                                                        <div class="fw-medium">{{ $product->name }}</div>
                                                                        <div class="text-muted small">
                                                                            @if($product->weight > 0)
                                                                                1 pack ({{ (float)$product->weight }} {{ $product->unit_type ?: 'kg' }})
                                                                            @else
                                                                                1 unit
                                                                            @endif
                                                                        </div>
                                                                        <input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
                                                                        <input type="hidden" name="products[{{ $product->id }}][name]" value="{{ $product->name }}">
                                                                        <input type="hidden" name="products[{{ $product->id }}][price]" value="{{ $product->price }}">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>₹{{ number_format($product->price, 2) }}</td>
                                                            <td>
                                                                <div class="input-group input-group-sm" style="width: 110px;">
                                                                    <button type="button" class="btn btn-outline-secondary btn-sm qty-minus" data-id="{{ $product->id }}">−</button>
                                                                    <input type="number" class="form-control form-control-sm text-center qty-input" name="products[{{ $product->id }}][quantity]" value="{{ $product->qty }}" min="1" data-id="{{ $product->id }}" style="width: 45px;">
                                                                    <button type="button" class="btn btn-outline-secondary btn-sm qty-plus" data-id="{{ $product->id }}">+</button>
                                                                </div>
                                                            </td>
                                                            <td class="text-end row-total">₹{{ number_format($product->price * $product->qty, 2) }}</td>
                                                            <td>
                                                                <a href="#" class="btn btn-icon btn-sm btn-outline-danger remove-product" data-id="{{ $product->id }}" title="Remove">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr id="no-products-row" style="{{ count($products) > 0 ? 'display:none;' : '' }}">
                                                            <td colspan="5" class="text-center text-muted py-4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg mb-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 17h-11v-14h-2"/><path d="M6 5l14 1l-1 7h-13"/></svg>
                                                                <div>No products added yet. Use the search above to add products.</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Sub total</td>
                                                            <td class="text-end fw-bold border-0" id="subtotal-display">₹{{ number_format($order->sub_total, 2) }}</td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Discount</td>
                                                            <td class="border-0">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text">₹</span>
                                                                    <input type="number" step="0.01" class="form-control form-control-sm text-end" name="discount_amount" id="discount-amount" value="{{ $order->discount_amount }}">
                                                                </div>
                                                            </td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Shipping fee</td>
                                                            <td class="border-0">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text">₹</span>
                                                                    <input type="number" step="0.01" class="form-control form-control-sm text-end" name="shipping_amount" id="shipping-amount" value="{{ $order->shipping_amount }}">
                                                                </div>
                                                            </td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-top">Total amount</td>
                                                            <td class="text-end fw-bold border-top text-primary fs-4" id="total-display">₹{{ number_format($order->amount, 2) }}</td>
                                                            <td class="border-top"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Customer Information Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Customer information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Customer</label>
                                                <div id="selected-customer-info" class="mt-2">
                                                    <div class="alert alert-info d-flex align-items-center mb-0 py-2">
                                                        <div class="flex-fill">
                                                            <strong>{{ $order->user->name ?? 'Guest' }}</strong>
                                                            <div class="text-muted small">{{ $order->user->email ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Store</label>
                                                <select class="form-select" name="store_id">
                                                    <option value="1" {{ $order->store_id == 1 ? 'selected' : '' }}>Default Store</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Shipping & Billing Address Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Address information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="mb-3">Shipping address</h5>
                                            <div class="mb-3">
                                                <label class="form-label">Full name</label>
                                                <input type="text" class="form-control" name="shipping_name" id="ship-name" value="{{ $shippingAddress->name ?? '' }}" placeholder="Full name">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="shipping_phone" id="ship-phone" value="{{ $shippingAddress->phone ?? '' }}" placeholder="Phone">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="shipping_email" id="ship-email" value="{{ $shippingAddress->email ?? '' }}" placeholder="Email">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <select class="form-select" name="shipping_country" id="ship-country">
                                                    <option value="IN" {{ ($shippingAddress->country ?? '') == 'IN' ? 'selected' : '' }}>India</option>
                                                    <option value="US" {{ ($shippingAddress->country ?? '') == 'US' ? 'selected' : '' }}>United States</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="shipping_state" id="ship-state" value="{{ $shippingAddress->state ?? '' }}" placeholder="State">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="shipping_city" id="ship-city" value="{{ $shippingAddress->city ?? '' }}" placeholder="City">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="shipping_address" id="ship-address" value="{{ $shippingAddress->address ?? '' }}" placeholder="Address">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Zip code</label>
                                                <input type="text" class="form-control" name="shipping_zipcode" id="ship-zip" value="{{ $shippingAddress->zip_code ?? '' }}" placeholder="Zip code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="mb-0">Billing address</h5>
                                                <label class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" id="same-as-shipping" name="same_as_shipping" value="1" {{ !$billingAddress ? 'checked' : '' }}>
                                                    <span class="form-check-label">Same as shipping</span>
                                                </label>
                                            </div>
                                            <div id="billing-fields" style="{{ !$billingAddress ? 'display: none;' : '' }}">
                                                <div class="mb-3">
                                                    <label class="form-label">Full name</label>
                                                    <input type="text" class="form-control" name="billing_name" value="{{ $billingAddress->name ?? '' }}" placeholder="Full name">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" class="form-control" name="billing_phone" value="{{ $billingAddress->phone ?? '' }}" placeholder="Phone">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="billing_email" value="{{ $billingAddress->email ?? '' }}" placeholder="Email">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" name="billing_state" value="{{ $billingAddress->state ?? '' }}" placeholder="State">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" name="billing_city" value="{{ $billingAddress->city ?? '' }}" placeholder="City">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="billing_address" value="{{ $billingAddress->address ?? '' }}" placeholder="Address">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Zip code</label>
                                                    <input type="text" class="form-control" name="billing_zipcode" value="{{ $billingAddress->zip_code ?? '' }}" placeholder="Zip code">
                                                </div>
                                            </div>
                                            <div id="billing-same-msg" class="text-muted" style="{{ !$billingAddress ? '' : 'display: none;' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10"/></svg>
                                                Billing address will be same as shipping address
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Note Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Note</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0">
                                        <label class="form-label">Private notes</label>
                                        <textarea class="form-control" name="description" rows="3" placeholder="Private notes">{{ $order->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT COLUMN: Sidebar --}}
                        <div class="col-md-3">
                            {{-- Publish Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Publish</h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit">
                                            Update Order
                                        </button>
                                        <a href="{{ route('admin.orders.index') }}" class="btn btn-link">Cancel</a>
                                    </div>
                                </div>
                            </div>

                            {{-- Order Status Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Order status</h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="status" required>
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Payment Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Payment Info</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Method</label>
                                        <select class="form-select" name="payment_method">
                                            <option value="cod" {{ ($order->payment->payment_channel ?? '') == 'cod' ? 'selected' : '' }}>COD</option>
                                            <option value="bank_transfer" {{ ($order->payment->payment_channel ?? '') == 'bank_transfer' ? 'selected' : '' }}>Bank transfer</option>
                                            <option value="upi" {{ ($order->payment->payment_channel ?? '') == 'upi' ? 'selected' : '' }}>UPI</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="payment_status">
                                            <option value="pending" {{ ($order->payment->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ ($order->payment->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="refunded" {{ ($order->payment->status ?? '') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const currencySymbol = '₹';

        $('#same-as-shipping').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billing-fields').hide();
                $('#billing-same-msg').show();
            } else {
                $('#billing-fields').show();
                $('#billing-same-msg').hide();
            }
        });

        // Product Search logic same as create
        let searchTimeout;
        $('#product-search').on('keyup', function() {
            let query = $(this).val();
            clearTimeout(searchTimeout);
            if (query.length > 2) {
                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: '{{ route("admin.orders.search-product") }}',
                        data: { q: query },
                        success: function(data) {
                            let html = '';
                            if (data.length > 0) {
                                data.forEach(product => {
                                    html += `<a href="#" class="list-group-item list-group-item-action product-item"
                                                data-id="${product.id}"
                                                data-name="${product.name}"
                                                data-price="${product.price}"
                                                data-weight="${product.weight}"
                                                data-unit="${product.unit_type || 'kg'}"
                                                data-image="${product.image_url || ''}">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-sm me-2" style="background-image: url(${product.image_url || ''})"></span>
                                                    <div class="flex-fill">
                                                        <div class="fw-medium">${product.name}</div>
                                                        <div class="text-muted small">${currencySymbol}${parseFloat(product.price).toFixed(2)}</div>
                                                    </div>
                                                </div>
                                            </a>`;
                                });
                                $('#product-results').html(html).show();
                            }
                        }
                    });
                }, 300);
            } else {
                $('#product-results').hide();
            }
        });

        $(document).on('click', '.product-item', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = parseFloat($(this).data('price'));
            let image = $(this).data('image');
            let rowWeight = $(this).data('weight');
            let rowUnit = $(this).data('unit');

            $('#no-products-row').hide();

            if ($(`#product-row-${id}`).length > 0) {
                let qtyInput = $(`#product-row-${id} .qty-input`);
                qtyInput.val(parseInt(qtyInput.val()) + 1);
                updateRowTotal(id);
            } else {
                let html = `<tr id="product-row-${id}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-sm me-2" style="background-image: url(${image})"></span>
                                        <div class="flex-fill">
                                            <div class="fw-medium">${name}</div>
                                            <div class="text-muted small">
                                                ${parseFloat(rowWeight) > 0 ? `1 pack (${parseFloat(rowWeight)} ${rowUnit})` : '1 unit'}
                                            </div>
                                            <input type="hidden" name="products[${id}][id]" value="${id}">
                                            <input type="hidden" name="products[${id}][name]" value="${name}">
                                            <input type="hidden" name="products[${id}][price]" value="${price}">
                                        </div>
                                    </div>
                                </td>
                                <td>${currencySymbol}${price.toFixed(2)}</td>
                                <td>
                                    <div class="input-group input-group-sm" style="width: 110px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-minus" data-id="${id}">−</button>
                                        <input type="number" class="form-control form-control-sm text-center qty-input" name="products[${id}][quantity]" value="1" min="1" data-id="${id}" style="width: 45px;">
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-plus" data-id="${id}">+</button>
                                    </div>
                                </td>
                                <td class="text-end row-total">${currencySymbol}${price.toFixed(2)}</td>
                                <td>
                                    <a href="#" class="btn btn-icon btn-sm btn-outline-danger remove-product" data-id="${id}" title="Remove">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                    </a>
                                </td>
                            </tr>`;
                $('#order-items-body').append(html);
            }
            $('#product-results').hide();
            $('#product-search').val('');
            calculateTotals();
        });

        $(document).on('click', '.qty-plus', function() {
            let id = $(this).data('id');
            let input = $(`#product-row-${id} .qty-input`);
            input.val(parseInt(input.val()) + 1);
            updateRowTotal(id);
        });
        $(document).on('click', '.qty-minus', function() {
            let id = $(this).data('id');
            let input = $(`#product-row-${id} .qty-input`);
            let val = parseInt(input.val());
            if (val > 1) {
                input.val(val - 1);
                updateRowTotal(id);
            }
        });
        $(document).on('change input', '.qty-input', function() {
            updateRowTotal($(this).data('id'));
        });
        $(document).on('click', '.remove-product', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
            calculateTotals();
            if ($('#order-items-body tr:visible').not('#no-products-row').length === 0) $('#no-products-row').show();
        });

        function updateRowTotal(id) {
            let row = $(`#product-row-${id}`);
            let price = parseFloat(row.find('input[name="products[' + id + '][price]"]').val());
            let qty = parseInt(row.find('.qty-input').val()) || 0;
            let total = price * qty;
            row.find('.row-total').text(currencySymbol + total.toLocaleString(undefined, {minimumFractionDigits: 2}));
            calculateTotals();
        }

        function calculateTotals() {
            let subtotal = 0;
            $('.row-total').each(function() {
                subtotal += parseFloat($(this).text().replace(currencySymbol, '').replace(/,/g, '')) || 0;
            });
            let shipping = parseFloat($('#shipping-amount').val()) || 0;
            let discount = parseFloat($('#discount-amount').val()) || 0;
            let total = subtotal + shipping - discount;
            $('#subtotal-display').text(currencySymbol + subtotal.toLocaleString(undefined, {minimumFractionDigits: 2}));
            $('#total-display').text(currencySymbol + total.toLocaleString(undefined, {minimumFractionDigits: 2}));
        }

        $('#shipping-amount, #discount-amount').on('change input', calculateTotals);
    });
</script>
@endpush
