<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city_id',
        'area',
        'block',
        'street',
        'avenue',
        'house',
        'floor',
        'apartment'
    ];
}
