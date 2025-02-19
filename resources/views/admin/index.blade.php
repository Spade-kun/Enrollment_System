@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Students Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Student::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Subjects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Subject::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Active Enrollments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Enrollment::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Grades</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Grade::count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('students.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus fa-sm mr-2"></i>Add New Student
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('subjects.create') }}" class="btn btn-success btn-block">
                                <i class="fas fa-book-medical fa-sm mr-2"></i>Add New Subject
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('enrollments.create') }}" class="btn btn-info btn-block">
                                <i class="fas fa-user-plus fa-sm mr-2"></i>New Enrollment
                            </a>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <a href="{{ route('grades.create') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-plus fa-sm mr-2"></i>Add Grades
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activities</h6>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach(App\Models\Enrollment::latest()->take(5)->get() as $enrollment)
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">New Enrollment</h6>
                                <small>{{ $enrollment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">Student enrolled in {{ $enrollment->subject->name ?? 'a subject' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection