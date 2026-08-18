<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    use HasFactory;
    protected $fillable = ['college_id', 'name', 'branch_code'];

    public function feeStructures() {
        return $this->hasMany(FeeStructure::class);
    }
}
