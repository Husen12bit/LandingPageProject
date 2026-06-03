@extends('layouts.admin')

@section('title', 'Data Freelancer')

@section('content')
<div class="glass-card rounded-2xl p-6">
    <div class="flex justify-between items-center mb-5 flex-wrap gap-3">
        <h2 class="text-xl font-semibold"><i class="fas fa-user text-emerald-400 mr-2"></i> Daftar Freelancer</h2>
        <a href="{{ route('freelancer.create') }}" class="btn-emerald px-4 py-2 rounded-lg text-white text-sm"><i class="fas fa-plus mr-1"></i> Tambah</a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/20 border border-emerald-400 text-emerald-300 px-4 py-3 rounded-lg mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-glass w-full">
            <thead>
                <tr><th>No</th><th>Nama</th><th>Email</th><th>Keahlian</th><th>Harga/Hari</th><th>Rating</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($freelancers as $key => $f)
                <tr>
                    <td>{{ $freelancers->firstItem() + $key }}</td>
                    <td>{{ $f->nama_lengkap }}</td>
                    <td>{{ $f->email }}</td>
                    <td>{{ $f->keahlian }}</td>
                    <td>Rp {{ number_format($f->harga_per_hari,0,',','.') }}</td>
                    <td><i class="fas fa-star text-yellow-400 text-xs"></i> {{ $f->rating }}</td>
                    <td>@if($f->status=='aktif')<span class="badge-emerald">Aktif</span>@elseif($f->status=='verifikasi')<span class="badge-yellow">Verifikasi</span>@else<span class="badge-gray">Nonaktif</span>@endif</td>
                    <td class="flex gap-2">
                        <a href="{{ route('freelancer.show', $f->id) }}" class="text-blue-400 hover:text-blue-300"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('freelancer.edit', $f->id) }}" class="text-yellow-400 hover:text-yellow-300"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('freelancer.destroy', $f->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty <tr><td colspan="8" class="text-center">Tidak ada data</td></tr> @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $freelancers->links() }}</div>
</div>
@endsection
