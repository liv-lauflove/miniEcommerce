@extends('owner.layout')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-4xl font-bold text-gray-900">Monitoring Penjualan</h1>
        <p class="text-gray-600 mt-2">{{ $label }}</p>
    </div>

    <!-- Period Filter -->
    <div class="flex gap-2">
        <form method="GET" action="{{ route('owner.dashboard') }}" class="flex gap-2">
            @foreach ($periods as $key => $value)
                <button type="submit" name="period" value="{{ $key }}"
                    class="px-4 py-2 rounded-lg font-semibold transition
                    {{ $period === $key ? 'bg-purple-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    {{ $value }}
                </button>
            @endforeach
        </form>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pendapatan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">💰</span>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pesanan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">📦</span>
                </div>
            </div>
        </div>

        <!-- Processed Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pesanan Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $processedOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">✅</span>
                </div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Menunggu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">⏳</span>
                </div>
            </div>
        </div>

        <!-- In Progress Orders -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Sedang Diproses</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $inProgressOrders }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-2xl">🔄</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sales Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Grafik Penjualan</h2>
            <canvas id="salesChart" style="max-height: 300px;"></canvas>
        </div>

        <!-- Top Products -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Top Produk</h2>
            @if ($topProducts->count() > 0)
                <div class="space-y-3">
                    @foreach ($topProducts as $product)
                        <div class="border-b pb-3 last:border-b-0">
                            <div class="flex justify-between mb-1">
                                <p class="font-semibold text-sm text-gray-900">{{ $product->name }}</p>
                                <p class="text-sm font-bold text-purple-600">{{ $product->total_quantity }}x</p>
                            </div>
                            <p class="text-xs text-gray-600">
                                Rp{{ number_format($product->total_sales, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600 text-center py-4">Belum ada data penjualan</p>
            @endif
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">Pesanan Terbaru</h2>
            <a href="{{ route('admin.orders.index') }}"
                class="text-purple-600 hover:text-purple-700 font-semibold text-sm">
                Lihat Semua →
            </a>
        </div>

        @php
            $recentOrders = App\Models\Order::latest()->limit(5)->get();
        @endphp

        @if ($recentOrders->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Penerima</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($recentOrders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-3 text-sm text-gray-700">{{ $order->recipient_name }}</td>
                            <td class="px-6 py-3 text-sm font-semibold text-gray-900">
                                Rp{{ number_format($order->grand_total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-3 text-sm">
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
                            <td class="px-6 py-3 text-sm text-gray-600">
                                {{ $order->created_at->format('d M Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600 text-center py-4">Belum ada pesanan</p>
        @endif
    </div>
</div>

<script>
    // Sales Chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($dailySalesData['labels']),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: @json($dailySalesData['data']),
                borderColor: '#9333ea',
                backgroundColor: 'rgba(147, 51, 234, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#9333ea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
