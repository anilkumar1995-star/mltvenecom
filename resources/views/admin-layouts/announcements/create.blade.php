@extends('admin-layouts.app')
@section('title', 'Create Announcement')

@section('content')

<div class="page-wrapper pt-5">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <div class="page-pretitle breadcrumb-arrows mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}">ANNOUNCEMENTS</a></li>
                            <li class="breadcrumb-item active">CREATE NEW ANNOUNCEMENT</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-info alert-dismissible bg-blue-lt" role="alert">
                <div class="d-flex">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>
                    </div>
                    <div>
                        You are editing <strong>"English"</strong> version
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>

            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf
                <div class="row row-cards">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter announcement name" value="{{ old('name') }}" required>
                                    <small class="form-hint text-muted mt-2">Name for internal reference only, not visible to users</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Content</label>
                                    <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                                    <small class="form-hint text-muted mt-2">The message that will be displayed to users. Supports HTML formatting.</small>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Start date</label>
                                        <div class="input-icon">
                                            <input class="form-control flatpickr" placeholder="Select date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d H:i:s')) }}">
                                            <span class="input-icon-addon">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">End date</label>
                                        <div class="input-icon">
                                            <input class="form-control flatpickr" placeholder="Select date" name="end_date" value="{{ old('end_date') }}">
                                            <span class="input-icon-addon">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title fw-semibold">Publish</h3>
                            </div>
                            <div class="card-body">
                                <button type="submit" name="save" class="btn btn-primary w-100 mb-2" style="background: #206bc4; border-color: #206bc4;">
                                    <i class="far fa-save me-2"></i> Save
                                </button>
                                <button type="submit" name="save_and_exit" value="1" class="btn btn-light text-muted w-100 border">
                                    <i class="fas fa-sign-out-alt me-2"></i> Save & Exit
                                </button>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header border-bottom-0 pb-1">
                                <h3 class="card-title fw-semibold">Is active</h3>
                            </div>
                            <div class="card-body pt-1">
                                <label class="form-check form-switch cursor-pointer mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <span class="form-check-label"></span>
                                </label>
                                <small class="form-hint text-muted">Enable or disable this announcement without deleting it</small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
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
    .breadcrumb-item.active a, .breadcrumb-item.active h1 {
        color: #6c7a91;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 0px;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
    }
    .bg-blue-lt {
        background: #f2f8fc !important;
        border-color: #d1e5f5 !important;
        color: #206bc4 !important;
    }
    .alert-icon {
        color: #206bc4 !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    CKEDITOR.replace('content', {
        height: 200,
        toolbar: [
            { name: 'document', items: ['Source'] },
            { name: 'clipboard', items: ['Undo', 'Redo'] },
            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
            '/',
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'links', items: ['Link', 'Unlink'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
            { name: 'colors', items: ['TextColor', 'BGColor'] },
            { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
        ]
    });

    flatpickr(".flatpickr", {
        enableTime: true,
        dateFormat: "Y-m-d H:i:S",
        time_24hr: true
    });
</script>
@endpush
