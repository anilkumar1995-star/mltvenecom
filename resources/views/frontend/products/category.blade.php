@extends('frontend.layouts.app')

@section('title', 'Products - Shofy E-commerce')

@section('content')
   <main>
        <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 mb-30 text-start pt-30 page_speed_462687251">
            <div class="container">
                <div class="breadcrumb__content p-relative z-index-1">
                    <h3 class="breadcrumb__title">{{ $category->name }}</h3>
                    <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile"><span><a class="d-inline-block" href="{{ url('/') }}">Home</a></span><span><a class="d-inline-block" href="{{ route('frontend.products.index') }}">Products</a></span><span> {{ $category->name }} </span></div>
                </div>
            </div>
        </section>
        <section class="tp-page-area pb-80 pt-50">
            <div class="container">
                <section class="tp-shop-area ">
                    <div class="container position-relative">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="bb-filter-offcanvas-area">
                                    <div class="bb-filter-offcanvas-wrapper">
                                        <div class="bb-filter-offcanvas-close"><button type=button class="bb-filter-offcanvas-close-btn" data-bb-toggle="toggle-filter-sidebar"><svg xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M18 6l-12 12" />
                                                    <path d="M6 6l12 12" />
                                                </svg> Close </button></div>
                                        <div class="bb-shop-sidebar">
                                            <form action="{{ url()->current() }}" method="GET" class="bb-product-form-filter">
                                                <div class="bb-ecommerce-filter-hidden-fields">
                                                    <input name="category" type="hidden" value="{{ $category->id }}">
                                                    <input name="layout" type="hidden" class="product-filter-item" value="">
                                                    <input name="page" type="hidden" class="product-filter-item" value="">
                                                    <input name="per-page" type="hidden" class="product-filter-item" value="">
                                                    <input name="num" type="hidden" class="product-filter-item" value="">
                                                    <input name="sort-by" type="hidden" class="product-filter-item" value="">
                                                    <input name="collection" type="hidden" class="product-filter-item" value="">
                                                    <input name="discounted_only" type="hidden" class="product-filter-item" value="">
                                                </div>
                                                <div class="tp-shop-widget mb-35 tp-sidebar-search">
                                                    <div class="tp-sidebar-search-input">
                                                        <input type="search" name="q" placeholder="Search..." value="{{ request('q') }}">
                                                        <button type="submit" title="Search">
                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.11111 15.2222C12.0385 15.2222 15.2222 12.0385 15.2222 8.11111C15.2222 4.18375 12.0385 1 8.11111 1C4.18375 1 1 4.18375 1 8.11111C1 12.0385 4.18375 15.2222 8.11111 15.2222Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M16.9995 17L13.1328 13.6667" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="bb-product-filter">
                                                    <h4 class="bb-product-filter-title">Categories</h4>
                                                    <div class="bb-product-filter-content">
                                                        <ul class="bb-product-filter-items active">
                                                            <li class="bb-product-filter-item">
                                                                <a href="{{ route('frontend.products.index') }}" class="bb-product-filter-link">
                                                                    <svg class="icon svg-icon-ti-ti-chevron-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M6 6l6-6l6-6m-6-6l-6-6l-6-6m-6-6l-6-6l-6-6m-6-6l-6-6l-6-6m-6-6l-6-6l-6-6m-7 -7l7 -7l7 -7m7 -7l7 -7l7 -7m7 -7l7 -7l7 -7m7 -7l7 -7l7 -7m0 -4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h4v4h0z"></path>
                                                                    </svg> All categories
                                                                </a>
                                                            </li>
                                                            @foreach($categories as $cat)
                                                                @php
                                                                    $isActive = $category->id == $cat->id || ($category->parent_id == $cat->id && $category->parent_id != 0);
                                                                    $hasChildren = $cat->children->count() > 0;
                                                                @endphp
                                                                <li class="bb-product-filter-item">
                                                                    <a href="{{ route('frontend.categories.show', $cat->slug) }}" class="bb-product-filter-link {{ $isActive ? 'active' : '' }}" data-id="{{ $cat->id }}">
                                                                        <svg class="icon svg-icon-ti-ti-folder" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                            <path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" />
                                                                        </svg> {{ $cat->name }}
                                                                    </a>
                                                                    @if($hasChildren)
                                                                        <ul class="bb-product-filter-items {{ $isActive ? 'active' : '' }}">
                                                                            @foreach($cat->children as $child)
                                                                                <li class="bb-product-filter-item">
                                                                                    <a href="{{ route('frontend.categories.show', $child->slug) }}" class="bb-product-filter-link {{ $category->id == $child->id ? 'active' : '' }}" data-id="{{ $child->id }}">
                                                                                        {{ $child->name }}
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                        <button type="button" data-bb-toggle="toggle-product-categories-tree">
                                                                            <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                                <path d="M12 5l0 14" />
                                                                                <path d="M5 12l14 0" />
                                                                            </svg>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon svg-icon-ti-ti-minus">
                                                                                <path d="M5 12l14 0" />
                                                                            </svg>
                                                                        </button>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="bb-product-filter">
                                                    <h4 class="bb-product-filter-title">Brands</h4>
                                                    <div class="bb-product-filter-content">
                                                        <ul class="bb-product-filter-items filter-checkbox">
                                                            @foreach ($brands as $brand)
                                                            <li class="bb-product-filter-item">
                                                                <input id="attribute-brand-{{ $brand->id }}" type="checkbox" name="brands[]" value="{{ $brand->id }}" {{ is_array(request('brands')) && in_array($brand->id, request('brands')) ? 'checked' : '' }} onchange="this.form.submit()">
                                                                <label for="attribute-brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="bb-product-filter">
                                                    <h4 class="bb-product-filter-title border-0 mb-3">Price</h4>
                                                    <div class="bb-product-filter-content">
                                                        <div class="bb-product-price-filter">
                                                            <div class="price-slider mb-20" data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}" data-current-min="{{ request('min_price', $minPrice) }}" data-current-max="{{ request('max_price', $maxPrice) }}"></div>
                                                            <div class="bb-product-price-filter-info d-flex align-items-center justify-content-between">
                                                                <span class="input-range">
                                                                    <input name="min_price" type="hidden" value="{{ request('min_price', $minPrice) }}">
                                                                    <input name="max_price" type="hidden" value="{{ request('max_price', $maxPrice) }}">
                                                                    <span class="input-range-label"><span class="from"></span> &mdash; <span class="to"></span></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="bb-product-filter mt-20">
                                                    <button type="submit" class="tp-btn tp-btn-2 w-100" style="background-color: #010F1C; color: white; padding: 10px; border-radius: 5px; border: none;">Filter Products</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-8">
                                <div class="tp-shop-main-wrapper">
                                    <div class="bb-product-listing-page-description">
                                        <div class="bb-block__header">
                                            <h1 class="h1">{{ $category->name }}</h1>
                                        </div>
                                    </div>
                                    <div class="tp-shop-top mb-45">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="tp-shop-top-left d-flex align-items-center">
                                                    <div class="tp-shop-top-tab tp-tab">
                                                        <ul class="nav nav-tabs" id="productTab" role="tablist">
                                                            <li class="nav-item" role="presentation"><button class="nav-link active" data-value="grid" id="grid-tab" data-bb-toggle="change-product-filter-layout" type=button role="tab" aria-controls="grid-tab-pane" aria-selected="true"><svg class="icon svg-icon-ti-ti-layout-grid" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M4 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                                                                        <path d="M14 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                                                                        <path d="M4 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                                                                        <path d="M14 15a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1l0 -4" />
                                                                    </svg></button></li>
                                                            <li class="nav-item" role="presentation"><button class="nav-link" data-value="list" id="list-tab" data-bb-toggle="change-product-filter-layout" type=button role="tab" aria-controls="list-tab-pane" aria-selected="false"><svg class="icon svg-icon-ti-ti-layout-list" xmlns="http://www.w3.org/2000/svg" width=24 height=24 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M4 6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -2" />
                                                                        <path d="M4 16a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -2" />
                                                                    </svg></button></li>
                                                        </ul>
                                                    </div>
                                                    <div class="tp-shop-top-result">
                                                        <p>Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
                                                    <div class="tp-shop-top-select"><select name=sort-by data-nice-select>
                                                            <option value="default_sorting">Default</option>
                                                            <option value="date_asc">Oldest</option>
                                                            <option value="date_desc">Newest</option>
                                                            <option value="price_asc">Price: low to high</option>
                                                            <option value="price_desc">Price: high to low</option>
                                                            <option value="name_asc">Name: A-Z</option>
                                                            <option value="name_desc">Name: Z-A</option>
                                                            <option value="rating_asc">Rating: low to high</option>
                                                            <option value="rating_desc">Rating: high to low</option>
                                                        </select></div>
                                                    <div class="tp-shop-top-select sort-by"><select name=per-page data-nice-select>
                                                            <option value="12">12</option>
                                                            <option value="24" selected>24</option>
                                                            <option value="36">36</option>
                                                        </select></div>
                                                    <div class="tp-shop-top-filter d-lg-none"><button type=button class="tp-filter-btn" data-bb-toggle="toggle-filter-sidebar"><span><svg width=16 height=15 viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.9998 3.45001H10.7998" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M3.8 3.45001H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M6.5999 5.9C7.953 5.9 9.0499 4.8031 9.0499 3.45C9.0499 2.0969 7.953 1 6.5999 1C5.2468 1 4.1499 2.0969 4.1499 3.45C4.1499 4.8031 5.2468 5.9 6.5999 5.9Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M15.0002 11.15H12.2002" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M5.2 11.15H1" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M9.4002 13.6C10.7533 13.6 11.8502 12.5031 11.8502 11.15C11.8502 9.79691 10.7533 8.70001 9.4002 8.70001C8.0471 8.70001 6.9502 9.79691 6.9502 11.15C6.9502 12.5031 8.0471 13.6 9.4002 13.6Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg></span> Filter </button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bb-product-items-wrapper tp-shop-item-primary">
                                        <div class="row mb-30 row-cols-xxl-3 row-cols-md-2 row-cols-sm-2 row-cols-2">
                                            @forelse ($products as $product)
                                             @php
                                                $imageUrl = $product->image ? (str_starts_with($product->image, 'http') ? $product->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($product->image, '/')) : asset('home/placeholder.png');
                                                @endphp
                                            <div class="col">
                                                <div class="tp-product-item-5 p-relative white-bg mb-40 ">
                                                    <div class="tp-product-thumb-5 w-img fix mb-15"><a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}">
                                                            @if($product->image)
                                                                <img src="{{ $imageUrl }}" data-bb-lazy="true" loading="lazy" alt="{{ $product->name }}">
                                                            @else
                                                                <img src="{{ asset('storage/main/general/placeholder.png') }}" data-bb-lazy="true" loading="lazy" alt="{{ $product->name }}">
                                                            @endif
                                                        </a>
                                                        <div class="tp-product-badge">
                                                            @if(method_exists($product, 'isOnSale') && $product->isOnSale())
                                                                <span class="product-sale">-{{ $product->getDiscountPercentage() }}%</span>
                                                            @endif
                                                        </div>
                                                        <div class="tp-product-action-2 tp-product-action-5 tp-product-action-greenStyle">
                                                            <div class="tp-product-action-item-2 d-flex flex-column">
                                                                <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" class="tp-product-action-btn-2 tp-product-quick-view-btn" title="Quick View">
                                                                    <svg width="18" height="15" viewBox="0 0 18 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99948 5.06828C7.80247 5.06828 6.82956 6.04044 6.82956 7.23542C6.82956 8.42951 7.80247 9.40077 8.99948 9.40077C10.1965 9.40077 11.1703 8.42951 11.1703 7.23542C11.1703 6.04044 10.1965 5.06828 8.99948 5.06828ZM8.99942 10.7482C7.0581 10.7482 5.47949 9.17221 5.47949 7.23508C5.47949 5.29705 7.0581 3.72021 8.99942 3.72021C10.9407 3.72021 12.5202 5.29705 12.5202 7.23508C12.5202 9.17221 10.9407 10.7482 8.99942 10.7482Z" fill="currentColor"/>
                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.41273 7.2346C3.08674 10.9265 5.90646 13.1215 8.99978 13.1224C12.0931 13.1215 14.9128 10.9265 16.5868 7.2346C14.9128 3.54363 12.0931 1.34863 8.99978 1.34773C5.90736 1.34863 3.08674 3.54363 1.41273 7.2346ZM9.00164 14.4703H8.99804H8.99714C5.27471 14.4676 1.93209 11.8629 0.0546754 7.50073C-0.0182251 7.33091 -0.0182251 7.13864 0.0546754 6.96883C1.93209 2.60759 5.27561 0.00288103 8.99714 0.000185582C8.99894 -0.000712902 8.99894 -0.000712902 8.99984 0.000185582C9.00164 -0.000712902 9.00164 -0.000712902 9.00254 0.000185582C12.725 0.00288103 16.0676 2.60759 17.945 6.96883C18.0188 7.13864 18.0188 7.33091 17.945 7.50073C16.0685 11.8629 12.725 14.4676 9.00254 14.4703H9.00164Z" fill="currentColor"/>
                                                                    </svg>
                                                                    <span class="tp-product-tooltip tp-product-tooltip-right">Quick View</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tp-product-content-5">
                                                        <div class="tp-product-tag-5">
                                                            <span>
                                                                @if($product->brand)
                                                                    <a href="{{ route('frontend.brands.show', $product->brand->slug ?? $product->brand) }}">{{ $product->brand->name ?? $product->brand }}</a>
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <h3 class="tp-product-title-2 line-clamp-2">
                                                            <a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}" title="{{ $product->name }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div class="">
                                                            <div class="tp-product-rating d-flex align-items-center mb-1">
                                                                <div class="tp-product-rating-icon">
                                                                    <div class="bb-product-rating"><span style="width: {{ ($product->reviews_avg ?? 0) * 20 }}%;"></span></div>
                                                                </div>
                                                                <div class="tp-product-rating-text"><a href="{{ route('frontend.products.show', $product->slug ?: $product->id) }}#review">({{ $product->reviews_count ?? 0 }} reviews)</a></div>
                                                            </div>
                                                            <div class="tp-product-price-wrapper-5">
                                                                @if(method_exists($product, 'isOnSale') && $product->isOnSale())
                                                                    <span class="tp-product-price-5 new-price">₹{{ number_format($product->sale_price, 2) }}</span>
                                                                    <span class=""><small><del class="tp-product-price-5 old-price">₹{{ number_format($product->price, 2) }}</del></small></span>
                                                                @else
                                                                    <span class="tp-product-price-5 new-price">₹{{ number_format($product->price, 2) }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @empty
                                            <div class="col-12">
                                                <div class="text-center py-5">
                                                    <h5>No products found in this category</h5>
                                                </div>
                                            </div>
                                            @endforelse
                                            
                                            <!-- Pagination -->
                                            @if(isset($products) && $products->hasPages())
                                            <div class="col-12 mt-4 bb-pagination-wrapper">
                                                {{ $products->links() }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>
@endsection
