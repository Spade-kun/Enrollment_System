// Initialize DataTables
$(document).ready(function () {
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
    setTimeout(function () {
        $('.alert').alert('close');
    }, 5000);
});


$(document).ready(function () {
    $('#subjectsTable').DataTable({
        responsive: true,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Search Student:"
        }
    });
});

$(document).ready(function () {
    $('#enrollmentsTable').DataTable({
        responsive: true,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Search Student:"
        }
    });
});
