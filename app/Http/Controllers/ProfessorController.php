<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Enrollment;
use Auth;

class ProfessorController extends Controller
{
    public function dashboard()
    {
        $subjects = Subject::where('professor_id', auth()->id())->withCount('enrollments')->get();
        return view('professors.dashboard', compact('subjects'));
    }

    public function createSubject()
    {
        return view('professors.create_subject');
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slots' => 'required|integer',
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->slots = $request->slots;
        $subject->professor_id = auth()->id();
        $subject->save();

        return redirect()->route('professor.dashboard')->with('success', 'Subject created successfully.');
    }

    public function viewEnrollments(Subject $subject)
    {
        // Load enrollments for the selected subject
        $enrollments = Enrollment::where('subject_id', $subject->id)->with('student')->get();

        return view('professors.view_enrollments', compact('subject', 'enrollments'));
    }

    public function removeStudent(Enrollment $enrollment)
    {
        // Delete enrollment record
        $enrollment->delete();

        return redirect()->back()->with('success', 'Student removed from subject.');
    }
}
