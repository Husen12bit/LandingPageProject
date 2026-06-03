@extends('layouts.admin')
@section('title', 'Detail Freelancer')
@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Detail Freelancer</h2>
    <div class="space-y-2 text-gray-200">
        <p><span class="text-gray-400 w-36 inline-block">Nama:</span> {{ $freelancer->nama_lengkap }}</p>
        <p><span class="text-gray-400 w-36 inline-block">Email:</span> {{ $freelancer->email }}</p>
        <p><span class="text-gray-400 w-36 inline-block">No Telepon:</span> {{ $freelancer->no_telepon }}</p>
        <p><span class="text-gray-400 w-36 inline-block">Keahlian:</span> {{ $freelancer->keahlian }}</p>
        <p><span class="text-gray-400 w-36 inline-block">Harga/Hari:</span> Rp {{ number_format($freelancer->harga_per_hari,0,',','.') }}</p>
        <p><span class="text-gray-400 w-36 inline-block">Pengalaman:</span> {{ $freelancer->pengalaman_tahun }} tahun</p>
        <p><span class="text-gray-400 w-36 inline-block">Rating:</span> <i class="fas fa-star text-yellow-400"></i> {{ $freelancer->rating }}</p>
        <p><span class="text-gray-400 w-36 inline-block">Status:</span> @if($freelancer->status=='aktif')<span class="badge-emerald">Aktif</span>@elseif($freelancer->status=='verifikasi')<span class="badge-yellow">Verifikasi</span>@else<span class="badge-gray">Nonaktif</span>@endif</p>
        <p><span class="text-gray-400 w-36 inline-block">Portfolio:</span> @if($freelancer->portfolio)<a href="{{ $freelancer->portfolio }}" target="_blank" class="text-emerald-400">Lihat</a>@else - @endif</p>
        <p><span class="text-gray-400 w-36 inline-block">Deskripsi:</span> {{ $freelancer->deskripsi }}</p>
    </div>
    <div class="flex justify-between mt-6">
        <a href="{{ route('freelancer.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
        <div>
            <a href="{{ route('freelancer.edit', $freelancer->id) }}" class="btn-emerald px-5 py-2 rounded-lg inline-block">Edit</a>
            <form action="{{ route('freelancer.destroy', $freelancer->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button type="submit" class="bg-red-500/70 px-5 py-2 rounded-lg ml-2">Hapus</button></form>
        </div>
    </div>
</div>
@endsection
