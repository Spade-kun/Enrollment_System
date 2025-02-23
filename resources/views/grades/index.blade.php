@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Grades Management</h1>
        <a href="{{ route('grades.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add New Grade</span>
        </a>
    </div>

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

    <!-- Grades Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Grades List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="gradesTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Student</th>
                            <th>Subject</th>
                            <th>Units</th>
                            <th>Midterm</th>
                            <th>Final</th>
                            <th>Semester</th>
                            <th>Average</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $grade->student->name }}</td>
                                <td>{{ $grade->subject->name }}</td>
                                <td>{{ $grade->subject->units }}</td>
                                <td>
                                    @if($grade->midterm === 'INC')
                                        <span class="badge badge-warning">Incomplete</span>
                                    @elseif($grade->midterm === 'D')
                                        <span class="badge badge-danger">Drop</span>
                                    @elseif($grade->midterm === 'FDA')
                                        <span class="badge badge-danger">FDA</span>
                                    @else
                                        <span class="badge badge-info">{{ $grade->midterm ?? 'N/A' }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($grade->final === 'INC')
                                        <span class="badge badge-warning">Incomplete</span>
                                    @elseif($grade->final === 'D')
                                        <span class="badge badge-danger">Drop</span>
                                    @elseif($grade->final === 'FDA')
                                        <span class="badge badge-danger">FDA</span>
                                    @else
                                        <span class="badge badge-info">{{ $grade->final ?? 'N/A' }}</span>
                                    @endif
                                </td>
                                <td>{{ $grade->semester ?? 'N/A' }}</td>
                                <td>
                                    <span class="font-weight-bold">{{ $grade->average ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $grade->us_grade ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('grades.show', $grade->id) }}" 
                                            class="btn btn-info btn-sm"
                                            data-toggle="tooltip" 
                                            title="View Grade">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('grades.edit', $grade) }}" 
                                           class="btn btn-warning btn-sm"
                                           data-toggle="tooltip" 
                                           title="Edit Grade">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('grades.destroy', $grade) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this grade?')"
                                                    data-toggle="tooltip" 
                                                    title="Delete Grade">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
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
        $('#gradesTable').DataTable({
            "order": [[0, "asc"]],
            "pageLength": 10,
            "responsive": true,
            "language": {
                "search": "Search grades:",
                "lengthMenu": "Show _MENU_ entries per page",
            }
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').alert('close');
        }, 5000);
    });
</script>
@endpush
@endsection