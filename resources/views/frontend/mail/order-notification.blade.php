<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Order Received</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Order Received!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $store->name }},</p>
            <p>You have received a new order on {{ config('app.name') }}. Here are the details:</p>
            
            <div class="order-info">
                <p><strong>Order Id:</strong> {{ $order->code }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                <p><strong>Status:</strong> New Order ({{ ucfirst($order->status) }})</p>
                <p><strong>Payment Mode:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment?->payment_channel ?? 'N/A')) }}</p>
                <p><strong>Payment Status:</strong> {{ ucfirst($order->payment?->status ?? 'pending') }}</p>
            </div>

            @php
                $shippingAddress = $order->address->where('type', 'shipping')->first();
                $customer = $order->user;
            @endphp

            <h3>Customer Information:</h3>
            <div class="order-info" style="background: #fff; border: 1px solid #eee;">
                <p><strong>Name:</strong> {{ $shippingAddress->name ?? ($customer->name ?? 'N/A') }}</p>
                <p><strong>Email:</strong> {{ $shippingAddress->email ?? ($customer->email ?? 'N/A') }}</p>
                <p><strong>Phone:</strong> {{ $shippingAddress->phone ?? ($customer->phone ?? 'N/A') }}</p>
            </div>

            @if($shippingAddress)
            <h3>Shipping Address:</h3>
            <div class="order-info" style="background: #fff; border: 1px solid #eee;">
                <p>{{ $shippingAddress->address }}, {{ $shippingAddress->city }}, {{ $shippingAddress->state }} @if($shippingAddress->zip_code) - {{ $shippingAddress->zip_code }} @endif, {{ $shippingAddress->country }}</p>
            </div>
            @endif

            <h3>Items Summary:</h3>
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

            <p class="total" style="text-align: right; margin-top: 20px;">
                Grand Total: ₹{{ number_format($order->amount, 2) }}
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
