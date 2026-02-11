@extends('admin-layouts.app')
@section('title','Create Collection')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.collections.index') }}">Collections</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form id="collection-form" action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="card-title">Collection Details</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" name="name" class="form-control" required placeholder="e.g. Featured Products, Hot Deals">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="published">Published</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" name="is_featured" class="form-check-input">
                                        <span class="form-check-label">Featured Collection</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Save</button>
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
$('#collection-form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'), method: 'POST', data: new FormData(this), processData: false, contentType: false,
        success: function(res) { if (res.status) Swal.fire('Success', res.message, 'success').then(() => window.location.href = '{{ route("admin.collections.index") }}'); },
        error: function() { Swal.fire('Error', 'Something went wrong!', 'error'); }
    });
});
</script>
@endpush
