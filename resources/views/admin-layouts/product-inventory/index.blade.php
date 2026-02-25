@extends('admin-layouts.app')
@section('title', 'Product Inventory')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Product Inventory</h1>
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
                <div class="table-wrapper">
                    <!-- Filter Panel (Hidden by default) -->
                    <div class="card mb-3 table-configuration-wrap" style="display: none;">
                        <div class="card-body">
                            <button class="btn btn-icon btn-sm btn-show-table-options rounded-pill" type="button">
                                <svg class="icon icon-sm icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </button>

                            <div class="wrapper-filter">
                                <p>Filters</p>
                                <form method="GET" action="{{ route('admin.product-inventory.index') }}" class="filter-form">
                                    <div class="filter_list inline-block filter-items-wrap">
                                        <div class="row filter-item form-filter filter-item-default">
                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-column-key" name="filter_columns[]">
                                                        <option value="" selected>Select field</option>
                                                        <option value="name">Name</option>
                                                        <option value="sku">SKU</option>
                                                        <option value="location">Storehouse</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto w-50 w-sm-auto">
                                                <div class="mb-3 position-relative">
                                                    <select class="form-select filter-operator filter-column-operator" name="filter_operators[]">
                                                        <option value="like">Contains</option>
                                                        <option value="=" selected>Is equal to</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto w-100 w-sm-25">
                                                <div class="filter-column-value-wrap mb-3">
                                                    <input class="form-control filter-column-value" type="text" placeholder="Value" name="filter_values[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-list">
                                        <button class="btn btn-primary btn-apply" type="submit">Apply</button>
                                        <a class="btn btn-icon w-6" href="{{ route('admin.product-inventory.index') }}">
                                            <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                            </svg>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card has-actions has-filter">
                        <div class="card-header">
                            <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                    <button class="btn btn-show-table-options" type="button">
                                        Filters
                                    </button>

                                    <div class="table-search-input">
                                        <form method="GET" action="{{ route('admin.product-inventory.index') }}">
                                            <label>
                                                <input type="search" name="keyword" class="form-control input-sm" placeholder="Search..." style="min-width: 120px" value="{{ request('keyword') }}">
                                            </label>
                                        </form>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                    <button class="btn" type="button" onclick="window.location.reload();">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Reload
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable">
                                    <thead>
                                        <tr>

                                            <th title="ID" width="20">ID</th>
                                            <th title="Image" width="50">Image</th>
                                            <th title="Products">Products</th>
                                            <th title="Storehouse Management" width="100">Storehouse Management</th>
                                            <th title="Quantity" width="200">Quantity</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>

                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @php
                                                    $displayImage = $product->image ?: (is_array($product->images) && !empty($product->images) ? $product->images[0] : null);
                                                    $imageUrl = $displayImage ? asset('uploads/' . $displayImage) : asset('home-dashboard-files/placeholder.png');
                                                @endphp
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-thumbnail me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    @if($product->is_variation)
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-1 text-muted">↳</div>
                                                            <div>
                                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary font-weight-bold text-decoration-none" target="_blank">{{ $product->name }}</a>
                                                                @if($product->variation_attributes)
                                                                     <div class="small text-success">{{ $product->variation_attributes }}</div>
                                                                @endif
                                                                <div class="text-muted small">SKU: {{ $product->sku ?: 'N/A' }}</div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary font-weight-bold text-decoration-none" target="_blank">{{ $product->name }}</a>
                                                        <div class="text-muted small">SKU: {{ $product->sku ?: 'N/A' }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-select update-storehouse" data-pk="{{ $product->id }}">
                                                    <option value="0" {{ !$product->with_storehouse_management ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ $product->with_storehouse_management ? 'selected' : '' }}>Yes</option>
                                                </select>
                                            </td>
                                            <td>
                                                <!-- Quantity Input (Show if Storehouse is Enabled) -->
                                                <input type="number" class="form-control update-quantity"
                                                       style="max-width: 150px; {{ !$product->with_storehouse_management ? 'display: none;' : '' }}"
                                                       value="{{ $product->quantity }}"
                                                       data-pk="{{ $product->id }}"
                                                       placeholder="Quantity">

                                                <!-- Stock Status Select (Show if Storehouse is Disabled) -->
                                                <select class="form-select update-stock-status"
                                                        style="max-width: 150px; {{ $product->with_storehouse_management ? 'display: none;' : '' }}"
                                                        data-pk="{{ $product->id }}">
                                                    <option value="in_stock" {{ $product->stock_status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                                    <option value="out_of_stock" {{ $product->stock_status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                                    <option value="on_backorder" {{ $product->stock_status == 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                                                </select>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $products->appends(request()->all())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection
    @push('scripts')
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Toggle Filter Panel
                $('.btn-show-table-options').on('click', function() {
                    $('.table-configuration-wrap').slideToggle();
                });



                // Inventory Update Logic
                function updateInventory(pk, name, value) {
                    $.ajax({
                        url: '{{ route("admin.product-inventory.update") }}',
                        type: 'POST',
                        data: {
                            pk: pk,
                            name: name,
                            value: value
                        },
                        success: function(response) {
                            if(response.success) {
                                toastr.success('Updated successfully');
                            } else {
                                toastr.error('Failed to update');
                            }
                        },
                        error: function() {
                            toastr.error('Error updating');
                        }
                    });
                }

                // Update Storehouse Management
                $('.update-storehouse').on('change', function() {
                    let select = $(this);
                    let pk = select.data('pk');
                    let value = select.val(); // Value is directly '0' or '1'

                    let row = select.closest('tr');
                    let quantityInput = row.find('.update-quantity');
                    let stockSelect = row.find('.update-stock-status');

                    // Toggle Visibility
                    if (value == 1) {
                        quantityInput.show();
                        stockSelect.hide();
                    } else {
                        quantityInput.hide();
                        stockSelect.show();
                    }

                    updateInventory(pk, 'with_storehouse_management', value);
                });

                // Update Quantity
                $('.update-quantity').on('change', function() {
                    let input = $(this);
                    let pk = input.data('pk');
                    let value = input.val();
                    updateInventory(pk, 'quantity', value);
                });

                // Update Stock Status
                $('.update-stock-status').on('change', function() {
                    let select = $(this);
                    let pk = select.data('pk');
                    let value = select.val();
                    updateInventory(pk, 'stock_status', value);
                });
            });
        </script>
    @endpush
