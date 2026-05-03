<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        $user->save();

        return response()->json([
            'message' => 'Profil berhasil diupdate',
            'user' => $user
        ]);
    }
}
