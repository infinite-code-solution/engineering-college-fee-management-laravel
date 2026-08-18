<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;
    protected $fillable = ['user_id', 'course_id', 'admission_number', 'current_year', 'current_semester'];
    protected $appends = ['total_fee', 'paid_fee', 'due_fee'];

    public function user() { return $this->belongsTo(User::class); }
    public function course() { return $this->belongsTo(Course::class); }
    public function payments() { return $this->hasMany(Payment::class); }

    public function getTotalFeeAttribute() {
        $structure = FeeStructure::where('course_id', $this->course_id)->first();
        if (!$structure) return 0;
        return $structure->tuition_fee + $structure->jntu_common_service_fee + $structure->exam_fee + $structure->library_fee;
    }

    public function getPaidFeeAttribute() {
        return $this->payments()->where('status', 'completed')->sum('amount_paid');
    }

    public function getDueFeeAttribute() {
        return $this->total_fee - $this->paid_fee;
    }
}
