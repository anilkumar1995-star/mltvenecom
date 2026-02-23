@extends('layouts.admin')

@section('page-title', 'Create Page')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf
            
            <div class="card mb-3">
                <div class="card-header">Page Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (SEO)</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="editor" rows="10"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-2 mb-5">
                <button type="submit" class="btn btn-primary">Save Page</button>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
