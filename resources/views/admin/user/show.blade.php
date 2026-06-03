@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="glass-card rounded-2xl p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4"><i class="fas fa-user-circle text-blue-400 mr-2"></i> Detail User</h2>
    <div class="space-y-3">
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">Nama :</span><span>{{ $user->name }}</span></div>
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">Username :</span><span>{{ $user->username ?? '-' }}</span></div>
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">Email :</span><span>{{ $user->email }}</span></div>
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">Role :</span><span>{{ ucfirst($user->role) }}</span></div>
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">Status :</span><span>@if($user->is_active)<span class="badge-emerald">Aktif</span>@else<span class="badge-gray">Nonaktif</span>@endif</span></div>
        <div class="flex py-2 border-b border-white/10"><span class="text-gray-400 w-32">No Telepon :</span><span>{{ $user->phone ?? '-' }}</span></div>
        <div class="flex py-2"><span class="text-gray-400 w-32">Bio :</span><span>{{ $user->bio ?? '-' }}</span></div>
    </div>
    <div class="flex justify-between mt-6">
        <a href="{{ route('user.index') }}" class="bg-gray-700/50 px-5 py-2 rounded-lg">Kembali</a>
        <div class="flex gap-2">
            <a href="{{ route('user.edit', $user->id) }}" class="btn-emerald px-5 py-2 rounded-lg">Edit</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user?')">@csrf @method('DELETE')<button type="submit" class="bg-red-500/70 px-5 py-2 rounded-lg">Hapus</button></form>
        </div>
    </div>
</div>
@endsection
