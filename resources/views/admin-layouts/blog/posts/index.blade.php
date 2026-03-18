@extends('admin-layouts.app')
@section('title', 'Posts')

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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Blog</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Posts</h1>
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
                    <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'postsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="postsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="70" class="text-start">ID</th>
                                    <th width="80" class="text-start">Image</th>
                                    <th>Name</th>
                                    <th>Categories</th>
                                    <th>Author</th>
                                    <th class="text-center">Views</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $post->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $post->id }}</td>
                                    <td class="text-start">
                                        <div class="avatar avatar-sm rounded bg-white border">
                                            @php
                                                $imageUrl = $post->image ? (str_contains($post->image, 'http') ? $post->image : asset('storage/' . $post->image)) : asset('img/noimg.png');
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="{{ $post->name }}" class="avatar-img" onerror="this.src='{{ asset('img/noimg.png') }}'">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.blog.posts.edit', $post->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $post->name }}
                                        </a>
                                        @if($post->is_featured)
                                            <span class="badge bg-yellow-lt ms-1" title="Featured Post">
                                                <i class="fas fa-star small"></i>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($post->categories as $category)
                                            <span class="badge bg-blue-lt mb-1">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="small text-muted">
                                        {{ $post->author->name ?? 'System' }}
                                    </td>
                                    <td class="text-center">
                                        <span class="text-muted small">{{ number_format($post->views) }}</span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $post->created_at ? $post->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($post->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                'pending'   => 'bg-warning text-warning-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">{{ ucwords($post->status ?? 'N/A') }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.blog.posts.edit', $post->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.blog.posts.destroy', $post->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No posts found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $posts->firstItem() ?? 0 }} to {{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }} entries
                        </div>
                        <div>
                            {{ $posts->appends(request()->query())->links() }}
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
        'tableId'       => 'postsTable',
        'bulkDeleteUrl' => route('admin.blog.posts.bulk-delete')
    ])
@endpush
