@extends('frontend.layouts.app')

@section('title', 'Reset Password')

@section('content')
<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg mb-30 text-start pt-30 pb-30">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Create New Password</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Create New Password </span>
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
                                    <svg class="icon text-primary svg-icon-ti-ti-lock-open" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                        <path d="M8 11v-5a4 4 0 0 1 8 0"></path>
                                    </svg>
                                </div>
                                <div class="mt-2">
                                    <h3 class="auth-card__header-title fs-4 mb-2 fw-bold">Create New Password</h3>
                                    <p class="auth-card__header-description text-muted small">Please choose a safe password you can remember.</p>
                                </div>
                            </div>
                        </div>
                        <div class="auth-card__body p-4 pt-4">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-4 position-relative">
                                    <label class="form-label fw-medium text-dark" for="email">Email</label>
                                    <div class="position-relative">
                                        <input class="form-control ps-3 py-2 bg-light @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" name="email" type="email" id="email" required autocomplete="email" readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 position-relative">
                                    <label class="form-label fw-medium text-dark" for="password">New Password</label>
                                    <div class="position-relative">
                                        <input class="form-control ps-3 py-2 @error('password') is-invalid @enderror" name="password" type="password" id="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 position-relative">
                                    <label class="form-label fw-medium text-dark" for="password-confirm">Confirm Password</label>
                                    <div class="position-relative">
                                        <input class="form-control ps-3 py-2" name="password_confirmation" type="password" id="password-confirm" required autocomplete="new-password">
                                    </div>
                                </div>
                                
                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary py-2 fw-bold" type="submit">
                                        Create New Password
                                    </button>
                                </div>
                                
                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-decoration-none small text-muted hover-underline">
                                        Back to login page
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
