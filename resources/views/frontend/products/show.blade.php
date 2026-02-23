@extends('frontend.layouts.app')

@section('title', $product->name . ' - Shofy E-commerce')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                    @else
                        <img src="https://via.placeholder.com/600x600" alt="{{ $product->name }}" class="img-fluid rounded">
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h1 class="h2">{{ $product->name }}</h1>
            
            @if($product->brand)
                <p class="text-muted">Brand: <a href="{{ route('frontend.brands.show', $product->brand->slug ?: $product->brand->id) }}">{{ $product->brand->name }}</a></p>
            @endif

            <!-- Price -->
            <div class="mb-3">
                @if($product->isOnSale())
                    <h3 class="text-danger">${{ number_format($product->sale_price, 2) }}</h3>
                    <p class="text-muted">
                        <del>${{ number_format($product->price, 2) }}</del>
                        <span class="badge bg-danger ms-2">Save {{ $product->getDiscountPercentage() }}%</span>
                    </p>
                @else
                    <h3>${{ number_format($product->price, 2) }}</h3>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="mb-3">
                @if($product->isOutOfStock())
                    <span class="badge bg-danger">Out of Stock</span>
                @else
                    <span class="badge bg-success">In Stock ({{ $product->quantity }} available)</span>
                @endif
            </div>

            <!-- Description -->
            @if($product->description)
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $product->description }}</p>
            </div>
            @endif

            <!-- Add to Cart -->
            <form action="{{ route('frontend.cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="row g-3">
                    <div class="col-auto">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->quantity }}" style="width: 100px;">
                    </div>
                    <div class="col-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                        <button type="submit" formaction="{{ route('frontend.cart.buyNow') }}" class="btn btn-dark btn-lg ms-2">
                            Buy Now
                        </button>
                    </div>
                </div>
            </form>

            <!-- Categories -->
            @if($product->categories->count() > 0)
            <div class="mb-3">
                <strong>Categories:</strong>
                @foreach($product->categories as $category)
                    <a href="{{ route('frontend.categories.show', $category->slug) }}" class="badge bg-secondary text-decoration-none">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            @endif

            <!-- Tags -->
            @if($product->tags->count() > 0)
            <div class="mb-3">
                <strong>Tags:</strong>
                @foreach($product->tags as $tag)
                    <span class="badge bg-light text-dark">{{ $tag->name }}</span>
                @endforeach
            </div>
            @endif

            <!-- SKU -->
            <p class="text-muted">SKU: {{ $product->sku }}</p>
        </div>
    </div>

    <!-- Product Details -->
    @if($product->content)
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product Details</h5>
                </div>
                <div class="card-body">
                    {!! nl2br(e($product->content)) !!}
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Reviews -->
    @if($product->reviews->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Customer Reviews ({{ $product->reviews->count() }})</h5>
                </div>
                <div class="card-body">
                    @foreach($product->reviews as $review)
                    <div class="mb-3 pb-3 border-bottom">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $review->customer->name ?? 'Anonymous' }}</strong>
                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                        </div>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $review->star)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <p class="mb-0">{{ $review->comment }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Related Products -->
    @if($related_products->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Related Products</h3>
            <div class="row g-4">
                @foreach($related_products as $related)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="position-relative">
                            @if($related->image)
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="product-image">
                            @else
                                <img src="https://via.placeholder.com/300x250" alt="{{ $related->name }}" class="product-image">
                            @endif
                        </div>
                        <div class="p-3">
                            <h6 class="mb-2">{{ $related->name }}</h6>
                            <div class="mb-2">
                                <span class="fw-bold">${{ number_format($related->getFinalPrice(), 2) }}</span>
                            </div>
                            <a href="{{ route('frontend.products.show', $related->slug) }}" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
