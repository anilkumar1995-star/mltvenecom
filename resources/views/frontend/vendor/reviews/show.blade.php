@extends('vendor-layouts.app')
@section('title', 'Review Detail')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.reviews.index') }}">Reviews</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Review #{{ $review->id }}</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('frontend.vendor.reviews.index') }}" class="btn btn-outline-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header justify-content-between">
                            <h3 class="card-title">Review Content</h3>
                            <div>
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->star)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="fs-2 fw-medium text-dark mb-4">"{{ $review->comment }}"</p>
                            
                            @if(!empty($review->images))
                                <div class="row g-2 mb-4">
                                    @foreach($review->images as $img)
                                        <div class="col-auto">
                                            <a href="{{ str_starts_with($img, 'http') ? $img : asset('storage/' . $img) }}" target="_blank">
                                                <img src="{{ str_starts_with($img, 'http') ? $img : asset('storage/' . $img) }}" 
                                                     class="rounded border" 
                                                     style="width: 120px; height: 120px; object-fit: cover;"
                                                     alt="Review attachment">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="d-flex align-items-center gap-2 text-muted small border-top pt-3">
                                <span>Published: {{ $review->created_at->format('M d, Y h:i A') }}</span>
                                <span>•</span>
                                <span>Status: <span class="badge bg-{{ $review->status == 'published' ? 'success' : 'warning' }} text-white">{{ ucfirst($review->status) }}</span></span>
                            </div>
                        </div>
                    </div>

                    @if($review->replies && $review->replies->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Replies</h3>
                            </div>
                            <div class="card-body">
                                @foreach($review->replies as $reply)
                                    <div class="mb-4 @if(!$loop->last) border-bottom pb-4 @endif">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="fw-bold text-primary">{{ $reply->user->name ?? 'Admin' }}</div>
                                            <div class="text-muted small">{{ $reply->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="text-dark bg-light p-3 rounded">
                                            {{ $reply->message }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Product Information</h3>
                        </div>
                        <div class="card-body">
                            @if($review->product)
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar avatar-lg me-3" style="background-image: url({{ $review->product->image_url }})"></span>
                                    <div>
                                        <div class="fw-bold">{{ $review->product->name }}</div>
                                        <div class="text-muted small">ID: #{{ $review->product->id }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('frontend.vendor.products.edit', $review->product->id) }}" class="btn btn-primary w-100">View Product</a>
                            @else
                                <div class="text-muted">Product no longer exists.</div>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customer Details</h3>
                        </div>
                        <div class="card-body">
                            @if($review->customer)
                                <div class="d-flex align-items-center mb-3">
                                    <span class="avatar rounded-circle me-3">{{ substr($review->customer->name, 0, 1) }}</span>
                                    <div>
                                        <div class="fw-bold">{{ $review->customer->name }}</div>
                                        <div class="text-muted small">{{ $review->customer->email }}</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small text-uppercase">Member Since</label>
                                    <div>{{ $review->customer->created_at->format('M d, Y') }}</div>
                                </div>
                            @else
                                <div class="text-muted">Guest User</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
