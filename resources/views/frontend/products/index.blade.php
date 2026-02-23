@extends('frontend.layouts.app')

@section('title', 'Products - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('frontend.products.index') }}" method="GET">
                        <!-- Categories -->
                        <div class="mb-4">
                            <h6>Categories</h6>
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="{{ $category->id }}" id="cat{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="cat{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Brands -->
                        <div class="mb-4">
                            <h6>Brands</h6>
                            @foreach($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="brand" value="{{ $brand->id }}" id="brand{{ $brand->id }}"
                                    {{ request('brand') == $brand->id ? 'checked' : '' }}>
                                <label class="form-check-label" for="brand{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <h6>Price Range</h6>
                            <div class="mb-2">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                            </div>
                            <div class="mb-2">
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('frontend.products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Products ({{ $products->total() }})</h4>
                <form action="{{ route('frontend.products.index') }}" method="GET" class="d-flex gap-2">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="hidden" name="brand" value="{{ request('brand') }}">
                    <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                    </select>
                </form>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="position-relative">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                            @else
                                <img src="https://via.placeholder.com/300x250" alt="{{ $product->name }}" class="product-image">
                            @endif
                            
                            @if($product->isOnSale())
                                <span class="product-badge">-{{ $product->getDiscountPercentage() }}%</span>
                            @endif
                        </div>
                        <div class="p-3">
                            <h6 class="mb-2">{{ $product->name }}</h6>
                            @if($product->brand)
                                <small class="text-muted">{{ $product->brand->name }}</small>
                            @endif
                            <div class="mb-2">
                                @if($product->isOnSale())
                                    <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                    <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <div class="d-grid gap-2">
                                <a href="{{ route('frontend.products.show', $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                <form action="{{ route('frontend.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                        <h5>No products found</h5>
                        <p class="text-muted">Try adjusting your filters</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-4">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
