@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Management</h1>
    </div>

    <div class="row">
        <!-- Student Form Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Student</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="text-dark">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="text-dark">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="year_level" class="text-dark">Year Level</label>
                            <select name="year_level" class="form-control" required>
                                <option value="" disabled selected>Select Year Level</option>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }} Year</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course" class="text-dark">Course</label>
                            <select name="course" class="form-control" required>
                                <option value="" disabled selected>Select Course</option>
                                <option value="BSIT">BSIT</option>
                                <option value="BSCS">BSCS</option>
                                <option value="BSCE">BSCE</option>
                                <option value="BSEd">BSEd</option>
                                <option value="BSBA">BSBA</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus fa-sm mr-2"></i>Add Student
                            </button>
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times fa-sm mr-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Students List Card -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Student Accounts</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Year Level</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (\App\Models\User::where('role', 'student')->get() as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->year_level ?? 'N/A' }}</td>
                                        <td>{{ $student->course ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $student->status === 'active' ? 'success' : 'secondary' }}">
                                                {{ $student->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if (\App\Models\User::where('role', 'student')->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No students found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection