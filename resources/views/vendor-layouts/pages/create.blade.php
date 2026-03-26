@extends('admin-layouts.app')
@section('title', 'Create Page')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.pages.index') }}">Pages</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Create Page</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    {{-- Main Content Space --}}
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3 position-relative">
                                    <label class="form-label required">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                        value="{{ old('name') }}" placeholder="Name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label class="form-label">Description (SEO)</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                        name="description" id="description" rows="4" 
                                        placeholder="Short description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 position-relative">
                                    <label class="form-label">Content</label>
                                    <div class="mb-2 btn-list">
                                        <button class="btn btn-sm btn-outline-secondary show-hide-editor-btn" type="button" data-result="content">
                                            Show/Hide Editor
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">
                                            <i class="fa fa-image me-1"></i> Add media
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" type="button">
                                            <i class="fa fa-cube me-1"></i> UI Blocks
                                        </button>
                                        <button class="btn btn-sm btn-info" type="button">
                                            <i class="fa fa-th-large me-1"></i> Visual Builder
                                        </button>
                                    </div>
                                    <textarea class="form-control editor-ckeditor ays-ignore @error('content') is-invalid @enderror" 
                                        name="content" id="content" data-counter="100000" rows="4" 
                                        placeholder="Write your content" cols="50">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar Actions --}}
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                    <button class="btn btn-primary w-100 mb-2" type="submit" name="submitter" value="apply">
                                        <i class="fa fa-save me-2"></i> Save
                                    </button>
                                    <button class="btn btn-outline-secondary w-100" type="submit" name="submitter" value="save">
                                        <i class="fa fa-sign-in-alt me-2"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4 class="card-title">Status</h4>
                            </div>
                            <div class="card-body">
                                <select name="status" class="form-select">
                                    <option value="published" {{ (old('status') == 'published') ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ (old('status') == 'draft' || !old('status')) ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ (old('status') == 'pending') ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4 class="card-title">Template</h4>
                            </div>
                            <div class="card-body">
                                <select name="template" class="form-select">
                                    <option value="default" {{ (old('template') == 'default') ? 'selected' : '' }}>Default</option>
                                    <option value="full-width" {{ (old('template') == 'full-width') ? 'selected' : '' }}>Full Width</option>
                                    <option value="homepage" {{ (old('template') == 'homepage') ? 'selected' : '' }}>Homepage</option>
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h4 class="card-title">Featured Image</h4>
                            </div>
                            <div class="card-body">
                                <div class="image-box text-center">
                                    <div class="image-box-preview mb-2">
                                        <div class="preview-image-wrapper border rounded d-flex align-items-center justify-content-center bg-light" 
                                            style="height: 150px; cursor: pointer;"
                                            onclick="document.getElementById('page-image-input').click()">
                                            <img src="https://botble.com/vendor/core/core/base/images/placeholder.png" style="opacity: 0.5; max-height: 80px;">
                                        </div>
                                    </div>
                                    <div class="image-box-actions">
                                        <input type="file" name="image" id="page-image-input" class="d-none" onchange="previewImage(this)">
                                        <a href="javascript:void(0);" class="text-primary text-decoration-none" onclick="document.getElementById('page-image-input').click()">Choose image</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function previewImage(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        let previewContainer = document.querySelector('.image-box-preview');
                                        previewContainer.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded border shadow-xs" style="max-height: 150px; cursor: pointer;" onclick="document.getElementById('page-image-input').click()">`;
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
