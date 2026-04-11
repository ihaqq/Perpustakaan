const sidebar = document.querySelector(".sidebar");
const sidebarToggle = document.getElementById("sidebar-toggle");
const navLinksWithSubmenu = document.querySelectorAll(".sidebar nav ul li a");

// =========== Elemen Modal Add Genre ===========
const addGenreModal = document.getElementById("addGenreModal");
const addGenreForm = document.getElementById("addGenreForm");
const btnSubmitGenre = document.getElementById("btnSubmitGenre");
const descInput = document.getElementById("deskripsi");
const charCount = document.getElementById("charCount");
const charLimitWarn = document.getElementById("charLimitWarn");
const modalTitle = document.querySelector(".modal-title");
const modalSubtitle = document.querySelector(".modal-subtitle");

// =========== Elemen Modal Delete Genre ===========
const deleteModalOverlay = document.getElementById("deleteModalOverlay");
const btnConfirmDelete = document.getElementById("btnConfirmDelete");

// =========== Inisialisasi Global Variabel ===========
let currentEditGenreId = null; // null = Add Mode, isi ID = Edit Mode
let currentDeleteGenreId = null; // Menyimpan ID yang akan dihapus

// === CONFIGURATION ===
const currentDomain = window.location.origin;

// BASE_URL menggunakan dinamis origin
const BASE_URL = `${currentDomain}/api`;
const ASSET_URL = `/storage/foto_profile/`;

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

// =========== Core Data Fetching ===========
let currentFilter = "Semua Genre";
let currentPage = 1;
let perPage = 10;
const searchInput = document.getElementById("genreSearch");

// Fetch data dari API dengan Parameter Page
async function fetchGenres(page = 1) {
    try {
        const searchText = searchInput.value;
        let kategoriParam = currentFilter;

        // Sesuaikan nilai filter dengan parameter yang diharapkan API
        if (kategoriParam === "Semua Genre") {
            kategoriParam = "";
        } else if (kategoriParam === "Non-fiksi") {
            kategoriParam = "Non Fiksi";
        }

        // Siapkan parameter URL termasuk pagination
        const params = new URLSearchParams({ page });
        if (searchText) params.append("search", searchText);
        if (kategoriParam) params.append("kategori", kategoriParam);

        // Fetching ke endpoint resource /genre
        const response = await fetch(`${BASE_URL}/genre?${params.toString()}`);
        const json = await response.json();

        if (json.success) {
            currentPage = json.data.meta.current_page;
            perPage = json.data.meta.per_page;

            renderTable(json.data.Genres);
            renderPagination(json.data.meta); // Panggil fungsi render pagination
        } else {
            console.error("Gagal mengambil data genre:", json.meta?.message);
            renderTable([]);
            document.getElementById("pagination").innerHTML = "";
        }
    } catch (error) {
        console.error("Error saat fetching genre:", error);
        renderTable([]);
        document.getElementById("pagination").innerHTML = "";
    }
}

// Render data ke dalam tabel
function renderTable(genres = []) {
    const tableBody = document.getElementById("genreTableBody");
    tableBody.innerHTML = "";

    if (genres.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="5" style="text-align:center; padding: 20px;">Data genre tidak ditemukan...</td></tr>`;
        return;
    }

    genres.forEach((item, index) => {
        // Tentukan class badge berdasarkan kategori
        const badgeClass =
            item.kategori_buku.toLowerCase() === "fiksi"
                ? "badge-fiksi"
                : "badge-nonfiksi";

        // Hitung nomor urut agar berlanjut saat pindah halaman
        const nomorUrut = (currentPage - 1) * perPage + index + 1;

        const row = `
            <tr>
                <td>${nomorUrut}</td>
                <td><strong>${item.nama_genre}</strong></td>
                <td><span class="badge ${badgeClass}">${item.kategori_buku}</span></td>
                <td class="deskripsi-text">${item.deskripsi}</td>
                <td>
                    <div class="action-icons">
                        <button class="btn-action btn-edit" title="Edit" onclick="window.openEditModal('${item.id}')"><i class="fas fa-edit"></i></button>
                        <button class="btn-action btn-delete" title="Hapus" onclick="window.openDeleteModal('${item.id}')"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
}

// =========== Pagination Logic ===========
function renderPagination(meta) {
    const container = document.getElementById("pagination");
    if (!container) return; // Safety check

    container.innerHTML = "";
    container.classList.add("pagination-container");

    const metaCurrentPage = meta.current_page;
    const lastPage = meta.last_page;

    // Sembunyikan pagination jika hanya ada 1 halaman
    if (lastPage <= 1) return;

    // Tombol Previous
    const prevBtn = document.createElement("button");
    prevBtn.className = `page-btn ${metaCurrentPage === 1 ? "disabled" : ""}`;
    prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
    prevBtn.disabled = metaCurrentPage === 1;
    prevBtn.addEventListener("click", () => {
        if (metaCurrentPage > 1) fetchGenres(metaCurrentPage - 1);
    });
    container.appendChild(prevBtn);

    // Hitung range tombol yang ditampilkan
    let startPage = Math.max(1, metaCurrentPage - 2);
    let endPage = Math.min(lastPage, metaCurrentPage + 2);

    // Tambahkan halaman 1 dan ellipsis di awal jika perlu
    if (startPage > 1) {
        container.appendChild(createPageBtn(1, metaCurrentPage));
        if (startPage > 2) container.appendChild(createEllipsis());
    }

    // Tombol angka di tengah
    for (let i = startPage; i <= endPage; i++) {
        container.appendChild(createPageBtn(i, metaCurrentPage));
    }

    // Tombol Next
    const nextBtn = document.createElement("button");
    nextBtn.className = `page-btn ${metaCurrentPage === lastPage ? "disabled" : ""}`;
    nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
    nextBtn.disabled = metaCurrentPage === lastPage;
    nextBtn.addEventListener("click", () => {
        if (metaCurrentPage < lastPage) fetchGenres(metaCurrentPage + 1);
    });
    container.appendChild(nextBtn);
}

function createPageBtn(page, metaCurrentPage) {
    const btn = document.createElement("button");
    btn.className = `page-btn ${page === metaCurrentPage ? "active" : ""}`;
    btn.innerText = page;
    if (page !== metaCurrentPage) {
        btn.addEventListener("click", () => fetchGenres(page));
    }
    return btn;
}

function createEllipsis() {
    const span = document.createElement("span");
    span.className = "page-btn disabled";
    span.innerText = "...";
    return span;
}

// =========== Event Listeners ===========

// Fitur Search dengan Debounce
let searchTimeout;
searchInput.addEventListener("input", function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(async () => {
        await fetchGenres(1); // Set ke halaman 1 saat mulai mencari
    }, 500);
});

// Fitur Filter Kategori
const filterButtons = document.querySelectorAll(".btn-filter");
filterButtons.forEach((btn) => {
    btn.addEventListener("click", async function () {
        filterButtons.forEach((b) => b.classList.remove("active"));
        this.classList.add("active");

        currentFilter = this.innerText.trim();
        await fetchGenres(1); // Set ke halaman 1 saat mengubah filter
    });
});

// Jalankan fetch pertama kali saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", async () => {
    await fetchGenres(1);
});

// =========== Fitur Open Modal (Tambah Data) ===========
window.openAddGenreModal = function () {
    currentEditGenreId = null; // Reset state ke Add
    addGenreForm.reset();
    clearGenreValidationErrors();

    // Sesuaikan Teks Modal untuk Tambah
    modalTitle.innerText = "Tambah Genre";
    modalSubtitle.innerText =
        "Tambahkan informasi genre baru ke perpustakaan Anda";
    btnSubmitGenre.innerHTML = '<i class="far fa-save text-lg"></i> Simpan';

    charCount.innerText = "0";
    charLimitWarn.classList.add("hidden");

    addGenreModal.style.display = "flex";
};

// =========== Fitur Open Modal (Edit Data) ===========
window.openEditModal = async function (id) {
    currentEditGenreId = id; // Set state ke Edit dengan ID
    addGenreForm.reset();
    clearGenreValidationErrors();

    // Sesuaikan Teks Modal untuk Edit
    modalTitle.innerText = "Edit Genre";
    modalSubtitle.innerText = "Perbarui informasi genre yang sudah ada";
    btnSubmitGenre.innerHTML = '<i class="far fa-save text-lg"></i> Update';

    addGenreModal.style.display = "flex"; // Tampilkan modal langsung agar user tahu merespon

    try {
        // Fetching data genre berdasarkan ID
        const response = await fetch(`${BASE_URL}/genre/${id}`, {
            headers: {
                Accept: "application/json",
                // 'Authorization': `Bearer ${localStorage.getItem('token')}` // Buka jika butuh token
            },
        });

        const json = await response.json();

        if (response.ok && json.success) {
            const genre = json.data;

            // Masukkan data ke dalam form
            document.getElementById("nama_genre").value =
                genre.nama_genre || "";
            document.getElementById("kategori_buku").value =
                genre.kategori_buku || "";
            document.getElementById("deskripsi").value = genre.deskripsi || "";

            // Sesuaikan hitungan karakter deskripsi
            const length = descInput.value.length;
            charCount.innerText = length;
            if (length >= 130) {
                charLimitWarn.classList.remove("hidden");
            } else {
                charLimitWarn.classList.add("hidden");
            }
        } else {
            alert(
                json.meta?.message || "Gagal memuat data genre untuk diedit.",
            );
            closeAddGenreModal();
        }
    } catch (error) {
        console.error("Error fetching edit data:", error);
        alert("Terjadi kesalahan pada jaringan.");
        closeAddGenreModal();
    }
};

// Fitur Close Modal
window.closeAddGenreModal = function () {
    addGenreModal.style.display = "none";
};

// Close saat overlay diklik
window.closeOnOverlay = function (e) {
    if (e.target === addGenreModal) {
        closeAddGenreModal();
    }
    if (e.target === deleteModalOverlay) {
        closeDeleteModal();
    }
};

// Fitur Live Character Count Deskripsi
descInput.addEventListener("input", function () {
    const length = this.value.length;
    charCount.innerText = length;

    if (length >= 130) {
        charLimitWarn.classList.remove("hidden");
    } else {
        charLimitWarn.classList.add("hidden");
    }
});

// =========== Fitur Hapus Pesan Error Validasi ===========
function clearGenreValidationErrors() {
    document.querySelectorAll("#addGenreForm .error-msg").forEach((el) => {
        el.innerText = "";
        el.style.display = "none";
    });
    document.querySelectorAll("#addGenreForm .form-input").forEach((el) => {
        el.classList.remove("input-error");
    });
}

// =========== Fitur Submit Form (Add & Edit) ===========
addGenreForm.addEventListener("submit", async function (e) {
    e.preventDefault();
    clearGenreValidationErrors();

    // Ambil Value
    const formData = {
        nama_genre: document.getElementById("nama_genre").value.trim(),
        kategori_buku: document.getElementById("kategori_buku").value,
        deskripsi: document.getElementById("deskripsi").value.trim(),
    };

    // Tentukan URL dan Method berdasarkan state currentEditGenreId
    const isEdit = currentEditGenreId !== null;
    const url = isEdit
        ? `${BASE_URL}/genre/${currentEditGenreId}`
        : `${BASE_URL}/genre`;
    const method = isEdit ? "PUT" : "POST";

    // Ubah state tombol menjadi loading
    btnSubmitGenre.disabled = true;
    btnSubmitGenre.innerHTML =
        '<i class="fas fa-spinner fa-spin text-lg"></i> Menyimpan...';

    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                // 'Authorization': `Bearer ${localStorage.getItem('token')}` // Buka jika butuh token
            },
            body: JSON.stringify(formData),
        });

        const json = await response.json();

        // Cek jika status API 201 (Created), 200 (OK), atau sukses bernilai true
        if (
            response.status === 201 ||
            response.status === 200 ||
            json.success
        ) {
            closeAddGenreModal();

            // Tampilkan pesan dinamis berdasarkan aksi
            alert(
                json.meta?.message ||
                    (isEdit
                        ? "Genre berhasil diperbarui!"
                        : "Genre berhasil ditambahkan!"),
            );

            // Refresh table ke halaman saat ini (tidak kembali ke halaman 1 jika sedang mengedit di halaman 3)
            await fetchGenres(isEdit ? currentPage : 1);
        } else if (response.status === 422) {
            // Validasi Error dari API
            const errors = json.errors;
            for (const field in errors) {
                const errorElement = document.getElementById(`error-${field}`);
                const inputElement = document.getElementById(field);

                if (errorElement) {
                    errorElement.innerText = errors[field][0]; // Ambil array pertama error
                    errorElement.style.display = "block";
                }
                if (inputElement) {
                    inputElement.classList.add("input-error");
                }
            }
        } else {
            // Error handling diluar validasi
            alert(json.message || "Gagal menyimpan data. Silakan coba lagi.");
        }
    } catch (error) {
        console.error("Error saat menyimpan genre:", error);
        alert("Terjadi kesalahan pada jaringan server.");
    } finally {
        // Kembalikan state tombol
        btnSubmitGenre.disabled = false;
        btnSubmitGenre.innerHTML = isEdit
            ? '<i class="far fa-save text-lg"></i> Update'
            : '<i class="far fa-save text-lg"></i> Simpan';
    }
});

// =========== Fitur Open Modal (Delete Data) ===========
window.openDeleteModal = function (id) {
    currentDeleteGenreId = id; // Simpan ID ke dalam variabel global
    deleteModalOverlay.style.display = "flex"; // Tampilkan modal
    deleteModalOverlay.classList.add("active");
    
};

// =========== Fitur Close Modal (Delete Data) ===========
window.closeDeleteModal = function () {
    currentDeleteGenreId = null; // Reset ID
    deleteModalOverlay.style.display = "none"; // Sembunyikan modal
    deleteModalOverlay.classList.remove("active");
};

// =========== Fitur Submit Eksekusi Delete ===========
btnConfirmDelete.addEventListener("click", async function () {
    // Jika tidak ada ID yang tersimpan, batalkan
    if (!currentDeleteGenreId) return;

    // Ubah state tombol menjadi loading
    const originalBtnText = btnConfirmDelete.innerText;
    btnConfirmDelete.disabled = true;
    btnConfirmDelete.innerHTML =
        '<i class="fas fa-spinner fa-spin"></i> Menghapus...';

    try {
        const response = await fetch(
            `${BASE_URL}/genre/${currentDeleteGenreId}`,
            {
                method: "DELETE",
                headers: {
                    Accept: "application/json",
                    // 'Authorization': `Bearer ${localStorage.getItem('token')}` // Buka jika butuh token
                },
            },
        );

        const json = await response.json();

        // Cek jika response status ok dan success bernilai true
        if (response.ok && json.success) {
            closeDeleteModal();

            // Tampilkan pesan sukses dari API
            alert(json.meta?.message || "Data genre berhasil dihapus");

            // Render ulang tabel (tetap di current page)
            await fetchGenres(currentPage);
        } else {
            alert(json.meta?.message || "Gagal menghapus data genre.");
            closeDeleteModal();
        }
    } catch (error) {
        console.error("Error saat menghapus genre:", error);
        alert("Terjadi kesalahan pada jaringan server.");
        closeDeleteModal();
    } finally {
        // Kembalikan state tombol ke semula
        btnConfirmDelete.disabled = false;
        btnConfirmDelete.innerText = originalBtnText;
    }
});
