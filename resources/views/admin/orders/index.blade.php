@extends('admin.layout')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Manajemen Pesanan</h1>
            <p class="text-gray-600 mt-2">Kelola pesanan pelanggan dan pantau status pengiriman</p>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6 p-6">
            <form method="GET" class="flex gap-4 flex-wrap">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" placeholder="Cari nama, nomor HP, atau alamat..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                    Cari
                </button>
                @if (request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}"
                        class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($orders->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID Pesanan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Penerima</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nomor HP</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->recipient_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $order->recipient_phone }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                                    Rp{{ number_format($order->grand_total, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span
                                        class="px-3 py-1 rounded-full text-white text-xs font-semibold
                                    {{ $order->status === 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $order->status === 'diproses' ? 'bg-blue-500' : '' }}
                                    {{ $order->status === 'dikirim' ? 'bg-indigo-500' : '' }}
                                    {{ $order->status === 'selesai' ? 'bg-green-500' : '' }}
                                    {{ $order->status === 'tertunda' ? 'bg-red-500' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="text-blue-500 hover:text-blue-700 font-semibold">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="p-8 text-center text-gray-600">
                    <p class="text-lg">Tidak ada pesanan yang ditemukan.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
