@extends('admin-layouts.app')
@section('title', 'Brand Create')
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
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="https://shofy-grocery.botble.com/admin">Dashboard</a>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                            </li>
                                            <li class="breadcrumb-item">
                                                <a class="mb-0 d-inline-block fs-6 lh-1" href="https://shofy-grocery.botble.com/admin/ecommerce/brands">Brands</a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <h1 class="mb-0 d-inline-block fs-6 lh-1">New brand</h1>
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


                        <form method="POST" action="{{ route('admin.brand.update', $brand->id) }}" enctype="multipart/form-data" id="brandForm">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="gap-3 col-md-9">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-body">
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="name">
                                                        Name
                                                    </label>
                                                    <input class="form-control" data-counter="250" placeholder="Name" name="name" type="text" id="name" value="{{ $brand->name }}" required>
                                                </div>

                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="description">
                                                        Description
                                                    </label>
                                                    <textarea class="form-control" data-counter="400" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ $brand->description }}</textarea>
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="website">
                                                        Website
                                                    </label>
                                                    <input class="form-control" data-counter="120" placeholder="Ex: https://example.com" name="website" type="text" id="website" value="{{ $brand->website }}">
                                                </div>
                                                <div class="mb-3 position-relative">
                                                    <label class="form-label" for="order">
                                                        Sort order
                                                    </label>
                                                    <input class="form-control" data-counter="250" placeholder="Order by" name="order" type="number" id="order" value="{{ $brand->order }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">Publish</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="btn-list">
                                                <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card meta-boxes mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label required" for="status">Status</label>
                                            </h4>
                                        </div>
                                        <div class=" card-body">
                                            <select class="form-select" required="required" id="status" name="status">
                                                <option value="published" {{ $brand->status == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="draft" {{ $brand->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="pending" {{ $brand->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card meta-boxes mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="logo">Logo</label>
                                            </h4>
                                        </div>
                                        <div class=" card-body">
                                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*" onchange="previewImage(this)">
                                            <div id="imagePreview" class="mt-2">
                                                <img src="{{ $brand->logo ? (str_starts_with($brand->logo, 'http') ? $brand->logo : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($brand->logo, '/')) : asset('home/placeholder.png') }}" alt="Preview" id="logoPreviewImg" style="max-width: 100%; height: auto;">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card meta-boxes mb-3">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <label class="form-label" for="is_featured">Is featured?</label>
                                            </h4>
                                        </div>
                                        <div class=" card-body">
                                            <label class="form-check form-switch">
                                                <input name="is_featured" type="hidden" value="0" />
                                                <input class="form-check-input" name="is_featured" type="checkbox" value="1" id="is_featured" {{ $brand->is_featured ? 'checked' : '' }} />
                                            </label>
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
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function() {
            $("#brandForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    order: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Brand Name",
                    },
                    status: {
                        required: "Please Select Status",
                    },
                    order: {
                        required: "Please Enter Sort Order",
                    }
                },
                errorElement: "p",
                errorClass: "text-danger",
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message
                                }).then(() => {
                                    window.location.href = "{{ route('admin.brand.Index') }}";
                                });
                            } else {
                                if (data.errors) {
                                    $.each(data.errors, function(key, value) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: value[0]
                                        });
                                    });
                                }
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422 && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Validation Error',
                                        text: value[0]
                                    });
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Something went wrong!'
                                });
                            }
                        }
                    });
                }
            });

            // Hierarchical checkbox logic
            $('.parent-category').on('change', function() {
                var isChecked = $(this).prop('checked');
                $(this).closest('li').find('.child-category').prop('checked', isChecked);
            });

            $('.child-category').on('change', function() {
                if ($(this).prop('checked')) {
                    $(this).closest('ul').prev('label').find('.parent-category').prop('checked', true);
                }
            });
        });
    </script>
@endpush
