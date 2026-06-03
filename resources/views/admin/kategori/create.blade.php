@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-tag text-emerald-400 mr-2"></i> Form Kategori Baru
    </h2>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nama Kategori <span class="text-red-400">*</span></label>
                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}"
                       class="input-glass w-full" required>
                @error('nama_kategori') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Icon (Font Awesome)</label>
                <input type="text" name="icon" value="{{ old('icon') }}"
                       class="input-glass w-full" placeholder="Contoh: fas fa-code, fas fa-mobile-alt">
                <p class="text-gray-500 text-xs mt-1">Masukkan class Font Awesome lengkap. <a href="https://fontawesome.com/icons" target="_blank" class="text-emerald-400">Cari icon</a></p>
                @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="input-glass w-full">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('kategori.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection
