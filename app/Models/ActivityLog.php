<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'order_id',
        'action',
        'old_status',
        'new_status',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi: Log ini milik satu User (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Relasi: Log ini milik satu Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
