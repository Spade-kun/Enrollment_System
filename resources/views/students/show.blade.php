@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Details</h1>
        <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-graduate mr-2"></i>Student Information
                    </h6>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-edit fa-sm"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Email</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->email }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Year Level</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->year_level }} Year</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Course</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student->course }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Status</div>
                            <div class="h5 mb-0">
                                <span class="badge badge-{{ $student->status === 'active' ? 'success' : 'danger' }} px-2">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection