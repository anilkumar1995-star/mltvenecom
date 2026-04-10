@extends('vendor-layouts.app')
@section('title', 'Store Settings')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">Store Settings</h2>
                    <div class="text-muted mt-1">Manage your store's public profile and contact info</div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div><svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg></div>
                        <div>{{ session('success') }}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <form action="{{ route('frontend.vendor.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row row-cards">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">General Information</h3></div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label required">Store Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $store->name) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Store Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $store->email) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Store Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $store->phone) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" class="form-control" name="company" value="{{ old('company', $store->company) }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Address</label>
                                        <textarea class="form-control" name="address" rows="2">{{ old('address', $store->address) }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city" value="{{ old('city', $store->city) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" name="state" value="{{ old('state', $store->state) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $store->zip_code) }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="4">{{ old('description', $store->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-3">
                            <div class="card-header"><h3 class="card-title">Store Branding</h3></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Store Logo</label>
                                    <div class="mb-2">
                                        @php
                                            $logoUrl = $store->logo ? (str_starts_with($store->logo, 'http') ? $store->logo : 'https://images.incomeowl.in/incomeowl/b2b/images/' . $store->logo) : asset('js/logo-white.png');
                                        @endphp
                                        <img src="{{ $logoUrl }}" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                    <input type="file" class="form-control" name="logo_file">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Cover Image</label>
                                    <div class="mb-2">
                                        @php
                                            $coverUrl = $store->cover_image ? (str_starts_with($store->cover_image, 'http') ? $store->cover_image : 'https://images.incomeowl.in/incomeowl/b2b/images/' . $store->cover_image) :  asset('home/placeholder.png');
                                        @endphp
                                        <img src="{{ $coverUrl }}" class="img-thumbnail" style="max-height: 100px; width: 100%; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" name="cover_file">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
