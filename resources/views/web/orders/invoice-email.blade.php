<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->invoice_number }}</title>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; color: #1e293b; max-width: 600px; margin: 0 auto; padding: 20px;">

    <div style="background: #0d1756; color: white; padding: 24px; border-radius: 8px 8px 0 0;">
        <h1 style="margin: 0; font-size: 20px;">Invoice {{ $order->invoice_number }}</h1>
        <p style="margin: 4px 0 0; color: #94a3b8; font-size: 12px;">MiniCommerce Store</p>
    </div>

    <div style="background: #fdf8f0; padding: 20px 24px; border: 1px solid #e5e0d8;">
        <p style="margin: 0 0 16px;">Hi <strong>{{ $order->user->name }}</strong>,</p>
        <p style="margin: 0 0 16px; color: #64748b;">Thank you for your order! Here is your invoice summary:</p>

        <div style="background: white; border-radius: 6px; padding: 16px; margin-bottom: 16px;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #e2e8f0;">
                        <th style="text-align: left; padding: 6px 0; font-size: 11px; color: #64748b; text-transform: uppercase;">Item</th>
                        <th style="text-align: center; padding: 6px 0; font-size: 11px; color: #64748b; text-transform: uppercase;">Qty</th>
                        <th style="text-align: right; padding: 6px 0; font-size: 11px; color: #64748b; text-transform: uppercase;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 8px 0;">{{ $item->product?->name ?? 'Product Deleted' }}</td>
                            <td style="text-align: center; padding: 8px 0;">{{ $item->quantity }}</td>
                            <td style="text-align: right; padding: 8px 0; font-weight: bold;">{{ $item->formatted_subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="text-align: right; font-size: 18px; font-weight: bold; color: #0d1756;">
            Total: {{ $order->formatted_total }}
        </div>

        <div style="margin-top: 16px; font-size: 12px; color: #64748b;">
            <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
        </div>
    </div>

    <div style="text-align: center; padding: 20px; color: #94a3b8; font-size: 12px;">
        <p>Questions? Reply to this email or contact hello@miniecommerce.com</p>
        <p style="margin-top: 8px;">&copy; {{ date('Y') }} MiniCommerce. All rights reserved.</p>
    </div>

</body>
</html>
