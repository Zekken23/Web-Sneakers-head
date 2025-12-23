<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    // REGISTER
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user' // Default jadi user biasa
        ]);

        return response()->json([
            'message' => 'Register Berhasil',
            'user' => $user
        ], 201);
    }

    // LOGIN
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Email atau Password Salah'], 401);
        }

        return response()->json([
            'message' => 'Login Berhasil',
            'access_token' => $token,
            'user' => auth()->guard('api')->user()
        ]);
    }

    // ME (Cek Profile)
    public function me() {
        return response()->json(auth()->guard('api')->user());
    }

    // LOGOUT
    public function logout() {
        auth()->guard('api')->logout();
        return response()->json(['message' => 'Logout Berhasil']);
    }
}
