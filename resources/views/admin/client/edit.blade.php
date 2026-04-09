@extends('layouts.landing')

@section('title', 'Edit Client - Admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Data Client</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('client.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                               id="nama_perusahaan" name="nama_perusahaan" value="{{ old('nama_perusahaan', $client->nama_perusahaan) }}" required>
                        @error('nama_perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nama_kontak" class="form-label">Nama Kontak <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_kontak') is-invalid @enderror"
                               id="nama_kontak" name="nama_kontak" value="{{ old('nama_kontak', $client->nama_kontak) }}" required>
                        @error('nama_kontak')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $client->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="no_telepon" class="form-label">No Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                               id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $client->no_telepon) }}" required>
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="bidang_usaha" class="form-label">Bidang Usaha <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('bidang_usaha') is-invalid @enderror"
                               id="bidang_usaha" name="bidang_usaha" value="{{ old('bidang_usaha', $client->bidang_usaha) }}" required>
                        @error('bidang_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="aktif" {{ old('status', $client->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $client->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror"
                                  id="alamat" name="alamat" rows="3" required>{{ old('alamat', $client->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('client.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
