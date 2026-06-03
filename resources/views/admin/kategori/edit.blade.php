@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-edit text-yellow-400 mr-2"></i> Edit Kategori
    </h2>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nama Kategori <span class="text-red-400">*</span></label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       class="input-glass w-full" required>
                @error('nama_kategori') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Icon (Font Awesome)</label>
                <input type="text" name="icon" value="{{ old('icon', $kategori->icon) }}"
                       class="input-glass w-full" placeholder="Contoh: fas fa-code">
                <div class="mt-2">
                    @if($kategori->icon)
                        <span class="text-sm text-gray-400">Preview: <i class="{{ $kategori->icon }} text-emerald-400"></i> <code class="text-xs">{{ $kategori->icon }}</code></span>
                    @endif
                </div>
                @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="aktif" {{ old('status', $kategori->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $kategori->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="input-glass w-full">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('kategori.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
