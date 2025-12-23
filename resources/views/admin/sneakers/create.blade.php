<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sepatu Baru</title>
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
                <input type="text" id="name" class="w-full border p-2 rounded mt-1 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: Nike Air Jordan" required>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Brand</label>
                    <input type="text" id="brand" class="w-full border p-2 rounded mt-1" placeholder="Nike, Adidas, dll" required>
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
                <textarea id="description" rows="3" class="w-full border p-2 rounded mt-1"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar Sepatu</label>
                <input type="file" id="image" class="w-full border p-2 rounded mt-1 bg-gray-50" accept="image/*">
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="/dashboard" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
                <button type="submit" id="btnSubmit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-bold">Simpan Data</button>
            </div>
        </form>
    </div>

    <script>
        const token = localStorage.getItem('jwt_token');
        if (!token) window.location.href = '/login';

        document.getElementById('createForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = document.getElementById('btnSubmit');
            btn.innerText = 'Menyimpan...';
            btn.disabled = true;

            // Siapkan Data (FormData untuk upload file)
            const formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('brand', document.getElementById('brand').value);
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
                        'Authorization': 'Bearer ' + token
                        // Jangan set Content-Type manual saat pakai FormData!
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Berhasil menambahkan sepatu!');
                    window.location.href = '/dashboard'; // Kembali ke dashboard
                } else {
                    alert('Gagal: ' + JSON.stringify(result));
                    btn.innerText = 'Simpan Data';
                    btn.disabled = false;
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan sistem.');
                btn.innerText = 'Simpan Data';
                btn.disabled = false;
            }
        });
    </script>
</body>
</html>
