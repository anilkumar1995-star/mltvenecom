@extends('frontend.layouts.app')
@section('title', 'Available Coupons')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 mb-30 text-start pt-30 page_speed_834475417">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Coupons</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Coupons </span>
                </div>
            </div>
        </div>
    </section>

    <div class="tp-coupon-page-area pb-120">
        <div class="container">
            <div class="row g-4">
                @forelse($coupons as $coupon)
                    <div class="col-xl-4 col-md-6">
                        <div class="tp-coupon-item p-relative bg-white rounded-4 border shadow-sm p-4 h-100 transition-3">
                            <div class="tp-coupon-item-left d-sm-flex align-items-center mb-3">
                                <div class="tp-coupon-thumb me-4 bg-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    <svg class="icon text-primary" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 15l6 -6"></path>
                                        <circle cx="9.5" cy="9.5" r=".5" fill="currentColor"></circle>
                                        <circle cx="14.5" cy="14.5" r=".5" fill="currentColor"></circle>
                                        <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7a2.2 2.2 0 0 0 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1a2.2 2.2 0 0 0 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1"></path>
                                    </svg>
                                </div>
                                <div class="tp-coupon-content">
                                    <div class="tp-coupon-status mb-1 d-flex align-items-center flex-wrap">
                                        <h4 class="mb-0 me-2" style="font-size: 18px;">
                                            Coupon 
                                            <span class="text-danger fw-bold">
                                                @if($coupon->type == 'percentage' || $coupon->type_option == 'percentage')
                                                    {{ $coupon->value }}%
                                                @else
                                                    ₹{{ number_format($coupon->value) }}
                                                @endif
                                            </span>
                                        </h4>
                                        <span class="badge bg-success" style="font-size: 11px;">Active</span>
                                        
                                        <div class="tp-coupon-info-details position-relative ms-2">
                                            <span class="info-icon text-muted" style="cursor: pointer;">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <div class="tp-coupon-info-tooltip shadow-sm p-2 rounded bg-dark text-white position-absolute d-none" style="bottom: 25px; left: 0; width: 220px; font-size: 12px; z-index: 10;">
                                                {{ $coupon->description ?: "Discount code for your orders. Min order value might apply." }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tp-coupon-date small text-muted">
                                        @if($coupon->end_date)
                                            Valid until: {{ $coupon->end_date->format('d M Y') }}
                                        @else
                                            No expiry date
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tp-coupon-code-wrapper mt-auto border-top pt-3">
                                <p class="small text-muted mb-2">Use this code at checkout:</p>
                                <div class="btn-group w-100">
                                    <input type="text" class="form-control text-center font-monospace font-weight-bold bg-light coupon-code-field" value="{{ $coupon->code }}" readonly style="letter-spacing: 1px;">
                                    <button class="btn btn-primary copy-coupon-btn" data-code="{{ $coupon->code }}">
                                        Copy
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-warning">
                            <h4>No active coupons available right now.</h4>
                            <p>Stay tuned for exciting discounts and offers!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</main>

@endsection

@push('styles')
<style>
    .tp-coupon-item {
        border-radius: 16px !important;
        background: #fff;
    }
    .tp-coupon-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        border-color: var(--primary-color) !important;
    }
    .tp-coupon-item-left {
        border-bottom: 2px dashed #f1f1f1;
        padding-bottom: 15px;
    }
    .copy-coupon-btn {
        min-width: 80px;
    }
    .info-icon:hover + .tp-coupon-info-tooltip {
        display: block !important;
    }
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.copy-coupon-btn').on('click', function() {
            var $btn = $(this);
            var code = $btn.data('code');
            
            navigator.clipboard.writeText(code).then(function() {
                var originalText = $btn.text();
                $btn.text('Copied!').addClass('btn-success').removeClass('btn-primary');
                
                setTimeout(function() {
                    $btn.text(originalText).addClass('btn-primary').removeClass('btn-success');
                }, 2000);
                
                if (typeof notify === 'function') {
                    notify('Coupon code copied to clipboard!', 'success');
                }
            });
        });
    });
</script>
@endpush
