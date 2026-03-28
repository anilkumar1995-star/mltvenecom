@extends('frontend.layouts.app')

@section('title', 'Become a Vendor')

@section('content')
<main>
    <div class="bb-customer-page">
        <div class="container">
            <div class="customer-body">
                <div class="row g-0">
                    <div class="col-lg-3 col-xl-3 d-none d-lg-block">
                        <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                            <div class="bb-customer-sidebar flex-1">
                                <div class="bb-customer-sidebar-heading">
                                    <div class="d-flex align-items-center gap-3 p-4">
                                        <div class="position-relative">
                                            <img class="rounded-circle border border-2 border-white shadow-sm" style="width:48px;height:48px;" src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}">
                                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:12px;height:12px;"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="name fw-semibold text-truncate">{{ $customer->name }}</div>
                                            <div class="email text-muted small text-truncate">{{ $customer->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                @include('frontend.customer.sidebar', ['active' => 'become-vendor'])
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-xl-9">
                        <div class="bb-profile-content p-4 p-md-5">
                            <div class="bb-profile-header mb-4 text-center">
                                <h1 class="bb-profile-header-title h2 mb-2"> Become a Vendor </h1>
                                <p class="text-muted">Fill in your store details to start selling on our platform.</p>
                            </div>
                            
                            <div class="bb-profile-main">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                    <div class="card-body p-4 p-md-5">
                                        <form action="{{ route('frontend.customer.become-vendor.post') }}" method="POST">
                                            @csrf
                                            <div class="row g-4">
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="shop_name">Shop Name</label>
                                                    <input class="form-control" type="text" id="shop_name" name="shop_name" value="{{ old('shop_name') }}" required placeholder="e.g. My Amazing Store">
                                                    @error('shop_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="shop_url">Shop URL (Slug)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light text-muted small">{{ url('/stores') }}/</span>
                                                        <input class="form-control" type="text" id="shop_url" name="shop_url" value="{{ old('shop_url') }}" required placeholder="my-shop">
                                                    </div>
                                                    @error('shop_url') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="phone">Store Phone Number</label>
                                                    <input class="form-control" type="text" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required placeholder="e.g. 9876543210">
                                                    @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label fw-semibold" for="pan_number">PAN Card Number</label>
                                                    <input class="form-control" type="text" id="pan_number" name="pan_number" value="{{ old('pan_number', $customer->pan_number) }}" required placeholder="e.g. ABCDE1234F">
                                                    @error('pan_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label fw-semibold" for="aadhar_number">Aadhar Card Number</label>
                                                    <input class="form-control" type="text" id="aadhar_number" name="aadhar_number" value="{{ old('aadhar_number', $customer->aadhar_number) }}" required placeholder="e.g. 1234 5678 9012">
                                                    @error('aadhar_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                                </div>
                                                
                                                <div class="col-12 mt-5">
                                                    <div class="form-check mb-4">
                                                        <input class="form-check-input" type="checkbox" id="agree" required>
                                                        <label class="form-check-label text-muted small" for="agree">
                                                            I agree to the <a href="#" class="text-primary fw-bold">Terms & Conditions</a> and understand my application will be reviewed by admin.
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm">
                                                        Submit Vendor Application
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="mt-5 text-center">
                                    <h5 class="text-muted mb-4">Why sell with us?</h5>
                                    <div class="row g-4 justify-content-center">
                                        <div class="col-md-4">
                                            <div class="p-3">
                                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                                </div>
                                                <h6>Wide Audience</h6>
                                                <p class="small text-muted">Reach thousands of potential customers across the country.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="p-3">
                                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1v22m11-18H1m22 14H1"/></svg>
                                                </div>
                                                <h6>Low Platform Fee</h6>
                                                <p class="small text-muted">Keep more of your profits with our industry-best commission rates.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="p-3">
                                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                                </div>
                                                <h6>Easy Management</h6>
                                                <p class="small text-muted">A dedicated vendor dashboard to manage products and orders.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
