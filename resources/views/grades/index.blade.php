@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Report Card Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Report Card</h1>
        <span class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user fa-sm text-white-50"></i> {{ Auth::user()->name }}
        </span>
    </div>

    <!-- Student Information -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Student Information</h5>
            <p class="card-text"><strong>Name:</strong> {{ Auth::user()->name }}</p>
            <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="card-text"><strong>Year Level:</strong> {{ Auth::user()->year_level }}</p>
            <p class="card-text"><strong>Course:</strong> {{ Auth::user()->course }}</p>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Grades</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                                <td class="{{ $grade->midterm < 75 ? 'text-danger' : 'text-success' }}">
                                    {{ $grade->midterm ?? 'N/A' }}
                                </td>
                                <td class="{{ $grade->final < 75 ? 'text-danger' : 'text-success' }}">
                                    {{ $grade->final ?? 'N/A' }}
                                </td>
                                <td class="{{ $grade->average < 75 ? 'text-danger' : 'text-success' }} font-weight-bold">
                                    {{ $grade->average ?? 'N/A' }}
                                </td>
                                <td>{{ $grade->semester ?? 'N/A' }}</td>
                                <td>{{ $grade->us_grade ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection