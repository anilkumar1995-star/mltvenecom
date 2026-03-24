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
                    @yield('header_actions')
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <div class="table-wrapper">
                    {{-- Shared Filter Panel --}}
                    @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                    {{-- Table Card --}}
                    <div class="card has-actions has-filter">
                        {{-- Shared Header --}}
                        @include('admin-layouts.partials.table-header', [
                            'bulkActions' => true,
                            'tableId' => 'inventoryTable'
                        ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="inventoryTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="20" class="text-start">ID</th>
                                            <th title="Image" width="50">Image</th>
                                            <th title="Products" class="text-start">Products</th>
                                            <th title="Storehouse Management" width="100">Storehouse Management</th>
                                            <th title="Quantity" width="200">Quantity / Stock Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $product->id }}">
                                            </td>
                                            <td class="text-start">{{ $product->id }}</td>
                                            <td>
                                                @php
                                                    $imageUrl = $product->image_url;
                                                    // Fallback to gallery first image if basic image is placeholder
                                                    if ($imageUrl == asset('home/placeholder.png') && !empty($product->gallery_image_urls)) {
                                                        $imageUrl = $product->gallery_image_urls[0];
                                                    }
                                                @endphp
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" 
                                                     class="avatar avatar-sm" 
                                                     style="object-fit: cover; width: 40px; height: 40px;"
                                                     onerror="this.src='{{ asset('home/placeholder.png') }}'">
                                            </td>
                                            <td class="text-start">
                                                <div class="d-flex flex-column">
                                                    @if($product->is_variation)
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-1 text-muted">↳</div>
                                                            <div>
                                                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary font-weight-bold text-decoration-none" target="_blank">{{ $product->name }}</a>
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
                                                <select class="form-select form-select-sm update-storehouse" data-pk="{{ $product->id }}">
                                                    <option value="0" {{ !$product->with_storehouse_management ? 'selected' : '' }}>No</option>
                                                    <option value="1" {{ $product->with_storehouse_management ? 'selected' : '' }}>Yes</option>
                                                </select>
                                            </td>
                                            <td>
                                                <!-- Quantity Input (Show if Storehouse is Enabled) -->
                                                <input type="number" class="form-control form-control-sm update-quantity"
                                                       style="max-width: 150px; {{ !$product->with_storehouse_management ? 'display: none;' : '' }}"
                                                       value="{{ $product->quantity }}"
                                                       data-pk="{{ $product->id }}"
                                                       placeholder="Quantity">

                                                <!-- Stock Status Select (Show if Storehouse is Disabled) -->
                                                <select class="form-select form-select-sm update-stock-status"
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
    @include('admin-layouts.partials.table-scripts', [
        'bulkDeleteUrl' => route('admin.product-inventory.bulk-delete'),
        'tableId' => 'inventoryTable'
    ])
    <script>
        $(document).ready(function () {
            // Inventory Update Logic
            function updateInventory(pk, name, value) {
                $.ajax({
                    url: '{{ route("admin.product-inventory.update") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pk: pk,
                        name: name,
                        value: value
                    },
                    success: function(response) {
                        if(response.success) {
                            notify('Updated successfully', 'success');
                        } else {
                            notify('Failed to update', 'error');
                        }
                    },
                    error: function() {
                        notify('Error updating', 'error');
                    }
                });
            }

            // Update Storehouse Management
            $(document).on('change', '.update-storehouse', function() {
                let select = $(this);
                let pk = select.data('pk');
                let value = select.val();

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
            $(document).on('change', '.update-quantity', function() {
                let input = $(this);
                let pk = input.data('pk');
                let value = input.val();
                updateInventory(pk, 'quantity', value);
            });

            // Update Stock Status
            $(document).on('change', '.update-stock-status', function() {
                let select = $(this);
                let pk = select.data('pk');
                let value = select.val();
                updateInventory(pk, 'stock_status', value);
            });
        });
    </script>
@endpush
