<?php

namespace App\Patterns\Observer;

use App\Models\Order;

class OrderStatusSubject implements Subject
{
    private array $observers = [];

    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notify(string $action, string $oldStatus, string $newStatus, int $adminId): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->order, $action, $oldStatus, $newStatus, $adminId);
        }
    }
}
