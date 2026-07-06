<?php

namespace App\Patterns\Strategy;

use App\Models\Order;

class PaymentContext
{
    private PaymentStrategy $strategy;

    public function setStrategy(PaymentStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function executePayment(Order $order): void
    {
        $this->strategy->process($order);
    }
}
