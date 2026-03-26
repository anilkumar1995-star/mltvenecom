@extends('admin-layouts.app')
@section('title', 'Blog Tags')

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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Blog</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Tags</h1>
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
                {{-- Create Button Section --}}
                @section('table_actions')
                    <a href="{{ route('admin.blog.tags.create') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="fas fa-plus me-1"></i>
                        Create
                    </a>
                @endsection

                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'tagsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="tagsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="70" class="text-start">ID</th>
                                    <th width="300">Name</th>
                                    <th class="text-center">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $tag->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $tag->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('admin.blog.tags.edit', $tag->id) }}" class="fw-bold text-dark text-decoration-none">
                                                {{ $tag->name }}
                                            </a>
                                            <small class="text-muted">{{ $tag->slug }}</small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($tag->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                'pending'   => 'bg-warning text-warning-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ ucwords($tag->status ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $tag->created_at ? $tag->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.blog.tags.edit', $tag->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.blog.tags.destroy', $tag->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No tags found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($tags, 'links'))
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $tags->firstItem() ?? 0 }} to {{ $tags->lastItem() ?? 0 }} of {{ $tags->total() }} entries
                        </div>
                        <div>
                            {{ $tags->appends(request()->query())->links() }}
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
        'tableId'       => 'tagsTable',
        'bulkDeleteUrl' => route('admin.blog.tags.bulk-delete')
    ])
@endpush
