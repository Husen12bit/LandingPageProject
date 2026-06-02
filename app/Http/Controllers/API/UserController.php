<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Get user profile
    public function profile(Request $request)
    {
        $user = $request->user();
        $user->load(['client', 'freelancer']);

        return response()->json([
            'success' => true,
            'data' => $this->formatUserProfile($user),
        ]);
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:15',
            'avatar' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string',
            'skill' => 'sometimes|string|max:255',
            'company' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string',
            'bidang_usaha' => 'sometimes|string|max:255',
            'portfolio' => 'sometimes|string',
            'harga_per_hari' => 'sometimes|numeric|min:0|max:99999999.99',
            'pengalaman_tahun' => 'sometimes|integer|min:0|max:80',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->fill($request->only(['name', 'phone', 'avatar', 'bio', 'skill', 'company']));
        $user->save();

        if ($user->role === 'freelancer') {
            $freelancer = Freelancer::firstOrCreate(
                ['email' => $user->email],
                [
                    'nama_lengkap' => $user->name,
                    'no_telepon' => $user->phone ?? '-',
                    'keahlian' => $request->input('skill', 'Umum'),
                    'deskripsi' => $request->input('bio', 'Deskripsi belum tersedia'),
                    'harga_per_hari' => 0,
                    'pengalaman_tahun' => 0,
                    'rating' => 0,
                    'status' => 'aktif',
                ]
            );

            $freelancer->fill([
                'nama_lengkap' => $request->input('name', $freelancer->nama_lengkap),
                'no_telepon' => $request->input('phone', $freelancer->no_telepon),
                'keahlian' => $request->input('skill', $freelancer->keahlian),
                'portfolio' => $request->input('portfolio', $freelancer->portfolio),
                'deskripsi' => $request->input('bio', $freelancer->deskripsi),
                'harga_per_hari' => $request->input('harga_per_hari', $freelancer->harga_per_hari),
                'pengalaman_tahun' => $request->input('pengalaman_tahun', $freelancer->pengalaman_tahun),
                'status' => $request->input('status', $freelancer->status),
            ])->save();
        }

        if ($user->role === 'client') {
            $client = Client::firstOrCreate(
                ['email' => $user->email],
                [
                    'nama_perusahaan' => $user->name,
                    'nama_kontak' => $user->name,
                    'no_telepon' => $user->phone ?? '-',
                    'alamat' => $request->input('alamat', '-'),
                    'bidang_usaha' => $request->input('company', '-'),
                    'total_proyek' => 0,
                    'status' => 'aktif',
                ]
            );

            $client->fill([
                'nama_perusahaan' => $request->input('name', $client->nama_perusahaan),
                'nama_kontak' => $request->input('name', $client->nama_kontak),
                'no_telepon' => $request->input('phone', $client->no_telepon),
                'alamat' => $request->input('alamat', $client->alamat),
                'bidang_usaha' => $request->input('company', $request->input('bidang_usaha', $client->bidang_usaha)),
                'status' => $request->input('status', $client->status),
            ])->save();
        }

        $user->load(['client', 'freelancer']);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diupdate',
            'data' => $this->formatUserProfile($user),
        ]);
    }

    private function formatUserProfile($user): array
    {
        $profile = [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'avatar' => $user->avatar,
            'bio' => $user->bio,
            'skill' => $user->skill,
            'company' => $user->company,
            'created_at' => $user->created_at->toDateTimeString(),
        ];

        if ($user->role === 'client' && $user->client) {
            $profile['client'] = [
                'id' => $user->client->id,
                'nama_perusahaan' => $user->client->nama_perusahaan,
                'nama_kontak' => $user->client->nama_kontak,
                'email' => $user->client->email,
                'no_telepon' => $user->client->no_telepon,
                'alamat' => $user->client->alamat,
                'bidang_usaha' => $user->client->bidang_usaha,
                'total_proyek' => $user->client->total_proyek,
                'status' => $user->client->status,
            ];
        }

        if ($user->role === 'freelancer' && $user->freelancer) {
            $profile['freelancer'] = [
                'id' => $user->freelancer->id,
                'nama_lengkap' => $user->freelancer->nama_lengkap,
                'email' => $user->freelancer->email,
                'no_telepon' => $user->freelancer->no_telepon,
                'keahlian' => $user->freelancer->keahlian,
                'portfolio' => $user->freelancer->portfolio,
                'deskripsi' => $user->freelancer->deskripsi,
                'harga_per_hari' => $user->freelancer->harga_per_hari,
                'pengalaman_tahun' => $user->freelancer->pengalaman_tahun,
                'rating' => $user->freelancer->rating,
                'status' => $user->freelancer->status,
            ];
        }

        return $profile;
    }
}
