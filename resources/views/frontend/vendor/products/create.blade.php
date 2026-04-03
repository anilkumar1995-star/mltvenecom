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
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form method="POST" action="{{ route('frontend.vendor.products.store') }}" accept-charset="UTF-8"
                    id="botble-ecommerce-forms-product-form" class="js-base-form dirty-check" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-9 gap-3 d-flex flex-column">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label form-label required fw-bold" for="name">Product Name</label>
                                            <input class="form-control shadow-none" data-counter="250" placeholder="Enter product name"
                                                required="required" name="name" type="text" id="name">
                                        </div>
                                        
                                        <div class="mb-3 position-relative">
                                            <label class="form-label fw-bold" for="description">Short Description</label>
                                            <textarea class="form-control editor-ckeditor" data-counter="1000" rows="3"
                                                placeholder="Provide a brief summary" id="description" name="description" cols="50"></textarea>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label fw-bold" for="content">Full Content / Details</label>
                                            <textarea class="form-control editor-ckeditor" data-counter="100000" rows="6"
                                                placeholder="Describe the product in detail" id="content" name="content" cols="50"></textarea>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label fw-bold">Product Gallery</label>
                                            <div class="card p-4 border-dashed bg-light text-center cursor-pointer" onclick="document.getElementById('product_images_input').click();" style="border: 2px dashed #cbd5e1;">
                                                <div class="mb-2">
                                                    <svg class="icon icon-lg text-primary bg-primary-lt p-2 rounded-circle" style="width:50px; height:50px;" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" /><path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /></svg>
                                                </div>
                                                <h5 class="mb-1 fw-bold">Upload Images</h5>
                                                <p class="text-secondary small mb-0">Drop files here or click to browse. Multiple selection allowed.</p>
                                                <input type="file" id="product_images_input" class="d-none" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                                            </div>
                                            <div id="image_preview_container" class="row g-2 mt-2"></div>
                                        </div>

                                        <div class="mb-0 position-relative">
                                            <label class="form-label fw-bold">Product Video</label>
                                            <div class="card p-3 border-dashed bg-light text-center cursor-pointer" onclick="document.getElementById('product_video_input').click();" style="border: 2px dashed #cbd5e1;">
                                                 <div class="mb-1 text-center">
                                                    <i class="fas fa-video text-secondary fs-2 p-2 rounded bg-white shadow-sm"></i>
                                                </div>
                                                <p class="mb-1 small fw-bold">Add Video Link or Upload MP4</p>
                                                <input type="file" id="product_video_input" class="d-none" name="video_file" accept="video/*" onchange="previewVideo(this)">
                                            </div>
                                            <div id="video_preview_container" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="card-title mb-0">Pricing & Inventory</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 price-group">
                                        <input class="detect-schedule d-none" name="sale_type" type="hidden" value="0">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">SKU</label>
                                            <input class="form-control shadow-none" type="text" name="sku" value="{{ $sku }}" placeholder="Unique identifier">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Regular Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text currency-symbol">₹</span>
                                                <input class="form-control shadow-none" type="number" name="price" id="price" step="0.01">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold d-flex align-items-center">
                                                Sale Price
                                                <div class="ms-auto small">
                                                    <a class="turn-on-schedule text-decoration-none" href="javascript:void(0)"><i class="far fa-calendar-alt me-1"></i>Schedule Sale</a>
                                                    <a class="turn-off-schedule text-danger text-decoration-none" style="display: none;" href="javascript:void(0)" onclick="cancelSchedule()">Cancel Schedule</a>
                                                </div>
                                            </label>
                                            <div class="input-group border-info-subtle">
                                                <span class="input-group-text currency-symbol bg-info-lt text-info border-info-subtle">₹</span>
                                                <input class="form-control border-info-subtle shadow-none" type="number" name="sale_price" id="sale_price" step="0.01">
                                            </div>
                                            <div class="form-hint small text-muted mt-1">Discount Calculation: <strong class="text-success">0%</strong></div>
                                        </div>

                                        <div class="col-md-6 scheduled-time" style="display: none;">
                                            <label class="form-label fw-bold">Sale From Date</label>
                                            <input class="form-control shadow-none" type="date" name="start_date">
                                        </div>
                                        <div class="col-md-6 scheduled-time" style="display: none;">
                                            <label class="form-label fw-bold">Sale To Date</label>
                                            <input class="form-control shadow-none" type="date" name="end_date">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-check p-2 rounded bg-light border cursor-pointer">
                                                <input type="checkbox" name="price_includes_tax" class="form-check-input ms-0" value="1">
                                                <span class="form-check-label ms-1">Price includes tax <i class="fas fa-question-circle text-muted ms-1" title="Check this if the entered price already includes taxes."></i></span>
                                            </label>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                            <input class="form-control shadow-none" type="text" name="barcode" placeholder="Optional barcode for inventory">
                                        </div>
                                    </div>

                                    <div class="mt-4 border-top pt-3">
                                        <label class="form-check form-switch mb-3 cursor-pointer">
                                            <input type="checkbox" name="with_storehouse_management" class="form-check-input storehouse-management-status" value="1">
                                            <span class="form-check-label fw-bold">Track Stock Quantity</span>
                                        </label>

                                        <div class="storehouse-info bg-light p-3 rounded" style="display: none;">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-bold">Initial Stock Level</label>
                                                    <input class="form-control shadow-none" type="number" name="quantity" value="0">
                                                </div>
                                                <div class="col-md-6 d-flex align-items-end">
                                                    <label class="form-check mb-0 cursor-pointer">
                                                        <input type="checkbox" name="allow_checkout_when_out_of_stock" class="form-check-input" value="1">
                                                        <span class="form-check-label small">Oversell Allowed (Backorders)</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="stock-status-wrapper mt-2">
                                            <div class="d-flex gap-4">
                                                <label class="form-check cursor-pointer">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="in_stock" checked>
                                                    <span class="form-check-label">In Stock</span>
                                                </label>
                                                <label class="form-check cursor-pointer">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="out_of_stock">
                                                    <span class="form-check-label">Out of Stock</span>
                                                </label>
                                                <label class="form-check cursor-pointer">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="on_backorder">
                                                    <span class="form-check-label">On Backorder</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <fieldset class="mt-4 bg-light p-3 rounded border shadow-none">
                                        <legend class="px-2 fw-bold h6 text-primary" style="float: none; width: auto;"><i class="fas fa-truck me-2"></i>Shipping Dimensions</legend>
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Length (cm)</label>
                                                <input class="form-control form-control-sm shadow-none" type="number" name="length" value="0">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Width (cm)</label>
                                                <input class="form-control form-control-sm shadow-none" type="wide" name="wide" value="0">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label small mb-1">Height (cm)</label>
                                                <input class="form-control form-control-sm shadow-none" type="number" name="height" value="0">
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0 product-specification-table">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                                    <h4 class="card-title mb-0">Technical Specification</h4>
                                    <select class="form-select w-auto form-select-sm shadow-none" name="specification_table_id" id="specification_table_id">
                                        <option value="">None</option>
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}">{{ $table->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-body">
                                    <p class="text-secondary small instruction-text mb-0">Map this product to a specification group for detailed data display.</p>
                                    <div class="specification-table mt-2"></div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
                                    <h4 class="card-title mb-0">Attributes & Variations</h4>
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-open-attributes shadow-none">Define Attributes</button>
                                </div>
                                <div class="card-body">
                                    <div class="list-product-attribute-values-wrap d-none">
                                        <div class="list-product-attribute-items-wrap"></div>
                                        <button type="button" class="btn btn-sm btn-light border btn-trigger-add-attribute-item mt-3 shadow-none"><i class="fas fa-plus me-1"></i>Add Attribute Group</button>
                                    </div>
                                    <p class="text-muted small empty-attributes-text mb-0">Add size, color, or other product variations.</p>
                                    <div class="product-select-attribute-item-template d-none">
                                        <div class="row g-2 align-items-end mb-3 attribute-row border p-3 rounded bg-light-subtle shadow-none">
                                            <div class="col-md-5">
                                                <label class="form-label small fw-bold">Attribute Type</label>
                                                <select class="form-select form-select-sm shadow-none attr-set-select" name="attributes[__INDEX__][attribute_set_id]">
                                                    <option value="">Choose set...</option>
                                                    @foreach ($attributeSets as $set)
                                                        <option value="{{ $set->id }}">{{ $set->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label small fw-bold">Value Selection</label>
                                                <select class="form-select form-select-sm shadow-none attr-val-select" name="attributes[__INDEX__][attribute_id]" disabled>
                                                    <option value="">Choose type first...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <button type="button" class="btn btn-sm btn-danger btn-remove-attr py-1 px-3 shadow-none">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="card-title mb-0">Custom Product Options</h4>
                                </div>
                                <div class="card-body">
                                    <div class="product-option-form-wrap">
                                        <input name="has_product_options" type="hidden" value="1">
                                        <div class="accordion mb-3 overflow-hidden shadow-none border-0" id="accordion-product-option"></div>
                                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3 pt-3 border-top">
                                            <button class="btn btn-sm btn-outline-primary add-new-option shadow-none" type="button"><i class="fas fa-plus-circle me-1"></i>Add Custom Field</button>
                                            <div class="ms-md-auto d-flex gap-2">
                                                <select class="form-select form-select-sm shadow-none" id="global-option" style="min-width: 180px;">
                                                    <option value="0">Use Global Preset</option>
                                                    @foreach($globalOptions as $globalOption)
                                                        <option value="{{ $globalOption->id }}">{{ $globalOption->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button class="btn btn-sm btn-primary add-from-global-option px-3 shadow-none" type="button">Apply Preset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="card-title mb-0">Linked / Related Products</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-0 position-relative">
                                        <p class="text-muted small mb-2">Search for products to link as related, up-sells, or cross-sells.</p>
                                        <div class="input-icon">
                                            <input type="text" class="form-control form-control-sm box-search-input shadow-none" placeholder="Target product name or SKU..." data-target="related-products">
                                            <span class="input-icon-addon"><i class="fas fa-search small opacity-50"></i></span>
                                        </div>
                                        <div class="box-search-results list-group position-absolute w-100 mt-2 shadow-lg rounded border" style="z-index: 1050; display: none; max-height: 250px; overflow-y: auto; background: white;"></div>
                                    </div>
                                    <div id="selected-related-products" class="list-group list-group-flush border rounded-3 overflow-hidden mt-3 shadow-none" style="display: none;"></div>
                                </div>
                            </div>

                            <div class="card mb-3 shadow-sm border-0">
                                <div class="card-header bg-white py-3">
                                    <h4 class="card-title mb-0">Product Q&A / FAQs</h4>
                                </div>
                                <div class="card-body">
                                    <p class="text-secondary small mb-3">Provide answers to common customer questions for this specific item.</p>
                                    <div class="faq-items-wrapper">
                                        <div id="faq-repeater"></div>
                                        <button type="button" class="btn btn-sm btn-outline-primary add-faq-item w-100 border-dashed py-2 shadow-none"><i class="fas fa-plus me-1"></i>Insert New FAQ Entry</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                            <div class="sticky-top" style="top: 2rem; z-index: 50;">
                                <div class="card shadow-sm border-0 bg-primary bg-opacity-10 mb-3">
                                    <div class="card-header bg-transparent py-2 border-bottom-0">
                                        <h4 class="card-title mb-0 text-primary small fw-bold">PUBLISH CONTROL</h4>
                                    </div>
                                    <div class="card-body pt-0">
                                        <button class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center shadow-sm" type="submit">
                                            <i class="fas fa-save me-2"></i><strong>SAVE LISTING</strong>
                                        </button>
                                        <a href="{{ route('frontend.vendor.products.index') }}" class="btn btn-link link-secondary w-100 mt-1 text-decoration-none small">Exit without saving</a>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 border-start border-warning border-4 mb-3">
                                    <div class="card-header d-flex justify-content-between align-items-center py-2 bg-white shadow-none">
                                        <h4 class="card-title mb-0 small text-muted fw-bold">APPROVAL QUEUE</h4>
                                        <span class="badge bg-warning text-white px-2" style="font-size: 9px;">PENDING</span>
                                    </div>
                                    <div class="card-body py-2">
                                        <input type="hidden" name="status" value="pending">
                                        <p class="small text-muted mb-0" style="font-size: 11px;"><i class="fas fa-clock me-1 opacity-50"></i> Review typically takes 24-48 hours.</p>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-header py-2 bg-white border-bottom shadow-none">
                                        <h4 class="card-title mb-0 small fw-bold text-muted">INVENTORY & UNIT</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="mb-3">
                                            <label class="x-small fw-bold opacity-50 mb-1">UNIT WEIGHT (PHYSICAL):</label>
                                            <input type="number" name="weight" 
                                                class="form-control form-control-sm border-0 bg-light-subtle fw-bold" 
                                                value="0.00" step="0.01" placeholder="e.g. 0.5 for 500g">
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="x-small fw-bold opacity-50 mb-1">STOCK QTY</label>
                                                    <input type="number" name="quantity" class="form-control form-control-sm border-0 bg-light-subtle fw-bold" value="0" step="0.001">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="x-small fw-bold opacity-50 mb-1">UNIT TYPE</label>
                                                    <select name="unit_type" class="form-select form-select-sm border-0 bg-light-subtle fw-bold">
                                                        <option value="pcs" selected>Pcs</option>
                                                        <option value="kg">Kg</option>
                                                        <option value="g">Gram</option>
                                                        <option value="l">Litre</option>
                                                        <option value="pvt">PVT</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-1">
                                            <label class="x-small fw-bold opacity-50 mb-1">PRODUCT SKU</label>
                                            <input type="text" name="sku" class="form-control form-control-sm" value="{{ $sku }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-header py-2 bg-white border-bottom shadow-none">
                                        <h4 class="card-title mb-0 small fw-bold">CATEGORIZATION</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="mb-3">
                                            <div class="input-icon">
                                                <input type="text" id="category-search" class="form-control form-control-sm shadow-none bg-light border-0" placeholder="Filter List...">
                                                <span class="input-icon-addon"><i class="fas fa-filter small opacity-50"></i></span>
                                            </div>
                                        </div>
                                        <div id="categories-tree" class="overflow-auto border p-2 rounded bg-light-subtle" style="max-height: 280px; font-size: 0.85rem;">
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($categories->where('parent_id', 0) as $parent)
                                                    <li class="category-item mb-1">
                                                        <label class="form-check cursor-pointer mb-0">
                                                            <input type="checkbox" name="categories[]" class="form-check-input parent-category" value="{{ $parent->id }}">
                                                            <span class="form-check-label fw-bold opacity-75">{{ $parent->name }}</span>
                                                        </label>
                                                        @php $subcats = $categories->where('parent_id', $parent->id); @endphp
                                                        @if ($subcats->count())
                                                            <ul class="list-unstyled ms-3 mt-1 ps-2 border-start">
                                                                @foreach ($subcats as $sub)
                                                                    <li class="category-item mb-1">
                                                                        <label class="form-check cursor-pointer mb-0">
                                                                            <input type="checkbox" name="categories[]" class="form-check-input child-category" value="{{ $sub->id }}" data-parent="{{ $parent->id }}">
                                                                            <span class="form-check-label text-muted">{{ $sub->name }}</span>
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

                                <div class="card shadow-sm border-0 mb-3">
                                    <div class="card-header py-2 bg-white shadow-none">
                                        <h4 class="card-title mb-0 small fw-bold text-muted">BRANDING</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <select class="form-select form-select-sm shadow-none" name="brand_id">
                                            <option value="">Generic / No Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 overflow-hidden mb-3">
                                    <div class="card-header py-2 bg-white shadow-none">
                                        <h4 class="card-title mb-0 small fw-bold">PRIMARY COVER</h4>
                                    </div>
                                    <div class="card-body p-3 text-center bg-light-subtle">
                                        <div class="preview-image-wrapper mb-3 border rounded overflow-hidden shadow-sm bg-white" style="height: 160px;">
                                            <img id="preview-image" src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" class="img-fluid w-100 h-100" style="object-fit: contain;">
                                        </div>
                                        <input type="file" name="image_file" id="image_file" class="d-none" accept="image/*" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 border-2 fw-bold" onclick="document.getElementById('image_file').click()">SELECT IMAGE</button>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 border-start border-3 border-info">
                                    <div class="card-header py-2 bg-white shadow-none">
                                        <h4 class="card-title mb-0 small fw-bold text-muted">TAGS FOR DISCOVERY</h4>
                                    </div>
                                    <div class="card-body p-3">
                                        <input class="form-control form-control-sm shadow-none border-0 bg-light" name="tag" id="tag" data-url="{{ route('frontend.vendor.product-tags.all') }}" placeholder="SEO Tags...">
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .page-wrapper { background-color: #f8fafc; }
    .card { border-radius: 12px; transition: transform 0.2s, box-shadow 0.2s; }
    .card:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .border-dashed { border-style: dashed !important; border-width: 2px !important; }
    .cursor-pointer { cursor: pointer; }
    .category-item { transition: all 0.2s; }
    .input-icon-addon { color: #64748b; }
    .form-control:focus, .form-select:focus { border-color: #0081ff; box-shadow: 0 0 0 4px rgba(0, 129, 255, 0.1); }
    .accordion-button:not(.collapsed) { background-color: #f0f7ff; color: #0081ff; }
    .x-small { font-size: 0.65rem; letter-spacing: 0.05em; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
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
                    col.innerHTML = `<div class="position-relative shadow-sm"><img src="${e.target.result}" class="img-fluid rounded border" style="height: 70px; width: 100%; object-fit: cover;"></div>`;
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
            container.innerHTML = `<video src="${url}" controls class="w-100 rounded border shadow-sm" style="max-height: 180px;"></video>`;
        }
    }

    $(document).ready(function() {
        // Tagify Initialization
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

        // Category Filter
        $('#category-search').on('keyup', function() {
            let q = $(this).val().toLowerCase();
            $('.category-item').each(function() {
                $(this).toggle($(this).text().toLowerCase().includes(q));
            });
        });

        $('.parent-category').on('change', function() {
            $(this).closest('li').find('.child-category').prop('checked', $(this).prop('checked'));
        });

        // Attributes Dynamic Rows
        let attrIndex = 0;
        $('.btn-open-attributes').on('click', function() {
            $('.list-product-attribute-values-wrap').removeClass('d-none');
            $('.empty-attributes-text').addClass('d-none');
            addAttributeRow();
        });

        $('.btn-trigger-add-attribute-item').on('click', addAttributeRow);

        function addAttributeRow() {
            let html = $('.product-select-attribute-item-template').html().replace(/__INDEX__/g, attrIndex++);
            $('.list-product-attribute-items-wrap').append(html);
        }

        $(document).on('change', '.attr-set-select', function() {
            let setId = $(this).val();
            let $valSelect = $(this).closest('.attribute-row').find('.attr-val-select');
            if (!setId) { $valSelect.prop('disabled', true).empty(); return; }
            $valSelect.prop('disabled', false).html('<option value="">Searching...</option>');
            $.get("{{ route('frontend.vendor.products.get-attribute-values') }}", { attribute_set_id: setId }, function(res) {
                let options = '<option value="">Choose value...</option>';
                res.data.forEach(v => options += `<option value="${v.id}">${v.name}</option>`);
                $valSelect.html(options);
            });
        });

        $(document).on('click', '.btn-remove-attr', function() { $(this).closest('.attribute-row').remove(); });

        // Pricing Period Toggle
        $('.turn-on-schedule').on('click', function() { $(this).hide(); $('.turn-off-schedule').show(); $('.scheduled-time').fadeIn(); $('.detect-schedule').val('1'); });
        $('.turn-off-schedule').on('click', function() { $(this).hide(); $('.turn-on-schedule').show(); $('.scheduled-time').fadeOut(); $('.detect-schedule').val('0'); });

        // Custom Options Repeater
        let optionIndex = 0;
        $('.add-new-option').on('click', function() { buildOptionForm(); });
        
        $('.add-from-global-option').on('click', function() {
            let id = $('#global-option').val();
            if (id == 0) return;
            $.get("{{ route('frontend.vendor.products.get-global-option', '') }}/" + id, function(res) { buildOptionForm(res.data); });
        });

        function buildOptionForm(data = null) {
            let id = optionIndex++;
            let name = data ? data.name : '';
            let type = data ? data.option_type : 'dropdown';
            let req = data && data.required ? 'checked' : '';
            let html = `
                <div class="accordion-item border-0 mb-3 rounded-3 shadow-sm overflow-hidden" id="option-${id}">
                    <h2 class="accordion-header"><button class="accordion-button py-2 bg-light-subtle small fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-opt-${id}"><i class="fas fa-list-check me-2 opacity-75"></i>${name || 'Variation Group'}</button></h2>
                    <div id="collapse-opt-${id}" class="accordion-collapse collapse show"><div class="accordion-body p-3 bg-white border">
                        <div class="row g-2 mb-3">
                            <div class="col-md-6"><label class="form-label small fw-bold">Option Label</label><input type="text" name="options[${id}][name]" class="form-control form-control-sm" value="${name}" required></div>
                            <div class="col-md-4"><label class="form-label small fw-bold">Field Type</label><select name="options[${id}][option_type]" class="form-select form-select-sm"><option value="dropdown" ${type=='dropdown'?'selected':''}>Select Menu</option><option value="checkbox" ${type=='checkbox'?'selected':''}>Checkbox List</option></select></div>
                            <div class="col-md-2 d-flex align-items-end pb-1"><label class="form-check mb-0 x-small fw-bold"><input type="checkbox" name="options[${id}][required]" class="form-check-input" ${req}><span class="form-check-label ms-1">MANDATORY</span></label></div>
                        </div>
                        <div class="option-values-container"><table class="table table-sm table-borderless mb-0"><thead><tr class="x-small text-muted fw-bold"><th>VALUE LABEL</th><th>FEE</th><th>MODE</th><th></th></tr></thead><tbody id="val-body-${id}"></tbody></table><button type="button" class="btn btn-sm text-primary p-0 fw-bold add-val-btn mt-2" data-opt-id="${id}">+ ADD ROW</button></div>
                        <div class="text-end border-top mt-3 pt-2"><button type="button" class="btn btn-sm btn-link text-danger p-0 fw-bold text-decoration-none" onclick="$('#option-${id}').remove()">DESTROY BLOCK</button></div>
                    </div></div>
                </div>`;
            $('#accordion-product-option').append(html);
            if (data && data.values) data.values.forEach(v => addOptionValue(id, v)); else addOptionValue(id);
        }

        $(document).on('click', '.add-val-btn', function() { addOptionValue($(this).data('opt-id')); });

        function addOptionValue(optId, data = null) {
            let rowId = Date.now() + Math.random();
            let val = data ? data.option_value : '';
            let pr = data ? data.affect_price : 0;
            let ty = data ? data.affect_type : '0';
            let row = `<tr class="align-middle">
                <td class="ps-0"><input type="text" name="options[${optId}][values][${rowId}][option_value]" class="form-control form-control-sm" value="${val}" required></td>
                <td><input type="number" name="options[${optId}][values][${rowId}][affect_price]" class="form-control form-control-sm" value="${pr}"></td>
                <td><select name="options[${optId}][values][${rowId}][affect_type]" class="form-select form-select-sm"><option value="0" ${ty=='0'?'selected':''}>₹ FIXED</option><option value="1" ${ty=='1'?'selected':''}>% PERCENT</option></select></td>
                <td class="text-end pe-0"><button type="button" class="btn btn-sm text-muted p-0 opacity-50" onclick="$(this).closest('tr').remove()"><i class="fas fa-times"></i></button></td></tr>`;
            $(`#val-body-${optId}`).append(row);
        }

        // Linked Products AJAX Search
        $('.box-search-input').on('keyup', function() {
            let $input = $(this); let $res = $input.next('.box-search-results'); let q = $input.val();
            if (q.length < 2) { $res.hide(); return; }
            $.get("{{ route('frontend.vendor.products.get-relations') }}", { search: q }, function(res) {
                let html = res.data.map(p => `<a href="#" class="list-group-item list-group-item-action py-2 select-relation d-flex align-items-center" data-id="${p.id}" data-name="${p.name}" data-image="${p.image}"><img src="${p.image || '/vendor/core/core/base/images/placeholder.png'}" width="30" height="30" class="rounded me-2 border-primary-subtle"><span class="small fw-bold">${p.name}</span></a>`).join('');
                $res.html(html || '<div class="list-group-item small text-center italic text-muted">No matches</div>').show();
            });
        });

        $(document).on('click', '.select-relation', function(e) {
            e.preventDefault(); let p = $(this).data(); let $list = $('#selected-related-products');
            if ($list.find(`input[value="${p.id}"]`).length) return;
            $list.show().append(`<div class="list-group-item d-flex justify-content-between align-items-center py-2 bg-info bg-opacity-10 border-0 border-bottom border-info-subtle"><span><img src="${p.image}" width="22" height="22" class="rounded me-2 border"><span class="small fw-bold text-info">${p.name}</span></span><input type="hidden" name="related_products[]" value="${p.id}"><button type="button" class="btn btn-sm text-danger p-0 border-0" onclick="$(this).parent().remove()"><i class="fas fa-trash-alt"></i></button></div>`);
            $(this).parent().hide();
        });

        // FAQ Repeater
        let faqIdx = 0;
        $('.add-faq-item').on('click', function() { addFaq(); });
        function addFaq(q = '', a = '') {
            let id = faqIdx++;
            let h = `<div class="faq-item p-3 mb-3 bg-white rounded-3 shadow-sm border border-info border-opacity-25" id="faq-${id}">
                <div class="mb-3"><label class="x-small fw-bold opacity-50 mb-1">PROMPT / QUESTION</label><input type="text" name="faq_schema_config[${id}][question]" class="form-control form-control-sm border-0 bg-info bg-opacity-10 shadow-none" value="${q}"></div>
                <div class="mb-1"><label class="x-small fw-bold opacity-50 mb-1">DETAILED ANSWER</label><textarea name="faq_schema_config[${id}][answer]" class="form-control form-control-sm border-0 bg-info bg-opacity-10 shadow-none" rows="2">${a}</textarea></div>
                <div class="text-end"><button type="button" class="btn btn-sm text-danger p-0 fw-bold x-small text-decoration-none" onclick="$('#faq-${id}').remove()">ERASE RECORD</button></div></div>`;
            $('#faq-repeater').append(h);
        }

        // Inventory Management Toggle
        $('.storehouse-management-status').on('change', function() { 
            $('.storehouse-info').fadeToggle($(this).prop('checked')); 
            $('.stock-status-wrapper').fadeToggle(!$(this).prop('checked')); 
        });

        // Form Submit via AJAX
        $('#botble-ecommerce-forms-product-form').validate({
            rules: { name: { required: true } },
            submitHandler: function(form) {
                if (typeof CKEDITOR !== 'undefined') for(i in CKEDITOR.instances) CKEDITOR.instances[i].updateElement();
                $.ajax({
                    url: $(form).attr('action'), type: 'POST', data: new FormData(form), processData: false, contentType: false,
                    beforeSend: function() { Swal.fire({ title: 'Deploying Listing...', html: 'Synchronizing assets and meta-records.', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } }); },
                    success: function(res) { if(res.status) { Swal.fire({ icon:'success', title:'Listing Active!', text:res.message, confirmButtonColor: '#0081ff' }).then(() => { window.location.href = res.redirect; }); } else { Swal.fire('Error', res.message, 'error'); } },
                    error: function(xhr) { Swal.fire('Deployment Failed', 'Check connectivity and required fields.', 'error'); }
                });
            }
        });
    });
</script>
@endpush
