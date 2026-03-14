@extends('admin-layouts.app')
@section('title', 'Create Announcement')

@section('content')
<div class="page-wrapper pt-0">
    <form action="{{ route('admin.announcements.store') }}" method="POST" id="announcementForm">
        @csrf
        
        <!-- Sticky Action Bar (appears on scroll or replaces header) -->
        <div id="sticky-action-bar" class="page-header d-print-none sticky-top bg-white border-bottom py-2 shadow-sm" style="z-index: 1020; display: none;">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title text-muted" style="font-size: 14px; font-weight: 500;">
                            Create new announcement
                        </h2>
                    </div>
                    <div class="col-auto ms-auto">
                        <div class="btn-list">
                            <button type="submit" name="save" class="btn btn-primary btn-sm px-3" style="background: #206bc4; border-color: #206bc4;">
                                <i class="fas fa-save me-2"></i> Save
                            </button>
                            <button type="submit" name="save_and_exit" value="1" class="btn btn-white btn-sm px-3 border shadow-none">
                                <i class="fas fa-sign-out-alt me-2 text-muted"></i> Save & Exit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Normal Page Header -->
        <div class="page-header d-print-none mb-3 py-3">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb" style="font-size: 11px; font-weight: 600; text-transform: uppercase; margin-bottom: 0;">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-primary" style="text-decoration: none;">DASHBOARD</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}" class="text-primary" style="text-decoration: none;">ANNOUNCEMENTS</a></li>
                                <li class="breadcrumb-item active text-muted" aria-current="page">CREATE NEW ANNOUNCEMENT</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-body">
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

                <div class="alert alert-info alert-dismissible bg-blue-lt mb-4 shadow-none border-0" style="background-color: #f2f8fc !important; border-left: 4px solid #206bc4 !important;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2 text-primary" style="font-size: 16px;"></i>
                        <div style="font-size: 13px; color: #475569;">You are editing <strong>"English"</strong> version</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>

                <div class="row row-cards">
                    <div class="col-md-9">
                        <div class="card mb-3 shadow-none border">
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label required fw-bold mb-2">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-shofy" name="name" placeholder="Enter announcement name" value="{{ old('name') }}" required>
                                    <div class="form-hint text-muted mt-2" style="font-size: 12px;">Name for internal reference only, not visible to users</div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label required fw-bold mb-2">Content <span class="text-danger">*</span></label>
                                    <div class="ckeditor-wrapper">
                                        <textarea id="editor" name="content">{{ old('content') }}</textarea>
                                    </div>
                                    <div class="form-hint text-muted mt-2" style="font-size: 12px;">The message that will be displayed to users. Supports HTML formatting.</div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold mb-2">Start date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control flatpickr" placeholder="2026-03-14 00:00:0" name="start_date" id="startDatePicker" value="{{ old('start_date', now()->format('Y-m-d H:i:s')) }}">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="document.getElementById('startDatePicker')._flatpickr.open()"><i class="far fa-calendar-alt text-muted"></i></span>
                                            <span class="input-group-text bg-white cursor-pointer text-danger" onclick="document.getElementById('startDatePicker')._flatpickr.clear()"><i class="fas fa-times"></i></span>
                                        </div>
                                        <div class="form-hint text-muted mt-2" style="font-size: 12px;">Announcement will be visible from this date. Leave empty to start immediately.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold mb-2">End date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control flatpickr" placeholder="2026-03-14 00:00:0" name="end_date" id="endDatePicker" value="{{ old('end_date') }}">
                                            <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="document.getElementById('endDatePicker')._flatpickr.open()"><i class="far fa-calendar-alt text-muted"></i></span>
                                            <span class="input-group-text bg-white cursor-pointer text-danger" onclick="document.getElementById('endDatePicker')._flatpickr.clear()"><i class="fas fa-times"></i></span>
                                        </div>
                                        <div class="form-hint text-muted mt-2" style="font-size: 12px;">Announcement will be hidden after this date. Leave empty for no expiration.</div>
                                    </div>
                                </div>

                                <!-- Has Action Section -->
                                <div class="mt-4 pt-4 border-top">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="form-check form-switch cursor-pointer mb-0 me-3">
                                            <input class="form-check-input" type="checkbox" name="has_action" id="hasActionToggle" value="1" {{ old('has_action') ? 'checked' : '' }}>
                                            <span class="form-check-label fw-bold">Has action</span>
                                        </label>
                                    </div>
                                    <div class="form-hint text-muted mb-3" style="font-size: 12px;">Add a call-to-action button to your announcement</div>

                                    <div id="actionFields" style="display: {{ old('has_action') ? 'block' : 'none' }};">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold mb-2">Action label</label>
                                                <input type="text" class="form-control form-control-shofy" name="action_label" placeholder="e.g., Learn More, Shop Now" value="{{ old('action_label') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold mb-2">Action URL</label>
                                                <input type="text" class="form-control form-control-shofy" name="action_url" placeholder="https://example.com/page" value="{{ old('action_url') }}">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-check form-switch cursor-pointer">
                                                <input class="form-check-input" type="checkbox" name="action_open_new_tab" value="1" {{ old('action_open_new_tab') ? 'checked' : '' }}>
                                                <span class="form-check-label fw-semibold">Open in new tab?</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <!-- Publish Sidebar Card -->
                        <div class="card mb-3 shadow-none border">
                            <div class="card-header bg-light py-2 px-3">
                                <h3 class="card-title fw-bold text-uppercase" style="font-size: 12px; color: #64748b; letter-spacing: 0.5px;">Publish</h3>
                            </div>
                            <div class="card-body p-3">
                                <div class="btn-list">
                                    <button type="submit" name="save" class="btn btn-primary w-100 py-2" style="background: #206bc4; border-color: #206bc4; font-size: 13px; font-weight: 500;">
                                        <i class="fas fa-save me-2"></i> Save
                                    </button>
                                    <button type="submit" name="save_and_exit" value="1" class="btn btn-white w-100 py-2 border shadow-none" style="font-size: 13px; font-weight: 500;">
                                        <i class="fas fa-sign-out-alt me-2 text-muted"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Is Active Sidebar Card -->
                        <div class="card mb-3 shadow-none border">
                            <div class="card-header bg-light py-2 px-3">
                                <h3 class="card-title fw-bold text-uppercase" style="font-size: 12px; color: #64748b; letter-spacing: 0.5px;">Is active</h3>
                            </div>
                            <div class="card-body p-3">
                                <label class="form-check form-switch cursor-pointer mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <span class="form-check-label fw-semibold">Is active</span>
                                </label>
                                <div class="form-hint text-muted" style="font-size: 11px;">Enable or disable this announcement without deleting it</div>
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
    .breadcrumb-item + .breadcrumb-item::before {
        content: "/";
        padding: 0 8px;
        color: #adb5bd;
    }
    .form-control-shofy {
        border-radius: 4px;
        border-color: #e2e8f0;
        padding: 0.6rem 0.75rem;
        font-size: 14px;
    }
    .form-control-shofy:focus {
        border-color: #206bc4;
        box-shadow: 0 0 0 0.1rem rgba(32, 107, 196, 0.1);
    }
    .bg-light {
        background-color: #f8fafc !important;
    }
    .card-header {
        border-bottom: 1px solid #f1f5f9;
    }
    .ck-editor__main .ck-content {
        min-height: 250px;
    }
    .sticky-top {
        transition: top 0.3s ease;
    }
    .btn-white:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
    }
    .shadow-none {
        box-shadow: none !important;
    }
    .form-hint {
        color: #94a3b8 !important;
        margin-top: 5px;
    }
    /* CKEditor Custom Styles */
    .ck-editor__editable_inline {
        min-height: 250px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // CKEditor 5 Superbuild Integration
        CKEDITOR.ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'sourceEditing', 'showBlocks', 'fullscreen'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: 'Enter announcement content...',
                // ... rest of config
            })
            .catch(error => {
                console.error(error);
            });

        // Flatpickr
        flatpickr(".flatpickr", {
            enableTime: true,
            dateFormat: "Y-m-d H:i:S",
            time_24hr: true
        });

        // Sticky Header Logic
        const stickyBar = document.getElementById('sticky-action-bar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                stickyBar.style.display = 'block';
            } else {
                stickyBar.style.display = 'none';
            }
        });

        // Toggle Action fields
        const hasActionToggle = document.getElementById('hasActionToggle');
        const actionFields = document.getElementById('actionFields');

        if (hasActionToggle && actionFields) {
            hasActionToggle.addEventListener('change', function() {
                actionFields.style.display = this.checked ? 'block' : 'none';
            });
            
            // Initial state check
            actionFields.style.display = hasActionToggle.checked ? 'block' : 'none';
        }
    });
</script>
@endpush
