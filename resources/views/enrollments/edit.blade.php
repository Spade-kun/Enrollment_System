@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Enrollment</h1>
        <a href="{{ route('enrollments.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit mr-2"></i>Enrollment Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Student</label>
                            <select name="student_id" class="form-control" required>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Subject</label>
                            <select name="subject_id" class="form-control" required>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $enrollment->subject_id == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Semester</label>
                            <select name="semester" class="form-control" required>
                                <option value="1st" {{ $enrollment->semester == '1st' ? 'selected' : '' }}>1st Semester</option>
                                <option value="2nd" {{ $enrollment->semester == '2nd' ? 'selected' : '' }}>2nd Semester</option>
                            </select>
                            @error('semester') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">School Year</label>
                            <input type="text" name="school_year" class="form-control" value="{{ $enrollment->school_year }}" required>
                            @error('school_year') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save fa-sm mr-2"></i>Update Enrollment
                            </button>
                            <a href="{{ route('enrollments.index') }}" class="btn btn-secondary ml-2">
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