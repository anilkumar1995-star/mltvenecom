@extends('frontend.layouts.app')

@section('title', 'Careers')

@push('styles')
<style>
    .breadcrumb__area {
        background-color: #f3f3f3;
        position: relative;
    }
    .breadcrumb__title {
        font-size: 40px;
        font-weight: 600;
        color: #010f1c;
    }
    .ck-content h3 {
        margin-bottom: 25px;
        font-weight: 700;
        color: #010f1c;
        font-size: 28px;
    }
    .ck-content h4 {
        margin-top: 35px;
        margin-bottom: 20px;
        font-weight: 700;
        color: #010f1c;
        font-size: 20px;
    }
    .ck-content p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #55585b;
    }
    .ck-content ul {
        margin-bottom: 25px;
        padding-left: 0;
        list-style: none;
    }
    .ck-content ul li {
        margin-bottom: 15px;
        padding-left: 25px;
        position: relative;
    }
    .ck-content ul li::before {
        content: "\f058";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 2px;
        color: var(--primary-color);
    }
    .ck-content ul li strong {
        color: #010f1c;
    }
    .career-apply-info {
        background: #f8f9fa;
        padding: 40px;
        border-radius: 15px;
        border: 2px dashed var(--primary-color);
        text-align: center;
        margin-top: 50px;
    }
    .career-apply-info h5 {
        font-weight: 700;
        margin-bottom: 15px;
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pb-20 mb-20 pt-20 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Careers</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Careers </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="ck-content">
                        @if($page)
                            {!! $page->content !!}
                        @else
                            <h3>Careers: Be Part of Our Brewing Legacy</h3>
                            <p> At Shofy, we're not just brewing coffee, we're brewing a legacy. Since our humble beginnings in 2024, we've grown from a small, family-owned roaster to a thriving coffee haven. But our passion for quality, community, and sustainability remains at the core of everything we do.</p>
                            
                            <h4>Why Join Our Team?</h4>
                            <ul>
                                <li><strong>Become a Coffee Connoisseur</strong>: Immerse yourself in the world of coffee, learning from experienced roasters and baristas about bean origins, roasting techniques, and crafting the perfect cup.</li>
                                <li><strong>Fuel Your Passion</strong>: Contribute to our mission by sourcing ethically, promoting sustainable practices, and fostering positive relationships with coffee-growing communities around the globe.</li>
                                <li><strong>Grow with Us</strong>: We offer comprehensive training programs and opportunities for professional development, helping you refine your skills and advance your career in the coffee industry.</li>
                                <li><strong>Be Part of the Family</strong>: We cultivate a collaborative and supportive work environment where your unique talents and perspectives are valued.</li>
                            </ul>

                            <h4>Current Openings:</h4>
                            <ul>
                                <li><strong>Coffee Roaster</strong>: Play a vital role in our roasting process, meticulously crafting unique flavor profiles and ensuring the highest quality beans reach our customers.</li>
                                <li><strong>Barista</strong>: Become a coffee ambassador, welcoming guests with a smile, crafting their perfect cup, and sharing your knowledge and passion for coffee.</li>
                                <li><strong>Cafe Manager</strong>: Lead your team in creating a warm and inviting atmosphere, overseeing daily operations, and ensuring exceptional customer service.</li>
                            </ul>

                            <h4>We are always looking for passionate individuals who share our values:</h4>
                            <ul>
                                <li>A genuine love for coffee and a desire to learn everything there is to know about it.</li>
                                <li>A commitment to ethical sourcing, sustainability, and social responsibility.</li>
                                <li>Excellent communication and interpersonal skills to build rapport with colleagues and customers.</li>
                                <li>A positive attitude, a willingness to learn, and a collaborative spirit.</li>
                            </ul>

                            <div class="career-apply-info">
                                <h5>Ready to join our brewing legacy?</h5>
                                <p class="mb-0">Submit your resume and cover letter, telling us why you're a perfect fit for our team. We look forward to meeting passionate individuals who are ready to brew the future with us, one cup at a time.</p>
                                <a href="mailto:{{ $footer_settings->footer_email ?? 'careers@shofy.com' }}" class="btn btn-primary text-white mt-3">Send Your Application</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
