const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.getElementById('sidebar-toggle');
const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');
const modalOverlay = document.getElementById('modalOverlay');
const filterButton = document.getElementById('filterButton');
const closeModalButton = document.getElementById('closeModal');
const applyFiltersBtn = document.getElementById('applyFiltersBtn');
const resetFiltersBtn = document.getElementById('resetFiltersBtn');
const bookSearchInput = document.getElementById('bookSearch');
const kategoriFilterOptionsDiv = document.getElementById('kategoriFilterOptions');
const stokFilterOptionsDiv = document.getElementById('stokFilterOptions');
const genreFilterOptionsDiv = document.getElementById('genreFilterOptions');
const addBookModal = document.getElementById('addBookModalOverlay');
const genreSelect = document.getElementById('genreSelect');
const kategoriRadios = document.querySelectorAll('input[name="kat"]');
const addBookForm = document.getElementById('addBookForm');
const btnSubmitBook = document.getElementById('btnSubmitBook');

// Modal Sukses & Gagal
const succesAddBookModal = document.getElementById('addSuccesModal');
const successEditBookModal = document.getElementById('addSuccesEditModal');
const succesDeleteBookModal = document.getElementById('deleteSuccesModal');
const failAddBookModal = document.getElementById('addFailModal');
const failEditBookModal = document.getElementById('addFailEditModal');

// === CONFIGURATION ===
const currentDomain = window.location.origin;

// BASE_URL menggunakan dinamis origin
const BASE_URL = `${currentDomain}/api`;
const ASSET_URL = `/storage/foto_profile/`; 

// === Global Variable untuk mendeteksi Mode Edit/Tambah ===
let currentEditBookId = null;

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

// =========== Filter Modal Logic ===========
filterButton.addEventListener('click', () => {
    modalOverlay.classList.add('active');
});

closeModalButton.addEventListener('click', () => {
    modalOverlay.classList.remove('active');
});

[kategoriFilterOptionsDiv, stokFilterOptionsDiv, genreFilterOptionsDiv].forEach(filterDiv => {
    filterDiv.addEventListener('click', (e) => {
        if (e.target.classList.contains('filter-option-item')) {
            filterDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
            e.target.classList.add('selected');

            // Jika di tombol kategori diklik, lakukan refresh genre
            if (filterDiv === kategoriFilterOptionsDiv) {
                const selectedKategori = e.target.getAttribute('data-filter-value');
                loadFilterGenres(selectedKategori);
            }
        }
    });
});

resetFiltersBtn.addEventListener('click', async () => {
    kategoriFilterOptionsDiv.querySelector('[data-filter-value=""]')?.click();
    stokFilterOptionsDiv.querySelector('[data-filter-value=""]')?.click();
    genreFilterOptionsDiv.querySelector('[data-filter-value=""]')?.click();
    bookSearchInput.value = '';

    await fetchBooks(1);
});

applyFiltersBtn.addEventListener('click', async () => {
    await fetchBooks(1);
    modalOverlay.classList.remove('active');
});

let searchTimeout;
bookSearchInput.addEventListener('keyup', () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(async () => {
        await fetchBooks(1);
    }, 500); 
});

// =========== Core Data Fetching ===========
let books = [];
let currentPage = 1;

document.addEventListener('DOMContentLoaded', async () => {
    await fetchBooks();
    loadFilterGenres(); 
});

async function fetchBooks(page = 1) {
    try {
        const search = bookSearchInput.value;
        const kategori = kategoriFilterOptionsDiv.querySelector('.selected')?.dataset.filterValue || '';
        const stok = stokFilterOptionsDiv.querySelector('.selected')?.dataset.filterValue || '';
        const genre_id = genreFilterOptionsDiv.querySelector('.selected')?.dataset.filterValue || '';

        const params = new URLSearchParams({ page, search, kategori, stok, genre_id });
        // UPDATE: Gunakan BASE_URL
        const res = await fetch(`${BASE_URL}/books?${params.toString()}`);
        const json = await res.json();

        books = json.data.books;
        currentPage = json.data.meta.current_page;

        populateBooksTable(books);
        renderPagination(json.data.meta);
    } catch (error) {
        console.error('Gagal mengambil data buku:', error);
    }
}

function populateBooksTable(filteredBooks = books) {
    const bookTableBody = document.getElementById('bookTableBody');
    bookTableBody.innerHTML = '';
    
    if (filteredBooks.length === 0) {
        bookTableBody.innerHTML = '<tr><td colspan="9" style="text-align: center;">Tidak ada buku yang ditemukan.</td></tr>';
        return;
    }

    filteredBooks.forEach((book, index) => {
        const row = document.createElement('tr');

        // UPDATE: Gunakan currentDomain untuk cover
        const coverPath = book.cover 
            ? `${currentDomain}/storage/${book.cover}`
            : `https://placehold.co/400x600/5c6ac4/white?text=No+Cover`;

        let stockClass = 'high';
        if (book.stok_tersedia <= 4 && book.stok_tersedia > 0) {
            stockClass = 'low';
        } else if (book.stok_tersedia === 0) {
            stockClass = 'empty';
        }

        row.innerHTML = `
            <td>${(currentPage - 1) * 10 + index + 1}</td>
            <td><b>${book.kode_buku}</b></td>
            <td style="text-align: center;"><img src="${coverPath}" alt="${book.judul_buku}" class="book-cover"></td>
            <td>
                <div class="text-wrap-2-lines" style="font-weight: 500;"> ${book.judul_buku}</div>
                <div style="font-size: 0.8rem; color: #888;">Tahun: ${book.tahun_terbit || '-'}</div>
            </td>
            <td>${book.kategori}</td>
            <td>${book.genre}</td>
            <td><span class="stock-badge ${stockClass}">${book.stok_tersedia}</span></td>
            <td style="text-align: center;">
                <div class="action-icons">
                    <button onclick="window.openDetailModal('${book.id}')" class="btn-action btn-view" title="Detail"><i class="fas fa-eye"></i></button>
                    <button onclick="window.openEditModal('${book.id}')" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></button>
                    <button onclick="window.openDeleteModal('${book.id}')" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                </div>
            </td>
        `;
        bookTableBody.appendChild(row);
    });
}

// =========== Pagination ===========
function renderPagination(meta) {
    const container = document.getElementById('pagination');
    container.innerHTML = '';
    container.classList.add('pagination-container');

    const currentPage = meta.current_page;
    const lastPage = meta.last_page;

    if (lastPage <= 1) return;

    const prevBtn = document.createElement('button');
    prevBtn.className = `page-btn ${currentPage === 1 ? 'disabled' : ''}`;
    prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
    prevBtn.disabled = currentPage === 1;
    prevBtn.addEventListener('click', () => {
        if (currentPage > 1) fetchBooks(currentPage - 1);
    });
    container.appendChild(prevBtn);

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(lastPage, currentPage + 2);

    if (startPage > 1) {
        container.appendChild(createPageBtn(1, currentPage));
        if (startPage > 2) container.appendChild(createEllipsis());
    }

    for (let i = startPage; i <= endPage; i++) {
        container.appendChild(createPageBtn(i, currentPage));
    }

    const nextBtn = document.createElement('button');
    nextBtn.className = `page-btn ${currentPage === lastPage ? 'disabled' : ''}`;
    nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
    nextBtn.disabled = currentPage === lastPage;
    nextBtn.addEventListener('click', () => {
        if (currentPage < lastPage) fetchBooks(currentPage + 1);
    });
    container.appendChild(nextBtn);
}

function createPageBtn(page, currentPage) {
    const btn = document.createElement('button');
    btn.className = `page-btn ${page === currentPage ? 'active' : ''}`;
    btn.innerText = page;
    if (page !== currentPage) {
        btn.addEventListener('click', () => fetchBooks(page));
    }
    return btn;
}

function createEllipsis() {
    const span = document.createElement('span');
    span.className = 'page-btn disabled';
    span.innerText = '...';
    return span;
}

// =========== Detail Modal ===========
window.openDetailModal = async function(id) {
    const detailModal = document.getElementById('detailModalOverlay');
    detailModal.classList.add('active');
    document.getElementById('detail-judul').innerText = 'Memuat data...';
    
    try {
        // UPDATE: Gunakan BASE_URL
        const response = await fetch(`${BASE_URL}/books/${id}`);
        const json = await response.json();

        if (response.ok && json.success) {
            const book = json.data;
            document.getElementById('detail-judul').innerText = book.judul_buku || '-';
            document.getElementById('detail-kategori').innerText = book.kategori || '-';

            const detailStokElement = document.getElementById('detail-stok');
            const stokValue = book.stok_tersedia || 0; 
            detailStokElement.innerText = stokValue;

            detailStokElement.classList.remove('high', 'low', 'empty');
            let stockClass = 'high'; 
            if (stokValue <= 4 && stokValue > 0) stockClass = 'low'; 
            else if (stokValue == 0) stockClass = 'empty'; 
            
            detailStokElement.classList.add('stock-badge', stockClass);

            document.getElementById('detail-kode_buku').innerText = book.kode_buku || '-';
            document.getElementById('detail-bahasa').innerText = book.bahasa || '-';
            document.getElementById('detail-pengarang').innerText = book.pengarang || '-';
            document.getElementById('detail-penerbit').innerText = book.penerbit || '-';
            document.getElementById('detail-genre').innerText = book.genre || '-';
            document.getElementById('detail-tahun_terbit').innerText = book.tahun_terbit || '-';
            document.getElementById('detail-jumlah_halaman').innerText = book.jumlah_halaman ? `${book.jumlah_halaman} Halaman` : '-';
            document.getElementById('detail-lokasi_rak').innerText = book.lokasi_rak || '-';
            document.getElementById('detail-sinopsis').innerText = book.sinopsis || 'Tidak ada sinopsis.';

            const coverElement = document.getElementById('detail-cover');
            if (book.cover) {
                // UPDATE: Gunakan currentDomain
                coverElement.src = `${currentDomain}/storage/${book.cover}`; 
            } else {
                coverElement.src = 'https://placehold.co/400x600/5c6ac4/white?text=No+Cover';
            }
        } else {
            alert('Gagal mengambil data detail buku.');
            closeDetailModal();
        }
    } catch (error) {
        console.error('Error saat fetching detail:', error);
        alert('Terjadi kesalahan pada jaringan.');
        closeDetailModal();
    }
}

window.closeDetailModal = function() { 
    document.getElementById('detailModalOverlay').classList.remove('active'); 
}

// =========== Delete Modal ===========
let bookIdToDelete = null;

window.openDeleteModal = function(id) {
    bookIdToDelete = id;
    document.getElementById('deleteModalOverlay').classList.add('active');
}

window.closeDeleteModal = function() {
    document.getElementById('deleteModalOverlay').classList.remove('active');
    bookIdToDelete = null;
}

document.getElementById('btnConfirmDelete').addEventListener('click', async () => {
    if (bookIdToDelete !== null) {
        const btnConfirm = document.getElementById('btnConfirmDelete');
        const originalText = btnConfirm.innerText;
        try {
            btnConfirm.innerText = 'Menghapus...';
            btnConfirm.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            // UPDATE: Gunakan BASE_URL
            const response = await fetch(`${BASE_URL}/books/${bookIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type' : 'application/json',
                    'Accept'       : 'application/json',
                    'X-CSRF-TOKEN' : csrfToken
                }
            });

            if (response.ok) {       
                window.closeDeleteModal();
                succesDeleteBookModal.classList.add('active');
                await fetchBooks(currentPage);
            } else {
                const errorData = await response.json();
                alert('Gagal menghapus buku: ' + (errorData.message || 'Terjadi kesalahan di server.'));
            }
        } catch (error) {
            console.error('Error saat menghapus buku:', error);
            alert('Terjadi kesalahan pada jaringan/server');
        } finally {
            btnConfirm.innerText = originalText;
            btnConfirm.disabled = false;
        }
    }
});

// =========== Input Validation Display ===========
function clearValidationErrors() {
    document.querySelectorAll('.error-feedback').forEach(el => el.remove());
    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
}

function showValidationErrors(errors) {
    // Mapping nama field dari Backend ke ID input di HTML Anda
    const fieldMap = {
        'judul': 'add-judul',
        'pengarang': 'add-pengarang',
        'penerbit': 'add-penerbit',
        'stok': 'add-stok',
        'tahun_terbit': 'add-tahun_terbit',
        'bahasa': 'add-bahasa',
        'lokasi_rak': 'add-lokasi_rak',
        'jumlah_halaman': 'add-jumlah_halaman',
        'sinopsis': 'add-sinopsis',
        'genres_id': 'genreSelect',
        'cover': 'fileInput'
    };

    for (const [key, messages] of Object.entries(errors)) {
        const inputId = fieldMap[key];
        if (inputId) {
            const inputEl = document.getElementById(inputId);
            if (inputEl) {
                inputEl.classList.add('is-invalid');
                
                // Membuat elemen teks error
                const errorSpan = document.createElement('small');
                errorSpan.className = 'error-feedback';
                errorSpan.style.color = '#e74c3c';
                errorSpan.style.display = 'block';
                errorSpan.style.marginTop = '4px';
                errorSpan.style.fontSize = '12px';
                errorSpan.innerText = messages[0];

                // Penempatan spesial untuk file upload
                if(key === 'cover') {
                    const uploadArea = inputEl.closest('.upload-area');
                    if(uploadArea) uploadArea.parentElement.appendChild(errorSpan);
                } else {
                    inputEl.parentElement.appendChild(errorSpan);
                }
            }
        }
    }
}

// =========== Add / Edit Book Modal ===========
window.openAddBookModal = function () {
    currentEditBookId = null; 
    addBookForm.reset(); 
    clearValidationErrors(); 
    
    const titleEl = document.querySelector('.add-modal-title h2');
    if(titleEl) titleEl.innerText = 'Tambah Buku';
    btnSubmitBook.innerHTML = '<i class="far fa-save text-lg"></i> Simpan';
    
    document.getElementById('previewContainer').style.display = 'none';
    document.getElementById('placeholderContent').style.display = 'flex';
    document.getElementById('imagePreview').src = '#';

    addBookModal.classList.add('active');
    
    const activeKategoriRadio = document.querySelector('input[name="kat"]:checked');
    const activeKategori = activeKategoriRadio ? activeKategoriRadio.value : 'Fiksi';
    fetchGenresForModal(activeKategori);
}

window.openEditModal = async function(id) {
    currentEditBookId = id; 
    addBookForm.reset(); 
    clearValidationErrors(); 
    
    const titleEl = document.querySelector('.add-modal-title h2');
    if(titleEl) titleEl.innerText = 'Edit Buku';
    btnSubmitBook.innerHTML = '<i class="far fa-save text-lg"></i> Update';
    
    addBookModal.classList.add('active'); 
    
    try {
        // UPDATE: Gunakan BASE_URL
        const response = await fetch(`${BASE_URL}/books/${id}`);
        const json = await response.json();

        if (response.ok && json.success) {
            const book = json.data;
            
            document.getElementById('add-judul').value = book.judul_buku || '';
            document.getElementById('add-pengarang').value = book.pengarang || '';
            document.getElementById('add-penerbit').value = book.penerbit || '';
            document.getElementById('add-stok').value = book.stok_total || '';
            document.getElementById('add-tahun_terbit').value = book.tahun_terbit || '';
            document.getElementById('add-bahasa').value = book.bahasa || '';
            document.getElementById('add-lokasi_rak').value = book.lokasi_rak || '';
            document.getElementById('add-jumlah_halaman').value = book.jumlah_halaman || '';
            document.getElementById('add-sinopsis').value = book.sinopsis || '';
            
            let currentKategori = 'Fiksi';
            kategoriRadios.forEach(radio => {
                if (radio.value === book.kategori) {
                    radio.checked = true;
                    currentKategori = book.kategori;
                }
            });

            await fetchGenresForModal(currentKategori);
            if(book.id_genre) {
                document.getElementById('genreSelect').value = book.id_genre;
            }
            
            const previewContainer = document.getElementById('previewContainer');
            const placeholderContent = document.getElementById('placeholderContent');
            const imagePreview = document.getElementById('imagePreview');

            if (book.cover) {
                // UPDATE: Gunakan currentDomain
                imagePreview.src = `${currentDomain}/storage/${book.cover}`;
                previewContainer.style.display = 'flex';
                placeholderContent.style.display = 'none';
            } else {
                previewContainer.style.display = 'none';
                placeholderContent.style.display = 'flex';
                imagePreview.src = '#';
            }

        } else {
            alert('Gagal memuat data buku untuk diedit.');
            closeAddBookModal();
        }
    } catch (error) {
        console.error('Error fetching edit data:', error);
        alert('Terjadi kesalahan pada jaringan.');
        closeAddBookModal();
    }
}

window.closeAddBookModal = function () {
    addBookModal.classList.remove('active');
    clearValidationErrors(); 
}

window.previewImage = function (input) {
    const previewContainer = document.getElementById('previewContainer');
    const placeholderContent = document.getElementById('placeholderContent');
    const imagePreview = document.getElementById('imagePreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            previewContainer.style.display = 'flex';
            placeholderContent.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    }
}  

async function fetchGenresForModal(kategori) {
    try {
        genreSelect.innerHTML = '<option value="" disabled selected>Memuat genre...</option>';
        genreSelect.disabled = true;

        // UPDATE: Gunakan BASE_URL
        const response = await fetch(`${BASE_URL}/genre/list?kategori=${kategori}`);
        const json = await response.json();

        if (response.ok && json.success) {
            const genres = json.data.Genres;
            genreSelect.innerHTML = '<option value="" disabled selected>Pilih Genre</option>';
            genres.forEach(genre => {
                const option = document.createElement('option');
                option.value = genre.id; 
                option.textContent = genre.nama_genre;
                genreSelect.appendChild(option);
            });
            genreSelect.disabled = false;
        } else {
            genreSelect.innerHTML = '<option value="" disabled selected>Gagal memuat data</option>';
        }
    } catch (error) {
        console.error('Error saat mengambil data genre:', error);
        genreSelect.innerHTML = '<option value="" disabled selected>Error jaringan</option>';
    }
}

kategoriRadios.forEach(radio => {
    radio.addEventListener('change', (e) => {
        if (e.target.checked) {
            fetchGenresForModal(e.target.value);
        }
    });
});

async function loadFilterGenres(kategori = '') {
    const genreFilterContainer = document.getElementById('genreFilterOptions');
    
    genreFilterContainer.innerHTML = `
        <span class="filter-option-item selected" data-filter-value="">Semua Genre</span>
        <span class="filter-option-item" style="pointer-events: none; opacity: 0.6;">Memuat genre...</span>
    `;

    try {
        // UPDATE: Gunakan BASE_URL
        let url = `${BASE_URL}/genre/list`;
        if (kategori) url += `?kategori=${kategori}`;

        const response = await fetch(url);
        const json = await response.json();

        genreFilterContainer.innerHTML = '<span class="filter-option-item selected" data-filter-value="">Semua Genre</span>';

        if (response.ok && json.success) {
            const genres = json.data.Genres || json.data; 
            
            genres.forEach(genre => {
                const span = document.createElement('span');
                span.className = 'filter-option-item';
                span.setAttribute('data-filter-value', genre.id); 
                span.textContent = genre.nama_genre;
                genreFilterContainer.appendChild(span);
            });
        } else {
            genreFilterContainer.innerHTML += '<span class="filter-option-item" style="pointer-events: none;">Gagal memuat</span>';
        }
    } catch (error) {
        console.error('Error saat mengambil data genre untuk filter:', error);
        genreFilterContainer.innerHTML += '<span class="filter-option-item" style="pointer-events: none;">Error Jaringan</span>';
    }
}

// =========== Submit Form (Tambah & Edit) ===========
addBookForm.addEventListener('submit', async (e) => {
    e.preventDefault(); 
    clearValidationErrors(); 

    const originalBtnHTML = btnSubmitBook.innerHTML;
    btnSubmitBook.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    btnSubmitBook.disabled = true;

    try {
        const formData = new FormData();
        
        // UPDATE: Gunakan BASE_URL
        let fetchUrl = `${BASE_URL}/books`;
        let fetchMethod = 'POST';

        if (currentEditBookId !== null) {
            fetchUrl = `${BASE_URL}/books/${currentEditBookId}`;
            formData.append('_method', 'PUT'); 
        }

        const selectedGenreId = document.getElementById('genreSelect').value;
        if(selectedGenreId) formData.append('genres_id', selectedGenreId);

        formData.append('judul', document.getElementById('add-judul').value);
        formData.append('pengarang', document.getElementById('add-pengarang').value);
        formData.append('penerbit', document.getElementById('add-penerbit').value);
        formData.append('stok_total', document.getElementById('add-stok').value);
        formData.append('tahun_terbit', document.getElementById('add-tahun_terbit').value);
        formData.append('bahasa', document.getElementById('add-bahasa').value);
        formData.append('lokasi_rak', document.getElementById('add-lokasi_rak').value);
        formData.append('jumlah_halaman', document.getElementById('add-jumlah_halaman').value);
        formData.append('sinopsis', document.getElementById('add-sinopsis').value);

        const fileInput = document.getElementById('fileInput'); 
        if (fileInput && fileInput.files.length > 0) {
            formData.append('cover', fileInput.files[0]);
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        const response = await fetch(fetchUrl, {
            method: fetchMethod,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });

        const json = await response.json();

        // Cek jika response sukses
        if (response.ok && (json.success || json.meta?.status === 'success')) {
            closeAddBookModal();
            
            // Tampilkan custom success modal sesuai dengan state (Tambah / Edit)
            if (currentEditBookId) {
                successEditBookModal.classList.add('active');
            } else {
                succesAddBookModal.classList.add('active');
            }

            await fetchBooks(currentPage); 
        } 
        else {
            if (json.errors) {
                showValidationErrors(json.errors); // Tampilkan pesan per form
            }
            
            // Tampilkan Modal Gagal
            if (currentEditBookId) {
                failEditBookModal.classList.add('active');
            } else {
                failAddBookModal.classList.add('active');
            }
        }

    } catch (error) {
        console.error('Error saat submit:', error);
        
        // Tampilkan Modal Gagal jika terjadi masalah jaringan
        if (currentEditBookId) {
            failEditBookModal.classList.add('active');
        } else {
            failAddBookModal.classList.add('active');
        }
    } finally {
        btnSubmitBook.innerHTML = originalBtnHTML;
        btnSubmitBook.disabled = false;
    }
});

// =========== Penyatuan Global Modal Click & Close Functions ===========

window.closeSuccesAddBookmodal = function() {
    succesAddBookModal.classList.remove('active');
    successEditBookModal.classList.remove('active');
    succesDeleteBookModal.classList.remove('active');
    failAddBookModal.classList.remove('active');
    failEditBookModal.classList.remove('active');
}

window.onclick = (e) => {
    // Menutup Modal Overlay biasa
    if (e.target == document.getElementById('modalOverlay')) {
        document.getElementById('modalOverlay').classList.remove('active');
    }
    if (e.target == document.getElementById('deleteModalOverlay')) {
        window.closeDeleteModal();
    }
    if (e.target == document.getElementById('detailModalOverlay')) {
        window.closeDetailModal();
    }
    if (e.target == addBookModal) {
        closeAddBookModal();
    }

    // [IMPROVISASI] Array untuk menutup modal notifikasi saat klik di luar
    const notificationModals = [succesAddBookModal, successEditBookModal, failAddBookModal, failEditBookModal];
    if (notificationModals.includes(e.target)) {
        e.target.classList.remove('active');
    }
};