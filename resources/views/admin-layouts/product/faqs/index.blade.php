@extends('admin-layouts.app')
@section('title', 'Product FAQs')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center text-uppercase">
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">FAQs</h1>
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
                {{-- Create Button (must be BEFORE table-header include) --}}
                @section('table_actions')
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'faqsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="faqsTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="50">ID</th>
                                    <th>Question</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $row)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $row->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $row->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.faqs.edit', $row->id) }}" class="text-primary text-decoration-none">
                                            {{ $row->question }}
                                        </a>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $row->created_at ? $row->created_at->format('Y-M-d') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($row->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ ucwords($row->status ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.faqs.edit', $row->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.faqs.destroy', $row->id) }}"
                                                data-id="{{ $row->id }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No records found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $faqs->firstItem() ?? 0 }} to {{ $faqs->lastItem() ?? 0 }} of {{ $faqs->total() }} entries
                        </div>
                        <div>
                            {{ $faqs->appends(request()->query())->links() }}
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
        'tableId'       => 'faqsTable',
        'bulkDeleteUrl' => route('admin.faqs.bulk-delete')
    ])
@endpush
