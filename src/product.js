// Menunggu halaman HTML selesai dimuat
document.addEventListener('DOMContentLoaded', () => {

    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const container = document.getElementById('product-container');
    const loadingMessage = document.getElementById('loading-message');

    /**
     * Fungsi utama untuk mengambil dan menampilkan data produk dari DummyJSON.
     * @param {string} sneakers - Kata kunci pencarian (cth: "sneakers", "phone")
     */
    async function fetchProducts(sneakers) {
        // Tampilkan pesan loading
        loadingMessage.style.display = 'block';
        container.innerHTML = '';
        container.appendChild(loadingMessage);

        // API Endpoint dari DummyJSON yang mendukung search
        const apiUrl = `https://dummyjson.com/products/search?q=${sneakers}`;

        try {
            // 1. Fetch data dari API (Method GET adalah default)
            const response = await fetch(apiUrl);

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();

            // 4. Sembunyikan pesan loading
            loadingMessage.style.display = 'none';
            container.innerHTML = ''; // Bersihkan container

            // 5. Cek jika API tidak menemukan produk
            if (data.products.length === 0) {
                container.innerHTML = '<p class="text-center text-gray-400 col-span-4">Produk tidak ditemukan.</p>';
                return;
            }

            // 6. Tampilkan data secara dinamis ke UI (sesuai Modul 3)
            data.products.forEach(product => {
                const card = document.createElement('div');
                card.className = 'bg-[#1E293B] rounded-lg overflow-hidden shadow-lg flex flex-col transition-transform duration-300 hover:scale-105';
                
                card.innerHTML = `
                    <div class="relative w-full h-56">
                        <img src="${product.thumbnail}" alt="${product.title}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-bold text-xl mb-2 flex-grow min-h-[60px]">${product.title}</h3>
                        <p class="text-gray-400 text-sm mb-2">${product.category}</p>
                        <p class="text-teal-400 text-2xl font-bold mb-4">$${product.price}</p>
                        <a href="#" class="mt-auto w-full text-center bg-gradient-to-r from-purple-600 to-teal-500 text-white font-bold py-2 px-4 rounded-md hover:shadow-lg transition-all">
                            View Details
                        </a>
                    </div>
                `;
                container.appendChild(card);
            });

        } catch (error) {
            // 7. Tampilkan pesan jika terjadi error
            console.error('Gagal mengambil data produk:', error);
            loadingMessage.style.display = 'none';
            container.innerHTML = '<p class="text-center text-red-500 col-span-4">Gagal memuat data. Periksa koneksi internet Anda.</p>';
        }
    }

    // Event listener untuk form pencarian
    searchForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Mencegah halaman refresh
        const searchTerm = searchInput.value;
        if (searchTerm) {
            fetchProducts(searchTerm);
        }
    });

    // Otomatis mencari "shoes" saat halaman pertama kali dibuka
    // (DummyJSON tidak punya data 'sneakers', tapi punya 'shoes')
    fetchProducts('sneaker');
});