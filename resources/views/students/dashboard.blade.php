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

    <!-- Grades Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Grade Report</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Actions:</div>
                    <a class="dropdown-item" href="#" onclick="window.print()">
                        <i class="fas fa-print fa-sm fa-fw mr-2 text-gray-400"></i>Print Report
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-download fa-sm fa-fw mr-2 text-gray-400"></i>Download PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="gradesDashboard" width="100%" cellspacing="0">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject</th>
                            <th>Midterm</th>
                            <th>Final</th>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#gradesDashboard').DataTable({
            "order": [[4, "desc"]], // Sort by average grade by default
            "pageLength": 10,
            "language": {
                "emptyTable": "No grades available"
            }
        });
    });
</script>
@endpush
@endsection