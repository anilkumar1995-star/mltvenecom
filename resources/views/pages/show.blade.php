@extends('admin-layouts.app')

@section('content')
<main>
    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <h3 class="breadcrumb__title">{{ $page->name }}</h3>
                        <div class="breadcrumb__list">
                            <span><a href="{{ url('/') }}">Home</a></span>
                            <span>{{ $page->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- page content start -->
    <section class="tp-page-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-page-wrapper">
                        @if($page->image)
                        <div class="tp-page-thumb mb-40">
                            <img src="{{ asset($page->image) }}" alt="{{ $page->name }}" style="max-width: 100%; border-radius: 8px;">
                        </div>
                        @endif
                        
                        <div class="tp-page-content">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page content end -->
</main>
@endsection
