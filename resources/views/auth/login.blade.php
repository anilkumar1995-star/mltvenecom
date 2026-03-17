@extends('frontend.layouts.app')
@section('title', 'Login')
@section('content')
    <style>
        .auth-card {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            background: #fff;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }
    </style>
    <section class="tp-page-area pb-80 pt-50" style="background-color: #f3f5f7;">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="auth-card auth-card__horizontal row g-0">
                        <div class="col-md-6 auth-card__left d-none d-md-block">
                            <img src="{{ asset('themes/shofy-grocery/images/auth-banner.png') }}"
                                class="auth-card__banner w-100 h-100" alt="Login to your account"
                                style="object-fit: cover; min-height: 500px; border-radius: 12px 0 0 12px;">
                        </div>
                        <div class="col-md-6 auth-card__right bg-white" style="border-radius: 0 12px 12px 0;">
                            <div class="p-4 p-lg-5">
                                <div class="auth-card__header mb-4">
                                    <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                        <div class="auth-card__header-icon bg-light p-3 rounded text-primary">
                                            <i class="fas fa-lock fa-2x"></i>
                                        </div>
                                        <div>
                                            <h3 class="auth-card__header-title fs-4 mb-1">Login to your account</h3>
                                            <p class="auth-card__header-description text-muted small">Your personal data
                                                will be used to support your experience throughout this website, to manage
                                                access to your account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="auth-card__body">
                                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                                        @csrf
                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="position-relative">
                                                <span
                                                    class="auth-input-icon position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input class="form-control ps-5 py-2" placeholder="Email address"
                                                    name="email" type="email" id="email" required autofocus
                                                    value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 position-relative">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative">
                                                <span
                                                    class="auth-input-icon position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input type="password" name="password" id="password"
                                                    class="form-control ps-5 py-2" placeholder="Password" required>
                                            </div>
                                            @error('password')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row g-0 mb-3 align-items-center">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">Remember me</label>
                                                </div>
                                            </div>
                                            <div class="col-6 text-end">
                                                <a href="{{ route('password.request') }}"
                                                    class="text-decoration-none small">Forgot password?</a>
                                            </div>
                                        </div>

                                        <div class="d-grid mb-4">
                                            <button class="btn btn-primary py-2" type="submit">
                                                Login <i class="fas fa-arrow-right ms-2"></i>
                                            </button>
                                        </div>

                                        <div class="text-center small">
                                            Don't have an account? <a href="{{ route('register') }}"
                                                class="text-decoration-none fw-bold">Register now</a>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var formData = form.serialize();
        
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.text-danger').remove();
        $('.alert-danger').remove();

        var submitBtn = form.find('button[type="submit"]');
        var originalBtnText = submitBtn.html();
        
        submitBtn.html('<span class="spinner-border spinner-border-sm me-2"></span> Logging in...').attr('disabled', true);

        Swal.fire({
            title: 'Authenticating...',
            text: 'Please wait while we verify your credentials.',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: url,
            type: method,
            data: formData,
            dataType: 'json',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Login successful!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = response.redirect || '/';
                    });
                } else {
                    submitBtn.html(originalBtnText).attr('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Login failed. Please try again.',
                    });
                }
            },
            error: function(xhr) {
                submitBtn.html(originalBtnText).attr('disabled', false);
                
                if (xhr.status === 422) { // Validation errors
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger mb-4 small"><ul class="mb-0 text-start">';
                    
                    $.each(errors, function(field, messages) {
                        var inputField = $('#' + field);
                        if (inputField.length === 0) {
                             inputField = $('[name="' + field + '"]');
                        }
                        
                        inputField.addClass('is-invalid');
                        inputField.closest('.mb-3').append('<span class="text-danger small mt-1 d-block">' + messages[0] + '</span>');
                        
                        errorHtml += '<li>' + messages[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    
                    form.before(errorHtml);
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Failed',
                        text: 'Please check your credentials.',
                    });
                } else if (xhr.status === 401 || xhr.status === 403) {
                    var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Invalid credentials.';
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: msg,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again later.',
                    });
                }
            }
        });
    });
});
</script>
@endpush
