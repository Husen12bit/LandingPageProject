@extends('layouts.admin')

@section('title', 'Data Penawaran')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center flex-wrap gap-3 mb-5">
        <h2 class="text-xl font-semibold">
            <i class="fas fa-gavel text-orange-400 mr-2"></i> Daftar Penawaran Freelancer
        </h2>
        <a href="{{ route('bid.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Penawaran
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-400/50 text-emerald-300 px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/20 border border-red-400/50 text-red-300 px-4 py-3 rounded-lg mb-5">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead>
                <tr>
                    <th class="w-12">No</th>
                    <th>Proyek</th>
                    <th>Freelancer</th>
                    <th>Harga Penawaran</th>
                    <th>Estimasi Hari</th>
                    <th class="w-24">Status</th>
                    <th class="w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bids as $key => $bid)
                <tr>
                    <td>{{ $bids->firstItem() + $key }}</td>
                    <td class="font-medium">{{ Str::limit($bid->project->judul ?? '-', 40) }}</td>
                    <td>{{ $bid->freelancer->nama_lengkap ?? '-' }}</td>
                    <td>Rp {{ number_format($bid->harga_penawaran, 0, ',', '.') }}</td>
                    <td>{{ $bid->estimasi_hari }} hari</td>
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
                                <a href="{{ route('bid.approve', $bid->id) }}" class="text-emerald-400 hover:text-emerald-300 transition" title="Setujui" onclick="return confirm('Setujui penawaran ini?')">
                                    <i class="fas fa-check-circle"></i>
                                </a>
                                <a href="{{ route('bid.reject', $bid->id) }}" class="text-red-400 hover:text-red-300 transition" title="Tolak" onclick="return confirm('Tolak penawaran ini?')">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            @endif
                            <a href="{{ route('bid.show', $bid->id) }}" class="text-blue-400 hover:text-blue-300 transition" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('bid.edit', $bid->id) }}" class="text-yellow-400 hover:text-yellow-300 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('bid.destroy', $bid->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus penawaran ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-400 py-6">Belum ada data penawaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $bids->links() }}
    </div>
</div>

<style>
    .badge-emerald { background: #10B98120; color: #10B981; padding: 2px 10px; border-radius: 20px; font-size: 12px; display: inline-block; min-width: 75px; text-align: center; }
    .badge-yellow { background: #EAB30820; color: #EAB308; padding: 2px 10px; border-radius: 20px; font-size: 12px; display: inline-block; min-width: 75px; text-align: center; }
    .badge-gray { background: #64748B30; color: #94A3B8; padding: 2px 10px; border-radius: 20px; font-size: 12px; display: inline-block; min-width: 75px; text-align: center; }
    .table-glass th, .table-glass td { vertical-align: middle; }
</style>
@endsection
