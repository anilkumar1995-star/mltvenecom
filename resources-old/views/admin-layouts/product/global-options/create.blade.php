@extends('admin-layouts.app')
@section('title','Create Global Option')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.global-options.index') }}">Global Options</a></li>
                                <li class="breadcrumb-item active">Create</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form id="option-form" action="{{ route('admin.global-options.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="card-title">Option Details</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" name="name" class="form-control" required placeholder="e.g. Warranty, RAM">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Option Type</label>
                                        <select name="option_type" class="form-select" required>
                                            <option value="dropdown">Dropdown</option>
                                            <option value="checkbox">Checkbox</option>
                                            <option value="radio">Radio Button</option>
                                            <option value="text">Text Field</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label required">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="published">Published</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-check">
                                        <input type="checkbox" name="required" class="form-check-input">
                                        <span class="form-check-label">Required option</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Option Values</h4>
                                <div class="card-actions">
                                    <button type="button" class="btn btn-sm btn-primary" id="add-value-btn">
                                        <i class="fas fa-plus me-1"></i> Add Value
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="option-values-container">
                                    <div class="option-value-row row mb-2" data-index="0">
                                        <div class="col-md-4">
                                            <input type="text" name="option_values[0][option_value]" class="form-control" placeholder="Value (e.g. 1 Year)">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" step="0.01" name="option_values[0][affect_price]" class="form-control" placeholder="Price +/-" value="0">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="option_values[0][affect_type]" class="form-select">
                                                <option value="fixed">Fixed (+/-)</option>
                                                <option value="percent">Percent (%)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-icon remove-value-btn"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save me-1"></i> Save Option
                                </button>
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
let valueIndex = 1;

$('#add-value-btn').on('click', function() {
    const html = `
        <div class="option-value-row row mb-2" data-index="${valueIndex}">
            <div class="col-md-4">
                <input type="text" name="option_values[${valueIndex}][option_value]" class="form-control" placeholder="Value">
            </div>
            <div class="col-md-3">
                <input type="number" step="0.01" name="option_values[${valueIndex}][affect_price]" class="form-control" placeholder="Price +/-" value="0">
            </div>
            <div class="col-md-3">
                <select name="option_values[${valueIndex}][affect_type]" class="form-select">
                    <option value="fixed">Fixed (+/-)</option>
                    <option value="percent">Percent (%)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-icon remove-value-btn"><i class="fas fa-trash"></i></button>
            </div>
        </div>`;
    $('#option-values-container').append(html);
    valueIndex++;
});

$(document).on('click', '.remove-value-btn', function() {
    $(this).closest('.option-value-row').remove();
});

$('#option-form').on('submit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);
    let submitBtn = $(this).find('button[type="submit"]');
    submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            if (res.status) {
                Swal.fire('Success', res.message, 'success').then(() => {
                    window.location.href = '{{ route("admin.global-options.index") }}';
                });
            }
        },
        error: function(xhr) {
            submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Save Option');
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMsg = '';
                $.each(errors, function(key, value) { errorMsg += value[0] + '<br>'; });
                Swal.fire('Validation Error', errorMsg, 'error');
            } else {
                Swal.fire('Error', 'Something went wrong!', 'error');
            }
        }
    });
});
</script>
@endpush
