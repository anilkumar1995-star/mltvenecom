@extends('admin-layouts.app')
@section('title', 'Invoices')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Invoices
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>
                                    <a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->code }}</a>
                                </td>
                                <td>
                                    <div>{{ $invoice->customer_name }}</div>
                                    <div class="text-muted">{{ $invoice->customer_email }}</div>
                                </td>
                                <td>{{ number_format($invoice->amount, 2) }}</td>
                                <td>
                                    @if($invoice->status == 'completed')
                                        <span class="badge bg-green text-green-fg">Completed</span>
                                    @elseif($invoice->status == 'pending')
                                        <span class="badge bg-yellow text-yellow-fg">Pending</span>
                                    @elseif($invoice->status == 'canceled')
                                        <span class="badge bg-red text-red-fg">Canceled</span>
                                    @else
                                        <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($invoice->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $invoice->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-icon btn-outline-primary btn-sm" title="View/Print" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                        </a>
                                        <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger btn-sm ms-2" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($invoices->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No invoices found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $invoices->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
