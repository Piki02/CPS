<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'captain_name',
        'vessel_name',
        'token',
        'total',
        'status',
        'user_id',
        'discount',
        'discount_percentage',
        'tax',
        'shipping_cost',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
