@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enrollment Details</h1>
        <a href="{{ route('enrollments.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clipboard-list mr-2"></i>Enrollment Information
                    </h6>
                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-edit fa-sm"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Student Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment->student->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Subject</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment->subject->name }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Semester</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment->semester }} Semester</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">School Year</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $enrollment->school_year }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection