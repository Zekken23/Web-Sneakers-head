<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sepatu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Data Sepatu</h2>

        <form id="editForm" class="space-y-4">
            <input type="hidden" id="sneakerId">

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Sepatu</label>
                <input type="text" id="name" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" class="w-full border p-2 rounded mt-1" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="number" id="size" class="w-full border p-2 rounded mt-1" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" id="price" class="w-full border p-2 rounded mt-1" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" id="stock" class="w-full border p-2 rounded mt-1" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" rows="3" class="w-full border p-2 rounded mt-1"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>
                <input type="file" id="image" class="w-full border p-2 rounded mt-1 bg-gray-50" accept="image/*">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>

                <div id="currentImageContainer" class="mt-2 hidden">
                    <p class="text-sm text-gray-600 mb-1">Gambar Saat Ini:</p>
                    <img id="previewImage" src="" alt="Preview" class="w-24 h-24 object-cover rounded border">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="/dashboard" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
                <button type="submit" id="btnSubmit" class="px-6 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 font-bold">Update Data</button>
            </div>
        </form>
    </div>

    <script>
        const token = localStorage.getItem('jwt_token');
        if (!token) window.location.href = '/login';

        // 1. Ambil ID dari URL (contoh: ?id=3)
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');

        if (!id) {
            alert('ID Sepatu tidak ditemukan!');
            window.location.href = '/dashboard';
        }

        // 2. Load Data Lama saat Halaman Dibuka
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const response = await fetch(`/api/sneakers/${id}`);
                const result = await response.json();

                if (!result.data) {
                    alert('Data tidak ditemukan!');
                    window.location.href = '/dashboard';
                    return;
                }

                const item = result.data;

                // Isi Form dengan Data Lama
                document.getElementById('sneakerId').value = item.id;
                document.getElementById('name').value = item.name;
                document.getElementById('brand').value = item.brand;
                document.getElementById('size').value = item.size;
                document.getElementById('price').value = item.price;
                document.getElementById('stock').value = item.stock;
                document.getElementById('description').value = item.description || '';

                // Tampilkan Preview Gambar Lama
                if (item.image) {
                    const imgUrl = item.image.startsWith('http') ? item.image : `/storage/${item.image}`;
                    document.getElementById('previewImage').src = imgUrl;
                    document.getElementById('currentImageContainer').classList.remove('hidden');
                }

            } catch (error) {
                console.error(error);
                alert('Gagal mengambil data.');
            }
        });

        // 3. Proses Update Data
        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = document.getElementById('btnSubmit');
            btn.innerText = 'Mengupdate...';
            btn.disabled = true;

            // Pakai FormData karena ada potensi upload file
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('brand', document.getElementById('brand').value);
            formData.append('size', document.getElementById('size').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('stock', document.getElementById('stock').value);
            formData.append('description', document.getElementById('description').value);

            // Cek ada gambar baru atau tidak
            const imageFile = document.getElementById('image').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            // PENTING: Method Spoofing untuk Laravel (karena FormData cuma support POST)


            try {
                const response = await fetch(`/api/sneakers/${id}`, {
                    method: 'POST', // Gunakan POST tapi ada _method: PUT di dalamnya
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Berhasil update data!');
                    window.location.href = '/dashboard';
                } else {
                    alert('Gagal: ' + (result.message || JSON.stringify(result)));
                    btn.innerText = 'Update Data';
                    btn.disabled = false;
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan sistem.');
                btn.innerText = 'Update Data';
                btn.disabled = false;
            }
        });
    </script>
</body>
</html>
