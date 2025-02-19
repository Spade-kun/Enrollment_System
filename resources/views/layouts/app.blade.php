<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white min-vh-100 p-3" style="width: 250px;">
            <h4 class="text-center mb-4">Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('students.index') }}">Manage Students</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('subjects.index') }}">Manage Subjects</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('enrollments.index') }}">Manage Enrollments</a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link text-white" href="{{ route('grades.index') }}">Manage Grades</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4 bg-light">
            @isset($header)
                <header class="bg-white shadow mb-4">
                    <div class="container py-3">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentsTable, #subjectsTable, #enrollmentsTable, #gradesTable, #usersTable, #gradesDashboard').DataTable();
        });
    </script>
</body>
</html>
