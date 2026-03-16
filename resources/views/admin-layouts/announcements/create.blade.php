@extends('admin-layouts.app')
@section('title', 'Create new announcement')

@section('content')
<div class="container-xl">
    <div class="page-header d-print-none mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">Create new announcement</h2>
            </div>
            <div class="col-auto ms-auto">
                <div class="btn-list">
                    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">Back to list</a>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex">
                <div><i class="fas fa-check-circle me-2"></i></div>
                <div>{{ session('success') }}</div>
            </div>
            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

    <form action="{{ route('admin.announcements.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Content</label>
                            <textarea class="form-control editor" name="content" id="editor" rows="10">{{ old('content') }}</textarea>
                            @error('content') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="text" class="form-control flatpickr" name="start_date" value="{{ old('start_date', now()->format('Y-m-d H:i:s')) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="text" class="form-control flatpickr" name="end_date" value="{{ old('end_date') }}">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_action" id="hasActionToggle" value="1" {{ old('has_action') ? 'checked' : '' }}>
                                <span class="form-check-label">Has action</span>
                            </label>
                        </div>

                        <div id="actionFields" class="row mb-3" style="display: {{ old('has_action') ? 'flex' : 'none' }};">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Action label</label>
                                <input type="text" class="form-control" name="action_label" value="{{ old('action_label') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Action URL</label>
                                <input type="text" class="form-control" name="action_url" value="{{ old('action_url') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" name="action_open_new_tab" value="1" {{ old('action_open_new_tab') ? 'checked' : '' }}>
                                    <span class="form-check-label">Open in new tab</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-header"><h3 class="card-title">Publish</h3></div>
                    <div class="card-body">
                        <button class="btn btn-primary w-100 mb-2" type="submit">Save</button>
                        <button class="btn btn-outline-secondary w-100" type="submit" name="save_and_exit" value="1">Save & Exit</button>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header"><h3 class="card-title">Status</h3></div>
                    <div class="card-body">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="form-check-label">Is active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<style>
    .ck-editor__editable { min-height: 250px !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        flatpickr(".flatpickr", { enableTime: true, dateFormat: "Y-m-d H:i:S" });
        $('#hasActionToggle').on('change', function() {
            $('#actionFields').toggle(this.checked);
        });
        if (document.querySelector('#editor')) {
            ClassicEditor.create(document.querySelector('#editor')).catch(error => { console.error(error); });
        }
    });
</script>
@endpush
