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

        // Load relasi client atau freelancer
        if ($user->role == 'client') {
            $user->client = \App\Models\Client::where('email', $user->email)->first();
        } elseif ($user->role == 'freelancer') {
            $user->freelancer = \App\Models\Freelancer::where('email', $user->email)->first();
        }

        return response()->json($user);
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

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diupdate',
            'user' => $user
        ]);
    }
}
