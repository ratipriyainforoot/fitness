<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'nutrition_id',
        'nutrition_value_id',
        'price',
        'quantity',
        'dated'
    ];
    public $timestamps = false;
}
