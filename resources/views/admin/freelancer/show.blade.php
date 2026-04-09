@extends('layouts.landing')

@section('title', 'Detail Freelancer')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Freelancer</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Lengkap</th>
                            <td>{{ $freelancer->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $freelancer->email }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $freelancer->no_telepon }}</td>
                        </tr>
                        <tr>
                            <th>Keahlian</th>
                            <td>{{ $freelancer->keahlian }}</td>
                        </tr>
                        <tr>
                            <th>Harga per Hari</th>
                            <td>Rp {{ number_format($freelancer->harga_per_hari, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Pengalaman</th>
                            <td>{{ $freelancer->pengalaman_tahun }} tahun</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td><i class="fas fa-star text-warning"></i> {{ $freelancer->rating }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($freelancer->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($freelancer->status == 'nonaktif')
                                    <span class="badge bg-danger">Nonaktif</span>
                                @else
                                    <span class="badge bg-warning">Verifikasi</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Portfolio</th>
                            <td>
                                @if($freelancer->portfolio)
                                    <a href="{{ $freelancer->portfolio }}" target="_blank">Lihat Portfolio</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <h5>Deskripsi</h5>
                    <p>{{ $freelancer->deskripsi }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('freelancer.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('freelancer.edit', $freelancer->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('freelancer.destroy', $freelancer->id) }}" method="POST" class="d-inline">
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
