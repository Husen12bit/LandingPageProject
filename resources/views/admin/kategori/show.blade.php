@extends('layouts.admin')

@section('title', 'Detail Kategori')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Kategori</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Nama Kategori</th>
                            <td>{{ $kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <th>Icon</th>
                            <td>
                                @if($kategori->icon)
                                    <i class="{{ $kategori->icon }} fa-2x text-success"></i>
                                    <code>{{ $kategori->icon }}</code>
                                @else
                                    <span class="text-muted">Tidak ada icon</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($kategori->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $kategori->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Update</th>
                            <td>{{ $kategori->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Deskripsi</h5>
                    <p>{{ $kategori->deskripsi ?: '-' }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
