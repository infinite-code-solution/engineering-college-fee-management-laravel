<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeStructure extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = ['fee_structure_name', 'course_id', 'academic_year', 'tuition_fee', 'jntu_common_service_fee', 'exam_fee', 'library_fee'];
}
