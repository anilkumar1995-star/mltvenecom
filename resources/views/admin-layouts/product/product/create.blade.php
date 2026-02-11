@extends('admin-layouts.app')
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
                                            href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="https://shofy-grocery.botble.com/admin/ecommerce/products">Products</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New product</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">New physical product</h1>
                                    </li>
                                </ol>
                            </nav>

                        </div>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form method="POST" action="{{ route('admin.products.create') }}" accept-charset="UTF-8"
                    id="botble-ecommerce-forms-product-form" class="js-base-form dirty-check" enctype="multipart/form-data">
                    @csrf

                    <div role="alert" class="alert alert-info">
                        <div class="d-flex gap-1">
                            <div>
                                <svg class="icon alert-icon svg-icon-ti-ti-info-circle" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg>
                            </div>
                            <div class="w-100">
                                You are editing "<strong class="current_language_text">English</strong>" version
                            </div>
                        </div>
                    </div>

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
                                        <div class="mb-3 ">
                                            <div class="slug-field-wrapper" data-field-name="name">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label required" for="slug">
                                                        Permalink
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text">
                                                            https://shofy-grocery.botble.com/products/
                                                        </span>
                                                        <input class="form-control ps-0" type="text" name="slug"
                                                            id="slug" required="required" />
                                                        <span class="input-group-text slug-actions">
                                                            <a href="#" class="link-secondary d-none"
                                                                data-bs-toggle="tooltip" aria-label="Generate URL"
                                                                data-bs-original-title="Generate URL"
                                                                data-bb-toggle="generate-slug">
                                                                <svg class="icon svg-icon-ti-ti-wand"
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M6 21l15 -15l-3 -3l-15 15l3 3" />
                                                                    <path d="M15 6l3 3" />
                                                                    <path
                                                                        d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                    <path
                                                                        d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" />
                                                                </svg>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                                <small class="form-hint mt-n2 text-truncate">Preview: <a
                                                        href="https://shofy-grocery.botble.com/products/"
                                                        target="_blank">https://shofy-grocery.botble.com/products/</a></small>
                                                <input class="slug-current" name="slug" type="hidden" value="">
                                                <div class="slug-data"
                                                    data-url="https://shofy-grocery.botble.com/ajax/slug/create"
                                                    data-view="https://shofy-grocery.botble.com/products/" data-id="0">
                                                </div>
                                                <input name="slug_id" type="hidden" value="0">
                                                <input name="is_slug_editable" type="hidden" value="1">
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn   show-hide-editor-btn" type="button"
                                                    data-result="description">
                                                    Show/Hide Editor
                                                </button>
                                                <button class="btn btn_gallery" type="button"
                                                    onclick="openImageModal()">
                                                    <svg class="icon icon-left svg-icon-ti-ti-photo"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M15 8h.01" />
                                                        <path
                                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    </svg>
                                                    Add media
                                                </button>
                                            </div>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4"
                                                placeholder="Short description" id="description" name="description" cols="50"></textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="content">
                                                Content
                                            </label>
                                            <div class="mb-2 btn-list">
                                                <button class="btn   show-hide-editor-btn" type="button"
                                                    data-result="content">
                                                    Show/Hide Editor
                                                </button>

                                                <button class="btn   btn_gallery" type="button" data-result="content"
                                                    data-multiple="true" data-action="media-insert-ckeditor">
                                                    <svg class="icon icon-left svg-icon-ti-ti-photo"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M15 8h.01" />
                                                        <path
                                                            d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12" />
                                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                                    </svg>
                                                    Add media
                                                </button>

                                                <button class="btn   add_shortcode_btn_trigger" type="button"
                                                    data-bb-toggle="shortcode-list-modal" data-result="content">
                                                    <svg class="icon svg-icon-ti-ti-box"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                                        <path d="M12 12l8 -4.5" />
                                                        <path d="M12 12l0 9" />
                                                        <path d="M12 12l-8 -4.5" />
                                                    </svg>
                                                    UI Blocks
                                                </button>
                                            </div>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4"
                                                placeholder="Write your content" with-short-code id="content" name="content" cols="50"></textarea>
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
                                                
                                                <!-- Image Preview Container -->
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
                                                
                                                <!-- Video Preview Container -->
                                                <div id="video_preview_container" class="mt-3"></div>
                                            </div>
                                        </div>

                                        <script>
                                            function previewImages(input) {
                                                const container = document.getElementById('image_preview_container');
                                                container.innerHTML = ''; // Clear previous previews
                                                
                                                if (input.files) {
                                                    Array.from(input.files).forEach(file => {
                                                        if (file.type.startsWith('image/')) {
                                                            const reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                const col = document.createElement('div');
                                                                col.className = 'col-6 col-md-4 col-lg-3';
                                                                col.innerHTML = `
                                                                    <div class="card border-0 shadow-sm position-relative">
                                                                        <img src="${e.target.result}" class="card-img-top rounded" style="height: 100px; object-fit: cover;">
                                                                    </div>
                                                                `;
                                                                container.appendChild(col);
                                                            }
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                }
                                            }

                                            function previewVideo(input) {
                                                const container = document.getElementById('video_preview_container');
                                                container.innerHTML = '';
                                                
                                                if (input.files && input.files[0]) {
                                                    const file = input.files[0];
                                                    const url = URL.createObjectURL(file);
                                                    container.innerHTML = `
                                                        <div class="card border-0 shadow-sm">
                                                             <video src="${url}" controls class="w-100 rounded" style="max-height: 200px;"></video>
                                                             <div class="p-2 text-center small text-muted text-truncate">${file.name}</div>
                                                        </div>
                                                    `;
                                                }
                                            }
                                        </script>
                                        <input class="form-control" name="product_type" type="hidden" value="physical">
                                    </div>




                                    
                                </div>
                            </div>

                            <div class="card mb-3 product-specification-table">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Specification Tables
                                    </h4>
                                    <div class="card-actions"><select class="form-select" name="specification_table_id"
                                            id="specification_table_id">
                                            <option value="">None</option>
                                            @foreach ($tables as $table)
                                                <option value="{{ $table->id }}">{{ $table->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <p class="text-secondary mb-0 p-3">
                                    Select the specification table to display in this product
                                </p>
                                <div class="specification-table"></div>
                            </div>
                            <div id="main-manage-product-type">
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Overview
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row price-group">
                                            <input class="detect-schedule d-none" name="sale_type" type="hidden"
                                                value="0">

                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sku">
                                                        SKU
                                                    </label>
                                                    <input class="form-control" type="text" name="sku"
                                                        id="sku" value="SF-2443-FQRW" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="price">
                                                        Price
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="price" id="price" value="0"
                                                            data-thousands-separator="," data-decimal-separator="."
                                                            step="any" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sale_price">
                                                        Price sale
                                                        <span class="form-label-description">
                                                            <a class="turn-on-schedule" style=""
                                                                href="javascript:void(0)">
                                                                Choose Discount Period
                                                            </a>
                                                            <a class="turn-off-schedule" style="display: none;"
                                                                href="javascript:void(0)">
                                                                Cancel
                                                            </a>
                                                        </span>
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="sale_price" id="sale_price"
                                                            data-thousands-separator="," data-decimal-separator="."
                                                            data-sale-percent-text="Discount :percent from original price." />
                                                    </div>
                                                    <small class="form-hint">Discount <strong>0%</strong> from original
                                                        price.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="start_date">
                                                        From date
                                                    </label>
                                                    <input class="form-control form-date-time" type="text"
                                                        name="start_date" id="start_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 scheduled-time" style="display: none;">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="end_date">
                                                        To date
                                                    </label>
                                                    <input class="form-control form-date-time" type="text"
                                                        name="end_date" id="end_date" placeholder="Y-m-d H:i:s" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3 position-relative">
                                                    <input type="hidden" name="price_includes_tax" value="0">

                                                    <label class="form-check">
                                                        <input type="checkbox" name="price_includes_tax"
                                                            class="form-check-input" value="1">
                                                        <span class="form-check-label">
                                                            Price includes tax
                                                        </span>

                                                        <span class="form-check-description">Check this if the entered
                                                            price already includes taxes. The system will calculate the base
                                                            price by removing the tax amount.</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="cost_per_item">
                                                        Cost per item
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text currency-symbol">$</span>
                                                        <input class="form-control input-mask-number" type="text"
                                                            name="cost_per_item" id="cost_per_item" value="0"
                                                            placeholder="Enter cost per item" step="any" />
                                                    </div>
                                                    <small class="form-hint">Customers won't see this price.</small>
                                                </div>
                                            </div>
                                            <input name="product_id" type="hidden" value="">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="barcode">
                                                        Barcode (ISBN, UPC, GTIN, etc.)
                                                    </label>
                                                    <input class="form-control" type="text" name="barcode"
                                                        id="barcode" step="any" placeholder="Enter barcode" />
                                                    <small class="form-hint">Must be unique for each product.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <input type="hidden" name="with_storehouse_management" value="0">
                                            <label class="form-check">
                                                <input type="checkbox" name="with_storehouse_management"
                                                    class="form-check-input storehouse-management-status" value="1">
                                                <span class="form-check-label">
                                                    With storehouse management
                                                </span>
                                            </label>
                                        </div>

                                        <fieldset class="form-fieldset storehouse-info" style="display: none;">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label" for="quantity">
                                                    Quantity
                                                </label>
                                                <input class="form-control input-mask-number" type="text"
                                                    name="quantity" id="quantity" value="0" />
                                            </div>
                                            <div class="mb-3 position-relative">
                                                <input type="hidden" name="allow_checkout_when_out_of_stock"
                                                    value="0">
                                                <label class="form-check">
                                                    <input type="checkbox" name="allow_checkout_when_out_of_stock"
                                                        class="form-check-input" value="1">
                                                    <span class="form-check-label">
                                                        Allow customer checkout when this product out of stock
                                                    </span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-fieldset stock-status-wrapper" style=";">
                                            <label class="form-label" for="stock_status">
                                                Stock status
                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="in_stock" checked>
                                                <span class="form-check-label">
                                                    In stock
                                                </span>

                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="out_of_stock">

                                                <span class="form-check-label">
                                                    Out of stock
                                                </span>
                                            </label>
                                            <label class="form-check form-check-inline mb-3">
                                                <input type="radio" name="stock_status" class="form-check-input"
                                                    value="on_backorder">
                                                <span class="form-check-label">
                                                    On backorder
                                                </span>
                                            </label>
                                        </fieldset>

                                        <fieldset class="form-fieldset">
                                            <legend>
                                                <h3>Shipping</h3>
                                            </legend>
                                            <div class="row">
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="weight">
                                                            Weight (g)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">g</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="weight" id="weight" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="length">
                                                            Length (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="length" id="length" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="wide">
                                                            Wide (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="wide" id="wide" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-md-6">
                                                    <div class="mb-3 position-relative">
                                                        <label class="form-label" for="height">
                                                            Height (cm)
                                                        </label>
                                                        <div class="input-group input-group-flat">
                                                            <span class="input-group-text">cm</span>
                                                            <input class="form-control input-mask-number" type="text"
                                                                name="height" id="height" value="0" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        <h4 class="card-title mb-0">Attributes</h4>
                                        <button type="button" class="btn btn-outline-primary btn-open-attributes">
                                            Add new attributes
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <p class="text-muted">
                                            Adding new attributes helps the product to have many options.
                                        </p>
                                        <div class="product-select-attribute-item-template d-none">
                                            <div class="row align-items-center mb-3 attribute-row">
                                                <div class="col-md-5">
                                                    <label>Attribute name</label>
                                                    <select class="form-control attr-name"
                                                        name="attributes[__INDEX__][attribute_set_id]">
                                                        <option value="">Select attribute</option>
                                                        @foreach ($attributeSets as $set)
                                                            <option value="{{ $set->id }}">{{ $set->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label>Value</label>
                                                    <select class="form-control attr-value"
                                                        name="attributes[__INDEX__][attribute_id]">
                                                        <option value="">Select value</option>
                                                        @foreach ($attributes as $attr)
                                                            <option value="{{ $attr->id }}"
                                                                data-set="{{ $attr->attribute_set_id }}">
                                                                {{ $attr->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <button type="button" class="btn btn-danger btn-remove-attr mt-4"
                                                        style="color:white;">
                                                        🗑
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- LIST -->
                                        <div class="list-product-attribute-values-wrap d-none">
                                            <div class="list-product-attribute-items-wrap"></div>
                                            <button type="button"
                                                class="btn btn-light border btn-trigger-add-attribute-item mt-3">
                                                Add more attribute
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Product options
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="product-option-form-wrap">
                                            <div class="product-option-form-group">
                                                <div class="product-option-form-body">
                                                    <input name="has_product_options" type="hidden" value="1">
                                                    <div class="accordion" id="accordion-product-option"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col col-12 col-md-4 mb-3 mb-md-0">
                                                        <button class="btn   add-new-option" type="button"
                                                            id="add-new-option">
                                                            Add new option
                                                        </button>
                                                    </div>
                                                    <div class="col ms-auto ms-md-0 col-12 col-md-8">
                                                        <div
                                                            class="d-flex gap-2 align-items-start justify-content-start justify-content-md-end">
                                                            <div class="mb-3 position-relative">
                                                                <select class="form-select" id="global-option">
                                                                    <option value="0">Select Global Option</option>
                                                                    @if(isset($globalOptions))
                                                                        @foreach($globalOptions as $globalOption)
                                                                            <option value="{{ $globalOption->id }}">{{ $globalOption->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <button class="btn  add-from-global-option" type="button">
                                                                Add Global Option
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">Related Products</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Search products</label>
                                            <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="related-products">
                                            <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                        </div>
                                        <div id="selected-related-products" class="list-group box-selected-items">
                                            <!-- Selected items will be appended here -->
                                        </div>
                                    </div>
                                </div>







 <!-- Up-selling Products -->
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title">Up-selling products</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 position-relative">
                                    <label class="form-label">Search products</label>
                                    <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="up-selling-products">
                                    <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                </div>
                                <div id="selected-up-selling-products" class="list-group box-selected-items">
                                    <!-- Selected items will be appended here -->
                                </div>
                                <div class="mt-2 text-muted small">
                                    * Price field: Enter the amount you want to reduce from the original price. Example: If the original price is $100, enter 20 to reduce the price to $80.<br>
                                    * Type field: Choose the discount type: Fixed (reduce a specific amount) or Percent (reduce by a percentage).
                                </div>
                            </div>
                        </div>

                        <!-- Cross-selling Products -->
                        <div class="card meta-boxes">
                            <div class="card-header">
                                <h4 class="card-title">Cross-selling products</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 position-relative">
                                    <label class="form-label">Search products</label>
                                    <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="cross-selling-products">
                                    <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                </div>
                                <div id="selected-cross-selling-products" class="list-group box-selected-items">
                                    <!-- Selected items will be appended here -->
                                </div>
                                <div class="mt-2 text-muted small">
                                    * Price field: Enter the amount you want to reduce from the original price. Example: If the original price is $100, enter 20 to reduce the price to $80.<br>
                                    * Type field: Choose the discount type: Fixed (reduce a specific amount) or Percent (reduce by a percentage).
                                </div>
                            </div>
                        </div>


                            </div>

                            <div class="card meta-boxes mb-3">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Product FAQ</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="form-label">Select from existing FAQs</label>
                                        <div class="dropdown" id="faq-custom-dropdown">
                                            <button class="form-select text-start d-flex justify-content-between align-items-center bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="faq-dropdown-btn">
                                                <span class="dropdown-text">Select FAQs...</span>
                                            </button>
                                            <ul class="dropdown-menu w-100 p-2 shadow-sm" aria-labelledby="faq-dropdown-btn" style="max-height: 300px; overflow-y: auto;">
                                               <div id="faq-list-container">
                                                    @foreach($faqs ?? [] as $faq)
                                                        <li>
                                                            <div class="dropdown-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input faq-checkbox" type="checkbox" 
                                                                        value="{{ $faq->id }}" 
                                                                        data-question="{{ $faq->question }}"
                                                                        id="faq-check-{{ $faq->id }}"
                                                                        name="selected_existing_faqs[]"
                                                                        @if(in_array($faq->id, old('selected_existing_faqs', []))) checked @endif
                                                                    >
                                                                    <label class="form-check-label w-100" for="faq-check-{{ $faq->id }}" style="cursor: pointer;">
                                                                        {{ $faq->question }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                               </div>
                                            </ul>
                                        </div>
                                        <!-- Selected Tags Container -->
                                        <div id="selected-faq-tags" class="mt-2 d-flex flex-wrap gap-2"></div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label mb-0">Custom FAQs</label>
                                        <button type="button" class="btn btn-sm btn-primary" id="add-faq">
                                            + Add FAQ
                                        </button>
                                    </div>
                                    
                                    <div id="faq-list">
                                        <!-- Repeater items will be injected here -->
                                        @if(old('faq_schema_config'))
                                            @foreach(old('faq_schema_config') as $key => $item)
                                                <div class="repeater-item mb-3 p-3 border rounded bg-white position-relative">
                                                     <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label mb-0 fw-bold">Question</label>
                                                        <button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control mb-3" name="faq_schema_config[{{ $key }}][question]" value="{{ $item['question'] ?? '' }}" placeholder="Enter your question...">
                                                    
                                                    <label class="form-label fw-bold">Answer</label>
                                                    <textarea class="form-control" name="faq_schema_config[{{ $key }}][answer]" rows="2" placeholder="Enter your answer...">{{ $item['answer'] ?? '' }}</textarea>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            Publish
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-list">
                                            <button class="btn btn-primary" type="submit" value="apply"
                                                name="submitter">
                                                <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                    <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                    <path d="M14 4l0 4l-6 0l0 -4" />
                                                </svg>
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div data-bb-waypoint data-bb-target="#form-actions"></div>
                                <header class="top-0 w-100 position-fixed end-0 z-1000" id="form-actions"
                                    style="display: none;">
                                    <div class="navbar">
                                        <div class="container-xl">
                                            <div class="row g-2 align-items-center w-100">
                                                <div class="col">
                                                    <div class="page-pretitle">
                                                        <nav aria-label="breadcrumb">
                                                            <ol class="breadcrumb">
                                                            </ol>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <div class="col-auto ms-auto d-print-none">
                                                    <div class="btn-list">
                                                        <button class="btn btn-primary" type="submit" value="apply"
                                                            name="submitter">
                                                            <svg class="icon icon-left svg-icon-ti-ti-device-floppy"
                                                                xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                                <path d="M14 4l0 4l-6 0l0 -4" />
                                                            </svg>
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </header>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label form-label required" for="status">
                                                Status
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        @if(auth()->check() && auth()->user()->role === 'vendor')
                                            <input type="hidden" name="status" value="pending">
                                            <select class="form-select" disabled>
                                                <option value="pending" selected>Pending</option>
                                            </select>
                                            <small class="text-muted">Vendors can only create products as Pending.</small>
                                        @else
                                            <select class="form-select" required="required" id="status-select-56485"
                                                name="status">
                                                <option value="published">Published</option>
                                                <option value="draft">Draft</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="store_id">
                                                Store
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <select class="select-search-full form-select"
                                            data-placeholder="Select a store..." data-allow-clear="true"
                                            id="store_id-select-59624" name="store_id">
                                        @if(!empty($stores))
                                            @foreach ($stores as $row)
                                                 <option selected="selected" value="">Select a store...</option>
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        @endif
                                        
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="is_featured">
                                                Is featured?
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <label class="form-check form-switch d-inline-block ">
                                            <input name="is_featured" type="hidden" value="0" />
                                            <input class="form-check-input" name="is_featured" type="checkbox"
                                                value="1" id="is_featured" />
                                        </label>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="is_new_until">
                                                New until
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="input-group datepicker">
                                            <input class="form-control " placeholder="Y-m-d" data-input=""
                                                readonly="readonly" name="is_new_until" type="text"
                                                id="is_new_until">
                                            <button class="btn btn-icon" type="button" data-toggle="data-toggle">
                                                <svg class="icon icon-left svg-icon-ti-ti-calendar"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path
                                                        d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12" />
                                                    <path d="M16 3v4" />
                                                    <path d="M8 3v4" />
                                                    <path d="M4 11h16" />
                                                    <path d="M11 15h1" />
                                                    <path d="M12 15v3" />
                                                </svg>

                                            </button>
                                            <button class="btn btn-icon   text-danger" type="button"
                                                data-clear="data-clear">
                                                <svg class="icon icon-left svg-icon-ti-ti-x"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M18 6l-12 12" />
                                                    <path d="M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <small class="form-hint">
                                            Set a date until which this product will be marked as "New". Leave empty to not
                                            mark
                                            as new based on date.
                                        </small>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="categories[]">
                                                Categories
                                            </label>
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="input-icon">
                                                <input type="text" id="search-category-input" class="form-control"
                                                    placeholder="Search..." onkeyup="filterCategories()" />
                                                <span class="input-icon-addon">
                                                    <svg class="icon svg-icon-ti-ti-search"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                        <path d="M21 21l-6 -6" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <div id="categories-tree">
                                            <ul class="list-unstyled">
                                                @foreach ($categories->where('parent_id', 0) as $parent)
                                                    <li>
                                                        <label class="form-check">
                                                            <input type="checkbox" name="categories[]"
                                                                class="form-check-input parent-category"
                                                                value="{{ $parent->id }}">
                                                            <span class="form-check-label">{{ $parent->name }}</span>
                                                        </label>
                                                        @php
                                                            $subcategories = $categories->where(
                                                                'parent_id',
                                                                $parent->id,
                                                            );
                                                        @endphp
                                                        @if ($subcategories->count())
                                                            <ul class="list-unstyled ms-3 mt-2">
                                                                @foreach ($subcategories as $sub)
                                                                    <li>
                                                                        <label class="form-check">
                                                                            <input type="checkbox" name="categories[]"
                                                                                class="form-check-input child-category"
                                                                                value="{{ $sub->id }}"
                                                                                data-parent="{{ $parent->id }}">
                                                                            <span
                                                                                class="form-check-label">{{ $sub->name }}</span>
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

                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="brand_id">
                                                Brand
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        @if(!empty($brands))
                                            <select class="select-search-full form-select"
                                                data-placeholder="Select a brand..." data-allow-clear="true"
                                                id="brand_id-select-84335" name="brand_id">
                                                @foreach ($brands as $row)
                                                     <option selected="selected" value="">Select a brand...</option>
                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="image">
                                                Featured image (optional)
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <div class="image-box">
                                            <div class="preview-image-wrapper mb-1">
                                                <div class="preview-image-inner">
                                                    <img id="preview-image" class="preview-image default-image"
                                                        src="{{ asset('vendor/core/core/base/images/placeholder.png') }}"
                                                        alt="Preview image"
                                                        style="width: 150px; height: 150px; object-fit: cover; border-radius: 4px;" />
                                                </div>
                                            </div>
                                            <input type="file" name="image_file" id="image_file" class="form-control"
                                                accept="image/*"
                                                onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                                            <small class="form-hint mt-2">Maximum file size: 2MB. Allowed formats: jpeg,
                                                png,
                                                jpg, gif.</small>
                                        </div>
                                    </div>
                                </div>

                               <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label">
                                                Product collections
                                            </label>
                                        </h4>
                                    </div>

                                    <div class="card-body">
                                        <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                            <div class="multi-check-list-wrapper">

                                                @foreach ($collections as $collection)
                                                    <label class="form-check">
                                                        <input type="checkbox"
                                                            id="product-collections-item-{{ $collection->id }}"
                                                            name="product_collections[]"
                                                            class="form-check-input"
                                                            value="{{ $collection->id }}">

                                                        <span class="form-check-label">
                                                            {{ $collection->name }}
                                                        </span>
                                                    </label>
                                                @endforeach

                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="product_labels[]">
                                                Labels
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                            <div class="multi-check-list-wrapper">
                                                @foreach($productionlabels as $label)
                                                    <label class="form-check">
                                                        <input type="checkbox" id="product-labels-item-{{ $label->id }}"
                                                            name="product_labels[]" class="form-check-input"
                                                            value="{{ $label->id }}">
                                                        <span class="form-check-label">
                                                            {{ $label->name }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="taxes[]">
                                                Taxes
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                            <div class="multi-check-list-wrapper">
                                                @foreach($taxes as $tax)
                                                    <label class="form-check">
                                                        <input type="checkbox" id="taxes-item-{{ $tax->id }}" name="taxes[]"
                                                            class="form-check-input" value="{{ $tax->id }}">
                                                        <span class="form-check-label">
                                                            {{ $tax->title }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="minimum_order_quantity">
                                                Minimum order quantity
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <input class="form-control" name="minimum_order_quantity" type="number"
                                            value="0" id="minimum_order_quantity">
                                        <small class="form-hint">
                                            Minimum quantity to place an order, if the value is 0, there is no limit.
                                        </small>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="maximum_order_quantity">
                                                Maximum order quantity
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <input class="form-control" name="maximum_order_quantity" type="number"
                                            value="0" id="maximum_order_quantity">
                                        <small class="form-hint">
                                            Maximum quantity to place an order, if the value is 0, there is no limit.
                                        </small>
                                    </div>
                                </div>
                                <div class="card meta-boxes">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                            <label class="form-label" for="tag">
                                                Tags
                                            </label>
                                        </h4>
                                    </div>
                                    <div class=" card-body">
                                        <input class="form-control" placeholder="Write some tags"
                                            data-url="{{ route('admin.product-tags.all') }}" name="tag"
                                            type="text" id="tag">
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                       
                        <div class="modal fade" id="rv_media_modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Media Gallery</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="file" id="imageInput" name="images[]" multiple accept="image/*"
                                            class="form-control mb-3">

                                        <div class="row" id="imagePreview"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary">Save</button>
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
            // ... existing scripts ...
            
            // AJAX Form Submission
            $(document).ready(function() {
                $("#botble-ecommerce-forms-product-form").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        status: {
                            required: true,
                        },
                        // Add other required fields here if needed
                    },
                    messages: {
                        name: {
                            required: "Please Enter Product Name",
                        },
                        status: {
                            required: "Please Select Status",
                        },
                    },
                    errorElement: "p",
                    errorClass: "text-danger",
                    submitHandler: function(form) {
                        var formData = new FormData(form);
                        // Manually append CKEditor content if needed, though FormData usually catches it if textarea is updated.
                        // CKEditor update (if used):
                        if (typeof CKEDITOR !== 'undefined') {
                            for (instance in CKEDITOR.instances) {
                                CKEDITOR.instances[instance].updateElement();
                            }
                        }
                        
                        $.ajax({
                            url: $(form).attr('action'),
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data.status === true || data.success === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: data.message
                                    }).then(() => {
                                        window.location.href = data.redirect || "{{ route('admin.products.index') }}";
                                    });
                                } else {
                                    // Handle logic where status might be false but 200 OK
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message || 'Something went wrong'
                                    });
                                }
                            },
                            error: function(xhr) {
                                if (xhr.status === 422 && xhr.responseJSON.errors) {
                                    // Validation errors
                                    let errorMsg = '';
                                    $.each(xhr.responseJSON.errors, function(key, value) {
                                        errorMsg += value[0] + '<br>';
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error',
                                        html: errorMsg
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Something went wrong!'
                                    });
                                }
                            }
                        });
                    }
                });
            });

            // Restoring Attribute Logic
            $(document).ready(function() {
                let index = 0;
                $('.btn-open-attributes').on('click', function() {

                    $('.list-product-attribute-values-wrap').removeClass('d-none');
                    $('.list-product-attribute-items-wrap').html('');
                    index = 0;

                    getAllAttributeSetIds().forEach(id => addRow(id));

                    toggleAddMoreVisibility();
                });

                $('.btn-trigger-add-attribute-item').on('click', function() {

                    let all = getAllAttributeSetIds();
                    let used = getUsedAttributeSetIds();

                    let next = all.find(id => !used.includes(id));

                    if (!next) return;

                    addRow(next);
                    toggleAddMoreVisibility();
                });

                function addRow(attributeSetId) {

                    let template = $('.product-select-attribute-item-template').html();
                    template = template.replace(/__INDEX__/g, index++);

                    let $row = $(template);
                    $('.list-product-attribute-items-wrap').append($row);

                    $row.find('.attr-name').val(attributeSetId).trigger('change');
                }

                $(document).on('change', '.attr-name', function() {

                    let setId = $(this).val();
                    let $value = $(this)
                        .closest('.attribute-row')
                        .find('.attr-value');

                    $value.val('');
                    $value.find('option').hide();
                    $value.find('option[value=""]').show();

                    if (!setId) return;

                    let $matched = $value.find(`option[data-set="${setId}"]`);
                    $matched.show();

                    if ($matched.length) {
                        $value.val($matched.first().val());
                    }
                });

                $(document).on('click', '.btn-remove-attr', function() {
                    $(this).closest('.attribute-row').remove();
                    toggleAddMoreVisibility();
                });

                function toggleAddMoreVisibility() {

                    let all = getAllAttributeSetIds();
                    let used = getUsedAttributeSetIds();

                    if (used.length < all.length) {
                        $('.list-product-attribute-values-wrap').removeClass('d-none');
                        $('.btn-trigger-add-attribute-item').show();
                    } else {
                        $('.btn-trigger-add-attribute-item').hide();
                    }
                }

                function getAllAttributeSetIds() {
                    let ids = [];
                    $('.product-select-attribute-item-template .attr-name option')
                        .not(':first')
                        .each(function() {
                            ids.push($(this).val());
                        });
                    return ids;
                }

                function getUsedAttributeSetIds() {
                    let ids = [];
                    $('.attr-name').each(function() {
                        let val = $(this).val();
                        if (val) ids.push(val);
                    });
                    return ids;
                }
            });

            function openImageModal() {
                $('#rv_media_modal').modal('show');
            }

            $(document).ready(function() {
                // Removed the hidden.bs.modal event that was clearing the input
                // $('#rv_media_modal').on('hidden.bs.modal', function() { ... });

                // Make the Save button close the modal
                $('#rv_media_modal .btn-primary').on('click', function(e) {
                    e.preventDefault();
                    $('#rv_media_modal').modal('hide');
                    // Optionally update a label on the main page to show selection count
                    let count = $('#imageInput')[0].files.length;
                    if(count > 0) {
                        $('.btn_gallery').html(`<i class="fa fa-check"></i> ${count} Images Selected`);
                    }
                });

                $(document).on("change", "#imageInput", function(event) {
                    let files = event.target.files;
                    let preview = $("#imagePreview");
                    preview.empty(); // Clear previous preview to match input state

                    $.each(files, function(i, file) {
                        let reader = new FileReader();

                        reader.onload = function(e) {
                            let html = `
                            <div class="col-md-3 mb-3 position-relative">
                                <img src="${e.target.result}" class="img-fluid rounded"
                                    style="width:100%; height:150px; object-fit:cover;">
                                <button type="button"
                                        class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-img">X</button>
                            </div>
                        `;

                            preview.append(html);
                        };

                        reader.readAsDataURL(file);
                    });
                });

                // remove button
                $(document).on("click", ".remove-img", function() {
                    $(this).parent().remove();
                    // Note: Removing from preview doesn't remove from file input 'files' array easily.
                    // For a simple implementation, we accept this limitation or use DataTransfer if needed.
                });


                $('.parent-category').on('change', function() {
                    var isChecked = $(this).prop('checked');
                    $(this).closest('li').find('.child-category').prop('checked', isChecked);
                });

                $('.child-category').on('change', function() {
                    if ($(this).prop('checked')) {
                        $(this).closest('ul').prev('label').find('.parent-category').prop('checked', true);
                    }
                });

                $(document).on('change', '#specification_table_id', function() {
                    const $this = $(this);
                    const $form = $this.closest('form');
                    const $table = $this.val();

                    if ($table) {
                        $.ajax({
                            url: "{{ route('admin.getatablesData') }}",
                            type: 'post',
                            data: {
                                group_id: $table,
                            },
                            success: function(response) {
                                if (response.data && response.data.length > 0) {
                                    let rows = "";
                                    response.data.forEach(function(group) {
                                        group.attributes.forEach(function(attr, index) {
                                            let valueField = "";

                                            // If attribute type is SELECT
                                            if (attr.type === "select" && attr
                                                .options) {
                                                let options = JSON.parse(attr.options);

                                                valueField = `<select class="form-control"
                                                    name="specs[${group.id}][${attr.id}][value]">`;

                                                options.forEach(opt => {
                                                    valueField +=
                                                        `<option value="${opt}">${opt}</option>`;
                                                });

                                                valueField += `</select>`;
                                            }
                                            // If attribute type is TEXT
                                            else {
                                                valueField = `
                                                <input type="text" class="form-control"
                                                    name="specs[${group.id}][${attr.id}][value]"
                                                    placeholder="Enter value">
                                                `;
                                            }

                                            rows += `
                                            <tr>
                                                <td>${group.name}</td>
                                                <td>${attr.name}</td>
                                                <td>${valueField}</td>

                                                <td class="text-center">
                                                    <input type="checkbox"
                                                        name="specs[${group.id}][${attr.id}][hide]"
                                                        value="1">
                                                </td>

                                                <td class="text-center sort-handle" style="cursor:move;">
                                                    ⇅
                                                    <input type="hidden"
                                                        name="specs[${group.id}][${attr.id}][order]"
                                                        value="0">
                                                </td>
                                            </tr>
                                            `;
                                        });
                                    });

                                    let html = `
                                    <table class="table table-bordered mt-3 align-middle">
                                        <thead>
                                            <tr>
                                                <th>GROUP</th>
                                                <th>ATTRIBUTE</th>
                                                <th>ATTRIBUTE VALUE</th>
                                                <th>HIDE</th>
                                                <th>SORTING</th>
                                            </tr>
                                        </thead>
                                        <tbody>${rows}</tbody>
                                    </table>
                                    `;

                                    $form.find('.specification-table').html(html);
                                    $('.product-specification-table p').hide();

                                    // Drag & drop sorting
                                    $form.find('.specification-table table tbody').sortable({
                                        handle: '.sort-handle',
                                        update: function() {
                                            $(this).find('tr').each(function(i) {
                                                $(this).find(
                                                    'input[name$="[order]"]'
                                                    ).val(i);
                                            });
                                        }
                                    });

                                } else {
                                    $form.find('.specification-table')
                                        .html('<p class="text-danger">No data found</p>');
                                }
                            }


                        });
                    } else {
                        $form.find('.specification-table').html('');
                        $('.product-specification-table p').show();
                    }
                });

                $('#specification_table_id').trigger('change');
            });



            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // --- Product Options Script ---
            $(document).ready(function() {
                let optionsData = @json($globalOptions ?? []);
                let globalOptionValues = @json($globalOptionsValue ?? []);
                let optionIndex = 0;

                // 1. Add New Option (Empty)
                $('#add-new-option').on('click', function() {
                    addOptionBlock();
                });

                // 2. Add Global Option
                $('.add-from-global-option').on('click', function() {
                    let selectedId = $('#global-option').val();
                    if (!selectedId || selectedId == 0) {
                        alert('Please select a global option first.');
                        return;
                    }

                    // Find the global option data
                    let globalOption = optionsData.find(opt => opt.id == selectedId);
                    if (!globalOption) {
                        alert('Global option data not found.');
                        return;
                    }

                    // Find associated values
                    globalOption.values = globalOptionValues.filter(val => val.option_id == selectedId);

                    addOptionBlock(globalOption);
                    // Reset dropdown
                     $('#global-option').val(0);
                });

                // Helper: Add Option Block
                function addOptionBlock(data = null) {
                    let index = optionIndex++;
                    let name = data ? data.name : '';
                    let type = data ? data.option_type : 'dropdown';
                    let required = (data && (data.required == 1 || data.required == '1')) ? 'checked' : '';
                    let order = data ? data.order : 0;

                    let html = `
                    <div class="accordion-item mb-3 product-option-item" data-index="${index}" style="border: 1px solid #e6e6e6; border-radius: 4px;">
                        <div class="accordion-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0">#${index + 1}</h5>
                            </div>

                            <div class="row align-items-end mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control option-name-input" name="options[${index}][name]" value="${name}" placeholder="Name">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="options[${index}][option_type]">
                                        <option value="dropdown" ${type === 'dropdown' ? 'selected' : ''}>Dropdown</option>
                                        <option value="checkbox" ${type === 'checkbox' ? 'selected' : ''}>Checkbox</option>
                                        <option value="radio" ${type === 'radio' ? 'selected' : ''}>RadioButton</option>
                                        <option value="field" ${type === 'field' ? 'selected' : ''}>Field</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="mt-4">
                                         <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="options[${index}][required]" value="1" ${required}>
                                            <span class="form-check-label">Is required?</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1 text-end">
                                    <button type="button" class="btn btn-danger btn-remove-option" style="padding: 0.5rem 0.7rem;">
                                        <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin:0;"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="option-values-section">
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered option-values-table align-middle">
                                        <thead>
                                            <tr>
                                                <th style="width: 40px;" class="text-center">#</th>
                                                <th>LABEL</th>
                                                <th>PRICE</th>
                                                <th>PRICE TYPE</th>
                                                <th style="width: 50px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-add-value">Add new row</button>
                            </div>
                        </div>
                    </div>
                    `;

                    let $block = $(html);
                    $('#accordion-product-option').append($block);

                    // Add existing values if global option
                    if (data && data.values) {
                        data.values.forEach(val => {
                            addValueRow($block.find('tbody'), index, val);
                        });
                    } else {
                         // Add one empty row by default for new options
                         addValueRow($block.find('tbody'), index);
                    }
                }

                // 3. Add Value Row
                $(document).on('click', '.btn-add-value', function() {
                    let $tbody = $(this).closest('.option-values-section').find('tbody');
                    let optionIdx = $(this).closest('.product-option-item').data('index');
                    addValueRow($tbody, optionIdx);
                });

                function addValueRow($tbody, optionIdx, data = null) {
                    let valueIndex = $tbody.find('tr').length;
                    let label = data ? data.option_value : '';
                    let price = data ? data.affect_price : 0;
                    let type = data ? data.affect_type : 0; 

                    let rowHtml = `
                    <tr>
                        <td class="text-center" style="cursor: move;">
                            <svg class="icon icon-tabler icon-tabler-arrows-sort" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                               <path d="M3 9l4 -4l4 4m-4 -4v14"></path>
                               <path d="M21 15l-4 4l-4 -4m4 4v-14"></path>
                            </svg>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="options[${optionIdx}][values][${valueIndex}][option_value]" value="${label}" placeholder="Please fill label">
                        </td>
                        <td>
                            <input type="number" step="0.01" class="form-control" name="options[${optionIdx}][values][${valueIndex}][affect_price]" value="${price}">
                        </td>
                        <td>
                            <select class="form-select" name="options[${optionIdx}][values][${valueIndex}][affect_type]">
                                <option value="0" ${type == 0 ? 'selected' : ''}>Fixed</option>
                                <option value="1" ${type == 1 ? 'selected' : ''}>Percentage</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-white btn-icon btn-remove-value" style="border: 1px solid #e6e6e6;">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                        </td>
                    </tr>
                    `;
                    $tbody.append(rowHtml);
                }

                // 4. Remove Option
                $(document).on('click', '.btn-remove-option', function() {
                    if (confirm('Are you sure you want to delete this option?')) {
                        $(this).closest('.product-option-item').remove();
                    }
                });

                // 5. Remove Value
                $(document).on('click', '.btn-remove-value', function() {
                    $(this).closest('tr').remove();
                });

                $(document).on('input', '.option-name-input', function() {
                    // let val = $(this).val();
                     // $(this).closest('.product-option-item').find('.option-title-text').text(val || 'New Option');
                });
            });
        // --- Separate Product Relations Scripts ---
        $(document).ready(function() {
            // Shared Helper: Render Results
            function renderSearchResults(products, $container) {
                if (!products || products.length === 0) {
                    $container.html('<div class="list-group-item">No products found</div>').show();
                    return;
                }

                let html = '';
                products.forEach(product => {
                    html += `
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-2 select-product-item"
                           data-id="${product.id}"
                           data-name="${product.text}"
                           data-image="${product.image}">
                            <img src="${product.image}" alt="${product.text}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                            <span>${product.text}</span>
                        </a>
                    `;
                });

                $container.html(html).show();
            }

            // Shared Helper: Get Selected IDs
            function getExistingIds($container, inputName) {
                return $container.find(`input[name="${inputName}"]`).map(function() {
                    return $(this).val();
                }).get();
            }

            // 1. Related Products Logic
            function initRelatedProductSearch() {
                const targetType = 'related-products';
                const inputName = 'related_products[]';
                const $container = $(`.box-search-input[data-target="${targetType}"]`).closest('.card-body');
                const $searchInput = $container.find('.box-search-input');
                const $resultsContainer = $container.find('.box-search-results');
                const $selectedContainer = $container.find('.box-selected-items');
                let searchTimeout;

                $searchInput.on('keyup', function() {
                    clearTimeout(searchTimeout);
                    let query = $(this).val();

                    if (query.length < 2) {
                        $resultsContainer.hide().html('');
                        return;
                    }

                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: "{{ route('admin.products.get-relations') }}",
                            type: 'GET',
                            data: {
                                q: query,
                                exclude_ids: getExistingIds($selectedContainer, inputName)
                            },
                            success: function(response) {
                                renderSearchResults(response.results, $resultsContainer);
                            },
                            error: function(err) {
                                console.error('Related Search failed', err);
                            }
                        });
                    }, 500);
                });

                $resultsContainer.on('click', '.select-product-item', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let image = $(this).data('image');

                    if ($selectedContainer.find(`#product-${targetType}-${id}`).length > 0) return;

                    let html = `
                        <div class="list-group-item d-flex justify-content-between align-items-center" id="product-${targetType}-${id}">
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="${image}" alt="${name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                <span class="fw-bold">${name}</span>
                                <input type="hidden" name="${inputName}" value="${id}">
                            </div>
                            <div class="ms-3">
                                <button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                </button>
                            </div>
                        </div>
                    `;
                    $selectedContainer.append(html);

                    $searchInput.val('');
                    $resultsContainer.hide().html('');
                });

                $selectedContainer.on('click', '.remove-selected-product', function() {
                    $(this).closest('.list-group-item').remove();
                });
            }

            // 2. Up-selling Products Logic
            function initUpSellingProductSearch() {
                const targetType = 'up-selling-products';
                const inputName = 'up_selling_products[]';
                const $container = $(`.box-search-input[data-target="${targetType}"]`).closest('.card-body');
                const $searchInput = $container.find('.box-search-input');
                const $resultsContainer = $container.find('.box-search-results');
                const $selectedContainer = $container.find('.box-selected-items');
                let searchTimeout;

                $searchInput.on('keyup', function() {
                    clearTimeout(searchTimeout);
                    let query = $(this).val();

                    if (query.length < 2) {
                        $resultsContainer.hide().html('');
                        return;
                    }

                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: "{{ route('admin.products.get-relations') }}",
                            type: 'GET',
                            data: {
                                q: query,
                                exclude_ids: getExistingIds($selectedContainer, inputName)
                            },
                            success: function(response) {
                                renderSearchResults(response.results, $resultsContainer);
                            },
                            error: function(err) {
                                console.error('Up-selling Search failed', err);
                            }
                        });
                    }, 500);
                });

                $resultsContainer.on('click', '.select-product-item', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let image = $(this).data('image');

                    if ($selectedContainer.find(`#product-${targetType}-${id}`).length > 0) return;

                    let prefix = 'up_selling'; 
                    let extraFields = `
                        <div class="d-flex gap-3 align-items-end ms-3">
                             <div style="width: 150px;">
                                <label class="form-label mb-1 small text-muted">Price</label>
                                <input type="number" step="0.01" class="form-control" name="${prefix}[${id}][price]" placeholder="0.00">
                             </div>
                             <div style="width: 120px;">
                                <label class="form-label mb-1 small text-muted">Price type</label>
                                <select class="form-select" name="${prefix}[${id}][price_type]">
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent</option>
                                </select>
                             </div>
                        </div>
                    `;

                    let html = `
                        <div class="list-group-item d-flex justify-content-between align-items-center" id="product-${targetType}-${id}">
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="${image}" alt="${name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                <span class="fw-bold">${name}</span>
                                <input type="hidden" name="${inputName}" value="${id}">
                            </div>
                            ${extraFields}
                            <div class="ms-3">
                                <button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                </button>
                            </div>
                        </div>
                    `;
                    $selectedContainer.append(html);

                    $searchInput.val('');
                    $resultsContainer.hide().html('');
                });

                $selectedContainer.on('click', '.remove-selected-product', function() {
                    $(this).closest('.list-group-item').remove();
                });
            }

            // 3. Cross-selling Products Logic
            function initCrossSellingProductSearch() {
                const targetType = 'cross-selling-products';
                const inputName = 'cross_selling_products[]';
                const $container = $(`.box-search-input[data-target="${targetType}"]`).closest('.card-body');
                const $searchInput = $container.find('.box-search-input');
                const $resultsContainer = $container.find('.box-search-results');
                const $selectedContainer = $container.find('.box-selected-items');
                let searchTimeout;

                $searchInput.on('keyup', function() {
                    clearTimeout(searchTimeout);
                    let query = $(this).val();

                    if (query.length < 2) {
                        $resultsContainer.hide().html('');
                        return;
                    }

                    searchTimeout = setTimeout(function() {
                        $.ajax({
                            url: "{{ route('admin.products.get-relations') }}",
                            type: 'GET',
                            data: {
                                q: query,
                                exclude_ids: getExistingIds($selectedContainer, inputName)
                            },
                            success: function(response) {
                                renderSearchResults(response.results, $resultsContainer);
                            },
                            error: function(err) {
                                console.error('Cross-selling Search failed', err);
                            }
                        });
                    }, 500);
                });

                $resultsContainer.on('click', '.select-product-item', function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let image = $(this).data('image');

                    if ($selectedContainer.find(`#product-${targetType}-${id}`).length > 0) return;

                    let prefix = 'cross_selling';
                    let extraFields = `
                        <div class="d-flex gap-3 align-items-end ms-3">
                             <div style="width: 150px;">
                                <label class="form-label mb-1 small text-muted">Price</label>
                                <input type="number" step="0.01" class="form-control" name="${prefix}[${id}][price]" placeholder="0.00">
                             </div>
                             <div style="width: 120px;">
                                <label class="form-label mb-1 small text-muted">Price type</label>
                                <select class="form-select" name="${prefix}[${id}][price_type]">
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent</option>
                                </select>
                             </div>
                        </div>
                    `;

                    let html = `
                        <div class="list-group-item d-flex justify-content-between align-items-center" id="product-${targetType}-${id}">
                            <div class="d-flex align-items-center flex-grow-1">
                                <img src="${image}" alt="${name}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                <span class="fw-bold">${name}</span>
                                <input type="hidden" name="${inputName}" value="${id}">
                            </div>
                            ${extraFields}
                            <div class="ms-3">
                                <button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
                                </button>
                            </div>
                        </div>
                    `;
                    $selectedContainer.append(html);

                    $searchInput.val('');
                    $resultsContainer.hide().html('');
                });

                $selectedContainer.on('click', '.remove-selected-product', function() {
                    $(this).closest('.list-group-item').remove();
                });
            }

            // Global Click to Hide Results
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.box-search-input, .box-search-results').length) {
                    $('.box-search-results').hide();
                }
            });

            // Initialize all three separately
            initRelatedProductSearch();
            initUpSellingProductSearch();
            initCrossSellingProductSearch();
        });

        // --- FAQ Script ---
        // --- FAQ Script ---
        // --- FAQ Script ---
        // --- FAQ Script (Client-Side) ---
            $(document).ready(function() {
                const $faqListContainer = $('#faq-list-container');
                const $selectedTagsContainer = $('#selected-faq-tags');
                const $repeaterContainer = $('#faq-list');

                // 2. Handle Checkbox Change (Sync Tags)
                $(document).on('change', '.faq-checkbox', function() {
                    updateSelectedTags();
                });

                // 3. Update Tags Function
                function updateSelectedTags() {
                    $selectedTagsContainer.empty();
                    
                    $('.faq-checkbox:checked').each(function() {
                        const id = $(this).val();
                        const question = $(this).data('question');
                        
                        // Create Tag
                        const tag = `
                            <div class="badge bg-blue-lt d-flex align-items-center gap-2 p-2 border" style="font-size: 0.9rem;">
                                <span class="text-truncate" style="max-width: 200px;">${question}</span>
                                <span class="cursor-pointer text-danger remove-faq-tag" data-id="${id}" style="cursor: pointer;">&times;</span>
                            </div>
                        `;
                        $selectedTagsContainer.append(tag);
                    });
                }

                // 4. Remove Tag
                $(document).on('click', '.remove-faq-tag', function() {
                    const id = $(this).data('id');
                    // Uncheck the box
                    $(`#faq-check-${id}`).prop('checked', false).trigger('change');
                });

                // Prevent dropdown closing when clicking inside search or list
                $(document).on('click', '#faq-custom-dropdown .dropdown-menu', function (e) {
                    e.stopPropagation();
                });

                // Initial Load
                updateSelectedTags();


                // --- Repeater Logic ---
                $(document).on('click', '#add-faq', function() {
                    let newIndex = $repeaterContainer.children('.repeater-item').length + Math.floor(Math.random() * 1000); // Random ID to prevent collisions
                    
                    let html = `
                        <div class="repeater-item mb-3 p-3 border rounded bg-white position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label mb-0 fw-bold">Question</label>
                                <button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                       <path d="M18 6l-12 12"></path>
                                       <path d="M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <input type="text" class="form-control mb-3" name="faq_schema_config[${newIndex}][question]" placeholder="Enter your question...">
                            
                            <label class="form-label fw-bold">Answer</label>
                            <textarea class="form-control" name="faq_schema_config[${newIndex}][answer]" rows="2" placeholder="Enter your answer..."></textarea>
                        </div>
                    `;
                    $repeaterContainer.append(html);
                });

                $(document).on('click', '.remove-repeater-item', function() {
                    if(confirm('Are you sure you want to remove this FAQ?')) {
                        $(this).closest('.repeater-item').remove();
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                var input = document.querySelector('#tag');
                if (input) {
                    var tagify = new Tagify(input, {
                        whitelist: [],
                        dropdown: {
                            maxItems: 20,
                            classname: "tags-look",
                            enabled: 0,
                            closeOnSelect: false
                        }
                    });

                    var url = input.getAttribute('data-url');
                    fetch(url)
                        .then(res => res.json())
                        .then(function(whitelist) {
                            tagify.settings.whitelist = whitelist;
                        });
                }
            });
        </script>

    @endpush
