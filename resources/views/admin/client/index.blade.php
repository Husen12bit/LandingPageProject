@extends('layouts.admin')

@section('title', 'Data Client')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center flex-wrap gap-3 mb-5">
        <h2 class="text-xl font-semibold">
            <i class="fas fa-building text-teal-400 mr-2"></i> Daftar Client
        </h2>
        <a href="{{ route('client.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Client
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
                    <th>Nama Perusahaan</th>
                    <th>Kontak</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Bidang Usaha</th>
                    <th class="w-20">Proyek</th>
                    <th class="w-24">Status</th>
                    <th class="w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $key => $client)
                <tr>
                    <td>{{ $clients->firstItem() + $key }}</td>
                    <td class="font-medium">{{ $client->nama_perusahaan }}</td>
                    <td>{{ $client->nama_kontak }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->no_telepon }}</td>
                    <td>{{ $client->bidang_usaha ?: '-' }}</td>
                    <td>{{ $client->total_proyek ?? 0 }}</td>
                    <td>
                        @if($client->status == 'aktif')
                            <span class="badge-emerald">Aktif</span>
                        @else
                            <span class="badge-gray">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('client.show', $client->id) }}" class="text-blue-400 hover:text-blue-300 transition" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('client.edit', $client->id) }}" class="text-yellow-400 hover:text-yellow-300 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('client.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus client ini?')" class="inline">
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
                    <td colspan="9" class="text-center text-gray-400 py-6">Belum ada data client</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $clients->links() }}
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
        text-align: center;
        min-width: 65px;
    }
    .badge-gray {
        background: #64748B30;
        color: #94A3B8;
        padding: 2px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        text-align: center;
        min-width: 65px;
    }
    .table-glass th, .table-glass td {
        vertical-align: middle;
    }
    .table-glass td .flex {
        display: inline-flex;
    }
</style>
@endsection
