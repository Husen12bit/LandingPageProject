<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /*
    // Get my bids (for freelancer)
    public function myBids(Request $request)
    {
        $user = $request->user();

        // Get freelancer from user email
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
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $bids
        ]);
    }
        */
}
