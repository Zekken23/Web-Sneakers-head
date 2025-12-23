<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Sneaker - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">Tambah Sepatu Baru</h2>

        <form id="createForm" class="space-y-4">
            <div>
                <label class="block mb-1">Nama Sepatu</label>
                <input type="text" id="name" class="w-full border p-2 rounded" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1">Brand</label>
                    <input type="text" id="brand" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block mb-1">Size</label>
                    <input type="number" id="size" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div>
                <label class="block mb-1">Harga (Rp)</label>
                <input type="number" id="price" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1">URL Gambar</label>
                <input type="text" id="image" class="w-full border p-2 rounded" placeholder="https://example.com/sepatu.jpg">
            </div>
            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea id="description" class="w-full border p-2 rounded" rows="3"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Simpan Data</button>
            <a href="/dashboard" class="block text-center mt-2 text-gray-500 hover:underline">Batal</a>
        </form>
    </div>

    <script>
        document.getElementById('createForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const token = localStorage.getItem('jwt_token'); // AMBIL TOKEN

            const data = {
                name: document.getElementById('name').value,
                brand: document.getElementById('brand').value,
                size: document.getElementById('size').value,
                price: document.getElementById('price').value,
                image: document.getElementById('image').value,
                description: document.getElementById('description').value,
            };

            const response = await fetch('/api/sneakers', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token, // PROTEKSI JWT [cite: 32]
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert('Berhasil menambah sepatu!');
                window.location.href = '/dashboard';
            } else {
                alert('Gagal menambahkan data.');
            }
        });
    </script>
</body>
</html>
