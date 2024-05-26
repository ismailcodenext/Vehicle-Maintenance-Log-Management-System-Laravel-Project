<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expense_note',
        'amount',
        'date',
        'expenses_categories_id',
        'user_id'
    ];
    public function category()
    {
        return $this->belongsTo(ExpensesCategory::class, 'expenses_categories_id');
    }
}
