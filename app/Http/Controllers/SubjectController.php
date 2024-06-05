<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $request->input('query');

        if ($query) {
            $subjects = Subject::where('name', 'LIKE', "%{$query}%")
                                ->orWhere('description', 'LIKE', "%{$query}%")
                                ->get();
        } else {
            $subjects = Subject::all();
        }

        return view('subjects.index', compact('subjects', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slots' => 'required|integer',
            'professor_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());
        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $id)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'slots' => 'required|integer',
        ]);

        $subject->update($request->all());
        return redirect()->route('subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index');
    }

    public function viewEnrollments()
    {
        // Get the currently logged-in professor
        $professorId = auth()->id();

        // Get subjects taught by this professor with the count of enrollments
        $subjects = Subject::withCount('enrollments')
            ->where('professor_id', $professorId)
            ->get();

        return view('subjects.enrollments', compact('subjects'));
    }
}
