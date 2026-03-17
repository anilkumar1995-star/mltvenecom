@extends('admin-layouts.app')
@section('title', 'Edit tag "' . $tag->name . '"')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none sticky-top bg-white border-bottom py-2" style="z-index: 100;">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1 font-medium" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1 font-medium" href="#">Blog</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1 font-medium" href="{{ route('admin.blog.tags.index') }}">Tags</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 font-medium">Edit tag "{{ $tag->name }}"</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="submit" form="tag-form" name="submit" value="save" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                            Save
                        </button>
                        <button type="submit" form="tag-form" name="save_and_exit" value="1" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                            Save & Exit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
                    {{-- Main Content --}}
                    <div class="col-md-9">
                        <div class="alert alert-info border-0 rounded-0 mb-4 py-3 px-4" style="background-color: #e8f2fc; color: #1a73e8; border-left: 4px solid #206bc4 !important;">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                                <span class="fs-4">You are editing "<strong>English</strong>" version</span>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $tag->name) }}" placeholder="Name" required maxlength="120">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Permalink</label>
                                    <div class="input-group mb-1 shadow-sm">
                                        <span class="input-group-text bg-light border-end-0 text-muted px-3" style="font-size: 0.95rem;">{{ url('tag') }}/</span>
                                        <input type="text" class="form-control border-start-0 ps-0" name="slug" id="slug" value="{{ old('slug', $tag->slug) }}" placeholder="slug" readonly>
                                        <button class="btn btn-outline-primary border-start-0 px-3" type="button" id="edit-slug-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                        </button>
                                    </div>
                                    <small class="form-hint mt-1">Preview: <a href="{{ url('tag/' . $tag->slug) }}" target="_blank" id="slug-preview" class="text-primary text-decoration-none border-bottom border-primary border-opacity-25">{{ url('tag') }}/{{ $tag->slug }}</a></small>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <label class="form-label mb-0">Content</label>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-light" id="toggle-editor">Show/Hide Editor</button>
                                            <button type="button" class="btn btn-light">Add media</button>
                                        </div>
                                    </div>
                                    <textarea class="form-control editor" name="description" id="content-editor" rows="10" placeholder="Short description">{{ old('description', $tag->description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- SEO Section --}}
                        <div class="card mb-3 shadow-sm">
                            <div class="card-header d-flex justify-content-between bg-transparent pt-4 px-4">
                                <h3 class="card-title fw-bold">Search Engine Optimize</h3>
                                <a href="javascript:void(0)" class="text-primary fw-medium text-decoration-none" id="toggle-seo">Edit SEO meta</a>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <p class="text-muted fs-4 mb-0" id="seo-preview-text">Setup meta title & description to make your site easy to discovered on search engines such as Google</p>
                                
                                <div id="seo-content" class="mt-4" style="{{ $tag->seo_title || $tag->seo_description ? '' : 'display: none;' }}">
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
                                                Meta keywords was removed by Google since 2009. Use Meta title and Meta description to improve SEO.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">SEO Title</label>
                                        <input type="text" class="form-control" name="seo_title" id="seo_title" value="{{ old('seo_title', $tag->seo_title) }}" placeholder="SEO Title">
                                        <small class="text-muted mt-1 d-block">Character count: <span id="seo_title_count">{{ strlen($tag->seo_title) }}</span> / 70. Optimal length: 50-70 characters.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Description</label>
                                        <textarea class="form-control" name="seo_description" id="seo_description" rows="3" placeholder="SEO Description">{{ old('seo_description', $tag->seo_description) }}</textarea>
                                        <small class="text-muted mt-1 d-block">Character count: <span id="seo_desc_count">{{ strlen($tag->seo_description) }}</span> / 160. Optimal length: 150-160 characters.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">SEO Image</label>
                                        <div class="image-preview-container p-3 bg-light rounded-3 d-flex align-items-center justify-content-center cursor-pointer border-2 border-dashed" style="min-height: 120px;" onclick="document.getElementById('seo_image_input').click();">
                                            <div id="seo-image-placeholder" style="{{ $tag->seo_image ? 'display: none;' : '' }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo text-muted" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg>
                                            </div>
                                            <img id="seo-image-preview" src="{{ $tag->seo_image ? 'https://images.incomeowl.in/incomeowl/b2b/images/' . $tag->seo_image : '#' }}" alt="Preview" style="max-width: 100%; max-height: 150px; {{ $tag->seo_image ? '' : 'display: none;' }}" class="rounded shadow-sm">
                                        </div>
                                        <input type="file" name="seo_image" id="seo_image_input" class="d-none" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="col-md-3">
                        <div class="card mb-3 shadow-sm border-0 overflow-hidden">
                            <div class="card-header bg-transparent border-bottom-0 pt-4 px-4">
                                <h3 class="card-title fw-bold">Publish</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <div class="btn-list">
                                    <button class="btn btn-primary d-flex align-items-center justify-content-center flex-fill py-2" type="submit" name="submit" value="save">
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
                            <div class="card-header bg-transparent pt-4 px-4 border-bottom-0">
                                <h3 class="card-title fw-bold required">Status</h3>
                            </div>
                            <div class="card-body px-4 pb-4">
                                <select class="form-select" name="status" id="status" required>
                                    <option value="published" {{ old('status', $tag->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', $tag->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ old('status', $tag->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
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
    :root {
        --primary-font: 'Public Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    body { font-family: var(--primary-font); background-color: #f0f2f5 !important; }
    .page-wrapper { font-family: var(--primary-font); background-color: #f0f2f5 !important; }
    
    .breadcrumb-item a { color: #206bc4; text-decoration: none; }
    .breadcrumb-item.active { color: #6c7a91; }
    
    .card { border-radius: 4px; border: 1px solid #e1e6eb; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .card-title { font-size: 0.875rem; color: #495057; }
    .form-label { font-size: 0.875rem; font-weight: 500; color: #495057; }
    .form-label.required:after { content: ' *'; color: #d63939; }
    
    .input-group-text { border-color: #ced4da; }
    .form-control:focus, .form-select:focus { border-color: #206bc4; box-shadow: 0 0 0 0.1rem rgba(32, 107, 196, 0.25); }
    
    .sticky-top { transition: all 0.2s; }
    .btn-list .btn { font-weight: 500; padding: 0.5rem 1rem; }
    
    .image-preview-container { transition: border-color 0.2s; }
    .image-preview-container:hover { border-color: #206bc4 !important; }
    
    .alert-info { border-left: 4px solid #206bc4 !important; }
    
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize CKEditor 5
        let editor;
        function initEditor() {
            if (typeof ClassicEditor !== 'undefined') {
                ClassicEditor.create(document.querySelector('#content-editor'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
                }).then(newEditor => {
                    editor = newEditor;
                }).catch(error => {
                    console.error('CKEditor initialization error:', error);
                });
            } else if (typeof CKEDITOR !== 'undefined') {
                // Fallback to CKEditor 4 if version 5 fails to load
                CKEDITOR.replace('content-editor', { height: 300 });
            } else {
                console.warn('Editor is not defined yet. Retrying...');
                setTimeout(initEditor, 500);
            }
        }
        initEditor();

        // Permalink logic
        $('#name').on('keyup', function() {
            if ($('#slug').prop('readonly')) {
                let name = $(this).val();
                let slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                $('#slug').val(slug);
                updateSlugPreview(slug);
            }
        });

        $('#edit-slug-btn').on('click', function() {
            let isReadonly = $('#slug').prop('readonly');
            $('#slug').prop('readonly', !isReadonly);
            $(this).toggleClass('btn-primary btn-outline-primary');
            if (isReadonly) {
                $('#slug').focus();
            }
        });

        $('#slug').on('keyup', function() {
            updateSlugPreview($(this).val());
        });

        function updateSlugPreview(slug) {
            let baseUrl = "{{ url('tag') }}/";
            $('#slug-preview').attr('href', baseUrl + slug).text(baseUrl + slug);
        }

        // Toggle SEO meta
        $('#toggle-seo').on('click', function(e) {
            e.preventDefault();
            $('#seo-content').slideToggle();
        });

        // SEO Word counts and validation
        $('#seo_title').on('keyup', function() {
            let len = $(this).val().length;
            $('#seo_title_count').text(len);
            if (len >= 50 && len <= 70) {
                $('#seo_title_count').addClass('text-success').removeClass('text-danger text-warning');
            } else if (len > 0) {
                $('#seo_title_count').addClass('text-warning').removeClass('text-success text-danger');
            } else {
                $('#seo_title_count').removeClass('text-success text-warning text-danger');
            }
        });

        $('#seo_description').on('keyup', function() {
            let len = $(this).val().length;
            $('#seo_desc_count').text(len);
            if (len >= 150 && len <= 160) {
                $('#seo_desc_count').addClass('text-success').removeClass('text-danger text-warning');
            } else if (len > 0) {
                $('#seo_desc_count').addClass('text-warning').removeClass('text-success text-danger');
            } else {
                $('#seo_desc_count').removeClass('text-success text-warning text-danger');
            }
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

        // Toggle editor button
        $('#toggle-editor').on('click', function() {
            if (editor) {
                $('.ck-editor').toggle();
                $('#content-editor').toggle(); // Show/hide raw textarea
            } else if (typeof CKEDITOR !== 'undefined') {
                let instance = CKEDITOR.instances['content-editor'];
                if (instance) {
                    instance.destroy();
                } else {
                    CKEDITOR.replace('content-editor');
                }
            }
        });
    });
</script>
@endpush
