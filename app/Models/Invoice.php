<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_reg',
        'invoice_date',
        'subtotal',
        'discount_ap',
        'discount_amount',
        'payment_status',
        'payment_method',
        'paid_amount',
        'due_amount',
        'pc_discount',
        'referred_by_doctor',
        'pc_reference_name',
        'report_delivery_date',
        'report_delivery_time',
        'patient_id',
        'doctor_id',
        'pc_id',
        'user_id'
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function invoiceDetails()
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id', 'id');
    }

}
