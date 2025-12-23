<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sneakershead.co</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md border border-gray-200">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-600">Sneakershead.co</h1>
            <p class="text-gray-500 mt-2">Masuk ke Dashboard Admin</p>
        </div>

        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="admin@sneakershead.co" required>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********" required>
            </div>

            <button type="submit" id="btnSubmit" class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                MASUK
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6">
            Belum punya akun? <a href="/register" class="text-blue-600 font-bold hover:underline">Daftar disini</a>
        </p>
    </div>

    <script>
        // Debugging: Cek apakah script jalan
        console.log("Script Login Dimuat...");

        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            console.log("Tombol ditekan...");
            const btn = document.getElementById('btnSubmit');
            const originalText = btn.innerText;

            // Ubah tombol jadi loading
            btn.innerText = "Loading...";
            btn.disabled = true;

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();
                console.log("Response:", data);

                if (response.ok) {
                    // SIMPAN TOKEN & ROLE
                    localStorage.setItem('jwt_token', data.access_token);
                    // Pastikan controller Auth kamu sudah mengembalikan object 'user'
                    if(data.user) {
                        localStorage.setItem('user_data', JSON.stringify(data.user));

                        // REDIRECT SESUAI ROLE
                        if (data.user.role === 'admin') {
                            window.location.href = '/dashboard';
                        } else {
                            window.location.href = '/';
                        }
                    } else {
                        // Fallback jika backend belum update controller
                        alert("Login berhasil tapi data user tidak ditemukan. Cek Controller.");
                        window.location.href = '/dashboard';
                    }
                } else {
                    alert('Login Gagal: ' + (data.message || data.error));
                }
            } catch (error) {
                console.error(error);
                alert('Gagal terhubung ke server.');
            } finally {
                // Kembalikan tombol
                btn.innerText = originalText;
                btn.disabled = false;
            }
        });
    </script>
</body>
</html>
