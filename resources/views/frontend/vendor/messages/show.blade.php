@extends('vendor-layouts.app')

@section('title', 'View Message')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('frontend.vendor.messages.index') }}">Messages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Message Detail</li>
                            </ol>
                        </nav>
                    </div>
                    <h2 class="page-title">
                        Inquiry from {{ $message->name }}
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('frontend.vendor.messages.index') }}" class="btn btn-outline-secondary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M15 6l-6 6l6 6" />
                            </svg>
                            Back to Inbox
                        </a>
                        <form action="{{ route('frontend.vendor.messages.destroy', $message->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                                Delete Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3">
                            <h4 class="card-title fw-bold mb-0">Sender Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 d-flex align-items-center gap-3">
                                <div class="bg-primary-lt p-3 rounded-circle text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="mb-0 fw-bold">{{ $message->name }}</h5>
                                    <p class="text-muted small mb-0">Full Name</p>
                                </div>
                            </div>

                            <hr class="my-3 opacity-25">

                            <div class="mb-3">
                                <label class="form-label small text-muted text-uppercase fw-bold mb-1">Email Address</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="far fa-envelope text-secondary"></i>
                                    <a href="mailto:{{ $message->email }}" class="text-decoration-none">{{ $message->email }}</a>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted text-uppercase fw-bold mb-1">Received On</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="far fa-calendar-alt text-secondary"></i>
                                    <span>{{ $message->created_at->format('M d, Y') }} at {{ $message->created_at->format('H:i') }}</span>
                                </div>
                            </div>

                            @if($message->phone)
                            <div class="mb-3">
                                <label class="form-label small text-muted text-uppercase fw-bold mb-1">Phone Number</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-phone-alt text-secondary"></i>
                                    <span>{{ $message->phone }}</span>
                                </div>
                            </div>
                            @endif

                            @if($message->subject)
                            <div class="mb-0">
                                <label class="form-label small text-muted text-uppercase fw-bold mb-1">Subject</label>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-tag text-secondary"></i>
                                    <span class="badge bg-info-lt text-info">{{ $message->subject }}</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h4 class="card-title fw-bold mb-0">Message Transcript</h4>
                            <span class="badge bg-green text-green-fg">Incoming</span>
                        </div>
                        <div class="card-body bg-light-subtle">
                            <div class="p-4 bg-white rounded-3 shadow-none border" style="min-height: 250px; line-height: 1.6;">
                                {!! nl2br(e($message->content)) !!}
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3">
                            <p class="small text-muted mb-3 italic">Use the button below to respond to this customer inquiry directly via email.</p>
                            <a href="mailto:{{ $message->email }}?subject=Re: Inquiry from {{ config('app.name') }}" class="btn btn-primary px-4 shadow-sm">
                                <i class="far fa-paper-plane me-2"></i>
                                <strong>Reply via Email</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .page-wrapper { background-color: #f8fafc; }
    .bg-primary-lt { background-color: rgba(32, 107, 196, 0.1) !important; }
    .card { border-radius: 12px; }
    .breadcrumb-item a { color: #64748b; text-decoration: none; }
    .breadcrumb-item.active { color: #1e293b; font-weight: 600; }
</style>
@endpush
