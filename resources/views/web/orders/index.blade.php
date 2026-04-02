<x-layouts.web title="My Orders">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl md:text-3xl font-bold text-chocolate-600 mb-8">My Orders</h1>

        @if($orders->isEmpty())
            <div class="card p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <h3 class="font-semibold text-chocolate-600 text-lg mb-2">No orders yet</h3>
                <p class="body-text mb-6">Start shopping to see your orders here.</p>
                <a href="{{ route('shop') }}" class="btn-primary inline-flex">Start Shopping</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="card p-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                            <div>
                                <div class="flex items-center gap-3 flex-wrap">
                                    <span class="font-semibold text-chocolate-600">{{ $order->invoice_number }}</span>
                                    <span class="badge-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                                </div>
                                <p class="text-sm body-text mt-1">{{ $order->created_at->format('M d, Y \a\t H:i') }} · {{ $order->items->count() }} item(s)</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-chocolate-600">{{ $order->formatted_total }}</p>
                                <p class="text-sm body-text">Payment: {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                            </div>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn-secondary btn-sm">View Details</a>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-layouts.web>
