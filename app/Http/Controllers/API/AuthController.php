<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    // Register User (Mobile)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:client,freelancer',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create User
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'is_active' => true,
        ]);

        // Auto create client/freelancer berdasarkan role
        if ($request->role === 'client') {
            \App\Models\Client::create([
                'nama_perusahaan' => $request->name,
                'nama_kontak'     => $request->name,
                'email'           => $request->email,
                'no_telepon'      => $request->phone ?? '-',
                'alamat'          => $request->input('alamat', '-'),
                'bidang_usaha'    => $request->input('bidang_usaha', '-'),
                'total_proyek'    => 0,
                'status'          => 'aktif',
            ]);
        } elseif ($request->role === 'freelancer') {
            \App\Models\Freelancer::create([
                'nama_lengkap'    => $request->name,
                'email'           => $request->email,
                'no_telepon'      => $request->phone ?? '-',
                'keahlian'        => $request->input('keahlian', 'Umum'),
                'deskripsi'       => $request->input('deskripsi', 'Deskripsi belum tersedia'),
                'harga_per_hari'  => 0,
                'pengalaman_tahun'=> 0,
                'status'          => 'verifikasi',
                'rating'          => 0,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone,
            ],
            'token' => $token
        ], 201);
    }

    // Login User (Mobile)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'sometimes|string',
            'email' => 'sometimes|string|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $identity = $request->input('identity', $request->input('email'));
        if (!$identity) {
            return response()->json([
                'message' => 'Email atau username diperlukan untuk login.'
            ], 422);
        }

        $user = User::where('email', $identity)
            ->orWhere('username', $identity)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email/Username atau password salah!'
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'message' => 'Akun Anda sedang dinonaktifkan. Hubungi admin.'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil!',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone,
            ],
            'token' => $token
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil!'
        ]);
    }

    // Forgot Password (request OTP)
    public function forgotPassword(Request $request)
    {
        return response()->json(['message' => 'OTP telah dikirim ke email Anda']);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        return response()->json(['message' => 'OTP valid']);
    }
}
