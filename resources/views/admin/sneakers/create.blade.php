<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sepatu - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Data Sepatu</h2>

        <form id="createForm" class="space-y-4">

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Sepatu</label>
                <input type="text" id="name" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Air Jordan 1" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand</label>
                    <select id="brand_id" class="w-full border p-2 rounded mt-1 bg-white focus:ring-2 focus:ring-blue-500 outline-none" required>
                        <option value="">-- Pilih Brand --</option>
                        <option value="" disabled>Memuat data...</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Size</label>
                    <input type="number" id="size" class="w-full border p-2 rounded mt-1" placeholder="42" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" id="price" class="w-full border p-2 rounded mt-1" placeholder="1500000" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" id="stock" class="w-full border p-2 rounded mt-1" placeholder="10" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" rows="3" class="w-full border p-2 rounded mt-1" placeholder="Deskripsi singkat sepatu..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Gambar</label>
                <input type="file" id="image" class="w-full border p-2 rounded mt-1 bg-gray-50" accept="image/*" required>
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maks: 5MB.</p>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="/dashboard" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</a>
                <button type="submit" id="btnSubmit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-bold transition shadow">Simpan Data</button>
            </div>
        </form>
    </div>

    <script>
        const token = localStorage.getItem('jwt_token');

        // 1. Cek Login
        if (!token) {
            alert('Anda belum login!');
            window.location.href = '/login';
        }

        // 2. Load Data Brand untuk Dropdown
        async function loadBrands() {
            try {
                const response = await fetch('/api/brands', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Gagal mengambil data brand');

                const brands = await response.json();
                const select = document.getElementById('brand_id');

                // Reset isi select
                select.innerHTML = '<option value="">-- Pilih Brand --</option>';

                // Loop data brand ke dalam option
                brands.forEach(brand => {
                    const option = document.createElement('option');
                    option.value = brand.id; // Value adalah ID
                    option.text = brand.name; // Tampilan adalah Nama
                    select.appendChild(option);
                });

            } catch (error) {
                console.error(error);
                alert('Gagal memuat daftar brand. Pastikan API /api/brands sudah dibuat.');
            }
        }

        // 3. Proses Submit Form
        document.getElementById('createForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = document.getElementById('btnSubmit');
            btn.innerText = 'Menyimpan...';
            btn.disabled = true;

            // Gunakan FormData untuk kirim data + file
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('brand_id', document.getElementById('brand_id').value); // Kirim ID Brand
            formData.append('size', document.getElementById('size').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('stock', document.getElementById('stock').value);
            formData.append('description', document.getElementById('description').value);

            const imageFile = document.getElementById('image').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            try {
                const response = await fetch('/api/sneakers', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                        // Jangan set 'Content-Type' saat pakai FormData, browser akan mengaturnya otomatis
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Berhasil menambah sepatu baru!');
                    window.location.href = '/dashboard';
                } else {
                    // Tampilkan pesan error validasi
                    console.error('Validation Error:', result);
                    alert('Gagal: ' + (result.message || JSON.stringify(result)));
                    btn.innerText = 'Simpan Data';
                    btn.disabled = false;
                }

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan koneksi.');
                btn.innerText = 'Simpan Data';
                btn.disabled = false;
            }
        });

        // Jalankan fungsi load brand saat halaman dibuka
        loadBrands();

    </script>
</body>
</html>
