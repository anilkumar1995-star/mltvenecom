@extends('admin-layouts.app')
@section('title','Group Create')
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
                                        href="{{ route('admin.group.Index') }}">Specification Groups</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Create Specification Group</h1>
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


            <form method="POST" action="{{ route('admin.group.store') }}" enctype="multipart/form-data" id="groupForm">
                @csrf
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="name">
                                            Name
                                        </label>
                                        <input class="form-control" data-counter="250" placeholder="Name" name="name"
                                            type="text" id="name" required>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="description">
                                            Description
                                        </label>
                                        <textarea class="form-control" data-counter="400" rows="4"
                                            placeholder="Short description" id="description" name="description"
                                            cols="50"></textarea>
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
            $("#groupForm").validate({
                rules: {
                    name: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Please Enter Name",
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
                                    window.location.href = "{{ route('admin.group.Index') }}";
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
        });
    </script>
    @endpush