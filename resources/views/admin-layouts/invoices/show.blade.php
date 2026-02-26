<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Invoice {{ $invoice->code }}</title>
    <!-- CSS files -->
    <link href="{{ asset('home/dist/css/tabler.min.css') }}" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
        body {
            background-color: #fff;
            color: #000;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container-xl py-4">
        <div class="card card-lg invoice-box">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p class="h3">Company Name</p>
                        <address>
                            123 Street Name<br>
                            City, State, Zip Code<br>
                            Country
                        </address>
                    </div>
                    <div class="col-6 text-end">
                        <p class="h3">Invoice</p>
                        <address>
                            <strong>{{ $invoice->customer_name }}</strong><br>
                            {{ $invoice->customer_address ?? 'Address not provided' }}<br>
                            {{ $invoice->customer_email }}<br>
                            {{ $invoice->customer_phone }}
                        </address>
                    </div>
                    <div class="col-12 my-5">
                        <h1>Invoice {{ $invoice->code }}</h1>
                    </div>
                </div>
                <table class="table table-transparent table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 1%">#</th>
                            <th>Product</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-end" style="width: 1%">Unit Price</th>
                            <th class="text-end" style="width: 1%">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <p class="strong mb-1">{{ $item->name }}</p>
                                <div class="text-muted">{{ $item->productOptionsImplode }}</div>
                            </td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-end">{{ number_format($item->price, 2) }}</td>
                            <td class="text-end">{{ number_format($item->amount, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Subtotal</td>
                            <td class="font-weight-bold text-end">{{ number_format($invoice->sub_total, 2) }}</td>
                        </tr>
                        @if($invoice->tax_amount > 0)
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Tax</td>
                            <td class="font-weight-bold text-end">{{ number_format($invoice->tax_amount, 2) }}</td>
                        </tr>
                        @endif
                        @if($invoice->shipping_amount > 0)
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Shipping</td>
                            <td class="font-weight-bold text-end">{{ number_format($invoice->shipping_amount, 2) }}</td>
                        </tr>
                        @endif
                         @if($invoice->discount_amount > 0)
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Discount</td>
                            <td class="font-weight-bold text-end">-{{ number_format($invoice->discount_amount, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-end">Total Due</td>
                            <td class="font-weight-bold text-end">{{ number_format($invoice->amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="text-muted text-center mt-5">Thank you for your business!</p>
            </div>
            <div class="card-footer no-print text-center">
                <button type="button" class="btn btn-primary" onclick="window.print();">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                    Print Invoice
                </button>
                <button type="button" class="btn btn-secondary ms-2" onclick="window.close();">Close</button>
            </div>
        </div>
    </div>
</body>
</html>
