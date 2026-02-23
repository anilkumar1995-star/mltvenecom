@extends('layouts.admin')

@section('page-title', 'Edit Page')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="card mb-3">
                <div class="card-header">Edit Page: {{ $page->name }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $page->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (SEO)</label>
                        <textarea class="form-control" name="description" rows="2">{{ $page->description }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="editor" rows="10">{{ $page->content }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ $page->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending" {{ $page->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mb-5">
                <button type="submit" class="btn btn-primary">Update Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
