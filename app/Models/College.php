<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'college_name',
        'college_code',
        'college_email',
        'college_mobile',
        'college_website',
        'college_address',
        'college_logo',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
