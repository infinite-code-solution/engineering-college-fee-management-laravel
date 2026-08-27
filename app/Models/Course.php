<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = ['college_id', 'course_name', 'course_code'];

    public function feeStructures() {
        return $this->hasMany(FeeStructure::class);
    }
}
