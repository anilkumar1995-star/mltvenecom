@extends('frontend.layouts.app')
@section('title', $store->name)
@section('content')

<main>
    <div class="bb-shop-detail pb-50">
        {{-- Banner Area --}}
        <div class="bb-shop-banner position-relative overflow-hidden mb-40" style="background: #f4f6f8; min-height: 250px;">
            @php
                $cover = $store->cover_image ? (str_starts_with($store->cover_image, 'http') ? $store->cover_image : \App\Helpers\ImageHelper::getImageUrl() . $store->cover_image) : '';
                $logo = $store->logo ? (str_starts_with($store->logo, 'http') ? $store->logo : \App\Helpers\ImageHelper::getImageUrl() . $store->logo) : asset('home/placeholder.png');
            @endphp
            @if($cover)
                <div class="bb-shop-banner-img position-absolute w-100 h-100" style="background: url('{{ $cover }}') center/cover no-repeat; opacity: 0.3;"></div>
            @endif
            <div class="bb-shop-banner-overlay position-absolute w-100 h-100" style="background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.8));"></div>
            
            <div class="container bb-shop-banner-content position-relative z-index-1 py-5 d-flex flex-column flex-md-row align-items-center gap-4">
                <img src="{{ $logo }}" class="bb-shop-banner-logo rounded shadow-sm bg-white p-2" style="width: 140px; height: 140px; object-fit: contain;" alt="{{ $store->name }}">
                
                <div class="bb-shop-banner-info text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                    <h2 class="bb-shop-banner-name mb-2 d-flex align-items-center gap-2 text-white fw-bold"> 
                        {{ $store->name }} 
                        @if($store->is_verified)
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" class="store-verified-badge badge-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="#1d9bf0">
                                    <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                </svg>
                            </span>
                        @endif
                    </h2>
                    
                    <div class="bb-shop-banner-rating d-flex align-items-center gap-2 mb-3">
                        <div class="bb-product-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="fas fa-star" style="color: #ffb21d;"></span>
                            @endfor
                        </div>
                        <small class="text-white-50">({{ $products->total() }} Products)</small>
                    </div>
                    
                    <div class="bb-shop-banner-contact d-flex flex-wrap gap-4 small mb-3">
                        @php $contactStyle = "background: rgba(0,0,0,0.4); padding: 5px 12px; border-radius: 20px;"; @endphp
                        @if($store->address)
                            <div class="bb-shop-banner-address d-flex align-items-center gap-1" style="{{ $contactStyle }}">
                                <i class="fas fa-map-marker-alt"></i> {{ $store->address }} 
                            </div>
                        @endif
                        @if($store->phone)
                            <div class="bb-shop-banner-phone d-flex align-items-center gap-1" style="{{ $contactStyle }}">
                                <i class="fas fa-phone"></i>
                                <a href="tel:{{ $store->phone }}" class="text-white">{{ $store->phone }}</a>
                            </div>
                        @endif
                        @if($store->email)
                            <div class="bb-shop-banner-email d-flex align-items-center gap-1" style="{{ $contactStyle }}">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $store->email }}" class="text-white">{{ $store->email }}</a>
                            </div>
                        @endif
                    </div>
                    
                    @if($store->description)
                        <div class="bb-shop-banner-description ck-content small line-clamp-2 text-white" style="max-width: 800px; text-shadow: 0 1px 2px rgba(0,0,0,0.6);">
                            {!! $store->description !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            {{-- Tabs Navigation --}}
            <ul class="bb-shop-nav-tabs nav nav-tabs mb-4 px-2" id="storeTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                        <i class="fas fa-home me-2"></i> Home 
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about-tab-pane" type="button" role="tab" aria-controls="about-tab-pane" aria-selected="false">
                        <i class="fas fa-info-circle me-2"></i> About the store 
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                        <i class="fas fa-comment-dots me-2"></i> Send message 
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="storeTabContent">
                {{-- Home Tab: Sidebar + Products --}}
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row g-4">
                        {{-- Sidebar --}}
                        <div class="col-xl-3 col-lg-4">
                            <aside class="bb-shop-sidebar sticky-top" style="top: 20px; z-index: 10;">
                                <form action="{{ route('frontend.stores.show', $store->slug) }}" method="GET" class="bb-product-form-filter">
                                    {{-- Search Widget --}}
                                    <div class="tp-shop-widget mb-35 tp-sidebar-search p-3 bg-light rounded shadow-sm">
                                        <h4 class="bb-product-filter-title mb-3 fs-6">Search in Store</h4>
                                        <div class="tp-sidebar-search-input position-relative">
                                            <input type="search" name="q" placeholder="Search..." value="{{ request('q') }}" class="form-control ps-3 pe-5">
                                            <button type="submit" title="Search" class="btn position-absolute top-50 end-0 translate-middle-y border-0 text-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Categories Widget --}}
                                    <div class="bb-product-filter p-3 bg-light rounded shadow-sm">
                                        <h4 class="bb-product-filter-title mb-3 fs-6">Categories</h4>
                                        <div class="bb-product-filter-content">
                                            <ul class="list-unstyled mb-0">
                                                @foreach($categories as $category)
                                                    <li class="mb-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat_{{ $category->id }}" {{ in_array($category->id, (array)request('categories')) ? 'checked' : '' }} onchange="this.form.submit()">
                                                            <label class="form-check-label small" for="cat_{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Hidden fields for sorting/pagination --}}
                                    <input type="hidden" name="sort-by" value="{{ request('sort-by') }}">
                                    <input type="hidden" name="per-page" value="{{ request('per-page') }}">
                                </form>
                            </aside>
                        </div>

                        {{-- Products Area --}}
                        <div class="col-xl-9 col-lg-8">
                            <div class="tp-shop-top mb-45 bg-light p-3 rounded shadow-sm">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="tp-shop-top-result small">
                                            <p class="mb-0">Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="tp-shop-top-right d-flex align-items-center justify-content-md-end gap-3 mt-3 mt-md-0">
                                            <div class="tp-shop-top-select">
                                                <select name="sort-by" class="form-select form-select-sm" onchange="window.location.href = '{{ route('frontend.stores.show', $store->slug) }}?' + new URLSearchParams(Object.assign({{ json_encode(request()->query()) }}, { 'sort-by': this.value })).toString()">
                                                    <option value="default_sorting" {{ request('sort-by') == 'default_sorting' ? 'selected' : '' }}>Default</option>
                                                    <option value="date_asc" {{ request('sort-by') == 'date_asc' ? 'selected' : '' }}>Oldest</option>
                                                    <option value="date_desc" {{ request('sort-by') == 'date_desc' ? 'selected' : '' }}>Newest</option>
                                                    <option value="price_asc" {{ request('sort-by') == 'price_asc' ? 'selected' : '' }}>Price: low to high</option>
                                                    <option value="price_desc" {{ request('sort-by') == 'price_desc' ? 'selected' : '' }}>Price: high to low</option>
                                                    <option value="name_asc" {{ request('sort-by') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                                                    <option value="name_desc" {{ request('sort-by') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                                                </select>
                                            </div>
                                            <div class="tp-shop-top-select">
                                                <select name="per-page" class="form-select form-select-sm" onchange="window.location.href = '{{ route('frontend.stores.show', $store->slug) }}?' + new URLSearchParams(Object.assign({{ json_encode(request()->query()) }}, { 'per-page': this.value })).toString()">
                                                    <option value="12" {{ request('per-page') == 12 ? 'selected' : '' }}>12</option>
                                                    <option value="24" {{ request('per-page') == 24 ? 'selected' : '' }}>24</option>
                                                    <option value="36" {{ request('per-page') == 36 ? 'selected' : '' }}>36</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-xxl-3 row-cols-md-2 row-cols-sm-2 row-cols-2 g-4">
                                @forelse($products as $product)
                                    <div class="col">
                                        @include('frontend.partials.product-card-grid', ['product' => $product])
                                    </div>
                                @empty
                                    <div class="col-12 py-5 text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-search fa-3x text-muted opacity-25"></i>
                                        </div>
                                        <p class="text-muted">No products found for this search/filter.</p>
                                        <a href="{{ route('frontend.stores.show', $store->slug) }}" class="btn btn-outline-primary btn-sm">Clear all filters</a>
                                    </div>
                                @endforelse
                            </div>

                            <div class="row mt-50">
                                <div class="col-12">
                                    <div class="tp-pagination text-center">
                                        {{ $products->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- About Tab --}}
                <div class="tab-pane fade" id="about-tab-pane" role="tabpanel" aria-labelledby="about-tab">
                    <div class="card shadow-sm border-0 p-4">
                        <div class="ck-content">
                            @if($store->content)
                                {!! $store->content !!}
                            @else
                                <p class="text-muted">No about information available for this store.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Contact Tab --}}
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 p-4">
                                <h3 class="fs-4 mb-3">Email {{ $store->name }}</h3>
                                <p class="small text-muted mb-4">All messages are recorded and spam is not tolerated. Your email address will be shown to the recipient.</p>
                                
                                @if(session('success'))
                                    <div class="alert alert-success border-0 shadow-sm mb-4">
                                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger border-0 shadow-sm mb-4">
                                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                    </div>
                                @endif

                                <form action="{{ route('frontend.stores.message', $store->slug) }}" method="POST" id="contact-store-form">
                                    @csrf
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Your name" name="name" type="text" required>
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control" placeholder="Your email address" name="email" type="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea class="form-control" rows="5" placeholder="Type your message..." name="content" required></textarea>
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">Send message</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4 mt-md-0">
                            <div class="card shadow-sm bg-primary text-white border-0 p-4 h-100">
                                <h4 class="mb-4">Contact Information</h4>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="fas fa-map-marker-alt mt-1"></i>
                                        <div>
                                            <strong>Address:</strong><br>
                                            {{ $store->address ?? 'Not provided' }}
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="fas fa-phone-alt mt-1"></i>
                                        <div>
                                            <strong>Phone:</strong><br>
                                            {{ $store->phone ?? 'Not provided' }}
                                        </div>
                                    </li>
                                    <li class="mb-3 d-flex gap-3">
                                        <i class="fas fa-envelope mt-1"></i>
                                        <div>
                                            <strong>Email:</strong><br>
                                            {{ $store->email ?? 'Not provided' }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('styles')
<style>
    .bb-shop-banner-logo {
        transition: transform 0.3s ease;
    }
    .bb-shop-banner-logo:hover {
        transform: scale(1.05);
    }
    .bb-shop-nav-tabs .nav-link {
        border: none;
        color: #666;
        font-weight: 500;
        padding: 12px 25px;
        position: relative;
    }
    .bb-shop-nav-tabs .nav-link.active {
        color: var(--primary-color);
        background: transparent;
    }
    .bb-shop-nav-tabs .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 3px;
        background: var(--primary-color);
        border-radius: 3px;
    }
    .tp-shop-widget {
        border: none;
    }
    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
