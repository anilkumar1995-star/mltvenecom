@extends('admin-layouts.app')
@section('title', 'Posts')
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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Blog</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Posts</h1>
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
            <div class="table-wrapper">
                
                {{-- Table Card --}}
                <div class="card has-actions has-filter">
                    <div class="card-header">
                        <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                            <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                <div class="dropdown d-inline-block">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Bulk Actions
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item text-danger" id="bulk-delete" style="display: none;">Delete</button>
                                    </div>
                                </div>

                                <button class="btn btn-show-table-options" type="button">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227z" /></svg>
                                    Filters
                                </button>

                                <div class="table-search-input">
                                    <label>
                                        <input type="search" class="form-control input-sm" id="table-search" placeholder="Search..." style="min-width: 120px" value="{{ request('search') }}">
                                    </label>
                                </div>
                            </div>
                            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                <a href="{{ route('admin.blog.posts.create') }}" class="btn btn-primary" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                    Create
                                </a>
                                <button class="btn" type="button" onclick="window.location.reload()">
                                    <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                    Reload
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="postsTable">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">
                                        <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" aria-label="Select all posts">
                                    </th>
                                    <th title="ID" width="50" class="text-start">ID</th>
                                    <th title="IMAGE" width="70" class="text-start">IMAGE</th>
                                    <th title="NAME" class="text-start">NAME</th>
                                    <th title="CATEGORIES" class="text-start">CATEGORIES</th>
                                    <th title="AUTHOR" class="text-start">AUTHOR</th>
                                    <th title="VIEWS" class="text-center">VIEWS</th>
                                    <th title="CREATED AT" class="text-center">CREATED AT</th>
                                    <th title="STATUS" width="120" class="text-center">STATUS</th>
                                    <th title="OPERATIONS" class="text-center" width="120">OPERATIONS</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($posts as $post)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $post->id }}">
                                        </td>
                                        <td class="text-start">{{ $post->id }}</td>
                                        <td class="text-start">
                                            @if($post->image)
                                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->name }}" style="width: 50px; height: auto;">
                                            @else
                                            <img src="https://via.placeholder.com/50" alt="Placeholder">
                                            @endif
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('admin.blog.posts.edit', $post->id) }}" class="text-primary fw-medium">{{ $post->name }}</a>
                                        </td>
                                        <td class="text-start text-primary">
                                            {{ $post->categories->pluck('name')->implode(', ') }}
                                        </td>
                                        <td class="text-start text-primary">
                                            {{ $post->author->name ?? 'System' }}
                                        </td>
                                        <td class="text-center text-muted">{{ number_format($post->views) }}</td>
                                        <td class="text-center text-muted">{{ $post->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            @if($post->status == 'published')
                                                <span class="badge bg-success text-white">Published</span>
                                            @elseif($post->status == 'pending')
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif($post->status == 'draft')
                                                <span class="badge bg-secondary text-white">Draft</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ ucfirst($post->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="table-actions d-flex justify-content-center gap-1">
                                                <a href="{{ route('admin.blog.posts.edit', $post->id) }}" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="tooltip" data-bs-title="Edit">
                                                    <svg class="icon svg-icon-ti-ti-edit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>            
                                                    <span class="sr-only">Edit</span>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-icon btn-danger delete-btn" data-url="{{ route('admin.blog.posts.destroy', $post->id) }}" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                    <svg class="icon svg-icon-ti-ti-trash" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>            
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <div class="mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-x" width="48" height="48" viewBox="0 0 24 24" stroke-width="1.5" stroke="#9e9e9e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                  <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                  <path d="M10 12l4 4m0 -4l-4 4" />
                                                </svg>
                                            </div>
                                            No posts found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ method_exists($posts, 'firstItem') ? $posts->firstItem() : 0 }} to {{ method_exists($posts, 'lastItem') ? $posts->lastItem() : 0 }} of {{ method_exists($posts, 'total') ? $posts->total() : $posts->count() }} records
                            </div>
                            {{ method_exists($posts, 'links') ? $posts->appends(request()->query())->links('pagination::bootstrap-5') : '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Check all
            $('.table-check-all').on('change', function () {
                $('.bulk-checkbox').prop('checked', $(this).is(':checked'));
                updateBulkDeleteButton();
            });

            $(document).on('change', '.bulk-checkbox', function () {
                updateBulkDeleteButton();
            });

            function updateBulkDeleteButton() {
                let checkedCount = $('.bulk-checkbox:checked').length;
                if (checkedCount > 0) {
                    $('#bulk-delete').show().text(`Delete (${checkedCount})`);
                } else {
                    $('#bulk-delete').hide();
                }
            }

            // Individual Delete
            $(document).on('click', '.delete-btn', function () {
                let btn = $(this);
                let url = btn.data('url');

                Swal.fire({
                    title: 'Confirm delete',
                    text: "Do you really want to delete this record?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (response) {
                                Swal.fire('Deleted!', 'Post has been deleted.', 'success').then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });

            // Live Search (client-side implementation)
            let searchTimer;
            $('#table-search').on('keyup', function () {
                clearTimeout(searchTimer);
                let query = $(this).val().toLowerCase();
                searchTimer = setTimeout(function() {
                    $('#postsTable tbody tr').each(function () {
                        let text = $(this).text().toLowerCase();
                        $(this).toggle(text.indexOf(query) > -1);
                    });
                }, 300);
            });
        });
    </script>
@endpush
