const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');

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

document.addEventListener("DOMContentLoaded", function () {
    // --- 1. Data Dummy ---
    const dataPengembalian = [
        {
            id: 1,
            idPeminjaman: "P0001",
            nama: "Aila Putri",
            batasKembali: "14/08/2025",
            tglDikembalikan: "14/08/2025",
            status: "Tepat Waktu",
        },
        {
            id: 2,
            idPeminjaman: "P0002",
            nama: "Dinda Permata",
            batasKembali: "14/08/2025",
            tglDikembalikan: "15/08/2025",
            status: "Terlambat",
        },
        {
            id: 3,
            idPeminjaman: "P0003",
            nama: "Budi Santoso",
            batasKembali: "15/08/2025",
            tglDikembalikan: "15/08/2025",
            status: "Tepat Waktu",
        },
        {
            id: 4,
            idPeminjaman: "P0004",
            nama: "Citra Lestari",
            batasKembali: "10/08/2025",
            tglDikembalikan: "12/08/2025",
            status: "Terlambat",
        },
        {
            id: 5,
            idPeminjaman: "P0005",
            nama: "Eko Wijaya",
            batasKembali: "20/08/2025",
            tglDikembalikan: "20/08/2025",
            status: "Tepat Waktu",
        },
    ];

    const tbody = document.getElementById("peminjamanTableBody");

    // --- 2. Fungsi Render Tabel ---
    function renderTable(data) {
        tbody.innerHTML = "";

        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="7" class="no-data">Data tidak ditemukan</td></tr>`;
            return;
        }

        data.forEach((item) => {
            const statusClass =
                item.status === "Tepat Waktu"
                    ? "badge-success"
                    : "badge-danger";
            const row = `
                        <tr>
                            <td>${item.id}</td>
                            <td><strong class="id-peminjaman">${item.idPeminjaman}</strong></td>
                            <td>${item.nama}</td>
                            <td>${item.batasKembali}</td>
                            <td>${item.tglDikembalikan}</td>
                            <td align="center"><span class="badge ${statusClass}">${item.status}</span></td>
                            <td align="center">
                                <button class="btn-proses" onclick="prosesData('${item.idPeminjaman}', '${item.nama}')">
                                    <i class="fas fa-sync-alt"></i> Proses
                                </button>
                            </td>
                        </tr>
                    `;
            tbody.innerHTML += row;
        });
    }

    renderTable(dataPengembalian);

    // --- 3. Pencarian ---
    const searchInput = document.getElementById("returnSearch");
    searchInput.addEventListener("input", function (e) {
        const searchTerm = e.target.value.toLowerCase();
        const filtered = dataPengembalian.filter(
            (item) =>
                item.nama.toLowerCase().includes(searchTerm) ||
                item.idPeminjaman.toLowerCase().includes(searchTerm),
        );
        renderTable(filtered);
    });

    // --- 4. Filter Status ---
    const filterButtons = document.querySelectorAll(".btn-filter");
    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            filterButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");

            const val = this.textContent.trim();
            if (val === "Semua Status") {
                renderTable(dataPengembalian);
            } else {
                renderTable(
                    dataPengembalian.filter((item) => item.status === val),
                );
            }
        });
    });

    // --- 5. Fungsi Global ---
    window.prosesData = function (id, nama) {
        alert("Memproses ID: " + id + " atas nama " + nama);
    };

    document
        .querySelector(".btn-simpan")
        .addEventListener("click", function () {
            const nama = document.getElementById("inputNama").value;
            const tgl = document.getElementById("inputTanggal").value;
            if (!nama || !tgl) return alert("Lengkapi data terlebih dahulu!");
            alert("Data " + nama + " berhasil disimpan.");
        });
});
