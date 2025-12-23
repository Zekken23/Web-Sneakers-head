<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#0F172A] text-white">

    <nav class="container mx-auto px-6 py-4 flex justify-between items-center border-b border-gray-800">
        <a href="/" class="text-2xl font-bold tracking-tighter">Sneakershead<span class="text-[#2DD4BF]">.co</span></a>
        <a href="/" class="text-gray-400 hover:text-white transition">Kembali Belanja</a>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-8">Keranjang Anda</h1>

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3">
                <div class="bg-[#1E293B] rounded-xl overflow-hidden shadow-lg border border-gray-700">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-800 text-gray-400 text-sm uppercase">
                                <th class="p-4">Produk</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4 text-center">Qty</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="cartTableBody">
                            </tbody>
                    </table>
                    <div id="emptyCartMessage" class="hidden p-8 text-center text-gray-500">
                        Keranjang masih kosong.
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-[#1E293B] p-6 rounded-xl shadow-lg border border-gray-700 sticky top-10">
                    <h3 class="text-xl font-bold mb-4 border-b border-gray-700 pb-4">Ringkasan Pesanan</h3>
                    <div class="flex justify-between mb-2 text-gray-300">
                        <span>Total Item</span>
                        <span id="totalItems">0</span>
                    </div>
                    <div class="flex justify-between mb-6 text-xl font-bold text-[#2DD4BF]">
                        <span>Total Harga</span>
                        <span id="totalPrice">Rp 0</span>
                    </div>
                    <button onclick="processCheckout()" id="btnCheckout" class="w-full bg-[#2DD4BF] text-[#0F172A] font-bold py-3 rounded-lg hover:bg-[#20b2aa] transition shadow-lg">
                        Checkout Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cek Login Dulu
        const token = localStorage.getItem('jwt_token');
        if (!token) {
            alert('Silakan login terlebih dahulu!');
            window.location.href = '/login';
        }

        // Load Cart saat halaman dibuka
        document.addEventListener('DOMContentLoaded', renderCart);

        // --- FUNGSI RENDER CART ---
        function renderCart() {
            const cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            const tbody = document.getElementById('cartTableBody');
            const emptyMsg = document.getElementById('emptyCartMessage');

            tbody.innerHTML = '';
            let grandTotal = 0;
            let totalQty = 0;

            if (cart.length === 0) {
                emptyMsg.classList.remove('hidden');
                document.getElementById('btnCheckout').disabled = true;
                document.getElementById('btnCheckout').classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                emptyMsg.classList.add('hidden');
                document.getElementById('btnCheckout').disabled = false;
                document.getElementById('btnCheckout').classList.remove('opacity-50', 'cursor-not-allowed');

                cart.forEach((item, index) => {
                    const totalItemPrice = item.price * item.quantity;
                    grandTotal += totalItemPrice;
                    totalQty += item.quantity;

                    // Gambar (Handle link luar vs storage)
                    let imgUrl = 'https://via.placeholder.com/80';
                    if(item.image) imgUrl = item.image.startsWith('http') ? item.image : `/storage/${item.image}`;

                    const row = `
                        <tr class="border-b border-gray-700 last:border-0 hover:bg-gray-700/50 transition">
                            <td class="p-4 flex items-center gap-4">
                                <img src="${imgUrl}" class="w-16 h-16 object-cover rounded-md bg-gray-800">
                                <div>
                                    <h4 class="font-bold text-white">${item.name}</h4>
                                    <p class="text-sm text-gray-400">${item.brand} - Size ${item.size}</p>
                                </div>
                            </td>
                            <td class="p-4 text-[#2DD4BF] font-medium">
                                Rp ${new Intl.NumberFormat('id-ID').format(item.price)}
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="updateQty(${index}, -1)" class="w-6 h-6 rounded bg-gray-600 hover:bg-gray-500">-</button>
                                    <span class="w-4">${item.quantity}</span>
                                    <button onclick="updateQty(${index}, 1)" class="w-6 h-6 rounded bg-gray-600 hover:bg-gray-500">+</button>
                                </div>
                            </td>
                            <td class="p-4 text-right">
                                <button onclick="removeItem(${index})" class="text-red-400 hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            }

            document.getElementById('totalItems').innerText = totalQty + ' Pcs';
            document.getElementById('totalPrice').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
        }

        // --- FUNGSI UPDATE QTY ---
        function updateQty(index, change) {
            let cart = JSON.parse(localStorage.getItem('cart_items')) || [];

            if (cart[index].quantity + change > 0) {
                cart[index].quantity += change;
                localStorage.setItem('cart_items', JSON.stringify(cart));
                renderCart();
            }
        }

        // --- FUNGSI HAPUS ITEM ---
        function removeItem(index) {
            if(!confirm('Hapus item ini?')) return;
            let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart_items', JSON.stringify(cart));
            renderCart();
        }

        // --- FUNGSI CHECKOUT KE SERVER ---
        async function processCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            const btn = document.getElementById('btnCheckout');

            // Hitung Total Ulang untuk dikirim
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            if(cart.length === 0) return;

            btn.innerText = 'Memproses...';
            btn.disabled = true;

            try {
                const response = await fetch('/api/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token // Wajib Token JWT
                    },
                    body: JSON.stringify({
                        items: cart, // Kirim array cart
                        total_price: totalPrice
                    })
                });

                const result = await response.json();

                if (response.ok) {
                    alert('Checkout Berhasil! Terima kasih sudah berbelanja.');
                    localStorage.removeItem('cart_items'); // Kosongkan keranjang
                    window.location.href = '/dashboard'; // Redirect ke dashboard (atau halaman sukses)
                } else {
                    alert('Gagal Checkout: ' + (result.message || 'Error server'));
                    btn.innerText = 'Checkout Sekarang';
                    btn.disabled = false;
                }

            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan koneksi.');
                btn.innerText = 'Checkout Sekarang';
                btn.disabled = false;
            }
        }
    </script>
</body>
</html>
