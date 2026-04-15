const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');

document.addEventListener("DOMContentLoaded", function () {
    // 1. Data Master (Data asli)
    const dataMaster = [
        {
            id: "PO-0001",
            judul: "Negeri 5 Menara",
            genre: "Fiksi",
            nama: "Dinda Permata",
            telp: "0854-1277-9524",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
        {
            id: "PO-0002",
            judul: "Laut Bercerita",
            genre: "Fiksi",
            nama: "Bunga Mawar",
            telp: "0854-3237-8649",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
        {
            id: "PO-0003",
            judul: "Atomic Habits",
            genre: "Non-Fiksi",
            nama: "Melati Indah",
            telp: "0856-5782-3021",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
        {
            id: "PO-0004",
            judul: "Bumi Manusia",
            genre: "Fiksi",
            nama: "Mutiara Laut",
            telp: "0853-9524-9524",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
        {
            id: "PO-0005",
            judul: "Filosofi Teras",
            genre: "Non-Fiksi",
            nama: "Dewita Ayu",
            telp: "0854-1207-1224",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
        {
            id: "PO-0006",
            judul: "Laskar Pelangi",
            genre: "Fiksi",
            nama: "Nayala",
            telp: "NISN: 0090712578",
            batas: "15 April 2026",
            status: "Siap Ambil",
        },
    ];

    // 2. Variabel Kontrol
    let filteredData = [...dataMaster]; // Menampung hasil pencarian
    let currentPage = 1;
    const rowsPerPage = 5;

    // 3. Seleksi Elemen DOM
    const tableBody = document.getElementById("bookingTableBody");
    const paginationBtns = document.getElementById("pagination");
    const searchInput = document.getElementById("bookingSearch");

    // 4. Fungsi untuk merender baris tabel
    function renderTable() {
        // Hitung pemotongan data untuk pagination
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedItems = filteredData.slice(start, end);

        if (paginatedItems.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center; padding: 20px;">Data tidak ditemukan.</td></tr>`;
            return;
        }

        // Render baris ke HTML
        tableBody.innerHTML = paginatedItems
            .map(
                (item) => `
				<tr>
					<td class="id-booking">${item.id}</td>
					<td class="info-buku">
						<span class="judul">${item.judul}</span>
						<span style="font-size: 11px; color:#888;">Genre: ${item.genre}</span>
					</td>
					<td class="penerima">
						<span class="nama">${item.nama}</span>
						<span style="font-size: 11px; color:#888;">Telp: ${item.telp}</span>
					</td>
					<td><span class="batas-ambil">${item.batas}</span></td>
					<td style="text-align: center;"><span class="status-pill">${item.status}</span></td>
					<td>
						<div class="action-btns">
							<button class="btn-action btn-check"><i class="fas fa-check"></i></button>
							<button class="btn-action btn-cross"><i class="fas fa-times"></i></button>
						</div>
					</td>
				</tr>
			`,
            )
            .join("");

        updatePaginationControls();
    }

    // 5. Fungsi untuk memperbarui tombol angka halaman
    function updatePaginationControls() {
        const pageCount = Math.ceil(filteredData.length / rowsPerPage);
        const container = document.getElementById("paginationBtns");
        container.innerHTML = "";

        if (pageCount <= 1) return; // Tidak perlu navigasi jika hanya 1 halaman

        // 1. Tombol Panah Kiri (Prev)
        const prevBtn = document.createElement("button");
        prevBtn.className = "btn-page";
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.disabled = currentPage === 1;
        prevBtn.onclick = () => {
            currentPage--;
            renderTable();
        };
        container.appendChild(prevBtn);

        // 2. Tombol Angka Halaman
        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.className = `btn-page ${i === currentPage ? "active" : ""}`;
            btn.onclick = () => {
                currentPage = i;
                renderTable();
            };
            container.appendChild(btn);
        }

        // 3. Tombol Panah Kanan (Next)
        const nextBtn = document.createElement("button");
        nextBtn.className = "btn-page";
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.disabled = currentPage === pageCount;
        nextBtn.onclick = () => {
            currentPage++;
            renderTable();
        };
        container.appendChild(nextBtn);
    }

    // 6. Logika Pencarian
    searchInput.addEventListener("input", function () {
        const query = searchInput.value.toLowerCase().trim();

        // Filter data berdasarkan input
        filteredData = dataMaster.filter((item) => {
            return (
                item.judul.toLowerCase().includes(query) ||
                item.nama.toLowerCase().includes(query) ||
                item.id.toLowerCase().includes(query)
            );
        });

        currentPage = 1; // Reset ke halaman 1 setiap kali mencari
        renderTable();
    });

    // 7. Inisialisasi Pertama Kali
    renderTable();
});

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