@extends('admin-layouts.app')
@section('title', 'View contact')

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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.contacts.list') }}">Contact</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">View contact</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" id="contact-form">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-9 gap-3">
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header border-bottom bg-light">
                                <h4 class="card-title fw-bold">Contact information</h4>
                            </div>
                            <div class="card-body bg-white text-dark">
                                <div class="datagrid">
                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Full Name</div>
                                        <div class="datagrid-content fw-bold text-dark">{{ $contact->name }}</div>
                                    </div>

                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Email</div>
                                        <div class="datagrid-content"><a href="mailto:{{ $contact->email }}" class="text-decoration-none fw-bold">{{ $contact->email }}</a></div>
                                    </div>

                                    @if($contact->phone)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Phone</div>
                                        <div class="datagrid-content"><a href="tel:{{ $contact->phone }}" class="text-decoration-none fw-bold">{{ $contact->phone }}</a></div>
                                    </div>
                                    @endif

                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Time</div>
                                        <div class="datagrid-content text-dark">{{ $contact->created_at->format('d M Y H:i:s') }}</div>
                                    </div>

                                    @if($contact->address)
                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Address</div>
                                        <div class="datagrid-content text-dark">{{ $contact->address }}</div>
                                    </div>
                                    @endif

                                    <div class="datagrid-item">
                                        <div class="datagrid-title text-muted small text-uppercase fw-bold">Subject</div>
                                        <div class="datagrid-content text-dark fw-bold">{{ $contact->subject ?? '(No Subject)' }}</div>
                                    </div>
                                </div>

                                <div class="datagrid-item mt-4">
                                    <div class="datagrid-title text-muted small text-uppercase fw-bold">Content</div>
                                    <div class="datagrid-content bg-light p-3 rounded mt-2 text-dark fs-3 lh-base" style="white-space: pre-wrap; min-height: 100px;">{{ $contact->content }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-header border-bottom bg-light">
                                <h4 class="card-title fw-bold">Replies</h4>
                            </div>
                            <div class="card-body bg-white text-dark">
                                <div id="reply-wrapper" class="mb-4">
                                    @forelse($replies as $reply)
                                        <div class="p-3 bg-light rounded-3 mb-3 border shadow-sm">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="fw-bold text-primary">
                                                    <i class="fas fa-user-shield me-1"></i> {{ $reply->user_name }} (Admin)
                                                </div>
                                                <div class="text-muted small">
                                                    <i class="far fa-clock me-1"></i> {{ $reply->replied_at }}
                                                </div>
                                            </div>
                                            <div class="text-dark fs-4">
                                                {!! nl2br(e($reply->message)) !!}
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-muted italic border p-3 rounded bg-light text-center">
                                            <i class="fas fa-info-circle me-1"></i> No reply yet!
                                        </div>
                                    @endforelse
                                </div>

                                <button class="btn btn-outline-primary shadow-sm answer-trigger-button" type="button" data-bs-toggle="collapse" data-bs-target="#answer-wrapper">
                                    <i class="fas fa-reply me-2"></i> Reply
                                </button>

                                <div class="collapse mt-3" id="answer-wrapper">
                                    <div class="mb-3">
                                        <textarea class="form-control" id="message" rows="4" name="message" placeholder="Type your reply here..."></textarea>
                                    </div>

                                    <button class="btn btn-primary shadow answer-send-button" type="button" data-url="{{ route('admin.contacts.reply', $contact->id) }}">
                                        <svg class="icon icon-left svg-icon-ti-ti-send" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 14l11 -11"></path>
                                            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                        </svg>
                                        Send
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 gap-3 d-flex flex-column mb-md-0 mb-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-light border-bottom">
                                <h4 class="card-title fw-bold">Publish</h4>
                            </div>
                            <div class="card-body bg-white p-3">
                                <div class="btn-list d-flex flex-column gap-2">
                                    <button class="btn btn-primary w-100 shadow-sm" type="submit" value="apply" name="submitter">
                                        <svg class="icon icon-left svg-icon-ti-ti-device-floppy me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                            <path d="M10 14a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M14 4l0 4l-6 0l0 -4"></path>
                                        </svg>
                                        Save
                                    </button>

                                    <button class="btn btn-outline-secondary w-100" type="submit" name="submitter" value="save">
                                        <svg class="icon icon-left svg-icon-ti-ti-transfer-in me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 18v3h16v-14l-8 -4l-8 4v3"></path>
                                            <path d="M4 14h9"></path>
                                            <path d="M10 11l3 3l-3 3"></path>
                                        </svg>
                                        Save & Exit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card meta-boxes shadow-sm border-0 mt-3">
                            <div class="card-header bg-light border-bottom">
                                <h4 class="card-title fw-bold">Status</h4>
                            </div>
                            <div class="card-body bg-white p-3">
                                <select class="form-select border-0 bg-light shadow-none" id="status" name="status">
                                    <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="unread" {{ $contact->status == 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                </select>
                            </div>
                        </div>

                        <div class="card shadow-sm border-0 mt-3 d-none">
                            <div class="card-header bg-light border-bottom">
                                <h4 class="card-title fw-bold text-danger">Actions</h4>
                            </div>
                            <div class="card-body bg-white p-3 text-center">
                                <button type="button" class="btn btn-outline-danger w-100 delete-confirm-btn" data-url="{{ route('admin.contacts.destroy', $contact->id) }}" data-redirect="{{ route('admin.contacts.list') }}">
                                    <i class="fas fa-trash me-2"></i> Delete contact
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'contactForm',
        'bulkDeleteUrl' => '#'
    ])
    <script>
        $(document).on('click', '.answer-send-button', function() {
            let button = $(this);
            let url = button.data('url');
            let message = $('#message').val();

            if (!message) {
                if (typeof Botble !== 'undefined') {
                    Botble.showError('Please enter a message');
                } else {
                    alert('Please enter a message');
                }
                return;
            }

            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Sending...');

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: message
                },
                success: function(response) {
                    if (response.status) {
                        if (typeof Botble !== 'undefined') {
                            Botble.showSuccess(response.message);
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        if (typeof Botble !== 'undefined') {
                            Botble.showError(response.message);
                        }
                        button.prop('disabled', false).html('Send');
                    }
                },
                error: function(xhr) {
                    if (typeof Botble !== 'undefined') {
                        Botble.showError('Error sending reply');
                    }
                    button.prop('disabled', false).html('Send');
                }
            });
        });
    </script>
@endpush
