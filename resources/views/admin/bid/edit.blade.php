@extends('layouts.admin')

@section('title', 'Edit Penawaran')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Penawaran</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('bid.update', $bid->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="project_id" class="form-label">Proyek <span class="text-danger">*</span></label>
                        <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id" required>
                            <option value="">Pilih Proyek</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id', $bid->project_id) == $project->id ? 'selected' : '' }}>
                                    {{ $project->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="freelancer_id" class="form-label">Freelancer <span class="text-danger">*</span></label>
                        <select class="form-control @error('freelancer_id') is-invalid @enderror" id="freelancer_id" name="freelancer_id" required>
                            <option value="">Pilih Freelancer</option>
                            @foreach($freelancers as $freelancer)
                                <option value="{{ $freelancer->id }}" {{ old('freelancer_id', $bid->freelancer_id) == $freelancer->id ? 'selected' : '' }}>
                                    {{ $freelancer->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('freelancer_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="harga_penawaran" class="form-label">Harga Penawaran (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('harga_penawaran') is-invalid @enderror"
                               id="harga_penawaran" name="harga_penawaran" value="{{ old('harga_penawaran', $bid->harga_penawaran) }}" required>
                        @error('harga_penawaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="estimasi_hari" class="form-label">Estimasi Hari Pengerjaan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('estimasi_hari') is-invalid @enderror"
                               id="estimasi_hari" name="estimasi_hari" value="{{ old('estimasi_hari', $bid->estimasi_hari) }}" required>
                        @error('estimasi_hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status', $bid->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ old('status', $bid->status) == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ old('status', $bid->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="pesan_penawaran" class="form-label">Pesan Penawaran <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('pesan_penawaran') is-invalid @enderror"
                                  id="pesan_penawaran" name="pesan_penawaran" rows="4" required>{{ old('pesan_penawaran', $bid->pesan_penawaran) }}</textarea>
                        @error('pesan_penawaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('bid.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
