<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin_user';
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'user_type',
        'password',
        'image',
        'gstin',
        'status'
    ];
    public $timestamps = false;
}
