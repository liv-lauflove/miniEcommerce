<?php

namespace App\Http\Services\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of user's orders.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        // Memastikan user hanya bisa lihat order miliknya sendiri
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Tidak diizinkan mengakses pesanan ini.');
        }

        $order->load('orderItems.product');

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Get status badge color and label
     */
    public static function getStatusBadge($status)
    {
        $badges = [
            'pending' => [
                'color' => 'bg-gray-100 text-gray-800',
                'label' => 'Menunggu Konfirmasi'
            ],
            'diproses' => [
                'color' => 'bg-blue-100 text-blue-800',
                'label' => 'Sedang Diproses'
            ],
            'dikirim' => [
                'color' => 'bg-yellow-100 text-yellow-800',
                'label' => 'Sedang Dikirim'
            ],
            'selesai' => [
                'color' => 'bg-green-100 text-green-800',
                'label' => 'Selesai'
            ],
            'tertunda' => [
                'color' => 'bg-orange-100 text-orange-800',
                'label' => 'Tertunda'
            ],
            'dibatalkan' => [
                'color' => 'bg-red-100 text-red-800',
                'label' => 'Dibatalkan'
            ],
        ];

        return $badges[$status] ?? $badges['pending'];
    }
}
