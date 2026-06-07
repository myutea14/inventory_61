<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Ubah extends Controller menjadi extends BaseController
class AuthController extends BaseController 
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->error('Validasi gagal.', 422, $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // Jika ada field 'role' di databasemu, bisa tambahkan: 'role' => 'user'
        ]);

        // Buat token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Gunakan response wrapper sukses
        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'User berhasil didaftarkan.', 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error('Email atau password salah.', 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Gunakan response wrapper sukses
        return $this->success([
            'user' => $user,
            'token' => $token
        ], 'Login berhasil.', 200);
    }
}