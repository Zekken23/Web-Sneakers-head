<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    // Ganti 'brand' jadi 'brand_id'
    protected $fillable = [
        'name', 'brand_id', 'size', 'price', 'stock', 'description', 'image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
