<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table="price";
    protected $fillable =['id_product', 'price', 'id', 'old'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'discount_price', 'id_price', 'id_discount');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
