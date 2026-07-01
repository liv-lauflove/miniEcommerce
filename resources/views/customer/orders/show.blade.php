@extends('customer.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8 flex items-start justify-between gap-4">
        <div>
            <a href="{{ route('user.orders.index') }}" class="text-emerald-600 font-bold hover:text-emerald-700 mb-2 inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-black text-slate-900">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
        </div>
    </div>

    <!-- Order Status Timeline -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-6 border border-slate-100">
        <h2 class="text-lg font-black text-slate-900 mb-6">Status Pesanan</h2>
        
        <div class="space-y-4">
            @php
                $statuses = [
                    'pending' => ['label' => 'Menunggu Konfirmasi', 'icon' => '⏳'],
                    'diproses' => ['label' => 'Sedang Diproses', 'icon' => '⚙️'],
                    'dikirim' => ['label' => 'Sedang Dikirim', 'icon' => '🚚'],
                    'selesai' => ['label' => 'Selesai', 'icon' => '✅'],
                    'tertunda' => ['label' => 'Tertunda', 'icon' => '⏸️'],
                    'dibatalkan' => ['label' => 'Dibatalkan', 'icon' => '❌'],
                ];
                
                $orderStatuses = ['pending', 'diproses', 'dikirim', 'selesai'];
                $statusPosition = array_search($order->status, $orderStatuses);
                if ($order->status === 'tertunda' || $order->status === 'dibatalkan') {
                    $statusPosition = -1;
                }
            @endphp

            <div class="relative">
                @foreach($orderStatuses as $index => $status)
                    @php
                        $statusInfo = \App\Http\Services\User\OrderController::getStatusBadge($status);
                        $isActive = $index <= $statusPosition;
                        $isCurrent = $index === $statusPosition;
                    @endphp
                    
                    <div class="flex gap-4 items-start {{ !$loop->last ? 'mb-8' : '' }}">
                        <!-- Circle -->
                        <div class="flex-shrink-0 mt-0.5">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm
                                @if($isActive)
                                    bg-emerald-600 text-white
                                @else
                                    bg-slate-200 text-slate-600
                                @endif
                            ">
                                {{ $index + 1 }}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <p class="font-bold {{ $isActive ? 'text-slate-900' : 'text-slate-500' }}">
                                {{ $statuses[$status]['label'] }}
                            </p>
                            <p class="text-sm text-slate-500">
                                @if($order->status === $status)
                                    Status saat ini
                                @else
                                    Menunggu...
                                @endif
                            </p>
                        </div>

                        <!-- Line -->
                        @if(!$loop->last)
                            <div class="absolute left-4 top-10 h-8 w-0.5 {{ $isActive ? 'bg-emerald-600' : 'bg-slate-200' }}"></div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($order->status === 'tertunda' || $order->status === 'dibatalkan')
                <div class="mt-6 p-4 rounded-xl {{ $order->status === 'tertunda' ? 'bg-orange-50 border border-orange-200' : 'bg-red-50 border border-red-200' }}">
                    <p class="font-bold {{ $order->status === 'tertunda' ? 'text-orange-900' : 'text-red-900' }}">
                        @if($order->status === 'tertunda')
                            Pesanan Anda tertunda
                        @else
                            Pesanan Anda dibatalkan
                        @endif
                    </p>
                    <p class="text-sm {{ $order->status === 'tertunda' ? 'text-orange-700' : 'text-red-700' }} mt-2">
                        @if($order->status === 'tertunda')
                            Hubungi toko untuk informasi lebih lanjut tentang pesanan Anda.
                        @else
                            Pesanan ini telah dibatalkan. Silakan hubungi toko jika ada pertanyaan.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Pengiriman -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
            <h3 class="font-black text-slate-900 mb-4">Informasi Pengiriman</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-slate-500 font-semibold">Penerima</p>
                    <p class="text-slate-900 font-semibold">{{ $order->recipient_name }}</p>
                </div>
                <div>
                    <p class="text-slate-500 font-semibold">No. HP</p>
                    <p class="text-slate-900 font-semibold">{{ $order->recipient_phone }}</p>
                </div>
                <div>
                    <p class="text-slate-500 font-semibold">Alamat</p>
                    <p class="text-slate-900 font-semibold">{{ $order->address_note ?: '-' }}</p>
                </div>
                @if($order->distance_km)
                    <div>
                        <p class="text-slate-500 font-semibold">Jarak</p>
                        <p class="text-slate-900 font-semibold">{{ $order->distance_km }} km</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
            <h3 class="font-black text-slate-900 mb-4">Informasi Pembayaran</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-slate-500 font-semibold">Metode Pembayaran</p>
                    <p class="text-slate-900 font-semibold">
                        @if($order->payment_method === 'transfer')
                            Transfer Bank
                        @elseif($order->payment_method === 'cod')
                            Bayar di Tempat (COD)
                        @else
                            {{ $order->payment_method }}
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-slate-500 font-semibold">Tanggal Pesanan</p>
                    <p class="text-slate-900 font-semibold">{{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Items -->
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 mb-6">
        <h3 class="font-black text-slate-900 mb-6">Item Pesanan</h3>
        
        <div class="space-y-4">
            @foreach($order->orderItems as $item)
                <div class="flex gap-4 pb-4 border-b border-slate-100 last:border-0 last:pb-0">
                    <!-- Product Image -->
                    <div class="flex-shrink-0">
                        @if($item->product->image)
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="h-24 w-24 object-cover rounded-xl">
                        @else
                            <div class="h-24 w-24 rounded-xl bg-slate-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-9-4.5h.008v.008h-.008V8.25m0 4h.008v.008h-.008V12.25m0 4h.008v.008h-.008V16.25m-12-2h.008v.008h-.008v-.008m0 4h.008v.008h-.008v-.008m0 4h.008v.008h-.008v-.008m12-6h.008v.008h-.008v-.008m0 4h.008v.008h-.008v-.008m0 4h.008v.008h-.008v-.008" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1">
                        <h4 class="font-bold text-slate-900 mb-1">{{ $item->product->name }}</h4>
                        <p class="text-sm text-slate-500 mb-3">{{ $item->product->category->name ?? 'Kategori tidak ada' }}</p>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-900">
                                Qty: <span class="font-black">{{ $item->quantity }}</span>
                            </p>
                            <p class="text-right">
                                <p class="text-xs text-slate-500">Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</p>
                                <p class="font-black text-emerald-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Total -->
    <div class="bg-gradient-to-r from-emerald-50 to-green-50 rounded-2xl shadow-sm p-6 border border-emerald-200 mb-6">
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-slate-600 font-semibold">Subtotal</span>
                <span class="text-slate-900 font-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-600 font-semibold">Biaya Pengiriman</span>
                <span class="text-slate-900 font-bold">Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
            </div>
            <div class="h-px bg-emerald-200"></div>
            <div class="flex justify-between items-center pt-2">
                <span class="text-lg font-black text-slate-900">Total</span>
                <span class="text-2xl font-black text-emerald-600">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4">
        <a href="{{ route('user.orders.index') }}" class="flex-1 inline-flex justify-center rounded-xl bg-slate-100 px-6 py-3 font-bold text-slate-900 hover:bg-slate-200 transition">
            Kembali ke Riwayat
        </a>
        <a href="{{ route('home') }}" class="flex-1 inline-flex justify-center rounded-xl bg-emerald-600 px-6 py-3 font-bold text-white hover:bg-emerald-700 transition">
            Belanja Lagi
        </a>
    </div>
</div>
@endsection
