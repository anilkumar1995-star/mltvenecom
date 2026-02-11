@extends('admin-layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a><i class="fa fa-circle"></i></li>
                <li><a href="{{ route('admin.products.index') }}">Products</a><i class="fa fa-circle"></i></li>
                <li><span>Edit Product</span></li>
            </ul>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <form id="product-form" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">General Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Product Name" value="{{ $product->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Content</label>
                                        <textarea name="content" class="form-control editor" rows="10">{{ $product->content }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">Inventory & Pricing</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">SKU</label>
                                            <input type="text" name="sku" class="form-control" placeholder="SKU" value="{{ $product->sku }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Barcode</label>
                                            <input type="text" name="barcode" class="form-control" placeholder="Barcode" value="{{ $product->barcode }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" value="{{ $product->price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" name="sale_price" class="form-control" placeholder="0.00" value="{{ $product->sale_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label fw-bold">Cost Per Item</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" step="0.01" name="cost_per_item" class="form-control" placeholder="0.00" value="{{ $product->cost_per_item }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-check form-switch mt-4">
                                                <input class="form-check-input" type="checkbox" name="price_includes_tax" value="1" {{ $product->price_includes_tax ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold">Price Includes Tax</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">Shipping & Dimensions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label fw-bold">Weight (g)</label>
                                            <input type="number" step="0.01" name="weight" class="form-control" placeholder="0.00" value="{{ $product->weight }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label fw-bold">Length (cm)</label>
                                            <input type="number" step="0.01" name="length" class="form-control" placeholder="0.00" value="{{ $product->length }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label fw-bold">Wide (cm)</label>
                                            <input type="number" step="0.01" name="wide" class="form-control" placeholder="0.00" value="{{ $product->wide }}">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label fw-bold">Height (cm)</label>
                                            <input type="number" step="0.01" name="height" class="form-control" placeholder="0.00" value="{{ $product->height }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">Order Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Minimum order quantity</label>
                                            <input type="number" name="minimum_order_quantity" class="form-control" value="{{ $product->minimum_order_quantity }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Maximum order quantity</label>
                                            <input type="number" name="maximum_order_quantity" class="form-control" value="{{ $product->maximum_order_quantity }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">Status & Publishing</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Stock Status</label>
                                        <select name="stock_status" class="form-select">
                                            <option value="in_stock" {{ $product->stock_status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="out_of_stock" {{ $product->stock_status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                            <option value="on_backorder" {{ $product->stock_status == 'on_backorder' ? 'selected' : '' }}>On Backorder</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Product Type</label>
                                        <select name="product_type" class="form-select">
                                            <option value="physical" {{ $product->product_type == 'physical' ? 'selected' : '' }}>Physical</option>
                                            <option value="digital" {{ $product->product_type == 'digital' ? 'selected' : '' }}>Digital</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Is Featured?</label>
                                        <select name="is_featured" class="form-select">
                                            <option value="0" {{ $product->is_featured == 0 ? 'selected' : '' }}>No</option>
                                            <option value="1" {{ $product->is_featured == 1 ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">New Until</label>
                                        <input type="date" name="is_new_until" class="form-control" value="{{ $product->is_new_until }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Order</label>
                                        <input type="number" name="order" class="form-control" value="{{ $product->order }}">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="with_storehouse_management" value="1" {{ $product->with_storehouse_management ? 'checked' : '' }}>
                                            <label class="form-check-label small">With storehouse management</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="allow_checkout_when_out_of_stock" value="1" {{ $product->allow_checkout_when_out_of_stock ? 'checked' : '' }}>
                                            <label class="form-check-label small">Allow checkout when out of stock</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fa fa-save"></i> Update Product
                                    </button>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-white py-3">
                                    <h5 class="card-title mb-0">Product Image</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="preview-container mb-3 border d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        @if($product->image)
                                            <img id="image-preview" src="{{ asset('storage/' . $product->image) }}" class="img-fluid" style="max-height: 100%;">
                                            <i id="preview-icon" class="fa fa-image fa-3x text-muted d-none"></i>
                                        @else
                                            <img id="image-preview" src="" class="img-fluid d-none" style="max-height: 100%;">
                                            <i id="preview-icon" class="fa fa-image fa-3x text-muted"></i>
                                        @endif
                                    </div>
                                    <input type="file" name="image_file" id="image-input" class="form-control" accept="image/*">
                                    <div class="small text-muted mt-2">Allowed JPG, PNG. Max size 2MB</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Image Preview
    $('#image-input').on('change', function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#image-preview').attr('src', event.target.result).removeClass('d-none');
                $('#preview-icon').addClass('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    // AJAX Submission
    $('#product-form').on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST', // Laravel uses POST with _method PUT
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 2000
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                }
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false).html('<i class="fa fa-save"></i> Update Product');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';
                    $.each(errors, function(key, value) {
                        errorMsg += value[0] + '<br>';
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMsg
                    });
                } else {
                    Swal.fire('Error', 'Something went wrong!', 'error');
                }
            }
        });
    });
});
</script>
@endpush