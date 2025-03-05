<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with('student', 'subject')->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();

        return view('grades.create', compact('students', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        $validated = $request->validated();

        // Check if student is enrolled in the selected subject and semester
        $enrollment = \DB::table('enrollments')
            ->where('student_id', $validated['student_id'])
            ->where('subject_id', $validated['subject_id'])
            ->where('semester', $validated['semester'])
            ->first();

        if (!$enrollment) {
            return back()->withErrors(['enrollment' => 'The selected student is not enrolled in this subject for the selected semester.']);
        }

        // Check if the subject is verified
        $isVerified = \DB::table('subjects')
            ->where('id', $validated['subject_id'])
            ->where('status', 'verified')
            ->exists();
    
        if (!$isVerified) {
            return back()->withErrors(['subject_id' => 'The selected subject is not verified.']);
        }
    
        // Get all existing grades for the student
        $existingGrades = Grade::where('student_id', $validated['student_id'])->get();
    
        // Calculate semester averages
        $firstSemTotal = $existingGrades->where('semester', '1st')->pluck('average')->avg();
        $secondSemTotal = $existingGrades->where('semester', '2nd')->pluck('average')->avg();
    
        // Create new grade entry
        $grade = new Grade();
        $grade->fill($validated);
    
        // Calculate average if both midterm and final exist
        if (!is_null($grade->midterm) && !is_null($grade->final)) {
            $average = ($grade->midterm + $grade->final) / 2;
            [$numeric_grade, $us_grade] = $this->getGradeDescription($average);
            $grade->average = $average;
            $grade->numeric_grade = $numeric_grade;
            $grade->us_grade = $us_grade;
        } else {
            $grade->average = null;
            $grade->numeric_grade = null;
            $grade->us_grade = null;
        }
    
        // Assign semester total grades correctly
        if ($validated['semester'] === '1st') {
            $grade->{'1st_sem_total_grade'} = $firstSemTotal ?? $grade->average;
            $grade->{'2nd_sem_total_grade'} = $secondSemTotal ?? null;
        } else {
            $grade->{'1st_sem_total_grade'} = $firstSemTotal ?? null;
            $grade->{'2nd_sem_total_grade'} = $secondSemTotal ?? $grade->average;
        }
    
        $grade->save();
    
        // Update the semester totals for all grades for this student without overriding the other semester
        if ($validated['semester'] === '1st') {
            Grade::where('student_id', $validated['student_id'])
                ->update(['1st_sem_total_grade' => $this->calculateSemesterTotal($validated['student_id'], '1st')]);
        } else {
            Grade::where('student_id', $validated['student_id'])
                ->update(['2nd_sem_total_grade' => $this->calculateSemesterTotal($validated['student_id'], '2nd')]);
        }
    
        return redirect()->route('grades.index')->with('success', 'Grade recorded successfully.');
    }
    
    private function calculateSemesterTotal($student_id, $semester)
    {
        $grades = Grade::where('student_id', $student_id)
            ->where('semester', $semester)
            ->whereNotNull('average')
            ->pluck('average');
    
        return $grades->count() > 0 ? $grades->sum() / $grades->count() : null;
    }
    
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grade = Grade::with('student', 'subject')->find($id);

        if (!$grade) {
            return redirect()->route('grades.index')->withErrors(['grade' => 'Grade not found.']);
        }

        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        $students = Student::all();
        $subjects = Subject::all();
        return view('grades.edit', compact('grade', 'students', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade)
    {
        $validated = $request->validated();

        // Handle numeric and special grades
        $midterm = $validated['midterm'];
        $final = $validated['final'];

        // Calculate average only if both grades are numeric
        if (is_numeric($midterm) && is_numeric($final)) {
            $average = (floatval($midterm) + floatval($final)) / 2;
            [$numeric_grade, $us_grade] = $this->getGradeDescription($average);
            
            $grade->average = $average;
            $grade->numeric_grade = $numeric_grade;
            $grade->us_grade = $us_grade;
        } else {
            $grade->average = null;
            $grade->numeric_grade = null;
            $grade->us_grade = null;
        }

        // Update the grade record with validated data
        $grade->update($validated);

        // Update semester totals
        $this->updateSemesterTotal($grade->student_id, $grade->semester);

        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
    }

    private function getGradeDescription($numeric_grade)
    {
        if ($numeric_grade >= 1.00 && $numeric_grade <= 1.24) {
            return [1.00, "Passed"];
        } elseif ($numeric_grade >= 1.25 && $numeric_grade <= 1.49) {
            return [1.25, "Passed"];
        } elseif ($numeric_grade >= 1.50 && $numeric_grade <= 1.74) {
            return [1.50, "Passed"];
        } elseif ($numeric_grade >= 1.75 && $numeric_grade <= 1.99) {
            return [1.75, "Passed"];
        } elseif ($numeric_grade >= 2.00 && $numeric_grade <= 2.24) {
            return [2.00, "Passed"];
        } elseif ($numeric_grade >= 2.25 && $numeric_grade <= 2.49) {
            return [2.25, "Passed",];
        } elseif ($numeric_grade >= 2.50 && $numeric_grade <= 2.74) {
            return [2.50, "Passed"];
        } elseif ($numeric_grade >= 2.75 && $numeric_grade <= 2.99) {
            return [2.75, "Passed"];
        } elseif ($numeric_grade == 3.00) {
            return [3.00, "Pass"];
        } elseif ($numeric_grade > 3.00 && $numeric_grade <= 4.00) {
            return [4.00, "Conditional"];
        } else {
            return [5.00, "Failed"];
        }
    }
    
    private function updateSemesterTotal($student_id, $semester)
    {
        $grades = Grade::where('student_id', $student_id)
            ->where('semester', $semester)
            ->whereNotNull('average')
            ->pluck('average');
    
        if ($grades->count() > 0) {
            $semester_average = $grades->sum() / $grades->count();
        } else {
            $semester_average = null; // No grades available
        }
    
        if ($semester === '1st') {
            Grade::where('student_id', $student_id)
                ->update([
                    '1st_sem_total_grade' => $semester_average,
                    '2nd_sem_total_grade' => null  // Ensure 2nd semester is null
                ]);
        } else {
            Grade::where('student_id', $student_id)
                ->update([
                    '2nd_sem_total_grade' => $semester_average,
                    '1st_sem_total_grade' => null  // Ensure 1st semester is null
                ]);
        }
    }
    

}
