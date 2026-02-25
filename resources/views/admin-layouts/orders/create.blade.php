@extends('admin-layouts.app')
@section('title', 'Create Order')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Create a new order</h1>
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
                <form action="{{ route('admin.orders.store') }}" method="POST" id="create-order-form">
                    @csrf
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
                                                        <tr id="no-products-row">
                                                            <td colspan="5" class="text-center text-muted py-4">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg mb-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 17h-11v-14h-2"/><path d="M6 5l14 1l-1 7h-13"/></svg>
                                                                <div>No products added yet. Use the search above to add products.</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Sub total</td>
                                                            <td class="text-end fw-bold border-0" id="subtotal-display">₹0.00</td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Discount</td>
                                                            <td class="border-0">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text">₹</span>
                                                                    <input type="number" step="0.01" class="form-control form-control-sm text-end" name="discount_amount" id="discount-amount" value="0.00">
                                                                </div>
                                                            </td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-0">Shipping fee</td>
                                                            <td class="border-0">
                                                                <div class="input-group input-group-sm">
                                                                    <span class="input-group-text">₹</span>
                                                                    <input type="number" step="0.01" class="form-control form-control-sm text-end" name="shipping_amount" id="shipping-amount" value="0.00">
                                                                </div>
                                                            </td>
                                                            <td class="border-0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" class="text-end fw-bold border-top">Total amount</td>
                                                            <td class="text-end fw-bold border-top text-primary fs-4" id="total-display">₹0.00</td>
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
                                                <div class="position-relative" id="customer-search-wrapper">
                                                    <input type="text" class="form-control" id="customer-search" placeholder="Search customer by name or email..." autocomplete="off">
                                                    <div class="list-group mt-1 position-absolute w-100 shadow-sm" id="customer-results" style="display:none; max-height: 200px; overflow-y: auto; z-index: 100;"></div>
                                                </div>
                                                <div id="selected-customer-info" style="display:none;" class="mt-2">
                                                    <div class="alert alert-info d-flex align-items-center mb-0 py-2">
                                                        <div class="flex-fill">
                                                            <strong id="customer-name-display"></strong>
                                                            <div class="text-muted small" id="customer-email-display"></div>
                                                        </div>
                                                        <a href="#" class="btn btn-icon btn-sm" id="remove-customer-btn" title="Remove">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                                        </a>
                                                    </div>
                                                    <input type="hidden" name="user_id" id="customer-id-input">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Store</label>
                                                <select class="form-select" name="store_id">
                                                    <option value="">Select store...</option>
                                                    <option value="1" selected>Default Store</option>
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
                                                <input type="text" class="form-control" name="shipping_name" id="ship-name" placeholder="Full name">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="shipping_phone" id="ship-phone" placeholder="Phone">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="shipping_email" id="ship-email" placeholder="Email">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Country</label>
                                                <select class="form-select" name="shipping_country" id="ship-country">
                                                    <option value="">Select...</option>
                                                    <option value="IN" selected>India</option>
                                                    <option value="US">United States</option>
                                                    <option value="UK">United Kingdom</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="shipping_state" id="ship-state" placeholder="State">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="shipping_city" id="ship-city" placeholder="City">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="shipping_address" id="ship-address" placeholder="Address">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Zip code</label>
                                                <input type="text" class="form-control" name="shipping_zipcode" id="ship-zip" placeholder="Zip code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="mb-0">Billing address</h5>
                                                <label class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" id="same-as-shipping" name="same_as_shipping" value="1" checked>
                                                    <span class="form-check-label">Same as shipping</span>
                                                </label>
                                            </div>
                                            <div id="billing-fields" style="display: none;">
                                                <div class="mb-3">
                                                    <label class="form-label">Full name</label>
                                                    <input type="text" class="form-control" name="billing_name" placeholder="Full name">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone</label>
                                                    <input type="text" class="form-control" name="billing_phone" placeholder="Phone">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="billing_email" placeholder="Email">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Country</label>
                                                    <select class="form-select" name="billing_country">
                                                        <option value="">Select...</option>
                                                        <option value="IN" selected>India</option>
                                                        <option value="US">United States</option>
                                                        <option value="UK">United Kingdom</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">State</label>
                                                    <input type="text" class="form-control" name="billing_state" placeholder="State">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">City</label>
                                                    <input type="text" class="form-control" name="billing_city" placeholder="City">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="billing_address" placeholder="Address">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Zip code</label>
                                                    <input type="text" class="form-control" name="billing_zipcode" placeholder="Zip code">
                                                </div>
                                            </div>
                                            <div id="billing-same-msg" class="text-muted">
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
                                        <textarea class="form-control" name="description" rows="3" placeholder="Private notes are only visible to admins"></textarea>
                                        <small class="form-hint">Private notes are only visible to admins</small>
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
                                        <button class="btn btn-primary" type="submit" name="submitter" value="save">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Save
                                        </button>
                                        <button class="btn" type="submit" name="submitter" value="save_exit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Save & Exit
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Order Status Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Order status <span class="text-danger">*</span></h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="status" required>
                                        <option value="pending" selected>Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Payment Method Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Payment method</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <select class="form-select" name="payment_method">
                                            <option value="cod" selected>Cash on Delivery (COD)</option>
                                            <option value="bank_transfer">Bank transfer</option>
                                            <option value="razorpay">Razorpay</option>
                                            <option value="upi">UPI</option>
                                            <option value="stripe">Stripe</option>
                                            <option value="paypal">PayPal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Payment Status Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Payment status</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <select class="form-select" name="payment_status">
                                            <option value="pending" selected>Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="refunded">Refunded</option>
                                            <option value="failed">Failed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Currency Card --}}
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Currency</h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="currency">
                                        <option value="INR" selected>INR - Indian Rupee (₹)</option>
                                        <option value="USD">USD - US Dollar ($)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        const currencySymbol = '₹';

        // Toggle billing address fields
        $('#same-as-shipping').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billing-fields').hide();
                $('#billing-same-msg').show();
            } else {
                $('#billing-fields').show();
                $('#billing-same-msg').hide();
            }
        });

        // Product Search
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
                                                data-sku="${product.sku || ''}"
                                                data-image="${product.image_url || ''}">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-sm me-2" style="background-image: url(${product.image_url || ''})"></span>
                                                    <div class="flex-fill">
                                                        <div class="fw-medium">${product.name}</div>
                                                        <div class="text-muted small">${product.sku || ''} — ${currencySymbol}${parseFloat(product.price).toFixed(2)}</div>
                                                    </div>
                                                </div>
                                            </a>`;
                                });
                                $('#product-results').html(html).show();
                            } else {
                                $('#product-results').html('<div class="list-group-item text-muted">No products found</div>').show();
                            }
                        }
                    });
                }, 300);
            } else {
                $('#product-results').hide();
            }
        });

        // Add Product to Table
        $(document).on('click', '.product-item', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = parseFloat($(this).data('price'));
            let image = $(this).data('image');

            // Hide no-products row
            $('#no-products-row').hide();

            // Check if already added
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

        // Qty Plus/Minus Buttons
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

        // Update Qty on manual input
        $(document).on('change input', '.qty-input', function() {
            let id = $(this).data('id');
            if (parseInt($(this).val()) < 1) $(this).val(1);
            updateRowTotal(id);
        });

        // Remove Product
        $(document).on('click', '.remove-product', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $(`#product-row-${id}`).remove();
            calculateTotals();

            // Show no-products row if table is empty
            if ($('#order-items-body tr:visible').not('#no-products-row').length === 0) {
                $('#no-products-row').show();
            }
        });

        function updateRowTotal(id) {
            let row = $(`#product-row-${id}`);
            let price = parseFloat(row.find('input[name="products[' + id + '][price]"]').val());
            let qty = parseInt(row.find('.qty-input').val()) || 0;
            let total = price * qty;
            row.find('.row-total').text(currencySymbol + total.toFixed(2));
            calculateTotals();
        }

        function calculateTotals() {
            let subtotal = 0;
            $('.row-total').each(function() {
                subtotal += parseFloat($(this).text().replace(currencySymbol, '')) || 0;
            });

            let shipping = parseFloat($('#shipping-amount').val()) || 0;
            let discount = parseFloat($('#discount-amount').val()) || 0;
            let total = subtotal + shipping - discount;
            if (total < 0) total = 0;

            $('#subtotal-display').text(currencySymbol + subtotal.toFixed(2));
            $('#total-display').text(currencySymbol + total.toFixed(2));
        }

        $('#shipping-amount, #discount-amount').on('change input', calculateTotals);

        // Customer Search
        let customerTimeout;
        $('#customer-search').on('keyup', function() {
            let query = $(this).val();
            clearTimeout(customerTimeout);
            if (query.length > 2) {
                customerTimeout = setTimeout(function() {
                    $.ajax({
                        url: '{{ route("admin.orders.search-customer") }}',
                        data: { q: query },
                        success: function(data) {
                            let html = '';
                            if (data.length > 0) {
                                data.forEach(customer => {
                                    html += `<a href="#" class="list-group-item list-group-item-action customer-item"
                                                data-id="${customer.id}"
                                                data-name="${customer.name}"
                                                data-email="${customer.email}"
                                                data-phone="${customer.phone || ''}"
                                                data-address='${JSON.stringify(customer.addresses && customer.addresses.length > 0 ? customer.addresses[0] : {})}'>
                                                <div>
                                                    <div class="fw-medium">${customer.name}</div>
                                                    <div class="text-muted small">${customer.email}${customer.phone ? ' — ' + customer.phone : ''}</div>
                                                </div>
                                            </a>`;
                                });
                                $('#customer-results').html(html).show();
                            } else {
                                $('#customer-results').html('<div class="list-group-item text-muted">No customers found</div>').show();
                            }
                        }
                    });
                }, 300);
            } else {
                $('#customer-results').hide();
            }
        });

        // Select Customer — autofill address
        $(document).on('click', '.customer-item', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = {};
            try { address = $(this).data('address') || {}; } catch(err) {}

            $('#customer-id-input').val(id);
            $('#customer-name-display').text(name);
            $('#customer-email-display').text(email);

            $('#selected-customer-info').show();
            $('#customer-search-wrapper').hide();
            $('#customer-results').hide();

            // Autofill shipping address from customer's default address
            if (address && address.name) {
                $('#ship-name').val(address.name || name);
                $('#ship-phone').val(address.phone || phone);
                $('#ship-email').val(address.email || email);
                $('#ship-country').val(address.country || 'IN');
                $('#ship-state').val(address.state || '');
                $('#ship-city').val(address.city || '');
                $('#ship-address').val(address.address || '');
                $('#ship-zip').val(address.zip_code || '');
            } else {
                // At least fill name, phone, email
                $('#ship-name').val(name);
                $('#ship-phone').val(phone);
                $('#ship-email').val(email);
            }
        });

        $('#remove-customer-btn').on('click', function(e) {
            e.preventDefault();
            $('#customer-id-input').val('');
            $('#selected-customer-info').hide();
            $('#customer-search-wrapper').show();
            $('#customer-search').val('');
        });

        // Click outside to close results
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#product-search, #product-results').length) {
                $('#product-results').hide();
            }
            if (!$(e.target).closest('#customer-search, #customer-results').length) {
                $('#customer-results').hide();
            }
        });
    });
</script>
@endpush
