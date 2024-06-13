<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'user_id'
    ];

    // Define the relationship with ServiceType
    public function serviceTypes()
    {
        return $this->hasMany(ServiceType::class);
    }
}
