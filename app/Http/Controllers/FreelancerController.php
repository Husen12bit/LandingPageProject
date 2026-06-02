<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    // Menampilkan semua data freelancer
    public function index()
    {
        $freelancers = Freelancer::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.freelancer.index', compact('freelancers'));
    }

    // Menampilkan form tambah freelancer
    public function create()
    {
        return view('admin.freelancer.create');
    }

    // Menyimpan data freelancer baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers,email',
            'no_telepon' => 'required|string|max:15',
            'keahlian' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'pengalaman_tahun' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif,verifikasi'
        ]);

        Freelancer::create($request->all());

        return redirect()->route('freelancer.index')
            ->with('success', 'Data freelancer berhasil ditambahkan');
    }

    // Menampilkan detail freelancer
    public function show($id)
    {
        $freelancer = Freelancer::findOrFail($id);
        return view('admin.freelancer.show', compact('freelancer'));
    }

    // Menampilkan form edit freelancer
    public function edit($id)
    {
        $freelancer = Freelancer::findOrFail($id);
        return view('admin.freelancer.edit', compact('freelancer'));
    }

    // Mengupdate data freelancer
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:freelancers,email,' . $id,
            'no_telepon' => 'required|string|max:15',
            'keahlian' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga_per_hari' => 'required|numeric|min:0',
            'pengalaman_tahun' => 'required|integer|min:0',
            'status' => 'required|in:aktif,nonaktif,verifikasi'
        ]);

        $freelancer = Freelancer::findOrFail($id);
        $freelancer->update($request->all());

        return redirect()->route('freelancer.index')
            ->with('success', 'Data freelancer berhasil diupdate');
    }

    // Menghapus data freelancer
    public function destroy($id)
    {
        $freelancer = Freelancer::findOrFail($id);
        $freelancer->delete();

        return redirect()->route('freelancer.index')
            ->with('success', 'Data freelancer berhasil dihapus');
    }
}
