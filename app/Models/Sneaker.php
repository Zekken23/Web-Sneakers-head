<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sneaker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'price',
        'stock',
        'description',
        'image', // <--- WAJIB ADA. Kalau ini ga ada, data ga akan masuk DB.
    ];
}
