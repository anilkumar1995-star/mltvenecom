@extends('vendor-layouts.app')
@section('title', 'KYC Verification')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">KYC Verification</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-12">
                    
                    @php
                        $statusColors = [
                            'approved' => 'success',
                            'verified' => 'success',
                            'pending' => 'warning',
                            'rejected' => 'danger',
                        ];
                        $isVerified = ($user->kyc_status === 'approved' || $user->kyc_status === 'verified');
                        $color = $statusColors[$user->kyc_status] ?? 'secondary';
                    @endphp

                    {{-- Status Header Card --}}
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-status-top bg-{{ $color }}"></div>
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-0">
                                <div>
                                    <h3 class="card-title fw-bold mb-1">KYC Account Status</h3>
                                    <p class="text-secondary small mb-0">Identity verification profile for vendor services.</p>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-{{ $color }} text-white fs-4 px-3 py-2">
                                        {{ ucfirst($user->kyc_status ?? 'Not Verified') }}
                                    </span>
                                    @if($isVerified)
                                        <div class="text-success fw-bold mt-2 small">
                                            <i class="fa fa-certificate me-1"></i> VERIFIED VENDOR
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Success Message Alert --}}
                    @if($isVerified)
                    <div class="alert alert-success border-0 shadow-sm mb-4 d-flex align-items-center">
                        <div class="me-3">
                            <span class="avatar bg-success text-white rounded-circle"><i class="fa fa-check"></i></span>
                        </div>
                        <div>
                            <h4 class="alert-title fw-bold mb-0">Success! Documents Verified</h4>
                            <div class="text-secondary small">Your identity has been successfully verified. Your account is now fully active for all store operations.</div>
                        </div>
                    </div>
                    @endif

                    {{-- Identification Form Card --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h4 class="card-title fw-bold mb-0">Identification Details</h4>
                            @if($isVerified)
                                <span class="text-success small fw-bold"><i class="fa fa-lock me-1"></i> Locked & Verified</span>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <form id="kycForm" method="POST" action="{{ route('frontend.vendor.kyc.store') }}">
                                @csrf
                                <input type="hidden" name="latitude" id="latitude" value="28.6139">
                                <input type="hidden" name="longitude" id="longitude" value="77.2090">

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label required fw-bold mb-2">PAN Card Number</label>
                                            <div class="input-group input-group-flat border rounded {{ $isVerified ? 'bg-light' : '' }}">
                                                <span class="input-group-text bg-transparent border-0">
                                                    <i class="fa fa-id-card text-secondary"></i>
                                                </span>
                                                <input type="text" name="pan_number" class="form-control border-0 text-uppercase {{ $isVerified ? 'bg-transparent text-muted' : '' }}" 
                                                    placeholder="ABCDE1234F" value="{{ $user->pan_number }}" 
                                                    {{ $isVerified ? 'readonly disabled' : 'required' }} maxlength="10">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label required fw-bold mb-2">Aadhar Card Number</label>
                                            <div class="input-group input-group-flat border rounded {{ $isVerified ? 'bg-light' : '' }}">
                                                <span class="input-group-text bg-transparent border-0">
                                                    <i class="fa fa-address-card text-secondary"></i>
                                                </span>
                                                <input type="text" name="aadhar_number" class="form-control border-0 {{ $isVerified ? 'bg-transparent text-muted' : '' }}" 
                                                    placeholder="1234 5678 9012" value="{{ $user->aadhar_number }}" 
                                                    {{ $isVerified ? 'readonly disabled' : 'required' }} maxlength="16">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(!$isVerified)
                                <div class="mt-4 pt-3 border-top d-flex align-items-center justify-content-between">
                                    <div class="text-muted small">
                                        <i class="fa fa-lock me-1"></i> SSL Secure Verification
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold" id="kycBtn">
                                        <i class="fa fa-shield-alt me-2"></i> {{ $user->kyc_status === 'pending' ? 'Update & Re-verify' : 'Proceed to Verification' }}
                                    </button>
                                </div>
                                @else
                                <div class="mt-4 pt-3 border-top text-center">
                                    <a href="{{ route('frontend.vendor.dashboard') }}" class="btn btn-outline-primary px-5">
                                        <i class="fa fa-home me-2"></i> Go to Dashboard
                                    </a>
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            $('#latitude').val(position.coords.latitude.toFixed(6));
            $('#longitude').val(position.coords.longitude.toFixed(6));
        });
    }

    $(document).ready(function() {
        $('#kycForm').validate({
            submitHandler: function(form) {
                var btn = $('#kycBtn');
                var originalText = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm me-2"></span> Submitting...').attr('disabled', true);
                
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: $(form).serialize(),
                    success: function(res) {
                        if (res.status && res.redirect_url) {
                            Swal.fire({
                                icon: 'info',
                                title: 'KYC Initiated!',
                                text: 'We are redirecting you to iPayments for video verification.',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.href = res.redirect_url;
                            });
                        } else {
                            btn.html(originalText).attr('disabled', false);
                            Swal.fire('Notice', res.message, 'info');
                        }
                    },
                    error: function(xhr) {
                        btn.html(originalText).attr('disabled', false);
                        var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong.';
                        Swal.fire('Error', msg, 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
