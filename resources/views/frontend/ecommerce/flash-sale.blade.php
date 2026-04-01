@extends('frontend.layouts.app')

@section('title', $flashSale->name . ' - Flash Sale')

@section('content')
<section class="tp-product-area pt-70 pb-70 p-relative z-index-1 fix" style="background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7)), url('{{ asset('winter_sale_banner_premium_1775029264836.png') }}') !important; background-size: cover; background-position: center;">
    <div class="container">
        <div class="row align-items-center mb-40">
            <div class="col-xl-6 col-lg-6">
                <div class="tp-section-title-wrapper-5">
                    <span class="tp-section-title-pre-5">Limited Time Offer</span>
                    <h3 class="section-title tp-section-title-5">{{ $flashSale->name }}</h3>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="tp-deal-countdown justify-content-lg-end d-flex">
                    <div class="tp-product-countdown" data-countdown="" data-date="{{ $flashSale->end_date->format('Y/m/d H:i:s') }}">
                        <div class="tp-product-countdown-inner">
                            <ul>
                                <li><span data-days="">0</span> Days</li>
                                <li><span data-hours="">0</span> Hrs</li>
                                <li><span data-minutes="">0</span> Mins</li>
                                <li><span data-seconds="">0</span> Secs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-xxl-4 row-cols-md-3 row-cols-sm-2 row-cols-2 g-4">
            @forelse($products as $product)
            <div class="col">
                @include('frontend.partials.product-card-grid', ['product' => $product])
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="fas fa-search fa-3x text-muted opacity-25"></i>
                </div>
                <p class="text-muted">No products found in this flash sale.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
            </div>
            @endforelse
        </div>

        <div class="row mt-50">
            <div class="col-12">
                <div class="tp-pagination text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ asset('home/countdown.js') }}"></script>
<script>
    $(document).ready(function() {
        if (typeof $.fn.countdown === 'function') {
            $('[data-countdown]').each(function() {
                var $this = $(this);
                var finalDate = $this.data('date');
                $this.countdown(finalDate, function(event) {
                    $this.find('[data-days]').html(event.strftime('%D'));
                    $this.find('[data-hours]').html(event.strftime('%H'));
                    $this.find('[data-minutes]').html(event.strftime('%M'));
                    $this.find('[data-seconds]').html(event.strftime('%S'));
                });
            });
        }
    });
</script>
@endpush
@endsection
