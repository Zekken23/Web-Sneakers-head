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

    <script src="https://unpkg.com/scrollreveal"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Tambahan untuk scrollbar sembunyi */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-[#0F172A] text-white font-sans antialiased overflow-x-hidden">

    <header class="bg-[#0F172A]/90 backdrop-blur-md fixed top-0 left-0 right-0 z-50 border-b border-gray-800 transition-all duration-300">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-white tracking-tighter">
                Sneakershead<span class="text-[#2DD4BF]">.co</span>
            </a>

            <div class="hidden md:flex space-x-8 items-center text-sm font-medium">
                <a href="#" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Home</a>
                <a href="#new-arrivals" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">New Arrivals</a>
                <a href="#collection" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Collection</a>
                <a href="#gallery" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Gallery</a>
                <a href="#contact" class="text-gray-300 hover:text-[#2DD4BF] transition-colors">Contact</a>
            </div>

            <div id="auth-buttons" class="flex items-center space-x-4">
                <a href="/login" class="px-6 py-2 border border-[#2DD4BF] text-[#2DD4BF] rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition font-bold text-sm">
                    Login
                </a>
            </div>
        </nav>
    </header>

    <section class="min-h-screen flex items-center relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1556906781-9a412961c28c?q=80&w=2070&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A] via-[#0F172A]/80 to-transparent"></div>

        <div class="container mx-auto px-6 relative z-10 pt-20">
            <div class="max-w-3xl reveal-left">
                <span class="text-[#2DD4BF] font-bold tracking-[0.2em] mb-4 block animate-pulse">NEW COLLECTION 2025</span>
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight text-white drop-shadow-lg">
                    PURCHASE <br> <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#2DD4BF] to-blue-500">YOUR SHOES</span> NOW.
                </h1>
                <p class="text-lg mb-8 text-gray-300 max-w-lg leading-relaxed">
                    Discover the latest collections from world-class brands. Style, comfort, and performance in one place.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#new-arrivals" class="bg-[#2DD4BF] text-[#0F172A] font-bold py-3 px-8 rounded-full hover:scale-105 transition-transform shadow-[0_0_20px_rgba(45,212,191,0.4)]">
                        Shop Now
                    </a>

                    <a href="/dashboard" id="hero-admin-btn" class="hidden border border-white text-white font-bold py-3 px-8 rounded-full hover:bg-white hover:text-[#0F172A] transition-colors">
                        Admin Dashboard
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="new-arrivals" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-end mb-12 reveal-up">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">New Arrivals</h2>
                    <div class="h-1 w-20 bg-[#2DD4BF] rounded"></div>
                </div>
                <a href="#" class="text-[#2DD4BF] font-bold hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group reveal-card">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=1964" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-[#2DD4BF] text-[#0F172A] text-xs font-bold px-3 py-1 rounded-full">NEW</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-white mb-1">Nike Air Jordan 1</h3>
                        <p class="text-gray-400 text-sm mb-4">High OG Chicago</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-[#2DD4BF]">Rp 2.899.000</span>
                            <button class="bg-white/10 p-2 rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group reveal-card" style="transition-delay: 100ms;">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-white mb-1">Adidas Ultraboost</h3>
                        <p class="text-gray-400 text-sm mb-4">Running Performance</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-[#2DD4BF]">Rp 3.100.000</span>
                            <button class="bg-white/10 p-2 rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group reveal-card" style="transition-delay: 200ms;">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=2070" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">SALE</div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-white mb-1">Nike Air Max 270</h3>
                        <p class="text-gray-400 text-sm mb-4">Lifestyle Red</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-[#2DD4BF]">Rp 1.500.000</span>
                            <button class="bg-white/10 p-2 rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1E293B] rounded-2xl overflow-hidden shadow-xl hover:-translate-y-2 transition-transform duration-300 group reveal-card" style="transition-delay: 300ms;">
                    <div class="relative h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?q=80&w=2025" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-white mb-1">New Balance 574</h3>
                        <p class="text-gray-400 text-sm mb-4">Classic Grey</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-[#2DD4BF]">Rp 1.299.000</span>
                            <button class="bg-white/10 p-2 rounded-full hover:bg-[#2DD4BF] hover:text-[#0F172A] transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="collection" class="py-20 bg-[#1E293B] relative">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 reveal-up">
                <h2 class="text-4xl font-bold text-white mb-2">Shop By Collection</h2>
                <div class="h-1 w-20 bg-[#2DD4BF] rounded mx-auto"></div>
            </div>

            <div class="flex overflow-x-auto space-x-6 pb-8 scrollbar-hide reveal-right">

                <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg">
                    <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">LIFESTYLE</h3>
                        <p class="text-[#2DD4BF] text-sm">Explore Collection &rarr;</p>
                    </div>
                </div>

                <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg">
                    <img src="https://images.unsplash.com/photo-1511556532299-8f662fc26c06?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">SPORT</h3>
                        <p class="text-[#2DD4BF] text-sm">Explore Collection &rarr;</p>
                    </div>
                </div>

                <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg">
                    <img src="https://images.unsplash.com/photo-1605218427368-35b0b2e3a139?q=80&w=2070" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">RUNNING</h3>
                        <p class="text-[#2DD4BF] text-sm">Explore Collection &rarr;</p>
                    </div>
                </div>

                <div class="flex-shrink-0 w-72 h-96 relative rounded-2xl overflow-hidden group cursor-pointer shadow-lg">
                    <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1974" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <h3 class="text-2xl font-bold text-white">LIMITED</h3>
                        <p class="text-[#2DD4BF] text-sm">Explore Collection &rarr;</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 reveal-up text-white">What They Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 reveal-card">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Gila sih, pengirimannya cepet banget. Barangnya ori, packing aman. Fix bakal langganan di Sneakershead!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-600 rounded-full mr-3 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" alt="User">
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Budi Santoso</h4>
                            <p class="text-sm text-gray-500">Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 reveal-card" style="transition-delay: 100ms;">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Adminnya ramah banget pas ditanya-tanya soal size. Sepatunya pas banget di kaki. Mantap!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-600 rounded-full mr-3 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" alt="User">
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Siti Aminah</h4>
                            <p class="text-sm text-gray-500">Surabaya</p>
                        </div>
                    </div>
                </div>
                <div class="bg-[#1E293B] p-8 rounded-2xl shadow-lg border border-gray-800 reveal-card" style="transition-delay: 200ms;">
                    <div class="flex text-[#2DD4BF] mb-4">★★★★★</div>
                    <p class="text-gray-300 mb-6 italic">"Nyari Jordan yang rare susah banget, eh nemu di sini dengan harga yang masih masuk akal. Thanks!"</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-600 rounded-full mr-3 overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name=Rizky+Febian&background=random" alt="User">
                        </div>
                        <div>
                            <h4 class="font-bold text-white">Rizky Febian</h4>
                            <p class="text-sm text-gray-500">Bandung</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-20 bg-[#1E293B]">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 reveal-up">
                <h2 class="text-4xl font-bold text-white mb-2">Sneaker Gallery</h2>
                <p class="text-gray-400">Inspiration from Pinterest</p>
            </div>

            <div id="gallery-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <p id="gallery-loading" class="text-center text-[#2DD4BF] col-span-full animate-pulse">Sedang memuat galeri...</p>
                </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-[#0F172A]">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-16">
                <div class="md:w-1/2 reveal-left">
                    <h2 class="text-4xl font-bold text-white mb-6">Get In Touch</h2>
                    <p class="text-gray-400 mb-8 text-lg">Have questions about your order or need help choosing the right pair? Our team is here to help.</p>

                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-[#1E293B] p-4 rounded-full text-[#2DD4BF]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Location</h4>
                                <p class="text-gray-400">Jln Tegalgondo, Malang, Indonesia</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="bg-[#1E293B] p-4 rounded-full text-[#2DD4BF]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white">Email</h4>
                                <p class="text-gray-400">vamos@sneakershead.co</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 reveal-right">
                    <form class="space-y-4 bg-[#1E293B] p-8 rounded-2xl shadow-xl border border-gray-700">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Name" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg focus:outline-none focus:border-[#2DD4BF] text-white focus:ring-1 focus:ring-[#2DD4BF] transition">
                            <input type="email" placeholder="Email" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg focus:outline-none focus:border-[#2DD4BF] text-white focus:ring-1 focus:ring-[#2DD4BF] transition">
                        </div>
                        <input type="text" placeholder="Subject" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg focus:outline-none focus:border-[#2DD4BF] text-white focus:ring-1 focus:ring-[#2DD4BF] transition">
                        <textarea rows="4" placeholder="Message" class="w-full bg-[#0F172A] border border-gray-600 p-3 rounded-lg focus:outline-none focus:border-[#2DD4BF] text-white focus:ring-1 focus:ring-[#2DD4BF] transition"></textarea>
                        <button class="w-full bg-[#2DD4BF] text-[#0F172A] font-bold py-3 rounded-lg hover:bg-[#20b2aa] hover:scale-[1.02] transition-all duration-300 shadow-lg">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-[#0F172A] border-t border-gray-800 text-gray-400 py-12">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold text-white mb-4 tracking-tighter">Sneakershead<span class="text-[#2DD4BF]">.co</span></h3>
            <p class="mb-6 max-w-md mx-auto">Lead The Way. The best sneakers collection in town with authentic guarantee.</p>
            <div class="flex justify-center space-x-6 mb-8">
                <a href="#" class="hover:text-[#2DD4BF] transition">Instagram</a>
                <a href="#" class="hover:text-[#2DD4BF] transition">Twitter</a>
                <a href="#" class="hover:text-[#2DD4BF] transition">Facebook</a>
            </div>
            <p class="text-sm">&copy; 2025 Sneakershead.co. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // --- 1. SETUP ANIMASI SCROLLREVEAL ---
            const sr = ScrollReveal({
                origin: 'bottom',
                distance: '60px',
                duration: 1000,
                delay: 200,
                reset: false,
            });

            sr.reveal('.reveal-up', { origin: 'bottom' });
            sr.reveal('.reveal-left', { origin: 'left', distance: '60px' });
            sr.reveal('.reveal-right', { origin: 'right', distance: '60px' });

            // Animasi bertingkat untuk kartu
            sr.reveal('.reveal-card', {
                interval: 150,
                origin: 'bottom',
                distance: '50px'
            });


            // --- 2. CEK STATUS LOGIN (LOGIC AUTH) ---
            const token = localStorage.getItem('jwt_token');
            const userString = localStorage.getItem('user_data');
            const authContainer = document.getElementById('auth-buttons');
            const heroAdminBtn = document.getElementById('hero-admin-btn');

            if (token && userString) {
                const user = JSON.parse(userString);
                let buttonsHtml = '';

                // Cek Role: ADMIN
                if (user.role === 'admin') {
                    // Navbar Button
                    buttonsHtml += `
                        <a href="/dashboard" class="px-5 py-2 bg-[#2DD4BF] text-[#0F172A] rounded-full font-bold text-sm hover:bg-[#1f9d8d] transition shadow-lg shadow-teal-500/20">
                            Dashboard Admin
                        </a>
                    `;
                    // Hero Button (Tampilkan)
                    if(heroAdminBtn) heroAdminBtn.classList.remove('hidden');
                } else {
                    // Role: USER BIASA
                    buttonsHtml += `
                        <div class="flex items-center space-x-3 bg-[#1E293B] py-1 px-3 rounded-full border border-gray-700">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=2DD4BF&color=0F172A" class="w-8 h-8 rounded-full">
                            <span class="font-medium text-sm text-gray-300">Hi, ${user.name.split(' ')[0]}</span>
                        </div>
                    `;
                }

                // Tombol Logout (Ada untuk semua role)
                buttonsHtml += `
                    <button onclick="logout()" class="text-gray-400 hover:text-red-500 text-sm font-medium ml-2 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                `;

                authContainer.innerHTML = buttonsHtml;
            }

            // --- 3. FETCH GALLERY (Logic Gambar Dinamis) ---
            fetchGalleryImages();
        });

        // Fungsi Logout
        function logout() {
            if(confirm('Yakin ingin logout?')) {
                localStorage.removeItem('jwt_token');
                localStorage.removeItem('user_data');
                window.location.reload();
            }
        }

        // Fungsi Fetch Gallery Pinterest
        async function fetchGalleryImages() {
            const container = document.getElementById('gallery-container');
            const loadingMessage = document.getElementById('gallery-loading');

            if (!container) return;

            // API Endpoint (Gunakan API publik atau placeholder jika limit)
            const apiUrl = 'https://api.ryzumi.vip/api/search/pinterest?query=sneakers+aesthetic';

            try {
                const response = await fetch(apiUrl);
                if (!response.ok) throw new Error('API Error');

                const data = await response.json();

                // Validasi data (Pinterest API sering berubah format, kita handle aman)
                // Asumsi data array ada di data atau data.data
                const images = Array.isArray(data) ? data : (data.data || []);

                if (images.length === 0) {
                    throw new Error('No images found');
                }

                loadingMessage.remove();

                // Ambil 10 gambar saja
                images.slice(0, 10).forEach((item, index) => {
                    const imgWrapper = document.createElement('div');
                    // Styling grid masonry-like sederhana
                    imgWrapper.className = `relative rounded-xl overflow-hidden shadow-lg group bg-gray-800 h-64 reveal-card`;
                    imgWrapper.style.transitionDelay = `${index * 50}ms`;

                    // Coba ambil URL gambar (sesuaikan dengan respons API mu)
                    // Biasanya: item, item.media.url, atau item.image
                    const imageUrl = item.media?.url || item;

                    imgWrapper.innerHTML = `
                        <img src="${imageUrl}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Sneaker" onerror="this.src='https://via.placeholder.com/300x400?text=Sneaker'">
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <span class="text-[#2DD4BF] font-bold text-sm border border-[#2DD4BF] px-3 py-1 rounded-full">View</span>
                        </div>
                    `;
                    container.appendChild(imgWrapper);
                });

            } catch (error) {
                console.error('Gallery Error:', error);
                loadingMessage.innerText = 'Gagal memuat galeri.';

                // FALLBACK: Jika API mati, tampilkan gambar statis agar tidak kosong
                loadingMessage.remove();
                const fallbacks = [
                    'https://images.unsplash.com/photo-1607522370275-f14206abe5d3?w=500',
                    'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=500',
                    'https://images.unsplash.com/photo-1552346154-21d32810aba3?w=500',
                    'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=500',
                    'https://images.unsplash.com/photo-1584735175315-9d5df23860e6?w=500'
                ];

                fallbacks.forEach(url => {
                     const imgWrapper = document.createElement('div');
                     imgWrapper.className = `relative rounded-xl overflow-hidden shadow-lg group bg-gray-800 h-64`;
                     imgWrapper.innerHTML = `<img src="${url}" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition">`;
                     container.appendChild(imgWrapper);
                });
            }
        }
    </script>
</body>
</html>
