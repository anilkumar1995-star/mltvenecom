@extends('admin-layouts.app')
@section('title', 'Edit post "' . $post->name . '"')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.blog.posts.index') }}">Blog</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.blog.posts.index') }}">Posts</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Edit post "{{ $post->name }}"</h1>
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
            <div class="alert alert-info border-0 rounded-0 mb-4 py-3 px-4" style="background-color: #e8f2fc; color: #1a73e8;">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                    <span class="fs-4">You are editing "<strong>English</strong>" version</span>
                </div>
            </div>

            <form action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $post->name) }}" placeholder="Name" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label required">Permalink</label>
                                    <div class="input-group mb-1 shadow-sm">
                                        <span class="input-group-text bg-light border-end-0 text-muted px-3" style="font-size: 0.95rem;">{{ url('blog') }}/</span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="slug" id="permalink" value="{{ old('slug', $post->slug) }}" placeholder="permalink-will-be-generated-here" readonly>
                                        <button class="btn btn-outline-primary border-start-0 px-3" type="button" id="edit-slug-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                        </button>
                                    </div>
                                    <div class="mt-1 ps-1">
                                        <small class="text-muted" style="font-size: 0.85rem;">Preview: <a href="{{ url('blog/' . $post->slug) }}" id="preview-permalink" class="text-primary text-decoration-none border-bottom border-primary border-opacity-25" target="_blank">{{ url('blog') }}/{{ $post->slug }}</a></small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" name="description" placeholder="Short description">{{ old('description', $post->description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check form-switch cursor-pointer">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                        <span class="form-check-label">Is featured?</span>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0">Content</label>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-light" id="toggle-editor">Show/Hide Editor</button>
                                            <button type="button" class="btn btn-light">Add media</button>
                                            <button type="button" class="btn btn-light">UI Blocks</button>
                                        </div>
                                    </div>
                                    <textarea class="form-control editor" name="content" id="post-content" rows="15">{{ old('content', $post->content) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold">FAQ schema configuration (<a href="#" class="text-primary text-decoration-none">Learn more</a>)</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="alert alert-info border-0 rounded-3 bg-light p-3 mb-4">
                                    <div class="d-flex">
                                        <div class="me-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                            </svg>
                                        </div>
                                        <div class="fs-4 text-muted">
                                            This configuration registers FAQ structured data for SEO purposes only. It will not be displayed in your front-end theme content. The schema is embedded in the page source and can be viewed using "View Source" or tested with Google's Rich Results Test tool.<br>
                                            <a href="#" class="text-primary fw-medium text-decoration-none mt-1 d-inline-block">Test with Google Rich Results Test</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="faq-items-container">
                                    @if(isset($post->faq_schema_config) && is_array($post->faq_schema_config))
                                        @foreach($post->faq_schema_config as $index => $faq)
                                            <div class="faq-item mb-3 p-3 border rounded bg-white shadow-sm" id="faq-item-{{ $index }}">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h4 class="mb-0 fs-4 fw-bold text-dark">Question & Answer</h4>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-faq" data-id="{{ $index }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    </button>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label fs-5">Question</label>
                                                    <input type="text" name="faq_schema_config[{{ $index }}][question]" class="form-control" placeholder="Question" value="{{ $faq['question'] ?? '' }}">
                                                </div>
                                                <div>
                                                    <label class="form-label fs-5">Answer</label>
                                                    <textarea name="faq_schema_config[{{ $index }}][answer]" class="form-control" rows="2" placeholder="Answer">{{ $faq['answer'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <button type="button" class="btn btn-outline-primary px-4" id="add-faq-item">Add new</button>
                                    <span class="text-muted fs-4">or <a href="#" class="text-primary text-decoration-none fw-medium">Select from existing FAQs</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold">Search Engine Optimize</h3>
                                <a href="#" class="text-primary text-decoration-none fw-medium" id="edit-seo-btn">Edit SEO meta</a>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <p class="text-muted fs-4 mb-0">Setup meta title & description to make your site easy to discovered on search engines such as Google</p>
                                <div id="seo-meta-fields" class="mt-4" style="display: none;">
                                    <div class="mb-3">
                                        <label class="form-label">SEO Title</label>
                                        <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title', $post->seo_title) }}" placeholder="SEO Title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Description</label>
                                        <textarea class="form-control" name="seo_description" rows="3" placeholder="SEO Description">{{ old('seo_description', $post->seo_description) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Image</label>
                                        <div class="image-preview-container p-2 bg-light rounded-2 d-flex align-items-center justify-content-center cursor-pointer" style="min-height: 100px;" onclick="document.getElementById('seo_image_input').click();">
                                            <div id="seo-image-placeholder" style="{{ $post->seo_image ? 'display: none;' : '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo text-muted" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg>
                                            </div>
                                            <img id="seo-image-preview" src="{{ $post->seo_image ? Storage::url($post->seo_image) : '#' }}" alt="Preview" style="max-width: 100%; max-height: 100px; {{ $post->seo_image ? '' : 'display: none;' }}">
                                        </div>
                                        <input type="file" name="seo_image" id="seo_image_input" class="d-none" accept="image/*">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label d-block">Index</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seo_index" id="seo_index_yes" value="1" {{ old('seo_index', $post->seo_index ?? 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="seo_index_yes">Index</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seo_index" id="seo_index_no" value="0" {{ old('seo_index', $post->seo_index ?? 1) == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="seo_index_no">No index</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3 shadow-sm border-0 overflow-hidden">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold">Publish</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary d-flex align-items-center justify-content-center flex-fill py-2" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                                        Save
                                    </button>
                                    <button class="btn btn-outline-secondary d-flex align-items-center justify-content-center flex-fill py-2" type="submit" name="save_and_exit" value="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-door-exit me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 12v.01" /><path d="M3 21h18" /><path d="M5 21v-16a2 2 0 0 1 2 -2h7.5m2.5 10.5v7.5" /><path d="M14 7h7m-3 -3l3 3l-3 3" /></svg>
                                        Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold required">Status</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <select class="form-select border-1 py-2" name="status">
                                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ old('status', $post->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold">Author</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <select class="form-select border-1 py-2 mb-2" name="author_id">
                                    <option value="">Select author</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted fs-5">Select an author from admin users.</small>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0" id="category-search" placeholder="Search...">
                                    </div>
                                </div>
                                <div class="category-list scrollable" style="max-height: 250px; overflow-y: auto;">
                                    @php $postCatIds = $post->categories->pluck('id')->toArray(); @endphp
                                    @foreach($categories as $category)
                                    <div class="form-check mb-2 category-item" data-name="{{ strtolower($category->name) }}">
                                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" {{ in_array($category->id, old('categories', $postCatIds)) ? 'checked' : '' }}>
                                        <label class="form-check-label fs-4" for="cat-{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold text-dark">Image</h3>
                            </div>
                            <div class="card-body px-4 pb-4 text-center">
                                <div class="image-preview-container mb-3 p-3 bg-light rounded-3 d-flex align-items-center justify-content-center cursor-pointer" style="min-height: 150px;" onclick="document.getElementById('image').click();">
                                    @if($post->image)
                                        <img id="image-preview" src="{{ Storage::url($post->image) }}" alt="Preview" style="max-width: 100%; max-height: 200px;" class="rounded-3 shadow-sm">
                                        <div id="image-placeholder" style="display: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo text-muted" width="64" height="64" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                              <line x1="15" y1="8" x2="15.01" y2="8" />
                                              <rect x="4" y="4" width="16" height="16" rx="3" />
                                              <path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" />
                                              <path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" />
                                            </svg>
                                            <div class="mt-2 text-primary fw-medium">Choose image</div>
                                        </div>
                                    @else
                                        <div id="image-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo text-muted" width="64" height="64" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                              <line x1="15" y1="8" x2="15.01" y2="8" />
                                              <rect x="4" y="4" width="16" height="16" rx="3" />
                                              <path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" />
                                              <path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" />
                                            </svg>
                                            <div class="mt-2 text-primary fw-medium">Choose image</div>
                                        </div>
                                        <img id="image-preview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;" class="rounded-3 shadow-sm">
                                    @endif
                                </div>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="text-primary text-decoration-none fw-medium fs-4" onclick="document.getElementById('image').click(); return false;">Change</a>
                                    <span class="text-muted fs-4">or</span>
                                    <a href="#" class="text-primary text-decoration-none fw-medium fs-4">Add from URL</a>
                                </div>
                                <input type="file" name="image" id="image" class="d-none" accept="image/*">
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold text-dark">Tags</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <input type="text" class="form-control border-1 py-1" name="post_tags" value="{{ old('post_tags', $post->tags->pluck('name')->implode(', ')) }}" placeholder="Write some tags" id="tags-input">
                                <small class="text-muted mt-2 d-block">Separate tags with commas.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@push('css')
<style>
    body { background-color: #f0f2f5 !important; }
    .page-wrapper { background-color: #f0f2f5 !important; }
    .page-pretitle .breadcrumb .breadcrumb-item a { color: #1a73e8; text-decoration: none; font-size: 0.85rem; font-weight: 500; }
    .page-pretitle .breadcrumb .breadcrumb-item.active h1 { color: #495057; font-weight: 500; font-size: 0.85rem; }
    .breadcrumb-item::before { color: #adb5bd !important; }
    
    .card { border: none; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border-radius: 4px; margin-bottom: 1.5rem; }
    .card-header { border-bottom: 1px solid #f1f4f9; padding: 1.25rem 1.5rem; background-color: transparent; }
    .card-title { font-size: 1rem; font-weight: 600; color: #495057; }
    .card-body { padding: 1.5rem; }
    
    .form-label { font-weight: 600; color: #495057; margin-bottom: 0.5rem; font-size: 0.875rem; }
    .required:after { content: " *"; color: #dc3545; }
    
    .form-control, .form-select { 
        border: 1px solid #ced4da; 
        border-radius: 4px; 
        padding: 0.6rem 0.75rem;
        font-size: 0.875rem;
        color: #495057;
    }
    .form-control:focus { border-color: #86b7fe; box-shadow: none; }
    
    .input-group-text { background-color: #f8f9fa; border-color: #ced4da; color: #6c757d; font-size: 0.875rem; }
    
    .btn-primary { background-color: #1a73e8; border-color: #1a73e8; padding: 0.5rem 1.25rem; font-weight: 500; border-radius: 4px; }
    .btn-primary:hover { background-color: #1557b0; border-color: #1557b0; }
    .btn-outline-secondary { border-color: #ced4da; color: #495057; padding: 0.5rem 1.25rem; font-weight: 500; border-radius: 4px; }
    
    .alert-info { border-left: 4px solid #1a73e8 !important; }
    
    .image-preview-container {
        border: 2px dashed #dee2e6;
        transition: all 0.2s;
        border-radius: 4px;
        background-color: #f8f9fa !important;
    }
    .image-preview-container:hover { border-color: #1a73e8; background-color: #f1f4f9 !important; }
    
    /* FAQ Section */
    .faq-item { position: relative; border: 1px solid #edf2f7 !important; border-radius: 8px !important; }
    .remove-faq { border: none !important; color: #adb5bd !important; transition: color 0.2s; background: transparent !important; }
    .remove-faq:hover { color: #dc3545 !important; }
</style>
@endpush

@push('scripts')
<script>
        // Edit slug button
        $('#edit-slug-btn').on('click', function() {
            $('#permalink').prop('readonly', function(i, v) { return !v; }).focus();
            $(this).toggleClass('btn-primary btn-outline-primary');
        });

        // Simple slug generator for permalink
        $('#name').on('keyup', function() {
            if ($('#permalink').prop('readonly')) {
                var val = $(this).val();
                var slug = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
                $('#permalink').val(slug);
                $('#preview-permalink').attr('href', "{{ url('blog') }}/" + slug).text("{{ url('blog') }}/" + slug);
            }
        });
        
        $('#permalink').on('keyup', function() {
            var val = $(this).val();
            $('#preview-permalink').attr('href', "{{ url('blog') }}/" + val).text("{{ url('blog') }}/" + val);
        });

        // Category search
        $('#category-search').on('keyup', function() {
            var query = $(this).val().toLowerCase();
            $('.category-item').each(function() {
                var name = $(this).data('name');
                if (name.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Image preview
        $('#image').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#image-preview').attr('src', event.target.result).show();
                    $('#image-placeholder').hide();
                }
                reader.readAsDataURL(file);
            }
        });

        // Toggle SEO meta
        $('#edit-seo-btn').on('click', function(e) {
            e.preventDefault();
            $('#seo-meta-fields').slideToggle();
        });

        // FAQ dynamic items
        let faqIndex = {{ isset($post->faq_schema_config) && is_array($post->faq_schema_config) ? count($post->faq_schema_config) : 0 }};
        $('#add-faq-item').on('click', function() {
            let html = `
                <div class="faq-item mb-4 p-4 bg-white shadow-sm" id="faq-item-${faqIndex}" style="border: 1px solid #edf2f7; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 fs-5 fw-bold text-dark">Question & Answer</h4>
                        <button type="button" class="btn btn-link text-danger p-0 remove-faq" data-id="${faqIndex}" style="text-decoration: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6">Question</label>
                        <input type="text" name="faq_schema_config[${faqIndex}][question]" class="form-control bg-light border-0" placeholder="Question">
                    </div>
                    <div>
                        <label class="form-label fs-6">Answer</label>
                        <textarea name="faq_schema_config[${faqIndex}][answer]" class="form-control bg-light border-0" rows="3" placeholder="Answer"></textarea>
                    </div>
                </div>
            `;
            $('#faq-items-container').append(html);
            faqIndex++;
        });

        $(document).on('click', '.remove-faq', function() {
            let id = $(this).data('id');
            $(`#faq-item-${id}`).remove();
        });

        // SEO Image preview
        $('#seo_image_input').on('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#seo-image-preview').attr('src', event.target.result).show();
                    $('#seo-image-placeholder').hide();
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
@endsection
