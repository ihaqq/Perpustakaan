
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

        filterButton.addEventListener('click', () => {
            modalOverlay.classList.add('active');
        });

        closeModalButton.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        const books = [{
            judul: 'Laskar Pelangi',
            pengarang: 'Andrea Hirata',
            penerbit: 'Bentang Pustaka',
            kategori: 'Fiksi',
            genre: 'Novel',
            stok: 10
        }, {
            judul: 'Filosofi Teras',
            pengarang: 'Henry Manampiring',
            penerbit: 'Kompas',
            kategori: 'Non-Fiksi',
            genre: 'Pengembangan Diri',
            stok: 5
        }, {
            judul: 'Atomic Habits',
            pengarang: 'James Clear',
            penerbit: 'Gramedia Pustaka Utama',
            kategori: 'Non-Fiksi',
            genre: 'Petualangan',
            stok: 2
        }, {
            judul: 'Bumi Manusia',
            pengarang: 'Pramoedya Ananta Toer',
            penerbit: 'Hasta Mitra',
            kategori: 'Fiksi',
            genre: 'Novel Sejarah',
            stok: 0
        }, {
            judul: 'Laut Bercerita',
            pengarang: 'Leila S. Chudori',
            penerbit: 'Kepustakaan Populer Gramedia',
            kategori: 'Fiksi',
            genre: 'Novel Sejarah',
            stok: 12
        }, {
            judul: 'Dune',
            pengarang: 'Frank Herbert',
            penerbit: 'Berkley Publishing Group',
            kategori: 'Fiksi',
            genre: 'Fiksi Ilmiah',
            stok: 8
        }, {
            judul: 'The Hobbit',
            pengarang: 'J.R.R. Tolkien',
            penerbit: 'Allen & Unwin',
            kategori: 'Fiksi',
            genre: 'Fantasi',
            stok: 7
        }, {
            judul: 'It',
            pengarang: 'Stephen King',
            penerbit: 'Viking Press',
            kategori: 'Fiksi',
            genre: 'Horor',
            stok: 3
        }, {
            judul: 'Steve Jobs',
            pengarang: 'Walter Isaacson',
            penerbit: 'Simon & Schuster',
            kategori: 'Non-Fiksi',
            genre: 'Biografi',
            stok: 6
        }, {
            judul: 'Komik Jagoan Cilik',
            pengarang: 'Budi Hartono',
            penerbit: 'Elex Media Komputindo',
            kategori: 'Fiksi',
            genre: 'Komik',
            stok: 15
        }, {
            judul: 'A Brief History of Time',
            pengarang: 'Stephen Hawking',
            penerbit: 'Bantam Books',
            kategori: 'Non-Fiksi',
            genre: 'Sains',
            stok: 4
        }, ];

        function populateBooksTable(filteredBooks = books) {
            const bookTableBody = document.getElementById('bookTableBody');
            bookTableBody.innerHTML = '';
            if (filteredBooks.length === 0) {
                bookTableBody.innerHTML = '<tr><td colspan="9" style="text-align: center; padding: 20px;">Tidak ada buku yang ditemukan.</td></tr>';
                return;
            }

            filteredBooks.forEach((book, index) => {
                const row = document.createElement('tr');
                let stockClass = 'high';
                let stockText = book.stok;
                
                if (book.stok <= 5 && book.stok > 0) {
                    stockClass = 'low';
                } else if (book.stok === 0) {
                    stockClass = 'empty';
                    stockText = 'Habis';
                }
                
                row.innerHTML = `
                    <td class="col-no">${index + 1}</td>
                    <td class="col-cover"><img src="https://placehold.co/50x70/EFEFEF/666666?text=Cover" alt="Cover Buku ${book.judul}" class="book-cover"></td>
                    <td class="col-title"><strong>${book.judul}</strong></td>
                    <td class="col-author">${book.pengarang}</td>
                    <td class="col-publisher">${book.penerbit}</td>
                    <td class="col-category">${book.kategori}</td>
                    <td class="col-genre">${book.genre}</td>
                    <td class="col-stock"><span class="stock-badge ${stockClass}">${stockText}</span></td>
                    <td class="col-actions">
                        <div class="action-icons">
                            <a href="#" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" title="Hapus" style="color: #e74c3c;"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                `;
                bookTableBody.appendChild(row);
            });
        }

        function filterBooks() {
            const searchQuery = bookSearchInput.value.toLowerCase();
            const selectedKategori = kategoriFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedStok = stokFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedGenre = genreFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            const filteredBooks = books.filter(book => {
                const matchesSearch = book.judul.toLowerCase().includes(searchQuery) ||
                    book.pengarang.toLowerCase().includes(searchQuery) ||
                    book.penerbit.toLowerCase().includes(searchQuery);
                const matchesKategori = selectedKategori === '' || book.kategori.toLowerCase() === selectedKategori.toLowerCase();
                const matchesStok = selectedStok === '' ||
                    (selectedStok === 'high' && book.stok > 5) ||
                    (selectedStok === 'low' && book.stok >= 1 && book.stok <= 5) ||
                    (selectedStok === 'empty' && book.stok === 0);
                const matchesGenre = selectedGenre === '' || book.genre.toLowerCase() === selectedGenre.toLowerCase();

                return matchesSearch && matchesKategori && matchesStok && matchesGenre;
            });

            populateBooksTable(filteredBooks);
        }

        [kategoriFilterOptionsDiv, stokFilterOptionsDiv, genreFilterOptionsDiv].forEach(filterDiv => {
            filterDiv.addEventListener('click', (e) => {
                if (e.target.classList.contains('filter-option-item')) {
                    filterDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                    e.target.classList.add('selected');
                }
            });
        });

        resetFiltersBtn.addEventListener('click', () => {
            kategoriFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            stokFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            genreFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            bookSearchInput.value = '';
            filterBooks();
        });

        applyFiltersBtn.addEventListener('click', () => {
            filterBooks();
            modalOverlay.classList.remove('active');
        });

        bookSearchInput.addEventListener('keyup', filterBooks);

        window.onload = () => {
            populateBooksTable();
            filterBooks();
        };  