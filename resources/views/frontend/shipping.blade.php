@extends('frontend.layouts.app')

@section('title', 'Shipping')

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
    .ck-content h2 {
        margin-top: 40px;
        margin-bottom: 20px;
        font-weight: 700;
        color: #010f1c;
        font-size: 24px;
        border-bottom: 2px solid var(--primary-color);
        display: inline-block;
        padding-bottom: 5px;
    }
    .ck-content p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #55585b;
    }
    .ck-content ul {
        margin-bottom: 20px;
        padding-left: 20px;
    }
    .ck-content ul li {
        margin-bottom: 10px;
        color: #55585b;
        position: relative;
        list-style: none;
    }
    .ck-content ul li::before {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: -25px;
        color: var(--primary-color);
    }
    .ck-content section {
        margin-bottom: 40px;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.03);
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pt-40 pb-40 mb-30 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Shipping</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Shipping </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-80 pt-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="ck-content">
                        <section>
                            <h2>Shipping Methods</h2>
                            <p>We offer several shipping methods to choose from:</p>
                            <ul>
                                <li>Standard Shipping - 3 to 5 business days</li>
                                <li>Express Shipping - 1 to 2 business days</li>
                                <li>International Shipping - 7 to 14 business days</li>
                            </ul>
                            <p>Please note that shipping times may vary depending on your location and other factors.</p>
                        </section>

                        <section>
                            <h2>Shipping Costs</h2>
                            <p>Shipping costs are calculated based on the weight of your order and the shipping method selected during checkout.</p>
                            <p>You can view the estimated shipping costs in your shopping cart before completing your purchase.</p>
                        </section>

                        <section>
                            <h2>Tracking Your Order</h2>
                            <p>Once your order has been shipped, you will receive a confirmation email with a tracking number.</p>
                            <p>You can use this tracking number to monitor the status of your delivery on our website or through the shipping carrier's website.</p>
                        </section>

                        <section>
                            <h2>Shipping Restrictions</h2>
                            <p>Some items may be subject to shipping restrictions due to size, weight, or destination.</p>
                            <p>If your order contains any restricted items, we will notify you during the checkout process.</p>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
