<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relasi: Satu Brand punya banyak Sneaker
    public function sneakers()
    {
        return $this->hasMany(Sneaker::class);
    }
}
