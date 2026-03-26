@extends('vendor-layouts.app')
@section('title', 'Withdrawals')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Withdrawals</h1>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('table_actions')
        <a href="{{ route('frontend.vendor.withdrawals.create') }}" class="btn btn-primary">
            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            Create
        </a>
    @endsection

    <div class="page-body">
        <div class="container-xl">
            <div class="table-wrapper">
                @php
                    $filterArgs = ['filterColumns' => $filterColumns];
                @endphp
                @include('admin-layouts.partials.table-filters', $filterArgs)

                <div class="card has-actions has-filter">
                    @php
                        $headerArgs = ['bulkActions' => false];
                    @endphp
                    @include('admin-layouts.partials.table-header', $headerArgs)

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="withdrawalsTable">
                                <thead>
                                    <tr>
                                        <th title="Checkbox" width="20">
                                            <input class="form-check-input m-0 align-middle table-check-all" type="checkbox">
                                        </th>
                                        <th title="ID" width="50" class="text-center">ID</th>
                                        <th title="Amount">Amount</th>
                                        <th title="Payment Channel">Channel</th>
                                        <th title="Status" width="130" class="text-center">Status</th>
                                        <th title="Created At">Date</th>
                                        <th title="Operations" class="text-end">Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($withdrawals) > 0)
                                        @foreach($withdrawals as $withdrawal)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $withdrawal->id }}">
                                            </td>
                                            <td class="text-center">{{ $withdrawal->id }}</td>
                                            <td><strong>₹{{ number_format($withdrawal->amount, 2) }}</strong></td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $withdrawal->payment_channel)) }}</td>
                                            <td class="text-center">
                                                @if($withdrawal->status == 'completed')
                                                    <span class="badge bg-success text-white">Completed</span>
                                                @elseif($withdrawal->status == 'pending')
                                                    <span class="badge bg-warning text-white">Pending</span>
                                                @elseif($withdrawal->status == 'refused')
                                                    <span class="badge bg-danger text-white">Refused</span>
                                                @else
                                                    <span class="badge bg-secondary text-white">{{ ucfirst($withdrawal->status) }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $withdrawal->created_at->format('d M Y') }}</td>
                                            <td class="text-end">
                                               <span class="text-muted">No Actions</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No withdrawals found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            {{ $withdrawals->appends(request()->query())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin-layouts.partials.table-scripts', [
        'tableId' => 'withdrawalsTable'
    ])
@endpush
