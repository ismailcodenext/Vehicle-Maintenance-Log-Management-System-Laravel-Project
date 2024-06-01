<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_category_id',
        'driver_id',
        'brand',
        'model',
        'year',
        'vin',
        'license_plate',
        'color',
        'mileage',
        'purchase_date',
        'history',
        'status',
        'user_id',
    ];
    // Define relationship with VehicleCategory
    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    // Define relationship with Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
