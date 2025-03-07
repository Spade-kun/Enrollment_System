@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Subject Details</h1>
        <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-2"></i>Back to List
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

    <div class="row">
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-book mr-2"></i>Subject Information
                    </h6>
                    <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-edit fa-sm"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Subject Code</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subject->code }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-gray-600 small font-weight-bold mb-1">Units</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subject->units }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="text-gray-600 small font-weight-bold mb-1">Subject Name</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subject->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection