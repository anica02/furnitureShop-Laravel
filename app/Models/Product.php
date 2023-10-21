<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ["name", "img_src", "img_alt", "status", "id_color", "id_category", "id_material"];
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function price()
    {
        return $this->belongsTo(Price::class);

    }

    public function material()
    {
        return $this->belongsTo(Material::class);

    }


}
