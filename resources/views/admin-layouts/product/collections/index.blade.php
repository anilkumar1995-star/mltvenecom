@extends('admin-layouts.app')
@section('title', 'Product Collections')

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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Collections</h1>
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
            {{-- Shared Filter Panel --}}
            @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

            <div class="card has-actions has-filter">
                {{-- Create Button (must be BEFORE table-header include) --}}
                @section('table_actions')
                    <a href="{{ route('admin.collections.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'collectionsTable'
                ])

                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="collectionsTable">
                            <thead>
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="60">ID</th>
                                    <th width="60" class="text-center">Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($collections as $row)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $row->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $row->id }}</td>
                                    <td class="text-center">
                                        @if($row->image)
                                            <div class="avatar avatar-sm rounded p-1 bg-white border">
                                                <img src="{{ asset('storage/' . $row->image) }}"
                                                     onerror="this.src='{{ asset('img/noimg.png') }}'"
                                                     alt="{{ $row->name }}" class="avatar-img">
                                            </div>
                                        @else
                                            <div class="avatar avatar-sm rounded p-1 bg-white border">
                                                <img src="{{ asset('img/noimg.png') }}" alt="No Image" class="avatar-img">
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.collections.edit', $row->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $row->name }}
                                        </a>
                                        @if($row->is_featured)
                                            <span class="badge bg-yellow-lt ms-1" title="Featured Collection">
                                                <i class="fas fa-star small"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-muted small">{{ $row->slug }}</td>
                                    <td class="text-center text-muted small">
                                        {{ $row->created_at ? $row->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($row->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ ucwords($row->status ?? 'N/A') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.collections.edit', $row->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.collections.destroy', $row->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">No records found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $collections->firstItem() ?? 0 }} to {{ $collections->lastItem() ?? 0 }} of {{ $collections->total() }} entries
                        </div>
                        <div>
                            {{ $collections->appends(request()->query())->links() }}
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
        'tableId'       => 'collectionsTable',
        'bulkDeleteUrl' => route('admin.collections.bulk-delete')
    ])
@endpush
