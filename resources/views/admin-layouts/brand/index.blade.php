@extends('admin-layouts.app')
@section('title', 'Brands')

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
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="#">Ecommerce</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Brands</h1>
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

            <div class="card">
                {{-- Create Button BEFORE table-header include --}}
                @section('table_actions')
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>
                        Create
                    </a>
                @endsection

                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'brandsTable'
                ])

                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="brandsTable">
                            <thead>
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="60">ID</th>
                                    <th width="70" class="text-center">Logo</th>
                                    <th>Name</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $brand)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $brand->id }}">
                                    </td>
                                    <td class="text-muted">{{ $brand->id }}</td>
                                    <td class="text-center">
                                        <div class="avatar avatar-sm rounded p-1 bg-white border">
                                            <img src="{{ $brand->logo ? (str_starts_with($brand->logo, 'http') ? $brand->logo : rtrim(\App\Helpers\ImageHelper::getImageUrl(), '/') . '/' . ltrim($brand->logo, '/')) : asset('home/placeholder.png') }}"
                                                 onerror="this.src='{{ asset('home/placeholder.png') }}'"
                                                 alt="{{ $brand->name }}" class="avatar-img">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.brand.edit', $brand->id) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $brand->name }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($brand->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-warning text-warning-fg',
                                                'pending'   => 'bg-danger text-danger-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ ucwords($brand->status ?? 'N/A') }}</span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ is_string($brand->created_at) ? $brand->created_at : ($brand->created_at ? $brand->created_at->format('M d, Y') : 'N/A') }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn"
                                                data-url="{{ route('admin.brand.Delete') }}"
                                                data-id="{{ $brand->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No brands found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $brands->firstItem() ?? 0 }} to {{ $brands->lastItem() ?? 0 }} of {{ $brands->total() }} entries
                        </div>
                        <div>
                            {{ $brands->appends(request()->query())->links() }}
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
    'tableId'       => 'brandsTable',
    'bulkDeleteUrl' => route('admin.brand.bulk-delete')
])
<script>
    $(document).on('click', '.delete-confirm-btn', function(e) {
        e.preventDefault();
        let id  = $(this).data('id');
        let url = $(this).data('url');

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
                    success: function(res) {
                        if (res.status) {
                            Swal.fire('Deleted!', res.message, 'success').then(() => location.reload());
                        } else {
                            Swal.fire('Error!', res.message, 'error');
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
