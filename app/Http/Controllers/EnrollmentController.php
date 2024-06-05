<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Subject;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('subject')->where('student_id', auth()->id())->get();
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Enrollment::create([
            'subject_id' => $request->subject_id,
            'student_id' => auth()->id(),
        ]);

        return redirect()->route('enrollments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index');
    }
}
