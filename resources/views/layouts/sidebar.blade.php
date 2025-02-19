<div class="h-screen w-64 bg-white shadow-md fixed top-0 left-0 flex flex-col z-50">
    <div class="p-4 text-xl font-bold text-gray-800 border-b">
        Dashboard
    </div>
    <nav class="flex-1 overflow-y-auto">
        <ul class="space-y-2 p-4">
            
            <li>
                <a href="{{ route('students.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 
                   {{ request()->routeIs('students.index') ? 'bg-gray-200 font-semibold' : '' }}">
                    🎓 Students
                </a>
            </li>
            <li>
                <a href="{{ route('subjects.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 
                   {{ request()->routeIs('subjects.index') ? 'bg-gray-200 font-semibold' : '' }}">
                    📚 Subjects
                </a>
            </li>
            <li>
                <a href="{{ route('enrollments.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 
                   {{ request()->routeIs('enrollments.index') ? 'bg-gray-200 font-semibold' : '' }}">
                    📝 Enrollments
                </a>
            </li>
            <li>
                <a href="{{ route('grades.index') }}" 
                   class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 
                   {{ request()->routeIs('grades.index') ? 'bg-gray-200 font-semibold' : '' }}">
                    🎯 Grades
                </a>
            </li>
        </ul>
    </nav>
</div>
