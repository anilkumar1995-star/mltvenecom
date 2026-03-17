@extends('admin-layouts.app')
@section('title', 'Admin Profile')
@section('content')
@php
    $name_parts = explode(' ', Auth::user()->name, 2);
    $first_name = $name_parts[0] ?? '';
    $last_name = $name_parts[1] ?? '';
@endphp
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">System</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Users</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">{{ Auth::user()->name }}</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible bg-success-lt" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg class="icon alert-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12l5 5l10 -10"></path></svg>
                        </div>
                        <div>{{ session('success') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible bg-danger-lt" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg class="icon alert-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v2m0 4v.01m-6.938 4h13.876c1.108 0 1.957 -1.066 1.574 -2.106l-6.938 -12.5a1.734 1.734 0 0 0 -3.148 0l-6.938 12.5a1.134 1.134 0 0 0 1.574 2.106z"></path></svg>
                        </div>
                        <div>
                            <ul class="mb-0 list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <div class="user-profile">
                <div class="card">
                    <div class="card-header">
                        <ul data-bs-toggle="tabs" class="nav nav-tabs card-header-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#profile" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                                    <svg class="icon me-2 svg-icon-ti-ti-user" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                    User profile
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a href="#avatar" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <svg class="icon me-2 svg-icon-ti-ti-camera-selfie" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2"></path>
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path>
                                        <path d="M15 11l.01 0"></path>
                                        <path d="M9 11l.01 0"></path>
                                    </svg>
                                    Avatar
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a href="#change-password" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <svg class="icon me-2 svg-icon-ti-ti-lock" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                    </svg>
                                    Change password
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a href="#preferences" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                                    <svg class="icon me-2 svg-icon-ti-ti-settings" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065"></path>
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                    </svg>
                                    Preferences
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            {{-- User Profile Tab --}}
                            <div class="tab-pane active show" id="profile" role="tabpanel">
                                <form method="POST" action="{{ route('admin.profile.update') }}" id="profile-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row row-cols-lg-2">
                                        <div class="mb-3 position-relative">
                                            <label class="form-label required" for="first_name">Full Name</label>
                                            <input class="form-control" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" required>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label required" for="email">Email</label>
                                            <input class="form-control" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="phone">Phone</label>
                                            <input class="form-control" name="mobile" type="text" value="{{ old('mobile', Auth::user()->mobile) }}" placeholder="Phone">
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="role">Role</label>
                                            <input class="form-control" type="text" value="{{ ucfirst(Auth::user()->role) }}" readonly disabled>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent mt-3 p-0 pt-3 text-end">
                                        <button class="btn btn-primary" type="submit">
                                            <svg class="icon icon-left svg-icon-ti-ti-circle-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Avatar Tab --}}
                            <div class="tab-pane" id="avatar" role="tabpanel">
                                <div class="crop-image-container">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Avatar</label>
                                        <div class="text-center">
                                            <div class="mb-3 d-flex justify-content-center">
                                                @if(Auth::user()->avatar)
                                                    <img src="{{ \App\Helpers\ImageHelper::getImageUrl() . Auth::user()->avatar }}" class="avatar avatar-2xl rounded-pill" alt="{{ Auth::user()->name }}">
                                                @else
                                                    <img src="{{ asset('avatars/no_user.webp') }}" class="avatar avatar-2xl rounded-pill" alt="{{ Auth::user()->name }}">
                                                @endif
                                            </div>
                                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" id="avatar-form">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                <div class="mb-3">
                                                    <input class="form-control" type="file" name="avatar_file" accept="image/*">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Update Avatar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Change Password Tab --}}
                            <div class="tab-pane" id="change-password" role="tabpanel">
                                <form method="POST" action="{{ route('admin.profile.update') }}" id="password-form">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 position-relative">
                                                <label class="form-label required" for="old_password">Current Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter your current password" required autocomplete="new-password">
                                                    <span class="btn btn-outline-secondary" onclick="togglePassword('old_password')">
                                                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 position-relative">
                                            <label class="form-label required" for="password">New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your new password" required autocomplete="new-password">
                                                <span class="btn btn-outline-secondary" onclick="togglePassword('password')">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3 position-relative">
                                            <label class="form-label required" for="password_confirmation">Confirm New Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter your new password" required autocomplete="new-password">
                                                <span class="btn btn-outline-secondary" onclick="togglePassword('password_confirmation')">
                                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent mt-3 p-0 pt-3 text-end">
                                        <button class="btn btn-primary" type="submit">
                                            <svg class="icon icon-left svg-icon-ti-ti-circle-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Preferences Tab --}}
                            <div class="tab-pane" id="preferences" role="tabpanel">
                                <form method="POST" action="#">
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="locale">Admin panel language</label>
                                        <select class="form-select" name="locale">
                                            <option value="en" selected>English - en</option>
                                            <option value="hi">हिन्दी - hi</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label">Admin language direction</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="locale_direction" value="ltr" checked>
                                            <span class="form-check-label">Left to Right</span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="locale_direction" value="rtl">
                                            <span class="form-check-label">Right to Left</span>
                                        </div>
                                    </div>

                                    <div class="mb-3 position-relative">
                                        <label class="form-label text-dark">Theme mode</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="theme_mode" value="light" checked>
                                            <span class="form-check-label">Light</span>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="theme_mode" value="dark">
                                            <span class="form-check-label">Dark</span>
                                        </div>
                                    </div>

                                    <div class="card-footer bg-transparent mt-3 p-0 pt-3 text-end">
                                        <button class="btn btn-primary" type="button" disabled>
                                            <svg class="icon icon-left svg-icon-ti-ti-circle-check" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M9 12l2 2l4 -4"></path>
                                            </svg>
                                            Update Preferences
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function togglePassword(id) {
        var x = document.getElementById(id);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endsection
