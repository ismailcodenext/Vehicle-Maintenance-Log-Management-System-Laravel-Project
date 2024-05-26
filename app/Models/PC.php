<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PC extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'nid',
        'address',
        'gender',
        'age',
        'img_url',
        'status',
        'hospital',
        'discount_percentage',
        'user_id'
    ];
}
