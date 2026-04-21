<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image_url',
    ];

    // Relasi: Produk ini milik satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Produk ini bisa ada di banyak OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}