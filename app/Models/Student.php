<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Enrollment;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'age', 'status', 'year_level', 'course'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Get latest enrolled semester
    public function getLatestSemesterAttribute()
    {
        return $this->enrollments()->orderBy('created_at', 'desc')->first()?->semester ?? 'Not Enrolled';
    }

    // Get latest enrolled school year
    public function getLatestSchoolYearAttribute()
    {
        return $this->enrollments()->orderBy('created_at', 'desc')->first()?->school_year ?? 'N/A';
    }

}
