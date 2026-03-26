@extends('vendor-layouts.app')
@section('title', 'Order Returns')
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @section('table_actions')
                    @endsection

                    @include('admin-layouts.partials.table-header', ['bulkActions' => false])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="returnsTable">
                                <thead>
                                    <tr>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Order">Order</th>
                                        <th title="Customer">Customer</th>
                                        <th title="Reason">Reason</th>
                                        <th title="Return status" width="130" class="text-center">Return status</th>
                                        <th title="Created At">Date</th>
                                        <th title="Operations" class="text-end">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($returns) > 0)
                                        @foreach($returns as $return)
                                        <tr>
                                            <td class="text-center">{{ $return->id }}</td>
                                            <td><strong>{{ $return->order->code }}</strong></td>
                                            <td>{{ $return->user->name }}</td>
                                            <td>{{ $return->reason }}</td>
                                            <td class="text-center">
                                                @if($return->return_status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($return->return_status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($return->return_status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $return->created_at->format('d M Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('frontend.vendor.order-returns.show', $return->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No order returns found</td>
                                        </tr>
                                    @endif
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
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'returnsTable'
    ])
@endpush
