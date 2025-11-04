document.addEventListener('DOMContentLoaded', () => {

    // --- ScrollReveal Animation ---
    const sr = ScrollReveal({
        origin: 'bottom',
        distance: '60px',
        duration: 1000,
        delay: 200,
        reset: false, 
    });

    sr.reveal('.reveal-up', { origin: 'bottom' });
    sr.reveal('.reveal-left', { origin: 'left', distance: '100px' });
    sr.reveal('.reveal-right', { origin: 'right' });
    
    sr.reveal('.reveal-card', {
        interval: 100,
        origin: 'bottom',
        distance: '50px',
        delay: (el) => el.style.getPropertyValue('--delay') || 0
    });
    
    const scrollers = document.querySelectorAll(".scroller");

    if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        addAnimation();
    }

    function addAnimation() {
        scrollers.forEach((scroller) => {
            scroller.setAttribute("data-animated", true);
            const scrollerInner = scroller.querySelector(".scroller__inner");
            const scrollerContent = Array.from(scrollerInner.children);

            scrollerContent.forEach((item) => {
                const duplicatedItem = item.cloneNode(true);
                duplicatedItem.setAttribute("aria-hidden", true);
                scrollerInner.appendChild(duplicatedItem);
            });
        });
    }

    // --- Efek Hover Dinamis pada New Arrivals ---
    const newArrivalsCards = document.querySelectorAll('#new-arrivals .reveal-card');

    newArrivalsCards.forEach(card => {
        // ... (Kode hover Anda tetap di sini) ...
    });

    fetchGalleryImages();

}); // <-- AKHIR DARI 'DOMContentLoaded'

async function fetchGalleryImages() {
    const container = document.getElementById('gallery-container');
    const loadingMessage = document.getElementById('gallery-loading');

    // Jika container tidak ada di halaman ini, hentikan fungsi
    if (!container || !loadingMessage) {
        return; 
    }
    
    // API Endpoint yang Anda berikan
    const apiUrl = 'https://api.ryzumi.vip/api/search/pinterest?query=sneakers';

    // Opsi untuk fetch, termasuk header dari 'curl' Anda
    const options = {
        method: 'GET',
        headers: {
            'accept': 'application/json'
        }
    };

    try {
        // 1. Fetch data dari API (Method GET + Headers)
        // Ini memenuhi poin "async/await" dan "method GET"
        const response = await fetch(apiUrl, options);

        // 2. Cek jika response gagal
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        // 3. Ubah response menjadi JSON
        // Berdasarkan contoh Anda, 'data' adalah sebuah array: [item1, item2, ...]
        const data = await response.json(); 

        // 4. Cek jika API menemukan gambar
        if (!data || data.length === 0) {
            loadingMessage.textContent = 'Gambar tidak ditemukan.';
            return;
        }

        // 5. Bersihkan pesan loading
        loadingMessage.remove();

        // 6. Tampilkan gambar ke UI (dinamis)
        // Kita ambil 10 gambar pertama dan gunakan 'item.directLink'
        data.slice(0, 10).forEach(item => {
            const imgWrapper = document.createElement('div');
            imgWrapper.className = 'w-full h-64 bg-[#0F172A] rounded-lg overflow-hidden shadow-lg reveal-card';
            
            // Gunakan 'item.directLink' untuk gambar, 'item.link' untuk klik
            const imageUrl = item.directLink;
            const pinterestLink = item.link;
            
            imgWrapper.innerHTML = `
                <a href="${pinterestLink}" target="_blank">
                    <img src="${imageUrl}" alt="Sneaker Gallery Image" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                </a>
            `;
            container.appendChild(imgWrapper);
        });

    } catch (error) {
        // 7. Tampilkan pesan jika terjadi error
        console.error('Gagal mengambil data galeri:', error);
        loadingMessage.textContent = 'Gagal memuat galeri. Coba lagi nanti.';
        loadingMessage.classList.add('text-red-500');
    }
}