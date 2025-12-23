document.addEventListener('DOMContentLoaded', () => {

    // 1. SETUP ANIMASI SCROLLREVEAL (Bisa dihapus jika tidak ingin animasi)
    const sr = ScrollReveal({
        origin: 'bottom',
        distance: '60px',
        duration: 1000,
        delay: 200,
        reset: false, // Animasi hanya terjadi sekali (biar tidak pusing)
    });

    sr.reveal('.reveal-up', { origin: 'bottom' });
    sr.reveal('.reveal-left', { origin: 'left', distance: '60px' });
    sr.reveal('.reveal-right', { origin: 'right', distance: '60px' });
    sr.reveal('.reveal-card', { interval: 100 });

    // 2. CEK STATUS LOGIN
    checkLoginStatus();

    // 3. LOAD DATA NEW ARRIVALS
    loadNewArrivals();
});

// --- FUNGSI CEK LOGIN ---
function checkLoginStatus() {
    const token = localStorage.getItem('jwt_token');
    const userString = localStorage.getItem('user_data');
    const authContainer = document.getElementById('auth-buttons');
    const heroAdminBtn = document.getElementById('hero-admin-btn');

    if (token && userString) {
        const user = JSON.parse(userString);
        let buttonsHtml = '';

        if (user.role === 'admin') {
            buttonsHtml += `
                <a href="/dashboard" class="px-5 py-2 bg-[#2DD4BF] text-[#0F172A] rounded-full font-bold text-sm hover:bg-[#1f9d8d] transition shadow-lg">
                    Dashboard Admin
                </a>
            `;
            if(heroAdminBtn) heroAdminBtn.classList.remove('hidden');
        } else {
            buttonsHtml += `
                <div class="flex items-center space-x-3 bg-[#1E293B] py-1 px-3 rounded-full border border-gray-700">
                    <img src="https://ui-avatars.com/api/?name=${user.name}&background=2DD4BF&color=0F172A" class="w-8 h-8 rounded-full">
                    <span class="font-medium text-sm text-gray-300">Hi, ${user.name.split(' ')[0]}</span>
                </div>
            `;
        }

        buttonsHtml += `
            <button onclick="logout()" class="text-gray-400 hover:text-red-500 text-sm font-medium ml-2 transition" title="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </button>
        `;
        authContainer.innerHTML = buttonsHtml;
    }
}

// --- FUNGSI LOGOUT (Global) ---
function logout() {
    if(confirm('Yakin ingin logout?')) {
        localStorage.removeItem('jwt_token');
        localStorage.removeItem('user_data');
        window.location.reload();
    }
}

// --- FUNGSI LOAD DATA (Anti-Rusak UI) ---
async function loadNewArrivals() {
    const container = document.getElementById('landing-sneaker-container');

    try {
        const response = await fetch('/api/sneakers');
        const result = await response.json();

        // Ambil data (handle pagination structure)
        const sneakers = result.data?.data || result.data || [];

        // Hapus loading spinner
        container.innerHTML = '';

        if (!sneakers || sneakers.length === 0) {
            container.innerHTML = `<div class="col-span-full text-center py-10 text-gray-500">Belum ada koleksi terbaru.</div>`;
            return;
        }

        const latestSneakers = sneakers.slice(0, 4);
        let htmlContent = '';

        latestSneakers.forEach((item, index) => {
            // Logic Gambar
            let imageUrl = 'https://via.placeholder.com/400x400?text=No+Image';
            if (item.image) {
                imageUrl = item.image.startsWith('http') ? item.image : `/storage/${item.image}`;
            }

            // Logic Harga
            const price = item.price || 0;
            const hargaRupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency', currency: 'IDR', minimumFractionDigits: 0
            }).format(price);

            // HTML Card (Fixed Height & Layout)
            htmlContent += `
                <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group reveal-card h-full flex flex-col" style="transition-delay: ${index * 100}ms;">
                    <div class="relative h-64 w-full bg-gray-800 overflow-hidden shrink-0">
                        <img src="${imageUrl}" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://via.placeholder.com/400x400?text=Error'">
                        <div class="absolute top-4 right-4 bg-[#2DD4BF] text-[#0F172A] text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">NEW</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow justify-between">
                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-white mb-1 truncate" title="${item.name}">${item.name || 'Tanpa Nama'}</h3>
                            <p class="text-gray-400 text-sm truncate">${item.brand || 'Brand'} ${item.size ? '• ' + item.size : ''}</p>
                        </div>
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-xl font-bold text-[#2DD4BF]">${hargaRupiah}</span>
                            <button class="bg-white/10 w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        container.innerHTML = htmlContent;

        // Sync animasi jika ada item baru
        if(typeof ScrollReveal !== 'undefined') {
            ScrollReveal().sync();
        }

    } catch (error) {
        console.error('Gagal fetch data:', error);
        container.innerHTML = `<div class="col-span-full text-center text-red-400">Gagal memuat data.</div>`;
    }
}
