<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['client', 'kategori'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        $clients = Client::where('status', 'aktif')->get();
        $kategoris = Kategori::where('status', 'aktif')->get();
        return view('admin.project.create', compact('clients', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'anggaran_min' => 'required|numeric|min:0',
            'anggaran_max' => 'required|numeric|min:0|gte:anggaran_min',
            'deadline' => 'required|date',
            'status' => 'required|in:open,in_progress,completed,cancelled'
        ]);

        Project::create($request->all());

        return redirect()->route('project.index')
            ->with('success', 'Proyek berhasil ditambahkan');
    }

    public function show($id)
    {
        $project = Project::with(['client', 'kategori', 'bids.freelancer'])->findOrFail($id);
        return view('admin.project.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $clients = Client::where('status', 'aktif')->get();
        $kategoris = Kategori::where('status', 'aktif')->get();
        return view('admin.project.edit', compact('project', 'clients', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'anggaran_min' => 'required|numeric|min:0',
            'anggaran_max' => 'required|numeric|min:0|gte:anggaran_min',
            'deadline' => 'required|date',
            'status' => 'required|in:open,in_progress,completed,cancelled'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('project.index')
            ->with('success', 'Proyek berhasil diupdate');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Proyek berhasil dihapus');
    }
}
