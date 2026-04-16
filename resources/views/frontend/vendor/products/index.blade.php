@extends('vendor-layouts.app')
@section('title', 'My Products')

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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">My Products</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @section('table_actions')
                        <div class="dropdown">
                            <button class="btn btn-primary d-flex align-items-center dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14" />
                                    <path d="M5 12h14" />
                                </svg>
                                Create
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('frontend.vendor.products.create', ['type' => 'physical']) }}">
                                    <span class="avatar avatar-xs bg-primary-lt me-2 rounded">
                                        <i class="fa fa-box-open scale-08"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bold">Physical Product</div>
                                        <div class="text-secondary small">Shippable items</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center py-2 border-top" href="{{ route('frontend.vendor.products.create', ['type' => 'digital']) }}">
                                    <span class="avatar avatar-xs bg-success-lt me-2 rounded">
                                        <i class="fa fa-cloud-download-alt scale-08"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bold">Digital Product</div>
                                        <div class="text-secondary small">Downloadable items</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endsection

                    @include('admin-layouts.partials.table-header', ['bulkActions' => true])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="productsTable">
                                <thead>
                                    <tr>
                                        <th title="Checkbox" width="20">
                                            <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                        </th>
                                        <th title="ID" width="50" class="text-center text-uppercase">ID</th>
                                        <th title="Image" width="50" class="text-uppercase">Image</th>
                                        <th title="Name" class="text-uppercase">Products</th>
                                        <th title="Price" class="text-uppercase text-nowrap">Price</th>
                                        <th title="Sale Price" class="text-uppercase text-nowrap">Sale Price</th>
                                        <th title="Stock Status" class="text-uppercase text-nowrap">Stock Status</th>
                                        <th title="Status" class="text-uppercase text-center text-nowrap">Status</th>
                                        <th title="Quantity" class="text-uppercase text-center">Quantity</th>
                                        <th title="SKU" class="text-uppercase">SKU</th>
                                        <th title="Sort Order" class="text-uppercase text-center">Sort Order</th>
                                        <th title="Date" class="text-uppercase text-nowrap">Created At</th>
                                        <th title="Operations" class="text-end text-uppercase">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $product->id }}">
                                        </td>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td>
                                            <span class="avatar avatar-sm rounded shadow-sm border" style="background-image: url('{{ $product->image_url }}')"></span>
                                        </td>
                                        <td class="fw-medium">
                                            <div class="font-weight-medium text-dark">{{ $product->name }}</div>
                                        </td>
                                        <td>
                                            <span class="{{ $product->sale_price ? 'text-decoration-line-through text-muted small' : 'fw-bold' }}">
                                                ₹{{ number_format($product->price ?? 0, 2) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->sale_price)
                                                <span class="badge bg-info-lt text-info fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                            @else
                                                <span class="text-muted small">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $stockClass = match($product->stock_status) {
                                                    'in_stock' => 'bg-success',
                                                    'out_of_stock' => 'bg-danger',
                                                    'on_backorder' => 'bg-info',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $stockClass }} text-white text-nowrap">{{ str_replace('_', ' ', ucfirst($product->stock_status)) }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($product->status == 'published')
                                                <span class="badge bg-success text-white">Published</span>
                                            @elseif($product->status == 'pending')
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ ucfirst($product->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $product->quantity ?? 0 }}</td>
                                        <td><code>{{ $product->sku ?? 'N/A' }}</code></td>
                                        <td class="text-center">{{ $product->order ?? 0 }}</td>
                                        <td class="text-nowrap">{{ $product->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('frontend.vendor.products.edit', $product->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('frontend.vendor.products.destroy', $product->id) }}" data-id="{{ $product->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" class="text-center text-muted py-4">No products found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'productsTable',
        'bulkDeleteUrl' => route('frontend.vendor.products.bulk-delete')
    ])
@endpush
