@extends('admin-layouts.app')
@section('title', 'Edit Simple Slider')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}"><i class="fas fa-home me-1"></i> DASHBOARD</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.simple-sliders.index') }}">SIMPLE SLIDERS</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="mb-0 d-inline-block fs-6 lh-1">{{ strtoupper($slider->name) }}</span>
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
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.simple-sliders.update', $slider->id) }}" method="POST" id="sliderForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="alert alert-info d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            You are editing "<strong>English</strong>" version
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label required" for="name">
                                            Name
                                        </label>
                                        <input class="form-control" placeholder="Name" name="name" type="text" id="name" value="{{ old('name', $slider->name) }}" required>
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label required" for="key">
                                            Key
                                        </label>
                                        <input class="form-control" placeholder="Key" name="key" type="text" id="key" value="{{ old('key', $slider->key) }}" required>
                                        @error('key')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <span class="text-muted small">(0/400)</span>
                                        </div>
                                        <textarea class="form-control" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description', $slider->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Items -->
                        <div class="card mt-4">
                            <div class="card-header border-bottom-0 pb-0 d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0 fs-3 fw-normal">Slide Items</h4>
                                <button class="btn btn-light btn-sm d-flex align-items-center gap-2 px-3 py-2 border" type="button" style="background: #fff; border-color: #e6e8e9; color: #182433;" data-bs-toggle="offcanvas" data-bs-target="#sliderItemOffcanvas" onclick="resetItemForm()">
                                    <i class="fas fa-plus"></i> Add new
                                </button>
                            </div>
                            <div class="card-body pb-0 pt-3">
                                <div class="table-search-input mb-3" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Search..." style="border-radius: 4px;">
                                </div>
                            </div>
                            <div class="card-table">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th width="40" class="text-center"><input type="checkbox" class="form-check-input" id="checkAllItems"></th>
                                                <th width="40" class="text-secondary text-uppercase fs-6">#</th>
                                                <th width="80" class="text-secondary text-uppercase fs-6">IMAGE</th>
                                                <th class="text-secondary text-uppercase fs-6">TITLE</th>
                                                <th width="80" class="text-secondary text-uppercase fs-6 text-center">ORDER</th>
                                                <th width="150" class="text-secondary text-uppercase fs-6 text-center">CREATED AT</th>
                                                <th width="100" class="text-center text-secondary text-uppercase fs-6">OPERATIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($slider->sliderItems as $item)
                                            <tr data-id="{{ $item->id }}">
                                                <td class="text-center"><input type="checkbox" class="form-check-input row-checkbox-item" value="{{ $item->id }}"></td>
                                                <td class="text-center text-muted" style="cursor: move;">
                                                    <i class="fas fa-grip-vertical text-muted opacity-50"></i>
                                                </td>
                                                <td>
                                                    <div class="p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                        @if($item->image)
                                                            @php
                                                                $imageUrl = str_starts_with($item->image, 'http') ? $item->image : \App\Helpers\ImageHelper::getImageUrl() . $item->image;
                                                            @endphp
                                                            <img src="{{ $imageUrl }}" alt="" class="img-fluid" style="max-height: 100%;">
                                                        @else
                                                            <i class="fas fa-image fs-3 text-muted"></i>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td><a href="#" class="text-primary text-decoration-none fs-5 fw-normal" data-bs-toggle="offcanvas" data-bs-target="#sliderItemOffcanvas" onclick='editItem(@json($item))'>{!! nl2br(e($item->title)) !!}</a></td>
                                                <td class="text-center">{{ $item->order ?? 0 }}</td>
                                                <td class="text-center text-muted fs-5 fw-normal">{{ $item->created_at ? $item->created_at->format('Y-m-d') : now()->format('Y-m-d') }}</td>
                                                <td class="text-center">
                                                    <div class="table-actions">
                                                        <div class="btn-group">
                                                            <a href="#" class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="offcanvas" data-bs-target="#sliderItemOffcanvas" onclick='editItem(@json($item))' data-bs-title="Edit" aria-label="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" onclick="deleteItem({{ $item->id }})" class="btn btn-sm btn-icon btn-outline-danger" data-bs-toggle="tooltip" title="Delete" aria-label="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="6" class="text-center text-muted py-4">No slider items added yet.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer border-top-0 pt-0 mt-3 pb-3">
                                    <p class="m-0 text-muted small d-flex align-items-center gap-1">
                                        <i class="fas fa-globe text-muted opacity-50"></i> Show from 1 to 1 in <span class="badge bg-secondary text-white rounded-pill px-2 py-1 mx-1">{{ $slider->sliderItems->count() }}</span> records
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                        <div class="card mb-3">
                            <div class="card-header bg-light py-2">
                                <h4 class="card-title mb-0 fs-5">Shortcode</h4>
                            </div>
                            <div class="card-body py-3">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm bg-light" value='[simple-slider key="{{ $slider->key }}"]' readonly id="shortcode-input">
                                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="copyShortcode()"><i class="fas fa-copy"></i></button>
                                </div>
                                <small class="text-muted mt-1 d-block">Use this shortcode to display this slider anywhere.</small>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                    <button class="btn btn-primary" type="submit" name="submit" value="save">
                                        <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                            <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M14 4l0 4l-6 0l0 -4" />
                                        </svg>
                                        Save
                                    </button>
                                    <button class="btn btn-outline-secondary" type="submit" name="submit" value="save-exit">
                                        <i class="fa fa-arrow-left me-2"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Languages</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('vendor/core/core/base/img/flags/us.svg') }}" style="width: 24px; margin-right: 8px;">
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="translations-wrap">
                                    <div class="text-muted small mb-2 fw-bold">Translations</div>
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('vendor/core/core/base/img/flags/sa.svg') }}" style="width: 16px; margin-right: 5px;"> Arabic</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('vendor/core/core/base/img/flags/vn.svg') }}" style="width: 16px; margin-right: 5px;"> Tiếng Việt</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('vendor/core/core/base/img/flags/fr.svg') }}" style="width: 16px; margin-right: 5px;"> Français</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <label class="form-label required" for="status">Status</label>
                                </h4>
                            </div>
                            <div class="card-body">
                                <select class="form-select" required="required" id="status" name="status">
                                    <option value="published" {{ $slider->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ $slider->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Slider Item Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="sliderItemOffcanvas" aria-labelledby="sliderItemOffcanvasLabel" style="width: 500px;">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="sliderItemOffcanvasLabel">Create a new slide</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="{{ route('admin.simple-sliders.items.store', ['slider_id' => $slider->id]) }}" method="POST" enctype="multipart/form-data" id="sliderItemForm">
                @csrf
                <input type="hidden" name="_method" value="POST" id="sliderItemMethod">
                
                <div class="mb-3">
                    <label class="form-label required">Title</label>
                    <input type="text" class="form-control" name="title" id="item_title" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" class="form-control" name="subtitle" id="item_subtitle">
                </div>

                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input type="text" class="form-control" name="link" id="item_link" placeholder="https://">
                </div>

                <div class="mb-3">
                    <label class="form-label">Button label</label>
                    <input type="text" class="form-control" name="button_label" id="item_button_label">
                    <small class="text-muted mt-1 d-block">Leave empty to hide button</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="item_description" rows="3" placeholder="Short description"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort order</label>
                    <input type="number" class="form-control" name="order" id="item_order" value="0">
                </div>

                <div class="mb-3">
                    <label class="form-label required">Image</label>
                    <div class="border rounded p-3 text-center bg-light cursor-pointer" onclick="$('#item_image').click()" style="cursor: pointer;">
                        <i class="fas fa-image fs-1 text-muted mb-2" id="item_image_preview"></i>
                        <img src="" id="item_image_preview_img" class="d-none img-fluid mb-2" style="max-height: 100px; margin: 0 auto;">
                        <div class="text-primary">Choose image</div>
                        <div class="small text-muted">or <a href="#">Add from URL</a></div>
                    </div>
                    <input type="file" name="image" id="item_image" class="d-none" accept="image/*" onchange="previewImage(this, 'item_image_preview', 'item_image_preview_img')">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Background color</label>
                    <input type="color" class="form-control form-control-color" name="background_color" id="item_background_color" value="#000000" title="Choose your color">
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="hidden" name="background_color_light" value="0">
                        <input class="form-check-input" type="checkbox" name="background_color_light" id="item_background_color_light" value="1">
                        <span class="form-check-label">Background color is light?</span>
                    </label>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Tablet Image</label>
                    <div class="border rounded p-3 text-center bg-light cursor-pointer" onclick="$('#item_tablet_image').click()" style="cursor: pointer;">
                        <i class="fas fa-image fs-1 text-muted mb-2" id="item_tablet_image_preview"></i>
                        <img src="" id="item_tablet_image_preview_img" class="d-none img-fluid mb-2" style="max-height: 100px; margin: 0 auto;">
                        <div class="text-primary">Choose image</div>
                        <div class="small text-muted">or <a href="#">Add from URL</a></div>
                        <div class="small text-muted mt-2">For devices with width from 768px to 1200px, if empty, will use the image from the desktop.</div>
                    </div>
                    <input type="file" name="tablet_image" id="item_tablet_image" class="d-none" accept="image/*" onchange="previewImage(this, 'item_tablet_image_preview', 'item_tablet_image_preview_img')">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mobile Image</label>
                    <div class="border rounded p-3 text-center bg-light cursor-pointer" onclick="$('#item_mobile_image').click()" style="cursor: pointer;">
                        <i class="fas fa-image fs-1 text-muted mb-2" id="item_mobile_image_preview"></i>
                        <img src="" id="item_mobile_image_preview_img" class="d-none img-fluid mb-2" style="max-height: 100px; margin: 0 auto;">
                        <div class="text-primary">Choose image</div>
                        <div class="small text-muted">or <a href="#">Add from URL</a></div>
                        <div class="small text-muted mt-2">For devices with width less than 768px, if empty, will use the image from the tablet.</div>
                    </div>
                    <input type="file" name="mobile_image" id="item_mobile_image" class="d-none" accept="image/*" onchange="previewImage(this, 'item_mobile_image_preview', 'item_mobile_image_preview_img')">
                </div>


                <div class="offcanvas-footer border-top pt-3 d-flex justify-content-end gap-2 bg-white sticky-bottom pb-2">
                    <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background: #206bc4;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .breadcrumb-arrows .breadcrumb-item+.breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .breadcrumb-item.active a {
        color: #6c7a91;
        font-size: 11px;
        font-weight: 600;
    }
    .breadcrumb-item.active h1 {
        font-size: 11px;
    }
    .table thead th {
        background: #f8f9fa;
        border-top: none;
        border-bottom: 1px solid #e6e8e9;
        color: #6c7a91;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .datatable tr td {
        border-bottom: 1px solid #f1f1f1;
        padding: 12px 8px;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
        color: #182433;
    }
</style>
@endpush

@push('scripts')
<script>
    $('#checkAllItems').on('change', function() {
        $('.row-checkbox-item').prop('checked', $(this).prop('checked'));
    });

    const storeUrl = "{{ route('admin.simple-sliders.items.store', ['slider_id' => $slider->id]) }}";
    const updateUrlBase = "{{ url('admin/simple-sliders/items') }}";
    const baseImageUrl = "{{ \App\Helpers\ImageHelper::getImageUrl() }}";

    function getImageUrl(img) {
        if (!img) return null;
        if (img.startsWith('http')) return img;
        return baseImageUrl.replace(/\/$/, '') + '/' + img.replace(/^\//, '');
    }

    function resetItemForm() {
        $('#sliderItemOffcanvasLabel').text('Create a new slide');
        $('#sliderItemForm').attr('action', storeUrl);
        $('#sliderItemMethod').val('POST');
        $('#sliderItemForm')[0].reset();
        
        // Reset image previews
        $('[id$="_preview_img"]').addClass('d-none').attr('src', '');
        $('[id$="_preview"]').removeClass('d-none');
    }

    function editItem(item) {
        $('#sliderItemOffcanvasLabel').text('Edit slide item #' + item.id);
        $('#sliderItemForm').attr('action', updateUrlBase + '/' + item.id);
        $('#sliderItemMethod').val('PUT');
        
        // Populate fields
        $('#item_title').val(item.title);
        $('#item_link').val(item.link);
        $('#item_description').val(item.description);
        $('#item_order').val(item.order);

        // Previews logic
        if (item.image) {
            $('#item_image_preview').addClass('d-none');
            $('#item_image_preview_img').removeClass('d-none').attr('src', getImageUrl(item.image));
        } else resetPreview('item_image');
    }

    function resetPreview(id) {
        $('#' + id + '_preview').removeClass('d-none');
        $('#' + id + '_preview_img').addClass('d-none').attr('src', '');
    }

    function previewImage(input, iconId, imgId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + iconId).addClass('d-none');
                $('#' + imgId).removeClass('d-none').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/simple-sliders/items") }}/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(res) {
                        if (res.status === true) {
                            Swal.fire({ icon: 'success', title: 'Deleted!', text: res.message }).then(() => { location.reload(); });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                        }
                    }
                });
            }
        });
    }

    function copyShortcode() {
        var copyText = document.getElementById("shortcode-input");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        // Show success alert
        Swal.fire({
            icon: 'success',
            title: 'Copied!',
            text: 'Shortcode copied to clipboard',
            timer: 1500,
            showConfirmButton: false
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Initialize sorting if there's more than 1 item
    const el = document.querySelector('.datatable tbody');
    if (el && el.children.length > 1) {
        Sortable.create(el, {
            animation: 150,
            handle: '.fa-grip-vertical',
            onEnd: function (evt) {
                // Here you would normally send an AJAX request to save the new order
                console.log('Reordered item from', evt.oldIndex, 'to', evt.newIndex);
            }
        });
    }
</script>
@endpush
