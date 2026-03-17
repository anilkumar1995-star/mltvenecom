@extends('frontend.layouts.app')
@section('title', 'My Wishlist')
@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold">My Wishlist <span class="badge bg-danger ms-2">{{ count($products) }}</span></h3>

    @if($products->isEmpty())
        <div class="text-center py-5">
            <i class="far fa-heart fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Your wishlist is empty</h5>
            <a href="{{ route('frontend.products.index') }}" class="btn btn-primary mt-3">Browse Products</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3 col-sm-6">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
