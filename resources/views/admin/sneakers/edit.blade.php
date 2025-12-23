<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Sneaker - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6 text-yellow-600">Edit Sepatu</h2>
        <form id="editForm" class="space-y-4">
            <input type="hidden" id="sneakerId">
            <div><label>Nama</label><input type="text" id="name" class="w-full border p-2 rounded"></div>
            <div><label>Brand</label><input type="text" id="brand" class="w-full border p-2 rounded"></div>
            <div><label>Size</label><input type="number" id="size" class="w-full border p-2 rounded"></div>
            <div><label>Harga</label><input type="number" id="price" class="w-full border p-2 rounded"></div>
            <div><label>URL Gambar</label><input type="text" id="image" class="w-full border p-2 rounded"></div>
            <div><label>Deskripsi</label><textarea id="description" class="w-full border p-2 rounded"></textarea></div>

            <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">Update Data</button>
        </form>
    </div>

    <script>
        const token = localStorage.getItem('jwt_token');
        // Ambil ID dari URL (contoh: /edit?id=1)
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');

        // 1. Load Data Lama
        async function loadData() {
            const response = await fetch(`/api/sneakers/${id}`, {
                headers: { 'Authorization': 'Bearer ' + token }
            });
            const data = await response.json();

            document.getElementById('sneakerId').value = data.id;
            document.getElementById('name').value = data.name;
            document.getElementById('brand').value = data.brand;
            document.getElementById('size').value = data.size;
            document.getElementById('price').value = data.price;
            document.getElementById('image').value = data.image;
            document.getElementById('description').value = data.description;
        }

        // 2. Kirim Update
        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const data = {
                name: document.getElementById('name').value,
                brand: document.getElementById('brand').value,
                size: document.getElementById('size').value,
                price: document.getElementById('price').value,
                image: document.getElementById('image').value,
                description: document.getElementById('description').value,
            };

            const response = await fetch(`/api/sneakers/${id}`, {
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + token, // WAJIB JWT
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                alert('Data berhasil diupdate!');
                window.location.href = '/dashboard';
            }
        });

        loadData();
    </script>
</body>
</html>
