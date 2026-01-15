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
        'invoice_name',
        'invoice_address',
        'invoice_phone',
        'invoice_nit',
        'invoice_zip_code',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
