        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');
        const memberSearchInput = document.getElementById('memberSearch');

        const openFilterModalBtn = document.getElementById('openFilterModal');
        const closeFilterModalBtn = document.getElementById('closeFilterModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const filterModal = document.getElementById('filterModal');

        const typeFilterOptionsDiv = document.getElementById('typeFilterOptions');
        const tingkatFilterOptionsDiv = document.getElementById('tingkatFilterOptions');
        const jurusanFilterOptionsDiv = document.getElementById('jurusanFilterOptions');
        const nomorKelasFilterOptionsDiv = document.getElementById('nomorKelasFilterOptions');

        const tingkatFilterGroup = document.getElementById('tingkatFilterGroup');
        const jurusanFilterGroup = document.getElementById('jurusanFilterGroup');
        const nomorKelasFilterGroup = document.getElementById('nomorKelasFilterGroup');

        const resetFiltersBtn = document.getElementById('resetFiltersBtn');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');

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

        // Dummy data yang diperbarui agar sesuai dengan kolom baru
        const members = [{
            nama: 'Dinda Permata',
            kelas: 'XII TKJ 1',
            username: 'dindaa',
            password: 'dinda123',
            role: 'User',
            tingkat: 'XII',
            jurusan: 'TKJ',
            sub_kelas: '1',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        }, {
            nama: 'Budi Santoso',
            kelas: 'XI RPL 2',
            username: 'budisanto',
            password: 'budi123',
            role: 'User',
            tingkat: 'XI',
            jurusan: 'RPL',
            sub_kelas: '2',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        },{
            nama: 'ihaq',
            kelas: 'XII RPL 2',
            username: 'bonek',
            password: 'cihuy',
            role: 'User',
            tingkat: 'XII',
            jurusan: 'RPL',
            sub_kelas: '2',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        },{
            nama: 'Siti Rahayu',
            kelas: 'X TSM 3',
            username: 'sitirahayu',
            password: 'siti123',
            role: 'User',
            tingkat: 'X',
            jurusan: 'TSM',
            sub_kelas: '3',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        }, {
            nama: 'Admin Utama',
            kelas: '-',
            username: 'admin',
            password: 'admin',
            role: 'Admin',
            tingkat: '',
            jurusan: '',
            sub_kelas: '',
            type: 'Admin',
            foto: 'https://placehold.co/30x30/png'
        }];

        function populateMembersTable() {
            const memberTableBody = document.getElementById('memberTableBody');
            memberTableBody.innerHTML = '';
            members.forEach((member, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td><img src="${member.foto}" alt="Foto ${member.nama}" class="member-photo"></td>
                <td>${member.nama}</td>
                <td>${member.kelas}</td>
                <td>${member.username}</td>
                <td>${member.password}</td>
                <td>${member.role}</td>
                <td class="action-icons">
                    <a href="#" style="color: var(--primary-color); margin-right: 5px;"><i class="fas fa-edit"></i></a>
                    <a href="#" style="color: #e74c3c;"><i class="fas fa-trash-alt"></i></a>
                </td>
            `;
                memberTableBody.appendChild(row);
            });
        }

        function filterMembers() {
            const selectedType = typeFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedTingkat = tingkatFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedJurusan = jurusanFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedNomorKelas = nomorKelasFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            const searchTerm = memberSearchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#memberTableBody tr');

            rows.forEach(row => {
                const rowName = row.cells[2].textContent.toLowerCase();
                const memberIndex = parseInt(row.cells[0].textContent) - 1;
                const memberData = members[memberIndex];

                const typeMatch = selectedType === '' || memberData.type === selectedType;
                const tingkatMatch = selectedTingkat === '' || memberData.tingkat === selectedTingkat;
                const jurusanMatch = selectedJurusan === '' || memberData.jurusan === selectedJurusan;
                const nomorKelasMatch = selectedNomorKelas === '' || memberData.sub_kelas === selectedNomorKelas;
                const searchMatch = rowName.includes(searchTerm);

                if (typeMatch && tingkatMatch && jurusanMatch && nomorKelasMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function updateFilterUI() {
            const selectedType = typeFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            if (selectedType === 'Admin') {
                tingkatFilterGroup.classList.add('disabled');
                jurusanFilterGroup.classList.add('disabled');
                nomorKelasFilterGroup.classList.add('disabled');

                tingkatFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });
                jurusanFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });
                nomorKelasFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });

            } else {
                tingkatFilterGroup.classList.remove('disabled');
                jurusanFilterGroup.classList.remove('disabled');
                nomorKelasFilterGroup.classList.remove('disabled');
            }
        }


        function resetFilters() {
            typeFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') {
                    opt.classList.add('selected');
                }
            });

            tingkatFilterGroup.classList.remove('disabled');
            jurusanFilterGroup.classList.remove('disabled');
            nomorKelasFilterGroup.classList.remove('disabled');

            tingkatFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });
            jurusanFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });
            nomorKelasFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });

            memberSearchInput.value = '';
            filterMembers();
        }

        openFilterModalBtn.addEventListener('click', () => {
            modalOverlay.classList.add('active');
        });

        closeFilterModalBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        typeFilterOptionsDiv.addEventListener('click', (e) => {
            if (e.target.classList.contains('filter-option-item')) {
                typeFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                e.target.classList.add('selected');
                updateFilterUI();
            }
        });

        [tingkatFilterOptionsDiv, jurusanFilterOptionsDiv, nomorKelasFilterOptionsDiv].forEach(filterDiv => {
            filterDiv.addEventListener('click', (e) => {
                if (e.target.classList.contains('filter-option-item') && !filterDiv.parentElement.classList.contains('disabled')) {
                    filterDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                    e.target.classList.add('selected');
                }
            });
        });

        resetFiltersBtn.addEventListener('click', resetFilters);
        applyFiltersBtn.addEventListener('click', () => {
            filterMembers();
            modalOverlay.classList.remove('active');
        });

        memberSearchInput.addEventListener('keyup', filterMembers);

        window.onload = () => {
            populateMembersTable();
            filterMembers();
        };