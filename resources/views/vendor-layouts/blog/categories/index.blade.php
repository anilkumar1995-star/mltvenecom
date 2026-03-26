@extends('admin-layouts.app')
@section('title', isset($category) ? 'Edit Category' : 'Categories')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Blog</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Categories</h1>
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
            <div class="alert alert-info border-0 rounded-0 bg-light text-muted mb-3">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <circle cx="12" cy="12" r="9"></circle>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            <polyline points="11 12 12 12 12 16 13 16"></polyline>
                        </svg>
                    </div>
                    <div>
                        For easier bulk management of categories, you can also <a href="#" class="text-primary">manage categories as a table</a>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Left Column: Category List --}}
                <div class="col-md-5">
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                                Drag and drop on the left to change the order or parent of the categories.
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('admin.blog.categories.index') }}" class="btn btn-primary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                      <line x1="12" y1="5" x2="12" y2="19" />
                                      <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    Create
                                </a>
                            </div>

                            <div class="list-group list-group-flush border rounded">
                                @forelse($categories as $cat)
                                <div class="list-group-item d-flex align-items-center p-2 border-bottom">
                                    <div class="text-muted cursor-move me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="6" x2="20" y2="6" /><line x1="4" y1="12" x2="20" y2="12" /><line x1="4" y1="18" x2="20" y2="18" /></svg>
                                    </div>
                                    <div class="me-2 text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('admin.blog.categories.edit', $cat->id) }}" class="{{ isset($category) && $category->id == $cat->id ? 'fw-bold text-primary' : 'text-dark text-decoration-none' }}">
                                            {{ $cat->name }}
                                        </a>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-sm btn-icon text-danger delete-btn" data-url="{{ route('admin.blog.categories.destroy', $cat->id) }}" style="padding:0; border:none; background:none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </button>
                                    </div>
                                </div>
                                @empty
                                <div class="p-3 text-center text-muted">No categories found</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Form --}}
                <div class="col-md-7">
                    <form action="{{ isset($category) ? route('admin.blog.categories.update', $category->id) : route('admin.blog.categories.store') }}" method="POST">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="card mb-3 bg-light border-0 shadow-none">
                            <div class="card-body p-3 text-muted small">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="12" y1="8" x2="12.01" y2="8" /><polyline points="11 12 12 12 12 16 13 16" /></svg>
                                You are editing <strong>"English"</strong> version
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Name" required>
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label required">Permalink</label>
                                    <div class="input-group">
                                        <span class="input-group-text">{{ url('blog') }}/</span>
                                        <input type="text" class="form-control" name="permalink" id="permalink" value="{{ old('permalink') }}" placeholder="permalink-will-be-generated-here">
                                    </div>
                                    <small class="form-hint">Preview: <a href="#" id="preview-permalink">{{ url('blog') }}/</a></small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Parent</label>
                                    <select class="form-select" name="parent_id">
                                        <option value="0">None</option>
                                        @foreach($categories as $cat)
                                            @if(!isset($category) || $category->id != $cat->id)
                                                <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id ?? 0) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" rows="4" name="description" placeholder="Short description">{{ old('description', $category->description ?? '') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_default" value="1" {{ old('is_default', $category->is_default ?? false) ? 'checked' : '' }}>
                                        <span class="form-check-label">Is default?</span>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Icon</label>
                                    <div class="input-icon">
                                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $category->icon ?? '') }}" placeholder="Ex: ti ti-home">
                                        <span class="input-icon-addon">
                                            <svg class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="6 9 12 15 18 9" /></svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured', $category->is_featured ?? false) ? 'checked' : '' }}>
                                        <span class="form-check-label">Is featured?</span>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="published" {{ old('status', $category->status ?? 'published') == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ old('status', $category->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="pending" {{ old('status', $category->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Search Engine Optimize</h3>
                                <a href="#" class="text-primary">Edit SEO meta</a>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-0">Setup meta title & description to make your site easy to discovered on search engines such as Google</p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-primary d-flex align-items-center w-50" type="submit" name="submit" value="save">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                                        Save
                                    </button>
                                    <button class="btn w-50" type="submit" name="save_and_exit" value="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><circle cx="12" cy="14" r="2" /><polyline points="14 4 14 8 8 8 8 4" /></svg>
                                        Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Simple slug generator for permalink
        $('#name').on('keyup', function() {
            var val = $(this).val();
            var slug = val.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            $('#permalink').val(slug);
            $('#preview-permalink').text("{{ url('blog') }}/" + slug);
        });
        
        $('#permalink').on('keyup', function() {
            var val = $(this).val();
            $('#preview-permalink').text("{{ url('blog') }}/" + val);
        });

        // Individual Delete
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            let btn = $(this);
            let url = btn.data('url');

            Swal.fire({
                title: 'Confirm delete',
                text: "Do you really want to delete this category?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            if(response.success){
                                Swal.fire('Deleted!', response.message, 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
