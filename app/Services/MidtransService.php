<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;
use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Exception;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized  = config('midtrans.is_sanitized', true);
        Config::$is3ds        = config('midtrans.is_3ds', true);
    }

    public function createPayment(Project $project, string $clientEmail, string $clientName)
    {
        $orderId = 'ORDER-' . $project->id . '-' . time();
        $amount  = (int) ($project->agreed_budget ?? $project->anggaran_min);

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'email'       => $clientEmail,
                'first_name'  => $clientName,
            ],
            'item_details' => [
                [
                    'id'       => $project->id,
                    'price'    => $amount,
                    'quantity' => 1,
                    'name'     => 'Project: ' . $project->judul,
                ]
            ]
        ];

        try {
            $snapResponse = Snap::createTransaction($params);

            Transaction::create([
                'order_id'          => $orderId,
                'project_id'        => $project->id,
                'amount'            => $amount,
                'status'            => 'pending',
                'midtrans_payload'  => json_encode($snapResponse),
            ]);

            return $snapResponse;
        } catch (Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function handleNotification(array $payload)
    {
        $orderId = $payload['order_id'] ?? null;
        if (!$orderId) {
            return false;
        }

        $transaction = Transaction::where('order_id', $orderId)->first();
        if (!$transaction) {
            return false;
        }

        $status = $this->mapStatus($payload['transaction_status'] ?? 'pending');
        $transaction->update([
            'status'         => $status,
            'payment_type'   => $payload['payment_type'] ?? null,
            'midtrans_payload' => json_encode($payload),
        ]);

        if ($status === 'settlement') {
            Project::where('id', $transaction->project_id)->update([
                'status' => 'in_progress',
            ]);
        }

        return true;
    }

    private function mapStatus(string $midtransStatus): string
    {
        return match ($midtransStatus) {
            'capture', 'settlement' => 'settlement',
            'pending'               => 'pending',
            'deny', 'expire', 'cancel' => 'failed',
            default                 => 'pending',
        };
    }
}
