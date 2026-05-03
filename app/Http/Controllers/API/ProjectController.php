<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Bid;
use App\Models\Freelancer;
use App\Models\Client;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    // Get all projects
    public function index(Request $request)
    {
        $query = Project::with(['client', 'kategori']);

        // Filter by kategori
        if ($request->has('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(10);

        return response()->json($projects);
    }

    // Get single project
    public function show($id)
    {
        $project = Project::with(['client', 'kategori', 'bids.freelancer'])->find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        return response()->json($project);
    }

    // Store new project (by client)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'anggaran_min' => 'required|numeric|min:0',
            'anggaran_max' => 'required|numeric|min:0|gt:anggaran_min',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        // Get client from user email
        $client = \App\Models\Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json(['message' => 'Anda belum terdaftar sebagai client'], 403);
        }

        $project = Project::create([
            'client_id' => $client->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'anggaran_min' => $request->anggaran_min,
            'anggaran_max' => $request->anggaran_max,
            'deadline' => $request->deadline,
            'status' => 'open'
        ]);

        return response()->json([
            'message' => 'Proyek berhasil dibuat!',
            'project' => $project
        ], 201);
    }

    // Get my projects (for client)
    public function myProjects(Request $request)
    {
        $user = $request->user();
        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json(['message' => 'Client tidak ditemukan'], 404);
        }

        $projects = Project::where('client_id', $client->id)
            ->with(['kategori', 'offers' => function($query) {
                $query->with('freelancer')->orderBy('created_at', 'desc');
            }])
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    // Apply to project (by freelancer)
    public function apply(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'offered_budget' => 'required|numeric|min:0',
            'message' => 'required|string',
            'proposed_deadline_days' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        // Get freelancer from user email
        $freelancer = Freelancer::where('email', $user->email)->first();

        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai freelancer'
            ], 403);
        }

        $project = Project::find($projectId);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan'
            ], 404);
        }

        if ($project->status != 'open') {
            return response()->json([
                'success' => false,
                'message' => 'Proyek sudah tidak tersedia'
            ], 400);
        }

        // Check if already applied
        $existingOffer = Offer::where('project_id', $projectId)
            ->where('freelancer_id', $freelancer->id)
            ->whereIn('status', ['pending', 'accepted', 'countered'])
            ->first();

        if ($existingOffer) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah mengajukan penawaran untuk proyek ini'
            ], 409);
        }

        $offer = Offer::create([
            'project_id' => $projectId,
            'freelancer_id' => $freelancer->id,
            'offered_budget' => $request->offered_budget,
            'message' => $request->message,
            'proposed_deadline_days' => $request->proposed_deadline_days,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil dikirim!',
            'data' => [
                'id' => $offer->id,
                'project_id' => $offer->project_id,
                'freelancer_name' => $freelancer->nama_lengkap,
                'offered_budget' => $offer->offered_budget,
                'message' => $offer->message,
                'proposed_deadline_days' => $offer->proposed_deadline_days,
                'status' => $offer->status,
                'created_at' => $offer->created_at,
            ]
        ], 201);
    }

    // Terima penawaran freelancer (by client)
    public function acceptBid(Request $request, $projectId, $bidId)
    {
        $user = $request->user();
        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $project = Project::where('id', $projectId)
            ->where('client_id', $client->id)
            ->first();

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $bid = Bid::where('id', $bidId)
            ->where('project_id', $projectId)
            ->first();

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        // Tolak semua bid lain
        Bid::where('project_id', $projectId)
            ->where('id', '!=', $bidId)
            ->update(['status' => 'rejected']);

        // Accept bid ini
        $bid->update(['status' => 'accepted']);

        // Update project status
        $project->update(['status' => 'in_progress']);

        return response()->json(['message' => 'Bid accepted successfully']);
    }
}
