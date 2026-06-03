@extends('layouts.admin')

@section('title', 'Detail Proyek')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-4xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">
        <i class="fas fa-info-circle text-blue-400 mr-2"></i> Detail Proyek
    </h2>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <div class="space-y-3">
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Judul Proyek :</span>
                    <span class="flex-1 font-medium">{{ $project->judul }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Client :</span>
                    <span class="flex-1">{{ $project->client->nama_perusahaan ?? '-' }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Kategori :</span>
                    <span class="flex-1">{{ $project->kategori->nama_kategori ?? '-' }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Anggaran :</span>
                    <span class="flex-1">Rp {{ number_format($project->anggaran_min, 0, ',', '.') }} - Rp {{ number_format($project->anggaran_max, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        <div>
            <div class="space-y-3">
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Deadline :</span>
                    <span class="flex-1">{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Status :</span>
                    <span class="flex-1">
                        @if($project->status == 'open')
                            <span class="badge-emerald">Open</span>
                        @elseif($project->status == 'in_progress')
                            <span class="badge-yellow">In Progress</span>
                        @elseif($project->status == 'completed')
                            <span class="badge-blue">Completed</span>
                        @else
                            <span class="badge-gray">Cancelled</span>
                        @endif
                    </span>
                </div>
                <div class="flex py-2 border-b border-white/10">
                    <span class="text-gray-400 w-36">Dibuat :</span>
                    <span class="flex-1">{{ $project->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex py-2">
                    <span class="text-gray-400 w-36">Update :</span>
                    <span class="flex-1">{{ $project->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
        <div class="md:col-span-2">
            <div class="mt-4 p-3 bg-white/5 rounded-lg">
                <h5 class="font-medium text-gray-300 mb-2">Deskripsi</h5>
                <p class="text-gray-200">{{ $project->deskripsi }}</p>
            </div>
        </div>
    </div>

    <!-- Daftar Penawaran -->
    <div class="mt-6">
        <h3 class="text-lg font-semibold mb-3 flex items-center gap-2">
            <i class="fas fa-gavel text-orange-400"></i> Penawaran Freelancer
        </h3>
        <div class="overflow-x-auto">
            <table class="table-glass w-full">
                <thead>
                    <tr>
                        <th>Freelancer</th>
                        <th>Harga Penawaran</th>
                        <th>Estimasi Hari</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project->bids as $bid)
                    <tr>
                        <td>{{ $bid->freelancer->nama_lengkap ?? '-' }}</td>
                        <td>Rp {{ number_format($bid->harga_penawaran, 0, ',', '.') }}</td>
                        <td>{{ $bid->estimasi_hari }} hari</td>
                        <td>{{ Str::limit($bid->pesan_penawaran, 40) }}</td>
                        <td>
                            @if($bid->status == 'pending')
                                <span class="badge-yellow">Pending</span>
                            @elseif($bid->status == 'accepted')
                                <span class="badge-emerald">Accepted</span>
                            @else
                                <span class="badge-gray">Rejected</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if($bid->status == 'pending')
                                    <a href="{{ route('bid.approve', $bid->id) }}" class="text-emerald-400 hover:text-emerald-300 transition" title="Setujui">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                    <a href="{{ route('bid.reject', $bid->id) }}" class="text-red-400 hover:text-red-300 transition" title="Tolak">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                @endif
                                <a href="{{ route('bid.show', $bid->id) }}" class="text-blue-400 hover:text-blue-300 transition" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 py-4">Belum ada penawaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between mt-6">
        <a href="{{ route('project.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
        <div class="flex gap-2">
            <a href="{{ route('project.edit', $project->id) }}" class="btn-emerald px-5 py-2 rounded-lg inline-block">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?')">
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
    .badge-emerald { background:#10B98120; color:#10B981; padding:2px 10px; border-radius:20px; display:inline-block; }
    .badge-yellow { background:#EAB30820; color:#EAB308; padding:2px 10px; border-radius:20px; display:inline-block; }
    .badge-blue { background:#3B82F620; color:#3B82F6; padding:2px 10px; border-radius:20px; display:inline-block; }
    .badge-gray { background:#64748B30; color:#94A3B8; padding:2px 10px; border-radius:20px; display:inline-block; }
</style>
@endsection
