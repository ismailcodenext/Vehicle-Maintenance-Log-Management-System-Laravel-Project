<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function drivers(): BelongsToMany
    {
        return $this->belongsToMany(Driver::class)->using(VehicleAssignedToDriver::class);
    }
}
