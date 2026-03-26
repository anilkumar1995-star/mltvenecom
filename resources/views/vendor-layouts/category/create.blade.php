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
                                            href="{{ route('admin.dashboard') }}">Dashboard</a>
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
                <form id="categoryForm" method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="mb-3">
                                            <label class="form-label required">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control" placeholder="Name">
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
                                            <label class="form-label required" for="description">
                                                Description
                                            </label>
                                            <textarea class="form-control" rows="4"
                                                placeholder="Write your content" id="description" name="description">{{ old('description') }}</textarea>
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
                                            <input type="text" name="icon" class="form-control" placeholder="ti ti-box" value="{{ old('icon') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Featured?</label>
                                            <label class="form-check form-switch mt-2">
                                                <input class="form-check-input" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                                <span class="form-check-label">Is featured?</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category Image</label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Icon Image</label>
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
                                        <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    <div class="text-danger" id="status_errors"></div>
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
            $("#categoryForm").on('submit', function(e) {
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
