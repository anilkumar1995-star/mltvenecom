@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')
    {{-- SweetAlert2 CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <section class="tp-page-area pb-80 pt-50" style="background-color: #f3f5f7;">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="row g-0" style="box-shadow: 0 10px 40px rgba(0,0,0,0.05); border-radius: 12px; overflow:hidden;">
                        <div class="col-md-6 d-none d-md-block">
                            <img src="{{ asset('themes/shofy-grocery/images/auth-banner.png') }}"
                                class="w-100 h-100" alt="Register"
                                style="object-fit: cover; min-height: 600px;">
                        </div>
                        <div class="col-md-6 bg-white">
                            <div class="p-4 p-lg-5">
                                <div class="mb-4">
                                    <h3 class="fs-4 mb-1">Create an Account</h3>
                                    <p class="text-muted small">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                                </div>

                                @if(session('error'))
                                    <div class="alert alert-danger mb-4 small">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="alert alert-danger mb-4 small">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" id="registerForm">
                                    @csrf
                                    <input type="hidden" name="latitude" id="latitude" value="28.6139">
                                    <input type="hidden" name="longitude" id="longitude" value="77.2090">

                                    <div class="mb-3">
                                        <label class="form-label" for="name">Your Name</label>
                                        <input class="form-control py-2 {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                            placeholder="Full Name" name="name"
                                            type="text" id="name" required autofocus value="{{ old('name') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control py-2 {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                            placeholder="Email address" name="email"
                                            type="email" id="email" required value="{{ old('email') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password" 
                                            class="form-control py-2 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            placeholder="Min. 8 characters" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">Confirm Password</label>
                                        <input type="password" name="password_confirmation" id="password-confirm"
                                            class="form-control py-2" placeholder="Repeat password" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold small text-uppercase text-muted">Register As</label>
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
                                            <input id="shop_name" type="text" class="form-control {{ $errors->has('shop_name') ? 'is-invalid' : '' }}" 
                                                name="shop_name" value="{{ old('shop_name') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Shop URL</label>
                                            <input id="website" type="text" class="form-control" name="website"
                                                value="{{ old('website') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mobile Number</label>
                                            <input id="mobile" type="text" class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" 
                                                name="mobile" value="{{ old('mobile') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">PAN Card Number</label>
                                            <input id="pan_number" type="text" class="form-control {{ $errors->has('pan_number') ? 'is-invalid' : '' }}" 
                                                name="pan_number" value="{{ old('pan_number') }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Aadhar Card Number</label>
                                            <input id="aadhar_number" type="text" class="form-control {{ $errors->has('aadhar_number') ? 'is-invalid' : '' }}" 
                                                name="aadhar_number" value="{{ old('aadhar_number') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 form-check">
                                        <input type="checkbox" name="agree" id="agree" class="form-check-input" required>
                                        <label class="form-check-label small" for="agree">I agree to the <a href="#">Terms and Privacy Policy</a></label>
                                    </div>

                                    <div class="d-grid mb-4">
                                        <button class="btn btn-primary py-2" type="submit" id="registerBtn">Register Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {

    // Toggle vendor fields
    $('input[name="type"]').on('change', function() {
        if ($(this).val() === 'vendor') {
            $('.vendor-fields').slideDown(300);
        } else {
            $('.vendor-fields').slideUp(300);
        }
    });

    // Geolocation capture
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            $('#latitude').val(position.coords.latitude.toFixed(6));
            $('#longitude').val(position.coords.longitude.toFixed(6));
        }, function(error) {
            console.log('Geolocation not available, using defaults.');
        });
    }

    // Standard Form Submit with SweetAlert Loader
    $('#registerForm').on('submit', function() {
        var isVendor = $('input[name="type"]:checked').val() === 'vendor';

        // Disable button with spinner
        $('#registerBtn')
            .html('<span class="spinner-border spinner-border-sm me-1"></span> Processing...')
            .attr('disabled', true);

        // SweetAlert loading popup
        Swal.fire({
            title: isVendor ? 'Connecting to iPayments...' : 'Processing...',
            text: isVendor 
                ? 'Initiating Video KYC verification. Please wait...' 
                : 'Creating your account...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        return true; // Allow form to submit normally
    });
});
</script>
@endpush
