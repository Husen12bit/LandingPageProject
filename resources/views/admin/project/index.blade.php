@extends('layouts.admin')

@section('title', 'Data Proyek')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Proyek</h4>
            <a href="{{ route('project.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Proyek
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
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Judul Proyek</th>
                            <th>Client</th>
                            <th>Kategori</th>
                            <th>Anggaran</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $key => $project)
                        <tr>
                            <td>{{ $projects->firstItem() + $key }}</td>
                            <td>{{ Str::limit($project->judul, 30) }}</td>
                            <td>{{ $project->client->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $project->kategori->nama_kategori ?? '-' }}</td>
                            <td>Rp {{ number_format($project->anggaran_min, 0, ',', '.') }} - Rp {{ number_format($project->anggaran_max, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>
                            <td>
                                @if($project->status == 'open')
                                    <span class="badge bg-success">Open</span>
                                @elseif($project->status == 'in_progress')
                                    <span class="badge bg-warning">In Progress</span>
                                @elseif($project->status == 'completed')
                                    <span class="badge bg-info">Completed</span>
                                @else
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('project.show', $project->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('project.destroy', $project->id) }}" method="POST" class="d-inline">
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
                            <td colspan="8" class="text-center">Tidak ada data proyek</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $projects->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
