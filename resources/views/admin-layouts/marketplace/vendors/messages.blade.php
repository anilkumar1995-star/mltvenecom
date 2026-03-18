@extends('admin-layouts.app')
@section('title', 'Marketplace Messages')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Marketplace</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Messages</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="page-body page-content mt-0">
        <div class="container-xl">
            {{-- Shared Filter Panel --}}
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'messagesTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="messagesTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="70" class="text-start">ID</th>
                                    <th width="200">Sender</th>
                                    <th>Content</th>
                                    <th width="150" class="text-center">Sent At</th>
                                    <th width="120" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($messages as $message)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $message->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $message->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $message->name ?: 'Guest' }}</span>
                                            <span class="text-muted small">{{ $message->email }}</span>
                                            @if($message->store)
                                                <span class="badge bg-purple-lt mt-1 w-fit">
                                                    Store: {{ $message->store->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-muted small text-truncate" style="max-width: 400px;" title="{{ $message->content }}">
                                            {{ $message->content }}
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $message->created_at ? $message->created_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-info btn-view-message" 
                                                data-name="{{ $message->name ?: 'Guest' }}"
                                                data-email="{{ $message->email }}"
                                                data-content="{{ $message->content }}"
                                                data-time="{{ $message->created_at->format('M d, Y H:i') }}"
                                                title="View Message">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.marketplace.messages.destroy', $message->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No messages found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($messages, 'links'))
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $messages->firstItem() ?? 0 }} to {{ $messages->lastItem() ?? 0 }} of {{ $messages->total() }} entries
                        </div>
                        <div>
                            {{ $messages->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId'       => 'messagesTable',
        'bulkDeleteUrl' => route('admin.marketplace.messages.bulk-delete')
    ])
    <script>
        $(document).ready(function () {
            // View Message Detail in Modal
            $(document).on('click', '.btn-view-message', function() {
                const name = $(this).data('name');
                const email = $(this).data('email');
                const content = $(this).data('content');
                const time = $(this).data('time');

                Swal.fire({
                    title: '<span class="text-primary mt-2">Message Details</span>',
                    html: `
                        <div class="text-start mt-3">
                            <div class="mb-3 p-2 bg-light rounded border-start border-primary border-3">
                                <div class="small text-muted mb-1 text-uppercase fw-bold">From</div>
                                <div><strong>${name}</strong> (${email})</div>
                            </div>
                            <div class="mb-3 p-2 bg-light rounded border-start border-info border-3">
                                <div class="small text-muted mb-1 text-uppercase fw-bold">Received At</div>
                                <div>${time}</div>
                            </div>
                            <div class="p-3 bg-white rounded border">
                                <div class="small text-muted mb-2 text-uppercase fw-bold">Message</div>
                                <div style="white-space: pre-wrap; line-height: 1.6;">${content}</div>
                            </div>
                        </div>
                    `,
                    width: '600px',
                    confirmButtonText: 'Close',
                    confirmButtonColor: '#3085d6',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });
        });
    </script>
@endpush