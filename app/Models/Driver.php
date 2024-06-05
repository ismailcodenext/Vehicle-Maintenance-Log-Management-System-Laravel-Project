<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'license_number',
        'date_of_birth',
        'license_expiry_date',
        'address',
        'medical_clearance_status',
        'driving_history',
        'image',
        'status',
        'user_id'
    ];
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)->using(VehicleAssignedToDriver::class);
    }

}
