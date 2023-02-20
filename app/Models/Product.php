<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'fitness_products';
    protected $fillable = [
        'category_id',
        'product_name',
        'product_name_ar',
        'nutrition_id',
        'nutrition_value',
        'meals',
        'snacks',
        'description',
        'description_ar',
        'price',
        'image'
    ];
    public $timestamps = false;
}
