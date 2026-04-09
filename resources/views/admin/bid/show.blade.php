@extends('layouts.landing')

@section('title', 'Detail Penawaran')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Penawaran</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Proyek</th>
                            <td>{{ $bid->project->judul ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Client</th>
                            <td>{{ $bid->project->client->nama_perusahaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Freelancer</th>
                            <td>{{ $bid->freelancer->nama_lengkap ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Keahlian Freelancer</th>
                            <td>{{ $bid->freelancer->keahlian ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Harga Penawaran</th>
                            <td>Rp {{ number_format($bid->harga_penawaran, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Estimasi Hari</th>
                            <td>{{ $bid->estimasi_hari }} hari</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($bid->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($bid->status == 'accepted')
                                    <span class="badge bg-success">Accepted</span>
                                @else
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $bid->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <h5>Pesan Penawaran</h5>
                    <p>{{ $bid->pesan_penawaran }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('bid.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    @if($bid->status == 'pending')
                        <a href="{{ route('bid.approve', $bid->id) }}" class="btn btn-success">Setujui</a>
                        <a href="{{ route('bid.reject', $bid->id) }}" class="btn btn-danger">Tolak</a>
                    @endif
                    <a href="{{ route('bid.edit', $bid->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('bid.destroy', $bid->id) }}" method="POST" class="d-inline">
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
