@extends('layouts.landing')

@section('title', 'Detail Proyek')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Proyek</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Judul Proyek</th>
                            <td>{{ $project->judul }}</td>
                        </tr>
                        <tr>
                            <th>Client</th>
                            <td>{{ $project->client->nama_perusahaan ?? '-' }} ({{ $project->client->nama_kontak ?? '-' }})</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $project->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anggaran</th>
                            <td>Rp {{ number_format($project->anggaran_min, 0, ',', '.') }} - Rp {{ number_format($project->anggaran_max, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Deadline</th>
                            <td>{{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Status</th>
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
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $project->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Update</th>
                            <td>{{ $project->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <h5>Deskripsi Proyek</h5>
                    <p>{{ $project->deskripsi }}</p>
                </div>
            </div>

            <!-- Daftar Penawaran -->
            <div class="mt-4">
                <h5>Daftar Penawaran</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Freelancer</th>
                                <th>Harga Penawaran</th>
                                <th>Estimasi Hari</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->bids as $bid)
                            <tr>
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
                                    @if($bid->status == 'pending')
                                        <a href="{{ route('bid.approve', $bid->id) }}" class="btn btn-success btn-sm">Setujui</a>
                                        <a href="{{ route('bid.reject', $bid->id) }}" class="btn btn-danger btn-sm">Tolak</a>
                                    @endif
                                 </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada penawaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('project.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('project.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('project.destroy', $project->id) }}" method="POST" class="d-inline">
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
