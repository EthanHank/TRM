// Sidebar Toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    if (sidebarToggle && sidebar && mainContent) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Active Menu Item
        document.querySelectorAll('.sidebar-menu .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.sidebar-menu .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Responsive Sidebar
        function checkWidth() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }
        }

        window.addEventListener('resize', checkWidth);
        checkWidth();
    }
});

// Flatpickr
document.addEventListener("DOMContentLoaded", function() {
    const today = new Date();
    const eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    const oneHundredYearsAgo = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());

    flatpickr("#dateofbirth", {
        dateFormat: "Y-m-d",
        maxDate: eighteenYearsAgo,
        minDate: oneHundredYearsAgo,
        altInput: true,
        altFormat: "F j, Y",
        allowInput: true
    });
});