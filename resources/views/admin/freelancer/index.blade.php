@extends('layouts.admin')

@section('title', 'Data Freelancer')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Freelancer</h4>
            <a href="{{ route('freelancer.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Freelancer
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
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Keahlian</th>
                            <th>Harga/Hari</th>
                            <th>Pengalaman</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($freelancers as $key => $freelancer)
                        <tr>
                            <td>{{ $freelancers->firstItem() + $key }}</td>
                            <td>{{ $freelancer->nama_lengkap }}</td>
                            <td>{{ $freelancer->email }}</td>
                            <td>{{ $freelancer->keahlian }}</td>
                            <td>Rp {{ number_format($freelancer->harga_per_hari, 0, ',', '.') }}</td>
                            <td>{{ $freelancer->pengalaman_tahun }} tahun</td>
                            <td>
                                <i class="fas fa-star text-warning"></i> {{ $freelancer->rating }}
                            </td>
                            <td>
                                @if($freelancer->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($freelancer->status == 'nonaktif')
                                    <span class="badge bg-danger">Nonaktif</span>
                                @else
                                    <span class="badge bg-warning">Verifikasi</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('freelancer.show', $freelancer->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('freelancer.edit', $freelancer->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('freelancer.destroy', $freelancer->id) }}" method="POST" class="d-inline">
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
                            <td colspan="9" class="text-center">Tidak ada data freelancer</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $freelancers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
