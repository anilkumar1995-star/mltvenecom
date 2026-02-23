@extends('admin-layouts.app')
@section('title', 'Create Attribute Set')
@section('content')

    <div class="page-wrapper">
        <div class="page-header d-print-none">
            <div class="container-xl">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.attribute-sets.index') }}">Attribute Sets</a>
                        </li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>

        <main class="page-body page-content">
            <div class="container-xl">
                <form id="attr-form" action="{{ route('admin.attribute-sets.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Set Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label required">Title</label>
                                        <input type="text" name="title" class="form-control" required
                                            placeholder="e.g. Color, Size">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Display Layout</label>
                                            <select name="display_layout" class="form-select">
                                                <option value="dropdown">Dropdown</option>
                                                <option value="swatch">Swatch (Color/Image)</option>
                                                <option value="text">Text</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select">
                                                <option value="published">Published</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Order</label>
                                            <input type="number" name="order" class="form-control" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Attributes</h4>
                                    <div class="card-actions">
                                        <button type="button" class="btn btn-sm btn-primary" id="add-attr-btn"><i
                                                class="fas fa-plus me-1"></i> Add</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="attributes-container">
                                        <div class="attr-row row mb-2" data-index="0">
                                            <div class="col-md-5">
                                                <input type="text" name="attributes[0][title]" class="form-control"
                                                    placeholder="Title (e.g. Red, S)">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="color" name="attributes[0][color]"
                                                    class="form-control form-control-color" value="#ffffff">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-check"><input type="checkbox"
                                                        name="attributes[0][is_default]" class="form-check-input">
                                                    Default</label>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-icon remove-attr-btn"><i
                                                        class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i>
                                        Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>

    @endsection

    @push('scripts')
        <script>
            let attrIndex = 1;
            $('#add-attr-btn').on('click', function() {
                $('#attributes-container').append(`
                    <div class="attr-row row mb-2" data-index="${attrIndex}">
                        <div class="col-md-5"><input type="text" name="attributes[${attrIndex}][title]" class="form-control" placeholder="Title"></div>
                        <div class="col-md-3"><input type="color" name="attributes[${attrIndex}][color]" class="form-control form-control-color" value="#ffffff"></div>
                        <div class="col-md-2"><label class="form-check"><input type="checkbox" name="attributes[${attrIndex}][is_default]" class="form-check-input"> Default</label></div>
                        <div class="col-md-2"><button type="button" class="btn btn-danger btn-icon remove-attr-btn"><i class="fas fa-trash"></i></button></div>
                    </div>`);
                attrIndex++;
            });
            $(document).on('click', '.remove-attr-btn', function() {
                $(this).closest('.attr-row').remove();
            });

            $('#attr-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status) Swal.fire('Success', res.message, 'success').then(() => window
                            .location.href = '{{ route('admin.attribute-sets.index') }}');
                    },
                    error: function() {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                });
            });
        </script>
    @endpush
