<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Enrollment;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            // Find the user with student role and 'not_added_as_student' status
            $user = \App\Models\User::where('email', $validated['email'])
                ->where('role', 'student')
                ->where('status', 'not_added_as_student')
                ->first();

            if (!$user) {
                return redirect()->route('students.index')->with('error', 'Student not found or already added.');
            }

            // Create a new student record using the user's details
            Student::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'age' => $user->age,
                'year_level' => $request->year_level,
                'course' => $request->course,
            ]);

            // Update the user's status in the users table
            $user->update(['status' => 'added_as_student']);

            return redirect()->route('students.index')->with('success', 'Student added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'An error occurred while adding the student: ' . $e->getMessage());
        }
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        try {
            $validated = $request->validated();

            // Update the student record
            $student->update($validated);

            // Also update the corresponding user record
            $user = \App\Models\User::where('email', $student->email)->first();
            if ($user) {
                $user->update([
                    'name' => $validated['name'],
                    'year_level' => $validated['year_level'],
                    'course' => $validated['course'],
                ]);
            }

            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'An error occurred while updating the student: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        // Check if student has any enrollments
        $hasEnrollments = \App\Models\Enrollment::where('student_id', $student->id)->exists();

        if ($hasEnrollments) {
            return redirect()->route('students.index')
                ->with('error', 'Cannot delete student. Student has active enrollments.');
        }

        // Find the corresponding user based on email
        $user = \App\Models\User::where('email', $student->email)->first();

        if ($user) {
            // Update the user's status to "not_added_as_student"
            $user->update(['status' => 'not_added_as_student']);
        }

        // Delete the student record
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
    
}
