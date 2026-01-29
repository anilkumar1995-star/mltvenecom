@extends('admin-layouts.app')
@section('title', 'Category Create')
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
                <form id="categoryForm" method="POST" action="{{ route('admin.category.store') }}">
                    @csrf

                    <div class="row">
                        <div class="gap-3 col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control">
                                            <div class="text-danger" id="name_errors"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Parent</label>
                                            <select name="parent_id" id="parent_id" class="form-select">
                                                <option value="0">None</option>

                                                @foreach ($categories as $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ old('parent_id') == $row->id ? 'selected' : '' }}>
                                                        {{ $row->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger" id="parent_id_errors"></div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <div class="mb-2 btn-list"></div>
                                            <textarea class="form-control form-control" rows="4"
                                                placeholder="Write your content" with-short-code id="description" name="description">
                                            </textarea>
                                            <div class="text-danger" id="description_errors"></div>
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
                                    <select class="form-select" name="status" id="status">
                                        <option value="">Select Status</option>
                                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>
                                            Published
                                        </option>
                                    </select>
                                    <div class="text-danger" id="description_errors"></div>
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
            $("#categoryForm").validate({
                rules: {
                    name: {
                        required: true,
                    },
                    parent_id: {
                        required: true,
                    },
                    description : {
                        required: true,
                    },
                    status : {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Name",
                    },
                    parent_id: {
                        required: "Please Select",
                    },
                    description : {
                        required: "Please Enter Description",
                    },
                    status : {
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
