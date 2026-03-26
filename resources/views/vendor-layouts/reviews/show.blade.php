@extends('admin-layouts.app')
@section('title', 'View Review')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <span class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</span>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.reviews.index') }}">Reviews</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">
                                        View review "{{ $review->customer->name ?? 'Guest' }}"
                                    </h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content">
        <div class="container-xl">
            <div class="row" id="review-section-wrapper">

                {{-- Left: Review Detail --}}
                <div class="col-md-8 mb-3 mb-md-0">
                    <div class="card">
                        <div class="card-header flex-wrap gap-2 justify-content-between">
                            <div>
                                {{-- Star Rating --}}
                                <h4 class="card-title d-flex justify-content-between align-items-center w-100">
                                    <div class="d-inline-flex gap-1 text-warning fs-5">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->star)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star text-muted"></i>
                                            @endif
                                        @endfor
                                        <span class="text-muted fs-6 ms-1">({{ $review->star }}/5)</span>
                                    </div>
                                </h4>

                                <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                                    <div class="fw-semibold">
                                        {{ $review->customer->name ?? 'Guest' }}
                                        @if($review->customer)
                                            (<a href="mailto:{{ $review->customer->email }}">{{ $review->customer->email }}</a>)
                                        @endif
                                    </div>
                                    <span class="d-flex align-items-center gap-1 text-muted small">
                                        <i class="fas fa-clock"></i>
                                        {{ $review->created_at ? $review->created_at->diffForHumans() : 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            @php
                                $statusClass = match(strtolower($review->status ?? '')) {
                                    'published' => 'bg-success text-success-fg',
                                    'pending'   => 'bg-warning text-warning-fg',
                                    default     => 'bg-secondary text-secondary-fg'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($review->status ?? 'N/A') }}</span>
                        </div>

                        <div class="card-body">
                            <p class="card-text mb-4 fs-3 fw-medium">{{ $review->comment }}</p>

                            {{-- Review Images --}}
                            @if(!empty($review->images))
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    @foreach($review->images as $img)
                                        <img src="{{ str_starts_with($img, 'http') ? $img : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($img, '/') }}"
                                             alt="Review image"
                                             class="rounded border"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    @endforeach
                                </div>
                            @endif

                            <div class="d-flex justify-content-end gap-2 border-bottom pb-4 mb-4">
                                {{-- Toggle Publish/Unpublish --}}
                                @if(strtolower($review->status) === 'published')
                                    <button class="btn btn-outline-warning btn-sm toggle-status-btn"
                                        data-id="{{ $review->id }}"
                                        data-status="pending"
                                        data-url="{{ route('admin.reviews.update', $review->id) }}">
                                        <i class="fas fa-eye-slash me-1"></i> Unpublish
                                    </button>
                                @else
                                    <button class="btn btn-outline-success btn-sm toggle-status-btn"
                                        data-id="{{ $review->id }}"
                                        data-status="published"
                                        data-url="{{ route('admin.reviews.update', $review->id) }}">
                                        <i class="fas fa-check me-1"></i> Publish
                                    </button>
                                @endif

                                {{-- Delete --}}
                                <button class="btn btn-outline-danger btn-sm delete-review-btn"
                                    data-url="{{ route('admin.reviews.destroy', $review->id) }}">
                                    <i class="fas fa-trash me-1"></i> Delete
                                </button>
                            </div>

                            {{-- Existing Replies --}}
                            @if($review->replies->count())
                                <div class="existing-replies mb-4">
                                    <h4 class="mb-3">Replies</h4>
                                    @foreach($review->replies as $reply)
                                        <div class="bg-light p-3 rounded mb-2 border-start border-primary border-4">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <span class="fw-bold text-primary">{{ $reply->user->name ?? 'Admin' }}</span>
                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0 text-dark">{{ $reply->message }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Reply Form --}}
                            <div class="reply-form mt-4">
                                <h4 class="mb-2">Reply to review</h4>
                                <form id="review-reply-form" action="{{ route('admin.reviews.reply', $review->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea class="form-control" name="message" rows="4" placeholder="Write your reply..." required></textarea>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane me-1"></i> Submit Reply
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Right: Product Info --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product</h4>
                        </div>
                        <div class="card-body">
                            @if($review->product)
                                <div class="d-flex gap-3 align-items-start">
                                    <img class="img-thumbnail"
                                         src="{{ $review->product->image ? (str_starts_with($review->product->image, 'http') ? $review->product->image : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($review->product->image, '/')) : asset('home/placeholder.png') }}"
                                         alt="{{ $review->product->name }}"
                                         style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px;">
                                    <div>
                                        <h4 class="mb-1">
                                            <a href="{{ route('admin.products.edit', $review->product->id) }}" target="_blank" class="text-decoration-none text-dark">
                                                {{ $review->product->name }}
                                            </a>
                                        </h4>
                                        <div class="d-inline-flex gap-1 text-warning small">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->star)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">Product no longer exists.</span>
                            @endif
                        </div>
                    </div>

                    {{-- Customer Info --}}
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Customer</h4>
                        </div>
                        <div class="card-body">
                            @if($review->customer)
                                <p class="mb-1"><strong>Name:</strong> {{ $review->customer->name }}</p>
                                <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $review->customer->email }}">{{ $review->customer->email }}</a></p>
                                <a href="{{ route('admin.customers.edit', $review->customer->id) }}" class="btn btn-sm btn-outline-secondary mt-2">
                                    <i class="fas fa-user me-1"></i> View Customer
                                </a>
                            @else
                                <span class="text-muted">Guest / Customer deleted</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    // Toggle publish/unpublish
    $(document).on('click', '.toggle-status-btn', function() {
        const btn = $(this);
        const url = btn.data('url');
        const newStatus = btn.data('status');

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                status: newStatus,
                star: {!! $review->star !!},
                comment: {!! json_encode($review->comment) !!},
                product_id: {!! $review->product_id !!},
                customer_id: {!! $review->customer_id ?? 'null' !!}
            },
            success: function(res) {
                notify('success', 'Status updated successfully!');
                setTimeout(() => location.reload(), 800);
            },
            error: function() {
                notify('error', 'Something went wrong!');
            }
        });
    });

    // Submit reply
    $('#review-reply-form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const data = form.serialize();

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(res) {
                if (res.status) {
                    notify('success', res.message);
                    setTimeout(() => location.reload(), 800);
                } else {
                    notify('error', 'Failed to save reply.');
                }
            },
            error: function() {
                notify('error', 'Something went wrong!');
            }
        });
    });

    // Delete review
    $(document).on('click', '.delete-review-btn', function() {
        const url = $(this).data('url');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This review will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e53e3e',
            cancelButtonColor: '#718096',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            notify('success', res.message);
                            setTimeout(() => window.location.href = '{{ route('admin.reviews.index') }}', 800);
                        } else {
                            notify('error', res.message);
                        }
                    },
                    error: function() {
                        notify('error', 'Something went wrong!');
                    }
                });
            }
        });
    });
</script>
@endpush
