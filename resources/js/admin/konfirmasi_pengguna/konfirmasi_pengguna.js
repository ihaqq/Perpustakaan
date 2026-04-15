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


const members = [
    {
        no: 1,
        nama: "Retno Wulandari",
        email: "Retnowulan@gmail.com",
        kategori: "Pelajar",
        tgl: "14/06/2025",
        status: "VALID",
    },
    {
        no: 2,
        nama: "Dinda Permata",
        email: "Dindapermata@gmail.com",
        kategori: "Guru",
        tgl: "15/06/2025",
        status: "BELUM VALID",
    },
    {
        no: 3,
        nama: "Bunga Mawar",
        email: "Bungamawar@gmail.com",
        kategori: "Guru",
        tgl: "16/06/2025",
        status: "VALID",
    },
    {
        no: 4,
        nama: "Melati Indah",
        email: "Melatiindah@gmail.com",
        kategori: "Pelajar",
        tgl: "16/06/2025",
        status: "VALID",
    },
    {
        no: 5,
        nama: "Mutiara Laut",
        email: "Mutiaralaut@gmail.com",
        kategori: "Pelajar",
        tgl: "17/06/2025",
        status: "BELUM VALID",
    },
    {
        no: 6,
        nama: "Dewita Ayu",
        email: "Dewitaayu@gmail.com",
        kategori: "Pelajar",
        tgl: "18/06/2025",
        status: "BELUM VALID",
    },
    {
        no: 7,
        nama: "Zara Amelia",
        email: "Zaraamelia@gmail.com",
        kategori: "Pelajar",
        tgl: "19/06/2025",
        status: "VALID",
    },
    {
        no: 8,
        nama: "Silpi Oktavia",
        email: "Silpioktavia@gmail.com",
        kategori: "Guru",
        tgl: "20/06/2025",
        status: "BELUM VALID",
    },
    {
        no: 9,
        nama: "Nayala Putri",
        email: "Nayala@gmail.com",
        kategori: "Pelajar",
        tgl: "20/06/2025",
        status: "VALID",
    },
    {
        no: 10,
        nama: "Arini Salsa",
        email: "Arini@gmail.com",
        kategori: "Pelajar",
        tgl: "21/06/2025",
        status: "VALID",
    },
];

function renderTable(data) {
    const tableBody = document.getElementById("memberTableBody");
    tableBody.innerHTML = data
        .map(
            (m) => `
                <tr>
                    <td>${m.no}</td>
                    <td>${m.nama}</td>
                    <td><span style="text-decoration: underline;">${m.email}</span></td>
                    <td class="text-center"><span class="badge ${m.kategori === "Pelajar" ? "badge-pelajar" : "badge-guru"}">${m.kategori}</span></td>
                    <td>${m.tgl}</td>
                    <td class="text-center"><span class="badge ${m.status === "VALID" ? "status-valid" : "status-invalid"}">${m.status}</span></td>
                    <td class="action-cell text-center">
                        <button class="btn-more" onclick="toggleDropdown(event)"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu">
                            <a href="#"><i class="fas fa-eye"></i> Lihat Detail</a>
                            <a href="#" style="color: #00b69b;"><i class="fas fa-check"></i> Terima</a>
                            <a href="#" style="color: #ef4444;"><i class="fas fa-times"></i> Tolak</a>
                        </div>
                    </td>
                </tr>
            `,
        )
        .join("");
}

function toggleDropdown(e) {
    e.stopPropagation();
    const currentMenu = e.currentTarget.nextElementSibling;
    document.querySelectorAll(".dropdown-menu").forEach((m) => {
        if (m !== currentMenu) m.classList.remove("show");
    });
    currentMenu.classList.toggle("show");
}

document.getElementById("memberSearch").addEventListener("input", (e) => {
    const val = e.target.value.toLowerCase();
    const filtered = members.filter((m) => m.nama.toLowerCase().includes(val));
    renderTable(filtered);
});

window.onclick = () =>
    document
        .querySelectorAll(".dropdown-menu")
        .forEach((m) => m.classList.remove("show"));

renderTable(members);
