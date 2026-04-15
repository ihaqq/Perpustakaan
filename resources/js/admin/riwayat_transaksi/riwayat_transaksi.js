const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');

const transactions = [
    {
        id: "TR-0001",
        nama: "Dinda Permata",
        buku: "Laskar Pelangi",
        tglPinjam: "14/08/2025",
        tglKembali: "--/--/----",
        status: "Dipinjam",
    },
    {
        id: "TR-0002",
        nama: "Budi Santoso",
        buku: "Atomic Habits",
        tglPinjam: "14/08/2025",
        tglKembali: "14/08/2025",
        status: "Selesai",
    },
    {
        id: "TR-0003",
        nama: "Siti Rahayu",
        buku: "Laut Bercerita",
        tglPinjam: "14/08/2025",
        tglKembali: "23/08/2025",
        status: "Terlambat",
    },
    {
        id: "TR-0004",
        nama: "Joko Susilo",
        buku: "Filosofi Teras",
        tglPinjam: "14/08/2025",
        tglKembali: "20/08/2025",
        status: "Selesai",
    },
    {
        id: "TR-0005",
        nama: "Nailah Masyithah",
        buku: "Bumi Manusia",
        tglPinjam: "14/08/2025",
        tglKembali: "17/08/2025",
        status: "Selesai",
    },
    {
        id: "TR-0006",
        nama: "Tiara Syifa",
        buku: "A Brief History of Time",
        tglPinjam: "14/08/2025",
        tglKembali: "--/--/----",
        status: "Dipinjam",
    },
    {
        id: "TR-0007",
        nama: "Retno Wulandari",
        buku: "The Hobbit",
        tglPinjam: "25/08/2025",
        tglKembali: "07/09/2025",
        status: "Terlambat",
    },
    {
        id: "TR-0008",
        nama: "Faizzatul Sa'diah",
        buku: "It",
        tglPinjam: "29/08/2025",
        tglKembali: "--/--/----",
        status: "Dipinjam",
    },
    {
        id: "TR-0009",
        nama: "Rasya Azka",
        buku: "Komik Jagoan Cilik",
        tglPinjam: "02/09/2025",
        tglKembali: "--/--/----",
        status: "Dipinjam",
    },
];

let filterAktif = "Semua";

function renderTable(searchText = "") {
    const tableBody = document.getElementById("riwayatTableBody");
    tableBody.innerHTML = "";

    const filteredData = transactions.filter((item) => {
        const matchStatus =
            filterAktif === "Semua" || item.status === filterAktif;
        const matchSearch =
            item.nama.toLowerCase().includes(searchText.toLowerCase()) ||
            item.buku.toLowerCase().includes(searchText.toLowerCase()) ||
            item.id.toLowerCase().includes(searchText.toLowerCase());
        return matchStatus && matchSearch;
    });

    if (filteredData.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding: 20px;">Data transaksi tidak ditemukan...</td></tr>`;
        return;
    }

    filteredData.forEach((item) => {
        const badgeClass = `status-${item.status.toLowerCase()}`;
        // Di dalam filteredData.forEach(item => { ... })
        const row = `
					<tr>
						<td><strong>${item.id}</strong></td>
						<td>${item.nama}</td>
						<td>${item.buku}</td>
						<td>${item.tglPinjam}</td>
						<td>${item.tglKembali}</td>
						<td style="text-align: center;"><span class="badge ${badgeClass}">${item.status.toUpperCase()}</span></td>
						<td style="text-align: center;">
							<button class="btn-detail" title="Lihat Detail">
								<i class="fas fa-eye"></i> Detail
							</button>
						</td>
					</tr>
				`;
        tableBody.innerHTML += row;
    });
}

const searchInput = document.getElementById("riwayatSearch");
searchInput.addEventListener("input", function () {
    renderTable(this.value);
});

const filterButtons = document.querySelectorAll(".btn-filter");
filterButtons.forEach((btn) => {
    btn.addEventListener("click", function () {
        filterButtons.forEach((b) => b.classList.remove("active"));
        this.classList.add("active");

        // AMBIL TEKS TOMBOL
        const buttonText = this.innerText.trim();

        // LOGIKA PERBAIKAN: Jika teks mengandung kata "Semua", set ke "Semua"
        if (buttonText.includes("Semua")) {
            filterAktif = "Semua";
        } else {
            filterAktif = buttonText;
        }

        renderTable(searchInput.value);
    });
});

document.addEventListener("DOMContentLoaded", () => renderTable());

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