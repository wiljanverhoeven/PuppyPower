<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'totaal_prijs'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

