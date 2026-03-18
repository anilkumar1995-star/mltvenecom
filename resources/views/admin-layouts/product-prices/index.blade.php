@extends('admin-layouts.app')
@section('title', 'Product Prices')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Product Prices</h1>
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
                    @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                    <div class="card has-actions has-filter">
                        @include('admin-layouts.partials.table-header', [
                            'bulkActions' => true,
                            'tableId' => 'productPricesTable'
                        ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="productPricesTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 20px;">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-start">ID</th>
                                            <th title="Image" width="50">Image</th>
                                            <th title="Name" class="text-start">Name</th>
                                            <th title="SKU" class="text-start">SKU</th>
                                            <th title="Price" width="150">Price</th>
                                            <th title="Sale Price" width="150">Sale Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $product->id }}">
                                            </td>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @php
                                                    $imageUrl = $product->image_url;
                                                    if ($imageUrl == asset('home/placeholder.png') && !empty($product->gallery_image_urls)) {
                                                        $imageUrl = $product->gallery_image_urls[0];
                                                    }
                                                @endphp
                                                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" 
                                                     class="avatar avatar-sm" 
                                                     style="object-fit: cover; width: 40px; height: 40px;"
                                                     onerror="this.src='{{ asset('home/placeholder.png') }}'">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->sku }}</td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" step="0.01" class="form-control update-price" 
                                                           data-pk="{{ $product->id }}" data-name="price" 
                                                           value="{{ $product->price }}">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" step="0.01" class="form-control update-price" 
                                                           data-pk="{{ $product->id }}" data-name="sale_price" 
                                                           value="{{ $product->sale_price }}">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} entries
                            </div>
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'productPricesTable',
        'bulkDeleteUrl' => route('admin.product-prices.bulk-delete')
    ])
    <script>
        $(document).ready(function() {
            $(document).on('change', '.update-price', function() {
                let input = $(this);
                let pk = input.data('pk');
                let name = input.data('name');
                let value = input.val();

                $.ajax({
                    url: '{{ route("admin.product-prices.update") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        pk: pk,
                        name: name,
                        value: value
                    },
                    success: function(response) {
                        if(response.success) {
                            notify('Price updated successfully', 'success');
                        } else {
                            notify('Failed to update price', 'error');
                        }
                    },
                    error: function() {
                        notify('Error updating price', 'error');
                    }
                });
            });
        });
    </script>
@endpush
