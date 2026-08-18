<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    use HasFactory;
    protected $fillable = ['student_id', 'transaction_id', 'amount_paid', 'payment_mode', 'status', 'remarks'];
}
