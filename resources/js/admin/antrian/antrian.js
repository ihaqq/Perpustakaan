// ================= Sidebar & Navbar Elements =================
const sidebar = document.querySelector(".sidebar");
const sidebarToggle = document.getElementById("sidebar-toggle");
const navLinksWithSubmenu = document.querySelectorAll(".sidebar nav ul li a");

// =========== Sidebar & Navbar Logic ===========
sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
});

navLinksWithSubmenu.forEach((link) => {
    link.addEventListener("click", (e) => {
        const submenu = link.nextElementSibling;
        const parentLi = link.parentElement;

        if (submenu) {
            e.preventDefault();

            if (parentLi.classList.contains("active")) {
                submenu.style.display = "none";
                parentLi.classList.remove("active");
            } else {
                document
                    .querySelectorAll(".sidebar nav ul .submenu")
                    .forEach((otherSubmenu) => {
                        otherSubmenu.style.display = "none";
                        otherSubmenu.parentElement.classList.remove("active");
                    });

                submenu.style.display = "block";
                parentLi.classList.add("active");
            }
        }
    });
});

// ================= Antrian Page Logic =================
document.addEventListener("DOMContentLoaded", function () {
    const dataAntrian = [
        {
            no: "01",
            kode: "BK-0001",
            judul: "Laskar Pelangi",
            genre: "Fiksi",
            pemesan: "Dinda Permata",
            nisn: "0090721678",
            estimasi: "15 April 2026",
            keterangan: "Sedang dipinjam (H-2)",
            status: "Menunggu",
        },
        {
            no: "02",
            kode: "BK-0002",
            judul: "Filosofi Teras",
            genre: "Non-Fiksi",
            pemesan: "Dinda Permata",
            nisn: "0090721678",
            estimasi: "15 April 2026",
            keterangan: "Sedang dipinjam (H-2)",
            status: "Menunggu",
        },
        {
            no: "03",
            kode: "BK-0003",
            judul: "Atomic Habits",
            genre: "Non-Fiksi",
            pemesan: "Dinda Permata",
            nisn: "0090721678",
            estimasi: "15 April 2026",
            keterangan: "Sedang dipinjam (H-2)",
            status: "Menunggu",
        },
    ];

    const tableBody = document.getElementById("antrianTableBody");
    const searchInput = document.getElementById("antrianSearch");

    function renderTable(data) {
        // Jika data kosong (saat pencarian tidak ditemukan)
        if (data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; padding: 20px; color: #888;">Data antrian tidak ditemukan.</td></tr>`;
            return;
        }

        let allRows = ""; // Kumpulkan baris di sini
        data.forEach((item) => {
            allRows += `
					<tr>
						<td class="no-antrian">${item.no}</td>
						<td><span class="kode-buku">${item.kode}</span></td>
						<td class="info-buku">
							<div class="judul">${item.judul}</div>
							<div class="genre">Genre: ${item.genre}</div>
						</td>
						<td class="pemesan">
							<div class="nama">${item.pemesan}</div>
							<div class="id">NISN: ${item.nisn}</div>
						</td>
						<td class="estimasi">
							<div class="tgl">${item.estimasi}</div>
							<div class="sub">${item.keterangan}</div>
						</td>
						<td style="text-align: center;"><span class="status-pill">${item.status}</span></td>
					</tr>
				`;
        });
        tableBody.innerHTML = allRows; // Masukkan ke DOM sekali saja
    }

    searchInput.addEventListener("input", function () {
        const query = searchInput.value.toLowerCase().trim();

        const filteredData = dataAntrian.filter((item) => {
            return (
                item.judul.toLowerCase().includes(query) ||
                item.pemesan.toLowerCase().includes(query) ||
                item.kode.toLowerCase().includes(query) ||
                item.nisn.toLowerCase().includes(query)
            );
        });

        renderTable(filteredData);
    });

    // Inisialisasi awal
    renderTable(dataAntrian);
});
