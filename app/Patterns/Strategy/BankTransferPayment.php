<?php

namespace App\Patterns\Strategy;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

class BankTransferPayment implements PaymentStrategy
{
    public function process(Order $order): void
    {
        // Logika spesifik untuk transfer bank (misal panggil API payment gateway)
        Log::info("Memproses pembayaran transfer bank untuk Order ID: {$order->id}");
    }

    public function getMethodName(): string
    {
        return 'transfer';
    }
}
