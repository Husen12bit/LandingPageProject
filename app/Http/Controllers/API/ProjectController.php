<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Bid;
use App\Models\Freelancer;
use App\Models\Client;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        $projects->getCollection()->transform(function ($project) {
            return $this->withFileUrls($project);
        });

        return response()->json($projects);
    }

    // Get single project
    public function show($id)
    {
        $project = Project::with(['client', 'kategori', 'bids.freelancer'])->find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        return response()->json($this->withFileUrls($project));
    }

    // Store new project (by client)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'anggaran_min' => 'required|numeric|min:0|max:99999999.99',
            'anggaran_max' => 'required|numeric|min:0|max:99999999.99|gt:anggaran_min',
            'deadline' => 'required|date',
            'attachment_file' => 'nullable|file|max:20480',
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

        if ($request->hasFile('attachment_file')) {
            $file = $request->file('attachment_file');
            $safeName = Str::uuid() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $fileName = $extension ? "{$safeName}.{$extension}" : $safeName;
            $filePath = $file->storeAs("project-attachments/{$project->id}", $fileName);

            $attachmentData = [];
            if (Schema::hasColumn('projects', 'attachment_file')) {
                $attachmentData['attachment_file'] = $filePath;
            }
            if (Schema::hasColumn('projects', 'attachment_name')) {
                $attachmentData['attachment_name'] = $file->getClientOriginalName();
            }
            if (!empty($attachmentData)) {
                $project->update($attachmentData);
            }
        }

        return response()->json([
            'message' => 'Proyek berhasil dibuat!',
            'project' => $this->withFileUrls($project->fresh(['client', 'kategori']))
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

        $projects->getCollection()->transform(function ($project) {
            return $this->withFileUrls($project);
        });

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

    public function submitResult(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'result_file' => 'required|file|max:51200',
            'result_link' => 'nullable|string|max:255',
            'result_note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
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

        $hasAcceptedOffer = Offer::where('project_id', $project->id)
            ->where('freelancer_id', $freelancer->id)
            ->where('status', 'accepted')
            ->exists();

        if (!$hasAcceptedOffer && $project->assigned_freelancer_id !== $freelancer->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengirim hasil proyek ini'
            ], 403);
        }

        $file = $request->file('result_file');
        $safeName = Str::uuid() . '-' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $fileName = $extension ? "{$safeName}.{$extension}" : $safeName;
        $filePath = $file->storeAs("project-results/{$project->id}", $fileName);

        $resultData = [
            'result_file' => $filePath,
            'result_link' => $request->result_link,
            'result_note' => $request->result_note,
            'status' => 'completed',
        ];

        if (Schema::hasColumn('projects', 'result_submitted_at')) {
            $resultData['result_submitted_at'] = now();
        }

        $project->update($resultData);

        return response()->json([
            'success' => true,
            'message' => 'Hasil pekerjaan berhasil dikirim',
            'data' => $this->withFileUrls(
                $project->fresh(['client', 'kategori', 'offers.freelancer'])
            ),
        ]);
    }

    public function downloadAttachment(Request $request, $projectId)
    {
        $project = Project::with(['client'])->find($projectId);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan'
            ], 404);
        }

        if (!$project->attachment_file || !Storage::exists($project->attachment_file)) {
            return response()->json([
                'success' => false,
                'message' => 'Lampiran belum tersedia'
            ], 404);
        }

        return Storage::download(
            $project->attachment_file,
            $project->attachment_name ?: basename($project->attachment_file)
        );
    }

    public function downloadResult(Request $request, $projectId)
    {
        $project = Project::with(['client', 'offers.freelancer'])->find($projectId);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan'
            ], 404);
        }

        if (!$this->canAccessProjectResult($request, $project)) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses ke file hasil proyek ini'
            ], 403);
        }

        if (!$project->result_file || !Storage::exists($project->result_file)) {
            return response()->json([
                'success' => false,
                'message' => 'File hasil belum tersedia'
            ], 404);
        }

        return Storage::download($project->result_file, basename($project->result_file));
    }

    public function review(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar sebagai client'
            ], 403);
        }

        $project = Project::with('offers.freelancer')
            ->where('id', $projectId)
            ->where('client_id', $client->id)
            ->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek tidak ditemukan'
            ], 404);
        }

        if ($project->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Review hanya bisa dikirim setelah freelancer mengirim hasil'
            ], 422);
        }

        $reviewData = [];

        if (Schema::hasColumn('projects', 'review_rating')) {
            $reviewData['review_rating'] = $request->rating;
        }

        if (Schema::hasColumn('projects', 'review_comment')) {
            $reviewData['review_comment'] = $request->comment;
        }

        if (Schema::hasColumn('projects', 'reviewed_at')) {
            $reviewData['reviewed_at'] = now();
        }

        if (!empty($reviewData)) {
            $project->update($reviewData);
        }

        $acceptedOffer = $project->offers->firstWhere('status', 'accepted');
        $freelancer = $acceptedOffer?->freelancer;

        if (!$freelancer && $project->assigned_freelancer_id) {
            $freelancer = Freelancer::find($project->assigned_freelancer_id);
        }

        if ($freelancer) {
            $completedRatings = Project::query()
                ->whereHas('offers', function ($query) use ($freelancer) {
                    $query->where('freelancer_id', $freelancer->id)
                        ->where('status', 'accepted');
                });

            if (Schema::hasColumn('projects', 'review_rating')) {
                $completedRatings->whereNotNull('review_rating');
                $averageRating = round((float) $completedRatings->avg('review_rating'), 2);
                $freelancer->update(['rating' => $averageRating]);
            } else {
                $freelancer->update(['rating' => $request->rating]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Review berhasil dikirim',
            'data' => $project->fresh(['client', 'kategori', 'offers.freelancer']),
        ]);
    }

    private function canAccessProjectResult(Request $request, Project $project): bool
    {
        $user = $request->user();

        $client = Client::where('email', $user->email)->first();
        if ($client && (int) $project->client_id === (int) $client->id) {
            return true;
        }

        $freelancer = Freelancer::where('email', $user->email)->first();
        if (!$freelancer) {
            return false;
        }

        if ($project->assigned_freelancer_id && (int) $project->assigned_freelancer_id === (int) $freelancer->id) {
            return true;
        }

        return Offer::where('project_id', $project->id)
            ->where('freelancer_id', $freelancer->id)
            ->where('status', 'accepted')
            ->exists();
    }

    private function withFileUrls(Project $project): Project
    {
        if ($project->attachment_file) {
            $project->setAttribute(
                'attachment_file_url',
                url("/api/projects/{$project->id}/attachment-file")
            );
            $project->setAttribute(
                'attachment_file_name',
                $project->attachment_name ?: basename($project->attachment_file)
            );
        }

        if ($project->result_file) {
            $project->setAttribute(
                'result_file_url',
                url("/api/projects/{$project->id}/result-file")
            );
            $project->setAttribute('result_file_name', basename($project->result_file));
        }

        return $project;
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
