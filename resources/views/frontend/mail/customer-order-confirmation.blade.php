<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - {{ $order->code }}</title>
    <style>
        body { font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #334155; background-color: #f8fafc; margin: 0; padding: 0; }
        .wrapper { width: 100%; background-color: #f8fafc; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .header { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 40px 20px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 28px; font-weight: 800; letter-spacing: -0.025em; }
        .header p { margin: 10px 0 0; opacity: 0.9; font-size: 16px; }
        .content { padding: 40px; }
        .greeting { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 20px; }
        .intro-text { font-size: 16px; margin-bottom: 30px; color: #64748b; }
        
        .card { background-color: #f1f5f9; border-radius: 8px; padding: 20px; margin-bottom: 30px; border-left: 4px solid #0f172a; }
        .order-meta { display: table; width: 100%; }
        .order-meta-item { display: table-cell; width: 33.33%; vertical-align: top; }
        .meta-label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; font-weight: 700; margin-bottom: 4px; }
        .meta-value { font-size: 14px; font-weight: 600; color: #1e293b; }

        .items-title { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 15px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 12px; text-transform: uppercase; color: #94a3b8; padding: 10px 0; border-bottom: 1px solid #e2e8f0; }
        td { padding: 15px 0; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .product-name { font-weight: 600; color: #1e293b; margin: 0; }
        .product-qty { font-size: 13px; color: #64748b; }
        .price-text { font-weight: 600; color: #1e293b; text-align: right; }

        .summary-table { margin-top: 30px; width: 100%; }
        .summary-row td { padding: 5px 0; border: none; font-size: 14px; }
        .summary-label { text-align: right; color: #64748b; padding-right: 20px !important; }
        .summary-value { text-align: right; width: 100px; font-weight: 600; }
        .grand-total { border-top: 2px solid #e2e8f0 !important; padding-top: 15px !important; }
        .grand-total td { font-size: 20px; font-weight: 800; color: #0f172a; }

        .btn-wrapper { text-align: center; margin-top: 40px; }
        .btn { display: inline-block; padding: 14px 32px; background-color: #0f172a; color: #ffffff !important; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 16px; transition: background-color 0.2s; }
        
        .footer { padding: 30px 40px; text-align: center; background-color: #f8fafc; border-top: 1px solid #e2e8f0; }
        .footer p { margin: 0; font-size: 13px; color: #94a3b8; }
        
        @media only screen and (max-width: 600px) {
            .content { padding: 25px; }
            .order-meta-item { display: block; width: 100%; margin-bottom: 15px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1>Order Confirmed!</h1>
                <p>Order #{{ $order->code }}</p>
            </div>
            <div class="content">
                <div class="greeting">Hello {{ $order->address->where('type', 'shipping')->first()->name ?? 'Customer' }},</div>
                <div class="intro-text">
                    Great news! Your order has been placed successfully and is now being processed. We'll send you another email as soon as your items are on the way.
                </div>
                
                <div class="card">
                    <div class="order-meta">
                        <div class="order-meta-item">
                            <div class="meta-label">Order Date</div>
                            <div class="meta-value">{{ $order->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="order-meta-item">
                            <div class="meta-label">Payment Method</div>
                            <div class="meta-value">{{ ucfirst(str_replace('_', ' ', $order->payment?->payment_channel ?? 'COD')) }}</div>
                        </div>
                        <div class="order-meta-item">
                            <div class="meta-label">Status</div>
                            <div class="meta-value" style="color: #10b981;">Confirmed</div>
                        </div>
                    </div>
                </div>

                <div class="items-title">Order Items</div>
                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: right;">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <p class="product-name">{{ $item->product_name }}</p>
                            </td>
                            <td style="text-align: center;" class="product-qty">{{ $item->qty }}</td>
                            <td class="price-text">₹{{ number_format($item->price * $item->qty, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <table class="summary-table">
                    <tr class="summary-row">
                        <td class="summary-label">Subtotal</td>
                        <td class="summary-value">₹{{ number_format($order->sub_total, 2) }}</td>
                    </tr>
                    @if($order->shipping_amount > 0)
                    <tr class="summary-row">
                        <td class="summary-label">Shipping</td>
                        <td class="summary-value">₹{{ number_format($order->shipping_amount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="summary-row">
                        <td class="summary-label">Tax</td>
                        <td class="summary-value">₹{{ number_format($order->tax_amount, 2) }}</td>
                    </tr>
                    @if($order->discount_amount > 0)
                    <tr class="summary-row">
                        <td class="summary-label" style="color: #ef4444;">Discount</td>
                        <td class="summary-value" style="color: #ef4444;">-₹{{ number_format($order->discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="summary-row grand-total">
                        <td class="summary-label">Grand Total</td>
                        <td class="summary-value">₹{{ number_format($order->amount, 2) }}</td>
                    </tr>
                </table>

                <div class="btn-wrapper">
                    <a href="{{ route('frontend.customer.orders') }}" class="btn">View Order Details</a>
                </div>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} iPaymnt Tech. All rights reserved.</p>
                <p style="margin-top: 5px;">Thank you for shopping with us!</p>
            </div>
        </div>
    </div>
</body>
</html>
