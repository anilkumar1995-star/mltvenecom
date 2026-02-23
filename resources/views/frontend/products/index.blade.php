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
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    @include('frontend.partials.product-card-grid', ['product' => $product])
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="tp-error-content">
                            <h4 class="tp-error-title">No products found</h4>
                            <p>Try adjusting your search or filters to find what you're looking for.</p>
                            <a href="{{ route('frontend.home') }}" class="tp-btn-green">Back to Home</a>
                        </div>
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
