<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'artisan_id',
        'images',           // ← ✅ لازم تكون موجودة
        'is_visible',
        'sales_count',
    ];

    protected $casts = [
        'images' => 'array',           // ← ✅ الأهم
        'is_visible' => 'boolean',
    ];

    public function artisan()
    {
        return $this->belongsTo(User::class, 'artisan_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}