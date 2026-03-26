@extends('admin-layouts.app')
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
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.products.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit product: {{ $product->name }}</h1>
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
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}" accept-charset="UTF-8"
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
                                        <div class="mb-3 ">
                                            <div class="slug-field-wrapper" data-field-name="name">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label required" for="slug">Permalink</label>
                                                    <div class="input-group input-group-flat">
                                                        <span class="input-group-text">{{ route('frontend.products.index') }}/</span>
                                                        <input class="form-control ps-0" type="text" name="slug" id="slug" required="required" value="{{ old('slug', $product->slug) }}"/>
                                                        <span class="input-group-text slug-actions">
                                                            <a href="#" class="link-secondary" data-bs-toggle="tooltip" aria-label="Generate URL" data-bb-toggle="generate-slug"><svg class="icon svg-icon-ti-ti-wand" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 21l15 -15l-3 -3l-15 15l3 3" /><path d="M15 6l3 3" /><path d="M9 3a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" /><path d="M19 13a2 2 0 0 0 2 2a2 2 0 0 0 -2 2a2 2 0 0 0 -2 -2a2 2 0 0 0 2 -2" /></svg></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">Description</label>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description', $product->description) }}</textarea>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="content">Content</label>
                                            <textarea class="form-control form-control editor-ckeditor ays-ignore" data-counter="100000" rows="4" placeholder="Write your content" id="content" name="content" cols="50">{{ old('content', $product->content) }}</textarea>
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
                                                <div id="image_preview_container" class="row g-2 mt-3">
                                                    @if(is_array($product->images))
                                                        @foreach($product->images as $img)
                                                        <div class="col-6 col-md-4 col-lg-3 existing-image-item">
                                                            <div class="card border-0 shadow-sm position-relative">
                                                                <img src="{{ str_starts_with($img, 'http') ? $img : \App\Helpers\ImageHelper::getImageUrl().$img }}" class="card-img-top rounded" style="height: 100px; object-fit: cover;">
                                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 remove-existing-img" style="border-radius: 50%; padding: 0 6px;">&times;</button>
                                                                <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
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
                                                <div id="video_preview_container" class="mt-3">
                                                    @if(!empty($product->video_media) && is_array($product->video_media))
                                                       @foreach($product->video_media as $video)
                                                            @if(isset($video['file']))
                                                            <div class="card border-0 shadow-sm">
                                                                 <video src="{{ str_starts_with($video['file'] ?? '', 'http') ? ($video['file'] ?? '') : \App\Helpers\ImageHelper::getImageUrl().($video['file'] ?? '') }}" controls class="w-100 rounded" style="max-height: 200px;"></video>
                                                                 <div class="p-2 text-center small text-muted text-truncate">Existing Video</div>
                                                            </div>
                                                            @endif
                                                       @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            function previewImages(input) {
                                                const container = document.getElementById('image_preview_container');
                                                // Clear ONLY new previews? Or append? 
                                                // If we clear, we lose existing images unless we separate containers.
                                                // Let's separate containers or just append.
                                                // The original script cleared: container.innerHTML = '';
                                                // Let's create a separate div for OLD and NEW.
                                                // Wait, I put existing images IN #image_preview_container.
                                                // If I clear, I lose them. I should rework this slightly.
                                                // Let's use a new container for NEW uploads.
                                                let newContainer = document.getElementById('new_image_preview_container');
                                                if(!newContainer) {
                                                    newContainer = document.createElement('div');
                                                    newContainer.id = 'new_image_preview_container';
                                                    newContainer.className = 'row g-2 mt-2';
                                                    container.appendChild(newContainer);
                                                }
                                                newContainer.innerHTML = ''; // Clear only new uploads preview

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
                                                                newContainer.appendChild(col);
                                                            }
                                                            reader.readAsDataURL(file);
                                                        }
                                                    });
                                                }
                                            }

                                            function previewVideo(input) {
                                                const container = document.getElementById('video_preview_container');
                                                container.innerHTML = ''; // Replace existing video preview
                                                
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
                            <!-- Specification Table -->
                            <div class="card mb-3 product-specification-table">
                                <div class="card-header">
                                    <h4 class="card-title">Specification Tables</h4>
                                    <div class="card-actions"><select class="form-select" name="specification_table_id" id="specification_table_id">
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
                                    <div class="card-header"><h4 class="card-title">Overview</h4></div>
                                    <div class="card-body">
                                        <div class="row price-group">
                                            <input class="detect-schedule d-none" name="sale_type" type="hidden" value="0">
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative"><label class="form-label">SKU</label><input class="form-control" type="text" name="sku" value="{{ old('sku', $product->sku) }}" /></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative"><label class="form-label">Price</label><div class="input-group input-group-flat"><span class="input-group-text">₹</span><input class="form-control input-mask-number" type="text" name="price" value="{{ old('price', $product->price) }}" data-thousands-separator="," data-decimal-separator="." step="any" /></div></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative"><label class="form-label">Price sale</label><div class="input-group input-group-flat"><span class="input-group-text">₹</span><input class="form-control input-mask-number" type="text" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" data-thousands-separator="," data-decimal-separator="." /></div></div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3 position-relative">
                                                     <label class="form-check"><input type="checkbox" name="price_includes_tax" class="form-check-input" value="1" {{ old('price_includes_tax', $product->price_includes_tax) ? 'checked' : '' }}><span class="form-check-label">Price includes tax</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative"><label class="form-label">Cost per item</label><div class="input-group input-group-flat"><span class="input-group-text">₹</span><input class="form-control input-mask-number" type="text" name="cost_per_item" value="{{ old('cost_per_item', $product->cost_per_item) }}" step="any" /></div></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3 position-relative"><label class="form-label">Barcode</label><input class="form-control" type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}" /></div>
                                            </div>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-check"><input type="checkbox" name="with_storehouse_management" class="form-check-input storehouse-management-status" value="1" {{ old('with_storehouse_management', $product->with_storehouse_management) ? 'checked' : '' }}><span class="form-check-label">With storehouse management</span></label>
                                        </div>
                                        <fieldset class="form-fieldset storehouse-info" style="display: {{ old('with_storehouse_management', $product->with_storehouse_management) ? 'block' : 'none' }};">
                                            <div class="mb-3 position-relative"><label class="form-label">Quantity</label><input class="form-control input-mask-number" type="text" name="quantity" value="{{ old('quantity', $product->quantity) }}" /></div>
                                            <div class="mb-3 position-relative"><label class="form-check"><input type="checkbox" name="allow_checkout_when_out_of_stock" class="form-check-input" value="1" {{ old('allow_checkout_when_out_of_stock', $product->allow_checkout_when_out_of_stock) ? 'checked' : '' }}><span class="form-check-label">Allow customer checkout when out of stock</span></label></div>
                                        </fieldset>
                                        <fieldset class="form-fieldset stock-status-wrapper">
                                            <label class="form-label">Stock status</label>
                                            <label class="form-check form-check-inline mb-3"><input type="radio" name="stock_status" class="form-check-input" value="in_stock" {{ old('stock_status', $product->stock_status) == 'in_stock' ? 'checked' : '' }}><span class="form-check-label">In stock</span></label>
                                            <label class="form-check form-check-inline mb-3"><input type="radio" name="stock_status" class="form-check-input" value="out_of_stock" {{ old('stock_status', $product->stock_status) == 'out_of_stock' ? 'checked' : '' }}><span class="form-check-label">Out of stock</span></label>
                                            <label class="form-check form-check-inline mb-3"><input type="radio" name="stock_status" class="form-check-input" value="on_backorder" {{ old('stock_status', $product->stock_status) == 'on_backorder' ? 'checked' : '' }}><span class="form-check-label">On backorder</span></label>
                                        </fieldset>
                                        
                                        <!-- Shipping -->
                                        <fieldset class="form-fieldset">
                                            <legend><h3>Shipping</h3></legend>
                                            <div class="row">
                                                <div class="col-md-3"><div class="mb-3 position-relative"><label class="form-label">Weight (g)</label><input class="form-control input-mask-number" type="text" name="weight" value="{{ old('weight', $product->weight) }}" /></div></div>
                                                <div class="col-md-3"><div class="mb-3 position-relative"><label class="form-label">Length (cm)</label><input class="form-control input-mask-number" type="text" name="length" value="{{ old('length', $product->length) }}" /></div></div>
                                                <div class="col-md-3"><div class="mb-3 position-relative"><label class="form-label">Wide (cm)</label><input class="form-control input-mask-number" type="text" name="wide" value="{{ old('wide', $product->wide) }}" /></div></div>
                                                <div class="col-md-3"><div class="mb-3 position-relative"><label class="form-label">Height (cm)</label><input class="form-control input-mask-number" type="text" name="height" value="{{ old('height', $product->height) }}" /></div></div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <!-- Attributes -->
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between"><h4 class="card-title mb-0">Attributes</h4><button type="button" class="btn btn-outline-primary btn-open-attributes">Add new attributes</button></div>
                                    <div class="card-body">
                                        <p class="text-muted">Adding new attributes helps the product to have many options.</p>
                                        <div class="product-select-attribute-item-template d-none">
                                            <div class="row align-items-center mb-3 attribute-row">
                                                <div class="col-md-5"><label>Attribute name</label><select class="form-control attr-name" name="attributes[__INDEX__][attribute_set_id]"><option value="">Select attribute</option>@foreach ($attributeSets as $set)<option value="{{ $set->id }}">{{ $set->title }}</option>@endforeach</select></div>
                                                <div class="col-md-5"><label>Value</label><select class="form-control attr-value" name="attributes[__INDEX__][attribute_id]"><option value="">Select value</option>@foreach ($attributes as $attr)<option value="{{ $attr->id }}" data-set="{{ $attr->attribute_set_id }}">{{ $attr->title }}</option>@endforeach</select></div>
                                                <div class="col-md-2 text-end"><button type="button" class="btn btn-danger btn-remove-attr mt-4" style="color:white;">🗑</button></div>
                                            </div>
                                        </div>
                                        <div class="list-product-attribute-values-wrap d-none"><div class="list-product-attribute-items-wrap"></div><button type="button" class="btn btn-light border btn-trigger-add-attribute-item mt-3">Add more attribute</button></div>
                                    </div>
                                </div>
                                
                                <!-- Product Options -->
                                <div class="card mb-3">
                                    <div class="card-header"><h4 class="card-title">Product options</h4></div>
                                    <div class="card-body">
                                        <div class="product-option-form-wrap">
                                            <div class="product-option-form-group">
                                                <div class="product-option-form-body">
                                                    <input name="has_product_options" type="hidden" value="1">
                                                    <div class="accordion" id="accordion-product-option"></div>
                                                </div>
                                                <div class="row"><div class="col col-12 col-md-4 mb-3 mb-md-0"><button class="btn add-new-option" type="button" id="add-new-option">Add new option</button></div>
                                                    <div class="col ms-auto ms-md-0 col-12 col-md-8"><div class="d-flex gap-2 align-items-start justify-content-start justify-content-md-end"><div class="mb-3 position-relative"><select class="form-select" id="global-option"><option value="0">Select Global Option</option>@if(isset($globalOptions)) @foreach($globalOptions as $globalOption) <option value="{{ $globalOption->id }}">{{ $globalOption->name }}</option> @endforeach @endif</select></div><button class="btn add-from-global-option" type="button">Add Global Option</button></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Related Products -->
                                <div class="card meta-boxes">
                                    <div class="card-header"><h4 class="card-title">Related Products</h4></div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Search products</label>
                                            <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="related-products">
                                            <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                        </div>
                                        <div id="selected-related-products" class="list-group box-selected-items">
                                            @foreach($product->relatedProducts as $item)
                                            <div class="list-group-item d-flex justify-content-between align-items-center" id="product-related-products-{{ $item->id }}">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <img src="{{ asset('uploads/'.$item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                    <input type="hidden" name="related_products[]" value="{{ $item->id }}">
                                                </div>
                                                <div class="ms-3"><button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg></button></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Up-selling Products -->
                                <div class="card meta-boxes">
                                    <div class="card-header"><h4 class="card-title">Up-selling products</h4></div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Search products</label>
                                            <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="up-selling-products">
                                            <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                        </div>
                                        <div id="selected-up-selling-products" class="list-group box-selected-items">
                                             @foreach($product->upSellingProducts as $item)
                                            <div class="list-group-item d-flex justify-content-between align-items-center" id="product-up-selling-products-{{ $item->id }}">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <img src="{{ asset('uploads/'.$item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                    <input type="hidden" name="up_selling_products[]" value="{{ $item->id }}">
                                                </div>
                                                <!-- Extra fields for up-selling logic would go here if pivot data exists, but simplest implementation just links product -->
                                                <div class="ms-3"><button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg></button></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- Cross-selling Products -->
                                <div class="card meta-boxes">
                                    <div class="card-header"><h4 class="card-title">Cross-selling products</h4></div>
                                    <div class="card-body">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Search products</label>
                                            <input type="text" class="form-control box-search-input" placeholder="Search by name..." data-target="cross-selling-products">
                                            <div class="box-search-results list-group position-absolute w-100 mt-1" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); background: #fff; border: 1px solid #e1e1e1;"></div>
                                        </div>
                                        <div id="selected-cross-selling-products" class="list-group box-selected-items">
                                             @foreach($product->crossSellingProducts as $item)
                                            <div class="list-group-item d-flex justify-content-between align-items-center" id="product-cross-selling-products-{{ $item->id }}">
                                                <div class="d-flex align-items-center flex-grow-1">
                                                    <img src="{{ asset('uploads/'.$item->image) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                                    <span class="fw-bold">{{ $item->name }}</span>
                                                    <input type="hidden" name="cross_selling_products[]" value="{{ $item->id }}">
                                                </div>
                                                <div class="ms-3"><button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product"><svg class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg></button></div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Sidebar -->
                            <div class="card meta-boxes mb-3">
                                <div class="card-header border-bottom"><h4 class="card-title">Product FAQ</h4></div>
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="form-label">Select from existing FAQs</label>
                                        <div class="dropdown" id="faq-custom-dropdown">
                                            <button class="form-select text-start d-flex justify-content-between align-items-center bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="faq-dropdown-btn"><span class="dropdown-text">Select FAQs...</span></button>
                                            <ul class="dropdown-menu w-100 p-2 shadow-sm" aria-labelledby="faq-dropdown-btn" style="max-height: 300px; overflow-y: auto;">
                                                <div id="faq-list-container">
                                                    @foreach($faqs ?? [] as $faq)
                                                        <li><div class="dropdown-item"><div class="form-check"><input class="form-check-input faq-checkbox" type="checkbox" value="{{ $faq->id }}" data-question="{{ $faq->question }}" id="faq-check-{{ $faq->id }}" name="selected_existing_faqs[]" {{ in_array($faq->id, $product->productFaqs->pluck('id')->toArray()) ? 'checked' : '' }}><label class="form-check-label w-100" for="faq-check-{{ $faq->id }}" style="cursor: pointer;">{{ $faq->question }}</label></div></div></li>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </div>
                                        <div id="selected-faq-tags" class="mt-2 d-flex flex-wrap gap-2"></div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3"><label class="form-label mb-0">Custom FAQs</label><button type="button" class="btn btn-sm btn-primary" id="add-faq">+ Add FAQ</button></div>
                                    <div id="faq-list">
                                        @if($product->faq_schema_config)
                                            @foreach($product->faq_schema_config as $key => $item)
                                                <div class="repeater-item mb-3 p-3 border rounded bg-white position-relative">
                                                     <div class="d-flex justify-content-between align-items-center mb-2"><label class="form-label mb-0 fw-bold">Question</label><button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg></button></div>
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
                            <div class="card"><div class="card-header"><h4 class="card-title">Publish</h4></div><div class="card-body"><div class="btn-list"><button class="btn btn-primary" type="submit" value="apply" name="submitter"><svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>Update</button></div></div></div>
                            <div data-bb-waypoint data-bb-target="#form-actions"></div>

                            <div class="card meta-boxes">
                                <div class="card-header"><h4 class="card-title"><label class="form-label form-label required" for="status">Status</label></h4></div>
                                <div class=" card-body">
                                     @if(auth()->check() && auth()->user()->role === 'vendor')
                                        <input type="hidden" name="status" value="pending">
                                        <select class="form-select" disabled>
                                            <option value="pending" selected>Pending</option>
                                        </select>
                                        <small class="text-muted">Product status is Pending for vendors.</small>
                                    @else
                                        <select class="form-select" required="required" id="status-select" name="status">
                                            <option value="published" {{ $product->status == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="draft" {{ $product->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                            <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label" for="store_id">Store</label></h4></div><div class=" card-body"><select class="select-search-full form-select" data-placeholder="Select a store..." data-allow-clear="true" id="store_id-select" name="store_id">@foreach ($stores as $row)<option value="{{ $row->id }}" {{ $product->store_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>@endforeach</select></div></div>
                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label" for="is_featured">Is featured?</label></h4></div><div class=" card-body"><label class="form-check form-switch d-inline-block "><input name="is_featured" type="hidden" value="0" /><input class="form-check-input" name="is_featured" type="checkbox" value="1" id="is_featured" {{ $product->is_featured ? 'checked' : '' }}/></label></div></div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label" for="is_new_until">New until</label>
                                    </h4>
                                </div>
                                <div class=" card-body">
                                    <div class="input-group datepicker">
                                        <input class="form-control" data-input placeholder="Y-m-d" readonly="readonly" name="is_new_until" type="text" id="is_new_until" value="{{ $product->is_new_until }}">
                                        <button class="btn btn-icon" data-toggle type="button">
                                            <svg class="icon icon-left svg-icon-ti-ti-calendar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M11 15h1" />
                                                <path d="M12 15v3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-icon text-danger" data-clear type="button">
                                            <svg class="icon icon-left svg-icon-ti-ti-x" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Categories</label></h4></div><div class="card-body"><div class="mb-3"><div class="input-icon"><input type="text" id="search-category-input" class="form-control" placeholder="Search..." onkeyup="filterCategories()" /><span class="input-icon-addon"><svg class="icon svg-icon-ti-ti-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg></span></div></div><div id="categories-tree"><ul class="list-unstyled">
                                @foreach ($categories->where('parent_id', 0) as $parent)
                                    <li><label class="form-check"><input type="checkbox" name="categories[]" class="form-check-input parent-category" value="{{ $parent->id }}" {{ in_array($parent->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}><span class="form-check-label">{{ $parent->name }}</span></label>
                                        @php $subcategories = $categories->where('parent_id', $parent->id); @endphp
                                        @if ($subcategories->count())
                                            <ul class="list-unstyled ms-3 mt-2">
                                                @foreach ($subcategories as $sub)
                                                    <li><label class="form-check"><input type="checkbox" name="categories[]" class="form-check-input child-category" value="{{ $sub->id }}" data-parent="{{ $parent->id }}" {{ in_array($sub->id, $product->categories->pluck('id')->toArray()) ? 'checked' : '' }}><span class="form-check-label">{{ $sub->name }}</span></label></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul></div></div></div>

                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label" for="brand_id">Brand</label></h4></div><div class=" card-body"><select class="select-search-full form-select" data-placeholder="Select a brand..." data-allow-clear="true" name="brand_id"><option value="">Select a brand...</option>@foreach ($brands as $row)<option value="{{ $row->id }}" {{ $product->brand_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>@endforeach</select></div></div>

                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Featured image (optional)</label></h4></div><div class=" card-body"><div class="image-box"><div class="preview-image-wrapper mb-1"><div class="preview-image-inner"><img id="preview-image" class="preview-image default-image" src="{{ $product->image_url }}" alt="Preview image" style="width: 150px; height: 150px; object-fit: cover; border-radius: 4px;" /></div></div><input type="file" name="image_file" id="image_file" class="form-control" accept="image/*" onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])"></div></div></div>

                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Product collections</label></h4></div><div class="card-body"><fieldset class="form-fieldset fieldset-for-multi-check-list"><div class="multi-check-list-wrapper">@foreach ($collections as $collection)<label class="form-check"><input type="checkbox" name="product_collections[]" class="form-check-input" value="{{ $collection->id }}" {{ in_array($collection->id, $product->productCollections->pluck('id')->toArray()) ? 'checked' : '' }}><span class="form-check-label">{{ $collection->name }}</span></label>@endforeach</div></fieldset></div></div>
                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Labels</label></h4></div><div class=" card-body"><fieldset class="form-fieldset fieldset-for-multi-check-list"><div class="multi-check-list-wrapper">@foreach($productionlabels as $label)<label class="form-check"><input type="checkbox" name="product_labels[]" class="form-check-input" value="{{ $label->id }}" {{ in_array($label->id, $product->productLabels->pluck('id')->toArray()) ? 'checked' : '' }}><span class="form-check-label">{{ $label->name }}</span></label>@endforeach</div></fieldset></div></div>
                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Taxes</label></h4></div><div class=" card-body"><fieldset class="form-fieldset fieldset-for-multi-check-list"><div class="multi-check-list-wrapper">@foreach($taxes as $tax)<label class="form-check"><input type="checkbox" name="taxes[]" class="form-check-input" value="{{ $tax->id }}" {{ $product->tax_id == $tax->id ? 'checked' : '' }}><span class="form-check-label">{{ $tax->title }}</span></label>@endforeach</div></fieldset></div></div>

                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Min/Max order quantity</label></h4></div><div class=" card-body"><div class="mb-3"><label class="form-label">Minimum</label><input class="form-control" name="minimum_order_quantity" type="number" value="{{ $product->minimum_order_quantity ?? 0 }}"></div><div><label class="form-label">Maximum</label><input class="form-control" name="maximum_order_quantity" type="number" value="{{ $product->maximum_order_quantity ?? 0 }}"></div></div></div>
                            <div class="card meta-boxes"><div class="card-header"><h4 class="card-title"><label class="form-label">Tags</label></h4></div><div class=" card-body"><input class="form-control" placeholder="Write some tags" data-url="{{ route('admin.product-tags.all') }}" name="tag" type="text" id="tag" value="{{ $product->tags->pluck('name')->implode(',') }}"></div></div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    @endsection

    @push('scripts')
        <script>
            // AJAX Form Submission
            $(document).ready(function() {
                $("#botble-ecommerce-forms-product-form").validate({
                    rules: { name: { required: true }, status: { required: true } },
                    messages: { name: { required: "Please Enter Product Name" }, status: { required: "Please Select Status" } },
                    errorElement: "p", errorClass: "text-danger",
                    submitHandler: function(form) {
                        var formData = new FormData(form);
                        if (typeof CKEDITOR !== 'undefined') { for (instance in CKEDITOR.instances) { CKEDITOR.instances[instance].updateElement(); } }
                        
                        $.ajax({
                            url: $(form).attr('action'),
                            type: 'POST', // Method PUT is handled by _method hidden field
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if (data.status === true || data.success === true) {
                                    Swal.fire({ icon: 'success', title: 'Success!', text: data.message }).then(() => { window.location.href = data.redirect || "{{ route('admin.products.index') }}"; });
                                } else { Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Something went wrong' }); }
                            },
                            error: function(xhr) {
                                Swal.fire({ icon: 'error', title: 'Error', text: xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Something went wrong!' });
                            }
                        });
                    }
                });

                // Remove Existing Image
                $(document).on('click', '.remove-existing-img', function() {
                    $(this).closest('.existing-image-item').remove();
                });
            });

            // Copy-Paste of Scripts from Create Page (Attributes, Options, Relations, FAQs)
            // ... (Includes logic for Attributes - addRow, toggleAddMoreVisibility, etc.)
            // ... (Includes logic for Options - addOptionBlock, addValueRow, etc.)
            // ... (Includes logic for Relations - initRelatedProductSearch, etc.)
            // ... (Includes logic for FAQs - updateSelectedTags, repeater, etc.)

            // NOTE: For brevity in this tool call, I will include the critical init logic for existing data.
            $(document).ready(function() {
                // Initialize Options
                let existingOptions = @json($product->options()->with('values')->get());
                if(existingOptions && existingOptions.length) {
                    existingOptions.forEach(opt => {
                        addOptionBlock(opt);
                    });
                }
            });
            // Re-include the full script blocks from Create Page below
        </script>
        
        <!-- FULL SCRIPTS FROM CREATE PAGE -->
        <script>
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
                    let $value = $(this).closest('.attribute-row').find('.attr-value');
                    $value.val('');
                    $value.find('option').hide();
                    $value.find('option[value=""]').show();
                    if (!setId) return;
                    let $matched = $value.find(`option[data-set="${setId}"]`);
                    $matched.show();
                    if ($matched.length) { $value.val($matched.first().val()); }
                });
                $(document).on('click', '.btn-remove-attr', function() {
                    $(this).closest('.attribute-row').remove();
                    toggleAddMoreVisibility();
                });
                function toggleAddMoreVisibility() {
                    let all = getAllAttributeSetIds();
                    let used = getUsedAttributeSetIds();
                    if (used.length < all.length) { $('.list-product-attribute-values-wrap').removeClass('d-none'); $('.btn-trigger-add-attribute-item').show(); } else { $('.btn-trigger-add-attribute-item').hide(); }
                }
                function getAllAttributeSetIds() {
                    let ids = [];
                    $('.product-select-attribute-item-template .attr-name option').not(':first').each(function() { ids.push($(this).val()); });
                    return ids;
                }
                function getUsedAttributeSetIds() {
                    let ids = [];
                    $('.attr-name').each(function() { let val = $(this).val(); if (val) ids.push(val); });
                    return ids;
                }
            });

            // OPTIONS SCRIPT
            $(document).ready(function() {
                let optionsData = @json($globalOptions ?? []);
                let globalOptionValues = @json($globalOptionsValue ?? []);
                let optionIndex = 0;
                window.addOptionBlock = function(data = null) { // Make global to call from init
                    let index = optionIndex++;
                    let name = data ? data.name : '';
                    let type = data ? data.option_type : 'dropdown';
                    let required = (data && (data.required == 1 || data.required == '1')) ? 'checked' : '';
                    let html = `
                    <div class="accordion-item mb-3 product-option-item" data-index="${index}" style="border: 1px solid #e6e6e6; border-radius: 4px;">
                        <div class="accordion-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2"><h5 class="mb-0">#${index + 1}</h5></div>
                            <div class="row align-items-end mb-3">
                                <div class="col-md-4"><label class="form-label">Name</label><input type="text" class="form-control option-name-input" name="options[${index}][name]" value="${name}" placeholder="Name"></div>
                                <div class="col-md-4"><label class="form-label">Type</label><select class="form-select" name="options[${index}][option_type]"><option value="dropdown" ${type === 'dropdown' ? 'selected' : ''}>Dropdown</option><option value="checkbox" ${type === 'checkbox' ? 'selected' : ''}>Checkbox</option><option value="radio" ${type === 'radio' ? 'selected' : ''}>RadioButton</option><option value="field" ${type === 'field' ? 'selected' : ''}>Field</option></select></div>
                                <div class="col-md-3"><div class="mt-4"><label class="form-check form-check-inline"><input type="checkbox" class="form-check-input" name="options[${index}][required]" value="1" ${required}><span class="form-check-label">Is required?</span></label></div></div>
                                <div class="col-md-1 text-end"><button type="button" class="btn btn-danger btn-remove-option" style="padding: 0.5rem 0.7rem;">X</button></div>
                            </div>
                            <div class="option-values-section"><div class="table-responsive mb-3"><table class="table table-bordered option-values-table align-middle"><thead><tr><th style="width: 40px;" class="text-center">#</th><th>LABEL</th><th>PRICE</th><th>PRICE TYPE</th><th style="width: 50px;"></th></tr></thead><tbody></tbody></table></div><button type="button" class="btn btn-outline-secondary btn-add-value">Add new row</button></div>
                        </div>
                    </div>`;
                    let $block = $(html);
                    $('#accordion-product-option').append($block);
                    if (data && data.values) { data.values.forEach(val => { addValueRow($block.find('tbody'), index, val); }); } else { addValueRow($block.find('tbody'), index); }
                }
                function addValueRow($tbody, optionIdx, data = null) {
                    let valueIndex = $tbody.find('tr').length;
                    let label = data ? data.option_value : '';
                    let price = data ? data.affect_price : 0;
                    let type = data ? data.affect_type : 0;
                    let rowHtml = `<tr><td class="text-center">⇅</td><td><input type="text" class="form-control" name="options[${optionIdx}][values][${valueIndex}][option_value]" value="${label}"></td><td><input type="number" step="0.01" class="form-control" name="options[${optionIdx}][values][${valueIndex}][affect_price]" value="${price}"></td><td><select class="form-select" name="options[${optionIdx}][values][${valueIndex}][affect_type]"><option value="0" ${type == 0 ? 'selected' : ''}>Fixed</option><option value="1" ${type == 1 ? 'selected' : ''}>Percentage</option></select></td><td class="text-center"><button type="button" class="btn btn-white btn-icon btn-remove-value">X</button></td></tr>`;
                    $tbody.append(rowHtml);
                }
                $('#add-new-option').on('click', function() { addOptionBlock(); });
                $('.add-from-global-option').on('click', function() {
                    let selectedId = $('#global-option').val();
                    if (!selectedId || selectedId == 0) { alert('Select global option'); return; }
                    let globalOption = optionsData.find(opt => opt.id == selectedId);
                    if (globalOption) { globalOption.values = globalOptionValues.filter(val => val.option_id == selectedId); addOptionBlock(globalOption); $('#global-option').val(0); }
                });
                $(document).on('click', '.btn-add-value', function() { addValueRow($(this).closest('.option-values-section').find('tbody'), $(this).closest('.product-option-item').data('index')); });
                $(document).on('click', '.btn-remove-option', function() { $(this).closest('.product-option-item').remove(); });
                $(document).on('click', '.btn-remove-value', function() { $(this).closest('tr').remove(); });
            });

            // RELATIONS SCRIPT
            $(document).ready(function() {
                function renderSearchResults(products, $container) {
                    let html = '';
                    products.forEach(product => { html += `<a href="#" class="list-group-item list-group-item-action d-flex align-items-center gap-2 select-product-item" data-id="${product.id}" data-name="${product.text}" data-image="${product.image}"><img src="${product.image}" style="width: 40px; height: 40px; border-radius: 4px;"><span>${product.text}</span></a>`; });
                    $container.html(html).show();
                }
                function getExistingIds($container, inputName) { return $container.find(`input[name="${inputName}"]`).map(function() { return $(this).val(); }).get(); }
                
                ['related', 'up-selling', 'cross-selling'].forEach(type => {
                    let target = type + '-products';
                    let inputName = type.replace('-', '_') + '_products[]';
                    let $container = $(`.box-search-input[data-target="${target}"]`).closest('.card-body');
                    let $searchInput = $container.find('.box-search-input');
                    let $results = $container.find('.box-search-results');
                    let $selected = $container.find('.box-selected-items');
                    
                    $searchInput.on('keyup', function() {
                        let query = $(this).val();
                        if(query.length < 2) { $results.hide(); return; }
                        $.ajax({ url: "{{ route('admin.products.get-relations') }}", type: 'GET', data: { q: query, exclude_ids: getExistingIds($selected, inputName) }, success: function(res) { renderSearchResults(res.results, $results); } });
                    });
                    
                    $results.on('click', '.select-product-item', function(e) {
                        e.preventDefault();
                        let id = $(this).data('id'), name = $(this).data('name'), image = $(this).data('image');
                        $selected.append(`<div class="list-group-item d-flex justify-content-between align-items-center"><div class="d-flex align-items-center flex-grow-1"><img src="${image}" style="width: 50px; height: 50px; border-radius: 4px; margin-right: 15px;"><span class="fw-bold">${name}</span><input type="hidden" name="${inputName}" value="${id}"></div><div><button type="button" class="btn btn-sm btn-icon text-danger remove-selected-product">X</button></div></div>`);
                        $results.hide().html(''); $searchInput.val('');
                    });
                });
                $(document).on('click', '.remove-selected-product', function() { $(this).closest('.list-group-item').remove(); });
                 $(document).on('click', function(e) { if (!$(e.target).closest('.box-search-input, .box-search-results').length) { $('.box-search-results').hide(); } });
            });
            
            // FAQ SCRIPT
            $(document).ready(function() {
                const $selectedTags = $('#selected-faq-tags');
                function updateSelectedTags() {
                    $selectedTags.empty();
                    $('.faq-checkbox:checked').each(function() {
                        let id = $(this).val(), q = $(this).data('question');
                        $selectedTags.append(`<div class="badge bg-blue-lt d-flex align-items-center gap-2 p-2 border"><span class="text-truncate" style="max-width: 200px;">${q}</span><span class="cursor-pointer text-danger remove-faq-tag" data-id="${id}">&times;</span></div>`);
                    });
                }
                $(document).on('change', '.faq-checkbox', updateSelectedTags);
                $(document).on('click', '.remove-faq-tag', function() { $(`#faq-check-${$(this).data('id')}`).prop('checked', false).trigger('change'); });
                updateSelectedTags();
                
                $('#add-faq').on('click', function() {
                    let newIndex = $('#faq-list .repeater-item').length + Math.floor(Math.random() * 1000);
                    $('#faq-list').append(`<div class="repeater-item mb-3 p-3 border rounded bg-white position-relative"><div class="d-flex justify-content-between align-items-center mb-2"><label class="form-label mb-0 fw-bold">Question</label><button type="button" class="btn btn-sm btn-icon text-muted remove-repeater-item">X</button></div><input type="text" class="form-control mb-3" name="faq_schema_config[${newIndex}][question]"><label class="form-label fw-bold">Answer</label><textarea class="form-control" name="faq_schema_config[${newIndex}][answer]" rows="2"></textarea></div>`);
                });
                $(document).on('click', '.remove-repeater-item', function() { if(confirm('Remove?')) $(this).closest('.repeater-item').remove(); });
            });
            
             $(document).ready(function() {
                var input = document.querySelector('#tag');
                if (input) {
                    var tagify = new Tagify(input, { whitelist: [], dropdown: { maxItems: 20, classname: "tags-look", enabled: 0, closeOnSelect: false } });
                    var url = input.getAttribute('data-url');
                    fetch(url).then(res => res.json()).then(function(whitelist) { tagify.settings.whitelist = whitelist; });
                }
            });
        </script>
    @endpush