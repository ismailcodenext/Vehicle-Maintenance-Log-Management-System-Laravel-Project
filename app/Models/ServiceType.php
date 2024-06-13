<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'service_interval',
        'service_description',
        'service_provider_id',
        'user_id'
    ];

    // Define the relationship with ServiceProvider
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function maintenanceRecords()
    {
        return $this->hasMany(MaintenanceRecord::class);
    }
}
