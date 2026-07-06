<?php

namespace App\Patterns\Strategy;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class CODPayment implements PaymentStrategy
{
    public function process(Order $order): void
    {
        // Logika spesifik untuk COD (misal catat ke sistem kurir internal)
        Log::info("Mempersiapkan pembayaran Cash on Delivery untuk Order ID: {$order->id}");
    }

    public function getMethodName(): string
    {
        return 'cod';
    }
}
