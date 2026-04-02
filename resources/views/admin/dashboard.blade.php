<x-layouts.admin title="Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm body-text mb-1">Total Products</p>
                    <p class="text-2xl font-bold text-oxford-900">{{ $stats['total_products'] }}</p>
                </div>
                <div class="w-12 h-12 bg-oxford-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-oxford-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm body-text mb-1">Total Orders</p>
                    <p class="text-2xl font-bold text-oxford-900">{{ $stats['total_orders'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm body-text mb-1">Customers</p>
                    <p class="text-2xl font-bold text-oxford-900">{{ $stats['total_customers'] }}</p>
                </div>
                <div class="w-12 h-12 bg-tan-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-tan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
        </div>
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm body-text mb-1">Revenue</p>
                    <p class="text-2xl font-bold text-oxford-900">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Orders --}}
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-oxford-900">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-oxford-600 hover:text-oxford-700 font-medium">View All</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($stats['recent_orders'] as $order)
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="flex items-center justify-between px-6 py-3 hover:bg-gray-50 transition-colors">
                        <div>
                            <p class="font-medium text-oxford-900 text-sm">{{ $order->invoice_number }}</p>
                            <p class="text-xs body-text">{{ $order->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="badge-{{ $order->status->color() }} text-xs">{{ $order->status->label() }}</span>
                            <p class="text-xs font-medium text-oxford-900 mt-1">{{ $order->formatted_total }}</p>
                        </div>
                    </a>
                @empty
                    <p class="px-6 py-8 text-center body-text text-sm">No orders yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Top Products --}}
        <div class="card">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-oxford-900">Top Products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs text-oxford-600 hover:text-oxford-700 font-medium">View All</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($stats['top_products'] as $product)
                    <div class="flex items-center gap-3 px-6 py-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-oxford-900 text-sm line-clamp-1">{{ $product->name }}</p>
                            <p class="text-xs body-text">{{ $product->order_items_count }} sold</p>
                        </div>
                        <p class="text-sm font-semibold text-oxford-900">{{ $product->formatted_price }}</p>
                    </div>
                @empty
                    <p class="px-6 py-8 text-center body-text text-sm">No products yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.admin>
