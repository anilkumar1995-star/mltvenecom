@extends('admin-layouts.app')
@section('title', 'Create Flash Sale')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.flash-sales.index') }}">Flash Sales</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">New Flash Sale</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="page-body page-content">
        <div class="container-xl">
            <form action="{{ route('admin.flash-sales.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="gap-3 col-md-9">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="mb-3 position-relative">
                                    <label class="form-label required" for="name">Name</label>
                                    <input class="form-control" placeholder="Name" data-counter="120" name="name" type="text" id="name" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Products</label>
                                <div class="mb-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="product-search" placeholder="Search products">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                    <div class="list-group position-absolute w-100" id="product-search-results" style="z-index: 1000; display: none; max-height: 300px; overflow-y: auto;">
                                        <!-- Search results will appear here -->
                                        @foreach($products as $product)
                                            <a href="#" class="list-group-item list-group-item-action product-search-item"
                                               data-id="{{ $product->id }}"
                                               data-name="{{ $product->name }}"
                                               data-price="{{ $product->price }}"
                                               data-image="{{ $product->image ? asset('uploads/' . $product->image) : asset('home-dashboard-files/placeholder.png') }}"
                                               style="display: none;">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $product->image ? asset('uploads/' . $product->image) : asset('home-dashboard-files/placeholder.png') }}" alt="{{ $product->name }}" width="30" class="me-2">
                                                    <span>{{ $product->name }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Selected products</label>
                                    <div class="list-group" id="selected-products-list">
                                        <!-- Selected products will be added here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Publish</h4>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <button class="btn btn-primary" type="submit" name="submiter" value="save">
                                    <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Save
                                </button>
                                <button class="btn btn-outline-secondary" type="submit" name="submiter" value="save-exit">
                                    <i class="fa fa-arrow-left me-2"></i> Save & Exit
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Status <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <select class="form-select" name="status" id="status" required>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">End date <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 position-relative">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                    </span>
                                    <input class="form-control form-date-time" name="end_date" type="text" id="end_date" placeholder="Y-m-d H:i:s" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('product-search');
        const searchResults = document.getElementById('product-search-results');
        const productsList = document.getElementById('selected-products-list');
        const searchItems = document.querySelectorAll('.product-search-item');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            let hasResults = false;

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            searchItems.forEach(item => {
                const name = item.getAttribute('data-name').toLowerCase();
                if (name.includes(query)) {
                    item.style.display = 'block';
                    hasResults = true;
                } else {
                    item.style.display = 'none';
                }
            });

            searchResults.style.display = hasResults ? 'block' : 'none';
        });

        // Hide search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });

        // Add product to list
        searchResults.addEventListener('click', function(e) {
            e.preventDefault();
            const item = e.target.closest('.product-search-item');
            if (!item) return;

            const id = item.getAttribute('data-id');
            const name = item.getAttribute('data-name');
            const price = item.getAttribute('data-price');
            const image = item.getAttribute('data-image');

            // Check if already added
            if (document.querySelector(`input[name="products[${id}][product_id]"]`)) {
                alert('Product already added!');
                return;
            }

            const productItem = document.createElement('div');
            productItem.className = 'list-group-item product-item';
            productItem.innerHTML = `
                <div class="d-flex align-items-center mb-2">
                    <img src="${image}" alt="${name}" width="40" class="me-3 rounded">
                    <div>
                        <a href="#" target="_blank" class="fw-bold text-dark">${name}</a>
                    </div>
                    <div class="ms-auto">
                        <button type="button" class="btn btn-icon btn-sm btn-danger remove-product-btn">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Price <span class="text-danger">*</span></label>
                        <input type="hidden" name="products[${id}][product_id]" value="${id}">
                        <div class="input-group">
                            <input type="number" class="form-control" name="products[${id}][price]" value="${price}" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="products[${id}][quantity]" value="1" min="1" required>
                    </div>
                </div>
            `;

            productsList.appendChild(productItem);
            searchResults.style.display = 'none';
            searchInput.value = '';
        });

        // Remove product from list
        productsList.addEventListener('click', function(e) {
            if (e.target.closest('.remove-product-btn')) {
                e.target.closest('.product-item').remove();
            }
        });
    });
</script>
@endpush
