@extends('admin-layouts.app')
@section('title','Create Product Tags')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a>Ecommerce</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.producttags.Index') }}">Product tags</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>New Product tags</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form method="POST" action="{{ route('admin.producttags.store') }}" id="tableForm">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4" placeholder="Short description"></textarea>
                                </div>

                                 <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" required="required" id="status" name="status">
                                        <option value="published">Published</option>
                                        <option value="draft">Draft</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>

                                <div class="col-md-3 text-end">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Save</button>
                                    </div>
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
        $("#tableForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        Swal.fire('Success!', data.message, 'success').then(() => {
                            window.location.href = "{{ route('admin.producttags.Index') }}";
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorMsg = Object.values(errors).flat().join('<br>');
                        Swal.fire('Error!', errorMsg, 'error');
                    }
                }
            });
        });
    });
</script>
@endpush
