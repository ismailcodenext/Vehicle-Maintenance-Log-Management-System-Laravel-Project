<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'img_url',
        'specialization',
        'degree',
        'hospital',
        'chamber_address',
        'mobile',
        'registration_number',
        // Assuming 'user_id' is the foreign key for the doctor's user
        'user_id',
    ];
}
