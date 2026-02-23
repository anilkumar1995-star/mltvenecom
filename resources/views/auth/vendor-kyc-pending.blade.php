@extends('frontend.layouts.app')
@section('title', 'KYC Verification Pending')
@section('content')
<style>
    .kyc-card {
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border-radius: 16px;
        background: #fff;
        overflow: hidden;
    }
    .kyc-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 2rem;
        text-align: center;
    }
    .kyc-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 700;
    }
    .kyc-header p {
        margin: 0.5rem 0 0;
        opacity: 0.9;
        font-size: 0.95rem;
    }
    .kyc-body {
        padding: 2rem;
    }
    .kyc-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .kyc-status-badge.pending {
        background: #fff3cd;
        color: #856404;
    }
    .kyc-status-badge.success {
        background: #d4edda;
        color: #155724;
    }
    .kyc-status-badge.failure {
        background: #f8d7da;
        color: #721c24;
    }
    .kyc-steps {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0;
    }
    .kyc-steps li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
    }
    .kyc-steps li:last-child {
        border-bottom: none;
    }
    .step-num {
        min-width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #667eea;
        color: #fff;
        border-radius: 50%;
        font-size: 0.8rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .btn-kyc {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-kyc:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: #fff;
    }
    .info-note {
        background: #f0f4ff;
        border-left: 4px solid #667eea;
        padding: 12px 16px;
        border-radius: 0 8px 8px 0;
        font-size: 0.9rem;
        color: #4a5568;
        margin-top: 1.5rem;
    }
</style>

<section class="tp-page-area pb-80 pt-50" style="background-color: #f3f5f7;">
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8">
                <div class="kyc-card">
                    <div class="kyc-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px; opacity: 0.9;">
                            <path d="M9 12l2 2l4 -4"/>
                            <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"/>
                        </svg>
                        <h2>Registration Successful!</h2>
                        <p>Complete your Video KYC to activate your vendor account</p>
                    </div>

                    <div class="kyc-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted fw-medium">KYC Status</span>
                            <span class="kyc-status-badge {{ $kyc_status ?? 'pending' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="6"/></svg>
                                {{ ucfirst($kyc_status ?? 'Pending') }}
                            </span>
                        </div>

                        <hr>

                        <h5 class="fw-bold mb-2">Complete your KYC in 3 easy steps:</h5>
                        <ul class="kyc-steps">
                            <li>
                                <span class="step-num">1</span>
                                <span>Click the <strong>"Start Video KYC"</strong> button below</span>
                            </li>
                            <li>
                                <span class="step-num">2</span>
                                <span>Complete the <strong>Aadhaar-based video verification</strong> on the Digio platform</span>
                            </li>
                            <li>
                                <span class="step-num">3</span>
                                <span>Once verified, our admin will <strong>approve your account</strong> and you'll be notified</span>
                            </li>
                        </ul>

                        @if(!empty($kyc_url))
                            <div class="text-center mt-4">
                                <a href="{{ $kyc_url }}" target="_blank" class="btn-kyc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"/>
                                    </svg>
                                    Start Video KYC
                                </a>
                            </div>
                        @else
                            <div class="alert alert-warning mt-4 mb-0" role="alert">
                                <strong>Note:</strong> KYC link could not be generated at this time. Please contact support or try registering again.
                            </div>
                        @endif

                        <div class="info-note">
                            <strong>📌 Important:</strong> Your vendor account will remain inactive until the KYC verification is completed and approved by our admin team. You will receive a notification once your account is activated.
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-muted">
                        ← Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
