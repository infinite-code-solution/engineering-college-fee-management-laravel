<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class FeeStructure extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_name',
        'roll_number',
        'fee_type',
        'total_amount',
        'amount_paid',
        'balance_amount',
        'status',
        'due_date'
    ];

    // Automatically calculate balance and status when data updates
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($fee) {
            // Balance logic
            $fee->balance_amount = $fee->total_amount - $fee->amount_paid;

            // Status allocation logic
            if ($fee->amount_paid >= $fee->total_amount) {
                $fee->status = 'Paid';
            } elseif ($fee->amount_paid > 0 && $fee->amount_paid < $fee->total_amount) {
                $fee->status = 'Partial';
            } else {
                $fee->status = 'Unpaid';
            }
        });
    }
}
