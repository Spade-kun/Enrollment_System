<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enrollment;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnrollmentRequest;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollments = Enrollment::with('student', 'subject')->get();

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('enrollments.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnrollmentRequest $request)
    {
        $validated = $request->validated();

        $student = Student::findOrFail($validated['student_id']);
        $subject = Subject::findOrFail($validated['subject_id']);

        // Prevent duplicate enrollment
        $existingEnrollment = Enrollment::where('student_id', $student->id)
            ->where('subject_id', $subject->id)
            ->where('semester', $validated['semester'])
            ->where('school_year', $validated['school_year'])
            ->first();

        if ($existingEnrollment) {
            return redirect()->route('enrollments.index')->with('error', 'Student is already enrolled in this subject.');
        }

        // Create Enrollment
        Enrollment::create($validated);

        // Verify the subject (Update its status)
        if ($subject->status !== 'verified') {
            $subject->update(['status' => 'verified']);
        }

        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('enrollments.edit', compact('enrollment', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnrollmentRequest $request, Enrollment $enrollment)
    {
        $validated = $request->validated();
        $enrollment->update($validated);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully.');
    }
}
