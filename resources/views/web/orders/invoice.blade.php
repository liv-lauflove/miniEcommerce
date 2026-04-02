<x-layouts.web title="Invoice {{ $order->invoice_number }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header Actions --}}
        <div class="flex items-center justify-between mb-8 no-print">
            <a href="{{ route('orders.show', $order->id) }}" class="text-chocolate-500 hover:text-chocolate-700 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Order
            </a>
            <div class="flex gap-2">
                <a href="{{ route('orders.invoice.download', $order->id) }}" class="btn-secondary btn-sm">
                    Download PDF
                </a>
                <button onclick="window.print()" class="btn-primary btn-sm">
                    Print Invoice
                </button>
            </div>
        </div>

        <div class="card overflow-hidden" id="invoice-content">
            {{-- Invoice Header --}}
            <div class="bg-chocolate-600 text-white px-8 py-8">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
                                <span class="text-chocolate-600 font-bold">TP</span>
                            </div>
                            <div>
                                <h1 class="font-bold text-white text-xl">UD Trisna Putra</h1>
                                <p class="text-chocolate-300 text-sm">Baking Supplies Supplier</p>
                            </div>
                        </div>
                        <p class="text-chocolate-300 text-sm">hello@udtrisnaputra.com</p>
                        <p class="text-chocolate-300 text-sm">(0361) 9004486</p>
                        <p class="text-chocolate-300 text-sm">Dalung Permai Blok WW No.59, Lingkungan Tegal Sari.</p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-3xl font-bold text-white mb-1">INVOICE</h2>
                        <p class="text-chocolate-300">{{ $order->invoice_number }}</p>
                        <div class="mt-4 space-y-1">
                            <p class="text-sm text-chocolate-200">Date: {{ $order->invoice_date?->format('M d, Y') ?? $order->created_at->format('M d, Y') }}</p>
                            @if($order->due_date)
                                <p class="text-sm text-chocolate-200">Due: {{ $order->due_date->format('M d, Y') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bill To --}}
            <div class="px-8 py-6 border-b border-gray-100 bg-cream-50">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-chocolate-600 font-semibold mb-2">Bill To</p>
                        <p class="font-semibold text-chocolate-600">{{ $order->user->name }}</p>
                        <p class="text-sm body-text">{{ $order->user->email }}</p>
                        <p class="text-sm body-text mt-2">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-chocolate-600 font-semibold mb-2">Status</p>
                        <span class="badge-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                        <p class="text-sm body-text mt-2">Payment: {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    </div>
                </div>
            </div>

            {{-- Items Table --}}
            <div class="px-8 py-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="text-left text-xs uppercase tracking-wider text-gray-500 font-semibold pb-3">Item</th>
                            <th class="text-center text-xs uppercase tracking-wider text-gray-500 font-semibold pb-3 w-20">Qty</th>
                            <th class="text-right text-xs uppercase tracking-wider text-gray-500 font-semibold pb-3 w-32">Unit Price</th>
                            <th class="text-right text-xs uppercase tracking-wider text-gray-500 font-semibold pb-3 w-32">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($order->items as $item)
                            <tr class="py-3">
                                <td class="py-3">
                                    <p class="font-medium text-chocolate-600">{{ $item->product?->name ?? 'Product Deleted' }}</p>
                                </td>
                                <td class="py-3 text-center text-gray-600">{{ $item->quantity }}</td>
                                <td class="py-3 text-right text-gray-600">{{ $item->formatted_unit_price }}</td>
                                <td class="py-3 text-right font-medium text-chocolate-600">{{ $item->formatted_subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Total --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                <div class="flex justify-end">
                    <div class="w-64 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="body-text">Subtotal</span>
                            <span class="font-medium text-chocolate-600">{{ $order->formatted_total }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="body-text">Shipping</span>
                            <span class="font-medium text-chocolate-600">Included</span>
                        </div>
                        <hr class="border-gray-200">
                        <div class="flex justify-between text-lg font-bold">
                            <span class="text-chocolate-600">Total</span>
                            <span class="text-chocolate-600">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-4 border-t border-gray-100 text-center">
                <p class="text-xs muted-text">Thank you for your purchase! Questions? Contact hello@udtrisnaputra.com</p>
            </div>
        </div>
    </div>
</x-layouts.web>
