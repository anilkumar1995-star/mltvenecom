@extends('admin-layouts.app')
@section('title', 'Edit Simple Slider')
@section('content')

<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('home') }}">DASHBOARD</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.simple-sliders.index') }}">SIMPLE SLIDERS</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">EDIT SLIDER</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.simple-sliders.update', $slider->id) }}" method="POST" id="sliderForm">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="gap-3 col-md-9">
                        <div class="alert alert-info d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle me-2"></i>
                            You are editing "<strong>English</strong>" version
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label required" for="name">
                                            Name
                                        </label>
                                        <input class="form-control" placeholder="Name" name="name" type="text" id="name" value="{{ old('name', $slider->name) }}" required>
                                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label required" for="key">
                                            Key
                                        </label>
                                        <input class="form-control" placeholder="Key" name="key" type="text" id="key" value="{{ old('key', $slider->key) }}" required>
                                        @error('key')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label" for="description">
                                                Description
                                            </label>
                                            <span class="text-muted small">(0/400)</span>
                                        </div>
                                        <textarea class="form-control" rows="4" placeholder="Short description" id="description" name="description" cols="50">{{ old('description', $slider->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slider Items -->
                        <div class="card mt-4">
                            <div class="card-header border-bottom-0 pb-0">
                                <div class="d-flex align-items-center justify-content-between w-100 flex-wrap gap-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-primary btn-sm add-slider-item" type="button" onclick="window.location='{{ route('admin.simple-sliders.items.create', ['slider_id' => $slider->id]) }}'">
                                            <i class="fas fa-plus me-1"></i> Add new item
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-table mt-3">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th width="40" class="text-center"><input type="checkbox" class="form-check-input" id="checkAllItems"></th>
                                                <th width="80" class="text-secondary text-uppercase fs-6">IMAGE</th>
                                                <th class="text-secondary text-uppercase fs-6">TITLE</th>
                                                <th class="text-secondary text-uppercase fs-6">LINK</th>
                                                <th width="80" class="text-secondary text-uppercase fs-6 text-center">ORDER</th>
                                                <th width="100" class="text-center text-secondary text-uppercase fs-6">OPERATIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($slider->sliderItems as $item)
                                            <tr>
                                                <td class="text-center"><input type="checkbox" class="form-check-input row-checkbox-item" value="{{ $item->id }}"></td>
                                                <td>
                                                    <div class="p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                        @if($item->image)
                                                            <img src="{{ asset($item->image) }}" alt="" class="img-fluid" style="max-height: 100%;">
                                                        @else
                                                            <i class="fas fa-image fs-3 text-muted"></i>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('admin.simple-sliders.items.edit', $item->id) }}" class="text-primary text-decoration-none fw-medium">{{ $item->title }}</a></td>
                                                <td>{{ $item->link }}</td>
                                                <td class="text-center">{{ $item->order }}</td>
                                                <td class="text-center no-column-visibility text-nowrap">
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <a href="{{ route('admin.simple-sliders.items.edit', $item->id) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" onclick="deleteItem({{ $item->id }})" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr><td colspan="6" class="text-center text-muted py-4">No slider items added yet.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Publish</h4>
                            </div>
                            <div class="card-body">
                                <div class="btn-list d-flex flex-column gap-2">
                                    <button class="btn btn-primary d-flex align-items-center justify-content-center w-100" type="submit" name="submit" value="save">
                                        <i class="fas fa-save me-1"></i> Save
                                    </button>
                                    <button class="btn btn-light d-flex align-items-center justify-content-center w-100" type="submit" name="submit" value="save_and_exit">
                                        <i class="fas fa-sign-out-alt me-1"></i> Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">Languages</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('flags/us.svg') }}" style="width: 24px; margin-right: 8px;">
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>English</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="translations-wrap">
                                    <div class="text-muted small mb-2 fw-bold">Translations</div>
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('flags/sa.svg') }}" style="width: 16px; margin-right: 5px;"> Arabic</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('flags/vn.svg') }}" style="width: 16px; margin-right: 5px;"> Tiếng Việt</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span><img src="{{ asset('flags/fr.svg') }}" style="width: 16px; margin-right: 5px;"> Français</span>
                                            <a href="#" class="text-decoration-none"><i class="fas fa-plus"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes mb-3">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <label class="form-label required" for="status">Status</label>
                                </h4>
                            </div>
                            <div class="card-body">
                                <select class="form-select" required="required" id="status" name="status">
                                    <option value="published" {{ $slider->status == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ $slider->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

@endsection

@push('styles')
<style>
    .breadcrumb-arrows .breadcrumb-item+.breadcrumb-item::before {
        content: "/";
        padding: 0 5px;
        color: #adb5bd;
    }
    .breadcrumb-item a {
        text-decoration: none;
        color: #206bc4;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .breadcrumb-item.active a {
        color: #6c7a91;
        font-size: 11px;
        font-weight: 600;
    }
    .breadcrumb-item.active h1 {
        font-size: 11px;
    }
    .table thead th {
        background: #f8f9fa;
        border-top: none;
        border-bottom: 1px solid #e6e8e9;
        color: #6c7a91;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .datatable tr td {
        border-bottom: 1px solid #f1f1f1;
        padding: 12px 8px;
    }
    .btn-light {
        background: #fff;
        border-color: #e6e8e9;
        color: #182433;
    }
</style>
@endpush

@push('scripts')
<script>
    $('#checkAllItems').on('change', function() {
        $('.row-checkbox-item').prop('checked', $(this).prop('checked'));
    });

    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this item?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("admin/simple-sliders/items") }}/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(res) {
                        if (res.status === true) {
                            Swal.fire({ icon: 'success', title: 'Deleted!', text: res.message }).then(() => { location.reload(); });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error', text: res.message });
                        }
                    }
                });
            }
        });
    }
</script>
@endpush
