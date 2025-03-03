@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Grade</h1>
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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-edit mr-2"></i>Edit Grade Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('grades.update', $grade) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Hidden fields to ensure required data is submitted -->
                        <input type="hidden" name="student_id" value="{{ $grade->student_id }}">
                        <input type="hidden" name="subject_id" value="{{ $grade->subject_id }}">
                        <input type="hidden" name="semester" value="{{ $grade->semester }}">

                        <!-- Read-only fields -->
                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Student</label>
                            <input type="text" class="form-control bg-light" value="{{ $grade->student->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Subject</label>
                            <input type="text" class="form-control bg-light" value="{{ $grade->subject->name }}" readonly>
                        </div>

                        <!-- Editable fields -->
                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Midterm Grade</label>
                            <select name="midterm" class="form-control" required>
                                @foreach(['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', '4.00', '5.00', 'INC', 'D', 'FDA'] as $value)
                                    <option value="{{ $value }}" {{ $grade->midterm == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('midterm') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Final Grade</label>
                            <select name="final" class="form-control" required>
                                @foreach(['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', '4.00', '5.00', 'INC', 'D', 'FDA'] as $value)
                                    <option value="{{ $value }}" {{ $grade->final == $value ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('final') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save fa-sm mr-2"></i>Update Grade
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