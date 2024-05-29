<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'description',
        'maximum_load_capacity',
        'seating_capacity',
    ];
}
