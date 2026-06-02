<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Freelancer;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index($projectId, Request $request)
    {
        $user = $request->user();
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        if (!$this->canAccessProjectChat($user, $project)) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke chat proyek ini'], 403);
        }

        $messages = Chat::where('project_id', $projectId)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'project_id' => $message->project_id,
                    'sender_id' => $message->user_id,
                    'sender_name' => $message->user?->name,
                    'sender_role' => $message->sender_role,
                    'message_type' => $message->message_type,
                    'content' => $message->content,
                    'metadata' => $message->metadata,
                    'created_at' => $message->created_at->toDateTimeString(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $messages,
        ]);
    }

    public function send($projectId, Request $request)
    {
        $user = $request->user();
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json(['message' => 'Proyek tidak ditemukan'], 404);
        }

        if (!$this->canAccessProjectChat($user, $project)) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke chat proyek ini'], 403);
        }

        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:2000',
            'message_type' => 'sometimes|in:text,negotiation,system',
            'metadata' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $senderRole = $user->role;

        $chat = Chat::create([
            'project_id' => $projectId,
            'user_id' => $user->id,
            'sender_role' => $senderRole,
            'message_type' => $request->input('message_type', 'text'),
            'content' => $request->content,
            'metadata' => $request->input('metadata', []),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $chat->id,
                'project_id' => $chat->project_id,
                'sender_id' => $chat->user_id,
                'sender_name' => $user->name,
                'sender_role' => $chat->sender_role,
                'message_type' => $chat->message_type,
                'content' => $chat->content,
                'metadata' => $chat->metadata,
                'created_at' => $chat->created_at->toDateTimeString(),
            ],
        ], 201);
    }

    private function canAccessProjectChat($user, Project $project): bool
    {
        if ($user->role === 'client') {
            return Client::where('id', $project->client_id)
                ->where('email', $user->email)
                ->exists();
        }

        if ($user->role === 'freelancer') {
            $hasOffer = Offer::where('project_id', $project->id)
                ->whereHas('freelancer', function ($query) use ($user) {
                    $query->where('email', $user->email);
                })
                ->exists();

            $isAssignedFreelancer = Freelancer::where('id', $project->assigned_freelancer_id)
                ->where('email', $user->email)
                ->exists();

            return $hasOffer || $isAssignedFreelancer;
        }

        return false;
    }
}
