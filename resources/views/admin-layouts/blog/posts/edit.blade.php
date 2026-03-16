@extends('admin-layouts.app')
@section('title', 'Edit post "' . $post->name . '"')

@section('content')
<div class="page-wrapper" id="main-content">
    <!-- Sticky Header -->
    <div class="card toolbar-fixed" id="sticky-header" style="display: none; position: fixed; top: 0; right: 0; width: calc(100% - 0px); z-index: 1030; border-radius: 0; border: none; border-bottom: 1px solid #e5e7eb; padding: 10px 0; background: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col">
                    <ol class="breadcrumb mb-0" style="background: transparent; padding: 0;">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="text-transform: none; font-size: 13px; color: #1a73e8;">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.posts.index') }}" style="text-transform: none; font-size: 13px; color: #1a73e8;">Blog</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.blog.posts.index') }}" style="text-transform: none; font-size: 13px; color: #1a73e8;">Posts</a></li>
                        <li class="breadcrumb-item active" style="text-transform: none; font-size: 13px; color: #64748b; font-weight: 400;">Edit post "{{ $post->name }}"</li>
                    </ol>
                </div>
                <div class="col-auto">
                    <div class="btn-list">
                        <button type="submit" form="postForm" class="btn btn-primary px-3 py-2 fw-bold" style="background: #206bc4 !important; border-color: #206bc4 !important; font-size: 14px;">
                            <i class="fas fa-save me-2"></i> Save
                        </button>
                        <button type="submit" form="postForm" name="save_and_exit" value="1" class="btn btn-white px-3 py-2 fw-bold" style="background: #fff; border-color: #d1d5db; color: #374151; font-size: 14px;">
                            <i class="fas fa-sign-out-alt me-2"></i> Save & Exit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header d-print-none mb-3">
        <div class="container-xl">
            <div class="row align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mt-2" style="background: transparent; padding: 0; margin-bottom: 0;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" style="color: #1a73e8; font-size: 13px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.blog.posts.index') }}" style="color: #1a73e8; font-size: 13px;">Blog</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.blog.posts.index') }}" style="color: #1a73e8; font-size: 13px;">Posts</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page" style="color: #64748b; font-size: 13px;">Edit post "{{ $post->name }}"</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body">
        <div class="container-xl">
            <!-- Language Alert -->
            <div class="alert alert-info border-0 rounded-0 mb-4 py-3 px-4" style="background-color: #e8f2fc; color: #1a73e8; border-left: 4px solid #1a73e8 !important;">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                    <span class="fs-4">You are editing "<strong>English</strong>" version</span>
                </div>
            </div>

            <form action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST" id="postForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label required fw-bold mb-2">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" required data-counter="250" value="{{ old('name', $post->name) }}" style="padding: 10px 14px;">
                                    @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required fw-bold mb-1">Permalink</label>
                                    <div class="input-group input-group-flat shadow-none border" style="border-radius: 4px;">
                                        <span class="input-group-text bg-transparent border-0 text-muted px-2" style="font-size: 13px; color: #64748b !important;">
                                            {{ url('blog') }}/
                                        </span>
                                        <input type="text" class="form-control ps-0 bg-transparent border-0" name="slug" id="permalink" value="{{ old('slug', $post->slug) }}" placeholder="permalink" readonly style="font-size: 13px; color: #1e293b;">
                                        <span class="input-group-text bg-transparent border-0 px-2">
                                            <a href="#" class="text-muted p-0" id="edit-slug-btn" title="Edit slug" data-bs-toggle="tooltip">
                                                <i class="fas fa-edit" style="font-size: 14px;"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <div class="mt-1 small" style="font-size: 12px; color: #64748b;">Preview: <a href="{{ url('blog/' . $post->slug) }}" id="preview-permalink" target="_blank" style="color: #1a73e8; text-decoration: none;">{{ url('blog') }}/{{ $post->slug }}</a></div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold mb-2">Description</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Short description" data-counter="400" style="padding: 10px 14px;">{{ old('description', $post->description) }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-check form-switch cursor-pointer">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                                        <span class="form-check-label fw-bold ps-2" style="font-size: 14px; padding-top: 2px;">Is featured?</span>
                                    </label>
                                </div>

                                <div class="mb-0">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <label class="form-label required fw-bold mb-0">Content</label>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-white shadow-sm border show-hide-editor-btn" data-result="post-content" style="background: #fff; color: #182433; font-size: 13px; font-weight: 500; height: 35px; border-color: #dce1e7 !important;">Show/Hide Editor</button>
                                            <button type="button" class="btn btn-white shadow-sm border btn_gallery" data-result="post-content" data-action="media-insert-ckeditor" data-multiple="true" style="background: #fff; color: #182433; font-size: 13px; font-weight: 500; height: 35px; border-color: #dce1e7 !important;"><i class="far fa-image me-1"></i> Add media</button>
                                            <button type="button" class="btn btn-white shadow-sm border" data-bb-toggle="shortcode-list-modal" data-result="post-content" style="background: #fff; color: #182433; font-size: 13px; font-weight: 500; height: 35px; border-color: #dce1e7 !important;"><i class="fas fa-cube me-1"></i> UI Blocks</button>
                                        </div>
                                    </div>
                                    <textarea class="form-control editor-ckeditor" name="content" id="post-content" rows="5">{{ old('content', $post->content) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Section -->
                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">FAQ schema configuration (<a href="#" class="text-primary text-decoration-none" style="font-weight: 400; font-size: 12px;">Learn more</a>)</h3>
                            </div>
                            <div class="card-body p-3">
                                <div class="alert alert-info border-0 rounded-0 p-3 mb-3" style="background-color: #f1f5f9; color: #475569; border-left: 3px solid #64748b !important;">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle text-secondary" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="9"></circle>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                                <polyline points="11 12 12 12 12 16 13 16"></polyline>
                                            </svg>
                                        </div>
                                        <div style="font-size: 13px; line-height: 1.4;">
                                            This configuration registers FAQ structured data for SEO purposes only. It will not be displayed in your front-end theme content.
                                        </div>
                                    </div>
                                </div>
                                <div id="faq-items-container">
                                    @if(isset($post->faq_schema_config) && is_array($post->faq_schema_config))
                                        @foreach($post->faq_schema_config as $index => $faq)
                                            <div class="faq-item mb-4 p-4 bg-white shadow-sm" id="faq-item-{{ $index }}" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="mb-0 fs-5 fw-bold" style="color: #334155;">Question & Answer</h4>
                                                    <button type="button" class="btn btn-link text-danger p-0 remove-faq" data-id="{{ $index }}">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Question</label>
                                                    <input type="text" name="faq_schema_config[{{ $index }}][question]" class="form-control" placeholder="Question" value="{{ $faq['question'] ?? '' }}">
                                                </div>
                                                <div>
                                                    <label class="form-label fw-bold">Answer</label>
                                                    <textarea name="faq_schema_config[{{ $index }}][answer]" class="form-control" rows="3" placeholder="Answer">{{ $faq['answer'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="d-flex align-items-center gap-2 mt-2">
                                    <button type="button" class="btn btn-white border px-3 py-1" id="add-faq-item" style="border-radius: 4px; font-weight: 600; font-size: 13px; background: #fff; color: #1e293b;">Add new</button>
                                    <span class="text-muted" style="font-size: 12px;">or <a href="#" class="text-primary text-decoration-none fw-bold">Select from existing FAQs</a></span>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Meta Section -->
                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header d-flex justify-content-between align-items-center bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Search Engine Optimize (SEO)</h3>
                                <a href="#" class="text-primary fw-bold p-0 text-decoration-none" id="edit-seo-btn" style="font-size: 12px;">Edit SEO meta</a>
                            </div>
                            <div class="card-body p-3">
                                <div id="seo-preview" class="border py-3 px-3 shadow-none mb-3" style="border: 1px solid #e5e7eb !important; border-radius: 4px !important; background: #fff;">
                                    <h4 class="mb-1" id="seo-preview-title" style="color: #1a0dab; font-family: arial,sans-serif; font-size: 18px; font-weight: 400; line-height: 1.2; cursor: pointer;">{{ old('seo_title', $post->seo_title ?: $post->name) }}</h4>
                                    <div class="mb-1" id="seo-preview-url" style="color: #006621; font-family: arial,sans-serif; font-size: 14px; line-height: 1.2;">{{ url('blog') }}/{{ $post->slug }}</div>
                                    <p class="mb-0" id="seo-preview-description" style="color: #4d5156; font-family: arial,sans-serif; font-size: 14px; line-height: 1.4;">{{ old('seo_description', $post->seo_description ?: $post->description) ?: 'Short description for the post will appear here in search engine results.' }}</p>
                                </div>
                                
                                <div id="seo-meta-fields" style="display: none;" class="mt-4 pt-4 border-top">
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-2">SEO Title</label>
                                        <input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="SEO Title" data-counter="70" value="{{ old('seo_title', $post->seo_title) }}" style="padding: 10px 14px;">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-2">SEO Description</label>
                                        <textarea class="form-control" name="seo_description" id="seo_description" rows="3" placeholder="SEO Description" data-counter="160" style="padding: 10px 14px;">{{ old('seo_description', $post->seo_description) }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label fw-bold mb-2">SEO Image</label>
                                        <div class="image-box text-center border rounded p-4 bg-light cursor-pointer" onclick="document.getElementById('seo_image_input').click();" style="border: 2px dashed #cbd5e1 !important; background: #f8fafc;">
                                            <input type="file" name="seo_image" id="seo_image_input" class="d-none" accept="image/*">
                                            <img id="seo-image-preview" src="{{ $post->seo_image ? Storage::url($post->seo_image) : '#' }}" alt="Preview" style="max-height: 100px; {{ $post->seo_image ? '' : 'display: none;' }} margin: 0 auto;" class="mb-2 rounded">
                                            <div id="seo-image-placeholder" style="{{ $post->seo_image ? 'display: none;' : '' }}">
                                                <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                                <div class="text-primary fw-bold" style="font-size: 13px;">Choose image</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label d-block fw-bold mb-3">Index</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seo_index" id="seo_index_yes" value="1" {{ old('seo_index', $post->seo_index ?? 1) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="seo_index_yes" style="font-size: 14px;">Index</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="seo_index" id="seo_index_no" value="0" {{ old('seo_index', $post->seo_index ?? 1) == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="seo_index_no" style="font-size: 14px;">No index</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Publish</h3>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary py-2 fw-bold d-flex align-items-center justify-content-center" type="submit" style="background: #206bc4; border-color: #206bc4; font-size: 14px;">
                                        <i class="fas fa-save me-2"></i> Save
                                    </button>
                                    <button class="btn btn-white py-2 fw-bold d-flex align-items-center justify-content-center" type="submit" name="save_and_exit" value="1" style="background: #fff; color: #374151; border-color: #d1d5db; font-size: 14px;">
                                        <i class="fas fa-sign-out-alt me-2"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0 required" style="font-size: 14px;">Status</h3>
                            </div>
                            <div class="card-body p-3">
                                <select class="form-select" name="status" style="padding: 8px 12px; font-size: 13px;">
                                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ old('status', $post->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Author</h3>
                            </div>
                            <div class="card-body p-3">
                                <select class="form-select mb-2" name="author_id" style="padding: 8px 12px; font-size: 13px;">
                                    <option value="">Select author...</option>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-muted" style="font-size: 12px;">Select an author from admin users.</div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Categories</h3>
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-3">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 ps-0 shadow-none" id="category-search" placeholder="Search categories..." style="font-size: 12px; height: 32px;">
                                    </div>
                                </div>
                                <div class="category-list-wrapper scrollable" style="max-height: 250px; overflow-y: auto; padding-right: 5px;">
                                    @php $postCatIds = $post->categories->pluck('id')->toArray(); @endphp
                                    @foreach($categories as $category)
                                    <div class="form-check mb-2 category-item" data-name="{{ strtolower($category->name) }}">
                                        <input class="form-check-input mt-1" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" {{ in_array($category->id, old('categories', $postCatIds)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="cat-{{ $category->id }}" style="font-size: 13px; color: #182433; cursor: pointer;">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Image</h3>
                            </div>
                            <div class="card-body p-3 text-center">
                                <div class="image-box-wrapper mb-2">
                                    <div class="image-placeholder-box cursor-pointer" onclick="document.getElementById('image').click();" style="width: 100%; height: 160px; border: 1px solid #e2e8f0; background: #f8fafc; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                        <div id="image-placeholder" style="{{ $post->image ? 'display: none;' : '' }}">
                                            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='48' height='48' viewBox='0 0 24 24' fill='none' stroke='%23cbd5e1' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'%3E%3C/circle%3E%3Cpolyline points='21 15 16 10 5 21'%3E%3C/polyline%3E%3C/svg%3E" alt="Placeholder" style="width: 48px; opacity: 0.5;">
                                        </div>
                                        <img id="image-preview" src="{{ $post->image ? Storage::url($post->image) : '#' }}" alt="Preview" style="max-width: 100%; max-height: 100%; {{ $post->image ? '' : 'display: none;' }}" class="rounded">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center gap-1 align-items-center mt-2" style="font-size: 13px;">
                                    <a href="#" class="text-primary text-decoration-none fw-bold" onclick="document.getElementById('image').click(); return false;">Change</a>
                                    <span class="text-muted">or</span>
                                    <a href="#" class="text-primary text-decoration-none fw-bold">Add from URL</a>
                                </div>
                                <input type="file" name="image" id="image" class="d-none" accept="image/*">
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm" style="border: 1px solid #e5e7eb; border-radius: 4px;">
                            <div class="card-header bg-transparent py-2 px-3" style="border-bottom: 1px solid #e5e7eb;">
                                <h3 class="card-title fw-bold m-0" style="font-size: 14px;">Tags</h3>
                            </div>
                            <div class="card-body p-3">
                                <input type="text" class="form-control" name="post_tags" value="{{ old('post_tags', $post->tags->pluck('name')->implode(',')) }}" placeholder="Write some tags" id="tag" style="padding: 8px 12px; font-size: 13px;">
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    body { background-color: #f1f5f9 !important; color: #1e293b; font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important; }
    .page-wrapper { min-height: 100vh; padding-bottom: 40px; }
    
    .card { background-color: #fff; border: 1px solid #e2e8f0; border-radius: 4px !important; }
    .card-header { padding: 0.75rem 1rem; }
    .card-body { padding: 1rem; }
    
    .form-label { font-size: 13px; color: #1e293b; margin-bottom: 4px; }
    .required:after { content: " *"; color: #ef4444; }
    
    .form-control, .form-select { border-color: #dce1e7; font-size: 13.5px; border-radius: 4px; padding: 8px 12px; transition: border-color 0.1s ease-in-out; }
    .form-control:focus, .form-select:focus { border-color: #206bc4; box-shadow: none !important; outline: 0; }
    
    .btn-primary { background: #206bc4 !important; border: 1px solid #206bc4 !important; }
    .btn-primary:hover { background: #1a569d !important; border-color: #1a569d !important; }
    
    .ck-editor__editable { min-height: 320px !important; border-color: #dce1e7 !important; border-bottom-left-radius: 4px !important; border-bottom-right-radius: 4px !important; }
    .ck-toolbar { border-color: #dce1e7 !important; border-top-left-radius: 4px !important; border-top-right-radius: 4px !important; background-color: #f8fafc !important; }
    
    .breadcrumb-item + .breadcrumb-item::before { content: "\f105"; font-family: "Font Awesome 6 Free"; font-weight: 900; font-size: 10px; padding: 0 8px; color: #94a3b8; }
    
    .scrollable::-webkit-scrollbar { width: 4px; }
    .scrollable::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .scrollable::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

    .image-placeholder-box:hover { background: #f1f5f9 !important; border-color: #cbd5e1 !important; }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Sticky Header Logic
        const stickyHeader = document.getElementById('sticky-header');
        window.onscroll = function() {
            if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                $(stickyHeader).slideDown(150);
            } else {
                $(stickyHeader).slideUp(100);
            }
        };

        // Edit slug button
        $('#edit-slug-btn').on('click', function(e) {
            e.preventDefault();
            $('#permalink').prop('readonly', function(i, v) { return !v; });
            if(!$('#permalink').prop('readonly')) {
                $('#permalink').addClass('bg-white').focus();
            } else {
                $('#permalink').removeClass('bg-white');
            }
        });

        // Slug Generation
        $('#name').on('keyup', function() {
            if ($('#permalink').prop('readonly')) {
                var val = $(this).val();
                var slug = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
                $('#permalink').val(slug);
                $('#preview-permalink').attr('href', "{{ url('blog') }}/" + slug).text("{{ url('blog') }}/" + slug);
                $('#seo-preview-title').text(val || 'Post Name');
                $('#seo-preview-url').text("{{ url('blog') }}/" + slug);
            }
        });

        // Tagify Initialization
        var tagInput = document.querySelector('#tag');
        if (tagInput && typeof Tagify !== 'undefined') {
            new Tagify(tagInput, {
                delimiters: ",", 
                dropdown: {
                    enabled: 0,
                }
            });
        }

        // Toggle SEO meta
        $('#edit-seo-btn').on('click', function(e) {
            e.preventDefault();
            $('#seo-meta-fields').slideToggle();
        });

        // Dynamic FAQ items
        let faqIndex = {{ isset($post->faq_schema_config) && is_array($post->faq_schema_config) ? count($post->faq_schema_config) : 0 }};
        $('#add-faq-item').on('click', function() {
            let html = `
                <div class="faq-item mb-4 p-4 bg-white shadow-sm" id="faq-item-${faqIndex}" style="border: 1px solid #e2e8f0; border-radius: 8px;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0 fs-5 fw-bold" style="color: #334155;">Question & Answer</h4>
                        <button type="button" class="btn btn-link text-danger p-0 remove-faq" data-id="${faqIndex}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Question</label>
                        <input type="text" name="faq_schema_config[${faqIndex}][question]" class="form-control" placeholder="Question" style="padding: 8px 12px; font-size: 13px;">
                    </div>
                    <div>
                        <label class="form-label fw-bold">Answer</label>
                        <textarea name="faq_schema_config[${faqIndex}][answer]" class="form-control" rows="3" placeholder="Answer" style="padding: 8px 12px; font-size: 13px;"></textarea>
                    </div>
                </div>
            `;
            $('#faq-items-container').append(html);
            faqIndex++;
        });

        $(document).on('click', '.remove-faq', function() {
            $(`#faq-item-${$(this).data('id')}`).remove();
        });

        // Category Search
        $('#category-search').on('keyup', function() {
            var query = $(this).val().toLowerCase();
            $('.category-item').each(function() {
                var name = $(this).data('name');
                $(this).toggle(name.includes(query));
            });
        });

        // Image previews
        function handleImagePreview(input, previewId, placeholderId) {
            const file = input.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $(`#${previewId}`).attr('src', e.target.result).show();
                    $(`#${placeholderId}`).hide();
                }
                reader.readAsDataURL(file);
            }
        }

        $('#image').on('change', function() { handleImagePreview(this, 'image-preview', 'image-placeholder'); });
        $('#seo_image_input').on('change', function() { handleImagePreview(this, 'seo-image-preview', 'seo-image-placeholder'); });
    });
</script>
@endpush
