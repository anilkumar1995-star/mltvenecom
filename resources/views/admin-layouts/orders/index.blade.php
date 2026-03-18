@extends('admin-layouts.app')
@section('title', 'Orders')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Orders</h1>
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
                    {{-- Shared Filter Panel --}}
                    @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                        {{-- Table Card --}}
                        <div class="card has-actions has-filter">
                            {{-- Custom Action Buttons for this page --}}
                            @section('table_actions')
                                <a href="#" class="btn" data-bs-toggle="tooltip" title="Export">
                                    <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                    Export
                                </a>
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary d-flex align-items-center">
                                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5v14" />
                                        <path d="M5 12h14" />
                                    </svg>
                                    Create
                                </a>
                            @endsection

                            {{-- Shared Header --}}
                            @include('admin-layouts.partials.table-header', [
                                'bulkActions' => true
                            ])

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="ordersTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Email">Email</th>
                                            <th title="Amount">Amount</th>
                                            <th title="Payment method">Payment method</th>
                                            <th title="Payment status" width="130" class="text-center">Payment status</th>
                                            <th title="Status" width="120" class="text-center">Status</th>
                                            <th title="Tax amount">Tax amount</th>
                                            <th title="Shipping amount">Shipping amount</th>
                                            <th title="Operations" class="text-end">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $order->id }}">
                                            </td>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td>
                                                @if($order->user)
                                                    <div>{{ $order->user->name }}</div>
                                                    <div class="text-muted small">{{ $order->user->email }}</div>
                                                @else
                                                    <span class="text-muted">Guest</span>
                                                @endif
                                            </td>
                                            <td>₹{{ number_format($order->amount, 2) }}</td>
                                            <td>{{ $order->payment ? ucfirst(str_replace('_', ' ', $order->payment->payment_channel ?? 'N/A')) : 'N/A' }}</td>
                                            <td class="text-center">
                                                @php $payStatus = $order->payment->status ?? 'N/A'; @endphp
                                                @if($payStatus == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($payStatus == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($payStatus == 'refunded')
                                                    <span class="badge bg-info text-white">Refunded</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($payStatus) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($order->status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($order->status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($order->status == 'processing')
                                                    <span class="badge bg-info text-white">Processing</span>
                                                @elseif($order->status == 'canceled')
                                                    <span class="badge bg-danger text-white">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($order->status) }}</span>
                                                @endif
                                            </td>
                                            <td>₹{{ number_format($order->tax_amount, 2) }}</td>
                                            <td>₹{{ number_format($order->shipping_amount, 2) }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.orders.destroy', $order->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">No orders found</td>
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
        </main>

@endsection

@push('scripts')
    {{-- Shared Scripts --}}
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'ordersTable',
        'bulkDeleteUrl' => route('admin.orders.bulk-delete')
    ])
@endpush
