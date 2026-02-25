@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/ecommerce') }}">Ecommerce</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.spec.groups.index') }}">Specification Groups</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Create Specification Group</h4>
            <a href="{{ route('admin.spec.groups.index') }}" class="btn btn-outline-secondary">Back</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger"><ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul></div>
        @endif

        <form action="{{ route('admin.spec.groups.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card p-3">
                        <div class="mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="6" placeholder="Short description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card p-3">
                        <h6 class="mb-3">Publish</h6>
                        <div class="d-grid gap-2">
                            <button type="submit" name="action" value="save" class="btn btn-primary btn-block">
                                <i class="fas fa-save me-1"></i> Save
                            </button>
                            <button type="submit" name="action" value="save_exit" class="btn btn-outline-secondary btn-block">
                                <i class="fas fa-sign-out-alt me-1"></i> Save &amp; Exit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
