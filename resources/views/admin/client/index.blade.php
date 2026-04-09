@extends('layouts.landing')

@section('title', 'Data Client - Admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Client</h4>
            <a href="{{ route('client.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Client
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
                            <th>Nama Perusahaan</th>
                            <th>Nama Kontak</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Bidang Usaha</th>
                            <th>Total Proyek</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $key => $client)
                        <tr>
                            <td>{{ $clients->firstItem() + $key }} </td>
                            <td>{{ $client->nama_perusahaan }} </td>
                            <td>{{ $client->nama_kontak }} </td>
                            <td>{{ $client->email }} </td>
                            <td>{{ $client->no_telepon }} </td>
                            <td>{{ $client->bidang_usaha }} </td>
                            <td>{{ $client->total_proyek }} </td>
                            <td>
                                @if($client->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                             </td>
                            <td>
                                <a href="{{ route('client.show', $client->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('client.edit', $client->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline">
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
                            <td colspan="9" class="text-center">Tidak ada data client</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $clients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
