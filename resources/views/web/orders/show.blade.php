<x-layouts.web title="Order {{ $order->invoice_number }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <a href="{{ route('orders.index') }}" class="text-chocolate-500 hover:text-chocolate-700 text-sm">← Orders</a>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-chocolate-600">Order {{ $order->invoice_number }}</h1>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('orders.invoice', $order->id) }}" class="btn-secondary btn-sm">
                    View Invoice
                </a>
                <a href="{{ route('orders.invoice.download', $order->id) }}" class="btn-primary btn-sm">
                    Download PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                {{-- Status & Items --}}
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="font-semibold text-chocolate-600">Order Items</h2>
                        <span class="badge-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                    </div>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex gap-4 items-center">
                                <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item->product?->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-chocolate-600">{{ $item->product?->name ?? 'Product Deleted' }}</p>
                                    <p class="text-sm body-text">{{ $item->quantity }} × {{ $item->formatted_unit_price }}</p>
                                </div>
                                <p class="font-semibold text-chocolate-600">{{ $item->formatted_subtotal }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="card p-6">
                    <h2 class="font-semibold text-chocolate-600 mb-3">Shipping Address</h2>
                    <p class="body-text">{{ $order->shipping_address }}</p>
                </div>

                @if($order->notes)
                    <div class="card p-6">
                        <h2 class="font-semibold text-chocolate-600 mb-3">Order Notes</h2>
                        <p class="body-text">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>

            {{-- Summary --}}
            <div>
                <div class="card p-6 sticky top-24 space-y-4">
                    <h2 class="font-semibold text-chocolate-600">Order Summary</h2>
                    <div class="space-y-2 text-sm">
                        @foreach($order->items as $item)
                            <div class="flex justify-between">
                                <span class="body-text">{{ $item->product?->name ?? 'Deleted' }} × {{ $item->quantity }}</span>
                                <span class="text-chocolate-600">{{ $item->formatted_subtotal }}</span>
                            </div>
                        @endforeach
                        <hr class="border-gray-100">
                        <div class="flex justify-between font-bold text-chocolate-600 pt-1">
                            <span>Total</span>
                            <span>{{ $order->formatted_total }}</span>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <div class="space-y-2 text-sm body-text">
                        <p><span class="font-medium text-chocolate-600">Payment:</span> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                        <p><span class="font-medium text-chocolate-600">Date:</span> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        <p><span class="font-medium text-chocolate-600">Invoice:</span> {{ $order->invoice_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.web>
