<?php

namespace App\Services;

use App\Models\User;
use App\Models\Freelancer;
use App\Models\Project;
use App\Models\Bid;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class AIRiskDetectionService
{
    /**
     * Hitung skor risiko untuk satu user (client atau freelancer)
     * Return: array ['score' => 0-100, 'level' => 'low', 'medium', 'high', 'reasons' => [...]]
     */
    public function analyzeUser(User $user): array
    {
        $score = 0;
        $reasons = [];

        // 1. Cek proyek batal sebagai client
        $cancelledProjects = Project::where('client_id', $user->id)
            ->where('status', 'cancelled')
            ->count();
        if ($cancelledProjects > 2) {
            $score += 40;
            $reasons[] = "Membatalkan $cancelledProjects proyek (client)";
        }

        // 2. Cek laporan (asumsi ada tabel reports dengan kolom reported_user_id)
        // Jika belum ada, bisa skip atau gunakan log suspended
        if (DB::table('reports')->where('reported_user_id', $user->id)->exists()) {
            $reportCount = DB::table('reports')->where('reported_user_id', $user->id)->count();
            $score += min(30, $reportCount * 10);
            $reasons[] = "Menerima $reportCount laporan dari pengguna lain";
        }

        // 3. Jika freelancer, cek status verifikasi
        $freelancer = Freelancer::where('user_id', $user->id)->first();
        if ($freelancer) {
            // Status 'verifikasi' berarti belum diverifikasi
            if ($freelancer->status === 'verifikasi') {
                $score += 20;
                $reasons[] = "Freelancer masih dalam status verifikasi (belum aktif)";
            }

            // Opsional: status 'nonaktif' juga mencurigakan
            if ($freelancer->status === 'nonaktif') {
                $score += 10;
                $reasons[] = "Freelancer berstatus nonaktif";
            }

            // 4. Rating rendah (sudah benar)
            if ($freelancer->rating && $freelancer->rating < 2) {
                $score += 25;
                $reasons[] = "Rating sangat rendah (" . $freelancer->rating . "/5)";
            }

            // 5. Akun baru tapi banyak bid
            $accountAge = now()->diffInDays($user->created_at);
            $bidCount = Bid::where('freelancer_id', $freelancer->id)->count();
            if ($accountAge < 7 && $bidCount > 10) {
                $score += 15;
                $reasons[] = "Akun baru ($accountAge hari) dengan $bidCount tawaran (lama)";
            }

            // 6. Persentase bid ditolak
            $totalBids = $bidCount;
            $rejectedBids = Bid::where('freelancer_id', $freelancer->id)
                ->where('status', 'rejected')
                ->count();
            if ($totalBids > 0 && ($rejectedBids / $totalBids) > 0.5) {
                $score += 20;
                $reasons[] = "Lebih dari 50% tawaran ditolak";
            }
        }

        // Batasi skor maksimal 100
        $score = min(100, $score);

        // Tentukan level
        if ($score >= 70) {
            $level = 'high';
        } elseif ($score >= 40) {
            $level = 'medium';
        } else {
            $level = 'low';
        }

        return [
            'score' => $score,
            'level' => $level,
            'reasons' => $reasons,
        ];
    }

    /**
     * Ambil semua user yang memiliki risiko tinggi atau sedang
     * Untuk ditampilkan di dashboard admin
     */
    public function getRiskyUsers($level = null)
    {
        $users = User::all();
        $results = [];

        foreach ($users as $user) {
            $analysis = $this->analyzeUser($user);
            if ($level === null) {
                $results[] = array_merge(['user' => $user], $analysis);
            } elseif ($analysis['level'] === $level) {
                $results[] = array_merge(['user' => $user], $analysis);
            }
        }

        // Urutkan berdasarkan skor tertinggi
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $results;
    }
}
