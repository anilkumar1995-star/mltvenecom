@extends('admin-layouts.app')
@section('title', 'Products')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Products</h1>
                                    </li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
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
                            @section('table_actions')
                                <div class="dropdown d-inline-block">
                                    <button
                                        class="btn btn-primary dropdown-toggle d-flex align-items-center"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg"
                                            width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5v14" />
                                            <path d="M5 12h14" />
                                        </svg>
                                        Create
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a
                                                href="{{ route('admin.products.create') }}"
                                                class="dropdown-item d-flex align-items-center"
                                            >
                                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M12 3l8 4.5v9l-8 4.5-8-4.5v-9z"/>
                                                    <path d="M12 12l8-4.5"/>
                                                    <path d="M12 12v9"/>
                                                    <path d="M12 12l-8-4.5"/>
                                                </svg>
                                                Physical
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endsection

                            @include('admin-layouts.partials.table-header', [
                                'bulkActions' => true,
                                'tableId' => 'productsTable'
                            ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="productsTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox"><input
                                                    class="form-check-input m-0 align-middle table-check-all"
                                                    data-set=".dataTable .checkboxes" name="" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="20"
                                                class="text-center no-column-visibility  column-key-0">ID</th>
                                            <th title="Image" width="50" class=" column-key-1">Image</th>
                                            <th title="Products" class="text-start  column-key-2">Products</th>
                                            <th title="Price" class="text-start  column-key-3">Price</th>
                                            <th title="Stock status" class=" column-key-4">Stock status</th>
                                            <th title="Quantity" class="text-start  column-key-5">Quantity</th>
                                            <th title="SKU" class="text-start  column-key-6">SKU</th>
                                            <th title="Sort order" width="50" class=" column-key-7">Sort order
                                            </th>
                                            <th title="Created At" width="100" class=" column-key-8">Created At
                                            </th>
                                            <th title="Status" width="100" class="text-center  column-key-9">
                                                Status</th>
                                            <th title="Operations">Operations</th>
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
                                                $gallery = $product->gallery_image_urls;
                                                $imageUrl = !empty($product->image) ? $product->image_url : (!empty($gallery) ? $gallery[0] : asset('home/placeholder.png'));
                                            @endphp
                                            <a data-fslightbox="gallery" href="{{ $imageUrl }}">
                                                <img src="{{ $imageUrl }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="avatar avatar-sm" 
                                                     style="width: 40px; height: 40px; object-fit: cover;"
                                                     onerror="this.src='{{ asset('home/placeholder.png') }}'">
                                            </a>
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>₹{{ number_format($product->price ?? 0, 2) }}</td>
                                        <td>{{ $product->stock_status  }}</td>
                                        <td>{{ $product->quantity   }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>{{ $product->order  }}</td>
                                        <td>{{ $product->created_at ? $product->created_at->format('M d, Y') : '' }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($product->status) {
                                                    'published' => 'bg-success text-white',
                                                    'draft' => 'bg-danger text-white',
                                                    'pending' => 'bg-warning text-white',
                                                    default => 'bg-secondary text-white'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                    
                                        <td class="text-end">
                                            <div class="btn-group">
                                                @if($product->status == 'pending')
                                                    <button type="button" class="btn btn-sm btn-success approve-confirm-btn" data-url="{{ route('admin.products.approve', $product->id) }}" title="Approve">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                @endif
                                                 <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-outline-success" title="View">
                                                     <i class="fa fa-eye"></i>
                                                 </a>
                                                 <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                     <i class="fa fa-edit"></i>
                                                 </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.products.destroy', $product->id) }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'productsTable',
        'bulkDeleteUrl' => route('admin.products.bulk-delete')
    ])
@endpush