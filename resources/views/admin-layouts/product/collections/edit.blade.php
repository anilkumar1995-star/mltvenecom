@extends('admin-layouts.app')
@section('title','Edit Collection')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.collections.index') }}">Collections</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form id="collection-form" action="{{ route('admin.collections.update', $collection->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="card-title">Collection Details</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" name="name" class="form-control" required value="{{ $collection->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $collection->description }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="published" {{ $collection->status == 'published' ? 'selected' : '' }}>Published</option>
                                            <option value="draft" {{ $collection->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if($collection->image)
                                        <small class="text-muted">Current: {{ $collection->image }}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" name="is_featured" class="form-check-input" {{ $collection->is_featured ? 'checked' : '' }}>
                                        <span class="form-check-label">Featured Collection</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Update</button>
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
