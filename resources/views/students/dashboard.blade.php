@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
        <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user fa-sm text-white-50"></i> {{ Auth::user()->name }}
        </span>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Average Grade Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Overall Average</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($grades->avg('average'), 2) ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Subjects Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Enrolled Subjects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grades->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Semester Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Current Semester</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $grades->last()->semester ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Report Card</h>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="gradesTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Midterm Grade</th>
                            <th>Final Grade</th>
                            <th>Average</th>
                            <th>Semester</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $grade->subject?->code ?? 'N/A' }}</td>
                                <td>{{ $grade->subject?->name ?? 'N/A' }}</td>
                                <td class="{{ $grade->midterm <= 3.00 ? 'text-success' : 'text-danger' }}">
                                    {{ $grade->midterm ?? 'N/A' }}
                                </td>
                                <td class="{{ $grade->final <= 3.00 ? 'text-success' : 'text-danger' }}">
                                    {{ $grade->final ?? 'N/A' }}
                                </td>
                                <td class="{{ $grade->average <= 3.00 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $grade->average ?? 'N/A' }}
                                </td>
                                <td>{{ $grade->semester ?? 'N/A' }}</td>
                                <td class="{{ $grade->us_grade <= 3.00 ? 'text-danger' : 'text-success' }}">
                                    {{ $grade->us_grade ?? 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection