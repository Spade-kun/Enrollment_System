@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Student</h1>
        <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    <!-- Error Message -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-gray-600">Student ID</label>
                                    <input type="text" class="form-control" value="{{ $student->id }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-gray-600">Email</label>
                                    <input type="email" class="form-control" value="{{ $student->email }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-gray-600">Year Level</label>
                                    <select name="year_level" class="form-control" required>
                                        <option value="" disabled>Select Year Level</option>
                                        @for ($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ $student->year_level == $i ? 'selected' : '' }}>
                                                {{ $i }}st Year
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold text-gray-600">Course</label>
                                    <select name="course" class="form-control" required>
                                        <option value="" disabled>Select Course</option>
                                        @foreach(['BSIT', 'BSCS', 'BSCE', 'BSEd', 'BSBA'] as $course)
                                            <option value="{{ $course }}" {{ $student->course == $course ? 'selected' : '' }}>
                                                {{ $course }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save fa-sm mr-2"></i>Update Student
                            </button>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary ml-2">
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