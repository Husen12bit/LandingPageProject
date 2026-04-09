@extends('layouts.landing')

@section('title', 'Data Penawaran')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Penawaran Freelancer</h4>
            <a href="{{ route('bid.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Penawaran
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
                    <thead class="table-warning">
                        <tr>
                            <th>No</th>
                            <th>Proyek</th>
                            <th>Freelancer</th>
                            <th>Harga Penawaran</th>
                            <th>Estimasi Hari</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bids as $key => $bid)
                        <tr>
                            <td>{{ $bids->firstItem() + $key }}</td>
                            <td>{{ Str::limit($bid->project->judul ?? '-', 30) }}</td>
                            <td>{{ $bid->freelancer->nama_lengkap ?? '-' }}</td>
                            <td>Rp {{ number_format($bid->harga_penawaran, 0, ',', '.') }}</td>
                            <td>{{ $bid->estimasi_hari }} hari</td>
                            <td>
                                @if($bid->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($bid->status == 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('bid.show', $bid->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('bid.edit', $bid->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('bid.destroy', $bid->id) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">Tidak ada data penawaran</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $bids->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
