<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    // Get all offers for a project (client view)
    public function index(Request $request, $projectId)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid'
            ], 401);
        }

        // Get client from user email
        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai client'
            ], 403);
        }

        $project = Project::where('id', $projectId)
            ->where('client_id', $client->id)
            ->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan'
            ], 404);
        }

        $offers = Offer::where('project_id', $projectId)
            ->with('freelancer')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($offer) {
                return [
                    'id' => $offer->id,
                    'freelancer_name' => $offer->freelancer->nama_lengkap ?? 'Unknown',
                    'freelancer_skill' => $offer->freelancer->keahlian ?? '-',
                    'freelancer_rating' => $offer->freelancer->rating ?? 0,
                    'offered_budget' => (int) $offer->offered_budget,
                    'message' => $offer->message,
                    'proposed_deadline_days' => $offer->proposed_deadline_days,
                    'status' => $offer->status,
                    'created_at' => $offer->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }

    // Accept an offer (client)
    public function accept(Request $request, $offerId)
    {
        $user = $request->user();

        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $offer = Offer::with('project')->find($offerId);

        if (!$offer) {
            return response()->json([
                'success' => false,
                'message' => 'Penawaran tidak ditemukan'
            ], 404);
        }

        if ($offer->project->client_id != $client->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($offer->status != 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Penawaran sudah diproses'
            ], 400);
        }

        // Reject all other offers for this project
        Offer::where('project_id', $offer->project_id)
            ->where('id', '!=', $offerId)
            ->update(['status' => 'rejected']);

        // Accept this offer
        $offer->update(['status' => 'accepted']);

        // Update project status and assign freelancer
        $offer->project->update([
            'status' => 'in_progress',
            'assigned_freelancer_id' => $offer->freelancer_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran diterima!'
        ]);
    }

    // Reject an offer (client)
    public function reject(Request $request, $offerId)
    {
        $user = $request->user();

        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $offer = Offer::find($offerId);

        if (!$offer) {
            return response()->json([
                'success' => false,
                'message' => 'Penawaran tidak ditemukan'
            ], 404);
        }

        if ($offer->status != 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Penawaran sudah diproses'
            ], 400);
        }

        $offer->update(['status' => 'rejected']);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran ditolak'
        ]);
    }

    // Get my offers (for freelancer)
    public function myOffers(Request $request)
    {
        $user = $request->user();

        $freelancer = Freelancer::where('email', $user->email)->first();

        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai freelancer'
            ], 403);
        }

        $offers = Offer::where('freelancer_id', $freelancer->id)
            ->with('project')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($offer) {
                return [
                    'id' => $offer->id,
                    'project_title' => $offer->project->judul,
                    'offered_budget' => (int) $offer->offered_budget,
                    'message' => $offer->message,
                    'status' => $offer->status,
                    'updated_at' => $offer->updated_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }
}
