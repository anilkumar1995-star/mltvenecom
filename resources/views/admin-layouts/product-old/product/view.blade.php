@extends('admin-layouts.app')

@section('title', 'View Product')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a><i class="fa fa-circle"></i></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a><i class="fa fa-circle"></i></li>
                <li><span>View Product</span></li>
            </ul>
            <div class="page-toolbar">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Edit Product
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Product Details: {{ $product->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="border p-2 text-center bg-light">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                                    @else
                                        <i class="fa fa-image fa-5x text-muted py-5"></i>
                                        <div class="text-muted">No Image Available</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="150" class="bg-light">Name</th>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">SKU</th>
                                        <td>{{ $product->sku ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Price</th>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Sale Price</th>
                                        <td>${{ number_format($product->sale_price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Quantity</th>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Status</th>
                                        <td>
                                            <span class="badge {{ $product->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Description</th>
                                        <td>{{ $product->description }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="fw-bold">Content</h6>
                                <div class="border p-3 bg-light">
                                    {!! $product->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection