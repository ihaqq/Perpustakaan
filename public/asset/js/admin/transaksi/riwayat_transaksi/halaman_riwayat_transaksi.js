
const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});

navLinksWithSubmenu.forEach(link => {
    link.addEventListener('click', (e) => {
        const submenu = link.nextElementSibling;
        const parentLi = link.parentElement;

        if (submenu) {
            e.preventDefault();
            if (parentLi.classList.contains('active')) {
                submenu.style.display = 'none';
                parentLi.classList.remove('active');
            } else {
                document.querySelectorAll('.sidebar nav ul .submenu').forEach(otherSubmenu => {
                    otherSubmenu.style.display = 'none';
                    otherSubmenu.parentElement.classList.remove('active');
                });
                submenu.style.display = 'block';
                parentLi.classList.add('active');
            }
        }
    });
});

const searchInput = document.getElementById('searchInput');
const filterButtons = document.querySelectorAll('.filter-button');
const tableRows = document.querySelectorAll('#riwayatTable tbody tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const activeStatusButton = document.querySelector('.filter-button.active');
        const statusFilter = activeStatusButton.getAttribute('data-status-filter');

         tableRows.forEach(row => {
            const rowContent = row.textContent.toLowerCase();
            const rowStatus = row.getAttribute('data-status');

             const statusMatch = (statusFilter === 'Semua Status' || rowStatus === statusFilter);
            const searchMatch = rowContent.includes(searchTerm);

             if (statusMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

     searchInput.addEventListener('input', filterTable);

     filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            filterTable();
        });
    });