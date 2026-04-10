@extends('frontend.layouts.app')

@section('title', 'Cookie Policy')

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
        margin-bottom: 15px;
        font-weight: 700;
        color: #010f1c;
        font-size: 20px;
    }
    .ck-content p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #55585b;
    }
    .cookie-info-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
        margin-bottom: 30px;
        border-left: 4px solid var(--primary-color);
    }
    .cookie-info-card h4 {
        margin-top: 0;
        color: var(--primary-color);
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pt-40 pb-40 mb-30 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Cookie Policy</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Cookie Policy </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-80 pt-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="ck-content">
                        <h3>EU Cookie Consent</h3>
                        <p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p>
                        
                        <div class="cookie-info-card">
                            <h4>Essential Data</h4>
                            <p>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</p>
                            <p><strong>Session Cookie</strong>: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</p>
                            <p><strong>XSRF-Token Cookie</strong>: Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</p>
                        </div>

                        <p class="text-muted small">This policy is subject to change at any time. We encourage visitors to frequently check this page for any changes to stay informed about how we are helping to protect the personal information we collect.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
