<!DOCTYPE html>
<html>
<head>
    <title>New Order Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>New Order #{{ $order->id }}</h2>
    <p>A new order has been placed.</p>
    
    <h3>Order Details:</h3>
    <ul>
        <li><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</li>
        <li><strong>Captain Name:</strong> {{ $order->captain_name }}</li>
        <li><strong>Vessel Name:</strong> {{ $order->vessel_name ?? 'N/A' }}</li>
        <li><strong>Total:</strong> ${{ number_format($order->total, 2) }}</li>
    </ul>

    <h3>Items:</h3>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Product</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Qty</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Price</th>
                <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->product->name }}</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $item->quantity }}</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">${{ number_format($item->unit_price, 2) }}</td>
                <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px;">
        <a href="{{ route('orders.show', $order->id) }}" style="background-color: #002855; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Order in Dashboard</a>
    </p>
</body>
</html>
