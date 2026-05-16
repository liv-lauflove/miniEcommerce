@extends('customer.layout')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-black text-slate-900 mb-2">Riwayat Pesanan</h1>
        <p class="text-slate-500">Lihat semua pesanan Anda dan status pengirimannya</p>
    </div>

    @if($orders->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.66V6.75a2.25 2.25 0 00-2.25 2.25v12.75c0 1.24 1.01 2.25 2.25 2.25h13.5c1.24 0 2.25-1.01 2.25-2.25V8.75c0-.227-.035-.45-.1-.66m-5.8 0A2.251 2.251 0 0013.5 2.25H12a2.25 2.25 0 00-1.5.75m0 0A2.251 2.251 0 0012 2.25h1.5m0 0A2.25 2.25 0 0115.75 3.75M15 6.75a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0m-3-2.25a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0M6.75 6.75a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0M6.75 9m0 0a.75.75 0 00-1.5 0m0 0a.75.75 0 01-1.5 0m1.5 0a.75.75 0 001.5 0" />
                </svg>
            </div>
            <p class="text-slate-600 text-lg font-semibold mb-4">Belum ada pesanan</p>
            <p class="text-slate-500 mb-6">Anda belum melakukan pesanan. Mari mulai berbelanja!</p>
            <a href="{{ route('home') }}" class="inline-flex rounded-xl bg-emerald-600 px-6 py-3 font-bold text-white hover:bg-emerald-700 transition">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-4">
            @forelse($orders as $order)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-slate-100">
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                            <div>
                                <p class="text-sm text-slate-500 font-semibold">Order ID</p>
                                <p class="text-lg font-black text-slate-900">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-semibold mb-2">Status</p>
                                @php
                                    $statusInfo = \App\Http\Services\User\OrderController::getStatusBadge($order->status);
                                @endphp
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold {{ $statusInfo['color'] }}">
                                    {{ $statusInfo['label'] }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4 pb-4 border-b border-slate-100">
                            <div>
                                <p class="text-sm text-slate-500 font-semibold">Tanggal</p>
                                <p class="text-slate-900 font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-semibold">Jumlah Item</p>
                                <p class="text-slate-900 font-semibold">{{ $order->orderItems->count() }} item</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-semibold">Total</p>
                                <p class="text-lg font-black text-emerald-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('user.orders.show', $order) }}" class="flex-1 inline-flex justify-center rounded-xl bg-slate-100 px-4 py-3 font-bold text-slate-900 hover:bg-slate-200 transition">
                                Lihat Detail
                            </a>
                            <a href="{{ route('categories.index') }}" class="flex-1 inline-flex justify-center rounded-xl bg-emerald-600 px-4 py-3 font-bold text-white hover:bg-emerald-700 transition">
                                Belanja Lagi
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                    <p class="text-slate-600">Tidak ada pesanan</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
