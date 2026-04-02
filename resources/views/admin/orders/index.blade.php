<x-layouts.admin title="Orders">
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-chocolate-600">Pesanan</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $orders->total() }} pesanan ditemukan</p>
        </div>
    </div>

    {{-- Stats Summary --}}
    @php
        $pendingCount = $orders->total() > 0 ? \App\Models\Order::where('status', 'pending')->count() : 0;
    @endphp
    @if($pendingCount > 0)
        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center gap-2 px-4 py-2.5 bg-yellow-50 border border-yellow-200 rounded-xl text-sm">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                <span class="text-yellow-800 font-medium">{{ $pendingCount }} pesanan menunggu diproses</span>
            </div>
        </div>
    @endif

    {{-- Filter Bar --}}
    <div class="flex items-center gap-3 mb-6 flex-wrap">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex items-center gap-2 flex-1 min-w-0">
            <div class="relative flex-1 max-w-xs">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari invoice..."
                       class="form-input pl-10 py-2 text-sm">
            </div>
            <select name="status" class="form-select w-40 py-2 text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="btn-secondary btn-sm whitespace-nowrap">Filter</button>
            @if(request()->has('search') || request()->has('status'))
                <a href="{{ route('admin.orders.index') }}" class="btn-ghost btn-sm text-red-500">Reset</a>
            @endif
        </form>
    </div>

    {{-- Orders Table --}}
    <div class="card overflow-hidden">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Pelanggan</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <span class="font-semibold text-chocolate-600">{{ $order->invoice_number }}</span>
                            </td>
                            <td class="text-gray-700">{{ $order->user->name }}</td>
                            <td>
                                <span class="badge-gray">{{ $order->items->count() }} item</span>
                            </td>
                            <td class="font-semibold text-gray-800">{{ $order->formatted_total }}</td>
                            <td>
                                @php
                                    $statusConfig = [
                                        'pending'    => ['label' => 'Pending',    'color' => 'yellow', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                                        'processing' => ['label' => 'Diproses',   'color' => 'blue',   'bg' => 'bg-blue-100',   'text' => 'text-blue-800'],
                                        'shipped'    => ['label' => 'Dikirim',   'color' => 'indigo', 'bg' => 'bg-indigo-100','text' => 'text-indigo-800'],
                                        'delivered'  => ['label' => 'Selesai',   'color' => 'green',  'bg' => 'bg-green-100',  'text' => 'text-green-800'],
                                        'cancelled'  => ['label' => 'Batal',     'color' => 'gray',   'bg' => 'bg-gray-100',   'text' => 'text-gray-600'],
                                    ];
                                    $cfg = $statusConfig[$order->status->value] ?? ['label' => $order->status->value, 'color' => 'gray', 'bg' => 'bg-gray-100', 'text' => 'text-gray-600'];
                                @endphp
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open"
                                            class="badge {{ $cfg['bg'] }} {{ $cfg['text'] }} cursor-pointer hover:opacity-80 transition-opacity flex items-center gap-1">
                                        {{ $cfg['label'] }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <div x-show="open" @click.away="open = false"
                                         x-transition class="absolute z-20 mt-1 w-44 bg-white border border-gray-200 rounded-xl shadow-lg py-1 text-sm">
                                        @foreach($statusConfig as $value => $config)
                                            <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $value }}">
                                                <button type="submit" @click="open = false"
                                                        class="w-full text-left px-4 py-2 hover:bg-cream-50 transition-colors {{ $order->status->value === $value ? 'font-semibold text-chocolate-600' : 'text-gray-700' }}">
                                                    {{ $config['label'] }}
                                                </button>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="muted-text">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn-icon text-gray-400 hover:text-chocolate-500" title="Detail pesanan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.orders.destroy', $order->id) }}"
                                          class="inline" onsubmit="return confirm('Hapus invoice {{ $order->invoice_number }}? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon text-gray-400 hover:text-red-600" title="Hapus invoice">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <div class="w-14 h-14 bg-cream-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-7 h-7 text-chocolate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 font-medium">Tidak ada pesanan ditemukan</p>
                                    <p class="text-sm text-gray-400 mt-1">Coba ubah filter atau kata kunci pencarian</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $orders->withQueryString()->links() }}
            </div>
        @endif
    </div>

</x-layouts.admin>
