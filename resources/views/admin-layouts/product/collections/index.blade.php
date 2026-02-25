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
                                        <a class="mb-0 d-inline-block fs-6 lh-1"
                                            href="{{ route('home') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Ecommerce</h1>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Product collections</h1>
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
                <div id="filter-section" class="card mb-3" style="display: none;">
                    <div class="card-body">
                        <form action="{{ route('admin.collections.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Search Name</label>
                                <input type="text" name="search" class="form-control" placeholder="Search by name..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                                <a href="{{ route('admin.collections.index') }}" class="btn btn-light">Reset</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-wrapper">
                    <div class="card has-actions">
                        <div class="card-header">
                            <div class="w-100 justify-content-between d-flex flex-wrap align-items-center gap-1">
                                <div class="d-flex flex-wrap flex-md-nowrap align-items-center gap-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" id="bulkActionsBtn">
                                                Bulk Actions
                                            </button>
                                            <div class="dropdown-menu shadow-sm">
                                                <a class="dropdown-item text-danger d-flex align-items-center"
                                                    href="javascript:void(0)" id="bulkDeleteBtn">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </a>
                                            </div>
                                        </div>

                                        <button class="btn btn-light" type="button" onclick="$('#filter-section').slideToggle()">
                                            <i class="fas fa-filter me-1"></i> Filters
                                        </button>

                                        <div class="table-search-input">
                                            <form action="{{ route('admin.collections.index') }}" method="GET">
                                                <div class="input-group input-group-flat">
                                                    <input type="text" name="search" class="form-control ps-2"
                                                        placeholder="Search..." value="{{ request('search') }}">
                                                    <span class="input-group-text px-2">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-1 table-action-buttons">
                                    <a href="{{ route('admin.collections.create') }}" class="btn btn-primary">
                                        <svg class="icon svg-icon-ti-ti-plus" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        <span class="ms-1">Create</span>
                                    </a>

                                    <button class="btn" type="button" onclick="location.reload()">
                                        <svg class="icon icon-left svg-icon-ti-ti-refresh"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                            <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                        </svg>
                                        Reload
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-table">
                            <div class="table-responsive table-has-actions">
                                <table class="table card-table table-vcenter table-hover datatable" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="40"><input class="form-check-input m-0 align-middle" id="checkAll"
                                                    type="checkbox"></th>
                                            <th width="40" class="text-center">ID</th>
                                            <th width="50" class="text-center">Image</th>
                                            <th class="text-start">Name</th>
                                            <th class="text-start">Slug</th>
                                            <th>Created At</th>
                                            <th class="text-center">Status</th>
                                            <th width="100" class="text-center">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($collections as $row)
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input row-checkbox"
                                                    value="{{ $row->id }}"></td>
                                            <td class="text-center">{{ $loop->index + 1 }}</td>
                                            <td class="text-center">
                                                @if($row->image)
                                                    <img src="{{ asset('storage/' . $row->image) }}" alt="{{ $row->name }}" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td class="text-start">
                                                <a href="{{ route('admin.collections.edit', $row->id) }}">
                                                    {{ $row->name }}
                                                </a>
                                            </td>
                                            <td>{{ $row->slug }}</td>
                                            <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge {{ $row->status == 'published' ? 'bg-success text-success-fg' : 'bg-secondary text-secondary-fg' }} rounded-pill px-2">
                                                    {{ ucwords($row->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-list flex-nowrap">
                                                    <a href="{{ route('admin.collections.edit', $row->id) }}"
                                                        class="btn btn-icon btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button onclick="deleteItem({{ $row->id }})"
                                                        class="btn btn-icon btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No product collections found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    @endsection

    @push('scripts')
    <script>
    function deleteItem(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this collection?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.collections.delete") }}',
                    type: 'POST',
                    data: { id: id, _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', res.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Something went wrong on the server', 'error');
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        // Bulk Delete Event
        $(document).on('click', '#bulkDeleteBtn', function(e) {
            e.preventDefault();
            var ids = [];
            $('.row-checkbox:checked').each(function() {
                ids.push($(this).val());
            });

            if (ids.length === 0) {
                Swal.fire('Error', 'Please select at least one item', 'error');
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to delete " + ids.length + " items.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete them!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("admin.collections.bulk-delete") }}',
                        type: 'POST',
                        data: { ids: ids, _token: '{{ csrf_token() }}' },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire('Deleted!', res.message, 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Something went wrong on the server', 'error');
                        }
                    });
                }
            });
        });

        // Check All functionality
        $(document).on('change', '#checkAll', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });
    });
    </script>
    @endpush
