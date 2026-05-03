<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($projectId, Request $request)
    {
        // TODO: Implementasi
        return response()->json(['message' => 'Chat index endpoint']);
    }

    public function send($projectId, Request $request)
    {
        // TODO: Implementasi
        return response()->json(['message' => 'Chat send endpoint']);
    }
}
