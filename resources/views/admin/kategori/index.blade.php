@extends('layouts.admin')

@section('title', 'Data Kategori')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center flex-wrap gap-3 mb-5">
        <h2 class="text-xl font-semibold">
            <i class="fas fa-tag text-emerald-400 mr-2"></i> Daftar Kategori Layanan
        </h2>
        <a href="{{ route('kategori.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Kategori
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
                    <th class="w-16">Icon</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th class="w-24">Status</th>
                    <th class="w-28 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $key => $kategori)
                <tr>
                    <td>{{ $kategoris->firstItem() + $key }}</td>
                    <td class="text-center text-2xl">
                        @if($kategori->icon)
                            <i class="{{ $kategori->icon }} text-emerald-400"></i>
                        @else
                            <i class="fas fa-tag text-gray-500"></i>
                        @endif
                    </td>
                    <td class="font-medium">{{ $kategori->nama_kategori }}</td>
                    <td>{{ Str::limit($kategori->deskripsi, 60) ?: '-' }}</td>
                    <td>
                        @if($kategori->status == 'aktif')
                            <span class="badge-emerald">Aktif</span>
                        @else
                            <span class="badge-gray">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('kategori.show', $kategori->id) }}" class="text-blue-400 hover:text-blue-300 transition" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="text-yellow-400 hover:text-yellow-300 transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
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
                    <td colspan="6" class="text-center text-gray-400 py-6">Belum ada data kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $kategoris->links() }}
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
</style>
@endsection
