@extends('admin-layouts.app')
@section('title', 'Galleries')

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
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Galleries</h1>
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
                {{-- Create Button --}}
                @section('table_actions')
                    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'galleriesTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="galleriesTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="80">ID</th>
                                    <th width="100" class="text-center">Image</th>
                                    <th>Name</th>
                                    <th width="120" class="text-center">Order</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galleries as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $item->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $item->id }}</td>
                                    <td class="text-center">
                                        @if($item->image)
                                            <img src="{{ \App\Helpers\ImageHelper::getImageUrl() . $item->image }}" onerror="this.src='{{ asset('vendor/core/core/base/images/placeholder.png') }}'" class="rounded shadow-sm border" alt="{{ $item->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border" style="width: 50px; height: 50px;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-bold">
                                        <a href="{{ route('admin.galleries.edit', $item->id) }}" class="text-dark text-decoration-none">{{ $item->name ?? 'N/A' }}</a>
                                    </td>
                                    <td class="text-center">{{ $item->order }}</td>
                                    <td class="text-center">
                                        @if($item->status === 'published')
                                            <span class="badge bg-success text-success-fg px-3 rounded-pill shadow-xs text-capitalize">{{ $item->status }}</span>
                                        @elseif($item->status === 'pending')
                                            <span class="badge bg-warning text-warning-fg px-3 rounded-pill text-capitalize">{{ $item->status }}</span>
                                        @else
                                            <span class="badge bg-secondary text-secondary-fg px-3 rounded-pill text-capitalize">{{ $item->status ?? 'draft' }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $item->created_at ? $item->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.galleries.edit', $item->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.galleries.destroy', $item->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No galleries found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $galleries->firstItem() ?? 0 }} to {{ $galleries->lastItem() ?? 0 }} of {{ $galleries->total() }} entries
                        </div>
                        <div>
                            {{ $galleries->appends(request()->query())->links() }}
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
        'tableId'       => 'galleriesTable',
        'bulkDeleteUrl' => route('admin.galleries.bulk-delete')
    ])
@endpush
