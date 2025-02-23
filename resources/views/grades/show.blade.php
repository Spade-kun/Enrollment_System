@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Grade Details</h1>
        <a href="{{ route('grades.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

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
                        <i class="fas fa-clipboard-list mr-2"></i>Grade Information
                    </h6>
                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-edit fa-sm"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Student Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->student->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Subject</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->subject->name }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Midterm Grade</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->midterm }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Final Grade</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->final }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Average Grade</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->average }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Grade Description</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->numeric_grade }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">US Grade</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->us_grade }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Semester</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade->semester }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
