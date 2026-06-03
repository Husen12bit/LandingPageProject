@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5">
        <i class="fas fa-user-plus text-emerald-400 mr-2"></i> Form User Baru
    </h2>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
                <div><label class="block text-sm text-gray-300">Nama Lengkap *</label><input type="text" name="name" class="input-glass w-full" required></div>
                <div><label class="block text-sm text-gray-300">Username *</label><input type="text" name="username" class="input-glass w-full" required></div>
                <div><label class="block text-sm text-gray-300">Email *</label><input type="email" name="email" class="input-glass w-full" required></div>
                <div><label class="block text-sm text-gray-300">Password *</label><input type="password" name="password" class="input-glass w-full" required></div>
                <div><label class="block text-sm text-gray-300">Role *</label>
                    <select name="role" class="input-glass w-full">
                        <option value="client">Client</option>
                        <option value="freelancer">Freelancer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div><label class="block text-sm text-gray-300">Status</label>
                    <select name="is_active" class="input-glass w-full">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                <div class="md:col-span-2"><label class="block text-sm text-gray-300">No Telepon</label><input type="text" name="phone" class="input-glass w-full"></div>
                <div class="md:col-span-2"><label class="block text-sm text-gray-300">Bio</label><textarea name="bio" rows="2" class="input-glass w-full"></textarea></div>
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <a href="{{ route('user.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">Simpan</button>
        </div>
    </form>
</div>
@endsection
