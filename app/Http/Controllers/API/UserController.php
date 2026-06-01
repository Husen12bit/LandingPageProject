<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->fill($request->only(['name', 'phone', 'avatar', 'bio', 'skill', 'company']));
        $user->save();

        // Jika user adalah freelancer, sinkronkan ke tabel freelancers
        if ($user->role === 'freelancer') {
            $freelancer = \App\Models\Freelancer::where('email', $user->email)->first();
            if ($freelancer) {
                $freelancer->update([
                    'keahlian' => $request->skill ?? $freelancer->keahlian,
                    'deskripsi' => $request->bio ?? $freelancer->deskripsi,
                ]);
            }
        }

        // Jika client, update tabel clients
        if ($user->role === 'client') {
            $client = \App\Models\Client::where('email', $user->email)->first();
            if ($client) {
                $client->update([
                    'bidang_usaha' => $request->company ?? $client->bidang_usaha,
                ]);
            }
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
