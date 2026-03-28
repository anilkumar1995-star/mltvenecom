@extends('frontend.layouts.app')
@section('title', 'Frequently Asked Questions')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area include-bg pt-60 pb-60 mb-50 mb-30 text-start pt-30 page_speed_482623375">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">FAQs</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> FAQs </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-80 pt-50">
        <div class="container">
            <div class="ck-content">
                <section data-block-id="faqs" class="mb-60">
                    <div class="tp-section-title-wrapper mb-40">
                        <h3 class="section-title tp-section-title"> Frequently Asked Questions </h3>
                        <p class="text-muted fs-6 mt-2">Below are frequently asked questions, you may find the answer for yourself.</p>
                    </div>

                    <div class="tp-faq-wrapper row gy-4">
                        {{-- Shipping Section --}}
                        <div class="col-md-6">
                            <div class="tp-faq-item">
                                <h4 class="tp-faq-title mb-20 text-primary">Shipping</h4>
                                <div class="accordion" id="accordionShipping">
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="heading1">
                                            <button class="accordion-button text-heading-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1"> 
                                                What Shipping Methods Are Available? 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse show" id="collapse1" aria-labelledby="heading1" data-bs-parent="#accordionShipping">
                                            <div class="accordion-body bg-white"> 
                                                We offer various shipping methods including Standard Delivery, Express Shipping, and Local Pickup through our vendor network.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="heading2">
                                            <button class="accordion-button text-heading-5 collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2"> 
                                                Do You Ship Internationally? 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse" id="collapse2" aria-labelledby="heading2" data-bs-parent="#accordionShipping">
                                            <div class="accordion-body bg-white"> 
                                                Currently, we focus on domestic shipping within India, though international options vary by vendor.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Section --}}
                        <div class="col-md-6">
                            <div class="tp-faq-item">
                                <h4 class="tp-faq-title mb-20 text-primary">Payment</h4>
                                <div class="accordion" id="accordionPayment">
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="heading4">
                                            <button class="accordion-button text-heading-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4"> 
                                                What Payment Methods Are Accepted? 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse show" id="collapse4" aria-labelledby="heading4" data-bs-parent="#accordionPayment">
                                            <div class="accordion-body bg-white"> 
                                                We accept all major credit/debit cards, UPI payments via Razorpay/PhonePe, and Net Banking for most verified stores.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Order & Returns Section --}}
                        <div class="col-md-6">
                            <div class="tp-faq-item">
                                <h4 class="tp-faq-title mb-20 text-primary">Order & Returns</h4>
                                <div class="accordion" id="accordionOrders">
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="heading6">
                                            <button class="accordion-button text-heading-5 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6"> 
                                                How do I place an Order? 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse show" id="collapse6" aria-labelledby="heading6" data-bs-parent="#accordionOrders">
                                            <div class="accordion-body bg-white"> 
                                                Simply select your items, add them to your cart, and proceed to checkout by entering your shipping details and choosing a payment method.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="heading9">
                                            <button class="accordion-button text-heading-5 collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9"> 
                                                How Do I Track My Order? 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse" id="collapse9" aria-labelledby="heading9" data-bs-parent="#accordionOrders">
                                            <div class="accordion-body bg-white"> 
                                                Once your order is shipped, you will receive a tracking ID via email/SMS. You can enter this on our Order Tracking page.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- General Section (populated from DB) --}}
                        @if($faqs->isNotEmpty())
                        <div class="col-md-6">
                            <div class="tp-faq-item">
                                <h4 class="tp-faq-title mb-20 text-primary">General Questions</h4>
                                <div class="accordion" id="accordionGeneral">
                                    @foreach($faqs as $faq)
                                    <div class="accordion-item shadow-sm border rounded mb-3 overflow-hidden">
                                        <h5 class="accordion-header" id="headingDb{{ $faq->id }}">
                                            <button class="accordion-button text-heading-5 collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDb{{ $faq->id }}" aria-expanded="false" aria-controls="collapseDb{{ $faq->id }}"> 
                                                {{ $faq->question }} 
                                            </button>
                                        </h5>
                                        <div class="accordion-collapse collapse" id="collapseDb{{ $faq->id }}" aria-labelledby="headingDb{{ $faq->id }}" data-bs-parent="#accordionGeneral">
                                            <div class="accordion-body bg-white"> 
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>

@endsection

@push('styles')
<style>
    .tp-faq-title {
        font-weight: 700;
        font-size: 24px;
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .tp-faq-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
        border-radius: 2px;
    }
    .accordion-button:not(.collapsed) {
        background-color: #f7f9fc;
        color: var(--primary-color);
        box-shadow: none;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
    }
    .accordion-item {
        border-radius: 10px !important;
    }
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
</style>
@endpush
