<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class BidController extends Controller
{
    // Get my bids (for freelancer)
    public function myBids(Request $request)
    {
        $user = $request->user();

        $freelancer = Freelancer::where('email', $user->email)->first();

        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai freelancer'
            ], 403);
        }

        $bids = Bid::where('freelancer_id', $freelancer->id)
            ->with('project')
            ->latest()
            ->get()
            ->map(function ($bid) {
                return [
                    'id' => $bid->id,
                    'project_id' => $bid->project->id,
                    'project_title' => $bid->project->judul,
                    'project_status' => $bid->project->status,
                    'harga_penawaran' => (int) $bid->harga_penawaran,
                    'pesan_penawaran' => $bid->pesan_penawaran,
                    'estimasi_hari' => $bid->estimasi_hari,
                    'status' => $bid->status,
                    'created_at' => $bid->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $bids
        ]);
    }
}
