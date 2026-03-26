@extends('admin-layouts.app')
@section('title', 'Edit Invoice')
@section('content')
<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb text-uppercase">
                                <li class="breadcrumb-item"><a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.dashboard') }}">DASHBOARD</a></li>
                                <li class="breadcrumb-item"><a class="mb-0 d-inline-block fs-6 lh-1" href="#">ECOMMERCE</a></li>
                                <li class="breadcrumb-item"><a class="mb-0 d-inline-block fs-6 lh-1" href="{{ route('admin.invoices.index') }}">INVOICES</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><h1 class="mb-0 d-inline-block fs-6 lh-1">EDIT "{{ $invoice->code }}"</h1></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <button type="button" class="btn btn-default" onclick="window.print();">
                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            Print Invoice
                        </button>
                        <a href="#" class="btn btn-default">
                            <svg class="icon icon-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 11l5 5l5 -5" />
                                <path d="M12 4l0 12" />
                            </svg>
                            Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="page-body page-content">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-5">
                    <!-- Top section -->
                    <div class="row mb-5">
                        <div class="col-6"></div>
                        <div class="col-6 text-end">
                            <h2 class="h1 mb-3">Invoice</h2>
                            <address class="mb-0 text-muted">
                                {{ $invoice->customer_name }}<br>
                                {{ $invoice->customer_email }}<br>
                                {{ $invoice->customer_phone }}<br>
                                {{ $invoice->customer_address ?? 'Address not provided' }}
                            </address>
                        </div>
                    </div>
                    
                    <!-- Metadata row -->
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <div class="text-muted text-uppercase text-xs fw-bold mb-1">Invoice Code</div>
                            <div class="fs-4">{{ $invoice->code }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted text-uppercase text-xs fw-bold mb-1">Issue At</div>
                            <div class="fs-4">{{ $invoice->created_at->format('d F, Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-muted text-uppercase text-xs fw-bold mb-1">Payment Method</div>
                            <div class="fs-4">
                                @if($invoice->payment_id == 0)
                                    Fast and safe online payment via PayPal
                                @else
                                    {{ $invoice->payment ? $invoice->payment->payment_channel : 'Fast and safe online payment' }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="table-responsive bg-light p-3 rounded">
                        <table class="table table-vcenter table-borderless mb-0">
                            <thead>
                                <tr class="text-muted text-uppercase text-xs font-weight-bolder">
                                    <th>#</th>
                                    <th>IMAGE</th>
                                    <th class="w-50">PRODUCT</th>
                                    <th>AMOUNT</th>
                                    <th>QUANTITY</th>
                                    <th class="text-end">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoice->items as $index => $item)
                                <tr class="border-bottom">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if(isset($item->image) && $item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" class="avatar avatar-md rounded" alt="{{ $item->name }}">
                                        @else
                                            <div class="avatar avatar-md rounded bg-secondary text-white">
                                                <i class="fa fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="text-decoration-none fw-bold">{{ $item->name }}</a>
                                        @if(isset($item->productOptionsImplode) && $item->productOptionsImplode)
                                        <div class="text-muted text-sm mt-1">{{ $item->productOptionsImplode }}</div>
                                        @endif
                                    </td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td class="text-end fw-bold">₹{{ number_format($item->amount, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No items defined for this dummy invoice.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Totals Grid -->
                    <div class="row mt-4">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr class="border-bottom">
                                        <td>Quantity</td>
                                        <td class="text-end fw-bold">{{ $invoice->items ? $invoice->items->sum('qty') : 0 }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Sub Total</td>
                                        <td class="text-end fw-bold">₹{{ number_format($invoice->sub_total, 2) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Shipping Fee</td>
                                        <td class="text-end fw-bold">₹{{ number_format($invoice->shipping_amount, 2) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Discount</td>
                                        <td class="text-end fw-bold">₹{{ number_format($invoice->discount_amount, 2) }}</td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td>Grand Total</td>
                                        <td class="text-end fw-bold">₹{{ number_format($invoice->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="pt-3">Total Amount</td>
                                        <td class="text-end pt-3 text-danger fs-3">₹{{ number_format($invoice->amount, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Details -->
                    <div class="mt-5 pt-3 border-top">
                        <div class="d-flex align-items-center text-sm">
                            <span class="text-muted me-2">Invoice For:</span>
                            <a href="#" class="text-decoration-none d-flex align-items-center">
                                #SF-100000{{ $invoice->reference_id }}
                                <svg class="icon ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                    <path d="M11 13l9 -9" />
                                    <path d="M15 4h5v5" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
