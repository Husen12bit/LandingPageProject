@extends('layouts.admin')

@section('title', 'Tambah Freelancer')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-5"><i class="fas fa-user-plus text-emerald-400 mr-2"></i> Form Freelancer Baru</h2>
    <form action="{{ route('freelancer.store') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 gap-4">
            <div><label class="block text-sm text-gray-300 mb-1">Nama Lengkap *</label><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">Email *</label><input type="email" name="email" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">No Telepon *</label><input type="text" name="no_telepon" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">Keahlian *</label><input type="text" name="keahlian" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">Harga per Hari (Rp) *</label><input type="number" name="harga_per_hari" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">Pengalaman (tahun) *</label><input type="number" name="pengalaman_tahun" class="input-glass" required></div>
            <div><label class="block text-sm text-gray-300 mb-1">Status *</label><select name="status" class="input-glass"><option value="verifikasi">Verifikasi</option><option value="aktif">Aktif</option><option value="nonaktif">Nonaktif</option></select></div>
            <div><label class="block text-sm text-gray-300 mb-1">Portfolio (URL)</label><input type="text" name="portfolio" class="input-glass"></div>
            <div class="md:col-span-2"><label class="block text-sm text-gray-300 mb-1">Deskripsi *</label><textarea name="deskripsi" rows="3" class="input-glass" required></textarea></div>
        </div>
        <div class="flex justify-between mt-6">
            <a href="{{ route('freelancer.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection
