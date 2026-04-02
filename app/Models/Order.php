<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'status',
        'total_amount',
        'shipping_address',
        'phone',
        'payment_method',
        'notes',
        'invoice_date',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
            'total_amount' => 'decimal:2',
            'invoice_date' => 'datetime',
            'due_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return $this->status->color();
    }

    public function getNextStatusAttribute(): ?OrderStatus
    {
        return $this->status->next();
    }

    public static function generateInvoiceNumber(): string
    {
        $prefix = 'INV-' . date('Ymd');
        $lastOrder = self::whereDate('created_at', today())->latest('id')->first();
        $sequence = $lastOrder ? ((int) substr($lastOrder->invoice_number, -4)) + 1 : 1;
        return $prefix . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}
