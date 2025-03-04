@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Grade</h1>
        <a href="{{ route('grades.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-graduation-cap mr-2"></i>Grade Form
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('grades.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Student</label>
                            <select name="student_id" class="form-control" required>
                                <option disabled selected value="">Select Student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Subject</label>
                            <select name="subject_id" class="form-control" required>
                                <option disabled selected value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Semester</label>
                            <select name="semester" class="form-control" required>
                                <option disabled selected value="">Select Semester</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                            </select>
                            @error('semester') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Midterm Grade</label>
                            <select name="midterm" class="form-control">
                                <option disabled selected value="">Select Grade</option>
                                @foreach(['1.00' => 'A+', '1.25' => 'A', '1.50' => 'A-', '1.75' => 'B+', 
                                        '2.00' => 'B', '2.25' => 'B-', '2.50' => 'C+', '2.75' => 'C', 
                                        '3.00' => 'C-', '4.00' => 'D - Conditional', '5.00' => 'F - Failed', 
                                        'INC' => 'Incomplete', 'D' => 'Drop', 'FDA' => 'Failure Due to Absence'] as $value => $label)
                                    <option value="{{ $value }}">{{ $value }} ({{ $label }})</option>
                                @endforeach
                            </select>
                            @error('midterm') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Final Grade</label>
                            <select name="final" class="form-control">
                                <option disabled selected value="">Select Grade</option>
                                @foreach(['1.00' => 'A+', '1.25' => 'A', '1.50' => 'A-', '1.75' => 'B+', 
                                        '2.00' => 'B', '2.25' => 'B-', '2.50' => 'C+', '2.75' => 'C', 
                                        '3.00' => 'C-', '4.00' => 'D - Conditional', '5.00' => 'F - Failed', 
                                        'INC' => 'Incomplete', 'D' => 'Drop', 'FDA' => 'Failure Due to Absence'] as $value => $label)
                                    <option value="{{ $value }}">{{ $value }} ({{ $label }})</option>
                                @endforeach
                            </select>
                            @error('final') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus fa-sm mr-2"></i>Add Grade
                            </button>
                            <a href="{{ route('grades.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-times fa-sm mr-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection