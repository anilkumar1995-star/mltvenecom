@extends('admin-layouts.app')
@section('title', 'Create Testimonial')

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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Create new testimonial</h1>
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
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex gap-1">
                        <div>
                            <svg class="icon alert-icon svg-icon-ti-ti-info-circle" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 9h.01"></path>
                                <path d="M11 12h1v4h1"></path>
                            </svg>
                        </div>
                        <div class="w-100">
                            {{ session('success') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.testimonials.store') }}" accept-charset="UTF-8" id="botble-testimonial-form" class="js-base-form dirty-check" novalidate="novalidate" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    
                                    <div class="mb-3 position-relative">
                                        <label class="form-label form-label required" for="name">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" data-counter="120" placeholder="Name" required="required" name="name" type="text" value="{{ old('name') }}" id="name">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label form-label" for="company">Company</label>
                                        <input class="form-control @error('company') is-invalid @enderror" data-counter="120" placeholder="Company (optional)" name="company" type="text" value="{{ old('company') }}" id="company">
                                        @error('company') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    
                                    <div class="mb-3 position-relative">
                                        <label class="form-label form-label required" for="content">Content</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" rows="5" placeholder="Testimonial content" id="content" name="content" required="required">{{ old('content') }}</textarea>
                                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 gap-3 d-flex flex-column-reverse flex-md-column mb-md-0 mb-5">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list">
                                    <button class="btn btn-primary" type="submit" value="apply" name="submitter">
                                        <svg class="icon icon-left svg-icon-ti-ti-device-floppy" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                          <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                          <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Save
                                    </button>

                                    <button class="btn" type="submit" name="save_and_exit" value="1">
                                        <svg class="icon icon-left svg-icon-ti-ti-transfer-in" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                          <path d="M4 14h9"></path>
                                          <path d="M10 11l3 3l-3 3"></path>
                                        </svg>
                                        Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <label class="form-label required" for="status">Status</label>
                                </h4>
                            </div>
                            <div class="card-body">
                                <select class="form-select text-capitalize" required="required" id="status" name="status">
                                    <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <label class="form-label" for="image">Image</label>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="image-box image-box-image">
                                    <input type="file" name="image" id="testimonial-image-input" style="display: none;" accept="image/*">
                                    
                                    <div style="width: 8rem" class="preview-image-wrapper mb-1">
                                        <div class="preview-image-inner position-relative d-inline-block">
                                            <a class="image-box-actions custom-image-trigger" href="javascript:void(0)">
                                                <img id="testimonial-image-preview" class="preview-image default-image img-fluid rounded border" data-default="{{ asset('vendor/core/core/base/images/placeholder.png') }}" src="{{ asset('vendor/core/core/base/images/placeholder.png') }}" alt="Preview image" style="max-height: 150px; width: auto; object-fit: cover;">
                                                <span class="image-picker-backdrop"></span>
                                            </a>
                                            <button class="btn btn-pill btn-icon btn-sm image-picker-remove-button p-0 position-absolute top-0 end-0 bg-white" id="testimonial-remove-image-btn" style="display: none; transform: translate(30%, -30%); z-index: 10;" type="button" title="Remove image">
                                                <svg class="icon icon-sm text-danger m-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                  <path d="M18 6l-12 12"></path>
                                                  <path d="M6 6l12 12"></path>
                                                </svg>            
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <a href="javascript:void(0)" class="custom-image-trigger text-decoration-none">
                                            Choose image
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const triggers = document.querySelectorAll('.custom-image-trigger');
        const fileInput = document.getElementById('testimonial-image-input');
        const preview = document.getElementById('testimonial-image-preview');
        const removeBtn = document.getElementById('testimonial-remove-image-btn');
        const defaultImage = preview.getAttribute('data-default');

        triggers.forEach(trigger => {
            trigger.addEventListener('click', function() {
                fileInput.click();
            });
        });

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    removeBtn.style.display = 'flex';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeBtn.addEventListener('click', function() {
            fileInput.value = '';
            preview.src = defaultImage;
            this.style.display = 'none';
        });
    });
</script>
@endsection
