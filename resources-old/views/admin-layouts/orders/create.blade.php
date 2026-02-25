@extends('admin-layouts.app')
@section('title', 'Create Order')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Create New Order
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <form action="{{ route('orders.store') }}" method="POST" id="create-order-form">
            @csrf
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-lg-8">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Order Items</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Search Product</label>
                                    <input type="text" class="form-control" id="product-search" placeholder="Search by name or SKU...">
                                    <div class="list-group mt-2" id="product-results" style="display:none; max-height: 200px; overflow-y: auto;"></div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-vcenter table-mobile-md card-table" id="order-items-table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Items will be added here -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end font-weight-bold">Subtotal</td>
                                                <td class="text-end" id="subtotal-display">0.00</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end font-weight-bold">Shipping Amount</td>
                                                <td><input type="number" step="0.01" class="form-control form-control-sm text-end" name="shipping_amount" id="shipping-amount" value="0.00"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end font-weight-bold">Discount</td>
                                                <td><input type="number" step="0.01" class="form-control form-control-sm text-end" name="discount_amount" id="discount-amount" value="0.00"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end font-weight-bold">Total</td>
                                                <td class="text-end font-weight-bold" id="total-display">0.00</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Customer</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Search Customer</label>
                                    <input type="text" class="form-control" id="customer-search" placeholder="Search by name or email...">
                                    <div class="list-group mt-2" id="customer-results" style="display:none; max-height: 200px; overflow-y: auto;"></div>
                                </div>
                                <div id="selected-customer-info" style="display:none;">
                                    <div class="card card-sm">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium" id="customer-name-display"></div>
                                                    <div class="text-muted" id="customer-email-display"></div>
                                                </div>
                                                <a href="#" class="btn btn-icon" id="remove-customer-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" id="customer-id-input">
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Payment & Shipping</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-select" name="payment_method">
                                        <option value="cod">Cash on Delivery</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="stripe">Stripe</option>
                                        <option value="paypal">PayPal</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-select" name="payment_status">
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                        <option value="failed">Failed</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Order Status</label>
                                    <select class="form-select" name="status">
                                        <option value="pending">Pending</option>
                                        <option value="processing">Processing</option>
                                        <option value="completed">Completed</option>
                                        <option value="canceled">Canceled</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                             <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">Create Order</button>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        let products = [];
        
        // Product Search
        $('#product-search').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("orders.search-product") }}',
                    data: { q: query },
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(product => {
                                html += `<a href="#" class="list-group-item list-group-item-action product-item" 
                                            data-id="${product.id}" 
                                            data-name="${product.name}" 
                                            data-price="${product.price}" 
                                            data-image="${product.image_url}">
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2" style="background-image: url(${product.image_url})"></span>
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">${product.name}</div>
                                                    <div class="text-muted">${product.sku} - $${product.price}</div>
                                                </div>
                                            </div>
                                        </a>`;
                            });
                            $('#product-results').html(html).show();
                        } else {
                            $('#product-results').hide();
                        }
                    }
                });
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

            // Check if already added
            if ($(`#product-row-${id}`).length > 0) {
                let qtyInput = $(`#product-row-${id} .qty-input`);
                qtyInput.val(parseInt(qtyInput.val()) + 1);
                updateRowTotal(id);
            } else {
                let html = `<tr id="product-row-${id}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar me-2" style="background-image: url(${image})"></span>
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">${name}</div>
                                            <input type="hidden" name="products[${id}][id]" value="${id}">
                                            <input type="hidden" name="products[${id}][name]" value="${name}">
                                            <input type="hidden" name="products[${id}][price]" value="${price}">
                                        </div>
                                    </div>
                                </td>
                                <td>${price.toFixed(2)}</td>
                                <td>
                                    <input type="number" class="form-control form-control-sm qty-input" name="products[${id}][quantity]" value="1" min="1" style="width: 80px;" data-id="${id}">
                                </td>
                                <td class="text-end row-total">${price.toFixed(2)}</td>
                                <td>
                                    <a href="#" class="btn btn-icon btn-sm btn-outline-danger remove-product" data-id="${id}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                    </a>
                                </td>
                            </tr>`;
                $('#order-items-table tbody').append(html);
            }
            
            $('#product-results').hide();
            $('#product-search').val('');
            calculateTotals();
        });

        // Update Qty
        $(document).on('change', '.qty-input', function() {
            let id = $(this).data('id');
            updateRowTotal(id);
        });

         // Remove Product
        $(document).on('click', '.remove-product', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $(`#product-row-${id}`).remove();
            calculateTotals();
        });

        function updateRowTotal(id) {
            let row = $(`#product-row-${id}`);
            let price = parseFloat(row.find('input[name="products[' + id + '][price]"]').val());
            let qty = parseInt(row.find('.qty-input').val());
            let total = price * qty;
            row.find('.row-total').text(total.toFixed(2));
            calculateTotals();
        }

        function calculateTotals() {
            let subtotal = 0;
            $('.row-total').each(function() {
                subtotal += parseFloat($(this).text());
            });

            let shipping = parseFloat($('#shipping-amount').val()) || 0;
            let discount = parseFloat($('#discount-amount').val()) || 0;
            let total = subtotal + shipping - discount;

            $('#subtotal-display').text(subtotal.toFixed(2));
            $('#total-display').text(total.toFixed(2));
        }

        $('#shipping-amount, #discount-amount').on('change', calculateTotals);

        // Customer Search
        $('#customer-search').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("orders.search-customer") }}',
                    data: { q: query },
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(customer => {
                                html += `<a href="#" class="list-group-item list-group-item-action customer-item" 
                                            data-id="${customer.id}" 
                                            data-name="${customer.name}" 
                                            data-email="${customer.email}">
                                            <div>
                                                <div class="font-weight-medium">${customer.name}</div>
                                                <div class="text-muted">${customer.email}</div>
                                            </div>
                                        </a>`;
                            });
                            $('#customer-results').html(html).show();
                        } else {
                            $('#customer-results').hide();
                        }
                    }
                });
            } else {
                $('#customer-results').hide();
            }
        });

        $(document).on('click', '.customer-item', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');

            $('#customer-id-input').val(id);
            $('#customer-name-display').text(name);
            $('#customer-email-display').text(email);
            
            $('#selected-customer-info').show();
            $('#customer-search').closest('.mb-3').hide();
            $('#customer-results').hide();
        });

        $('#remove-customer-btn').on('click', function(e) {
            e.preventDefault();
            $('#customer-id-input').val('');
            $('#selected-customer-info').hide();
            $('#customer-search').closest('.mb-3').show();
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
@endsection
