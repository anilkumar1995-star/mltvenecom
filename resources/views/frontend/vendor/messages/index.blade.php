@extends('vendor-layouts.app')
@section('title', 'Messages')
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Messages</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @include('admin-layouts.partials.table-header', ['bulkActions' => false])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="messagesTable">
                                <thead>
                                    <tr>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Sender">Sender</th>
                                        <th title="Email">Email</th>
                                        <th title="Content">Content Preview</th>
                                        <th title="Created At">Date</th>
                                        <th title="Operations" class="text-end">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $message)
                                    <tr>
                                        <td class="text-center">{{ $message->id }}</td>
                                        <td><strong>{{ $message->name }}</strong></td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ Str::limit($message->content, 50) }}</td>
                                        <td>{{ $message->created_at->format('d M Y') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('frontend.vendor.messages.show', $message->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('frontend.vendor.messages.destroy', $message->id) }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No messages found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $messages->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'messagesTable'
    ])
@endpush
