const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');
const ctxLine = document.getElementById("lineChart").getContext("2d");

// =========== Sidebar & Navbar Logic ===========
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

new Chart(ctxLine, {
    type: "line",
    data: {
        labels: ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
        datasets: [
            {
                label: "Peminjaman",
                data: [12, 19, 15, 25, 22, 10],
                borderColor: "#5c6ac4",
                backgroundColor: "rgba(92, 106, 196, 0.1)",
                fill: true,
                tension: 0.4,
            },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
    },
});

const ctxPie = document.getElementById("pieChart").getContext("2d");
new Chart(ctxPie, {
    type: "doughnut",
    data: {
        labels: ["Fiksi", "Teknologi", "Sains", "Sejarah"],
        datasets: [
            {
                data: [40, 25, 20, 15],
                backgroundColor: ["#5c6ac4", "#45aaf2", "#2ecc71", "#f1c40f"],
                borderWidth: 0,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: { legend: { position: "bottom" } },
    },
});
