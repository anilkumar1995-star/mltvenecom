@extends('admin-layouts.app')
@section('title', 'Contact Messages')

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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Ecommerce</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Contact Messages</h1>
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
                    'tableId'     => 'contactsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="contactsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="70" class="text-start">ID</th>
                                    <th>Sender Info</th>
                                    <th>Subject & Message</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($contacts as $contact)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $contact->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $contact->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $contact->name }}</span>
                                            <small class="text-muted">{{ $contact->email }}</small>
                                            @if($contact->phone)
                                                <small class="text-muted">{{ $contact->phone }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $contact->subject ?? 'No Subject' }}</span>
                                            <small class="text-muted text-truncate" style="max-width: 300px;">{{ $contact->content }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $status = strtolower($contact->status ?? 'unread');
                                            $statusClass = match($status) {
                                                'read' => 'bg-success text-success-fg',
                                                'unread' => 'bg-warning text-warning-fg',
                                                'replied' => 'bg-info text-info-fg',
                                                default => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-2 rounded-pill shadow-xs">
                                            {{ ucfirst($contact->status ?? 'Unread') }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $contact->created_at ? $contact->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-outline-primary" title="View Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No contact messages found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $contacts->firstItem() ?? 0 }} to {{ $contacts->lastItem() ?? 0 }} of {{ $contacts->total() }} entries
                        </div>
                        <div>
                            {{ $contacts->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId'       => 'contactsTable',
        'bulkDeleteUrl' => route('admin.contacts.bulk-delete')
    ])
@endpush