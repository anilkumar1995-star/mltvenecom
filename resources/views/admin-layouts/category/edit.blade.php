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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Create new product category
                                        </h1>
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
                <form id="editcategoryForm" method="POST" action="{{ route('admin.category.update', $category) }}">
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
                                            <input class="form-control" placeholder="Name" name="name" type="text"
                                                id="editname" value="{{ old('name', $category->name) }}">
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="parent_id">
                                                Parent
                                            </label>
                                            <select class="select-search-full form-select" data-allow-clear="false"
                                                id="editparent_id" name="parent_id"
                                                value="{{ old('parent_id', $category->parent_id) }}">
                                                <option value="0">None</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list"></div>
                                            <textarea class="form-control form-control"rows="4"
                                                placeholder="Write your content" with-short-code id="editdescription"
                                                value="{{ old('description', $category->description) }}" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                            <div data-bb-waypoint data-bb-target="#form-actions"></div>
                            <div class="card meta-boxes">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <label class="form-label form-label required" for="status">
                                            Status
                                        </label>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" required="required" id="editstatus" name="status">
                                        <option value="Pending"
                                            {{ old('status', $category->status) == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Published"
                                            {{ old('status', $category->status) == 'Published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        Publish
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit">
                                            Save
                                        </button>
                                    </div>
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
        $(document).ready(function() {
            $("#editcategoryForm").validate({
                rules: {
                    editname: {
                        required: true,
                    },
                    editparent_id: {
                        required: true,
                    },
                    editdescription : {
                        required: true,
                    },
                    editstatus : {
                        required: true,
                    }
                },
                messages: {
                    editname: {
                        required: "Please Enter Name",
                    },
                    editparent_id: {
                        required: "Please Select",
                    },
                    editdescription : {
                        required: "Please Enter Description",
                    },
                    editstatus : {
                        required: "Please Select Status",
                    }
                },
                errorElement: "p",
                errorPlacement: function(error, element) {
                    if (element.prop("tagName").toLowerCase() === "select") {
                        error.insertAfter(element.closest(".form-group").find(".select2"));
                    } else {
                        error.insertAfter(element);
                    }
                },
               submitHandler: function(form) {
                    form = $(form);
                    form.ajaxSubmit({
                        dataType: 'json',
                        success: function(data) {
                            $('.text-danger').html('');

                            if (data.status === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: data.message
                                }).then(() => {
                                    window.location.href = "{{ route('admin.category.Index') }}";
                                });
                            } else {
                                $.each(data.errors, function(key, value) {
                                    $('#' + key + '_errors').html(value[0]);
                                });
                            }
                        },error: function(xhr) {
                            $('.text-danger').html('');

                            if (xhr.status === 422 && xhr.responseJSON.errors) {
                                $.each(xhr.responseJSON.errors, function(key, value) {
                                    $('#' + key + '_errors').html(value[0]);
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
        });
    </script>
@endpush
