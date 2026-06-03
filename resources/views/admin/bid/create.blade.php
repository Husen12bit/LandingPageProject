@extends('layouts.admin')

@section('title', 'Tambah Penawaran')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-plus-circle text-emerald-400 mr-2"></i> Form Penawaran Baru
    </h2>

    @if(session('error'))
        <div class="bg-red-500/20 border border-red-400/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('bid.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Proyek <span class="text-red-400">*</span></label>
                <select name="project_id" class="input-glass w-full" required>
                    <option value="">Pilih Proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->judul }} (Rp {{ number_format($project->anggaran_min,0,',','.') }} - Rp {{ number_format($project->anggaran_max,0,',','.') }})
                        </option>
                    @endforeach
                </select>
                @error('project_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Freelancer <span class="text-red-400">*</span></label>
                <select name="freelancer_id" class="input-glass w-full" required>
                    <option value="">Pilih Freelancer</option>
                    @foreach($freelancers as $freelancer)
                        <option value="{{ $freelancer->id }}" {{ old('freelancer_id') == $freelancer->id ? 'selected' : '' }}>
                            {{ $freelancer->nama_lengkap }} - {{ $freelancer->keahlian }}
                        </option>
                    @endforeach
                </select>
                @error('freelancer_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Harga Penawaran (Rp) <span class="text-red-400">*</span></label>
                    <input type="number" name="harga_penawaran" value="{{ old('harga_penawaran') }}"
                           class="input-glass w-full" required>
                    @error('harga_penawaran') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Estimasi Hari <span class="text-red-400">*</span></label>
                    <input type="number" name="estimasi_hari" value="{{ old('estimasi_hari') }}"
                           class="input-glass w-full" required>
                    @error('estimasi_hari') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Pesan Penawaran <span class="text-red-400">*</span></label>
                <textarea name="pesan_penawaran" rows="4" class="input-glass w-full" required>{{ old('pesan_penawaran') }}</textarea>
                @error('pesan_penawaran') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('bid.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
