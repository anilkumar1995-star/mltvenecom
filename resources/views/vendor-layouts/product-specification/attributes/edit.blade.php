@extends('admin-layouts.app')
@section('title','Edit Attribute')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.productattributes.Index') }}">Specification Attributes</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>Edit Attribute</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form method="POST" action="{{ route('admin.productAttribute.update', $attribute->id) }}" id="attributeForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $attribute->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Specification Group</label>
                                    <select name="group_id" class="form-select" required>
                                        <option value="">Select Group</option>
                                        @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ $attribute->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="text" {{ $attribute->type == 'text' ? 'selected' : '' }}>Text</option>
                                        <option value="textarea" {{ $attribute->type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                        <option value="select" {{ $attribute->type == 'select' ? 'selected' : '' }}>Select</option>
                                        <option value="checkbox" {{ $attribute->type == 'checkbox' ? 'selected' : '' }}>Checkbox</option>
                                        <option value="radio" {{ $attribute->type == 'radio' ? 'selected' : '' }}>Radio</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Default Value</label>
                                    <textarea name="default_value" class="form-control" rows="2">{{ $attribute->default_value }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title">Publish</h4></div>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">Update</button>
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
    $(document).ready(function() {
        $("#attributeForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        Swal.fire('Success!', data.message, 'success').then(() => {
                            window.location.href = "{{ route('admin.productattributes.Index') }}";
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
