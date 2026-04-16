@extends('frontend.layouts.app')

@section('title', 'Our Story')

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
    .ck-content h4 {
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 700;
        color: #010f1c;
    }
    .ck-content p {
        margin-bottom: 20px;
        line-height: 1.8;
        color: #55585b;
    }
</style>
@endpush

@section('content')
<main>
    <section class="breadcrumb__area pt-40 pb-40 mb-30 text-start">
        <div class="container">
            <div class="breadcrumb__content p-relative z-index-1">
                <h3 class="breadcrumb__title">Our Story</h3>
                <div class="breadcrumb__list">
                    <span><a class="d-inline-block" href="{{ route('frontend.home') }}">Home</a></span>
                    <span> Our Story </span>
                </div>
            </div>
        </div>
    </section>

    <section class="tp-page-area pb-80 pt-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="ck-content">
                        @if($page)
                            {!! $page->content !!}
                        @else
                            <h4>A passion for handcrafted coffee, brewed with love and community.</h4>
                            <p> We are a small, family-owned coffee roaster dedicated to bringing the finest, ethically sourced beans to your cup. Our story began in a cozy kitchen, fueled by a shared passion for the rich aroma and invigorating taste of freshly brewed coffee. We dreamt of creating a space where people could connect over a warm cup, share stories, and experience the joy of handcrafted coffee.</p>
                            
                            <h4>From Humble Beginnings to Roasting Success:</h4>
                            <p> Our journey started with a small coffee roaster nestled in our garage. We spent countless hours experimenting with different roasting profiles, meticulously cupping each batch to achieve the perfect balance of flavor and aroma. Driven by a desire to make a difference, we built relationships with sustainable coffee farms around the world, ensuring fair trade practices and the highest quality beans.</p>
                            
                            <h4>Milestones and More to Come:</h4>
                            <p> Our dedication to quality and community resonated with coffee lovers, and our small business quickly grew. We opened our first cafe, a warm and inviting space where people could gather, savor our freshly roasted coffee, and connect with friends and neighbors. We've continued to expand, now offering a variety of handcrafted coffee beverages, alongside delicious pastries and light bites.</p>
                            
                            <h4>Values at Our Core:</h4>
                            <p> At the heart of everything we do lies our commitment to ethical sourcing, sustainable practices, and building meaningful connections. We believe in supporting the communities that cultivate our coffee beans, ensuring fair wages and responsible farming methods. Every cup you enjoy contributes to a positive impact, one sip at a time.</p>
                            
                            <h4>Join us on our journey!</h4>
                            <p> We invite you to explore our world of coffee, from the rich diversity of our bean origins to the unique flavors crafted through meticulous roasting. Visit our cafe, discover your perfect cup, and become part of our ever-growing coffee community. Let's connect over a cup, share stories, and celebrate the simple joy of a well-brewed coffee.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
