@extends('admin-layouts.app')
@section('title', 'Pages')

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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Pages</h1>
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
                {{-- Custom Action Buttons for this page --}}
                @section('table_actions')
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive table-has-actions table-has-filter">
                        <table class="table card-table table-vcenter table-hover datatable" id="pagesTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="20">
                                        <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                    </th>
                                    <th width="50" class="text-center">ID</th>
                                    <th>Name</th>
                                    <th>Template</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th class="text-end">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pages as $page)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $page->id }}">
                                    </td>
                                    <td class="text-center">{{ $page->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($page->image)
                                                <span class="avatar avatar-sm me-2" style="background-image: url({{ \App\Helpers\ImageHelper::getImageUrl() . $page->image }})"></span>
                                            @endif
                                            <div>
                                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="fw-bold">{{ $page->name }}</a>
                                                <div class="text-muted small">/{{ \Illuminate\Support\Str::slug($page->name) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ ucfirst($page->template ?? 'Default') }}</td>
                                    <td class="text-center">
                                        @if($page->status == 'published')
                                            <span class="badge bg-success text-white">Published</span>
                                        @elseif($page->status == 'draft')
                                            <span class="badge bg-warning text-white">Draft</span>
                                        @else
                                            <span class="badge bg-secondary text-white">{{ ucfirst($page->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $page->created_at ? $page->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.pages.destroy', $page->id) }}" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No pages found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="text-muted small">
                        Showing {{ $pages->firstItem() ?? 0 }} to {{ $pages->lastItem() ?? 0 }} of {{ $pages->total() }} entries
                    </div>
                    <div>
                        {{ $pages->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    {{-- Shared Scripts --}}
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'pagesTable',
        'bulkDeleteUrl' => route('admin.pages.bulk-delete')
    ])
@endpush
