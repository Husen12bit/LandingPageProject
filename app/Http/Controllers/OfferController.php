<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Project;
use App\Models\Freelancer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    /**
     * Display a listing of offers.
     */
    public function index()
    {
        $offers = Offer::with(['project', 'freelancer'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new offer.
     * (Optional, jika admin boleh membuat offer langsung)
     */
    public function create()
    {
        $projects = Project::where('status', 'open')->get();
        $freelancers = Freelancer::where('status', 'aktif')->get();
        return view('admin.offer.create', compact('projects', 'freelancers'));
    }

    /**
     * Store a newly created offer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'            => 'required|exists:projects,id',
            'freelancer_id'         => 'required|exists:freelancers,id',
            'offered_budget'        => 'required|numeric|min:0',
            'message'               => 'required|string',
            'proposed_deadline_days'=> 'required|integer|min:1',
            'status'                => ['required', Rule::in(['pending', 'accepted', 'rejected', 'countered'])],
        ]);

        Offer::create($validated);

        return redirect()->route('offer.index')
            ->with('success', 'Offer berhasil ditambahkan.');
    }

    /**
     * Display the specified offer.
     */
    public function show(Offer $offer)
    {
        $offer->load(['project', 'freelancer']);
        return view('admin.offer.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified offer.
     */
    public function edit(Offer $offer)
    {
        $projects = Project::where('status', 'open')->get();
        $freelancers = Freelancer::where('status', 'aktif')->get();
        return view('admin.offer.edit', compact('offer', 'projects', 'freelancers'));
    }

    /**
     * Update the specified offer.
     */
    public function update(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'project_id'            => 'required|exists:projects,id',
            'freelancer_id'         => 'required|exists:freelancers,id',
            'offered_budget'        => 'required|numeric|min:0',
            'message'               => 'required|string',
            'proposed_deadline_days'=> 'required|integer|min:1',
            'status'                => ['required', Rule::in(['pending', 'accepted', 'rejected', 'countered'])],
        ]);

        $offer->update($validated);

        return redirect()->route('offer.index')
            ->with('success', 'Offer berhasil diperbarui.');
    }

    /**
     * Remove the specified offer.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offer.index')
            ->with('success', 'Offer berhasil dihapus.');
    }

    /**
     * Approve an offer (change status to accepted).
     */
    public function approve($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->status = 'accepted';
        $offer->save();

        // Opsional: update project dengan assigned_freelancer_id dan agreed_budget
        $project = $offer->project;
        $project->assigned_freelancer_id = $offer->freelancer_id;
        $project->agreed_budget = $offer->offered_budget;
        $project->status = 'in_progress';
        $project->save();

        return redirect()->route('offer.index')
            ->with('success', 'Offer disetujui. Proyek sekarang dalam progress.');
    }

    /**
     * Reject an offer (change status to rejected).
     */
    public function reject($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->status = 'rejected';
        $offer->save();

        return redirect()->route('offer.index')
            ->with('success', 'Offer ditolak.');
    }
}
