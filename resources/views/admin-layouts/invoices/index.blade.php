@extends('admin-layouts.app')
@section('title', 'Invoices')
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
                                    <h1 class="mb-0 d-inline-block fs-6 lh-1">Invoices</h1>
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
                @include('admin-layouts.partials.table-filters', ['filterColumns' => $filterColumns])

                <div class="card has-actions has-filter">
                    @section('table_actions')
                        <button class="btn btn-primary invoice-generate" data-action="{{ route('admin.invoices.generate') }}" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                            Generate Invoices
                        </button>
                    @endsection

                    @include('admin-layouts.partials.table-header', [
                        'bulkActions' => true,
                        'tableId' => 'invoicesTable'
                    ])

                    <div class="card-table">
                        <div class="table-responsive table-has-actions table-has-filter">
                            <table class="table card-table table-vcenter table-hover datatable" id="invoicesTable">
                                <thead>
                                <tr>
                                    <th class="text-center" style="width: 20px;">
                                        <input class="form-check-input m-0 align-middle table-check-all" type="checkbox" aria-label="Select all invoices">
                                    </th>
                                    <th title="ID" width="50" class="text-start">ID</th>
                                    <th title="Name" class="text-start">Name</th>
                                    <th title="Order" class="text-start">Order</th>
                                    <th title="Code" class="text-start">Code</th>
                                    <th title="Amount" class="text-start">Amount</th>
                                    <th title="Created at" class="text-start">Created At</th>
                                    <th title="Status" width="120" class="text-center">Status</th>
                                    <th title="Operations" class="text-end">Operations</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($invoices as $invoice)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="form-check-input bulk-checkbox" value="{{ $invoice->id }}">
                                        </td>
                                        <td class="text-start">{{ $invoice->id }}</td>
                                        <td class="text-start">
                                            <div>{{ $invoice->customer_name }}</div>
                                            @if($invoice->customer_email)
                                            <div class="text-muted"><small>{{ $invoice->customer_email }}</small></div>
                                            @endif
                                        </td>
                                        <td class="text-start">
                                            <a href="#" class="text-decoration-none">#SF-100000{{ $invoice->reference_id }}</a>
                                        </td>
                                        <td class="text-start">
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}">{{ $invoice->code }}</a>
                                        </td>
                                        <td class="text-start">₹{{ number_format($invoice->amount, 2) }}</td>
                                        <td class="text-start">{{ $invoice->created_at->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            @if($invoice->status == 'completed')
                                                <span class="badge bg-success text-white">Completed</span>
                                            @elseif($invoice->status == 'pending')
                                                <span class="badge bg-warning text-white">Pending</span>
                                            @elseif($invoice->status == 'canceled')
                                                <span class="badge bg-danger text-white">Canceled</span>
                                            @else
                                                <span class="badge bg-secondary text-white">{{ ucfirst($invoice->status) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-confirm-btn" data-url="{{ route('admin.invoices.destroy', $invoice->id) }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">No invoices found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $invoices->firstItem() ?? 0 }} to {{ $invoices->lastItem() ?? 0 }} of {{ $invoices->total() ?? 0 }} entries
                            </div>
                            {{ $invoices->appends(request()->query())->links('pagination::bootstrap-5') }}
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
        'tableId' => 'invoicesTable',
        'bulkDeleteUrl' => url('/admin/invoices/bulk-delete')
    ])
    <script>
        $(document).ready(function () {
            // Generate Invoices Logic
            $('.invoice-generate').on('click', function () {
                let btn = $(this);
                let url = btn.data('action');
                let originalText = btn.html();

                btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Generating...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        btn.prop('disabled', false).html(originalText);
                        if (response.success || response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message || 'Invoices generated successfully.',
                                icon: 'success',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message || 'Something went wrong.', 'error');
                        }
                    },
                    error: function(xhr) {
                        btn.prop('disabled', false).html(originalText);
                        Swal.fire('Error!', 'Could not generate invoices. Please check your backend code.', 'error');
                    }
                });
            });
        });
    </script>
@endpush
