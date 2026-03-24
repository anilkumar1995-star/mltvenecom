@extends('frontend.layouts.app')

@section('title', 'My Products')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-3">
            @include('frontend.vendor.sidebar')
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>My Products</h2>
                <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">Add New Product</a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>₹{{ number_format($product->price, 2) }}</td>
                                <td>
                                    @if($product->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($product->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending Approval</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($product->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                            @if($products->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">No products found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
