@extends('layouts.admin')

@section('title', 'Data Proyek')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center flex-wrap gap-3 mb-5">
        <h2 class="text-xl font-semibold">
            <i class="fas fa-project-diagram text-purple-400 mr-2"></i> Daftar Proyek
        </h2>
        <a href="{{ route('project.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Proyek
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-400/50 text-emerald-300 px-4 py-3 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead>
                <tr>
                    <th class="w-12">No</th>
                    <th>Judul Proyek</th>
                    <th>Client</th>
                    <th>Kategori</th>
                    <th>Anggaran</th>
                    <th class="w-28">Deadline</th>
                    <th class="w-24">Status</th>
                    <th class="w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $key => $project)
                <tr>
                    <td>{{ $projects->firstItem() + $key }}</td>
                    <td class="font-medium">{{ Str::limit($project->judul, 40) }}</td>
                    <td>{{ $project->client->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $project->kategori->nama_kategori ?? '-' }}</td>
                    <td>Rp {{ number_format($project->anggaran_min, 0, ',', '.') }} - Rp {{ number_format($project->anggaran_max, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>
                    <td>
                        @if($project->status == 'open')
                            <span class="badge-emerald">Open</span>
                        @elseif($project->status == 'in_progress')
                            <span class="badge-yellow">In Progress</span>
                        @elseif($project->status == 'completed')
                            <span class="badge-blue">Completed</span>
                        @else
                            <span class="badge-gray">Cancelled</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('project.show', $project->id) }}" class="text-blue-400 hover:text-blue-300 transition" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('project.edit', $project->id) }}" class="text-yellow-400 hover:text-yellow-300 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus proyek ini?')" class="inline">
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
                    <td colspan="8" class="text-center text-gray-400 py-6">Belum ada data proyek</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $projects->links() }}
    </div>
</div>

<style>
    .badge-emerald {
        background: #10B98120;
        color: #10B981;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        min-width: 75px;
        text-align: center;
    }
    .badge-yellow {
        background: #EAB30820;
        color: #EAB308;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        min-width: 75px;
        text-align: center;
    }
    .badge-blue {
        background: #3B82F620;
        color: #3B82F6;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        min-width: 75px;
        text-align: center;
    }
    .badge-gray {
        background: #64748B30;
        color: #94A3B8;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        min-width: 75px;
        text-align: center;
    }
    .table-glass th, .table-glass td {
        vertical-align: middle;
    }
</style>
@endsection
