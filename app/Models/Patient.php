<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'mobile',
        'gender',
        'age',
        'dob',
        'blood_group',
        'address',
        'email',
        'user_id',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'patient_id', 'id');
    }
}
