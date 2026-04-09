@extends('layouts.landing')

@section('title', 'Data Kategori')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Kategori Layanan</h4>
            <a href="{{ route('kategori.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Icon</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $key => $kategori)
                        <tr>
                            <td>{{ $kategoris->firstItem() + $key }}</td>
                            <td>
                                @if($kategori->icon)
                                    <i class="{{ $kategori->icon }} fa-2x text-success"></i>
                                @else
                                    <i class="fas fa-tag fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>{{ Str::limit($kategori->deskripsi, 50) }}</td>
                            <td>
                                @if($kategori->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data kategori</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $kategoris->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
