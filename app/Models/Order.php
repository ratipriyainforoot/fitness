<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'nutrition_id',
        'nutrition_value_id',
        'quantity',
        'price',
        'payment_method',
        'dated',
        'note',
        'door_to_door',
        'coupon_id',
        'address_id',
        'transaction_id',
        'payment_status'
    ];
    public $timestamps = false;
}
