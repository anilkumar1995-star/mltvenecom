@extends('admin-layouts.app')
@section('title', 'Payment Transactions')

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
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Payments</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Transactions</h1>
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

                {{-- Shared Header --}}
                @include('admin-layouts.partials.table-header', [
                    'bulkActions' => true,
                    'tableId'     => 'paymentsTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="paymentsTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="120">Charge ID</th>
                                    <th>Customer / Order</th>
                                    <th width="150">Payment Channel</th>
                                    <th width="120">Amount</th>
                                    <th width="120">Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $item)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $item->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $item->charge_id ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $item->order ? ($item->order->user ? $item->order->user->name : 'Ordered') : 'N/A' }}</span>
                                            <div class="small text-muted">Order ID: {{ $item->order_id ?? 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary text-primary-fg px-2 py-1">{{ ucfirst($item->payment_channel) }}</span>
                                    </td>
                                    <td class="fw-bold">
                                        {{ $item->currency }} {{ number_format($item->amount, 2) }}
                                    </td>
                                    <td>
                                        @if($item->status == 'completed' || $item->status == 'success')
                                            <span class="badge bg-success text-success-fg px-3 rounded-pill shadow-xs">{{ ucfirst($item->status) }}</span>
                                        @elseif($item->status == 'pending')
                                            <span class="badge bg-warning text-warning-fg px-3 rounded-pill">{{ ucfirst($item->status) }}</span>
                                        @elseif($item->status == 'failed')
                                            <span class="badge bg-danger text-danger-fg px-3 rounded-pill">{{ ucfirst($item->status) }}</span>
                                        @else
                                            <span class="badge bg-secondary text-secondary-fg px-3 rounded-pill">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $item->created_at ? $item->created_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.payments.transactions.destroy', $item->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No transactions found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $payments->firstItem() ?? 0 }} to {{ $payments->lastItem() ?? 0 }} of {{ $payments->total() }} entries
                        </div>
                        <div>
                            {{ $payments->appends(request()->query())->links() }}
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
        'tableId'       => 'paymentsTable',
        'bulkDeleteUrl' => route('admin.payments.transactions.bulk-delete')
    ])
@endpush
