@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-5"><i class="fas fa-edit text-yellow-400 mr-2"></i> Edit User</h2>
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="space-y-4">
            <div class="grid md:grid-cols-2 gap-4">
                <div><label>Nama Lengkap *</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-glass w-full" required></div>
                <div><label>Username *</label><input type="text" name="username" value="{{ old('username', $user->username) }}" class="input-glass w-full" required></div>
                <div><label>Email *</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-glass w-full" required></div>
                <div><label>Password (kosongkan jika tidak diubah)</label><input type="password" name="password" class="input-glass w-full" placeholder="********"></div>
                <div><label>Role *</label>
                    <select name="role" class="input-glass w-full">
                        <option value="client" @selected($user->role=='client')>Client</option>
                        <option value="freelancer" @selected($user->role=='freelancer')>Freelancer</option>
                        <option value="admin" @selected($user->role=='admin')>Admin</option>
                    </select>
                </div>
                <div><label>Status</label>
                    <select name="is_active" class="input-glass w-full">
                        <option value="1" @selected($user->is_active)>Aktif</option>
                        <option value="0" @selected(!$user->is_active)>Nonaktif</option>
                    </select>
                </div>
                <div class="md:col-span-2"><label>No Telepon</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-glass w-full"></div>
                <div class="md:col-span-2"><label>Bio</label><textarea name="bio" rows="2" class="input-glass w-full">{{ old('bio', $user->bio) }}</textarea></div>
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <a href="{{ route('user.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
            <button type="submit" class="btn-emerald px-6 py-2 rounded-lg">Update</button>
        </div>
    </form>
</div>
@endsection
