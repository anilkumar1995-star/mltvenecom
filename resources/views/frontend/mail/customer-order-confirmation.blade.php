<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation - {{ $order->code }}</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .header { background: #1a73e8; color: #fff; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .order-info { background: #f9f9f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .footer { text-align: center; padding: 10px; font-size: 12px; color: #777; background: #eee; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #eee; }
        th { background-color: #f4f4f4; }
        .total { font-weight: bold; font-size: 1.2em; color: #1a73e8; }
        .btn { display: inline-block; padding: 10px 20px; background: #1a73e8; color: #fff !important; text-decoration: none; border-radius: 5px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmed!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $order->address->where('type', 'shipping')->first()->name ?? 'Customer' }},</p>
            <p>Thank you for shopping with us! Your order <strong>#{{ $order->code }}</strong> has been placed successfully.</p>
            
            <div class="order-info">
                <p><strong>Order Summary:</strong></p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment?->payment_channel ?? 'N/A')) }}</p>
            </div>

            <h3>Items Ordered:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->price * $item->qty, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="text-align: right; margin-top: 20px;">
                <p><strong>Subtotal:</strong> ₹{{ number_format($order->sub_total, 2) }}</p>
                @if($order->discount_amount > 0)
                <p><strong>Discount:</strong> -₹{{ number_format($order->discount_amount, 2) }}</p>
                @endif
                @if($order->tax_amount > 0)
                <p><strong>Tax:</strong> ₹{{ number_format($order->tax_amount, 2) }}</p>
                @endif
                <p class="total">Grand Total: ₹{{ number_format($order->amount, 2) }}</p>
            </div>

            <div style="margin-top: 30px; text-align: center;">
                <p>Need help? Feel free to contact our support team.</p>
                <a href="{{ route('frontend.orders.tracking') }}" class="btn">Track Your Order</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
