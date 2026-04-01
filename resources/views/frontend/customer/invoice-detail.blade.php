@extends('frontend.layouts.app')

@section('title', 'Invoice Details #' . $invoice->code)

@section('content')
<main>
    <div class="bb-customer-page crop-avatar">
        <div class="container">
            <div class="customer-body shadow-sm rounded-4 overflow-hidden bg-white border-0">
                <div class="d-lg-none bg-white border-bottom p-3 d-print-none">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="wrapper-image">
                                <img class="rounded-circle img-fluid shadow-sm" style="width:40px;height:40px;" src="{{ $customer->avatar_url ?? asset('home/placeholder.png') }}" alt="{{ $customer->name ?? 'User' }}">
                            </div>
                            <div>
                                <div class="fw-semibold small text-dark">{{ $customer->name ?? 'User' }}</div>
                                <div class="text-muted small">Account Dashboard</div>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#customerSidebar" aria-controls="customerSidebar">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>

                <div class="row g-0">
                    {{-- Desktop Sidebar --}}
                    <div class="col-lg-3 d-none d-lg-block border-end bg-light-subtle d-print-none">
                        <div class="bb-customer-sidebar-wrapper h-100 d-flex flex-column">
                            <div class="bb-customer-sidebar flex-1">
                                <div class="bb-customer-sidebar-heading border-bottom">
                                    <div class="d-flex align-items-center gap-3 p-4">
                                        <div class="position-relative">
                                            <div class="wrapper-image">
                                                <img class="rounded-circle border border-3 border-white shadow-sm" style="width:56px;height:56px; object-fit: cover;" src="{{ $customer->avatar_url ?? asset('home/placeholder.png') }}" alt="{{ $customer->name ?? 'User' }}">
                                            </div>
                                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white" style="width:14px;height:14px;"></div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="name fw-bold text-dark text-truncate">{{ $customer->name ?? 'User' }}</div>
                                            <div class="email text-muted small text-truncate">{{ $customer->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                                @include('frontend.customer.sidebar', ['active' => 'invoices'])
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="bb-profile-content p-4 p-md-5 bg-white">
                            {{-- Admin Style Header Integration --}}
                            <div class="d-flex justify-content-between align-items-center mb-5 d-print-none">
                                <a href="{{ route('frontend.customer.invoices') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                    <i class="fas fa-arrow-left me-1"></i> Back to Invoices
                                </a>
                                <div class="btn-list">
                                    <button type="button" class="btn btn-default shadow-sm rounded-pill" onclick="window.print();">
                                        <i class="fas fa-print me-2"></i> Print Invoice
                                    </button>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white invoice-card-main">
                                <div class="card-body p-4 p-md-5">
                                    <!-- Top section -->
                                    <div class="row mb-5 invoice-header-row">
                                        <div class="col-6">
                                            <img src="{{ asset('home/logo.png') }}" alt="Logo" class="invoice-logo" style="max-height: 50px;">
                                        </div>
                                        <div class="col-6 text-end">
                                            <h2 class="h1 mb-3 fw-black text-dark invoice-title-text" style="letter-spacing: -2px;">INVOICE</h2>
                                            <address class="mb-0 text-muted small">
                                                <span class="fw-bold text-dark">{{ $invoice->customer_name }}</span><br>
                                                {{ $invoice->customer_email }}<br>
                                                {{ $invoice->customer_phone }}<br>
                                                {{ $invoice->customer_address ?? 'Address not provided' }}
                                            </address>
                                        </div>
                                    </div>
                                    
                                    <!-- Metadata row -->
                                    <div class="row mb-5 bg-light-subtle p-4 rounded-4 invoice-meta-row border">
                                        <div class="col-md-3">
                                            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Invoice Code</div>
                                            <div class="fs-6 fw-bold text-dark">{{ $invoice->code }}</div>
                                        </div>
                                        <div class="col-md-3 mt-3 mt-md-0 border-start">
                                            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Order Code</div>
                                            <div class="fs-6 fw-bold text-primary">{{ $invoice->reference->code ?? '#' . $invoice->reference_id }}</div>
                                        </div>
                                        <div class="col-md-3 mt-3 mt-md-0 border-start">
                                            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Issue Date</div>
                                            <div class="fs-6 fw-bold text-dark">{{ $invoice->created_at->format('d F, Y') }}</div>
                                        </div>
                                        <div class="col-md-3 mt-3 mt-md-0 border-start">
                                            <div class="text-muted text-uppercase fw-bold mb-1" style="font-size: 10px; letter-spacing: 1px;">Payment</div>
                                            <div class="fs-6 fw-bold text-dark text-truncate">
                                                {{ $invoice->payment ? $invoice->payment->payment_channel : 'Online' }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Products Table with Fixed Colgroup -->
                                    <div class="table-responsive mb-5">
                                        <table class="table table-vcenter align-middle mb-0 invoice-main-table">
                                            <colgroup>
                                                <col style="width: 50px;">
                                                <col style="width: auto;">
                                                <col style="width: 120px;">
                                                <col style="width: 80px;">
                                                <col style="width: 150px;">
                                            </colgroup>
                                            <thead>
                                                <tr class="text-muted text-uppercase fw-bold bg-light" style="font-size: 10px; letter-spacing: 1px;">
                                                    <th class="ps-4">#</th>
                                                    <th>PRODUCT</th>
                                                    <th class="text-center">AMOUNT</th>
                                                    <th class="text-center">QTY</th>
                                                    <th class="text-end pe-4">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($invoice->items as $index => $item)
                                                <tr>
                                                    <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                                                    <td style="white-space: normal;">
                                                        <div class="fw-bold text-dark">{{ $item->name }}</div>
                                                        @if(isset($item->description) && $item->description)
                                                        <div class="text-muted small mt-1">{{ $item->description }}</div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">₹{{ number_format($item->price, 2) }}</td>
                                                    <td class="text-center">{{ $item->qty }}</td>
                                                    <td class="text-end pe-4 fw-bold">₹{{ number_format($item->amount, 2) }}</td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-4 text-muted">No items found.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                            <tfoot class="border-top-0 invoice-table-footer">
                                                <tr>
                                                    <td colspan="3" rowspan="5" class="align-top pt-4 border-0 status-box-td">
                                                        <div class="bg-light p-4 rounded-4 d-inline-block status-badge-wrapper">
                                                            <h6 class="fw-bold text-dark mb-2 small text-uppercase" style="letter-spacing: 1px;">Status:</h6>
                                                            @php
                                                                $statusClass = match($invoice->status) {
                                                                    'paid' => 'bg-success',
                                                                    'pending' => 'bg-warning text-dark',
                                                                    'cancelled' => 'bg-danger',
                                                                    default => 'bg-secondary'
                                                                };
                                                            @endphp
                                                            <span class="badge rounded-pill {{ $statusClass }} px-3 py-2 text-uppercase" style="font-size: 10px;">
                                                                {{ $invoice->status }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pt-4 fw-bold text-muted border-0 small no-wrap">Sub Total:</td>
                                                    <td class="text-end pe-4 pt-4 fw-bold text-dark border-0 no-wrap">₹{{ number_format($invoice->sub_total, 2) }}</td>
                                                </tr>
                                                @if($invoice->tax_amount > 0)
                                                <tr>
                                                    <td class="text-end fw-bold text-muted border-0 small no-wrap">Tax:</td>
                                                    <td class="text-end pe-4 fw-bold text-dark border-0 no-wrap">₹{{ number_format($invoice->tax_amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                @if($invoice->shipping_amount > 0)
                                                <tr>
                                                    <td class="text-end fw-bold text-muted border-0 small no-wrap">Shipping:</td>
                                                    <td class="text-end pe-4 fw-bold text-dark border-0 no-wrap">₹{{ number_format($invoice->shipping_amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                @if($invoice->discount_amount > 0)
                                                <tr>
                                                    <td class="text-end fw-bold text-muted border-0 small no-wrap">Discount:</td>
                                                    <td class="text-end pe-4 fw-bold text-danger border-0 no-wrap">-₹{{ number_format($invoice->discount_amount, 2) }}</td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-end py-4 fw-black text-dark fs-5 border-0 no-wrap align-middle">Final Total:</td>
                                                    <td class="text-end pe-4 py-3 text-primary fw-black fs-3 border-0 no-wrap align-middle">₹{{ number_format($invoice->amount, 2) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <!-- Footer Details -->
                                    <div class="mt-5 pt-4 border-top border-light invoice-footer-details">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                            <div class="d-flex align-items-center small text-muted">
                                                <span class="me-2">Order Code:</span>
                                                <span class="fw-bold text-dark">{{ $invoice->reference->code ?? '#' . $invoice->reference_id }}</span>
                                            </div>
                                            <div class="small text-muted italic">
                                                Thank you for choosing our store!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Sidebar Offcanvas --}}
        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="customerSidebar" aria-labelledby="customerSidebarLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title fw-bold" id="customerSidebarLabel">Member Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="bb-customer-sidebar-wrapper">
                    @include('frontend.customer.sidebar', ['active' => 'invoices'])
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .fw-black { font-weight: 900; }
    .bg-light-subtle { background-color: #f8f9fa !important; }
    address { line-height: 1.6; }
    .no-wrap { white-space: nowrap !important; }
    
    @media print {
        header, footer, aside, nav, 
        .tp-header-area, .tp-header-sticky, .tp-header-mobile, 
        .tp-header-action-item-5, .tp-header-action-badge-5,
        .bb-customer-sidebar-wrapper, .d-lg-none, .d-print-none, 
        .bb-profile-header, .btn, .breadcrumb, .tp-offcanvas-area, 
        .tp-search-area, .tp-cart-area, #dashboard-logout-form {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0 !important;
            width: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        body { background-color: #fff !important; margin: 0 !important; padding: 0 !important; }
        .container { max-width: 100% !important; width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .customer-body { border: none !important; box-shadow: none !important; margin: 0 !important; padding: 0 !important; background: #fff !important; }
        .row { margin-right: 0 !important; margin-left: 0 !important; }
        .col-lg-3 { display: none !important; }
        .col-lg-9 { width: 100% !important; flex: 0 0 100% !important; max-width: 100% !important; padding: 0 !important; margin: 0 !important; }
        .bb-profile-content { padding: 40px !important; margin: 0 !important; }
        .card { border: none !important; box-shadow: none !important; }
        .card-body { padding: 0 !important; }

        .table { 
            display: table !important; 
            width: 100% !important; 
            border-collapse: collapse !important; 
            margin-top: 30px !important; 
            table-layout: fixed !important; 
        }
        .table tr { display: table-row !important; }
        .table th, .table td { 
            display: table-cell !important; 
            vertical-align: middle !important; 
            padding: 15px 12px !important; 
            border-bottom: 2px solid #f8f9fa !important; 
            overflow: visible !important; 
        }

        /* Colgroup Widths - Hardcoded for Print */
        .table col:nth-child(1) { width: 50px !important; }
        .table col:nth-child(2) { width: auto !important; }
        .table col:nth-child(3) { width: 120px !important; }
        .table col:nth-child(4) { width: 80px !important; }
        .table col:nth-child(5) { width: 180px !important; }

        .table-responsive { overflow: visible !important; }
        .text-end { text-align: right !important; }
        .text-center { text-align: center !important; }

        .bg-light { background-color: #f8f9fa !important; -webkit-print-color-adjust: exact !important; }
        .bg-primary-subtle { background-color: #e0eaffe3 !important; -webkit-print-color-adjust: exact !important; }
        .text-primary { color: #034f75 !important; -webkit-print-color-adjust: exact !important; }
        .badge { border: 1px solid #ddd !important; -webkit-print-color-adjust: exact !important; }
        
        /* Ensure specific rows stay horizontal */
        .invoice-header-row, .invoice-meta-row {
            display: flex !important;
            flex-direction: row !important;
            width: 100% !important;
        }
        .invoice-header-row .col-6 {
            flex: 1 !important;
        }
        .invoice-meta-row > div {
            flex: 1 !important;
            border-left: 1px solid #eee !important;
            padding-left: 15px !important;
        }
        .invoice-meta-row > div:first-child {
            border-left: none !important;
            padding-left: 0 !important;
        }
    }
</style>
@endsection
