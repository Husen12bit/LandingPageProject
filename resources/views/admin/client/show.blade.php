@extends('layouts.admin')

@section('title', 'Detail Client')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-building text-blue-400 mr-2"></i> Detail Client
    </h2>

    <div class="space-y-3 text-gray-200">
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Nama Perusahaan :</span>
            <span class="col-span-2 font-medium">{{ $client->nama_perusahaan }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Nama Kontak :</span>
            <span class="col-span-2">{{ $client->nama_kontak }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Email :</span>
            <span class="col-span-2">{{ $client->email }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">No Telepon :</span>
            <span class="col-span-2">{{ $client->no_telepon }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Bidang Usaha :</span>
            <span class="col-span-2">{{ $client->bidang_usaha }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Total Proyek :</span>
            <span class="col-span-2">{{ $client->total_proyek ?? 0 }} proyek</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Status :</span>
            <span class="col-span-2">
                @if($client->status == 'aktif')
                    <span class="badge-emerald">Aktif</span>
                @else
                    <span class="badge-gray">Nonaktif</span>
                @endif
            </span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2 border-b border-white/10">
            <span class="text-gray-400">Alamat :</span>
            <span class="col-span-2">{{ $client->alamat }}</span>
        </div>
        <div class="grid grid-cols-3 gap-2 py-2">
            <span class="text-gray-400">Dibuat :</span>
            <span class="col-span-2">{{ $client->created_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('client.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <div class="flex gap-2">
            <a href="{{ route('client.edit', $client->id) }}" class="btn-emerald px-5 py-2 rounded-lg inline-block">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('client.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus client ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500/70 hover:bg-red-500 px-5 py-2 rounded-lg transition">
                    <i class="fas fa-trash mr-1"></i> Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .badge-emerald {
        background: #10B98120;
        color: #10B981;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 13px;
    }
    .badge-gray {
        background: #64748B30;
        color: #94A3B8;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 13px;
    }
</style>
@endsection
