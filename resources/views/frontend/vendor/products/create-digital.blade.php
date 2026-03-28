@extends('vendor-layouts.app')
@section('title', 'Create Digital Product')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="{{ route('frontend.vendor.products.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New digital product</h1>
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
                <form method="POST" action="{{ route('frontend.vendor.products.store') }}" accept-charset="UTF-8"
                    id="product-digital-form" class="js-base-form dirty-check" enctype="multipart/form-data">
                    @csrf
                    <input name="product_type" type="hidden" value="digital">

                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">Product Name</label>
                                        <input class="form-control" name="name" type="text" placeholder="Digital product name" required>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control editor-ckeditor" rows="4" name="description" placeholder="A brief overview of the digital product"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Main Images (Gallery)</label>
                                        <div class="card p-4 border-dashed text-center" style="border: 2px dashed #cbd5e1; background: #f8fafc; cursor: pointer;" onclick="document.getElementById('product_images').click()">
                                            <i class="fa fa-images fa-3x text-secondary mb-2"></i>
                                            <p class="mb-0 fw-medium">Click to upload product covers/screenshots</p>
                                            <input type="file" id="product_images" class="d-none" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                                        </div>
                                        <div id="image_preview" class="row g-2 mt-3"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Digital Files Section -->
                            <div class="card mb-3 border-primary" style="background: #f0f7ff;">
                                <div class="card-header bg-primary text-white">
                                    <h4 class="card-title text-white">Digital Assets</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">The Downloadable Files</label>
                                        <div class="card p-5 border-dashed text-center" style="border: 2px dashed #3b82f6; background: #fff; cursor: pointer;" onclick="document.getElementById('digital_files').click()">
                                            <i class="fa fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                            <h3 class="mb-1">Upload Digital Content</h3>
                                            <p class="text-secondary small">Customers will get access to these files after purchase (ZIP, PDF, Software, etc.)</p>
                                            <input type="file" id="digital_files" class="d-none" name="digital_files[]" multiple required>
                                        </div>
                                        <div id="file_list" class="mt-3"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="generate_license_code" value="1">
                                            <span class="form-check-label">Generate license code for this product?</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Pricing & Inventory</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label required">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input class="form-control" type="number" step="0.01" name="price" value="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input class="form-control" type="number" step="0.01" name="sale_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">SKU (Unique ID)</label>
                                            <input class="form-control" type="text" name="sku" placeholder="E.g. SOFT-001" value="{{ $sku }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-primary fw-bold">Minimum Order Quantity</label>
                                            <input class="form-control border-primary" type="number" name="minimum_order_quantity" value="1" min="1" />
                                            <small class="text-muted small">Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-info fw-bold">Maximum Order Quantity</label>
                                            <input class="form-control border-info" type="number" name="maximum_order_quantity" value="0" min="0" />
                                            <small class="text-muted small">Maximum quantity to place an order, if the value is 0, there is no limit.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3 sticky-top" style="top: 1rem;">
                                <div class="card-body">
                                    <button class="btn btn-success w-100 mb-2 py-2" type="submit">
                                        <i class="fa fa-check-circle me-2"></i> Publish Digital Product
                                    </button>
                                    <a href="{{ route('frontend.vendor.products.create') }}" class="btn btn-outline-secondary w-100">
                                        Change Type
                                    </a>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                </div>
                                <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                                    @foreach ($categories->where('parent_id', 0) as $parent)
                                        <label class="form-check mb-2">
                                            <input type="checkbox" name="categories[]" class="form-check-input" value="{{ $parent->id }}">
                                            <span class="form-check-label">{{ $parent->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Image</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="preview-image-wrapper mb-2">
                                        <img id="main-preview" src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" class="img-fluid rounded border" style="height: 150px; width: 100%; object-fit: cover;">
                                    </div>
                                    <input type="file" name="image_file" class="form-control" accept="image/*" onchange="document.getElementById('main-preview').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
<script>
    function previewImages(input) {
        const container = document.getElementById('image_preview');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    container.innerHTML += `<div class="col-3"><img src="${e.target.result}" class="img-fluid rounded border shadow-sm" style="height: 70px; width: 100%; object-fit: cover;"></div>`;
                };
                reader.readAsDataURL(file);
            });
        }
    }

    document.getElementById('digital_files').onchange = function() {
        const list = document.getElementById('file_list');
        list.innerHTML = '';
        Array.from(this.files).forEach(file => {
            list.innerHTML += `<div class="p-2 mb-1 border rounded bg-white shadow-sm d-flex align-items-center">
                <i class="fa fa-file-archive text-warning me-2"></i>
                <span class="small fw-medium">${file.name}</span>
                <span class="ms-auto badge bg-secondary-lt">${(file.size/1024/1024).toFixed(2)} MB</span>
            </div>`;
        });
    }

    $(document).ready(function() {
        $('#product-digital-form').validate({
            errorClass: "text-danger smaller",
            submitHandler: function(form) {
                var formData = new FormData(form);
                if (typeof CKEDITOR !== 'undefined') {
                    for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement();
                }
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Digital Product Ready!', res.message, 'success').then(() => {
                                window.location.href = "{{ route('frontend.vendor.products.index') }}";
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
