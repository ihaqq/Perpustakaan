// Enhanced Dashboard JavaScript
class Dashboard {
    constructor() {
        this.sidebar = document.querySelector(".sidebar");
        this.sidebarToggle = document.getElementById("sidebar-toggle");
        this.menuToggles = document.querySelectorAll(".menu-toggle");

        this.initializeEventListeners();
        this.initializeChart();
        
        // Memanggil fungsi fetch data dinamis saat inisialisasi
        this.fetchDashboardData();
    }

    initializeEventListeners() {
        // Sidebar toggle
        this.sidebarToggle.addEventListener("click", () => {
            this.sidebar.classList.toggle("collapsed");
            this.savePreference(
                "sidebarCollapsed",
                this.sidebar.classList.contains("collapsed"),
            );
        });

        // Menu toggles
        this.menuToggles.forEach((toggle) => {
            toggle.addEventListener("click", (e) => {
                e.preventDefault();
                this.toggleSubmenu(toggle);
            });
        });

        // Load saved preferences
        this.loadPreferences();

        // Add smooth scrolling to view more links
        document.querySelectorAll(".view-more").forEach((link) => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                this.animateClick(link);
            });
        });
    }

    toggleSubmenu(toggle) {
        const submenu = toggle.nextElementSibling;
        const parentLi = toggle.parentElement;

        if (parentLi.classList.contains("active")) {
            submenu.style.display = "none";
            parentLi.classList.remove("active");
        } else {
            // Close other submenus
            document
                .querySelectorAll(".sidebar nav ul .submenu")
                .forEach((otherSubmenu) => {
                    otherSubmenu.style.display = "none";
                    otherSubmenu.parentElement.classList.remove("active");
                });

            // Open clicked submenu
            submenu.style.display = "block";
            parentLi.classList.add("active");
        }
    }

    initializeChart() {
        const ctx = document.getElementById("bookChart").getContext("2d");

        // Enhanced chart with better styling
        this.bookChart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: ["Buku di pinjam", "Buku di rak"],
                datasets: [
                    {
                        data: [11, 19], // Data statis sementara
                        backgroundColor: ["#5c6ac4", "#e9ecef"],
                        borderWidth: 0,
                        hoverOffset: 8,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 20,
                            usePointStyle: false, 
                            font: {
                                size: 12,
                                weight: "500",
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        borderColor: "#5c6ac4",
                        borderWidth: 1,
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce(
                                    (a, b) => a + b,
                                    0,
                                );
                                const percentage = (
                                    (context.parsed / total) *
                                    100
                                ).toFixed(1);
                                return `${context.label}: ${context.parsed} (${percentage}%)`;
                            },
                        },
                    },
                },
                animation: {
                    animateRotate: true,
                    duration: 2000,
                },
            },
        });
    }

    // FUNGSI BARU: Mengambil data dari API
    async fetchDashboardData() {
        try {
            // Promise.all digunakan untuk mengambil semua endpoint secara bersamaan
            // Sesuaikan URL dengan prefix route Anda (misal: '/api/books/total' jika menggunakan api.php)
            const [totalBooksReq, totalAnggotaReq, latestBooksReq, latestAnggotaReq] = await Promise.all([
                fetch('api/books/total'),
                fetch('api/anggota/total'),
                fetch('api/books?per_page=3'),
                fetch('api/anggota?status=Approved&per_page=4')
            ]);

            // Konversi response ke JSON
            const totalBooks = await totalBooksReq.json();
            const totalAnggota = await totalAnggotaReq.json();
            const latestBooks = await latestBooksReq.json();
            const latestAnggota = await latestAnggotaReq.json();

            // Panggil fungsi untuk mengisi tabel dengan response data yang benar
            // Kolom disesuaikan dengan key dari response JSON Anda
            this.populateTable("memberTableBody", latestAnggota.data.anggota, [
                "nama", 
                "kelas", 
                "kategori" // Menggunakan 'kategori' untuk merepresentasikan 'Role'
            ]);
            
            this.populateTable("bookTableBody", latestBooks.data.books, [
                "judul_buku", 
                "pengarang", 
                "stok_tersedia" // Menampilkan stok yang tersedia saat ini
            ]);

            // Eksekusi animasi counter angka dengan data dinamis
            this.animateCounters(totalAnggota.data.total, totalBooks.data.total);

        } catch (error) {
            console.error("Gagal melakukan fetching data dashboard:", error);
            // Opsional: Tampilkan notifikasi toast/alert ke user di sini
        }
    }

    populateTable(tableId, data, columns) {
        const tableBody = document.getElementById(tableId);
        tableBody.innerHTML = "";

        if(data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="${columns.length + 1}" style="text-align:center;">Tidak ada data</td></tr>`;
            return;
        }

        data.forEach((item, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                        <td>${index + 1}</td>
                        ${columns.map((col) => `<td>${item[col] || '-'}</td>`).join("")}
                    `;

            // Add stagger animation
            row.style.opacity = "0";
            row.style.transform = "translateY(20px)";
            tableBody.appendChild(row);

            setTimeout(() => {
                row.style.transition = "all 0.5s ease";
                row.style.opacity = "1";
                row.style.transform = "translateY(0)";
            }, index * 100);
        });
    }

    // Menerima parameter dinamis
    animateCounters(totalAnggota, totalBooks) {
        const counters = [
            { id: "member-count", target: totalAnggota },
            { id: "book-count", target: totalBooks },
            { id: "loan-count", target: 23 },     // Ganti dengan data asli jika endpoint sudah ada
            { id: "return-count", target: 12 },   // Ganti dengan data asli jika endpoint sudah ada
            { id: "total-inventory", target: totalBooks },
            { id: "books-borrowed", target: 11 },  // Ganti dengan data asli jika endpoint sudah ada
            { id: "books-available", target: 19 }, // Ganti dengan data asli jika endpoint sudah ada
        ];

        counters.forEach((counter) => {
            this.animateCounter(counter.id, counter.target);
        });
    }

    animateCounter(elementId, target) {
        const element = document.getElementById(elementId);
        if (!element) return;

        // Cegah pembagian dengan 0 atau data tidak valid
        if(!target || target === 0) {
            element.textContent = 0;
            return;
        }

        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 20);
    }

    animateClick(element) {
        element.style.transform = "scale(0.95)";
        setTimeout(() => {
            element.style.transform = "scale(1)";
        }, 150);
    }

    savePreference(key, value) {
        localStorage.setItem(`dashboard_${key}`, JSON.stringify(value));
    }

    loadPreferences() {
        const sidebarCollapsed = JSON.parse(
            localStorage.getItem("dashboard_sidebarCollapsed"),
        );
        if (sidebarCollapsed) {
            this.sidebar.classList.add("collapsed");
        }
    }

    updateStats(newStats) {
        Object.keys(newStats).forEach((key) => {
            const element = document.getElementById(key);
            if (element) {
                this.animateCounter(key, newStats[key]);
            }
        });

        if (newStats["books-borrowed"] || newStats["books-available"]) {
            this.bookChart.data.datasets[0].data = [
                newStats["books-borrowed"] || 11,
                newStats["books-available"] || 19,
            ];
            this.bookChart.update();
        }
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    window.dashboard = new Dashboard();
});

// Add some interactive features
document.addEventListener("DOMContentLoaded", () => {
    // Add ripple effect to cards
    document.querySelectorAll(".stat-card, .card").forEach((card) => {
        card.addEventListener("click", function (e) {
            const ripple = document.createElement("span");
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + "px";
            ripple.style.left = x + "px";
            ripple.style.top = y + "px";
            ripple.classList.add("ripple");

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});