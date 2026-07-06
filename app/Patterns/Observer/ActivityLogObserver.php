<?php

namespace App\Patterns\Observer;

use App\Models\ActivityLog;
use App\Models\Order;
use App\Models\User;

class ActivityLogObserver implements Observer
{
    public function update(Order $order, string $action, string $oldStatus, string $newStatus, int $adminId): void
    {
        $admin = User::find($adminId);
        $adminName = $admin ? $admin->name : 'System';

        $description = match ($action) {
            'accept' => "Pesanan diterima oleh {$adminName}",
            'update_status' => 'Status pesanan diubah dari '.ucfirst($oldStatus).' menjadi '.ucfirst($newStatus)." oleh {$adminName}",
            default => "Aktivitas pesanan oleh {$adminName}",
        };

        ActivityLog::create([
            'admin_id' => $adminId,
            'order_id' => $order->id,
            'action' => $action,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'description' => $description,
        ]);
    }
}
