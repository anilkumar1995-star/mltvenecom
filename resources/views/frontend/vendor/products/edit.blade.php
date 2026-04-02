@extends('vendor-layouts.app')
@section('title', 'Edit Product')
@section('content')
    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.products.index') }}">Products</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit product: {{ $product->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form method="POST" action="{{ route('frontend.vendor.products.update', $product->id) }}" accept-charset="UTF-8"
                    id="botble-ecommerce-forms-product-form" class="js-base-form dirty-check" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label form-label required" for="name">Name</label>
                                            <input class="form-control" data-counter="250" placeholder="Name" required="required" name="name" type="text" id="name" value="{{ old('name', $product->name) }}">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control editor-ckeditor" data-counter="100000" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description', $product->description) }}</textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="content">Content</label>
                                            <textarea class="form-control editor-ckeditor" data-counter="100000" rows="4" placeholder="Write your content" id="content" name="content" cols="50">{{ old('content', $product->content) }}</textarea>
                                        </div>

                                        <!-- Images Upload Section -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Images</label>
                                            <div class="card p-3 border-dashed" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                                                <div class="text-center cursor-pointer mb-3" onclick="document.getElementById('product_images_input').click();">
                                                    <div class="mb-2">
                                                        <svg class="icon icon-lg text-secondary" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" /><path d="M14 14l1 -1c.67 -.644 1.45 -.824 2.182 -.54" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /></svg>
                                                    </div>
                                                    <p class="mb-0 text-muted fw-medium">Click to upload more images</p>
                                                </div>
                                                <input type="file" id="product_images_input" class="d-none" name="images[]" multiple accept="image/*" onchange="previewImages(this)">
                                                
                                                <div id="image_preview_container" class="row g-2">
                                                    @if($product->gallery_image_urls && is_array($product->gallery_image_urls))
                                                        @foreach($product->gallery_image_urls as $imgUrl)
                                                        <div class="col-3 existing-image-item">
                                                            <div class="card border-0 shadow-sm position-relative">
                                                                <img src="{{ $imgUrl }}" class="card-img-top rounded" style="height: 100px; object-fit: cover;">
                                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-img" style="border-radius: 50%; padding: 0 6px;">&times;</button>
                                                                <input type="hidden" name="existing_images[]" value="{{ str_replace(asset('storage/'), '', $imgUrl) }}">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div id="new_image_preview_container" class="row g-2 mt-2"></div>
                                            </div>
                                        </div>

                                        <!-- Video Upload Section -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Video</label>
                                            <div class="card p-3 border-dashed" style="border: 2px dashed #e2e8f0; background: #f8fafc;">
                                                 <div class="text-center cursor-pointer mb-2" onclick="document.getElementById('product_video_input').click();">
                                                    <div class="mb-2">
                                                        <svg class="icon icon-lg text-secondary" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" /><path d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" /></svg>
                                                    </div>
                                                    <p class="mb-0 text-muted fw-medium">Click to upload new video</p>
                                                </div>
                                                <input type="file" id="product_video_input" class="d-none" name="video_file" accept="video/*" onchange="previewVideo(this)">
                                                <div id="video_preview_container" class="mt-3">
                                                    @if(!empty($product->video_media) && is_array($product->video_media))
                                                        @foreach($product->video_media as $video)
                                                            @if(isset($video['file']))
                                                                <video src="{{ str_starts_with($video['file'] ?? '', 'http') ? ($video['file'] ?? '') : asset($video['file'] ?? '') }}" controls class="w-100 rounded border" style="max-height: 200px;"></video>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
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
                                                <option value="{{ $table->id }}" {{ $product->specification_table_id == $table->id ? 'selected' : '' }}>{{ $table->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                            <input class="detect-schedule d-none" name="sale_type" type="hidden" value="{{ $product->sale_type ?? 0 }}">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sku">SKU (Unique ID)</label>
                                                    <input class="form-control" type="text" name="sku" id="sku" placeholder="E.g. SOFT-001" value="{{ old('sku', $product->sku) }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="price">Price</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text currency-symbol">₹</span>
                                                        <input class="form-control input-mask-number" type="text" name="price" id="price" value="{{ old('price', $product->price) }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="sale_price">
                                                        Price sale
                                                        <span class="form-label-description ms-auto">
                                                            <a class="turn-on-schedule" href="javascript:void(0)" style="{{ $product->sale_type ? 'display:none' : '' }}">Choose Discount Period</a>
                                                            <a class="turn-off-schedule" style="{{ $product->sale_type ? '' : 'display:none' }}" href="javascript:void(0)">Cancel</a>
                                                        </span>
                                                    </label>
                                                    <div class="input-group font-weight-bold">
                                                        <span class="input-group-text currency-symbol">₹</span>
                                                        <input class="form-control input-mask-number" type="text" name="sale_price" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 scheduled-time" style="{{ $product->sale_type ? '' : 'display:none' }}">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="start_date">From date</label>
                                                    <input class="form-control form-date-time" type="text" name="start_date" id="start_date" placeholder="Y-m-d H:i:s" value="{{ old('start_date', $product->start_date) }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 scheduled-time" style="{{ $product->sale_type ? '' : 'display:none' }}">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="end_date">To date</label>
                                                    <input class="form-control form-date-time" type="text" name="end_date" id="end_date" placeholder="Y-m-d H:i:s" value="{{ old('end_date', $product->end_date) }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-check">
                                                        <input type="checkbox" name="price_includes_tax" class="form-check-input" value="1" {{ $product->price_includes_tax ? 'checked' : '' }}>
                                                        <span class="form-check-label">Price includes tax</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                                    <input class="form-control" type="text" name="barcode" id="barcode" placeholder="Enter barcode" value="{{ old('barcode', $product->barcode) }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Quantity</label>
                                                    <input class="form-control font-weight-bold" type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity ?? 0) }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input type="checkbox" name="with_storehouse_management" class="form-check-input storehouse-management-status" value="1" {{ $product->with_storehouse_management ? 'checked' : '' }}>
                                                <span class="form-check-label">With storehouse management</span>
                                            </label>
                                        </div>

                                        <fieldset class="form-fieldset storehouse-info" style="{{ $product->with_storehouse_management ? '' : 'display:none' }}">
                                            <div class="mb-3">
                                                <label class="form-check">
                                                    <input type="checkbox" name="allow_checkout_when_out_of_stock" class="form-check-input" value="1" {{ $product->allow_checkout_when_out_of_stock ? 'checked' : '' }}>
                                                    <span class="form-check-label">Allow customer checkout when this product out of stock</span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-fieldset stock-status-wrapper" style="{{ $product->with_storehouse_management ? 'display:none' : '' }}">
                                            <label class="form-label">Stock status</label>
                                            <div class="d-flex gap-3">
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="in_stock" {{ $product->stock_status == 'in_stock' ? 'checked' : '' }}>
                                                    <span class="form-check-label">In stock</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="out_of_stock" {{ $product->stock_status == 'out_of_stock' ? 'checked' : '' }}>
                                                    <span class="form-check-label">Out of stock</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input type="radio" name="stock_status" class="form-check-input" value="on_backorder" {{ $product->stock_status == 'on_backorder' ? 'checked' : '' }}>
                                                    <span class="form-check-label">On backorder</span>
                                                </label>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-fieldset mt-3 shadow-none border">
                                            <legend class="px-2 fw-bold">Shipping</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-label">Weight (g)</label>
                                                    <input class="form-control" type="number" name="weight" value="{{ old('weight', $product->weight ?? 0) }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Length (cm)</label>
                                                    <input class="form-control" type="number" name="length" value="{{ old('length', $product->length ?? 0) }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Wide (cm)</label>
                                                    <input class="form-control" type="number" name="wide" value="{{ old('wide', $product->wide ?? 0) }}" />
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Height (cm)</label>
                                                    <input class="form-control" type="number" name="height" value="{{ old('height', $product->height ?? 0) }}" />
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Attributes Section -->
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Attributes</h4>
                                    <button type="button" class="btn btn-outline-primary btn-open-attributes">Manage attributes</button>
                                </div>
                                <div class="card-body">
                                    <div class="product-select-attribute-item-template d-none">
                                        <div class="row align-items-center mb-3 attribute-row">
                                            <div class="col-md-5"><label>Attribute</label><select class="form-control attr-name" name="attributes[__INDEX__][attribute_set_id]">@foreach ($attributeSets as $set)<option value="{{ $set->id }}">{{ $set->title }}</option>@endforeach</select></div>
                                            <div class="col-md-5"><label>Value</label><select class="form-control attr-value" name="attributes[__INDEX__][attribute_id]">@foreach ($attributes as $attr)<option value="{{ $attr->id }}" data-set="{{ $attr->attribute_set_id }}">{{ $attr->title }}</option>@endforeach</select></div>
                                            <div class="col-md-2 text-end pt-4"><button type="button" class="btn btn-danger btn-remove-attr mt-1">🗑</button></div>
                                        </div>
                                    </div>
                                    <div class="list-product-attribute-values-wrap {{ ($product->productAttributes && $product->productAttributes->count()) ? '' : 'd-none' }}">
                                        <div class="list-product-attribute-items-wrap">
                                            @if($product->productAttributes)
                                                @foreach($product->productAttributes as $index => $attrItem)
                                                    <!-- Row initialization would be handled by JS or pre-rendered -->
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-light border btn-trigger-add-attribute-item mt-3">Add more attribute</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Options -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Product options</h4>
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
                                                    <button class="btn add-new-option" type="button" id="add-new-option">Add new option</button>
                                                </div>
                                                <div class="col ms-auto ms-md-0 col-12 col-md-8">
                                                    <div class="d-flex gap-2 align-items-start justify-content-start justify-content-md-end">
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
                                                        <button class="btn add-from-global-option" type="button">Add Global Option</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Related Products -->
                            <div class="card meta-boxes mb-3">
                                <div class="card-header"><h4 class="card-title">Related Products</h4></div>
                                <div class="card-body">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Search products</label>
                                        <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="related-products">
                                        <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; background: #fff; border: 1px solid #e1e1e1;"></div>
                                    </div>
                                    <div id="selected-related-products" class="list-group box-selected-items">
                                        @foreach($product->relatedProducts as $related)
                                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <img src="{{ $related->image_url }}" alt="{{ $related->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                                    <span class="fw-bold">{{ $related->name }}</span>
                                                    <input type="hidden" name="related_products[]" value="{{ $related->id }}">
                                                </div>
                                                <div><button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product">&times;</button></div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Section -->
                            <div class="card meta-boxes mb-3">
                                <div class="card-header border-bottom"><h4 class="card-title">Product FAQ</h4></div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label mb-0">Custom FAQs</label>
                                        <button type="button" class="btn btn-sm btn-primary" id="add-faq">+ Add FAQ</button>
                                    </div>
                                    <div id="faq-list">
                                        @if($product->faq_schema_config)
                                            @foreach($product->faq_schema_config as $key => $item)
                                                <div class="repeater-item mb-3 p-3 border rounded bg-white position-relative">
                                                     <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label mb-0 fw-bold">Question</label>
                                                        <button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item">&times;</button>
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

                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header"><h4 class="card-title">Publish</h4></div>
                                <div class="card-body">
                                    <button class="btn btn-primary w-100" type="submit">Update Product</button>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">Status</h4>
                                    @if($product->status == 'published')
                                        <span class="badge bg-success text-white">Published</span>
                                    @else
                                        <span class="badge bg-warning text-white">Pending Approval</span>
                                    @endif
                                </div>
                                <div class="card-body py-2 small text-muted">
                                    Current Status: <strong>{{ ucfirst($product->status) }}</strong><br>
                                    Edits will set this to <strong>Pending</strong> for re-approval.
                                    <input type="hidden" name="status" value="pending">
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header"><h4 class="card-title">Categories</h4></div>
                                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                    <ul class="list-unstyled">
                                        @foreach ($categories->where('parent_id', 0) as $parent)
                                            <li>
                                                <label class="form-check">
                                                    <input type="checkbox" name="categories[]" class="form-check-input parent-category" value="{{ $parent->id }}" {{ in_array($parent->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <span class="form-check-label">{{ $parent->name }}</span>
                                                </label>
                                                @php $subcats = $categories->where('parent_id', $parent->id); @endphp
                                                @if ($subcats->count())
                                                    <ul class="list-unstyled ms-3 mt-1">
                                                        @foreach ($subcats as $sub)
                                                            <li>
                                                                <label class="form-check">
                                                                    <input type="checkbox" name="categories[]" class="form-check-input child-category" value="{{ $sub->id }}" data-parent="{{ $parent->id }}" {{ in_array($sub->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
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

                            <div class="card mb-3">
                                <div class="card-header"><h4 class="card-title">Featured Image</h4></div>
                                <div class="card-body text-center">
                                    <img id="preview-image" src="{{ $product->image_url }}" alt="Preview" style="width: 100%; height: 160px; object-fit: cover; border-radius: 4px; border: 1px solid #e1e1e1;">
                                    <input type="file" name="image_file" class="form-control mt-2" accept="image/*" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Tags</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" name="tag" id="tag" data-url="{{ route('frontend.vendor.product-tags.all') }}" placeholder="Write some tags" value="{{ $product->tags->pluck('name')->implode(',') }}">
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Minimum Order Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" type="number" name="minimum_order_quantity" value="{{ old('minimum_order_quantity', $product->minimum_order_quantity ?? 1) }}" min="1">
                                    <small class="text-muted mt-1 d-block font-size-xs">Minimum quantity to place an order, if the value is 0, there is no limit.</small>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Maximum Order Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input class="form-control" type="number" name="maximum_order_quantity" value="{{ old('maximum_order_quantity', $product->maximum_order_quantity ?? 0) }}" min="0">
                                    <small class="text-muted mt-1 d-block font-size-xs">Maximum quantity to place an order, if the value is 0, there is no limit.</small>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Product collections</h4>
                                </div>
                                <div class="card-body">
                                    <div style="max-height: 200px; overflow-y: auto;">
                                        @php $pCollections = $product->productCollections->pluck('id')->toArray(); @endphp
                                        @foreach ($collections as $collection)
                                            <label class="form-check mb-1">
                                                <input type="checkbox" name="product_collections[]" class="form-check-input" value="{{ $collection->id }}" {{ in_array($collection->id, $pCollections) ? 'checked' : '' }}>
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
                                        @php $pLabels = $product->productLabels->pluck('id')->toArray(); @endphp
                                        @foreach ($productionlabels as $label)
                                            <label class="form-check mb-1">
                                                <input type="checkbox" name="product_labels[]" class="form-check-input" value="{{ $label->id }}" {{ in_array($label->id, $pLabels) ? 'checked' : '' }}>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    function previewImages(input) {
        const container = document.getElementById('new_image_preview_container');
        container.innerHTML = '';
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    container.innerHTML += `<div class="col-3"><img src="${e.target.result}" class="img-fluid rounded border" style="height: 80px; width:100%; object-fit: cover;"></div>`;
                };
                reader.readAsDataURL(file);
            });
        }
    }
    function previewVideo(input) {
        const container = document.getElementById('video_preview_container');
        container.innerHTML = '';
        if (input.files && input.files[0]) {
            container.innerHTML = `<video src="${URL.createObjectURL(input.files[0])}" controls class="w-100 rounded border" style="max-height: 200px;"></video>`;
        }
    }

    $(document).ready(function() {
        // Remove Existing Image
        $(document).on('click', '.remove-existing-img', function() { $(this).closest('.existing-image-item').remove(); });

        // Sale Schedule Toggle
        $(document).on('click', '.turn-on-schedule', function() {
            $('.scheduled-time').show();
            $('.turn-on-schedule').hide();
            $('.turn-off-schedule').show();
            $('input[name="sale_type"]').val(1);
        });
        $(document).on('click', '.turn-off-schedule', function() {
            $('.scheduled-time').hide();
            $('.turn-on-schedule').show();
            $('.turn-off-schedule').hide();
            $('input[name="sale_type"]').val(0);
        });

        // Storehouse Management Toggle
        $(document).on('change', '.storehouse-management-status', function() {
            if($(this).is(':checked')) {
                $('.storehouse-info').show();
                $('.stock-status-wrapper').hide();
            } else {
                $('.storehouse-info').hide();
                $('.stock-status-wrapper').show();
            }
        });

        // Tagify
        var tagInput = document.querySelector('#tag');
        if (tagInput) {
            var tagify = new Tagify(tagInput, {
                whitelist: [],
                dropdown: { enabled: 0 }
            });
            fetch(tagInput.getAttribute('data-url'))
                .then(res => res.json())
                .then(whitelist => {
                    tagify.settings.whitelist = whitelist.map(t => typeof t === 'string' ? t : (t.name || t.text));
                });
        }

        // --- ATTRIBUTES LOGIC ---
        let attributeIndex = 0;
        $('.btn-open-attributes').on('click', function() {
            $('.list-product-attribute-values-wrap').removeClass('d-none');
            $('.list-product-attribute-items-wrap').empty();
            attributeIndex = 0;
            // Add all available sets by default or let user choose? 
            // In Admin Create, it adds all.
            @json($attributeSets).forEach(set => addAttributeRow(set.id));
        });

        $('.btn-trigger-add-attribute-item').on('click', function() {
            addAttributeRow();
        });

        function addAttributeRow(setId = '') {
            let template = $('.product-select-attribute-item-template').html();
            template = template.replace(/__INDEX__/g, attributeIndex++);
            let $row = $(template);
            $('.list-product-attribute-items-wrap').append($row);
            if(setId) {
                $row.find('.attr-name').val(setId).trigger('change');
            }
        }

        $(document).on('change', '.attr-name', function() {
            let setId = $(this).val();
            let $valueSelect = $(this).closest('.attribute-row').find('.attr-value');
            $valueSelect.find('option').hide();
            $valueSelect.find('option[value=""]').show();
            if(setId) {
                $valueSelect.find(`option[data-set="${setId}"]`).show();
            }
            $valueSelect.val('');
        });

        $(document).on('click', '.btn-remove-attr', function() {
            $(this).closest('.attribute-row').remove();
        });

        // --- OPTIONS LOGIC ---
        let optionIndex = 0;
        let globalOptions = @json($globalOptions ?? []);
        let globalOptionValues = @json($globalOptionsValue ?? []);

        window.addOptionBlock = function(data = null) {
            let index = optionIndex++;
            let name = data ? (data.name || data.option_value || '') : '';
            let type = data ? (data.option_type || 'dropdown') : 'dropdown';
            let required = (data && (data.required == 1)) ? 'checked' : '';
            
            let html = `
            <div class="accordion-item mb-3 product-option-item" data-index="${index}" style="border: 1px solid #e6e6e6; border-radius: 4px;">
                <div class="accordion-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="mb-0">#${index + 1}</h5>
                        <button type="button" class="btn btn-danger btn-sm btn-remove-option">&times;</button>
                    </div>
                    <div class="row align-items-end mb-3">
                        <div class="col-md-5">
                            <label class="form-label">Option Name</label>
                            <input type="text" class="form-control" name="options[${index}][name]" value="${name}" placeholder="E.g. Size, Color">
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
                            <label class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="options[${index}][required]" value="1" ${required}>
                                <span class="form-check-label">Is required?</span>
                            </label>
                        </div>
                    </div>
                    <div class="option-values-section">
                        <table class="table table-bordered table-sm">
                            <thead><tr><th>Label</th><th>Price Add-on</th><th>Price Type</th><th width="50"></th></tr></thead>
                            <tbody></tbody>
                        </table>
                        <button type="button" class="btn btn-outline-secondary btn-sm btn-add-value">Add Value</button>
                    </div>
                </div>
            </div>`;
            
            let $block = $(html);
            $('#accordion-product-option').append($block);
            
            if (data && data.values) {
                data.values.forEach(val => addValueRow($block.find('tbody'), index, val));
            } else if (data && data.option_value) {
                 // Handle simple value if passed (unlikely given schema but defensive)
                 addValueRow($block.find('tbody'), index, data);
            } else {
                addValueRow($block.find('tbody'), index);
            }
        }

        function addValueRow($tbody, optIdx, data = null) {
            let valIdx = $tbody.find('tr').length;
            let label = data ? (data.option_value || '') : '';
            let price = data ? (data.affect_price || 0) : 0;
            let type = data ? (data.affect_type || 0) : 0;
            
            let row = `
            <tr>
                <td><input type="text" class="form-control form-control-sm" name="options[${optIdx}][values][${valIdx}][option_value]" value="${label}"></td>
                <td><input type="number" step="0.01" class="form-control form-control-sm" name="options[${optIdx}][values][${valIdx}][affect_price]" value="${price}"></td>
                <td>
                    <select class="form-select form-select-sm" name="options[${optIdx}][values][${valIdx}][affect_type]">
                        <option value="0" ${type == 0 ? 'selected' : ''}>Fixed</option>
                        <option value="1" ${type == 1 ? 'selected' : ''}>Percentage</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-link text-danger btn-remove-value p-0">&times;</button></td>
            </tr>`;
            $tbody.append(row);
        }

        $('#add-new-option').on('click', () => addOptionBlock());
        $('.add-from-global-option').on('click', function() {
            let id = $('#global-option').val();
            if(!id || id == 0) return;
            let opt = globalOptions.find(o => o.id == id);
            if(opt) {
                opt.values = globalOptionValues.filter(v => v.option_id == id);
                addOptionBlock(opt);
                $('#global-option').val(0);
            }
        });

        $(document).on('click', '.btn-remove-option', function() { $(this).closest('.product-option-item').remove(); });
        $(document).on('click', '.btn-remove-value', function() { $(this).closest('tr').remove(); });
        $(document).on('click', '.btn-add-value', function() {
            addValueRow($(this).closest('.option-values-section').find('tbody'), $(this).closest('.product-option-item').data('index'));
        });

        // Initialize Existing Options
        let existingOptions = @json($product->options()->with('values')->get());
        if(existingOptions && existingOptions.length) {
            existingOptions.forEach(opt => addOptionBlock(opt));
        }

        // --- RELATIONS LOGIC ---
        $('.box-search-input').on('keyup', function() {
            let query = $(this).val();
            let $results = $(this).siblings('.box-search-results');
            let target = $(this).data('target');
            if(query.length < 2) { $results.hide(); return; }
            
            $.get("{{ route('frontend.vendor.products.get-relations') }}", { q: query }, function(res) {
                let html = '';
                res.results.forEach(p => {
                    html += `<a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-2 select-product-item" data-id="${p.id}" data-name="${p.text}" data-image="${p.image}">
                        <img src="${p.image}" style="width:30px; height:30px; object-fit:cover; border-radius:3px;">
                        <span>${p.text}</span>
                    </a>`;
                });
                $results.html(html).show();
            });
        });

        $(document).on('click', '.select-product-item', function(e) {
            e.preventDefault();
            let id = $(this).data('id'), name = $(this).data('name'), img = $(this).data('image');
            let $container = $(this).closest('.card-body').find('.box-selected-items');
            let nameAttr = 'related_products[]';
            
            if($container.find(`input[value="${id}"]`).length) return;

            $container.append(`
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center flex-grow-1">
                    <img src="${img}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                    <span class="fw-bold">${name}</span>
                    <input type="hidden" name="${nameAttr}" value="${id}">
                </div>
                <button type="button" class="btn btn-sm text-danger remove-selected-product">&times;</button>
            </div>`);
            $(this).parent().hide();
        });

        $(document).on('click', '.remove-selected-product', function() { $(this).closest('.list-group-item').remove(); });

        // --- FAQ LOGIC ---
        $('#add-faq').on('click', function() {
            let index = $('#faq-list .repeater-item').length + Date.now();
            $('#faq-list').append(`
            <div class="repeater-item mb-3 p-3 border rounded bg-white position-relative">
                 <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label mb-0 fw-bold">Question</label>
                    <button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item">&times;</button>
                 </div>
                 <input type="text" class="form-control mb-3" name="faq_schema_config[${index}][question]">
                 <label class="form-label fw-bold">Answer</label>
                 <textarea class="form-control" name="faq_schema_config[${index}][answer]" rows="2"></textarea>
            </div>`);
        });
        $(document).on('click', '.remove-repeater-item', function() { $(this).closest('.repeater-item').remove(); });

        // --- SPECIFICATION LOGIC ---
        $('#specification_table_id').on('change', function() {
            let id = $(this).val();
            if (!id) { $('.specification-table').empty(); return; }
            $.post("{{ route('frontend.vendor.getatablesData') }}", { group_id: id, _token: "{{ csrf_token() }}" }, function(res) {
                 if (res.data) {
                    let rows = res.data.flatMap(g => g.attributes.map(a => `<tr><td>${g.name}</td><td>${a.name}</td><td><input type="text" class="form-control" name="specs[${g.id}][${a.id}][value]"></td></tr>`)).join('');
                    $('.specification-table').html('<table class="table table-sm table-bordered mt-2"><tbody>'+rows+'</tbody></table>');
                 }
            });
        });

        // --- SUBMISSION LOGIC ---
        $('#botble-ecommerce-forms-product-form').validate({
            submitHandler: function(form) {
                var formData = new FormData(form);
                if (typeof CKEDITOR !== 'undefined') { for (instance in CKEDITOR.instances) CKEDITOR.instances[instance].updateElement(); }
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status) { 
                            Swal.fire('Updated!', res.message, 'success').then(() => { window.location.href = "{{ route('frontend.vendor.products.index') }}"; }); 
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
    });
</script>
@endpush
