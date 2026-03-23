
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

        let books = [];

        async function fetchBooks() {

            try {
                const res = await fetch('/api/books');
                const json = await res.json();

                // sesuaikan dengan struktur API kamu
                books = json.data ?? json;

                populateBooksTable(books);
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
                let stockClass = 'high';
                if (book.stok <= 5 && book.stok > 0) {
                    stockClass = 'low';
                } else if (book.stok === 0) {
                    stockClass = 'empty';
                }
                row.innerHTML = `
                <td>${index + 1}</td>
                <td><img src="https://placehold.co/50x70/png" alt="Cover Buku ${book.judul}" class="book-cover"></td>
                <td>${book.judul}</td>
                <td>${book.pengarang}</td>
                <td>${book.penerbit}</td>
                <td>${book.kategori}</td>
                <td>${book.genre}</td>
                <td><span class="stock-badge ${stockClass}">${book.stok}</span></td>
                <td>
                    <a href="#" style="color: var(--primary-color); margin-right: 5px;"><i class="fas fa-edit"></i></a>
                    <a href="#" style="color: #e74c3c;"><i class="fas fa-trash-alt"></i></a>
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

        window.onload = async() => {
            await fetchBooks();
            filterBooks();
        };  