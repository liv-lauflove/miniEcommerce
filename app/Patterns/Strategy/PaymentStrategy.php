<?php

namespace App\Patterns\Strategy;

use App\Models\Order;

interface PaymentStrategy
{
    public function process(Order $order): void;

    public function getMethodName(): string;
}
