<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['subject_id', 'student_id'];

    /**
     * Get the subject for the enrollment.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the student (user) for the enrollment.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
