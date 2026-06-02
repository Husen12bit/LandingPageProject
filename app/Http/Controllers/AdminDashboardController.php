<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use App\Models\Client;
use App\Models\Kategori;
use App\Models\Project;
use App\Models\Bid;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Hitung total data
        $totalFreelancer = Freelancer::count();
        $totalClient = Client::count();
        $totalKategori = Kategori::count();
        $totalProject = Project::count();
        $totalBid = Bid::count();

        // Hitung berdasarkan status
        $freelancerAktif = Freelancer::where('status', 'aktif')->count();
        $freelancerVerifikasi = Freelancer::where('status', 'verifikasi')->count();

        $clientAktif = Client::where('status', 'aktif')->count();

        $projectOpen = Project::where('status', 'open')->count();
        $projectProgress = Project::where('status', 'in_progress')->count();
        $projectCompleted = Project::where('status', 'completed')->count();

        $bidPending = Bid::where('status', 'pending')->count();
        $bidAccepted = Bid::where('status', 'accepted')->count();

        // Data untuk chart (7 hari terakhir)
        $labels = [];
        $freelancerData = [];
        $projectData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('d/m', strtotime($date));

            $freelancerData[] = Freelancer::whereDate('created_at', $date)->count();
            $projectData[] = Project::whereDate('created_at', $date)->count();
        }

        // Data untuk chart kategori proyek
        $kategoriLabels = [];
        $kategoriData = [];
        $kategoris = Kategori::withCount('projects')->get();

        foreach ($kategoris as $kategori) {
            $kategoriLabels[] = $kategori->nama_kategori;
            $kategoriData[] = $kategori->projects_count;
        }

        // Data freelancer terbaru
        $latestFreelancers = Freelancer::orderBy('created_at', 'desc')->limit(5)->get();

        // Data proyek terbaru
        $latestProjects = Project::with(['client', 'kategori'])->orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalFreelancer', 'totalClient', 'totalKategori', 'totalProject', 'totalBid',
            'freelancerAktif', 'freelancerVerifikasi', 'clientAktif',
            'projectOpen', 'projectProgress', 'projectCompleted',
            'bidPending', 'bidAccepted',
            'labels', 'freelancerData', 'projectData',
            'kategoriLabels', 'kategoriData',
            'latestFreelancers', 'latestProjects'
        ));
    }
}
