@extends('layouts.admin')

@section('title', 'Edit Penawaran')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-edit text-yellow-400 mr-2"></i> Edit Penawaran
    </h2>

    <form action="{{ route('bid.update', $bid->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Proyek <span class="text-red-400">*</span></label>
                <select name="project_id" class="input-glass w-full" required>
                    <option value="">Pilih Proyek</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $bid->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->judul }}
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
                        <option value="{{ $freelancer->id }}" {{ old('freelancer_id', $bid->freelancer_id) == $freelancer->id ? 'selected' : '' }}>
                            {{ $freelancer->nama_lengkap }} - {{ $freelancer->keahlian }}
                        </option>
                    @endforeach
                </select>
                @error('freelancer_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Harga Penawaran (Rp) <span class="text-red-400">*</span></label>
                    <input type="number" name="harga_penawaran" value="{{ old('harga_penawaran', $bid->harga_penawaran) }}"
                           class="input-glass w-full" required>
                    @error('harga_penawaran') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-300 mb-1">Estimasi Hari <span class="text-red-400">*</span></label>
                    <input type="number" name="estimasi_hari" value="{{ old('estimasi_hari', $bid->estimasi_hari) }}"
                           class="input-glass w-full" required>
                    @error('estimasi_hari') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="pending" {{ old('status', $bid->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ old('status', $bid->status) == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ old('status', $bid->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Pesan Penawaran <span class="text-red-400">*</span></label>
                <textarea name="pesan_penawaran" rows="4" class="input-glass w-full" required>{{ old('pesan_penawaran', $bid->pesan_penawaran) }}</textarea>
                @error('pesan_penawaran') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('bid.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
