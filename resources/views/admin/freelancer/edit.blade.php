@extends('layouts.admin')
@section('title', 'Edit Freelancer')
@section('content')
<div class="glass-card rounded-2xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">Edit Data Freelancer</h2>
    <form action="{{ route('freelancer.update', $freelancer->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="grid md:grid-cols-2 gap-4">
            <div><label>Nama Lengkap</label><input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $freelancer->nama_lengkap) }}" class="input-glass" required></div>
            <div><label>Email</label><input type="email" name="email" value="{{ old('email', $freelancer->email) }}" class="input-glass" required></div>
            <div><label>No Telepon</label><input type="text" name="no_telepon" value="{{ old('no_telepon', $freelancer->no_telepon) }}" class="input-glass" required></div>
            <div><label>Keahlian</label><input type="text" name="keahlian" value="{{ old('keahlian', $freelancer->keahlian) }}" class="input-glass" required></div>
            <div><label>Harga per Hari</label><input type="number" name="harga_per_hari" value="{{ old('harga_per_hari', $freelancer->harga_per_hari) }}" class="input-glass" required></div>
            <div><label>Pengalaman tahun</label><input type="number" name="pengalaman_tahun" value="{{ old('pengalaman_tahun', $freelancer->pengalaman_tahun) }}" class="input-glass" required></div>
            <div><label>Status</label><select name="status" class="input-glass"><option value="verifikasi" @selected($freelancer->status=='verifikasi')>Verifikasi</option><option value="aktif" @selected($freelancer->status=='aktif')>Aktif</option><option value="nonaktif" @selected($freelancer->status=='nonaktif')>Nonaktif</option></select></div>
            <div><label>Portfolio</label><input type="text" name="portfolio" value="{{ old('portfolio', $freelancer->portfolio) }}" class="input-glass"></div>
            <div class="md:col-span-2"><label>Deskripsi</label><textarea name="deskripsi" rows="3" class="input-glass" required>{{ old('deskripsi', $freelancer->deskripsi) }}</textarea></div>
        </div>
        <div class="flex justify-between mt-6">
            <a href="{{ route('freelancer.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>
@endsection
