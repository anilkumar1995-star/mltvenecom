@extends('admin-layouts.app')
@section('title', 'Discounts')

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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Discounts</h1>
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
                    <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary d-flex align-items-center">
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
                    'tableId'     => 'discountsTable'
                ])

                <div class="card-table">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="discountsTable">
                            <thead>
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="60">ID</th>
                                    <th>Detail</th>
                                    <th class="text-center">Used</th>
                                    <th class="text-center">Start Date</th>
                                    <th class="text-center">End Date</th>
                                    <th class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($discounts as $discount)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $discount->id }}">
                                    </td>
                                    <td class="text-muted">{{ $discount->id }}</td>
                                    <td>
                                        @if($discount->type == 'coupon')
                                            <div class="p-3 rounded-2 text-white shadow-sm" style="background: linear-gradient(135deg, #206bc4, #0054a6); max-width: 400px; border-left: 5px solid #ffcc00;">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <span class="fw-bold tracking-tight">COUPON: <code class="text-white bg-dark bg-opacity-25 px-2 rounded">{{ $discount->code }}</code></span>
                                                    <button type="button" class="btn btn-sm btn-link text-white p-0 border-0" 
                                                            onclick="navigator.clipboard.writeText('{{ $discount->code }}'); notify('Copied!', 'success');" title="Copy">
                                                        <i class="far fa-copy"></i>
                                                    </button>
                                                </div>
                                                <div class="small fw-semibold opacity-90">
                                                    Discount: 
                                                    <span class="text-warning">
                                                        @if($discount->type_option == 'amount')
                                                            ₹{{ number_format($discount->value, 2) }}
                                                        @else
                                                            {{ $discount->value }}%
                                                        @endif
                                                    </span>
                                                    for {{ ucwords(str_replace('-', ' ', $discount->target)) }}
                                                </div>
                                                @if(!$discount->can_use_with_promotion)
                                                    <div class="mt-2 text-warning fst-italic x-small border-top border-white border-opacity-10 pt-1">
                                                        * Cannot be combined with other promotions.
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="p-3 rounded-2 text-white shadow-sm" style="background: linear-gradient(135deg, #6f42c1, #522d9b); max-width: 400px; border-left: 5px solid #00f2fe;">
                                                <div class="fw-bold mb-1 letter-spacing-1 text-uppercase small">Promotion: {{ $discount->title }}</div>
                                                <div class="small fw-semibold opacity-90">
                                                    Discount: 
                                                    <span class="text-info">
                                                        @if($discount->type_option == 'amount')
                                                            ₹{{ number_format($discount->value, 2) }}
                                                        @else
                                                            {{ $discount->value }}%
                                                        @endif
                                                    </span>
                                                    for {{ ucwords(str_replace('-', ' ', $discount->target)) }}
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-blue-lt fw-bold px-3 py-2 fs-5">{{ $discount->total_used ?? 0 }}</span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $discount->start_date ? $discount->start_date->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @if($discount->end_date)
                                            <span class="small">{{ $discount->end_date->format('M d, Y') }}</span>
                                        @else
                                            <span class="badge bg-purple-lt text-uppercase px-2" style="font-size: 10px;">Lifetime</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.discounts.edit', $discount->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.discounts.destroy', $discount->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div class="empty">
                                            <div class="empty-icon">
                                                <i class="fas fa-percentage fa-3x opacity-20"></i>
                                            </div>
                                            <p class="empty-title">No discounts found</p>
                                            <p class="empty-subtitle text-muted">Try adjusting your filter or search.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $discounts->firstItem() ?? 0 }} to {{ $discounts->lastItem() ?? 0 }} of {{ $discounts->total() }} entries
                        </div>
                        <div>
                            {{ $discounts->appends(request()->query())->links() }}
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
        'tableId'       => 'discountsTable',
        'bulkDeleteUrl' => route('admin.discounts.bulk-delete')
    ])
@endpush
