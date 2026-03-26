@extends('admin-layouts.app')
@section('title', 'Create Slider Item')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}">DASHBOARD</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.simple-sliders.index') }}">SIMPLE SLIDERS</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.simple-sliders.edit', $slider->id) }}">{{ strtoupper($slider->name) }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">NEW ITEM</h1>
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
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.simple-sliders.items.store') }}" method="POST" id="sliderItemForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="simple_slider_id" value="{{ $slider->id }}">
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="alert alert-info d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            You are creating in "<strong>English</strong>" version
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="title">
                                            Title
                                        </label>
                                        <input class="form-control" placeholder="Title" name="title" type="text" id="title" value="{{ old('title') }}">
                                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="link">
                                            Link
                                        </label>
                                        <input class="form-control" placeholder="Link" name="link" type="text" id="link" value="{{ old('link') }}">
                                        @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <span class="text-muted small">(0/400)</span>
                                        </div>
                                        <textarea class="form-control" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description') }}</textarea>
                                    </div>
                                    
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="order">
                                            Order
                                        </label>
                                        <input class="form-control" placeholder="0" name="order" type="number" id="order" value="{{ old('order', 0) }}">
                                        @error('order')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list d-flex flex-column gap-2">
                                    <button class="btn btn-primary d-flex align-items-center justify-content-center w-100" type="submit" name="submit" value="save">
                                        <i class="fas fa-save me-1"></i> Save
                                    </button>
                                    <button class="btn btn-light d-flex align-items-center justify-content-center w-100" type="submit" name="submit" value="save_and_exit">
                                        <i class="fas fa-sign-out-alt me-1"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Languages</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('vendor/core/core/base/img/flags/us.svg') }}" style="width: 24px; margin-right: 8px;">
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <label class="form-label required" for="image">Image</label>
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="image-box">
                                    <div class="preview-image-wrapper p-2 border rounded mb-2 text-center" style="min-height: 150px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                                        <img src="https://via.placeholder.com/150" alt="Preview image" class="preview_image img-fluid" style="max-height: 150px;" id="image_preview">
                                    </div>
                                    <div class="image-box-actions text-center">
                                        <input type="file" name="image" id="image_input" class="form-control form-control-sm" accept="image/*">
                                    </div>
                                    @error('image')<span class="text-danger small mt-1 d-block">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </main>

@endsection

@push('styles')
<style>
    .breadcrumb-arrows .breadcrumb-item+.breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .breadcrumb-item.active a {
        color: #6c7a91;
        font-size: 11px;
        font-weight: 600;
    }
    .breadcrumb-item.active h1 {
        font-size: 11px;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
        color: #182433;
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('image_input').onchange = evt => {
        const [file] = document.getElementById('image_input').files;
        if (file) {
            document.getElementById('image_preview').src = URL.createObjectURL(file);
        }
    }
</script>
@endpush
