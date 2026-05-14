@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Detail Pesanan #{{ $order->id }}</h1>
                <p class="text-gray-600 mt-2">{{ $order->created_at->format('d F Y H:i') }}</p>
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                ← Kembali
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Status Section -->
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Status Pesanan</h2>
                    <span
                        class="inline-block px-4 py-2 rounded-full text-white font-semibold
                    {{ $order->status === 'pending' ? 'bg-yellow-500' : '' }}
                    {{ $order->status === 'diproses' ? 'bg-blue-500' : '' }}
                    {{ $order->status === 'dikirim' ? 'bg-indigo-500' : '' }}
                    {{ $order->status === 'selesai' ? 'bg-green-500' : '' }}
                    {{ $order->status === 'tertunda' ? 'bg-red-500' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="space-x-2">
                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition font-semibold">
                                Terima Pesanan
                            </button>
                        </form>
                    @endif

                    <button onclick="openStatusModal()"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-semibold">
                        Ubah Status
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-6">
            <!-- Penerima -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Data Penerima</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm">Nama</p>
                        <p class="text-gray-900 font-semibold">{{ $order->recipient_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Nomor HP</p>
                        <p class="text-gray-900 font-semibold">{{ $order->recipient_phone }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Metode Pembayaran</p>
                        <p class="text-gray-900 font-semibold">{{ ucfirst($order->payment_method) }}</p>
                    </div>
                </div>
            </div>

            <!-- Pengiriman -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Data Pengiriman</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm">Alamat</p>
                        <p class="text-gray-900 font-semibold">{{ $order->address_note }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Jarak (Km)</p>
                        <p class="text-gray-900 font-semibold">{{ $order->distance_km }} km</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Lokasi</p>
                        <p class="text-gray-900 font-semibold">
                            <a href="https://maps.google.com/?q={{ $order->latitude }},{{ $order->longitude }}"
                                target="_blank"
                                class="text-blue-500 hover:text-blue-700 underline">
                                {{ $order->latitude }}, {{ $order->longitude }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Daftar Barang (Picking List)</h3>
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Kuantitas</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <strong>{{ $item->product->name }}</strong>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700">
                                Rp{{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 text-center">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <div class="space-y-2 text-right">
                <div class="flex justify-end gap-4">
                    <span class="text-gray-600">Subtotal:</span>
                    <span class="font-semibold">Rp{{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-end gap-4">
                    <span class="text-gray-600">Ongkos Kirim:</span>
                    <span class="font-semibold">Rp{{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-end gap-4 pt-2 border-t-2 border-gray-300">
                    <span class="text-gray-900 font-bold">Total:</span>
                    <span class="text-xl font-bold text-gray-900">Rp{{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Riwayat Aktivitas</h3>
            @if ($activityLogs->count() > 0)
                <div class="space-y-4">
                    @foreach ($activityLogs as $log)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between mb-1">
                                <p class="font-semibold text-gray-900">
                                    {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                </p>
                                <p class="text-sm text-gray-600">{{ $log->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <p class="text-gray-700">{{ $log->description }}</p>
                            @if ($log->old_status && $log->new_status)
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ ucfirst($log->old_status) }} → {{ ucfirst($log->new_status) }}
                                </p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">Belum ada aktivitas.</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Ubah Status -->
<div id="statusModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-96">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Ubah Status Pesanan</h2>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Status Baru</label>
                <select name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Status</option>
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="tertunda" {{ $order->status === 'tertunda' ? 'selected' : '' }}>Tertunda</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 justify-end">
                <button type="button" onclick="closeStatusModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Ubah Status
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openStatusModal() {
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    document.getElementById('statusModal').addEventListener('click', function (e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });
</script>
@endsection
