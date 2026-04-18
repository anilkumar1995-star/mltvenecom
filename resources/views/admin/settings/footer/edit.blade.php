@extends('admin-layouts.app')
@section('title', 'Edit Footer Settings')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1 text-muted" href="{{ route('admin.footer-settings.index') }}">Settings</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Edit Footer</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.footer-settings.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
                           <i class="fas fa-arrow-left me-1"></i> Back to View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            <form action="{{ route('admin.footer-settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-4 shadow-sm border-0" style="border-radius: 12px;">
                            <div class="card-header border-bottom bg-light-subtle">
                                <h3 class="card-title fw-bold">General Footer Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Site Name / Copyright Text</label>
                                    <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name ?? 'All Rights Reserved.' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Footer Description</label>
                                    <textarea name="footer_description" class="form-control" rows="5" required>{{ $settings->footer_description ?? '' }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <input type="text" name="footer_phone" class="form-control" value="{{ $settings->footer_phone ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <input type="email" name="footer_email" class="form-control" value="{{ $settings->footer_email ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Office Address</label>
                                    <input type="text" name="footer_address" class="form-control" value="{{ $settings->footer_address ?? '' }}" required>
                                </div>
                                
                                <div class="mt-4 mb-2">
                                    <h4 class="fw-bold border-bottom pb-2">Social Media Icons</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Facebook URL</label>
                                        <input type="text" name="facebook_url" class="form-control" value="{{ $settings->facebook_url ?? '#' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Twitter URL</label>
                                        <input type="text" name="twitter_url" class="form-control" value="{{ $settings->twitter_url ?? '#' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">YouTube URL</label>
                                        <input type="text" name="youtube_url" class="form-control" value="{{ $settings->youtube_url ?? '#' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">LinkedIn URL</label>
                                        <input type="text" name="linkedin_url" class="form-control" value="{{ $settings->linkedin_url ?? '#' }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Instagram URL</label>
                                        <input type="text" name="instagram_url" class="form-control" value="{{ $settings->instagram_url ?? '#' }}">
                                    </div>
                                </div>
                                
                                <div class="mt-4 mb-2">
                                    <h4 class="fw-bold border-bottom pb-2">Location Settings</h4>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Google Map Iframe URL (Only the src part)</label>
                                    <input type="text" name="contact_map_iframe" class="form-control" value="{{ $settings->contact_map_iframe ?? '' }}">
                                    <small class="text-muted">Example: https://maps.google.com/maps?q=YourAddress&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card mb-4 shadow-sm border-0" style="border-radius: 12px;">
                            <div class="card-header border-bottom bg-light-subtle">
                                <h3 class="card-title fw-bold">Footer Logo</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 text-center bg-light p-2 rounded">
                                    @if(isset($settings->footer_logo))
                                        <p class="small text-muted">Current Logo:</p>
                                        <img src="{{ \App\Helpers\ImageHelper::getImageUrl() }}{{ $settings->footer_logo }}" width="100" height="auto" alt="Logo Preview" class="mb-3 border">
                                    @else
                                        <span class="text-muted small">No Logo Uploaded</span>
                                    @endif
                                </div>
                                <label class="form-label fw-bold">Choose New Logo</label>
                                <input type="file" name="footer_logo" class="form-control">
                                <small class="text-muted d-block mt-2">Recommended size: 200x50px</small>
                            </div>
                        </div>
                        
                        <div class="card shadow-sm border-0 sticky-top" style="border-radius: 12px; top: 100px;">
                            <div class="card-body">
                                <p class="text-muted small mb-4">Clicking save will instantly update both the main footer and the contact page information across the site.</p>
                                <button type="submit" class="btn btn-success w-100 py-2 fw-bold shadow-sm" style="border-radius: 8px;">
                                    <i class="fas fa-save me-2"></i> Save All Changes
                                </button>
                                <a href="{{ route('admin.footer-settings.index') }}" class="btn btn-outline-secondary w-100 mt-3 py-2 fw-bold" style="border-radius: 8px;">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection
