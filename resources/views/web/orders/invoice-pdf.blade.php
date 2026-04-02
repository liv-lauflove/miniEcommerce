<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->invoice_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #1e293b; line-height: 1.5; }
        .header { background: #0d1756; color: white; padding: 24px; }
        .header-grid { display: table; width: 100%; }
        .header-left, .header-right { display: table-cell; vertical-align: top; }
        .header-right { text-align: right; }
        .invoice-title { font-size: 24px; font-weight: bold; color: white; }
        .invoice-number { color: #cbd5e1; font-size: 12px; }
        .brand { font-size: 18px; font-weight: bold; color: white; }
        .brand-sub { color: #94a3b8; font-size: 10px; }
        .info-section { background: #fdf8f0; padding: 16px 24px; display: table; width: 100%; }
        .info-block { display: table-cell; width: 50%; vertical-align: top; }
        .info-label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; color: #92400e; font-weight: bold; margin-bottom: 4px; }
        .info-value { font-weight: bold; color: #1e293b; }
        .info-detail { color: #64748b; font-size: 11px; margin-top: 2px; }
        .content { padding: 24px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 9px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; padding: 8px 0; border-bottom: 2px solid #e2e8f0; }
        th.right { text-align: right; }
        th.center { text-align: center; }
        td { padding: 12px 0; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
        td.right { text-align: right; }
        td.center { text-align: center; }
        .item-name { font-weight: bold; color: #1e293b; }
        .item-detail { color: #64748b; font-size: 11px; margin-top: 2px; }
        .total-section { padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; }
        .total-table { width: 280px; margin-left: auto; }
        .total-row { display: table; width: 100%; padding: 4px 0; }
        .total-label, .total-value { display: table-cell; }
        .total-label { color: #64748b; }
        .total-value { text-align: right; font-weight: bold; color: #1e293b; }
        .grand-total { font-size: 14px; padding-top: 8px !important; border-top: 2px solid #0d1756; }
        .grand-total .total-label, .grand-total .total-value { color: #0d1756 !important; }
        .footer { padding: 16px 24px; text-align: center; color: #94a3b8; font-size: 10px; border-top: 1px solid #e2e8f0; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 999px; font-size: 10px; font-weight: bold; text-transform: uppercase; }
        .badge-yellow { background: #fef3c7; color: #92400e; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-indigo { background: #e0e7ff; color: #3730a3; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-red { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

{{-- Header --}}
<div class="header">
    <div class="header-grid">
        <div class="header-left">
            <div class="brand">MiniCommerce</div>
            <div class="brand-sub">miniCommerce Store</div>
            <div style="margin-top: 12px; color: #94a3b8; font-size: 11px;">
                hello@miniecommerce.com<br>
                +62 21 1234 5678<br>
                Jl. Sudirman No. 123, Jakarta
            </div>
        </div>
        <div class="header-right">
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-number">{{ $order->invoice_number }}</div>
            <div style="margin-top: 12px; color: #94a3b8; font-size: 11px;">
                <div>Date: {{ $order->invoice_date?->format('M d, Y') ?? $order->created_at->format('M d, Y') }}</div>
                @if($order->due_date)
                    <div>Due: {{ $order->due_date->format('M d, Y') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Bill To --}}
<div class="info-section">
    <div class="info-block">
        <div class="info-label">Bill To</div>
        <div class="info-value">{{ $order->user->name }}</div>
        <div class="info-detail">{{ $order->user->email }}</div>
        <div class="info-detail" style="margin-top: 8px;">{{ $order->shipping_address }}</div>
    </div>
    <div class="info-block">
        <div class="info-label">Status</div>
        <?php
            $colorMap = [
                'yellow' => 'badge-yellow',
                'blue' => 'badge-blue',
                'indigo' => 'badge-indigo',
                'green' => 'badge-green',
                'red' => 'badge-red',
            ];
            $badgeClass = $colorMap[$order->status->color()] ?? 'badge-blue';
        ?>
        <span class="badge {{ $badgeClass }}">{{ $order->status->label() }}</span>
        <div style="margin-top: 8px;">
            <span class="info-label">Payment</span>
            <div class="info-detail">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</div>
        </div>
    </div>
</div>

{{-- Items --}}
<div class="content">
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th class="center">Qty</th>
                <th class="right">Unit Price</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        <div class="item-name">{{ $item->product?->name ?? 'Product Deleted' }}</div>
                    </td>
                    <td class="center">{{ $item->quantity }}</td>
                    <td class="right">{{ $item->formatted_unit_price }}</td>
                    <td class="right" style="font-weight: bold;">{{ $item->formatted_subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Total --}}
<div class="total-section">
    <table class="total-table">
        <tr class="total-row">
            <td class="total-label">Subtotal</td>
            <td class="total-value">{{ $order->formatted_total }}</td>
        </tr>
        <tr class="total-row">
            <td class="total-label">Shipping</td>
            <td class="total-value">Included</td>
        </tr>
        <tr class="total-row grand-total">
            <td class="total-label">Total</td>
            <td class="total-value">{{ $order->formatted_total }}</td>
        </tr>
    </table>
</div>

{{-- Footer --}}
<div class="footer">
    Thank you for your purchase! Questions? Contact hello@miniecommerce.com
</div>

</body>
</html>
