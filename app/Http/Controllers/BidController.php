<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Project;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::with(['project', 'freelancer'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bid.index', compact('bids'));
    }

    public function create()
    {
        $projects = Project::where('status', 'open')->get();
        $freelancers = Freelancer::where('status', 'aktif')->get();
        return view('admin.bid.create', compact('projects', 'freelancers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'freelancer_id' => 'required|exists:freelancers,id',
            'harga_penawaran' => 'required|numeric|min:0',
            'pesan_penawaran' => 'required|string',
            'estimasi_hari' => 'required|integer|min:1',
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        // Cek apakah freelancer sudah pernah bidding di project ini
        $existingBid = Bid::where('project_id', $request->project_id)
                          ->where('freelancer_id', $request->freelancer_id)
                          ->first();

        if ($existingBid) {
            return redirect()->back()
                ->with('error', 'Freelancer sudah pernah mengajukan penawaran untuk proyek ini')
                ->withInput();
        }

        Bid::create($request->all());

        return redirect()->route('bid.index')
            ->with('success', 'Penawaran berhasil ditambahkan');
    }

    public function show($id)
    {
        $bid = Bid::with(['project', 'freelancer'])->findOrFail($id);
        return view('admin.bid.show', compact('bid'));
    }

    public function edit($id)
    {
        $bid = Bid::findOrFail($id);
        $projects = Project::where('status', 'open')->get();
        $freelancers = Freelancer::where('status', 'aktif')->get();
        return view('admin.bid.edit', compact('bid', 'projects', 'freelancers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'freelancer_id' => 'required|exists:freelancers,id',
            'harga_penawaran' => 'required|numeric|min:0',
            'pesan_penawaran' => 'required|string',
            'estimasi_hari' => 'required|integer|min:1',
            'status' => 'required|in:pending,accepted,rejected'
        ]);

        $bid = Bid::findOrFail($id);
        $bid->update($request->all());

        return redirect()->route('bid.index')
            ->with('success', 'Penawaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->delete();

        return redirect()->route('bid.index')
            ->with('success', 'Penawaran berhasil dihapus');
    }

    // Method khusus untuk approve/reject bid
    public function approve($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->update(['status' => 'accepted']);

        // Update status project menjadi in_progress
        $bid->project->update(['status' => 'in_progress']);

        return redirect()->route('bid.index')
            ->with('success', 'Penawaran disetujui');
    }

    public function reject($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->update(['status' => 'rejected']);

        return redirect()->route('bid.index')
            ->with('success', 'Penawaran ditolak');
    }
}
