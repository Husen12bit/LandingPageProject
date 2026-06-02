<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Menampilkan semua data client
    public function index()
    {
        $clients = Client::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.client.index', compact('clients'));
    }

    // Menampilkan form tambah client
    public function create()
    {
        return view('admin.client.create');
    }

    // Menyimpan data client baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'nama_kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Client::create($request->all());

        return redirect()->route('client.index')
            ->with('success', 'Data client berhasil ditambahkan');
    }

    // Menampilkan detail client
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.show', compact('client'));
    }

    // Menampilkan form edit client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.client.edit', compact('client'));
    }

    // Mengupdate data client
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'nama_kontak' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'bidang_usaha' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $client = Client::findOrFail($id);
        $client->update($request->all());

        return redirect()->route('client.index')
            ->with('success', 'Data client berhasil diupdate');
    }

    // Menghapus data client
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Data client berhasil dihapus');
    }
}
