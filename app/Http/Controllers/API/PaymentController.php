<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\MidtransService;
use App\Models\Project;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected MidtransService $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    // 1. Buat transaksi dan dapetin Snap Token
    public function createTransaction(Request $request, int $projectId)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $client = Client::where('email', $user->email)->first();
        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $project = Project::where('id', $projectId)
            ->where('client_id', $client->id)
            ->first();

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        try {
            $snapResponse = $this->midtrans->createPayment($project, $user->email, $user->name);

            return response()->json([
                'snap_token'   => $snapResponse->token,
                'redirect_url' => $snapResponse->redirect_url,
                'order_id'     => $snapResponse->order_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payment initiation failed',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // 2. Webhook dari Midtrans
    public function callback(Request $request)
    {
        $payload = $request->all();
        $this->midtrans->handleNotification($payload);
        return response()->json(['message' => 'OK'], 200);
    }

    // 3. Cek status transaksi
    public function status(string $orderId)
    {
        $transaction = Transaction::where('order_id', $orderId)->first();
        if (!$transaction) {
            return response()->json(['status' => 'not_found'], 404);
        }
        return response()->json(['status' => $transaction->status]);
    }
}
