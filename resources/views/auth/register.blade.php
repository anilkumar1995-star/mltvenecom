@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')
    <style>
        .auth-card {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            background: #fff;
        }
    </style>
    <section class="tp-page-area pb-80 pt-50" style="background-color: #f3f5f7;">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="auth-card auth-card__horizontal row g-0">
                        <div class="col-md-6 auth-card__left d-none d-md-block">
                            <img src="{{ asset('themes/shofy-grocery/images/auth-banner.png') }}"
                                class="auth-card__banner w-100 h-100" alt="Register"
                                style="object-fit: cover; min-height: 600px; border-radius: 12px 0 0 12px;">
                        </div>
                        <div class="col-md-6 auth-card__right bg-white" style="border-radius: 0 12px 12px 0;">
                            <div class="p-4 p-lg-5">
                                <div class="auth-card__header mb-4">
                                    <h3 class="auth-card__header-title fs-4 mb-1">Create an Account</h3>
                                    <p class="auth-card__header-description text-muted small">Already have an account? <a
                                            href="{{ route('login') }}">Log in</a></p>
                                </div>

                                <div class="auth-card__body">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="name">Your Name</label>
                                            <input class="form-control py-2" placeholder="Full Name" name="name"
                                                type="text" id="name" required autofocus
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control py-2" placeholder="Email address" name="email"
                                                type="email" id="email" required value="{{ old('email') }}">
                                            @error('email')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control py-2"
                                                placeholder="Min. 8 characters" required>
                                            @error('password')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="password-confirm">Confirm Password</label>
                                            <input type="password" name="password_confirmation" id="password-confirm"
                                                class="form-control py-2" placeholder="Repeat password" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small text-uppercase text-muted">Register
                                                as</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="type-customer" value="customer"
                                                        {{ old('type', 'customer') == 'customer' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="type-customer">Customer</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type"
                                                        id="type-vendor" value="vendor"
                                                        {{ old('type') == 'vendor' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="type-vendor">Vendor</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="vendor-fields w-100 p-3 mb-3 bg-light rounded border"
                                            style="display: {{ old('type') == 'vendor' ? 'block' : 'none' }}">
                                            <div class="mb-3">
                                                <label class="form-label">Shop Name</label>
                                                <input id="shop_name" type="text" class="form-control" name="shop_name"
                                                    value="{{ old('shop_name') }}">
                                                @error('shop_name')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Shop URL</label>
                                                <input id="website" type="text" class="form-control" name="website"
                                                    value="{{ old('website') }}">
                                                @error('website')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input id="mobile" type="text" class="form-control" name="mobile"
                                                    value="{{ old('mobile') }}">
                                                @error('mobile')
                                                    <span class="text-danger small">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4 form-check">
                                            <input type="checkbox" name="agree" id="agree"
                                                class="form-check-input" required>
                                            <label class="form-check-label small" for="agree">I agree to the <a
                                                    href="#">Terms and Privacy Policy</a></label>
                                        </div>

                                        <div class="d-grid mb-4">
                                            <button class="btn btn-primary py-2" type="submit">Register Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeRadios = document.querySelectorAll('input[name="type"]');
            const vendorFields = document.querySelector('.vendor-fields');
            const vendorInputs = vendorFields.querySelectorAll('input');

            function toggleVendorFields() {
                const selectedType = document.querySelector('input[name="type"]:checked').value;
                if (selectedType === 'vendor') {
                    vendorFields.style.display = 'block';
                    vendorInputs.forEach(input => input.required = true);
                } else {
                    vendorFields.style.display = 'none';
                    vendorInputs.forEach(input => input.required = false);
                }
            }

            typeRadios.forEach(radio => radio.addEventListener('change', toggleVendorFields));
            if (document.querySelector('input[name="type"]:checked')) {
                toggleVendorFields();
            }
        });
    </script>
@endpush
