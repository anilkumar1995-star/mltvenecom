@extends('admin-layouts.app')
@section('title', 'Product Tags')

@section('content')
<div class="page-wrapper">
    {{-- Page Header --}}
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Product Tags</h1>
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
            {{-- Standard Filters --}}
            @include('admin-layouts.partials.table-filters', [
                'filterColumns' => $filterColumns
            ])

            <div class="card">
                {{-- Create Button (must be BEFORE table-header include) --}}
                @section('table_actions')
                    <a href="{{ route('admin.producttags.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId' => 'productTagsTable'
                ])

                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="productTagsTable">
                            <thead>
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="80">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="120">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $tag->id }}">
                                    </td>
                                    <td class="text-muted">{{ $tag->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.producttags.edit', $tag->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $tag->name }}
                                        </a>
                                    </td>
                                    <td class="text-muted small">
                                        {{ Str::limit($tag->description, 100) }}
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match(strtolower($tag->status)) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft' => 'bg-warning text-warning-fg',
                                                'pending' => 'bg-danger text-danger-fg',
                                                default => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucwords($tag->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ is_string($tag->created_at) ? $tag->created_at : ($tag->created_at ? $tag->created_at->format('M d, Y') : 'N/A') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.producttags.edit', $tag->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn"
                                                data-url="{{ route('admin.producttags.Delete') }}"
                                                data-id="{{ $tag->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No product tags found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $tags->firstItem() ?? 0 }} to {{ $tags->lastItem() ?? 0 }} of {{ $tags->total() }} entries
                        </div>
                        <div>
                            {{ $tags->appends(request()->query())->links() }}
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
    'tableId' => 'productTagsTable',
    'bulkDeleteUrl' => route('admin.producttags.bulk-delete')
])
<script>
    $(document).on('click', '.delete-confirm-btn', function(e) {
        e.preventDefault();
        let btn = $(this);
        let id = btn.data('id');
        let url = btn.data('url');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', id: id },
                    success: function(response) {
                        if (response.status || response.success) {
                            Swal.fire('Deleted!', 'Product tag has been deleted.', 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
