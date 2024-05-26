<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_code',
        'test_name',
        'department',
        'price',
        'commission',
        'status',
        'test_category_id',
        'user_id',
    ];

    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class);
    }

}
