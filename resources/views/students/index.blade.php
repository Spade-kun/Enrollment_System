@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Students Management</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Add New Student</span>
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

    <!-- Error Message -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Students Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Students List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="studentsTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->course }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>{{ $student->latest_semester }}</td>
                            <td>{{ $student->latest_school_year }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('students.show', $student) }}" 
                                       class="btn btn-info btn-sm" 
                                       data-toggle="tooltip" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('students.edit', $student) }}" 
                                       class="btn btn-warning btn-sm"
                                       data-toggle="tooltip" 
                                       title="Edit Student">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('students.destroy', $student) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this student?')"
                                                data-toggle="tooltip" 
                                                title="Delete Student">
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
        $('#studentsTable').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 10,
            "responsive": true,
            "language": {
                "search": "Search students:",
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