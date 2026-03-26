@extends('admin-layouts.app')
@section('title', 'Incomplete Orders')

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
                                <li class="breadcrumb-item">
                                    <span class="mb-0 d-inline-block fs-6 lh-1 text-muted">Ecommerce</span>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1 text-dark">Incomplete Orders</h1>
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
                    'tableId'     => 'incompleteOrdersTable'
                ])

                <div class="card-table mt-1">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter table-hover datatable" id="incompleteOrdersTable">
                            <thead class="bg-light">
                                <tr>
                                    <th width="40" class="text-center">
                                        <input type="checkbox" class="form-check-input" id="check-all">
                                    </th>
                                    <th width="70" class="text-start">ID</th>
                                    <th>Customer Info</th>
                                    <th width="120" class="text-center">Amount</th>
                                    <th width="150" class="text-center">Payment Method</th>
                                    <th width="150" class="text-center">Payment Status</th>
                                    <th width="120" class="text-center">Order Status</th>
                                    <th width="150" class="text-center">Created At</th>
                                    <th width="100" class="text-center">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $order->id }}">
                                    </td>
                                    <td class="text-muted small">{{ $order->id }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if($order->user)
                                                <a href="{{ route('admin.customers.edit', $order->user->id) }}" class="fw-bold text-dark text-decoration-none">
                                                    {{ $order->user->name }}
                                                </a>
                                                <small class="text-muted">{{ $order->user->email }}</small>
                                            @else
                                                <span class="text-muted italic">Guest / No Customer</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-center font-weight-bold">
                                        ₹{{ number_format($order->amount, 2) }}
                                    </td>
                                    <td class="text-center small text-uppercase">
                                        {{ $order->payment_channel ?: 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $payStatus = strtolower($order->payment_status ?? 'pending');
                                            $payStatusClass = match($payStatus) {
                                                'completed' => 'bg-success text-success-fg',
                                                'pending' => 'bg-warning text-warning-fg',
                                                'processing' => 'bg-info text-info-fg',
                                                'failed' => 'bg-danger text-danger-fg',
                                                default => 'bg-secondary text-secondary-fg'
                                            };
                                        @endphp
                                        <span class="badge {{ $payStatusClass }} px-2 rounded-pill shadow-xs">
                                            {{ ucfirst($order->payment_status ?? 'Pending') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-purple-lt px-2 rounded-pill">Incomplete</span>
                                    </td>
                                    <td class="text-center text-muted small">
                                        {{ $order->created_at ? $order->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.incomplete-orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" 
                                                data-url="{{ route('admin.incomplete-orders.destroy', $order->id) }}"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted bg-white shadow-xs rounded-1">
                                        No incomplete orders found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <div class="text-muted small">
                            Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} entries
                        </div>
                        <div>
                            {{ $orders->appends(request()->query())->links() }}
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
        'tableId'       => 'incompleteOrdersTable',
        'bulkDeleteUrl' => route('admin.incomplete-orders.bulk-delete')
    ])
@endpush