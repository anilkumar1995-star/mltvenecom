@extends('frontend.layouts.app')
@section('title', 'All Stores')
@section('content')

<main>
    <section class="breadcrumb__area include-bg pt-40 pb-40 mb-40 mb-20 text-start pt-20 page_speed_272179630">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Stores</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Stores </span>
                </div>
            </div>
        </div>
    </section>

    <div class="tp-page-area pt-30 pb-120">
        <div class="container">
            <div class="tp-shop-top mb-45">
                <div class="tp-shop-top-left d-flex flex-wrap gap-3 justify-content-between align-items-center">
                    <div class="tp-shop-top-result">
                        <p>Showing {{ $stores->firstItem() }}-{{ $stores->lastItem() }} of {{ $stores->total() }} stores</p>
                    </div>
                    <form method="GET" action="{{ route('frontend.stores.index') }}" accept-charset="UTF-8">
                        <div class="tp-sidebar-search-input">
                            <input type="search" name="q" placeholder="Search..." value="{{ request('q') }}">
                            <button type="submit" title="Search">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.9995 17L13.1328 13.1333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row g-4 mb-40">
                @forelse($stores as $store)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="card bb-store-item h-100 shadow-sm border-0">
                            <div class="bb-store-item-content p-4">
                                <a href="{{ route('frontend.stores.show', $store->slug) }}">
                                    <h4 class="mb-2"> 
                                        {{ $store->name }} 
                                        @if($store->is_verified)
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified" class="store-verified-badge badge-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#1d9bf0">
                                                    <path d="M22.25 12c0-1.43-.88-2.67-2.19-3.34.46-1.39.2-2.9-.81-3.91s-2.52-1.27-3.91-.81c-.66-1.31-1.91-2.19-3.34-2.19s-2.67.88-3.33 2.19c-1.4-.46-2.91-.2-3.92.81s-1.26 2.52-.8 3.91c-1.31.67-2.2 1.91-2.2 3.34s.89 2.67 2.2 3.34c-.46 1.39-.21 2.9.8 3.91s2.52 1.26 3.91.81c.67 1.31 1.91 2.19 3.34 2.19s2.68-.88 3.34-2.19c1.39.45 2.9.2 3.91-.81s1.27-2.52.81-3.91c1.31-.67 2.19-1.91 2.19-3.34zm-11.71 4.2L6.8 12.46l1.41-1.42 2.26 2.26 4.8-5.23 1.47 1.36-6.2 6.77z"></path>
                                                </svg>
                                            </span>
                                        @endif
                                    </h4>
                                </a>
                                {{-- Rating Placeholder (Calculated from products eventually) --}}
                                <div class="d-flex align-items-center gap-1 bb-store-item-rating mb-3">
                                    <div class="bb-product-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="fas fa-star" style="color: #ffb21d;"></span>
                                        @endfor
                                    </div>
                                    <a href="{{ route('frontend.stores.show', $store->slug) }}" class="small text-muted">({{ $store->products_count }} Products)</a>
                                </div>

                                @if($store->address)
                                    <p class="bb-store-item-info text-truncate mb-2" title="{{ $store->address }}">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0"></path>
                                        </svg>
                                        {{ $store->address }}
                                    </p>
                                @endif

                                @if($store->phone)
                                    <p class="bb-store-item-info mb-2">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        </svg>
                                        <a href="tel:{{ $store->phone }}">{{ $store->phone }}</a>
                                    </p>
                                @endif

                                @if($store->email)
                                    <p class="bb-store-item-info mb-0">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10"></path>
                                            <path d="M3 7l9 6l9 -6"></path>
                                        </svg>
                                        <a href="mailto:{{ $store->email }}">{{ $store->email }}</a>
                                    </p>
                                @endif
                            </div>
                            <div class="bb-store-item-footer d-flex align-items-center justify-content-between p-4 bg-light">
                                <div class="bb-store-item-logo" style="width: 100px; height: 100px;">
                                    <a href="{{ route('frontend.stores.show', $store->slug) }}">
                                        @php
                                            $logo = $store->logo ? (str_starts_with($store->logo, 'http') ? $store->logo : \App\Helpers\ImageHelper::getImageUrl() . $store->logo) : asset('home/placeholder.png');
                                        @endphp
                                        <img src="{{ $logo }}" alt="{{ $store->name }}" class="img-fluid rounded" style="object-fit: contain; height: 100%;">
                                    </a>
                                </div>
                                <div class="bb-store-item-action">
                                    <a href="{{ route('frontend.stores.show', $store->slug) }}" class="btn btn-primary btn-sm">
                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 21l18 0"></path>
                                            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                            <path d="M5 21l0 -10.15"></path>
                                            <path d="M19 21l0 -10.15"></path>
                                            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                        </svg> 
                                        Visit Store 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No stores found.</div>
                    </div>
                @endforelse
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tp-pagination mt-30">
                        {{ $stores->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
    .bb-store-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .bb-store-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .bb-store-item-info {
        font-size: 14px;
        color: #666;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .bb-store-item-info svg {
        color: var(--primary-color);
        flex-shrink: 0;
    }
    .bb-store-item-rating span {
        font-size: 12px;
    }
    .tp-sidebar-search-input {
        position: relative;
    }
    .tp-sidebar-search-input input {
        padding: 10px 45px 10px 15px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
        width: 100%;
        min-width: 250px;
    }
    .tp-sidebar-search-input button {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: none;
        color: #666;
    }
</style>
@endpush
