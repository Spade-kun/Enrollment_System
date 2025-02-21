@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Enrollments Management</h1>
        <a href="{{ route('enrollments.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Add New Enrollment</span>
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

    <!-- Enrollments Table Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Enrollments List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="enrollmentsTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Subject Name</th>
                            <th>Semester</th>
                            <th>School Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->subject->name }}</td>
                            <td>{{ $enrollment->semester }}</td>
                            <td>{{ $enrollment->school_year }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('enrollments.show', $enrollment) }}" 
                                       class="btn btn-info btn-sm"
                                       data-toggle="tooltip" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('enrollments.edit', $enrollment) }}" 
                                       class="btn btn-warning btn-sm"
                                       data-toggle="tooltip" 
                                       title="Edit Enrollment">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('enrollments.destroy', $enrollment) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this enrollment?')"
                                                data-toggle="tooltip" 
                                                title="Delete Enrollment">
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
        $('#enrollmentsTable').DataTable({
            "order": [[0, "desc"]],
            "pageLength": 10,
            "responsive": true,
            "language": {
                "search": "Search enrollments:",
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