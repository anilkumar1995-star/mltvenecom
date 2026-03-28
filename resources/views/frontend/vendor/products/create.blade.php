@extends('vendor-layouts.app')
@section('title', 'Create Product')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New product</h1>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('frontend.vendor.products.index') }}" class="btn btn-outline-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l14 0"></path><path d="M5 12l6 6"></path><path d="M5 12l6 -6"></path></svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form method="POST" action="{{ route('frontend.vendor.products.store') }}" accept-charset="UTF-8"
                    id="botble-ecommerce-forms-product-form" class="js-base-form dirty-check" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label form-label required" for="name">
                                                Name
                                            </label>
                                            <input class="form-control" data-counter="250" placeholder="Name"
                                                required="required" name="name" type="text" id="name">
                                        </div>
                                        
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn show-hide-editor-btn" type="button"
                                                    data-result="description">
                                                    Show/Hide Editor
                                                </button>
                                            </div>
                                            <textarea class="form-control editor-ckeditor" data-counter="100000" rows="4"
                                                placeholder="Short description" id="description" name="description" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="content">
                                                Content
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn show-hide-editor-btn" type="button"
                                                    data-result="content">
                                                    Show/Hide Editor
                                                </button>
                                            </div>
                                            <textarea class="form-control editor-ckeditor" data-counter="100000" rows="4"
                                                placeholder="Write your content" id="content" name="content" cols="50"></textarea>
                                        </div>

                                        <!-- Images Upload Section -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Images</label>
                                            <div class="card p-3 border-dashed" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                                                <div class="text-center cursor-pointer" onclick="document.getElementById('product_images_input').click();">
                                                    <div class="mb-2">
                                                        <svg class="icon icon-lg text-secondary" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" /><path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /></svg>
                                                    </div>
                                                    <p class="mb-0 text-muted fw-medium">Click to upload images</p>
                                                    <p class="small text-muted">You can select multiple files</p>
                                                </div>
                                                <input type="file" id="product_images_input" class="d-none" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                                                <div id="image_preview_container" class="row g-2 mt-3"></div>
                                            </div>
                                        </div>

                                        <!-- Video Upload Section -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Video</label>
                                            <div class="card p-3 border-dashed" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                                                 <div class="text-center cursor-pointer" onclick="document.getElementById('product_video_input').click();">
                                                    <div class="mb-2">
                                                        <svg class="icon icon-lg text-secondary" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" /><path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /></svg>
                                                    </div>
                                                    <p class="mb-0 text-muted fw-medium">Click to upload video</p>
                                                </div>
                                                <input type="file" id="product_video_input" class="d-none" name="video_file" accept="video/*" onchange="previewVideo(this)">
                                                <div id="video_preview_container" class="mt-3"></div>
                                            </div>
                                        </div>

                                        <input class="form-control" name="product_type" type="hidden" value="physical">
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 product-specification-table">
                                <div class="card-header">
                                    <h4 class="card-title">Specification Tables</h4>
                                    <div class="card-actions">
                                        <select class="form-select" name="specification_table_id" id="specification_table_id">
                                            <option value="">None</option>
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}">{{ $table->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="p-3 text-secondary mb-0 instruction-text">
                                    Select the specification table to display in this product
                                </div>
                                <div class="specification-table"></div>
                            </div>

                            <div id="main-manage-product-type">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Overview</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row price-group">
                                            <input class="detect-schedule d-none" name="sale_type" type="hidden" value="0">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sku">SKU (Unique ID)</label>
                                                    <input class="form-control" type="text" name="sku" id="sku" placeholder="E.g. SOFT-001" value="{{ $sku }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="price">Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text currency-symbol">₹</span>
                                                        <input class="form-control input-mask-number" type="text" name="price" id="price"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sale_price">
                                                        Price sale
                                                        <span class="form-label-description ms-auto">
                                                            <a class="turn-on-schedule" href="javascript:void(0)">Choose Discount Period</a>
                                                            <a class="turn-off-schedule" style="display: none;" href="javascript:void(0)">Cancel</a>
                                                        </span>
                                                    </label>
                                                    <div class="input-group font-weight-bold">
                                                        <span class="input-group-text currency-symbol">₹</span>
                                                        <input class="form-control input-mask-number" type="text" name="sale_price" id="sale_price" />
                                                    </div>
                                                    <small class="form-hint">Discount <strong>0%</strong> from original price.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="start_date">From date</label>
                                                    <input class="form-control form-date-time" type="text" name="start_date" id="start_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="end_date">To date</label>
                                                    <input class="form-control form-date-time" type="text" name="end_date" id="end_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-check">
                                                        <input type="checkbox" name="price_includes_tax" class="form-check-input" value="1">
                                                        <span class="form-check-label">Price includes tax</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                                    <input class="form-control" type="text" name="barcode" id="barcode" placeholder="Enter barcode" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input class="form-control font-weight-bold" type="number" name="quantity" id="quantity" value="0" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" name="with_storehouse_management" class="form-check-input storehouse-management-status" value="1">
                                                <span class="form-check-label">With storehouse management</span>
                                            </label>
                                        </div>

                                        <fieldset class="form-fieldset storehouse-info" style="display: none;">
                                            <div class="mb-3">
                                                <label class="form-check">
                                                    <input type="checkbox" name="allow_checkout_when_out_of_stock" class="form-check-input" value="1">
                                                    <span class="form-check-label">Allow customer checkout when this product out of stock</span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-fieldset stock-status-wrapper">
                                            <label class="form-label">Stock status</label>
                                            <div class="d-flex gap-3">
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="in_stock" checked>
                                                    <span class="form-check-label">In stock</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="out_of_stock">
                                                    <span class="form-check-label">Out of stock</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="on_backorder">
                                                    <span class="form-check-label">On backorder</span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-fieldset mt-3 shadow-none border">
                                            <legend class="px-2 fw-bold">Shipping</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Weight (g)</label>
                                                    <input class="form-control" type="number" name="weight" value="0" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Length (cm)</label>
                                                    <input class="form-control" type="number" name="length" value="0" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Wide (cm)</label>
                                                    <input class="form-control" type="number" name="wide" value="0" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Height (cm)</label>
                                                    <input class="form-control" type="number" name="height" value="0" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title">Attributes</h4>
                                        <button type="button" class="btn btn-outline-primary btn-open-attributes">Add new attributes</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="product-select-attribute-item-template d-none">
                                            <div class="row align-items-center mb-3 attribute-row">
                                                <div class="col-md-5">
                                                    <label>Attribute name</label>
                                                    <select class="form-control attr-name" name="attributes[__INDEX__][attribute_set_id]">
                                                        <option value="">Select attribute</option>
                                                        @foreach ($attributeSets as $set)
                                                            <option value="{{ $set->id }}">{{ $set->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Value</label>
                                                    <select class="form-control attr-value" name="attributes[__INDEX__][attribute_id]">
                                                        <option value="">Select value</option>
                                                        @foreach ($attributes as $attr)
                                                            <option value="{{ $attr->id }}" data-set="{{ $attr->attribute_set_id }}">{{ $attr->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 text-end pt-4">
                                                    <button type="button" class="btn btn-danger btn-remove-attr mt-1">🗑</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-product-attribute-values-wrap d-none">
                                            <div class="list-product-attribute-items-wrap"></div>
                                            <button type="button" class="btn btn-light border btn-trigger-add-attribute-item mt-3">Add more attribute</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Product options</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="product-option-form-wrap">
                                            <input name="has_product_options" type="hidden" value="1">
                                            <div class="accordion mb-3" id="accordion-product-option"></div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <button class="btn btn-outline-primary add-new-option" type="button" id="add-new-option">Add new option</button>
                                                <div class="ms-md-auto d-flex gap-2">
                                                    <select class="form-select" id="global-option" style="width: 200px;">
                                                        <option value="0">Select Global Option</option>
                                                        @foreach($globalOptions as $globalOption)
                                                            <option value="{{ $globalOption->id }}">{{ $globalOption->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-primary add-from-global-option" type="button">Add Global Option</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Related Products</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <input type="text" class="form-control box-search-input" placeholder="Search products..." data-target="related-products">
                                            <div class="box-search-results list-group position-absolute w-100 mt-1 shadow" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto;"></div>
                                        </div>
                                        <div id="selected-related-products" class="list-group"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Publish</h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <button class="btn btn-primary w-100" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path></svg>
                                            Save Product
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Status</h4>
                                    <span class="badge bg-warning-lt">Pending</span>
                                </div>
                                <div class="card-body py-2">
                                    <input type="hidden" name="status" value="pending">
                                    <p class="small text-muted mb-0">Products added by vendors require admin approval.</p>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Categories</h4>
                                </div>
                                <div class="card-body pt-2" style="max-height: 300px; overflow-y: auto;">
                                    <div id="categories-tree">
                                        <ul class="list-unstyled">
                                            @foreach ($categories->where('parent_id', 0) as $parent)
                                                <li class="mb-1">
                                                    <label class="form-check">
                                                        <input type="checkbox" name="categories[]" class="form-check-input parent-category" value="{{ $parent->id }}">
                                                        <span class="form-check-label">{{ $parent->name }}</span>
                                                    </label>
                                                    @php
                                                        $subcats = $categories->where('parent_id', $parent->id);
                                                    @endphp
                                                    @if ($subcats->count())
                                                        <ul class="list-unstyled ms-3 mt-1">
                                                            @foreach ($subcats as $sub)
                                                                <li class="mb-1">
                                                                    <label class="form-check">
                                                                        <input type="checkbox" name="categories[]" class="form-check-input child-category" value="{{ $sub->id }}" data-parent="{{ $parent->id }}">
                                                                        <span class="form-check-label small">{{ $sub->name }}</span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Brand</h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="brand_id">
                                        <option value="">Select a brand...</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Featured Image</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="preview-image-wrapper mb-2">
                                        <img id="preview-image" src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" alt="Preview" style="width: 100%; height: 160px; object-fit: cover; border-radius: 4px; border: 1px solid #e1e1e1;">
                                    </div>
                                    <input type="file" name="image_file" class="form-control" accept="image/*" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Tags</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" name="tag" id="tag" data-url="{{ route('frontend.vendor.product-tags.all') }}" placeholder="Write some tags">
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Minimum Order Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" type="number" name="minimum_order_quantity" value="1" min="1">
                                    <small class="text-muted mt-1 d-block font-size-xs">Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Maximum Order Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" type="number" name="maximum_order_quantity" value="0" min="0">
                                    <small class="text-muted mt-1 d-block font-size-xs">Maximum quantity to place an order, if the value is 0, there is no limit.</small>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Product collections</h4>
                                </div>
                                <div class="card-body">
                                    <div style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($collections as $collection)
                                            <label class="form-check mb-1">
                                                <input type="checkbox" name="product_collections[]" class="form-check-input" value="{{ $collection->id }}">
                                                <span class="form-check-label small">{{ $collection->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Labels</h4>
                                </div>
                                <div class="card-body">
                                    <div style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($productionlabels as $label)
                                            <label class="form-check mb-1">
                                                <input type="checkbox" name="product_labels[]" class="form-check-input" value="{{ $label->id }}">
                                                <span class="form-check-label small">{{ $label->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
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
        const container = document.getElementById('image_preview_container');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const col = document.createElement('div');
                    col.className = 'col-3';
                    col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded border" style="height: 80px; width: 100%; object-fit: cover;">`;
                    container.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function previewVideo(input) {
        const container = document.getElementById('video_preview_container');
        container.innerHTML = '';
        if (input.files && input.files[0]) {
            const url = URL.createObjectURL(input.files[0]);
            container.innerHTML = `<video src="${url}" controls class="w-100 rounded border" style="max-height: 200px;"></video>`;
        }
    }

    $(document).ready(function() {
        // Tagify
        var tagInput = document.querySelector('#tag');
        if (tagInput) {
            var tagify = new Tagify(tagInput, {
                whitelist: [],
                dropdown: { enabled: 0 }
            });
            fetch(tagInput.getAttribute('data-url'))
                .then(res => res.json())
                .then(whitelist => tagify.settings.whitelist = whitelist.map(t => t.name));
        }

        // Parent/Child Categories logic
        $('.parent-category').on('change', function() {
            var isChecked = $(this).prop('checked');
            $(this).closest('li').find('.child-category').prop('checked', isChecked);
        });
        $('.child-category').on('change', function() {
            if ($(this).prop('checked')) {
                $(this).closest('ul').prev('label').find('.parent-category').prop('checked', true);
            }
        });

        // AJAX Submission
        $('#botble-ecommerce-forms-product-form').validate({
            rules: { name: { required: true } },
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
                            Swal.fire('Success', res.message, 'success').then(() => {
                                window.location.href = "{{ route('frontend.vendor.products.index') }}";
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        let msg = 'Server error';
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            msg = Object.values(xhr.responseJSON.errors).map(e => e[0]).join('<br>');
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire('Error', msg, 'error');
                    }
                });
            }
        });

        // Specification Tables
        $('#specification_table_id').on('change', function() {
            let id = $(this).val();
            let $container = $('.specification-table');
            if (!id) { $container.empty(); $('.instruction-text').show(); return; }
            $.post("{{ route('frontend.vendor.getatablesData') }}", { group_id: id, _token: "{{ csrf_token() }}" }, function(res) {
                if (res.data && res.data.length > 0) {
                    let rows = "";
                    res.data.forEach(group => {
                        group.attributes.forEach(attr => {
                            let input = attr.type === 'select' ? `<select class="form-select small" name="specs[${group.id}][${attr.id}][value]">` + JSON.parse(attr.options).map(o => `<option value="${o}">${o}</option>`).join('') + `</select>` : `<input type="text" class="form-control" name="specs[${group.id}][${attr.id}][value]">`;
                            rows += `<tr><td class="small fw-bold">${group.name}</td><td>${attr.name}</td><td>${input}</td><td class="text-center"><input type="checkbox" name="specs[${group.id}][${attr.id}][hide]" value="1"></td></tr>`;
                        });
                    });
                    $container.html(`<table class="table table-sm table-bordered mt-2"><thead><tr><th>Group</th><th>Attribute</th><th>Value</th><th>Hide</th></tr></thead><tbody>${rows}</tbody></table>`);
                    $('.instruction-text').hide();
                }
            });
        });

        // Relations Search
        $('.box-search-input').on('keyup', function() {
            let $input = $(this);
            let target = $input.data('target');
            let $results = $input.next('.box-search-results');
            let query = $input.val();
            if (query.length < 2) { $results.hide(); return; }
            $.get("{{ route('frontend.vendor.products.get-relations') }}", { search: query }, function(res) {
                let html = res.data.map(p => `<a href="#" class="list-group-item list-group-item-action select-relation" data-id="${p.id}" data-name="${p.name}" data-image="${p.image}">${p.name}</a>`).join('');
                $results.html(html || '<div class="list-group-item">No results</div>').show();
            });
        });

        $(document).on('click', '.select-relation', function(e) {
            e.preventDefault();
            let p = $(this).data();
            let $list = $(this).closest('.card-body').find('.list-group').last();
            if ($list.find(`input[value="${p.id}"]`).length) return;
            $list.append(`<div class="list-group-item d-flex justify-content-between align-items-center"><span>${p.name}</span><input type="hidden" name="related_products[]" value="${p.id}"><button type="button" class="btn btn-sm text-danger remove-relation">&times;</button></div>`);
            $(this).parent().hide();
        });

        $(document).on('click', '.remove-relation', function() { $(this).parent().remove(); });

        // Storehouse Management Toggle
        $(document).on('change', '.storehouse-management-status', function() {
            if ($(this).prop('checked')) {
                $('.storehouse-info').show();
                $('.stock-status-wrapper').hide();
            } else {
                $('.storehouse-info').hide();
                $('.stock-status-wrapper').show();
            }
        });

        // Price Schedule Toggle
        $(document).on('click', '.turn-on-schedule', function() {
            $(this).hide();
            $('.turn-off-schedule').show();
            $('.scheduled-time').show();
            $('.detect-schedule').val('1');
        });

        $(document).on('click', '.turn-off-schedule', function() {
            $(this).hide();
            $('.turn-on-schedule').show();
            $('.scheduled-time').hide();
            $('.detect-schedule').val('0');
        });
    });
</script>
@endpush
