<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification - {{ $order->code }}</title>
    <style>
        body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #334155; background-color: #f1f5f9; margin: 0; padding: 0; }
        .wrapper { width: 100%; background-color: #f1f5f9; padding: 40px 0; }
        .container { max-width: 650px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .header { background: #0f172a; padding: 30px 40px; color: #ffffff; display: table; width: 100%; box-sizing: border-box; }
        .header-content { display: table-cell; vertical-align: middle; }
        .order-badge { background-color: #3b82f6; color: #ffffff; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px; display: inline-block; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 800; }
        
        .content { padding: 40px; }
        .alert-box { background-color: #f0f9ff; border: 1px solid #bae6fd; border-radius: 8px; padding: 20px; margin-bottom: 30px; }
        .alert-box p { margin: 0; color: #0369a1; font-weight: 600; }

        .section-title { font-size: 14px; text-transform: uppercase; letter-spacing: 0.1em; color: #94a3b8; font-weight: 800; margin-bottom: 15px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; }
        
        .grid { display: table; width: 100%; margin-bottom: 30px; }
        .col { display: table-cell; width: 50%; vertical-align: top; padding-right: 20px; }
        .info-label { font-size: 12px; color: #64748b; margin-bottom: 2px; }
        .info-value { font-size: 15px; font-weight: 600; color: #1e293b; margin-bottom: 12px; }

        .address-box { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; font-size: 14px; color: #475569; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { text-align: left; font-size: 11px; text-transform: uppercase; color: #94a3b8; padding: 12px 10px; background-color: #f8fafc; }
        td { padding: 15px 10px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        .product-name { font-weight: 600; color: #1e293b; }
        
        .summary-wrapper { width: 100%; margin-top: 20px; }
        .summary-row { display: table; width: 100%; margin-bottom: 5px; }
        .summary-cell { display: table-cell; vertical-align: middle; }
        .summary-label { text-align: right; color: #64748b; padding-right: 20px; font-size: 14px; }
        .summary-value { text-align: right; width: 120px; font-weight: 700; color: #1e293b; font-size: 14px; }
        .total-row { margin-top: 10px; padding-top: 10px; border-top: 2px solid #f1f5f9; }
        .total-label { font-size: 18px; font-weight: 800; color: #0f172a; }
        .total-value { font-size: 22px; font-weight: 800; color: #3b82f6; }

        .footer { padding: 30px 40px; text-align: center; color: #94a3b8; font-size: 12px; }
        
        @media only screen and (max-width: 600px) {
            .col { display: block; width: 100%; padding-right: 0; }
            .content { padding: 25px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <div class="header-content">
                    <div class="order-badge">New Order</div>
                    <h1>Order Notification</h1>
                </div>
            </div>
            
            <div class="content">
                <div class="alert-box">
                    <p>Hello {{ $store->name }}, you have received a new order for fulfillment.</p>
                </div>

                <div class="section-title">Order Basic Info</div>
                <div class="grid">
                    <div class="col">
                        <div class="info-label">Order Number</div>
                        <div class="info-value">#{{ $order->code }}</div>
                        <div class="info-label">Date Placed</div>
                        <div class="info-value">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                    </div>
                    <div class="col">
                        <div class="info-label">Payment Method</div>
                        <div class="info-value">{{ ucfirst(str_replace('_', ' ', $order->payment?->payment_channel ?? 'N/A')) }}</div>
                        <div class="info-label">Payment Status</div>
                        <div class="info-value" style="color: {{ $order->payment?->status == 'paid' ? '#10b981' : '#f59e0b' }};">{{ ucfirst($order->payment?->status ?? 'pending') }}</div>
                    </div>
                </div>

                @php
                    $shippingAddress = $order->address->where('type', 'shipping')->first();
                @endphp

                <div class="grid">
                    <div class="col">
                        <div class="section-title">Customer Details</div>
                        <div class="info-label">Name</div>
                        <div class="info-value">{{ $shippingAddress->name ?? 'Guest' }}</div>
                        <div class="info-label">Email / Phone</div>
                        <div class="info-value">{{ $shippingAddress->email ?? 'N/A' }}<br>{{ $shippingAddress->phone ?? 'N/A' }}</div>
                    </div>
                    <div class="col">
                        <div class="section-title">Shipping Address</div>
                        <div class="address-box">
                            @if($shippingAddress)
                                {{ $shippingAddress->address }}<br>
                                {{ $shippingAddress->city }}, {{ $shippingAddress->state }}<br>
                                {{ $shippingAddress->country }} @if($shippingAddress->zip_code)- {{ $shippingAddress->zip_code }}@endif
                            @else
                                No shipping address provided.
                            @endif
                        </div>
                    </div>
                </div>

                <div class="section-title">Items to Fulfill</div>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="product-name">{{ $item->product_name }}</td>
                            <td style="text-align: center;">{{ $item->qty }}</td>
                            <td style="text-align: right; font-weight: 600;">₹{{ number_format($item->price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="summary-wrapper">
                    <div class="summary-row">
                        <div class="summary-cell summary-label">Subtotal</div>
                        <div class="summary-cell summary-value">₹{{ number_format($order->sub_total, 2) }}</div>
                    </div>
                    @if($order->shipping_amount > 0)
                    <div class="summary-row">
                        <div class="summary-cell summary-label">Shipping</div>
                        <div class="summary-cell summary-value">₹{{ number_format($order->shipping_amount, 2) }}</div>
                    </div>
                    @endif
                    <div class="summary-row">
                        <div class="summary-cell summary-label">Tax Total</div>
                        <div class="summary-cell summary-value">₹{{ number_format($order->tax_amount, 2) }}</div>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="summary-row">
                        <div class="summary-cell summary-label" style="color: #ef4444;">Discount applied</div>
                        <div class="summary-cell summary-value" style="color: #ef4444;">-₹{{ number_format($order->discount_amount, 2) }}</div>
                    </div>
                    @endif
                    <div class="summary-row total-row">
                        <div class="summary-cell summary-label total-label">Grand Total</div>
                        <div class="summary-cell summary-value total-value">₹{{ number_format($order->amount, 2) }}</div>
                    </div>
                </div>
            </div>
            
            <div class="footer">
                <p>&copy; {{ date('Y') }} iPaymnt Tech. All rights reserved.</p>
                <p>This is an automated notification. Please log in to your vendor dashboard to process this order.</p>
            </div>
        </div>
    </div>
</body>
</html>
