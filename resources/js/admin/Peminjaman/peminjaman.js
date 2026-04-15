const modal = document.getElementById("returnModalOverlay");
const displayID = document.getElementById("displayID");

function openReturnModal(id) {
    displayID.innerText = id;
    modal.classList.add("active");
}

function closeReturnModal() {
    modal.classList.remove("active");
}

document.getElementById("btnConfirmReturn").addEventListener("click", () => {
    console.log("Buku ID " + displayID.innerText + " dikembalikan");
    closeReturnModal();
});

window.onclick = (e) => {
    if (e.target == modal) closeReturnModal();
};

// Ambil elemen-elemen yang dibutuhkan
const filterOverlay = document.getElementById("filterModalOverlay");
const btnOpenFilter = document.getElementById("btnOpenFilter");
const btnCloseFilter = document.getElementById("btnCloseFilter");
const btnResetFilter = document.getElementById("btnResetFilter");
const btnApplyFilter = document.getElementById("btnApplyFilter");

const inputTglPinjam = document.getElementById("filterTglPinjam");
const inputTglKembali = document.getElementById("filterTglKembali");

// Fungsi Utama Filter
btnApplyFilter.addEventListener("click", () => {
    const filterPinjam = inputTglPinjam.value; // Format: YYYY-MM-DD
    const filterKembali = inputTglKembali.value;
    const tableRows = document.querySelectorAll("#peminjamanTable tbody tr");

    tableRows.forEach((row) => {
        // Ambil teks dari kolom 4 (Pinjam) dan 5 (Kembali)
        const tglPinjamTeks = row.cells[3].textContent.trim();
        const tglKembaliTeks = row.cells[4].textContent.trim();

        // Ubah teks "DD/MM/YYYY" di tabel menjadi "YYYY-MM-DD" untuk dibandingkan
        const tglPinjamFormatted = formatDateToISO(tglPinjamTeks);
        const tglKembaliFormatted = formatDateToISO(tglKembaliTeks);

        let isMatch = true;

        // Logika Filter Tanggal Pinjam
        if (filterPinjam && tglPinjamFormatted !== filterPinjam) {
            isMatch = false;
        }

        // Logika Filter Tanggal Kembali
        if (filterKembali && tglKembaliFormatted !== filterKembali) {
            isMatch = false;
        }

        row.style.display = isMatch ? "" : "none";
    });

    filterOverlay.classList.remove("active");
});

// Fungsi untuk mengubah format DD/MM/YYYY menjadi YYYY-MM-DD
function formatDateToISO(dateStr) {
    const parts = dateStr.split("/");
    if (parts.length === 3) {
        // parts[0]=DD, parts[1]=MM, parts[2]=YYYY -> Jadi YYYY-MM-DD
        return `${parts[2]}-${parts[1]}-${parts[0]}`;
    }
    return "";
}

// Tombol Reset
btnResetFilter.addEventListener("click", () => {
    inputTglPinjam.value = "";
    inputTglKembali.value = "";
    document.querySelectorAll("#peminjamanTable tbody tr").forEach((row) => {
        row.style.display = "";
    });
});

// Buka/Tutup Modal
btnOpenFilter.addEventListener("click", () =>
    filterOverlay.classList.add("active"),
);
btnCloseFilter.addEventListener("click", () =>
    filterOverlay.classList.remove("active"),
);
window.onclick = (e) => {
    if (e.target == filterOverlay) filterOverlay.classList.remove("active");
};
