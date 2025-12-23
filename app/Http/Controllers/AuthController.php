<?php

namespace App\Http\Controllers\Api; // Saya rapikan namespace ke folder Api

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * Middleware 'auth:api' memastikan user harus login dulu untuk akses method selain login/register
     */
    public function __construct()
    {
        // Kita proteksi semua method KECUALI login dan register
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        // TAPI: Karena kita atur middleware di route, constructor ini opsional.
        // Biar aman saya komen dulu agar tidak bentrok dengan Route.
    }

    // 1. REGISTER
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    // 2. LOGIN (Wajib JWT)
    public function login()
    {
        $credentials = request(['email', 'password']);

        // PENTING: Tambahkan guard('api') agar Laravel tahu kita pakai JWT, bukan Session biasa
        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized', 'message' => 'Email atau Password salah'], 401);
        }

        return $this->respondWithToken($token);
    }

    // 3. ME (Cek Profil User yang sedang login)
    public function me()
    {
        // PENTING: Pakai guard('api')
        return response()->json(auth()->guard('api')->user());
    }

    // 4. LOGOUT
    public function logout()
    {
        // PENTING: Pakai guard('api')
        auth()->guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // 5. REFRESH TOKEN (Opsional tapi bagus buat nilai plus)
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    // HELPER: Format Token JSON
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'user'         => auth()->guard('api')->user(),
            'expires_in'   => auth()->guard('api')->factory()->getTTL() * 60
        ]);
    }
}
