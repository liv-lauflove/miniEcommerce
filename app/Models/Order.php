<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recipient_name',
        'recipient_phone',
        'address_note',
        'latitude',
        'longitude',
        'distance_km',
        'subtotal',
        'shipping_fee',
        'grand_total',
        'payment_method',
        'status',
    ];

    // Relasi: Pesanan ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Satu Pesanan punya banyak detail item barang
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}