<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <div class="text-xl font-bold text-blue-600">
            Sneakershead.co <span class="text-sm text-gray-500 font-normal">Admin Area</span>
        </div>

        <div class="flex items-center gap-6">
            <a href="/" class="text-gray-600 hover:text-blue-600 font-medium transition duration-200">
                Home
            </a>
            <button id="logoutBtn" class="text-red-500 hover:text-red-700 font-medium">
                Logout
            </button>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Daftar Produk Sepatu</h2>
            <a href="/sneakers/create" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow">+ Tambah Sepatu</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">Gambar</th>
                        <th class="py-3 px-6">Nama Produk</th>
                        <th class="py-3 px-6">Brand</th>
                        <th class="py-3 px-6">Size</th>
                        <th class="py-3 px-6">Harga</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sneakerTable" class="text-gray-600 text-sm font-light">
                    <tr>
                        <td colspan="6" class="text-center py-4">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-gray-500 text-sm" id="paginationInfo"></div>
    </div>

    <script>
        const token = localStorage.getItem('jwt_token');

        // Cek Login
        if (!token) {
            alert('Anda belum login!');
            window.location.href = '/login';
        }

        // Fungsi Load Data
        async function loadSneakers() {
            try {
                // Fetch ke API Sneakers
                const response = await fetch('/api/sneakers');
                const result = await response.json();

                const tableBody = document.getElementById('sneakerTable');
                tableBody.innerHTML = ''; // Kosongkan tabel

                // Ambil array data dari hasil pagination Laravel
                const sneakers = result.data.data;

                if (!sneakers || sneakers.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Belum ada data sepatu.</td></tr>';
                    return;
                }

                sneakers.forEach(item => {
                    // Logic URL Gambar
                    let imageUrl = item.image;
                    if (item.image && !item.image.startsWith('http')) {
                        imageUrl = `/storage/${item.image}`;
                    } else if (!item.image) {
                        imageUrl = 'https://via.placeholder.com/100?text=No+Image';
                    }

                    // --- PERUBAHAN PENTING DI SINI (BRAND) ---
                    // Cek apakah item.brand ada (tidak null)
                    const brandName = item.brand ? item.brand.name : '-';

                    const row = `
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">
                                <img src="${imageUrl}" class="w-16 h-16 object-cover rounded shadow-sm" alt="Sepatu">
                            </td>
                            <td class="py-3 px-6 font-medium text-gray-800">${item.name}</td>
                            <td class="py-3 px-6">${brandName}</td>
                            <td class="py-3 px-6">${item.size || '-'}</td>
                            <td class="py-3 px-6 text-green-600 font-bold">Rp ${parseInt(item.price).toLocaleString('id-ID')}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center gap-2">
                                    <a href="/sneakers/edit?id=${item.id}" class="w-8 h-8 flex items-center justify-center bg-yellow-100 text-yellow-600 rounded hover:bg-yellow-200 transition">
                                        ✏️
                                    </a>
                                    <button onclick="deleteSneaker(${item.id})" class="w-8 h-8 flex items-center justify-center bg-red-100 text-red-600 rounded hover:bg-red-200 transition">
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });

                // Update info pagination
                document.getElementById('paginationInfo').innerText = `Menampilkan ${sneakers.length} data dari total ${result.data.total} sepatu.`;

            } catch (error) {
                console.error(error);
                document.getElementById('sneakerTable').innerHTML = '<tr><td colspan="6" class="text-center py-4 text-red-500">Gagal mengambil data server. Cek console.</td></tr>';
            }
        }

        // Fungsi Hapus
        async function deleteSneaker(id) {
            if(!confirm('Yakin ingin menghapus sepatu ini?')) return;

            try {
                const response = await fetch(`/api/sneakers/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    alert('Berhasil dihapus!');
                    loadSneakers(); // Refresh tabel
                } else {
                    alert('Gagal menghapus.');
                }
            } catch (err) {
                alert('Error koneksi.');
            }
        }

        // Fungsi Logout
        async function logout() {
            const token = localStorage.getItem('jwt_token');
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });
            } catch (error) {
                console.log('Logout server skip, lanjut logout lokal.');
            }

            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user_data');
            window.location.href = '/login';
        }

        // Event Listener Logout
        const btnLogout = document.getElementById('logoutBtn');
        if (btnLogout) {
            btnLogout.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin keluar?')) {
                    this.innerText = 'Keluar...';
                    logout();
                }
            });
        }

        // Jalankan saat halaman dibuka
        loadSneakers();
    </script>
</body>
</html>
