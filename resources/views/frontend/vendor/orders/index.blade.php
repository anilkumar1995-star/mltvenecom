@extends('vendor-layouts.app')
@section('title', 'Orders')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('frontend.vendor.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Orders</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                {{-- Shared Filter Panel (Reusing admin partials for consistency) --}}
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @section('table_actions')
                        <a href="#" class="btn" data-bs-toggle="tooltip" title="Export">
                            <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                            Export
                        </a>
                    @endsection

                    @include('admin-layouts.partials.table-header', ['bulkActions' => true])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="ordersTable">
                                <thead>
                                    <tr>
                                        <th title="Checkbox" width="20">
                                            <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                        </th>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Order Code">Code</th>
                                        <th title="Customer">Customer</th>
                                        <th title="Amount">Amount</th>
                                        <th title="Status" width="120" class="text-center">Status</th>
                                        <th title="Created At">Date</th>
                                        <th title="Operations" class="text-end">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $order->id }}">
                                        </td>
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td><strong>{{ $order->code }}</strong></td>
                                        <td>
                                            @if($order->user)
                                                <div>{{ $order->user->name }}</div>
                                                <div class="text-muted small">{{ $order->user->email }}</div>
                                            @else
                                                <span class="text-muted">Guest</span>
                                            @endif
                                        </td>
                                        <td>₹{{ number_format($order->amount, 2) }}</td>
                                        <td class="text-center">
                                            @if($order->status == 'completed')
                                                <span class="badge bg-success text-white">Completed</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="badge bg-danger text-white">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('frontend.vendor.orders.show', $order->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('frontend.vendor.orders.bulk-delete') }}" data-id="{{ $order->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No orders found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'ordersTable',
        'bulkDeleteUrl' => route('frontend.vendor.orders.bulk-delete')
    ])
@endpush
