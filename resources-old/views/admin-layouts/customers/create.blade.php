@extends('admin-layouts.app')
@section('title', 'Create Customer')
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
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.customers.index') }}">Customers</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Create a customer</h1>
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
                <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data" class="ajax-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
                                        <li class="nav-item">
                                            <a href="#tabs-detail" class="nav-link active" data-bs-toggle="tab">Detail</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="tabs-detail">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Name</label>
                                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Email</label>
                                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="e.g. example@domain.com" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" name="is_vendor" value="1" {{ old('is_vendor') ? 'checked' : '' }}>
                                                            <span class="form-check-label">Is vendor?</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone</label>
                                                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date of birth</label>
                                                        <div class="input-icon">
                                                            <span class="input-icon-addon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                                            </span>
                                                            <input class="form-control" placeholder="Y-m-d" id="dob" name="dob" value="{{ old('dob') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Password</label>
                                                        <input type="password" class="form-control" name="password" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label required">Password confirmation</label>
                                                        <input type="password" class="form-control" name="password_confirmation" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Private notes</label>
                                                        <textarea class="form-control" name="private_notes" rows="4" placeholder="Private notes are only visible to admins"></textarea>
                                                        <small class="form-hint">Private notes are only visible to admins</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Publish</h4>
                                </div>
                                <div class="card-body">
                                    <div class="btn-list">
                                        <button class="btn btn-primary" type="submit" name="submitter" value="save">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                                <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                            </svg>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Status <span class="text-danger">*</span></h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" name="status" required>
                                        <option value="activated" selected>Activated</option>
                                        <option value="locked">Locked</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h4 class="card-title">Avatar</h4>
                                </div>
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <div class="avatar-preview-container" style="cursor: pointer;" onclick="document.getElementById('avatar').click()">
                                            <img id="avatar-preview" src="{{ asset('media/images/placeholder.png') }}" alt="Avatar" class="rounded mb-2" style="max-width: 150px; max-height: 150px; object-fit: cover; display: none;">
                                            <div id="avatar-placeholder" class="p-4 border border-dashed rounded bg-light">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                   <path d="M15 8h.01"></path>
                                                   <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12"></path>
                                                   <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5"></path>
                                                   <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3"></path>
                                                </svg>
                                                <div class="mt-2 text-muted">Choose image</div>
                                            </div>
                                        </div>
                                        <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*" onchange="previewAvatar(this)">
                                        <div class="mt-2">
                                            <a href="#" class="text-primary small">or Add from URL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
    

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                    document.getElementById('avatar-preview').style.display = 'inline-block';
                    document.getElementById('avatar-placeholder').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
