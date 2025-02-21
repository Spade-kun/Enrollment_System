@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Subject</h1>
        <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
        </a>
    </div>

    <!-- Error Message -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-book mr-2"></i>Subject Information
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('subjects.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Subject Code</label>
                            <input type="text" name="code" class="form-control" value="{{ old('code') }}" required>
                            @error('code') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Subject Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="small font-weight-bold text-gray-600">Units</label>
                            <input type="number" name="units" class="form-control" value="{{ old('units') }}" required>
                            @error('units') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <hr>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus fa-sm mr-2"></i>Add Subject
                            </button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary ml-2">
                                <i class="fas fa-times fa-sm mr-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection