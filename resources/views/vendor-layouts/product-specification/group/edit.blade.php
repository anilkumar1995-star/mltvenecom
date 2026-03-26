@extends('admin-layouts.app')
@section('title','Edit Group')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.group.Index') }}">Specification Groups</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a>Edit Group</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <form method="POST" action="{{ route('admin.group.update', $group->id) }}" id="groupForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $group->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $group->description }}</textarea>
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
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $("#groupForm").on('submit', function(e) {
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
                            window.location.href = "{{ route('admin.group.Index') }}";
                        });
                    }
                }
            });
        });
    });
</script>
@endpush