@extends('admin-layouts.app')
@section('title','Edit Product Tag')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.producttags.Index') }}">Product Tags</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>Edit Tag</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form method="POST" action="{{ route('admin.producttags.update', $tag->id) }}" id="tableForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $tag->description }}</textarea>
                                </div>

                                 <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" required="required" id="status" name="status">
                                        <option value="published" {{ $tag->status == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ $tag->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="pending" {{ $tag->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>

                                <div class="col-md-3 text-end">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Update</button>
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
                type: 'POST', // Blade @method('PUT') will handle this in PHP
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
