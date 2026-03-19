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
                <div class="tp-product-rating-icon-2 mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <span><i class="fas fa-star" style="color: {{ $i <= round($product->reviews_avg ?? 0) ? '#ffb21d' : '#d5d5d5' }}; font-size: 10px;"></i></span>
                    @endfor
                    <span class="ms-1 text-muted" style="font-size: 10px;">({{ $product->reviews_count ?? 0 }})</span>
                </div>
                @if($product->brand)
                    <small class="text-muted">{{ $product->brand->name }}</small>
                @endif
                <div class="mb-2">
                    @if($product->isOnSale())
                        <span class="text-danger fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                        <span class="text-muted text-decoration-line-through ms-2">₹{{ number_format($product->price, 2) }}</span>
                    @else
                        <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                <div class="d-grid gap-2">
                    <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                    @if(isset(session('cart', [])[$product->id]))
                        <div class="tp-product-quantity d-flex align-items-center justify-content-between w-100 px-3" style="background-color: #F3F5F6; height: 38px; border-radius: 4px;">
                            <form action="{{ route('frontend.cart.update') }}" method="POST" class="d-flex align-items-center w-100 m-0 p-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <span class="tp-cart-minus d-flex align-items-center justify-content-center" style="cursor:pointer; width:30px; height:100%; color: #010F1C;" onclick="var input = this.nextElementSibling; if(parseInt(input.value) <= 1) { document.getElementById('remove-plist-{{ $product->id }}').submit(); } else { input.value--; this.closest('form').submit(); }">
                                    <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                
                                <input type="text" name="quantity" value="{{ session('cart', [])[$product->id]['quantity'] }}" class="tp-cart-input text-center w-100 m-0 bg-transparent border-0 fw-medium text-dark" style="height: 100%; outline: none; font-size: 15px;" readonly>
                                
                                <span class="tp-cart-plus d-flex align-items-center justify-content-center" style="cursor:pointer; width:30px; height:100%; color: #010F1C;" onclick="var input = this.previousElementSibling; input.value++; this.closest('form').submit();">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </form>
                            <form id="remove-plist-{{ $product->id }}" action="{{ route('frontend.cart.remove', $product->id) }}" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @else
                        <form action="{{ route('frontend.cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    @endif
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
