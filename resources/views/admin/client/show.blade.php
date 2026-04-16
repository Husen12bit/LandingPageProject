@extends('layouts.admin')

@section('title', 'Detail Client - Admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Client</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Nama Perusahaan</th>
                            <td>{{ $client->nama_perusahaan }}</td>
                        </tr>
                        <tr>
                            <th>Nama Kontak</th>
                            <td>{{ $client->nama_kontak }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $client->email }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $client->no_telepon }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Bidang Usaha</th>
                            <td>{{ $client->bidang_usaha }}</td>
                        </tr>
                        <tr>
                            <th>Total Proyek</th>
                            <td>{{ $client->total_proyek }} proyek</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($client->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12 mt-3">
                    <h5>Alamat</h5>
                    <p>{{ $client->alamat }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('client.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline">
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
