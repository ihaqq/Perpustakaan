        // Enhanced Dashboard JavaScript
        class Dashboard {
            constructor() {
                this.sidebar = document.querySelector(".sidebar");
                this.sidebarToggle = document.getElementById("sidebar-toggle");
                this.menuToggles = document.querySelectorAll(".menu-toggle");
                
                this.initializeChart();
                this.populateData();
                this.animateCounters();
            }

            initializeChart() {
                const ctx = document.getElementById("bookChart").getContext("2d");
                
                // Enhanced chart with better styling
                this.bookChart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ["Buku di pinjam", "Buku di rak"],
                        datasets: [{
                            data: [500, 734],
                            backgroundColor: [
                                "#5c6ac4",
                                "#e9ecef"
                            ],
                            borderWidth: 0,
                            hoverOffset: 8,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: "bottom",
                                labels: {
                                    padding: 20,
                                    usePointStyle: false, // perintah lingkaran/persegi panjang
                                    font: {
                                        size: 12,
                                        weight: "500"
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: "rgba(0, 0, 0, 0.8)",
                                titleColor: "#fff",
                                bodyColor: "#fff",
                                borderColor: "#5c6ac4",
                                borderWidth: 1,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateRotate: true,
                            duration: 2000
                        }
                    }
                });
            }

            populateData() {
                // Enhanced sample data
                const members = [
                    { nama: "Dinda Permata Sari", kelas: "XII IPA 1", role: "ADMIN" },
                    { nama: "Budi Santoso", kelas: "XI IPS 2", role: "SISWA" },
                    { nama: "Siti Rahayu", kelas: "X MIPA 3", role: "PETUGAS" },
                    { nama: "XIHUY", kelas: "XI MIPA 3", role: "SISWA" },
                    // { nama: "Siti Rahayu", kelas: "X MIPA 3", tanggal: "2024-04-25" },
                ];

                const books = [
                    { judul: "Laskar Pelangi", pengarang: "Andrea Hirata", stok: 10 },
                    { judul: "Filosofi Teras", pengarang: "Henry Manampiring", stok: 5 },
                    { judul: "Atomic Habits", pengarang: "James Clear", stok: 15 }
                ];

                this.populateTable("memberTableBody", members, ["nama", "kelas", "role"]);
                this.populateTable("bookTableBody", books, ["judul", "pengarang", "stok"]);
            }

            populateTable(tableId, data, columns) {
                const tableBody = document.getElementById(tableId);
                tableBody.innerHTML = "";

                data.forEach((item, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        ${columns.map(col => `<td>${item[col]}</td>`).join("")}
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

            animateCounters() {
                const counters = [
                    { id: "member-count", target: 123 },
                    { id: "book-count", target: 1234 },
                    { id: "loan-count", target: 1234 },
                    { id: "return-count", target: 1234 },
                    { id: "total-inventory", target: 1234 },
                    { id: "books-borrowed", target: 500 },
                    { id: "books-available", target: 734 }
                ];

                counters.forEach(counter => {
                    this.animateCounter(counter.id, counter.target);
                });
            }

            animateCounter(elementId, target) {
                const element = document.getElementById(elementId);
                if (!element) return;

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
                const sidebarCollapsed = JSON.parse(localStorage.getItem('dashboard_sidebarCollapsed'));
                if (sidebarCollapsed) {
                    this.sidebar.classList.add('collapsed');
                }
            }

            // Method to update real-time data (can be called from external sources)
            updateStats(newStats) {
                Object.keys(newStats).forEach(key => {
                    const element = document.getElementById(key);
                    if (element) {
                        this.animateCounter(key, newStats[key]);
                    }
                });

                // Update chart if book stats changed
                if (newStats['books-borrowed'] || newStats['books-available']) {
                    this.bookChart.data.datasets[0].data = [
                        newStats['books-borrowed'] || 500,
                        newStats['books-available'] || 734
                    ];
                    this.bookChart.update();
                }
            }
        }

        // Initialize dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.dashboard = new Dashboard();
        });

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', () => {
            // Add ripple effect to cards
            document.querySelectorAll(".stat-card, .card").forEach(card => {
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });