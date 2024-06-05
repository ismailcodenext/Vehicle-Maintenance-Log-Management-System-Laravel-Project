<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecord extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'vehicle_id',
        'date_of_service',
        'mileage_at_service',
        'service_type_id',
        'service_provider_type_id',
        'description_of_service',
        'cost',
        'image_upload',
        'user_id',
    ];

    /**
     * Get the vehicle that owns the maintenance record.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Get the service type associated with the maintenance record.
     */
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    /**
     * Get the service provider type associated with the maintenance record.
     */
    public function serviceProviderType()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    /**
     * Get the user who created the maintenance record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
