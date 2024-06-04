<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicleDocumentRegistration extends Model
{
    Protected $fillable = [
        'user_id',
        'vehicle_id',
        'registration_number',
        'registration_expiry_date',
        'insurance_expiry_date',
        'tax_token_number',
        'tax_token_expiry_date',
        'fitness_certificate_number',
        'fitness_certificate_expiry_date',
        'permit_number',
        'permit_expiry_date',
        'road_worthiness_certificate_number',
        'road_worthiness_certificate_expiry_date',
        'emission_test_certificate_number',
        'emission_test_certificate_expiry_date',
        'note',
        'status',
    ];
}
