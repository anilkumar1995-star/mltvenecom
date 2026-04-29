@extends('admin-layouts.app')
@section('title', 'Category Edit')
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
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit product category</h1>
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
                <form id="editcategoryForm" method="POST" action="{{ route('admin.category.update', $category) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3">
                                            <label class="form-label required">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                                                class="form-control" placeholder="Name">
                                            <div class="text-danger" id="name_errors"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Parent</label>
                                            <select name="parent_id" id="parent_id" class="form-select">
                                                <option value="0">None</option>
                                                @foreach ($categories as $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ old('parent_id', $category->parent_id) == $row->id ? 'selected' : '' }}>
                                                        {{ $row->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger" id="parent_id_errors"></div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label required" for="description">
                                                Description
                                            </label>
                                            <textarea class="form-control" rows="4"
                                                placeholder="Write your content" id="description" name="description">{{ old('description', $category->description) }}</textarea>
                                            <div class="text-danger" id="description_errors"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Icons & Media</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Icon Class (e.g. ti ti-home)</label>
                                            <input type="text" name="icon" class="form-control" placeholder="ti ti-box" value="{{ old('icon', $category->icon) }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Featured?</label>
                                            <label class="form-check form-switch mt-2">
                                                <input class="form-check-input" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}>
                                                <span class="form-check-label">Is featured?</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category Image</label>
                                            @if($category->image)
                                                <div class="mb-2">
                                                    <img src="{{ $category->image ? (str_starts_with($category->image, 'http') ? $category->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->image, '/')) : asset('home/placeholder.png') }}" alt="Category Image" style="height: 100px; object-fit: cover;" class="rounded border">
                                                </div>
                                            @endif
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Icon Image</label>
                                            @if($category->icon_image)
                                                <div class="mb-2">
                                                    <img src="{{ $category->icon_image ? (str_starts_with($category->icon_image, 'http') ? $category->icon_image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($category->icon_image, '/')) : asset('home/placeholder.png') }}" alt="Icon Image" style="height: 100px; object-fit: cover;" class="rounded border">
                                                </div>
                                            @endif
                                            <input type="file" name="icon_image" class="form-control" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Status</h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="status" id="status">
                                        <option value="Published" {{ old('status', $category->status) == 'Published' ? 'selected' : '' }}>Published</option>
                                        <option value="Pending" {{ old('status', $category->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    <div class="text-danger" id="status_errors"></div>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Sub Categories</h4>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSubCategory()">
                                        <i class="ti ti-plus me-1"></i> Add More
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="sub_categories_container">
                                        @php $children = $category->children; @endphp
                                        @if($children->count() > 0)
                                            @foreach($children as $child)
                                                <div class="input-group mb-2 sub-category-row">
                                                    <input type="hidden" name="sub_category_ids[]" value="{{ $child->id }}">
                                                    <input type="text" name="sub_category_names[]" value="{{ $child->name }}" class="form-control" placeholder="Subcategory Name">
                                                    <button type="button" class="btn btn-outline-danger" onclick="removeSubCategory(this, {{ $child->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                        @for($i = 0; $i < max(0, 2 - $children->count()); $i++)
                                            <div class="input-group mb-2 sub-category-row">
                                                <input type="hidden" name="sub_category_ids[]" value="">
                                                <input type="text" name="sub_category_names[]" value="" class="form-control" placeholder="Subcategory Name">
                                                <button type="button" class="btn btn-outline-danger" onclick="removeSubCategory(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        @endfor
                                    </div>
                                    <div id="removed_sub_categories"></div>
                                    <div class="text-danger" id="sub_categories_errors"></div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Publish</h4>
                                </div>
                                <div class="card-body text-end">
                                    <button class="btn btn-primary w-100" type="submit">
                                        <i class="fa fa-save me-2"></i> Save Changes
                                    </button>
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
        $(document).ready(function() {
            window.addSubCategory = function() {
                let html = `
                    <div class="input-group mb-2 sub-category-row">
                        <input type="hidden" name="sub_category_ids[]" value="">
                        <input type="text" name="sub_category_names[]" value="" class="form-control" placeholder="Subcategory Name">
                        <button type="button" class="btn btn-outline-danger" onclick="removeSubCategory(this)">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>`;
                $('#sub_categories_container').append(html);
            }

            window.removeSubCategory = function(btn, id = null) {
                if (id) {
                    $('#removed_sub_categories').append(`<input type="hidden" name="remove_sub_category_ids[]" value="${id}">`);
                }
                $(btn).closest('.sub-category-row').remove();
            }

            $("#editcategoryForm").on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let formData = new FormData(this);
                
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.text-danger').html('');
                        if (data.status === true) {
                            notify(data.message, 'success');
                            setTimeout(() => {
                                window.location.href = "{{ route('admin.category.Index') }}";
                            }, 1000);
                        } else {
                            $.each(data.errors, function(key, value) {
                                $('#' + key + '_errors').html(value[0]);
                                notify(value[0], 'error');
                            });
                        }
                    },
                    error: function(xhr) {
                        $('.text-danger').html('');
                        if (xhr.status === 422 && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('#' + key + '_errors').html(value[0]);
                            });
                            notify('Validation Error', 'error');
                        } else {
                            notify('Something went wrong!', 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
