@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-edit text-yellow-400 mr-2"></i> Edit Data Client
    </h2>

    <form action="{{ route('client.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm text-gray-300 mb-1">Nama Perusahaan <span class="text-red-400">*</span></label>
                <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $client->nama_perusahaan) }}"
                       class="input-glass w-full" required>
                @error('nama_perusahaan') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Nama Kontak <span class="text-red-400">*</span></label>
                <input type="text" name="nama_kontak" value="{{ old('nama_kontak', $client->nama_kontak) }}"
                       class="input-glass w-full" required>
                @error('nama_kontak') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Email <span class="text-red-400">*</span></label>
                <input type="email" name="email" value="{{ old('email', $client->email) }}"
                       class="input-glass w-full" required>
                @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">No Telepon <span class="text-red-400">*</span></label>
                <input type="text" name="no_telepon" value="{{ old('no_telepon', $client->no_telepon) }}"
                       class="input-glass w-full" required>
                @error('no_telepon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Bidang Usaha <span class="text-red-400">*</span></label>
                <input type="text" name="bidang_usaha" value="{{ old('bidang_usaha', $client->bidang_usaha) }}"
                       class="input-glass w-full" required>
                @error('bidang_usaha') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status" class="input-glass w-full">
                    <option value="aktif" {{ old('status', $client->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $client->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm text-gray-300 mb-1">Alamat <span class="text-red-400">*</span></label>
                <textarea name="alamat" rows="3" class="input-glass w-full" required>{{ old('alamat', $client->alamat) }}</textarea>
                @error('alamat') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('client.index') }}" class="bg-gray-700/50 hover:bg-gray-700/70 px-5 py-2 rounded-lg transition">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">
                <i class="fas fa-save mr-1"></i> Update
            </button>
        </div>
    </form>
</div>
@endsection
