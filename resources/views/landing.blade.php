<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakershead.co - Lead The Way</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
        }
    </script>

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            display: flex;
            width: max-content;
            animation: scroll 30s linear infinite;
        }
        .animate-scroll:hover {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="bg-[#0F172A] text-white font-sans antialiased overflow-x-hidden">

    <header class="bg-[#0F172A]/90 backdrop-blur-md fixed top-0 left-0 right-0 z-50 border-b border-gray-800">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white tracking-tighter">Sneakershead<span class="text-[#2DD4BF]">.co</span></a>

            <div class="hidden md:flex space-x-8 items-center text-sm font-medium">
                <a href="#" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Home</a>
                <a href="#new-arrivals" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">New Arrivals</a>
                <a href="#collection" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Collection</a>
                <a href="#gallery" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Gallery</a>
                <a href="#contact" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Contact</a>
            </div>

            <div class="flex items-center space-x-6">

                <a href="/cart" class="relative text-gray-300 hover:text-[#2DD4BF] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span id="cart-badge" class="hidden absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </a>

                <div id="auth-buttons">
                    <a href="/login" class="px-6 py-2 border border-[#2DD4BF] text-[#2DD4BF] rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition font-bold text-sm">Login</a>
                </div>
            </div>
        </nav>
    </header>

    <section class="min-h-screen flex items-center relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1556906781-9a412961c28c?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A] via-[#0F172A]/80 to-transparent"></div>
        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl">
                <span class="text-[#2DD4BF] font-bold tracking-[0.2em] mb-4 block">NEW COLLECTION 2025</span>
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight text-white drop-shadow-lg">
                    PURCHASE <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2DD4BF] to-blue-500">YOUR SHOES</span> NOW.
                </h1>
                <p class="text-lg mb-8 text-gray-300 max-w-lg leading-relaxed">Discover the latest collections from world-class brands.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="#new-arrivals" class="bg-[#2DD4BF] text-[#0F172A] font-bold py-3 px-8 rounded-full hover:scale-105 transition-transform shadow-[0_0_20px_rgba(45,212,191,0.4)]">Shop Now</a>
                    <a href="/dashboard" id="hero-admin-btn" class="hidden border border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-[#0F172A] transition-colors">Admin Dashboard</a>
                </div>
            </div>
        </div>
    </section>

    <section id="new-arrivals" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">New Arrivals</h2>
                    <div class="h-1 w-20 bg-[#2DD4BF] rounded"></div>
                </div>
                <a href="#" class="text-[#2DD4BF] font-bold hover:underline">View All</a>
            </div>

            <div id="landing-sneaker-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="col-span-full flex flex-col items-center justify-center py-12">
                    <div class="w-12 h-12 border-4 border-[#2DD4BF] border-t-transparent rounded-full animate-spin mb-3"></div>
                    <p class="text-gray-400 text-sm tracking-wider">MEMUAT DATA...</p>
                </div>
            </div>
        </div>
    </section>

    <section id="collection" class="py-20 bg-[#1E293B] relative overflow-hidden">
        <div class="container mx-auto px-6 mb-12">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-white mb-2">Shop By Collection</h2>
                <div class="h-1 w-20 bg-[#2DD4BF] rounded mx-auto"></div>
            </div>
        </div>

        <div class="flex animate-scroll gap-8 px-4">
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">LIFESTYLE</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">SPORT</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1964" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">RUNNING</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">LIMITED</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300 border-2 border-[#2DD4BF]">
                <img src="https://images.unsplash.com/photo-1600269452121-4f2416e55c28?q=80&w=1965" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute top-4 right-4 bg-[#2DD4BF] text-[#0F172A] font-bold px-3 py-1 rounded-full text-xs animate-bounce">HOT</div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">NEW ARRIVAL</h3><p class="text-[#2DD4BF] text-sm">Shop Now &rarr;</p></div>
            </div>

            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">LIFESTYLE</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">SPORT</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1964" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">RUNNING</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300">
                <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">LIMITED</h3><p class="text-[#2DD4BF] text-sm">Explore &rarr;</p></div>
            </div>
            <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg hover:scale-95 transition duration-300 border-2 border-[#2DD4BF]">
                <img src="https://images.unsplash.com/photo-1600269452121-4f2416e55c28?q=80&w=1965" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent"></div>
                <div class="absolute top-4 right-4 bg-[#2DD4BF] text-[#0F172A] font-bold px-3 py-1 rounded-full text-xs animate-bounce">HOT</div>
                <div class="absolute bottom-6 left-6"><h3 class="text-2xl font-bold text-white">NEW ARRIVAL</h3><p class="text-[#2DD4BF] text-sm">Shop Now &rarr;</p></div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 text-white">What They Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 hover:border-[#2DD4BF] transition">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Gila sih, pengirimannya cepet banget. Barangnya ori, packing aman."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-600 rounded-full mr-4 overflow-hidden"><img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" class="w-full h-full object-cover"></div>
                        <div><h4 class="font-bold text-white">Budi Santoso</h4><p class="text-sm text-gray-500">Jakarta</p></div>
                    </div>
                </div>
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 hover:border-[#2DD4BF] transition">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Sepatunya pas banget di kaki. Mantap!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-600 rounded-full mr-4 overflow-hidden"><img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" class="w-full h-full object-cover"></div>
                        <div><h4 class="font-bold text-white">Siti Aminah</h4><p class="text-sm text-gray-500">Surabaya</p></div>
                    </div>
                </div>
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 hover:border-[#2DD4BF] transition">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Nyari Jordan yang rare susah banget, eh nemu di sini."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gray-600 rounded-full mr-4 overflow-hidden"><img src="https://ui-avatars.com/api/?name=Rizky+Febian&background=random" class="w-full h-full object-cover"></div>
                        <div><h4 class="font-bold text-white">Rizky Febian</h4><p class="text-sm text-gray-500">Bandung</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 bg-[#1E293B]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-2">Sneaker Gallery</h2>
                <p class="text-gray-400">Inspiration</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1607522370275-f14206abe5d3?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1584735175315-9d5df23860e6?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1605348532760-6753d2c43329?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1520256862855-398228c41684?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1562183241-b937e95585b6?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
                <div class="rounded-xl overflow-hidden h-64 bg-gray-800"><img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=500" class="w-full h-full object-cover hover:scale-110 transition duration-700"></div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-16">
                <div class="md:w-1/2">
                    <h2 class="text-4xl font-bold text-white mb-6">Get In Touch</h2>
                    <p class="text-gray-400 mb-8">Have questions? Our team is here to help.</p>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4"><div class="bg-[#1E293B] p-4 rounded-full text-[#2DD4BF]">📍</div><div><h4 class="font-bold text-white">Location</h4><p class="text-gray-400">Malang, Indonesia</p></div></div>
                        <div class="flex items-center space-x-4"><div class="bg-[#1E293B] p-4 rounded-full text-[#2DD4BF]">📧</div><div><h4 class="font-bold text-white">Email</h4><p class="text-gray-400">vamos@sneakershead.co</p></div></div>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <form class="space-y-4 bg-[#1E293B] p-8 rounded-2xl shadow-xl border border-gray-700">
                        <div class="grid grid-cols-2 gap-4"><input type="text" placeholder="Name" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg text-white"><input type="email" placeholder="Email" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg text-white"></div>
                        <textarea rows="4" placeholder="Message" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg text-white"></textarea>
                        <button class="w-full bg-[#2DD4BF] text-[#0F172A] font-bold py-3 rounded-lg hover:bg-[#20b2aa]">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#0F172A] border-t border-gray-800 text-gray-400 py-12 text-center">
        <h3 class="text-2xl font-bold text-white mb-4">Sneakershead<span class="text-[#2DD4BF]">.co</span></h3>
        <p class="text-sm">&copy; 2025 Sneakershead.co. All Rights Reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Cek Login & Update UI
            checkLogin();

            // 2. Load Data New Arrivals
            loadNewArrivals();

            // 3. Update Badge Cart
            updateCartBadge();
        });

        // --- FUNGSI AUTH ---
        function checkLogin() {
            const token = localStorage.getItem('jwt_token');
            const userString = localStorage.getItem('user_data');
            const authContainer = document.getElementById('auth-buttons');
            const heroAdminBtn = document.getElementById('hero-admin-btn');

            if (token && userString) {
                const user = JSON.parse(userString);
                let buttonsHtml = '';

                if (user.role === 'admin') {
                    buttonsHtml += `<a href="/dashboard" class="px-5 py-2 bg-[#2DD4BF] text-[#0F172A] rounded-full font-bold text-sm hover:bg-[#1f9d8d] transition">Dashboard</a>`;
                    if(heroAdminBtn) heroAdminBtn.classList.remove('hidden');
                } else {
                    buttonsHtml += `<div class="flex items-center space-x-2 bg-[#1E293B] py-1 px-3 rounded-full border border-gray-700"><img src="https://ui-avatars.com/api/?name=${user.name}&background=2DD4BF&color=0F172A" class="w-6 h-6 rounded-full"><span class="font-medium text-xs text-gray-300">Hi, ${user.name.split(' ')[0]}</span></div>`;
                }

                buttonsHtml += `<button onclick="logout()" class="text-gray-400 hover:text-red-500 text-xs font-bold ml-3 uppercase">Logout</button>`;
                authContainer.innerHTML = buttonsHtml;
            }
        }

        function logout() {
            if(confirm('Yakin ingin logout?')) {
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user_data');
                window.location.reload();
            }
        }

        // --- FUNGSI CART ---
        function updateCartBadge() {
            const cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            const badge = document.getElementById('cart-badge');
            const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);

            if (totalItems > 0) {
                badge.innerText = totalItems;
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }

        function addToCart(id, name, price, brand, size, image) {
            const token = localStorage.getItem('jwt_token');
            if (!token) {
                alert("Silakan login untuk berbelanja!");
                window.location.href = '/login';
                return;
            }

            let cart = JSON.parse(localStorage.getItem('cart_items')) || [];
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, brand, size, image, quantity: 1 });
            }

            localStorage.setItem('cart_items', JSON.stringify(cart));
            updateCartBadge();

            // Animasi kecil feedback (optional)
            alert('Berhasil masuk keranjang!');
        }

        // --- FUNGSI LOAD DATA ---
        async function loadNewArrivals() {
            const container = document.getElementById('landing-sneaker-container');

            try {
                const response = await fetch('/api/sneakers');
                const result = await response.json();
                container.innerHTML = '';

                const sneakers = result.data?.data || result.data || [];

                if (!sneakers || sneakers.length === 0) {
                    container.innerHTML = `<div class="col-span-full text-center py-10 text-gray-500">Belum ada koleksi terbaru.</div>`;
                    return;
                }

                const latestSneakers = sneakers.slice(0, 4); // Ambil 4 teratas

                latestSneakers.forEach((item, index) => {
                    let imageUrl = 'https://via.placeholder.com/400x400?text=No+Image';
                    if (item.image) {
                        imageUrl = item.image.startsWith('http') ? item.image : `/storage/${item.image}`;
                    }

                    const price = item.price || 0;
                    const hargaRupiah = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(price);

                    container.innerHTML += `
                        <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group h-full flex flex-col">
                            <div class="relative h-64 w-full bg-gray-800 overflow-hidden shrink-0">
                                <img src="${imageUrl}" alt="${item.name}" class="w-full h-full object-cover object-center" onerror="this.src='https://via.placeholder.com/400x400?text=Error'">
                                <div class="absolute top-4 right-4 bg-[#2DD4BF] text-[#0F172A] text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">NEW</div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow justify-between">
                                <div class="mb-4">
                                    <h3 class="font-bold text-lg text-white mb-1 truncate" title="${item.name}">${item.name || 'Tanpa Nama'}</h3>
                                    <p class="text-gray-400 text-sm truncate">${item.brand || 'General'} ${item.size ? '• Size ' + item.size : ''}</p>
                                </div>
                                <div class="flex justify-between items-center mt-auto">
                                    <span class="text-xl font-bold text-[#2DD4BF]">${hargaRupiah}</span>

                                    <button onclick="addToCart(${item.id}, '${item.name}', ${item.price}, '${item.brand}', '${item.size || ''}', '${imageUrl}')"
                                        class="bg-white/10 w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition cursor-pointer" title="Add to Cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });

            } catch (error) {
                console.error('Gagal ambil data:', error);
                container.innerHTML = `<div class="col-span-full text-center text-red-400">Gagal memuat data.</div>`;
            }
        }
    </script>
</body>
</html>
