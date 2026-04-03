            // Enhanced Dashboard JavaScript
        class Dashboard {
            constructor() {
                this.sidebar = document.querySelector(".sidebar");
                this.sidebarToggle = document.getElementById("sidebar-toggle");
                this.menuToggles = document.querySelectorAll(".menu-toggle");
                
                this.initializeEventListeners();
                // this.initializeChart();
                // this.populateData();
                // this.animateCounters();
            }

            initializeEventListeners() {
                // Sidebar toggle
                this.sidebarToggle.addEventListener("click", () => {
                    this.sidebar.classList.toggle("collapsed");
                    this.savePreference("sidebarCollapsed", this.sidebar.classList.contains("collapsed"));
                });

                // Menu toggles
                this.menuToggles.forEach(toggle => {
                    toggle.addEventListener("click", (e) => {
                        e.preventDefault();
                        this.toggleSubmenu(toggle);
                    });
                });

                // Load saved preferences
                this.loadPreferences();

                // Add smooth scrolling to view more links
                document.querySelectorAll(".view-more").forEach(link => {
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
                    document.querySelectorAll(".sidebar nav ul .submenu").forEach(otherSubmenu => {
                        otherSubmenu.style.display = "none";
                        otherSubmenu.parentElement.classList.remove("active");
                    });

                    // Open clicked submenu
                    submenu.style.display = "block";
                    parentLi.classList.add("active");
                }
            }
        }