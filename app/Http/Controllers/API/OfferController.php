<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Client;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return DB::transaction(function () use ($offerId, $client) {
            $offer = Offer::where('id', $offerId)->lockForUpdate()->first();

            if (!$offer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penawaran tidak ditemukan'
                ], 404);
            }

            $project = Project::where('id', $offer->project_id)->lockForUpdate()->first();

            if (!$project || $project->client_id != $client->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if (
                $offer->status === 'accepted' &&
                (int) $project->assigned_freelancer_id === (int) $offer->freelancer_id
            ) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penawaran sudah diterima!'
                ]);
            }

            if (!in_array($offer->status, ['pending', 'counter_accepted'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penawaran sudah diproses'
                ], 400);
            }

            $acceptedOffer = Offer::where('project_id', $offer->project_id)
                ->where('id', '!=', $offerId)
                ->where('status', 'accepted')
                ->lockForUpdate()
                ->first();

            if ($acceptedOffer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Project ini sudah memiliki penawaran diterima'
                ], 409);
            }

            // Reject all other offers for this project
            Offer::where('project_id', $offer->project_id)
                ->where('id', '!=', $offerId)
                ->update(['status' => 'rejected']);

            // Accept this offer
            $offer->update(['status' => 'accepted']);

            // Update project status and assign freelancer
            $project->update([
                'status' => 'waiting_payment',
                'assigned_freelancer_id' => $offer->freelancer_id,
                'agreed_budget' => $offer->offered_budget,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Penawaran diterima!'
            ]);
        });
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

        if (!$offer->project || $offer->project->client_id != $client->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if (!in_array($offer->status, ['pending', 'countered', 'counter_accepted'])) {
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

    // Counter an offer (client)
    public function counter(Request $request, $offerId)
    {
        $user = $request->user();

        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'offered_budget' => 'required|numeric|min:1000',
            'message' => 'required|string|max:1000',
            'proposed_deadline_days' => 'nullable|integer|min:1|max:365',
        ]);

        return DB::transaction(function () use ($offerId, $client, $validated) {
            $offer = Offer::where('id', $offerId)->lockForUpdate()->first();

            if (!$offer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penawaran tidak ditemukan'
                ], 404);
            }

            $project = Project::where('id', $offer->project_id)->lockForUpdate()->first();

            if (!$project || $project->client_id != $client->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if (!in_array($offer->status, ['pending', 'countered'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penawaran sudah diproses'
                ], 400);
            }

            $offer->update([
                'offered_budget' => $validated['offered_budget'],
                'message' => $validated['message'],
                'proposed_deadline_days' => $validated['proposed_deadline_days']
                    ?? $offer->proposed_deadline_days,
                'status' => 'countered',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tawar balik berhasil dikirim',
                'data' => $offer->fresh('freelancer'),
            ]);
        });
    }

    // Accept a counter offer (freelancer)
    public function acceptCounter(Request $request, $offerId)
    {
        $user = $request->user();

        $freelancer = Freelancer::where('email', $user->email)->first();

        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai freelancer'
            ], 403);
        }

        return DB::transaction(function () use ($offerId, $freelancer) {
            $offer = Offer::where('id', $offerId)->lockForUpdate()->first();

            if (!$offer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Penawaran tidak ditemukan'
                ], 404);
            }

            if ((int) $offer->freelancer_id !== (int) $freelancer->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if ($offer->status === 'counter_accepted') {
                return response()->json([
                    'success' => true,
                    'message' => 'Tawar balik sudah disetujui'
                ]);
            }

            if ($offer->status !== 'countered') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada tawar balik yang perlu disetujui'
                ], 400);
            }

            $offer->update(['status' => 'counter_accepted']);

            return response()->json([
                'success' => true,
                'message' => 'Tawar balik disetujui. Menunggu client membayar.',
                'data' => $offer->fresh('project.client'),
            ]);
        });
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
            ->with('project.client')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($offer) {
                return [
                    'id' => $offer->id,
                    'project_id' => $offer->project_id,
                    'freelancer_id' => $offer->freelancer_id,
                    'project_title' => $offer->project?->judul,
                    'project' => $offer->project,
                    'offered_budget' => (int) $offer->offered_budget,
                    'message' => $offer->message,
                    'proposed_deadline_days' => $offer->proposed_deadline_days,
                    'status' => $offer->status,
                    'created_at' => $offer->created_at?->toDateTimeString(),
                    'updated_at' => $offer->updated_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }
}
