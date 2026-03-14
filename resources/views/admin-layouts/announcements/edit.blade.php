@extends('admin-layouts.app')
@section('title', 'Edit Announcement')

@section('content')
<div class="page-wrapper pt-0" style="background-color: #f8fafc;">
    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" id="announcementForm">
        @csrf
        @method('PUT')
   

        <!-- Normal Page Header -->
        <div class="page-header d-print-none mb-3 py-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb" style="font-size: 11px; font-weight: 600; text-transform: uppercase; margin-bottom: 8px;">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" style="color: #206bc4; text-decoration: none;">DASHBOARD</a></li>
                                <li class="separator mx-1" style="color: #cbd5e1; font-weight: 300;">/</li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}" style="color: #206bc4; text-decoration: none;">ANNOUNCEMENTS</a></li>
                                <li class="separator mx-1" style="color: #cbd5e1; font-weight: 300;">/</li>
                                <li class="breadcrumb-item active text-muted" aria-current="page">EDIT "{{ $announcement->name }}"</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body mt-0">
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible bg-success-lt mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <div class="alert alert-info alert-dismissible bg-blue-lt mb-4 shadow-none border" style="background-color: #f2f8fc !important; border: 1px solid rgba(32, 107, 196, 0.2) !important; border-left: 4px solid #206bc4 !important;">
                    <div class="d-flex align-items-center py-1">
                        <i class="fas fa-info-circle me-3 text-primary" style="font-size: 18px;"></i>
                        <div style="font-size: 14px; color: #475569;">You are editing <strong>"English"</strong> version</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>

                <div class="row row-cards">
                    <div class="col-md-9">
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label required fw-bold mb-2" style="font-size: 13px;">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter announcement name" value="{{ old('name', $announcement->name) }}" required style="border-radius: 4px; border-color: #e2e8f0; padding: 10px 12px; font-size: 14px;">
                                    <div class="form-hint text-muted mt-2" style="font-size: 12px; color: #64748b !important;">Name for internal reference only, not visible to users</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label required fw-bold mb-2" style="font-size: 13px;">Content <span class="text-danger">*</span></label>
                                    <div class="ckeditor-wrapper">
                                        <textarea id="editor" name="content">{{ old('content', $announcement->content) }}</textarea>
                                    </div>
                                    <div class="form-hint text-muted mt-2" style="font-size: 12px; color: #64748b !important;">The message that will be displayed to users. Supports HTML formatting.</div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold mb-2" style="font-size: 13px;">Start date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control flatpickr" placeholder="2026-03-14 00:00:0" name="start_date" id="startDatePicker" value="{{ old('start_date', $announcement->start_date ? $announcement->start_date->format('Y-m-d H:i:s') : '') }}" style="border-radius: 4px 0 0 4px; border-color: #e2e8f0;">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="document.getElementById('startDatePicker')._flatpickr.open()"><i class="far fa-calendar-alt text-muted"></i></span>
                                            <span class="input-group-text bg-white cursor-pointer text-danger" onclick="document.getElementById('startDatePicker')._flatpickr.clear()"><i class="fas fa-times"></i></span>
                                        </div>
                                        <div class="form-hint text-muted mt-2" style="font-size: 12px; color: #64748b !important;">Announcement will be visible from this date. Leave empty to start immediately.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold mb-2" style="font-size: 13px;">End date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control flatpickr" placeholder="2026-03-14 00:00:0" name="end_date" id="endDatePicker" value="{{ old('end_date', $announcement->end_date ? $announcement->end_date->format('Y-m-d H:i:s') : '') }}" style="border-radius: 4px 0 0 4px; border-color: #e2e8f0;">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="document.getElementById('endDatePicker')._flatpickr.open()"><i class="far fa-calendar-alt text-muted"></i></span>
                                            <span class="input-group-text bg-white cursor-pointer text-danger" onclick="document.getElementById('endDatePicker')._flatpickr.clear()"><i class="fas fa-times"></i></span>
                                        </div>
                                        <div class="form-hint text-muted mt-2" style="font-size: 12px; color: #64748b !important;">Announcement will be hidden after this date. Leave empty for no expiration.</div>
                                    </div>
                                </div>

                                <!-- Has Action Section -->
                                <div class="mt-4 pt-4 border-top">
                                    <div class="d-flex align-items-center mb-1">
                                        <label class="form-check form-switch cursor-pointer mb-0">
                                            <input class="form-check-input" type="checkbox" name="has_action" id="hasActionToggle" value="1" {{ old('has_action', $announcement->has_action) ? 'checked' : '' }}>
                                            <span class="form-check-label fw-bold" style="font-size: 13px;">Has action</span>
                                        </label>
                                    </div>
                                    <div class="form-hint text-muted mb-3" style="font-size: 12px; color: #64748b !important;">Add a call-to-action button to your announcement</div>

                                    <div id="actionFields" style="display: {{ old('has_action', $announcement->has_action) ? 'block' : 'none' }};">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold mb-2" style="font-size: 13px;">Action label</label>
                                                <input type="text" class="form-control" name="action_label" placeholder="e.g., Learn More, Shop Now" value="{{ old('action_label', $announcement->action_label) }}" style="border-radius: 4px; border-color: #e2e8f0;">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold mb-2" style="font-size: 13px;">Action URL</label>
                                                <input type="text" class="form-control" name="action_url" placeholder="https://example.com/page" value="{{ old('action_url', $announcement->action_url) }}" style="border-radius: 4px; border-color: #e2e8f0;">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-check form-switch cursor-pointer">
                                                <input class="form-check-input" type="checkbox" name="action_open_new_tab" value="1" {{ old('action_open_new_tab', $announcement->action_open_new_tab) ? 'checked' : '' }}>
                                                <span class="form-check-label fw-semibold" style="font-size: 13px;">Open in new tab?</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Publish Sidebar -->
                        <div class="card mb-3 shadow-none border-0 overflow-hidden">
                            <div class="card-header py-2 px-3" style="background-color: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                                <h3 class="card-title fw-bold text-uppercase" style="font-size: 11px; color: #475569; letter-spacing: 0.5px;">Publish</h3>
                            </div>
                            <div class="card-body p-3 bg-white">
                                <div class="btn-list">
                                    <button type="submit" name="save" class="btn btn-primary w-100 py-2" style="background: #206bc4; border-color: #206bc4; font-size: 13px; font-weight: 500;">
                                        <i class="fas fa-save me-2"></i> Save
                                    </button>
                                    <button type="submit" name="save_and_exit" value="1" class="btn btn-white w-100 py-2 border shadow-none" style="font-size: 13px; font-weight: 500; background: white;">
                                        <i class="fas fa-sign-out-alt me-2 text-muted"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Is active Sidebar -->
                        <div class="card mb-3 shadow-none border-0 overflow-hidden">
                            <div class="card-header py-2 px-3" style="background-color: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                                <h3 class="card-title fw-bold text-uppercase" style="font-size: 11px; color: #475569; letter-spacing: 0.5px;">Is active</h3>
                            </div>
                            <div class="card-body p-3 bg-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-check form-switch cursor-pointer mb-0">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $announcement->is_active) ? 'checked' : '' }} style="width: 32px; height: 16px;">
                                    </label>
                                </div>
                                <div class="form-hint text-muted mt-2" style="font-size: 11px; line-height: 1.4;">Enable or disable this announcement without deleting it</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        display: none;
    }
    .form-check-input {
        background-color: #cbd5e1;
        border-color: #cbd5e1;
    }
    .form-check-input:checked {
        background-color: #206bc4;
        border-color: #206bc4;
    }
    .card {
        border-radius: 4px;
    }
    .ck-editor__editable {
        min-height: 250px !important;
    }
    .sticky-top {
        transition: top 0.3s ease;
    }
    .shadow-sm {
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
    }
    /* CKEditor Custom Colors */
    :root {
        --ck-color-base-border: #e2e8f0;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CKEditor 5 Classic
        if (typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'link', '|',
                            'bulletedList', 'numberedList', 'alignment', '|',
                            'outdent', 'indent', '|',
                            'insertImage', 'mediaEmbed', 'insertTable', 'blockQuote', '|',
                            'undo', 'redo', '|',
                            'removeFormat', 'sourceEditing', 'fullscreen'
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    language: 'en'
                })
                .catch(error => { console.error(error); });
        }

        // Flatpickr
        flatpickr(".flatpickr", {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
            time_24hr: true
        });

        // Sticky Header
        const stickyHeader = document.getElementById('sticky-header');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 150) {
                stickyHeader.style.display = 'block';
            } else {
                stickyHeader.style.display = 'none';
            }
        });

        // Toggle Logic
        const toggle = document.getElementById('hasActionToggle');
        const fields = document.getElementById('actionFields');
        if (toggle && fields) {
            toggle.addEventListener('change', () => fields.style.display = toggle.checked ? 'block' : 'none');
            fields.style.display = toggle.checked ? 'block' : 'none';
        }
    });
</script>
@endpush
