@extends('admin-layouts.app')
@section('title','Create Tax')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.taxes.index') }}">Taxes</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form id="tax-form" action="{{ route('admin.taxes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="card-title">Tax Details</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="e.g. VAT, GST, Import Tax">
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label required">Percentage (%)</label>
                                        <input type="number" step="0.01" name="percentage" class="form-control" required value="0" min="0" max="100">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Priority</label>
                                        <input type="number" name="priority" class="form-control" value="0">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="published">Published</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
$('#tax-form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'), method: 'POST', data: new FormData(this), processData: false, contentType: false,
        success: function(res) { if (res.status) Swal.fire('Success', res.message, 'success').then(() => window.location.href = '{{ route("admin.taxes.index") }}'); },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let msg = '';
                $.each(errors, function(k, v) { msg += v[0] + '<br>'; });
                Swal.fire('Validation Error', msg, 'error');
            } else { Swal.fire('Error', 'Something went wrong!', 'error'); }
        }
    });
});
</script>
@endpush
