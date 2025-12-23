<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 1. REGISTER
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat User Baru
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password), // Pakai bcrypt sesuai modul
        ]);

        // Return sukses (Tanpa token dulu, login manual setelah register)
        return response()->json(['message' => 'User successfully registered', 'user' => $user], 201);
    }

    // 2. LOGIN (Perubahan Besar di sini: Pakai JWT)
    public function login()
    {
        $credentials = request(['email', 'password']);

        // auth()->attempt() di JWT akan mengembalikan TOKEN jika berhasil
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Jika berhasil, kembalikan token dengan format khusus
        return $this->respondWithToken($token);
    }

    // 3. ME (Cek Profil)
    public function me()
    {
        return response()->json(auth()->user());
    }

    // 4. LOGOUT (Hapus Token JWT)
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // 5. HELPER FUNCTION (Format Token Sesuai Modul)
    // Ini wajib ada untuk mengatur respon JSON saat Login
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}
