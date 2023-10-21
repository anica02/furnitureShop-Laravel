<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =['id_user', 'address', 'quantity', 'total','payment_type', 'delivery_method'];



    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
