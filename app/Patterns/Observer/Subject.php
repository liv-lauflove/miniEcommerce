<?php

namespace App\Patterns\Observer;

interface Subject
{
    public function attach(Observer $observer): void;

    public function detach(Observer $observer): void;

    public function notify(string $action, string $oldStatus, string $newStatus, int $adminId): void;
}
