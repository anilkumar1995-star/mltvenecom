@extends('admin-layouts.app')
@section('title','Edit FAQ')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQs</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form id="faq-form" action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-header"><h4 class="card-title">FAQ Details</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Question</label>
                                    <input type="text" name="question" class="form-control" required value="{{ $faq->question }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">Answer</label>
                                    <textarea name="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="published" {{ $faq->status == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ $faq->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Update</button>
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
$('#faq-form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'), method: 'POST', data: new FormData(this), processData: false, contentType: false,
        success: function(res) { if (res.status) Swal.fire('Success', res.message, 'success').then(() => window.location.href = '{{ route("admin.faqs.index") }}'); },
        error: function() { Swal.fire('Error', 'Something went wrong!', 'error'); }
    });
});
</script>
@endpush
