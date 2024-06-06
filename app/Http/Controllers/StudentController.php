<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Enrollment;
use Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $enrollments = Enrollment::where('student_id', Auth::id())->with('subject')->get();
        return view('student.dashboard', compact('enrollments'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $subjects = Subject::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('student.dashboard', compact('subjects', 'query'));
    }

    public function addSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Enrollment::create([
            'subject_id' => $request->subject_id,
            'student_id' => Auth::id(),
        ]);

        return redirect()->route('student.dashboard');
    }

    public function removeSubject($id)
    {
        $enrollment = Enrollment::where('subject_id', $id)
            ->where('student_id', Auth::id())
            ->first();

        if ($enrollment) {
            $enrollment->delete();
        }

        return redirect()->route('student.dashboard');
    }

    public function finalizeEnrollment()
    {
        // Assuming there's a 'finalized' column to mark the enrollment as finalized
        $enrollments = Enrollment::where('student_id', Auth::id())->get();
        foreach ($enrollments as $enrollment) {
            $enrollment->update(['finalized' => true]);
        }

        return redirect()->route('student.dashboard');
    }
}
