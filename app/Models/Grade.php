<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'semester',
        'midterm',
        'final',
        'average',
        'numeric_grade',
        'us_grade',
        '1st_sem_total_grade',
        '2nd_sem_total_grade',
    ];
    
    protected $attributes = [
        'average' => null,
        'numeric_grade' => null,
        'us_grade' => null,
    ];
    
    
    

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }


}
