<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    public function prices()
    {
        return $this->belongsToMany(Price::class, 'discount_price', 'id_discount', 'id_price');
    }
}
