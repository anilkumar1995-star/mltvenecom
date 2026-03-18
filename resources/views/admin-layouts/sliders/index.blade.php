@extends('admin-layouts.app')
@section('title', 'Simple Sliders')

@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none text-uppercase">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <h1 class="mb-0 d-inline-block fs-6 lh-1">Simple Sliders</h1>
                            </li>
                        </ol>
                    </nav>
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
                    <a href="{{ route('admin.simple-sliders.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'slidersTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="slidersTable">
                            <thead class="bg-light text-uppercase">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="80">ID</th>
                                    <th>Name</th>
                                    <th>Shortcode</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="120" class="text-center">Status</th>
                                    <th width="120" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sliders as $slider)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $slider->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $slider->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.simple-sliders.edit', $slider->id) }}" class="fw-bold text-dark text-decoration-none hover-primary">
                                            {{ $slider->name }}
                                        </a>
                                        @if($slider->description)
                                            <div class="small text-muted text-truncate" style="max-width: 300px;">
                                                {{ $slider->description }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <code class="bg-gray-100 px-2 py-1 rounded text-primary small">
                                                [simple-slider alias="{{ $slider->key }}"][/simple-slider]
                                            </code>
                                            <button class="btn btn-sm btn-icon btn-ghost-primary copy-shortcode" 
                                                data-shortcode='[simple-slider alias="{{ $slider->key }}"][/simple-slider]'
                                                title="Copy Shortcode">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $slider->created_at ? $slider->created_at->format('Y-m-d') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $statusClass = match(strtolower($slider->status ?? '')) {
                                                'published' => 'bg-success text-success-fg',
                                                'draft'     => 'bg-secondary text-secondary-fg',
                                                default     => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 rounded-pill shadow-xs">
                                            {{ ucwords($slider->status ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.simple-sliders.edit', $slider->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.simple-sliders.destroy', $slider->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No sliders found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between pt-3">
                        <div class="text-muted small">
                            Showing {{ $sliders->firstItem() ?? 0 }} to {{ $sliders->lastItem() ?? 0 }} of {{ $sliders->total() }} entries
                        </div>
                        <div>
                            {{ $sliders->appends(request()->query())->links() }}
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
        'tableId'       => 'slidersTable',
        'bulkDeleteUrl' => route('admin.simple-sliders.bulk-delete')
    ])
    <script>
        $(document).on('click', '.copy-shortcode', function() {
            let shortcode = $(this).data('shortcode');
            navigator.clipboard.writeText(shortcode).then(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    icon: 'success',
                    title: 'Shortcode copied!'
                });
            });
        });
    </script>
@endpush
