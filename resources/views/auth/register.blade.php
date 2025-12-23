<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border border-gray-200">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600">Sneakershead.co</h1>
            <p class="text-gray-500 mt-2">Buat akun admin baru</p>
        </div>

        <form id="registerForm" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Yusron Al Ghoni" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="admin@sneakershead.co" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Minimal 6 karakter" required minlength="6">
            </div>

            <button type="submit" id="btnRegister" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                DAFTAR SEKARANG
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:underline">Login disini</a>
        </p>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Mencegah reload halaman

            const btn = document.getElementById('btnRegister');
            const originalText = btn.innerText;

            // 1. Ubah tombol jadi Loading (Feedback Visual)
            btn.innerText = "Memproses...";
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');

            // Ambil data form
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                // 2. HIT API REGISTER
                const regResponse = await fetch('/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name, email, password })
                });

                const regData = await regResponse.json();

                if (!regResponse.ok) {
                    throw new Error(regData.message || JSON.stringify(regData));
                }

                // 3. JIKA SUKSES REGISTER -> LANGSUNG LOGIN OTOMATIS
                // Kita hit API Login menggunakan email & password yang baru didaftarkan
                const loginResponse = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const loginData = await loginResponse.json();

                if (loginResponse.ok) {
                    // Simpan Token & Data User
                    localStorage.setItem('jwt_token', loginData.access_token);
                    if(loginData.user) {
                        localStorage.setItem('user_data', JSON.stringify(loginData.user));
                    }

                    alert('Registrasi Berhasil! Mengalihkan ke Dashboard...');

                    // Redirect langsung ke Dashboard
                    window.location.href = '/dashboard';
                } else {
                    // Fallback jika auto-login gagal (jarang terjadi)
                    alert('Registrasi berhasil, silakan login manual.');
                    window.location.href = '/login';
                }

            } catch (error) {
                console.error(error);
                alert('Gagal Daftar: ' + error.message);
            } finally {
                // Kembalikan tombol seperti semula jika error
                btn.innerText = originalText;
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
</body>
</html>
