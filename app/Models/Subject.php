<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slots', 'professor_id'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function remainingSlots()
    {
        // Calculate total enrolled students
        $enrolledStudents = $this->enrollments()->count();

        // Calculate remaining slots
        $remainingSlots = $this->slots - $enrolledStudents;

        // Ensure remaining slots are not negative
        return max(0, $remainingSlots);
    }
}
