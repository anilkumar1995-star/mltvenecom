@extends('admin-layouts.app')
@section('title', 'Incomplete Orders')
@section('content')
<div class="page-wrapper">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Incomplete Orders
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
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment method</th>
                                <th>Payment status</th>
                                <th>Created at</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    @if($order->user)
                                    <a href="{{ route('admin.customers.edit', $order->user->id) }}">{{ $order->user->name }}</a>
                                    @else
                                    Guest
                                    @endif
                                </td>
                                <td>{{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-secondary text-secondary-fg">Incomplete</span>
                                </td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>
                                    <span class="badge bg-secondary text-secondary-fg">{{ ucfirst($order->payment_status) }}</span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-list flex-nowrap">
                                        <form action="{{ route('admin.incomplete-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger btn-sm" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <line x1="4" y1="7" x2="20" y2="7" />
                                                    <line x1="10" y1="11" x2="10" y2="17" />
                                                    <line x1="14" y1="11" x2="14" y2="17" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @if($orders->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center">No incomplete orders found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection