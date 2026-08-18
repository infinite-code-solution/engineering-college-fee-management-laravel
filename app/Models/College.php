<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model {
    use HasFactory;
    protected $fillable = ['code', 'name', 'location'];

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
