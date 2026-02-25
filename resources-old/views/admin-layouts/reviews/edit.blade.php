@extends('admin-layouts.app')
@section('title', 'Edit Review')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Ecommerce</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Review</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <main class="page-body">
        <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Product</label>
                                    <input type="text" class="form-control" id="product-search" placeholder="Search product..." value="{{ $review->product ? $review->product->name : '' }}">
                                    <input type="hidden" name="product_id" id="product-id" value="{{ $review->product_id }}" required>
                                    <div class="list-group mt-2" id="product-results" style="display:none; max-height: 200px; overflow-y: auto; z-index: 1000; position: absolute; width: 95%;"></div>
                                    <div id="selected-product" class="mt-2 text-primary font-weight-bold">
                                        @if($review->product)
                                            Selected: {{ $review->product->name }}
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Choose from existing customers</label>
                                    <input type="text" class="form-control" id="customer-search" placeholder="Search customer..." value="{{ $review->customer ? $review->customer->name : '' }}">
                                    <input type="hidden" name="customer_id" id="customer-id" value="{{ $review->customer_id }}">
                                    <div class="list-group mt-2" id="customer-results" style="display:none; max-height: 200px; overflow-y: auto; z-index: 1000; position: absolute; width: 95%;"></div>
                                    <div id="selected-customer" class="mt-2 text-primary font-weight-bold">
                                        @if($review->customer)
                                            Selected: {{ $review->customer->name }} ({{ $review->customer->email }})
                                        @endif
                                    </div>
                                    <div class="form-text">Choose a customer to leave a review as them. If you want to enter the customer details manually, leave empty this field and fill the customer name and email fields below.</div>
                                </div>

                                <div class="p-3 bg-light border rounded mb-3">
                                    <label class="form-label">Or enter manually customer details:</label>
                                    <div class="mb-3">
                                        <label class="form-label required">Customer name</label>
                                        <input type="text" class="form-control" name="customer_name" placeholder="Customer name" data-counter="250" value="{{ !$review->customer_id ? $review->customer_name : '' }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label required">Customer email</label>
                                        <input type="email" class="form-control" name="customer_email" placeholder="Customer email" data-counter="60" value="{{ !$review->customer_id ? $review->customer_email : '' }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Star</label>
                                    <select class="form-select" name="star">
                                        <option value="5" {{ $review->star == 5 ? 'selected' : '' }}>5</option>
                                        <option value="4" {{ $review->star == 4 ? 'selected' : '' }}>4</option>
                                        <option value="3" {{ $review->star == 3 ? 'selected' : '' }}>3</option>
                                        <option value="2" {{ $review->star == 2 ? 'selected' : '' }}>2</option>
                                        <option value="1" {{ $review->star == 1 ? 'selected' : '' }}>1</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Comment</label>
                                    <textarea class="form-control" name="comment" rows="4" placeholder="Comment" required>{{ $review->comment }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Images</label>
                                    <div class="card card-body">
                                        <div class="image-preview-container d-flex flex-wrap gap-2 mb-2" id="image-preview-container">
                                            @if($review->images && is_array($review->images))
                                                @foreach($review->images as $image)
                                                    <div class="position-relative d-inline-block">
                                                        <img src="{{ asset('uploads/reviews/' . $image) }}" width="80" height="80" class="rounded border" style="object-fit: cover;">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div>
                                            <a href="#" class="text-decoration-none" onclick="document.getElementById('images-input').click(); return false;">Add Images</a>
                                            <input type="file" id="images-input" name="images[]" multiple accept="image/*" style="display: none;" onchange="previewImages(this)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <button type="submit" name="submitter" value="save" class="btn btn-primary w-100 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                        <path d="M14 4l0 4l-6 0l0 -4"></path>
                                    </svg>
                                    Save
                                </button>
                                <button type="submit" name="submitter" value="save-exit" class="btn btn-outline-secondary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 12l14 0"></path>
                                        <path d="M5 12l6 6"></path>
                                        <path d="M5 12l6 -6"></path>
                                    </svg>
                                    Save & Exit
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Created At</h3>
                            </div>
                            <div class="card-body">
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
                                    </span>
                                    <input class="form-control form-date-time" name="created_at" type="text" value="{{ $review->created_at->format('Y-m-d H:i:s') }}" data-date-format="YYYY-MM-DD HH:mm:ss">
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Status</h3>
                            </div>
                            <div class="card-body">
                                <select class="form-select" name="status" required>
                                    <option value="published" {{ $review->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="pending" {{ $review->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
@push('scripts')
<script>
    function previewImages(input) {
        var previewContainer = document.getElementById('image-preview-container');
        // Keep existing images, append new ones or just clear?
        // For simplicity, let's just append new ones visually

        if (input.files) {
            Array.from(input.files).forEach(file => {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imgDiv = document.createElement('div');
                    imgDiv.style.position = 'relative';
                    imgDiv.style.display = 'inline-block';

                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 80;
                    img.height = 80;
                    img.className = 'rounded border';
                    img.style.objectFit = 'cover';

                    imgDiv.appendChild(img);
                    previewContainer.appendChild(imgDiv);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    $(document).ready(function() {
        // Reuse similar search logic

        // Product Search
        $('#product-search').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("admin.orders.search-product") }}',
                    data: { q: query },
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(product => {
                                html += `<a href="#" class="list-group-item list-group-item-action product-item"
                                            data-id="${product.id}"
                                            data-name="${product.name}">
                                            <div class="d-flex align-items-center">
                                                <span class="avatar me-2" style="background-image: url(${product.image_url})"></span>
                                                <div class="text-truncate">${product.name}</div>
                                            </div>
                                        </a>`;
                            });
                            $('#product-results').html(html).show();
                        } else {
                            $('#product-results').hide();
                        }
                    }
                });
            } else {
                $('#product-results').hide();
            }
        });

        $(document).on('click', '.product-item', function(e) {
            e.preventDefault();
            $('#product-id').val($(this).data('id'));
            $('#selected-product').text('Selected: ' + $(this).data('name'));
            $('#product-results').hide();
            $('#product-search').val('');
        });

        // Customer Search
        $('#customer-search').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: '{{ route("admin.orders.search-customer") }}',
                    data: { q: query },
                    success: function(data) {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(customer => {
                                html += `<a href="#" class="list-group-item list-group-item-action customer-item"
                                            data-id="${customer.id}"
                                            data-name="${customer.name}">
                                            <div>${customer.name} (${customer.email})</div>
                                        </a>`;
                            });
                            $('#customer-results').html(html).show();
                        } else {
                            $('#customer-results').hide();
                        }
                    }
                });
            } else {
                $('#customer-results').hide();
            }
        });

        $(document).on('click', '.customer-item', function(e) {
            e.preventDefault();
            $('#customer-id').val($(this).data('id'));
            $('#selected-customer').text('Selected: ' + $(this).data('name'));
            $('#customer-results').hide();
            $('#customer-search').val('');
        });

        // Click outside to close
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#product-search, #product-results').length) {
                $('#product-results').hide();
            }
            if (!$(e.target).closest('#customer-search, #customer-results').length) {
                $('#customer-results').hide();
            }
        });
    });
</script>
@endpush

