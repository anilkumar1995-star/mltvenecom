<div class="row g-4">
    @forelse($products as $product)
    <div class="col-md-4">
        <div class="product-card">
            <div class="position-relative">
                @if($product->image)
                    <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                @else
                    <img src="{{ asset('uploads/products/no-img.png') }}" alt="{{ $product->name }}" class="product-image">
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
