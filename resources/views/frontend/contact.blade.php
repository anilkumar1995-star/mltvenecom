@extends('frontend.layouts.app')
@section('title', 'Contact Us')
@section('content')

<main>
    {{-- Breadcrumb --}}
    <section class="breadcrumb__area pt-40 pb-40 mb-30 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Contact</h3>
                <div class="breadcrumb__list js_breadcrumb_reduce_length_on_mobile">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Contact </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-contact-area pb-100">
        <div class="container">
            <div class="tp-contact-inner">
                <div class="row">
                    {{-- Contact Form --}}
                    <div class="col-xl-9 col-lg-8">
                        <div class="tp-contact-wrapper pe-xl-5">
                            <h3 class="tp-contact-title mb-30 fs-2 fw-bold text-dark">Sent A Message</h3>
                            
                            <div class="tp-contact-form">
                                <form id="contact-form-ajax" action="{{ route('frontend.contact.send') }}" method="POST" class="contact-form-custom">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <div class="contact-form-group">
                                                <label class="form-label fw-bold" for="name">Name <span class="text-danger">*</span></label>
                                                <input class="form-control" placeholder="Your Name" required name="name" type="text" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <div class="contact-form-group">
                                                <label class="form-label fw-bold" for="email">Email <span class="text-danger">*</span></label>
                                                <input class="form-control" placeholder="Your Email" required name="email" type="email" id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <div class="contact-form-group">
                                                <label class="form-label fw-bold" for="phone">Phone</label>
                                                <input class="form-control" placeholder="Your Phone" name="phone" type="text" id="phone">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <div class="contact-form-group">
                                                <label class="form-label fw-bold" for="subject">Subject</label>
                                                <input class="form-control" placeholder="Subject" name="subject" type="text" id="subject">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-25">
                                            <div class="contact-form-group">
                                                <label class="form-label fw-bold" for="content">Message <span class="text-danger">*</span></label>
                                                <textarea class="form-control" rows="4" placeholder="Your Message" required id="content" name="content"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-30">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="agree" required>
                                                <label class="form-check-label small" for="agree">
                                                    I agree to the <a href="#" class="text-decoration-underline text-primary">Terms and Privacy Policy</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-dark px-5 py-3 fw-bold" type="submit" id="submit-btn" style="border-radius: 8px;">
                                                Send Message
                                            </button>
                                        </div>
                                    </div>
                                    <div class="contact-message-container mt-3">
                                        <div id="contact-success" class="alert alert-success d-none"></div>
                                        <div id="contact-error" class="alert alert-danger d-none"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Info Sidebar --}}
                    <div class="col-xl-3 col-lg-4 mt-5 mt-lg-0">
                        <div class="tp-contact-info-wrapper">
                            <div class="tp-contact-info-item mb-40 d-flex align-items-start gap-3">
                                <div class="tp-contact-info-icon flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(103, 142, 97, 0.1);">
                                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                                        <path d="M3 7l9 6l9 -6"></path>
                                    </svg>
                                </div>
                                <div class="tp-contact-info-content">
                                    <h4 class="fs-6 fw-bold mb-1">Email & Phone</h4>
                                    <p class="mb-0 text-muted small">{{ $footer_settings->footer_email ?? 'contact@multive.com' }}</p>
                                    <p class="mb-0 fw-bold">{{ $footer_settings->footer_phone ?? '+670 413 90 762' }}</p>
                                </div>
                            </div>

                            <div class="tp-contact-info-item mb-40 d-flex align-items-start gap-3">
                                <div class="tp-contact-info-icon flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(103, 142, 97, 0.1);">
                                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                    </svg>
                                </div>
                                <div class="tp-contact-info-content">
                                    <h4 class="fs-6 fw-bold mb-1">Visit Our Store</h4>
                                    <p class="mb-0 text-muted small">{{ $footer_settings->footer_address ?? '502 New St, Brighton VIC 3186, Melbourne, Australia' }}</p>
                                </div>
                            </div>

                            <div class="tp-contact-info-item d-flex align-items-start gap-3">
                                <div class="tp-contact-info-icon flex-shrink-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: rgba(103, 142, 97, 0.1);">
                                    <i class="fas fa-share-alt text-primary" style="font-size: 20px;"></i>
                                </div>
                                <div class="tp-contact-info-content">
                                    <h4 class="fs-6 fw-bold mb-2">Find on Social Media</h4>
                                    <div class="d-flex gap-2">
                                        <a href="{{ $footer_settings->facebook_url ?? '#' }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fab fa-facebook-f"></i></a>
                                        <a href="{{ $footer_settings->twitter_url ?? '#' }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fab fa-x-twitter"></i></a>
                                        <a href="{{ $footer_settings->linkedin_url ?? '#' }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="{{ $footer_settings->youtube_url ?? '#' }}" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 32px; height: 32px; padding: 0; line-height: 30px;"><i class="fab fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Area --}}
    <section class="tp-map-area pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-map-wrapper rounded overflow-hidden shadow-sm" style="height: 450px;">
                        @if(isset($footer_settings->contact_map_iframe) && !empty($footer_settings->contact_map_iframe))
                            <iframe 
                                src="{{ $footer_settings->contact_map_iframe }}" 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        @else
                            <iframe 
                                src="https://maps.google.com/maps?q=502 New Street, Brighton VIC, Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" 
                                width="100%" 
                                height="100%" 
                                frameborder="0" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy">
                            </iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contact-form-ajax').on('submit', function(e) {
            e.preventDefault();
            
            const btn = $('#submit-btn');
            const originalText = btn.text();
            
            btn.prop('disabled', true).text('Sending...');
            $('#contact-success, #contact-error').addClass('d-none');

            $.ajax({
                url: "{{ route('frontend.contact.send') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    btn.prop('disabled', false).text(originalText);
                    if (!response.error) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#678E61'
                        });
                        $('#contact-form-ajax')[0].reset();
                    } else {
                        $('#contact-error').removeClass('d-none').text(response.message);
                    }
                },
                error: function(xhr) {
                    btn.prop('disabled', false).text(originalText);
                    const msg = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong. Please try again.';
                    $('#contact-error').removeClass('d-none').text(msg);
                }
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
    }
    .tp-contact-title {
        position: relative;
        padding-bottom: 15px;
    }
    .tp-contact-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
    }
    .contact-form-group .form-control {
        border-radius: 8px;
        padding: 12px 20px;
        border: 1px solid #e5e5e5;
        background-color: #f9f9f9;
        font-size: 14px;
        transition: all 0.3s;
    }
    .contact-form-group .form-control:focus {
        background-color: #fff;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(103, 142, 97, 0.1);
    }
    .tp-contact-info-item:hover .tp-contact-info-icon {
        background-color: var(--primary-color) !important;
        color: #fff !important;
    }
    .tp-contact-info-item:hover .tp-contact-info-icon i,
    .tp-contact-info-item:hover .tp-contact-info-icon svg {
        color: #fff !important;
        stroke: #fff !important;
    }
    .tp-contact-info-icon {
        transition: all 0.3s;
    }
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
</style>
@endpush
