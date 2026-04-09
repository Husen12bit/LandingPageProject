@extends('layouts.landing')

@section('title', 'Tambah Freelancer')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Freelancer Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('freelancer.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                               id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="no_telepon" class="form-label">No Telepon <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                               id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" required>
                        @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="keahlian" class="form-label">Keahlian <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('keahlian') is-invalid @enderror"
                               id="keahlian" name="keahlian" value="{{ old('keahlian') }}" required>
                        @error('keahlian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="harga_per_hari" class="form-label">Harga per Hari (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga_per_hari') is-invalid @enderror"
                               id="harga_per_hari" name="harga_per_hari" value="{{ old('harga_per_hari') }}" required>
                        @error('harga_per_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="pengalaman_tahun" class="form-label">Pengalaman (tahun) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('pengalaman_tahun') is-invalid @enderror"
                               id="pengalaman_tahun" name="pengalaman_tahun" value="{{ old('pengalaman_tahun') }}" required>
                        @error('pengalaman_tahun')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="verifikasi" {{ old('status') == 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="portfolio" class="form-label">Portfolio (URL)</label>
                        <input type="text" class="form-control @error('portfolio') is-invalid @enderror"
                               id="portfolio" name="portfolio" value="{{ old('portfolio') }}" placeholder="https://...">
                        @error('portfolio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('freelancer.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
