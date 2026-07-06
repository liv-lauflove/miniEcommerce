<?php

namespace App\Patterns\Observer;

use App\Models\Order;

interface Observer
{
    public function update(Order $order, string $action, string $oldStatus, string $newStatus, int $adminId): void;
}
