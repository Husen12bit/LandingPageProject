@extends('layouts.admin')

@section('title', 'Detail Penawaran')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-info-circle text-blue-400 mr-2"></i> Detail Penawaran
    </h2>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <div class="space-y-3">
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Proyek :</span>
                    <span class="flex-1 font-medium">{{ $bid->project->judul ?? '-' }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Client :</span>
                    <span class="flex-1">{{ $bid->project->client->nama_perusahaan ?? '-' }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Freelancer :</span>
                    <span class="flex-1">{{ $bid->freelancer->nama_lengkap ?? '-' }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Keahlian :</span>
                    <span class="flex-1">{{ $bid->freelancer->keahlian ?? '-' }}</span>
                </div>
            </div>
        </div>
        <div>
            <div class="space-y-3">
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Harga Penawaran :</span>
                    <span class="flex-1">Rp {{ number_format($bid->harga_penawaran, 0, ',', '.') }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Estimasi Hari :</span>
                    <span class="flex-1">{{ $bid->estimasi_hari }} hari</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Status :</span>
                    <span class="flex-1">
                        @if($bid->status == 'pending')
                            <span class="badge-yellow">Pending</span>
                        @elseif($bid->status == 'accepted')
                            <span class="badge-emerald">Accepted</span>
                        @else
                            <span class="badge-gray">Rejected</span>
                        @endif
                    </span>
                </div>
                <div class="flex py-2">
                    <span class="text-gray-400 w-36">Dibuat :</span>
                    <span class="flex-1">{{ $bid->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
        <div class="md:col-span-2">
            <div class="mt-4 p-3 bg-white/5 rounded-lg">
                <h5 class="font-medium text-gray-300 mb-2">Pesan Penawaran</h5>
                <p class="text-gray-200">{{ $bid->pesan_penawaran }}</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('bid.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <div class="flex gap-2">
            @if($bid->status == 'pending')
                <a href="{{ route('bid.approve', $bid->id) }}" class="bg-emerald-600 hover:bg-emerald-700 px-5 py-2 rounded-lg transition" onclick="return confirm('Setujui penawaran ini?')">
                    <i class="fas fa-check mr-1"></i> Setujui
                </a>
                <a href="{{ route('bid.reject', $bid->id) }}" class="bg-red-600 hover:bg-red-700 px-5 py-2 rounded-lg transition" onclick="return confirm('Tolak penawaran ini?')">
                    <i class="fas fa-times mr-1"></i> Tolak
                </a>
            @endif
            <a href="{{ route('bid.edit', $bid->id) }}" class="btn-emerald px-5 py-2 rounded-lg inline-block">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('bid.destroy', $bid->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penawaran ini?')">
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
    .badge-emerald { background:#10B98120; color:#10B981; padding:2px 12px; border-radius:20px; display:inline-block; }
    .badge-yellow { background:#EAB30820; color:#EAB308; padding:2px 12px; border-radius:20px; display:inline-block; }
    .badge-gray { background:#64748B30; color:#94A3B8; padding:2px 12px; border-radius:20px; display:inline-block; }
</style>
@endsection
