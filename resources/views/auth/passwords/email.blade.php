@extends('frontend.layouts.app')

@section('title', 'Forgot Password')

@section('content')
<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg mb-30 text-start pt-30 pb-30 page_speed_668549954">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Forgot Password</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Login </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-80 pt-50">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-xl-6 col-lg-8">
                    <div class="auth-card card border-0 shadow-sm" style="border-radius: 12px;">
                        <div class="auth-card__header border-0 bg-transparent p-4 pb-0">
                            <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                <div class="auth-card__header-icon bg-light p-3 rounded text-primary">
                                    <svg class="icon text-primary svg-icon-ti-ti-lock-question" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 21h-8a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h10c.265 0 .518 .052 .75 .145"></path>
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                        <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                        <path d="M19 22v.01"></path>
                                        <path d="M19 19a2.003 2.003 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                                    </svg>
                                </div>
                                <div class="mt-2">
                                    <h3 class="auth-card__header-title fs-4 mb-2 fw-bold">Forgot Password</h3>
                                    <p class="auth-card__header-description text-muted small">Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
                                </div>
                            </div>
                        </div>
                        <div class="auth-card__body p-4 pt-4">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" id="forgotPasswordForm">
                                @csrf
                                <div class="mb-4 position-relative">
                                    <label class="form-label fw-medium text-dark" for="email">Email</label>
                                    <div class="position-relative">
                                        <span class="auth-input-icon position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                                            <svg class="icon svg-icon-ti-ti-mail" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10"></path>
                                                <path d="M3 7l9 6l9 -6"></path>
                                            </svg>
                                        </span>
                                        <input class="form-control ps-5 py-2 @error('email') is-invalid @enderror" placeholder="Email address" name="email" type="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary py-2 fw-bold" type="submit">
                                        Send Password Reset Link
                                    </button>
                                </div>
                                
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-decoration-none small text-muted hover-underline">
                                        <i class="fas fa-arrow-left me-1"></i> Back to login page
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('styles')
<style>
    .auth-card {
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.05);
    }
    .hover-underline:hover {
        text-decoration: underline !important;
        color: var(--primary-color) !important;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: none;
    }
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
</style>
@endpush
