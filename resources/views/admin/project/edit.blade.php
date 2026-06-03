@extends('layouts.admin')

@section('title', 'Edit Proyek')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-edit text-yellow-400 mr-2"></i> Edit Proyek
    </h2>

    <form action="{{ route('project.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm text-gray-300 mb-1">Judul Proyek <span class="text-red-400">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $project->judul) }}"
                       class="input-glass w-full" required>
                @error('judul') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Client <span class="text-red-400">*</span></label>
                <select name="client_id" class="input-glass w-full" required>
                    <option value="">Pilih Client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                            {{ $client->nama_perusahaan }} - {{ $client->nama_kontak }}
                        </option>
                    @endforeach
                </select>
                @error('client_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Kategori <span class="text-red-400">*</span></label>
                <select name="kategori_id" class="input-glass w-full" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $project->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Anggaran Minimal (Rp) <span class="text-red-400">*</span></label>
                <input type="number" name="anggaran_min" value="{{ old('anggaran_min', $project->anggaran_min) }}"
                       class="input-glass w-full" required>
                @error('anggaran_min') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Anggaran Maksimal (Rp) <span class="text-red-400">*</span></label>
                <input type="number" name="anggaran_max" value="{{ old('anggaran_max', $project->anggaran_max) }}"
                       class="input-glass w-full" required>
                @error('anggaran_max') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Deadline <span class="text-red-400">*</span></label>
                <input type="date" name="deadline" value="{{ old('deadline', $project->deadline) }}"
                       class="input-glass w-full" required>
                @error('deadline') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="open" {{ old('status', $project->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ old('status', $project->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ old('status', $project->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm text-gray-300 mb-1">Deskripsi <span class="text-red-400">*</span></label>
                <textarea name="deskripsi" rows="4" class="input-glass w-full" required>{{ old('deskripsi', $project->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('project.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
