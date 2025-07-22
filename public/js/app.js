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

    // Appointment date (tomorrow and onward, no weekends)
    flatpickr("#appointmentstartdate", {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1), // tomorrow
        disable: [
            function(date) {
                // Disable weekends
                return (date.getDay() === 0 || date.getDay() === 6); // Sunday = 0, Saturday = 6
            }
        ],
        altInput: true,
        altFormat: "F j, Y",
        allowInput: true
    });
});

// Paddy Show: Pagination hash and scroll logic
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        // Add hash to drying paginator links
        document.querySelectorAll('.drying-pagination a.page-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!link.hash || link.hash === '#') {
                    e.preventDefault();
                    window.location = link.href + '#drying-history';
                }
            });
        });
        // Add hash to milling paginator links
        document.querySelectorAll('.milling-pagination a.page-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                if (!link.hash || link.hash === '#') {
                    e.preventDefault();
                    window.location = link.href + '#milling-history';
                }
            });
        });

        // Scroll to the correct section if hash is present
        if (window.location.hash === '#drying-history' || window.location.hash === '#milling-history') {
            var el = document.getElementById(window.location.hash.substring(1));
            if (el) {
                setTimeout(function() {
                    var yOffset = -80;
                    var y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({ top: y, behavior: 'smooth' });
                }, 300);
            }
        }
    });
})();