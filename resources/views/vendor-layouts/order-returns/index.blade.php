@extends('admin-layouts.app')
@section('title', 'Order Returns')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Order Returns</h1>
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
                    @include('admin-layouts.partials.table-filters', [
                        'filterColumns' => [
                            'id' => 'ID',
                            'order_id' => 'Order ID',
                            'return_status' => 'Status',
                            'created_at' => 'Created At'
                        ]
                    ])

                    {{-- Table Card --}}
                    <div class="card has-actions has-filter">
                        {{-- Shared Header --}}
                        @include('admin-layouts.partials.table-header', [
                            'bulkActions' => true
                        ])
                        
                        @section('table_actions')
                            <a href="{{ route('admin.order-returns.export') }}" class="btn" data-bs-toggle="tooltip" title="Export">
                                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                Export
                            </a>
                        @endsection

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="returnsTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Order ID">Order ID</th>
                                            <th title="Customer">Customer</th>
                                            <th title="Reason">Reason</th>
                                            <th title="Status" width="120" class="text-center">Status</th>
                                            <th title="Created At">Created At</th>
                                            <th title="Operations" class="text-end">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($returns as $return)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $return->id }}">
                                            </td>
                                            <td class="text-center">{{ $return->id }}</td>
                                            <td>
                                                @if($return->order)
                                                    <a href="#">#{{ $return->order->id }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($return->user)
                                                    <a href="{{ route('admin.customers.edit', $return->user->id) }}">{{ $return->user->name }}</a>
                                                @else
                                                    Guest
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Str::limit($return->reason, 50) }}</td>
                                            <td class="text-center">
                                                @if($return->return_status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($return->return_status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($return->return_status == 'canceled')
                                                    <span class="badge bg-danger text-white">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($return->return_status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $return->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td class="text-end">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.order-returns.destroy', $return->id) }}" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                {{ $returns->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    {{-- Shared Scripts --}}
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'returnsTable',
        'bulkDeleteUrl' => route('admin.order-returns.bulk-delete')
    ])
@endpush
