<x-layouts.admin title="Order {{ $order->invoice_number }}">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-xl font-bold text-oxford-900">Order {{ $order->invoice_number }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Items --}}
            <div class="card p-6">
                <h2 class="font-semibold text-oxford-900 mb-4">Order Items</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4 items-center">
                            <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->product?->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-oxford-900">{{ $item->product?->name ?? 'Product Deleted' }}</p>
                                <p class="text-sm body-text">{{ $item->quantity }} × {{ $item->formatted_unit_price }}</p>
                            </div>
                            <p class="font-semibold text-oxford-900">{{ $item->formatted_subtotal }}</p>
                        </div>
                    @endforeach
                </div>
                <hr class="my-4 border-gray-100">
                <div class="text-right">
                    <p class="text-lg font-bold text-oxford-900">Total: {{ $order->formatted_total }}</p>
                </div>
            </div>

            {{-- Customer & Address --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card p-6">
                    <h2 class="font-semibold text-oxford-900 mb-3">Customer</h2>
                    <p class="font-medium text-oxford-900">{{ $order->user->name }}</p>
                    <p class="text-sm body-text">{{ $order->user->email }}</p>
                </div>
                <div class="card p-6">
                    <h2 class="font-semibold text-oxford-900 mb-3">Shipping Address</h2>
                    <p class="text-sm body-text">{{ $order->shipping_address }}</p>
                </div>
            </div>
        </div>

        {{-- Status & Actions --}}
        <div>
            <div class="card p-6 space-y-4 sticky top-6">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-oxford-900">Status</h2>
                    <span class="badge-{{ $order->status->color() }}">{{ $order->status->label() }}</span>
                </div>

                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}" class="space-y-3">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="form-select">
                        @foreach(\App\Enums\OrderStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ $order->status->value == $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary w-full btn-sm">Update Status</button>
                </form>

                <hr class="border-gray-100">

                <div class="space-y-2 text-sm body-text">
                    <p><span class="font-medium text-oxford-900">Payment:</span> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><span class="font-medium text-oxford-900">Date:</span> {{ $order->created_at->format('M d, Y H:i') }}</p>
                    <p><span class="font-medium text-oxford-900">Items:</span> {{ $order->items->count() }}</p>
                </div>

                @if($order->notes)
                    <div>
                        <p class="text-sm font-medium text-oxford-900 mb-1">Notes</p>
                        <p class="text-sm body-text">{{ $order->notes }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
