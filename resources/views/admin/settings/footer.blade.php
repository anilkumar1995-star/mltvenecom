@extends('admin-layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Footer Settings</h2>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <form action="{{ route('admin.footer-settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Footer Logo</label>
                            <input type="file" name="footer_logo" class="form-control">
                            @if(isset($settings['footer_logo']))
                                <div class="mt-2 text-center" style="background: #f8f9fa; padding: 10px;">
                                    <img src="{{ asset('/') }}{{ $settings['footer_logo'] }}" height="50" alt="Current Logo">
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Site Name / Copyright Text</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'All Rights Reserved.' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Footer Description</label>
                            <textarea name="footer_description" class="form-control" rows="3">{{ $settings['footer_description'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="footer_phone" class="form-control" value="{{ $settings['footer_phone'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="footer_email" class="form-control" value="{{ $settings['footer_email'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="footer_address" class="form-control" value="{{ $settings['footer_address'] ?? '' }}">
                        </div>
                        
                        <div class="col-md-12">
                            <hr>
                            <h4>Social Links</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Facebook URL</label>
                            <input type="text" name="facebook_url" class="form-control" value="{{ $settings['facebook_url'] ?? '#' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Twitter URL</label>
                            <input type="text" name="twitter_url" class="form-control" value="{{ $settings['twitter_url'] ?? '#' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">YouTube URL</label>
                            <input type="text" name="youtube_url" class="form-control" value="{{ $settings['youtube_url'] ?? '#' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">LinkedIn URL</label>
                            <input type="text" name="linkedin_url" class="form-control" value="{{ $settings['linkedin_url'] ?? '#' }}">
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h4>Contact Page Settings</h4>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Google Map Iframe URL (Only the src part)</label>
                            <input type="text" name="contact_map_iframe" class="form-control" value="{{ $settings['contact_map_iframe'] ?? '' }}">
                            <small class="text-muted">Example: https://maps.google.com/maps?q=YourAddress&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
