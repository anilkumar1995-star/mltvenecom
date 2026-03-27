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

                            <div class="card mb-3">
                                <div class="card-header"><h4 class="card-title">Overview</h4></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">SKU</label>
                                            <input class="form-control" type="text" name="sku" value="{{ old('sku', $product->sku) }}" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input class="form-control" type="text" name="price" value="{{ old('price', $product->price) }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text">₹</span>
                                                <input class="form-control" type="text" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Quantity</label>
                                            <input class="form-control" type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" />
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check">
                                            <input type="checkbox" name="with_storehouse_management" class="form-check-input" value="1" {{ $product->with_storehouse_management ? 'checked' : '' }}>
                                            <span class="form-check-label">With storehouse management</span>
                                        </label>
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
        $(document).on('click', '.remove-existing-img', function() { $(this).closest('.existing-image-item').remove(); });
        
        // Specification Logic
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
        if($('#specification_table_id').val()) $('#specification_table_id').trigger('change');

        // AJAX update
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
                            Swal.fire('Updated', res.message, 'success').then(() => { window.location.href = "{{ route('frontend.vendor.products.index') }}"; }); 
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
