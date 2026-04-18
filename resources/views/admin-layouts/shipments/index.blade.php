@extends('admin-layouts.app')
@section('title', 'Shipments')
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
                                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Shipments</h1>
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
                        {{-- Shared Header --}}
                        @include('admin-layouts.partials.table-header', [
                            'bulkActions' => true
                        ])
                        
                        @section('table_actions')
                            <a href="{{ route('admin.shipments.export') }}" class="btn" data-bs-toggle="tooltip" title="Export">
                                <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3" /></svg>
                                Export
                            </a>
                        @endsection

                        <div class="card-table">
                            <div class="table-responsive table-has-actions table-has-filter">
                                <table class="table card-table table-vcenter table-hover datatable" id="shipmentsTable">
                                    <thead>
                                        <tr>
                                            <th title="Checkbox" width="20">
                                                <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" id="check-all">
                                            </th>
                                            <th title="ID" width="50" class="text-center">ID</th>
                                            <th title="Order ID">ORDER ID</th>
                                            <th title="Customer">CUSTOMER</th>
                                            <th title="Shipping Amount">SHIPPING AMOUNT</th>
                                            <th title="Warehouse">WAREHOUSE</th>
                                            <th title="Status" width="100" class="text-center">STATUS</th>
                                            <th title="COD Status" width="100" class="text-center">COD STATUS</th>
                                            <th title="Created At">CREATED AT</th>
                                            <th title="Operations" class="text-end">OPERATIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($shipments as $shipment)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $shipment->id }}">
                                            </td>
                                            <td class="text-center text-muted">{{ $shipment->id }}</td>
                                            <td>
                                                @if($shipment->order_id)
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" class="text-primary text-decoration-none">#SF-{{ str_pad($shipment->order_id, 8, '0', STR_PAD_LEFT) }}</a>
                                                        <a href="#" class="ms-1 text-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-external-link" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg>
                                                        </a>
                                                    </div>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if($shipment->order && $shipment->order->user)
                                                    <div class="mb-1 text-dark">{{ $shipment->order->user->name }}</div>
                                                    <div class="mb-1 text-muted small">{{ $shipment->order->user->email }}</div>
                                                    @if($shipment->order->user->phone)
                                                    <div class="text-muted small">{{ $shipment->order->user->phone }}</div>
                                                    @endif
                                                @else
                                                    <div class="text-muted">Guest</div>
                                                @endif
                                            </td>
                                            <td>₹{{ number_format($shipment->price, 2) }}</td>
                                            <td>
                                                <span class="text-muted">{{ $shipment->store && $shipment->store->name ? $shipment->store->name : 'N/A' }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if(strtolower($shipment->status) == 'delivered')
                                                    <span class="badge bg-success text-success-fg">Delivered</span>
                                                @elseif(strtolower($shipment->status) == 'approved')
                                                    <span class="badge bg-warning text-warning-fg">Approved</span>
                                                @elseif(strtolower($shipment->status) == 'delivering')
                                                    <span class="badge bg-info text-info-fg">Delivering</span>
                                                @elseif(strtolower($shipment->status) == 'canceled')
                                                    <span class="badge bg-danger text-danger-fg">Canceled</span>
                                                @else
                                                    <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($shipment->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if(strtolower($shipment->cod_status) == 'completed')
                                                    <span class="badge bg-success text-success-fg">Completed</span>
                                                @elseif(strtolower($shipment->cod_status) == 'pending' || strtolower($shipment->cod_status) == 'not available')
                                                    <span class="badge bg-blue text-blue-fg">Not available</span>
                                                @else
                                                    <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($shipment->cod_status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $shipment->created_at->format('Y-m-d') }}</td>
                                            <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.shipments.edit', $shipment->id) }}" class="btn btn-sm btn-outline-info" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.shipments.destroy', $shipment->id) }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">No records found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer d-flex align-items-center">
                                {{ $shipments->appends(request()->query())->links('pagination::bootstrap-5') }}
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
        'tableId' => 'shipmentsTable',
        'bulkDeleteUrl' => route('admin.shipments.bulk-delete')
    ])
@endpush
