document.addEventListener("DOMContentLoaded", () => {
    // === DOM ELEMENTS ===
    const sidebar = document.querySelector(".sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    const navLinksWithSubmenu = document.querySelectorAll(".sidebar nav ul li a",);

    const memberSearchInput = document.getElementById("memberSearch");
    const memberTableBody = document.getElementById("memberTableBody");
    const paginationContainer = document.getElementById("pagination");

    // Filter Modal Elements
    const openFilterModalBtn = document.getElementById("openFilterModal");
    const closeFilterModalBtn = document.getElementById("closeFilterModal");
    const modalOverlay = document.getElementById("modalOverlay");

    // Filter Options
    const typeFilterOptionsDiv = document.getElementById("typeFilterOptions");
    const kelasFilterOptionsDiv = document.getElementById("kelasFilterOptions");
    const jurusanFilterOptionsDiv = document.getElementById("jurusanFilterOptions",);
    const kelasFilterGroup = document.getElementById("kelasFilterGroup");
    const jurusanFilterGroup = document.getElementById("jurusanFilterGroup");

    const resetFiltersBtn = document.getElementById("resetFiltersBtn");
    const applyFiltersBtn = document.getElementById("applyFiltersBtn");

    // === DELETE LOGIC & MODALS (IMPROVISASI) ===
    let memberIdToDelete = null; // Menyimpan ID anggota yang akan dihapus sementara
    const deleteModalOverlay = document.getElementById("deleteModalOverlay");
    const deleteSuccesModal = document.getElementById("deleteSuccesModal");
    const btnConfirmDelete = document.getElementById("btnConfirmDelete");

    // === CONFIGURATION ===
    const currentDomain = window.location.origin;

    const BASE_URL = `${currentDomain}/api`;
    const ASSET_URL = `/storage/foto_profile/`; // Path relatif biasanya sudah cukup untuk gambar

    let currentPage = 1;
    let lastPage = 1;
    let debounceTimer;
    let allKelasData = []; // Menyimpan data master kelas dari API

    // === SIDEBAR LOGIC ===
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
                            otherSubmenu.parentElement.classList.remove(
                                "active",
                            );
                        });
                    submenu.style.display = "block";
                    parentLi.classList.add("active");
                }
            }
        });
    });

    // === FETCH DYNAMIC FILTER DATA (IMPROVISASI BARU) ===
    async function fetchFilterOptions() {
        try {
            const response = await fetch(`${BASE_URL}/kelas/list`);
            const result = await response.json();

            if (result.success && result.data && result.data.Kelas) {
                allKelasData = result.data.Kelas;

                // Ekstrak Jurusan yang unik
                const uniqueJurusan = [
                    ...new Set(allKelasData.map((item) => item.jurusan)),
                ].filter(Boolean);
                renderFilterItems(
                    jurusanFilterOptionsDiv,
                    uniqueJurusan,
                    "Semua Jurusan",
                );

                // Ekstrak Kelas yang unik
                const uniqueKelas = [
                    ...new Set(allKelasData.map((item) => item.nama_kelas)),
                ].filter(Boolean);
                renderFilterItems(
                    kelasFilterOptionsDiv,
                    uniqueKelas,
                    "Semua Kelas",
                );
            }
        } catch (error) {
            console.error("Gagal mengambil data opsi filter:", error);
        }
    }

    // Helper untuk merender elemen span filter
    function renderFilterItems(container, items, defaultText) {
        container.innerHTML = `<span class="filter-option-item selected" data-filter-value="">${defaultText}</span>`;
        items.forEach((item) => {
            const span = document.createElement("span");
            span.className = "filter-option-item";
            span.dataset.filterValue = item;
            span.textContent = item;
            container.appendChild(span);
        });
    }

    // === FETCH & RENDER DATA TABLE ===
    async function fetchMembers() {
        const searchQuery = memberSearchInput.value.trim();
        const selectedType =
            typeFilterOptionsDiv.querySelector(".filter-option-item.selected")
                ?.dataset.filterValue || "";
        const selectedJurusan =
            jurusanFilterOptionsDiv.querySelector(
                ".filter-option-item.selected",
            )?.dataset.filterValue || "";
        const selectedKelas =
            kelasFilterOptionsDiv.querySelector(".filter-option-item.selected")
                ?.dataset.filterValue || "";

        memberTableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Memuat data...</td></tr>`;

        try {
            const url = new URL(`${BASE_URL}/anggota?status=Approved`);
            url.searchParams.append("search", searchQuery);
            if (selectedType) url.searchParams.append("kategori", selectedType);
            if (selectedJurusan)
                url.searchParams.append("jurusan", selectedJurusan);
            if (selectedKelas) url.searchParams.append("kelas", selectedKelas); // Sesuaikan dengan key parameter BE
            url.searchParams.append("page", currentPage);

            const response = await fetch(url);
            const result = await response.json();

            if (result.success && result.data && result.data.anggota) {
                renderTable(result.data.anggota, result.data.meta);
                renderPagination(result.data.meta);
            } else {
                memberTableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Data tidak ditemukan</td></tr>`;
                if (paginationContainer) paginationContainer.innerHTML = "";
            }
        } catch (error) {
            console.error("Gagal mengambil data:", error);
            memberTableBody.innerHTML = `<tr><td colspan="7" style="text-align:center; color:red;">Terjadi kesalahan saat memuat data.</td></tr>`;
        }
    }

    // Fungsi untuk merender tabel anggota
    function renderTable(members, meta) {
        memberTableBody.innerHTML = "";
        if (members.length === 0) {
            memberTableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;">Tidak ada anggota yang cocok.</td></tr>`;
            return;
        }

        members.forEach((member, index) => {
            const rowNo = (meta.current_page - 1) * meta.per_page + index + 1;
            const bgDark = generateDarkColor(member.nama);
            const fallbackAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(member.nama)}&background=${bgDark}&color=fff`;

            let photoSrc = fallbackAvatar;
            if (member.foto_profile) {
                photoSrc = member.foto_profile.startsWith("http")
                    ? member.foto_profile
                    : `${ASSET_URL}${member.foto_profile}`;
            }

            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="text-center">${rowNo}</td>
                <td class="text-center">
                    <img src="${photoSrc}" alt="Foto ${member.nama}" class="member-photo" 
                         style="width:36px; height:36px; border-radius:50%; object-fit:cover;"
                         onerror="this.onerror=null; this.src='${fallbackAvatar}';">
                </td>
                <td><div class="text-wrap-2-lines fw-500">${member.nama || "-"}</div></td>
                <td>${member.nomor_induk || "-"}</td>
                <td>${member.kelas || "-"}</td>
                <td><span class="badge ${member.kategori === "Pelajar" ? "badge-pelajar" : "badge-guru"}">${member.kategori || "-"}</span></td>
                <td class="text-center">
                    <div class="action-icons">
                        <button onclick="window.openDetailModal('${member.id}')" class="btn-action btn-view" title="Detail"><i class="fas fa-eye"></i></button>
                        <button onclick="window.openDeleteModal('${member.id}')" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            `;
            memberTableBody.appendChild(row);
        });
    }

    // Fungsi untuk membuka modal detail dan mengambil data API
    window.openDetailModal = async function (id) {
        const modal = document.getElementById("memberDetailModal");

        // Tampilkan modal
        modal.classList.add("active");
        document.body.style.overflow = "hidden";

        // State Loading
        document.getElementById("mdc-nama").textContent = "Memuat...";
        document.getElementById("mdc-username").textContent = "@memuat";
        document.getElementById("mdc-foto").src =
            "https://ui-avatars.com/api/?name=Loading&background=e3f2fd&color=5c6ac4";

        try {
            const response = await fetch(`${BASE_URL}/anggota/${id}`);
            const result = await response.json();

            if (result.success && result.data) {
                const member = result.data;

                // Mapping Data Dasar
                document.getElementById("mdc-nama").textContent =
                    member.nama || "Tanpa Nama";
                document.getElementById("mdc-username").textContent =
                    member.username ? `@${member.username}` : "-";

                // Badges
                document.getElementById("mdc-kategori").textContent =
                    member.kategori || "-";
                document.getElementById("mdc-status").textContent =
                    member.status || "-";

                // Stats
                document.getElementById("mdc-pinjaman-aktif").textContent =
                    member.pinjaman_aktif ?? 0;
                document.getElementById("mdc-total-pinjaman").textContent =
                    member.total_pinjaman ?? 0;

                // Handle Foto Profil (Termasuk jika null)
                const bgDarkModal = generateDarkColor(member.nama || "User");
                const fallbackAvatar = `https://ui-avatars.com/api/?name=${encodeURIComponent(member.nama || "User")}&background=${bgDarkModal}&color=fff`;
                let photoSrc = fallbackAvatar;
                if (member.foto_profile) {
                    photoSrc = member.foto_profile.startsWith("http")
                        ? member.foto_profile
                        : `${ASSET_URL}/${member.foto_profile}`;
                }
                const imgEl = document.getElementById("mdc-foto");
                imgEl.src = photoSrc;
                imgEl.onerror = () => {
                    imgEl.src = fallbackAvatar;
                };

                // Mapping Grid Info
                document.getElementById("mdc-no-induk").textContent =
                    member.nomor_induk || "-";
                document.getElementById("mdc-email").textContent =
                    member.email || "-";
                document.getElementById("mdc-telepon").textContent =
                    member.telepon || "-";

                // Improvisasi: Penanganan jenis kelamin null
                let jkStr = "-";
                if (member.gender === "Laki-laki") jkStr = "Laki-laki";
                else if (member.gender === "Perempuan") jkStr = "Perempuan";
                else if (member.gender) jkStr = member.gender; // Tampilkan apa adanya jika ada value laina
                document.getElementById("mdc-jk").textContent = jkStr;

                // Gabungkan kelas dan jurusan
                const kelas = member.kelas || "";
                const jurusan = member.jurusan || "";
                document.getElementById("mdc-kelas-jurusan").textContent =
                    kelas || jurusan ? `${kelas} - ${jurusan}` : "-";

                // Format Tanggal
                document.getElementById("mdc-tgl-gabung").textContent =
                    formatDate(member.tanggal_gabung);
            }
        } catch (error) {
            console.error("Error fetching detail:", error);
            document.getElementById("mdc-nama").textContent =
                "Gagal memuat data";
        }
    };

    // Event Listener: Eksekusi hapus data saat tombol Hapus di-klik
    if (btnConfirmDelete) {
        btnConfirmDelete.addEventListener("click", async () => {
            if (!memberIdToDelete) return;

            // Improvisasi: Tambahkan state loading pada tombol
            const originalText = btnConfirmDelete.textContent;
            btnConfirmDelete.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Menghapus...';
            btnConfirmDelete.disabled = true;

            try {
                // Melakukan request DELETE ke API
                const response = await fetch(
                    `${BASE_URL}/anggota/${memberIdToDelete}`,
                    {
                        method: "DELETE",
                        headers: {
                            Accept: "application/json",
                            "Content-Type": "application/json",
                            // Catatan: Jika API kamu menggunakan bearer token, tambahkan header "Authorization": `Bearer ${token}` di sini.
                        },
                    },
                );

                const result = await response.json();

                if (result.success) {
                    // Berhasil dihapus
                    window.closeDeleteModal(); // Tutup modal konfirmasi
                    deleteSuccesModal.classList.add("active"); // Buka modal sukses

                    // Improvisasi: Panggil ulang data tabel agar otomatis ter-refresh
                    // Jika data di page ini habis terhapus, mundur 1 page
                    if (
                        memberTableBody.querySelectorAll("tr").length === 1 &&
                        currentPage > 1
                    ) {
                        currentPage--;
                    }
                    fetchMembers();
                } else {
                    // Respon API mengembalikan success: false
                    alert(
                        "Gagal menghapus data: " +
                            (result.meta?.message ||
                                "Terjadi kesalahan di server."),
                    );
                    window.closeDeleteModal();
                }
            } catch (error) {
                // Error jaringan atau server mati
                console.error("Gagal melakukan request hapus:", error);
                alert(
                    "Terjadi kesalahan jaringan saat mencoba menghapus data.",
                );
                window.closeDeleteModal();
            } finally {
                // Kembalikan state tombol ke semula apapun yang terjadi (berhasil/gagal)
                btnConfirmDelete.textContent = originalText;
                btnConfirmDelete.disabled = false;
                memberIdToDelete = null; // Reset ID
            }
        });
    }

    // Helper function untuk generate warna Hex gelap berdasarkan nama
    // Supaya warna anggota tidak berubah-ubah saat di-refresh
    function generateDarkColor(name) {
        if (!name) return "333333"; // Default dark gray jika tidak ada nama

        let hash = 0;
        for (let i = 0; i < name.length; i++) {
            hash = name.charCodeAt(i) + ((hash << 5) - hash);
        }

        let color = "";
        for (let i = 0; i < 3; i++) {
            // Bitwise AND dengan 127 (0x7F) untuk memastikan nilai RGB maksimal 127 (menghasilkan warna gelap)
            let value = (hash >> (i * 8)) & 0x7f;
            color += ("00" + value.toString(16)).substr(-2);
        }
        return color;
    }

    // Helper function untuk format tanggal (Contoh: 2026-04-03 -> 03 April 2026)
    function formatDate(dateString) {
        if (!dateString) return "-";
        const options = { year: "numeric", month: "long", day: "numeric" };
        return new Date(dateString).toLocaleDateString("id-ID", options);
    }

    // Fungsi membuka modal konfirmasi delete
    window.openDeleteModal = function (id) {
        memberIdToDelete = id;
        deleteModalOverlay.classList.add("active");
        document.body.style.overflow = "hidden"; // Cegah scroll background
    };

    // Fungsi menutup modal konfirmasi delete
    window.closeDeleteModal = function () {
        memberIdToDelete = null;
        deleteModalOverlay.classList.remove("active");
        document.body.style.overflow = "auto";
    };

    // Fungsi menutup modal sukses delete
    window.closeDeleteSuccesModal = function () {
        deleteSuccesModal.classList.remove("active");
        document.body.style.overflow = "auto";
    };

    // Fungsi untuk menutup modal detail
    window.closeDetailModal = function () {
        document.getElementById("memberDetailModal").classList.remove("active");
        document.body.style.overflow = "auto";
    };

    // Event Listener: Tutup modal jika klik di area luar modal detail (overlay)
    window.addEventListener("click", (e) => {
        if (e.target === deleteModalOverlay) {
            window.closeDeleteModal();
        }
        if (e.target === deleteSuccesModal) {
            window.closeDeleteSuccesModal();
        }
    });

    // Tutup modal jika klik di luar konten modal
    window.closeDetailModalOutside = function (event) {
        if (event.target.id === "memberDetailModal") {
            window.closeDetailModal();
        }
    };

    // pagination logic
    function renderPagination(meta) {
        if (!paginationContainer) return;
        paginationContainer.innerHTML = "";
        lastPage = meta.last_page;

        if (lastPage <= 1) return;

        const prevBtn = document.createElement("button");
        prevBtn.className = `page-btn ${meta.current_page === 1 ? "disabled" : ""}`;
        prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
        prevBtn.disabled = meta.current_page === 1;
        prevBtn.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                fetchMembers();
            }
        });
        paginationContainer.appendChild(prevBtn);

        let startPage = Math.max(1, meta.current_page - 2);
        let endPage = Math.min(lastPage, meta.current_page + 2);

        if (startPage > 1) {
            paginationContainer.appendChild(
                createPageBtn(1, meta.current_page),
            );
            if (startPage > 2)
                paginationContainer.appendChild(createEllipsis());
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationContainer.appendChild(
                createPageBtn(i, meta.current_page),
            );
        }

        if (endPage < lastPage) {
            if (endPage < lastPage - 1)
                paginationContainer.appendChild(createEllipsis());
            paginationContainer.appendChild(
                createPageBtn(lastPage, meta.current_page),
            );
        }

        const nextBtn = document.createElement("button");
        nextBtn.className = `page-btn ${meta.current_page === lastPage ? "disabled" : ""}`;
        nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
        nextBtn.disabled = meta.current_page === lastPage;
        nextBtn.addEventListener("click", () => {
            if (currentPage < lastPage) {
                currentPage++;
                fetchMembers();
            }
        });
        paginationContainer.appendChild(nextBtn);
    }

    // Helper untuk membuat tombol halaman
    function createPageBtn(page, current) {
        const btn = document.createElement("button");
        btn.className = `page-btn ${page === current ? "active" : ""}`;
        btn.textContent = page;
        if (page !== current) {
            btn.addEventListener("click", () => {
                currentPage = page;
                fetchMembers();
            });
        }
        return btn;
    }

    // Helper untuk membuat elemen ellipsis
    function createEllipsis() {
        const span = document.createElement("span");
        span.className = "page-btn disabled";
        span.textContent = "...";
        return span;
    }

    // === FILTER & SEARCH LOGIC ===
    memberSearchInput.addEventListener("keyup", (e) => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            currentPage = 1;
            fetchMembers();
        }, 500);
    });

    openFilterModalBtn.addEventListener("click", () =>
        modalOverlay.classList.add("active"),
    );
    closeFilterModalBtn.addEventListener("click", () =>
        modalOverlay.classList.remove("active"),
    );
    modalOverlay.addEventListener("click", (e) => {
        if (e.target === modalOverlay) modalOverlay.classList.remove("active");
    });

    const setupFilterSelection = (container) => {
        container.addEventListener("click", (e) => {
            if (
                e.target.classList.contains("filter-option-item") &&
                !container.parentElement.classList.contains("disabled")
            ) {
                container
                    .querySelectorAll(".filter-option-item")
                    .forEach((opt) => opt.classList.remove("selected"));
                e.target.classList.add("selected");

                // Logic Disable Kelas & Jurusan jika bukan Siswa/Pelajar
                if (container === typeFilterOptionsDiv) {
                    const isSiswa = e.target.dataset.filterValue !== "Admin";
                    kelasFilterGroup.classList.toggle("disabled", !isSiswa);
                    jurusanFilterGroup.classList.toggle("disabled", !isSiswa);
                }

                // Logic Cascading: Ubah list kelas berdasarkan jurusan yang dipilih
                if (container === jurusanFilterOptionsDiv) {
                    const selectedJurusan = e.target.dataset.filterValue;
                    let filteredKelas = allKelasData;

                    if (selectedJurusan) {
                        filteredKelas = allKelasData.filter(
                            (k) => k.jurusan === selectedJurusan,
                        );
                    }

                    const uniqueKelas = [
                        ...new Set(
                            filteredKelas.map((item) => item.nama_kelas),
                        ),
                    ].filter(Boolean);
                    renderFilterItems(
                        kelasFilterOptionsDiv,
                        uniqueKelas,
                        "Semua Kelas",
                    );
                }
            }
        });
    };

    setupFilterSelection(typeFilterOptionsDiv);
    setupFilterSelection(kelasFilterOptionsDiv);
    setupFilterSelection(jurusanFilterOptionsDiv);

    applyFiltersBtn.addEventListener("click", () => {
        currentPage = 1;
        fetchMembers();
        modalOverlay.classList.remove("active");
    });

    resetFiltersBtn.addEventListener("click", () => {
        document.querySelectorAll(".filter-option-item").forEach((opt) => {
            opt.classList.remove("selected");
            if (opt.dataset.filterValue === "") opt.classList.add("selected");
        });

        kelasFilterGroup.classList.remove("disabled");
        jurusanFilterGroup.classList.remove("disabled");
        memberSearchInput.value = "";

        // Kembalikan semua opsi kelas
        const uniqueKelas = [
            ...new Set(allKelasData.map((item) => item.nama_kelas)),
        ].filter(Boolean);
        renderFilterItems(kelasFilterOptionsDiv, uniqueKelas, "Semua Kelas");

        currentPage = 1;
        fetchMembers();
        modalOverlay.classList.remove("active");
    });

    // === INITIALISASI ===
    fetchFilterOptions(); // Ambil data filter (Jurusan & Kelas) saat pertama diload
    fetchMembers(); // Ambil data tabel anggota
});
